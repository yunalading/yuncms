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

use app\common\model\BaseRoleModel;

/**
 * Class RoleModel
 * @package app\admin\model
 */
class RoleModel extends BaseRoleModel {
    public function access(){
        return $this->hasMany('role_access','role_id');
    }
}
