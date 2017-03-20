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

use app\admin\model\UserModel;

/**
 * Class User
 * @package app\admin\controller
 */
class User extends AdminBaseController {
    protected $allow_actions = ['login'];

    /**
     * 管理员列表
     * @return \think\response\View
     */
    public function index() {
        $userModel = new UserModel();
        $list = $userModel->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }

    /**
     * 添加或修改管理员
     * @return \think\response\View
     */
    public function update() {
        return view();
    }

    /**
     * 登录
     * @return \think\response\View
     */
    public function login() {
        return view();
    }

    /**
     * 用户信息
     * @return \think\response\View
     */
    public function info() {

        return view();
    }

    /**
     * 退出
     * @return \think\response\View
     */
    public function logout() {

    }
}
