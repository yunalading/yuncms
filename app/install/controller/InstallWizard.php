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
/**
 * 安装向导
 * Class InstallWizard
 * @package app\install\controller
 */
abstract class InstallWizard extends InstallBaseController {
    public function __construct() {
        parent::__construct();
        //检查是否安装
        $this->checkInstall();
    }
}
