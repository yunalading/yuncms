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
/**
 * 角色
 * Class BaseRoleModel
 * @package app\common\model
 */
abstract class BaseRoleModel extends BaseModel {
    protected $name = 'role';

    /**
     * 获取角色权限
     * @return \think\model\relation\HasMany\
     */
    public function access() {
        return $this->hasMany('role_access', 'role_id');
    }
}
