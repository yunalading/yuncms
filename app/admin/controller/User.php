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
use app\admin\model\UserModel;
use app\admin\validate\UserValidate;
use think\exception\PDOException;
use think\Log;

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
        $role_list = RoleModel::all();
        $userModel = new UserModel();
        $action_name = '添加';
        if ($this->request->isPost()) {
            //验证数据
            $user_data = array_filter($this->post['user']);
            $userValidate = new UserValidate();
            if (!$userValidate->check($user_data, [], 'update')) {
                $this->error($userValidate->getError());
            }
            try {
                if (!key_exists('state', $user_data)) {
                    $user_data['state'] = 0;
                }
                $user_data['password'] = $userModel->createPassWord($user_data['password']);
                unset($user_data['password2']);
                //添加或更新角色
                $userModel->saveAll([$user_data])[0];
                $this->success('操作成功!', url('/admin/user'));
            } catch (PDOException $e) {
                Log::error($e);
                if ($e->getCode() == 10501) {
                    $this->error('用户已存在，操作失败');
                }
            }
        } else {
            if (!empty($this->param) && $this->param['id']) {
                $user = UserModel::get($this->param['id']);
                $this->assign('user', $user);
                $action_name = '编辑';
            }
        }
        $this->assign('role_list', $role_list);
        $this->assign('action_name', $action_name);
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
                if (UserModel::destroy($this->param['id'], $flag)) {
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
        $list = UserModel::onlyTrashed()->paginate();
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
                $user = UserModel::onlyTrashed()->find($this->param['id']);
                if ($user->restore()) {
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
            UserModel::onlyTrashed()->delete(true);
            $this->success('操作成功!');
        } catch (PDOException $e) {
            Log::error($e);
            $this->error('清空失败!');
        }
    }

    /**
     * 登录
     * @return \think\response\View
     */
    public function login() {
        if ($this->request->isPost()) {

        }
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
     */
    public function logout() {
        $userModel = new UserModel();
        if ($userModel->logout()) {
            $this->success('退出成功', url('/admin'));
        }
    }
}
