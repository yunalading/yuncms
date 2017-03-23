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
namespace app\common\model;

use think\Session;
use traits\model\SoftDelete;

/**
 * 管理员用户
 * Class BaseUserModel
 * @package app\common\model
 */
abstract class BaseUserModel extends BaseModel {
    //开启软删除
    use SoftDelete;
    protected $name = 'users';

    /**
     * 登录
     * @param $username 用户名
     * @param $password 密码
     * @return mixed
     */
    public function login($username, $password) {
        $user = $this->find([
            'username' => $username,
            'password' => $this->createPassWord($password)
        ]);
        Session::set('user', $user);
        return $user;
    }

    /**
     * 退出
     * @return bool
     */
    public function logout() {
        Session::delete('user');
        return true;
    }

    /**
     * 是否登录
     * @return bool
     */
    public function isLogin() {
        return Session::has('user');
    }

    /**
     * 获取当前登录的用户信息
     * @return mixed
     */
    public function currentUser() {
        return Session::get('user');
    }

    /**
     * 创建加密密码
     * @param string $password
     * @return string
     */
    public function createPassWord($password) {
        return md5(md5($password));
    }
}
