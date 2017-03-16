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
        'username' => 'require',
        'password' => 'require|min:6',
        'captcha' => 'require|captcha',
    ];
    protected $message = [
        'username.require' => '用户名不能为空',
        'password.require' => '用户密码不能为空',
        'password.min' => '用户密码最少6个字符',
        'captcha.require' => '验证码不能为空',
        'captcha.captcha' => '验证码输入错误',
    ];
}
