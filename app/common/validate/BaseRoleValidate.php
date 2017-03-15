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
 * Class RoleValidate
 * @package app\common\validate
 */
abstract class BaseRoleValidate extends BaseValidate {
    protected $rule = [
        'role_name' => 'require',

    ];
    protected $message = [
        'role_name.require' => '角色名称为空',
    ];
}
