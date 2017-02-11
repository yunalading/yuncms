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

use app\common\controller\InstallBaseController;
use think\App;
use think\view\driver\Think;

/**
 * Class Index
 * @package app\install\controller
 */
class Index extends InstallBaseController {
    /**
     * 首页
     * @return \think\response\View
     */
    public function index() {
        return view();
    }

    /**
     *
     * @return \think\response\View
     */
    public function step1() {
        return view();
    }

    /**
     * @return \think\response\View
     */
    public function step2() {
        return view();
    }

    /**
     * @return \think\response\View
     */
    public function step3() {
        return view();
    }

    /**
     * @return \think\response\View
     */
    public function step4() {
        return view();
    }

    public function complete() {
        return view();
    }
}
