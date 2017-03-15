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


namespace app\admin\controller;

/**
 * Class Ad
 * @package app\admin\controller
 */
class Ad extends AdminBaseController {
    /**
     * 普通广告列表
     * @return \think\response\View
     */
    public function general() {
        return view();
    }

    /**
     * 脚本广告列表
     * @return \think\response\View
     */
    public function script() {
        return view();
    }

    /**
     * 幻灯片广告列表
     * @return \think\response\View
     */
    public function slide() {
        return view();
    }
}
