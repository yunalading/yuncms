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

    /**
     * 添加或修改角色
     * @return \think\response\View
     */
    public function update() {

        if ($this->request->isPost()) {
            print_r($this->request->post());
            exit;
        }
        $this->assign('actions', config('authorization.menus'));
        return view();
    }

    /**
     * 软删除
     */
    public function remove() {

    }

    /**
     * 回收站
     * @return \think\response\View
     */
    public function trash() {

        return view();
    }

    /**
     * 硬删除
     */
    public function destroy() {

    }

    /**
     * 清空回收站
     */
    public function emptyTrash() {

    }
}
