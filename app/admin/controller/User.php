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

                $action_name = '编辑';
            }
        }
        $this->assign('role_list', $role_list);
        $this->assign('action_name', $action_name);
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
