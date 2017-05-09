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
namespace app\core\rbac;

use app\admin\model\UserModel;
use think\Session;


class Role {
        /*
         * 获取当前登录用户的角色
         */
        public static function get_role(){
            $user_id = session('user.user_id');
            return UserModel::get($user_id)['role_id'];
        }
}
