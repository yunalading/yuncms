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

class InstallFormValidate implements FormValidateInterface {
    private $post = null;

    public function __construct($post) {
        $this->post = $post;
    }

    public function validateForm() {
        $dbValidate = new DbValidate();
        $appValidate = new AppValidate();
        $dbDate = $this->post['db'];
        $appDate = $this->post['app'];
        $flag = $dbValidate->check($dbDate, [], 'install') && $appValidate->check($appDate, [], 'install');
        if ($flag) {
            //保存安装表单
            Install::saveConfig($this->post);
        }
        return $flag;
    }
}
