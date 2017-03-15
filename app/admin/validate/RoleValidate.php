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

use app\common\validate\BaseRoleValidate;

/**
 * Class RoleValidate
 * @package app\admin\validate
 */
class RoleValidate extends BaseRoleValidate {
    protected $scene = [
        'update' => [
            'role_name' => 'require|token'
        ]
    ];
}
