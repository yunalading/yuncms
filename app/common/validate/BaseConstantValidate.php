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

/**
 * Class BaseConstantValidate
 * @package app\common\validate
 */
class BaseConstantValidate extends BaseValidate {
    protected $rule = [
        'key' => ['regex' => '/^[a-zA-Z_]+\d*$/i'],
        'val' => 'require'
    ];
    protected $message = [
        'key.regex' => '请正确填写常量名',
        'val.require' => '请填写常量值',
    ];
}
