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
  // 应用Trace
  'app_trace'              => true,
  'captcha'  => [
          // 验证码字符集合
          'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',
          // 验证码字体大小(px)
          'fontSize' => 25,
          // 是否画混淆曲线
          'useCurve' => true,
           // 验证码图片高度
          'imageH'   => 30,
          // 验证码图片宽度
          'imageW'   => 100,
          // 验证码位数
          'length'   => 5,
          // 验证成功后是否重置
          'reset'    => true
  ],
  'auth_config' => [
      'auth_on'           => true,                // 认证开关
      'auth_type'         => 1,                   // 认证方式，1为实时认证；2为登录认证。
      'auth_group'        => 'auth_group',        // 用户组数据表名
      'auth_group_access' => 'auth_group_access', // 用户-用户组关系表
      'auth_rule'         => 'auth_rule',         // 权限规则表
      'auth_user'         => 'member'             // 用户信息表
  ],
  'user_administrator' => 1,//管理员的默认id,始终是最大权限
  //'admin_group_id' => 3,//管理员组的默认id
  'develop_mode'  =>  'false',//菜单里面开发者模式
  'dispatch_success_tmpl' => APP_PATH . 'admin' . DS . 'view' . DS . 'dispatch_jump.html',
  'dispatch_error_tmpl' => APP_PATH . 'admin' . DS . 'view' . DS . 'dispatch_jump.html',
  'template'  =>  [
    'layout_on'     =>  true,
    'layout_name'   =>  'layout',
    'view_depr' => DS,
    'tpl_cache'=>false,//开发模式下
  ],
];
