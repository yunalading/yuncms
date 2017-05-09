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


namespace app\admin\validate;

use app\common\validate\BaseConstantValidate;

/**
 * Class ConstantValidate
 * @package app\admin\validate
 */
class ConstantValidate extends BaseConstantValidate {
    protected $scene = [
        'update' => [
            'key' => ['regex' => '/^[a-zA-Z_]+\d*$/i'],
            'val' => 'require|token'
        ]
    ];
}
