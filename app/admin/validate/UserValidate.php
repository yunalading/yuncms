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


namespace app\admin\validate;

use app\common\validate\BaseUserValidate;

/**
 * Class UserValidate
 * @package app\admin\validate
 */
class UserValidate extends BaseUserValidate {
    protected $scene = [
        'login' => [
            'username',
            'password',
            'captcha',
        ],
        'update' => [
            'username' => 'require|token',
            'role_id' => 'require|integer',
            'password' => 'require|min:6',
            'password2' => 'require|confirm:password',
        ]
    ];
}
