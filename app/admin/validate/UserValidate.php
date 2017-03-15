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
        'index' => [
            'username',
            'password',
            'captcha',
        ]
    ];
}
