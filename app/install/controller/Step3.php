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


namespace app\install\controller;

use app\core\install\Install;
use think\Cookie;

/**
 * Class Complete
 * @package app\install\controller
 */
class Step3 extends InstallWizard {
    /**
     * @return \think\response\View
     */
    public function index() {
        if (!Install::checkEnv() || !Install::checkMode()) {
            $this->error('请检查安装环境!', url('/install/step1'));
        }
        return view();
    }
}
