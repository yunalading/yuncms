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

use app\core\system\check\env\GdCheck;
use app\core\system\check\env\OsCheck;
use think\Log;
use app\core\system\BaseCheck;

/**
 * Class Complete
 * @package app\install\controller
 */
class Step1 extends InstallWizard {
    /**
     * @return \think\response\View
     */
    public function index() {
        $env_check = [
            'os' => new OsCheck(),
//            'gd' => new GdCheck(),
        ];
//        echo '<pre>';
//        print_r($env_check);exit;
        Log::info("aaaa");
        return view();
    }
}
