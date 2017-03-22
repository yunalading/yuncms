<?php
// +----------------------------------------------------------------------
// | YunCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://www.yunalading.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: chenqianhao <68527761@qq.com>
// +----------------------------------------------------------------------


namespace app\common\validate;

/**
 * Class BaseUserValidate
 * @package app\common\validate
 */
abstract class BaseUserValidate extends BaseValidate {
    protected $rule = [
        'role_id' => 'require|integer',
        'username' => 'require',
        'password' => 'require|min:6',
        'password2' => 'require|confirm:password',
        'captcha' => 'require|captcha'
    ];
    protected $message = [
        'role_id.require' => '请选择角色',
        'role_id.integer' => '角色编号正确',
        'username.require' => '请输入用户名',
        'password.require' => '请输入密码',
        'password.min' => '密码至少需要6位',
        'password2.require' => '请输入确认密码',
        'password2.confirm' => '确认密码不正确',
        'captcha.require' => '验证码不能为空',
        'captcha.captcha' => '验证码输入错误',
    ];
}
