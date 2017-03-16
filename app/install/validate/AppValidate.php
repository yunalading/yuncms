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


namespace app\install\validate;

/**
 * Class SiteValidate
 * @package app\install\validate
 */
class AppValidate extends InstallValidate {
    protected $rule = [
        'site_name' => 'require',
        'username' => 'require',
        'password' => 'require|min:6',
        'password2' => 'require|confirm:password',
        'email' => 'require|email'
    ];
    protected $message = [
        'site_name.require' => '请填写站点名称',
        'username.require' => '请填写管理员账号',
        'password.require' => '请填写管理员密码',
        'password.min' => '管理员密码至少需要6位',
        'password2.require' => '请输入确认密码',
        'password2.confirm' => '确认密码不正确',
        'email.require' => '请输入管理员邮箱',
        'email.email' => '请正确输入管理员邮箱'
    ];
    protected $scene = [
        'install' => [
            'site_name',
            'username',
            'password',
            'password2',
            'email'
        ]
    ];
}
