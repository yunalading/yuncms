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


namespace app\common\validate;


class BaseAppValidate extends BaseValidate {
    protected $rule = [
        'site_name' => 'require',
        'theme' => 'require',
        'email' => 'require|email'
    ];
    protected $message = [
        'site_name.require' => '请填写网站名称',
        'theme.require' => '请选择主题',
        'email.require' => '请填写管理员邮箱',
        'email.email' => '请填写正确的邮箱地址'
    ];
}
