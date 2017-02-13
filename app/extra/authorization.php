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
return [
  'auth_config' => [
      'auth_on'           => true,                // 认证开关
      'auth_type'         => 1,                   // 认证方式，1为实时认证；2为登录认证。
      'auth_group'        => 'auth_group',        // 用户组数据表名
      'auth_group_access' => 'auth_group_access', // 用户-用户组关系表
      'auth_rule'         => 'auth_rule',         // 权限规则表
      'auth_user'         => 'admin_user'             // 用户信息表
  ],
  'user_administrator' => 1,//管理员的默认id,始终是最大权限
  //'admin_group_id' => 3,//管理员组的默认id
  'develop_mode'  =>  'false',//菜单里面开发者模式
];
