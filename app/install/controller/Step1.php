<?php
// +----------------------------------------------------------------------
// | YunCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://www.yunalading.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: chenqianhao <68527761@qq.com>
// +----------------------------------------------------------------------


namespace app\install\controller;

use app\core\install\Install;

/**
 * Class Complete
 * @package app\install\controller
 */
class Step1 extends InstallWizard {
    /**
     * @return \think\response\View
     */
    public function index() {
        $list = Install::getEnvList();
        $flag = Install::checkEnv();
        $this->assign('list', $list);
        $this->assign('flag', $flag);
        return view();
    }
}
