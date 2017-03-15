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
    /**
     * 清空权限
     * @return mixed
     */
    public function clearAccess() {
        return $this->access()->delete();
    }

    /**
     * 添加角色权限
     * @param $access
     */
    public function updateAccess($access = []) {
        $data = array();
        foreach ($access as $key => $value) {
            $data[] = array('role_id' => $this->role_id, 'access' => $value);
        }
        if (!empty($data)) {
            $this->access()->saveAll($data);
        }
    }
}
