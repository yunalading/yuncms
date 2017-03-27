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

use app\admin\model\RoleModel;
use app\admin\validate\RoleValidate;
use think\exception\PDOException;
use think\Log;

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
        $roleModel = new RoleModel();
        $list = $roleModel->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }

    /**
     * 添加或修改角色
     * @return \think\response\View
     */
    public function update() {
        $roleModel = new RoleModel();
        $action_name = '添加';
        if ($this->request->isPost()) {
            //验证数据
            $role_data = array_filter($this->post['role']);
            $roleValidate = new RoleValidate();
            if (!$roleValidate->check($role_data, [], 'update')) {
                $this->error($roleValidate->getError());
            }
            try {
                //添加或更新角色
                $role = $roleModel->saveAll([$role_data])[0];
                //清空权限
                $role->clearAccess();
                if (!empty($this->post['ac'])) {
                    //添加或更新权限
                    $access = array_filter($this->post['ac']);
                    $role->updateAccess($access);
                }
                $this->success('操作成功!', url('/admin/role'));
            } catch (PDOException $e) {
                Log::error($e);
                //角色名已存在
                if ($e->getCode() == 10501) {
                    $this->error('角色已存在，操作失败');
                }
            }
        } else {
            if (!empty($this->param) && $this->param['id']) {
                //编辑页面初始化数据
                $role = RoleModel::get($this->param['id']);
                $this->assign('role', $role);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name',$action_name);
        $this->assign('actions', config('authorization.menus'));
        return view();
    }

    /**
     * 软删除
     */
    public function remove() {
        $this->delete();
    }

    /**
     * 删除
     * @param bool $flag 是否真删除
     */
    private function delete($flag = false) {
        if (!empty($this->param) && $this->param['id']) {
            try {
                if (RoleModel::destroy($this->param['id'], $flag)) {
                    $this->success('删除成功!');
                } else {
                    $this->error('删除失败!');
                }
            } catch (PDOException $e) {
                Log::error($e);
                $this->error('删除失败!');
            }
        } else {
            $this->error('参数错误!');
        }
    }

    /**
     * 回收站
     * @return \think\response\View
     */
    public function trash() {
        $list = RoleModel::onlyTrashed()->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }

    /**
     * 恢复
     */
    public function recovery() {
        if (!empty($this->param) && $this->param['id']) {
            try {
                $role = RoleModel::onlyTrashed()->find($this->param['id']);
                if ($role->restore()) {
                    $this->success('恢复成功!');
                } else {
                    $this->error('恢复失败!');
                }
            } catch (PDOException $e) {
                Log::error($e);
                $this->error('恢复失败!');
            }
        } else {
            $this->error('参数错误!');
        }
    }

    /**
     * 真删除
     */
    public function destroy() {
        $this->delete(true);
    }

    /**
     * 清空回收站
     */
    public function emptyTrash() {
        try {
            RoleModel::onlyTrashed()->delete(true);
            $this->success('操作成功!');
        } catch (PDOException $e) {
            Log::error($e);
            $this->error('清空失败!');
        }
    }
}
