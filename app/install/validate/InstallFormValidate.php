<?php
// +----------------------------------------------------------------------
// | YunCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://www.yunalading.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: jabber <2898117012@qq.com>
// +----------------------------------------------------------------------


namespace app\install\validate;

use app\core\install\FormValidateInterface;
use app\core\install\Install;
use think\Session;
class InstallFormValidate implements FormValidateInterface {
    private $config = null;

    /**
     * InstallFormValidate constructor.
     * @param $config 需要验证的配置信息
     */
    public function __construct($config) {
        $this->config = $config;
    }

    public function validateForm() {
        $dbValidate = new DbValidate();
        $appValidate = new AppValidate();
        $dbDate = $this->config['db'];
        $appDate = $this->config['app'];
        $flag = $dbValidate->check($dbDate, [], 'install') && $appValidate->check($appDate, [], 'install');
        if( session('install_mode') =='demo'){
            $this->config['app']['theme'] = 'yuncms';
        }else{
            $this->config['app']['theme'] = 'default';
        }
        if ($flag) {
            //保存安装表单
            Install::saveConfig($this->config);
        }
        return $flag;
    }
}
