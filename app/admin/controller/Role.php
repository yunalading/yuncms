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
 * Class Role
 * @package app\admin\controller
 */
class Role extends AdminBaseController {
    /**
     * 角色列表
     * @return \think\response\View
     */
    public function index() {
        return view();
    }

    public function edit() {
        $this->assign('actions',config('authorization.menus'));
        return view();
    }

    public function del() {

    }

}
