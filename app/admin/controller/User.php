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
 * Class User
 * @package app\admin\controller
 */
class User extends AdminBaseController {
    protected $allow_actions = ['login'];
    /**
     * @return \think\response\View
     */
    public function index() {
        return view();
    }

    /**
     * @return \think\response\View
     */
    public function login() {
        return view();
    }

    /**
     * @return \think\response\View
     */
    public function logout() {
        return view();
    }
}
