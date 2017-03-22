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

namespace app\admin\model;

use app\common\model\BaseUserModel;

/**
 * Class UserModel
 * @package app\admin\model
 */
class UserModel extends BaseUserModel {
    /**
     * 获取角色信息
     * @return \think\model\relation\HasOne
     */
    public function role() {
        return $this->hasOne('RoleModel', 'role_id', 'role_id');
    }
}
