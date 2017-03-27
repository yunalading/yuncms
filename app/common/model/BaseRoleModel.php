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
namespace app\common\model;

use traits\model\SoftDelete;

/**
 * 角色
 * Class BaseRoleModel
 * @package app\common\model
 */
abstract class BaseRoleModel extends BaseModel {
    //开启软删除
    use SoftDelete;

    protected $name = 'role';

    //开启删除锁
    protected $del_lock_field = 'del_lock';
    protected $auto = [
        'del_lock' => BaseRoleModel::DEL_LOCK_OFF,
    ];
    
}
