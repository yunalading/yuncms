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

use app\admin\model\RoleAccessModel;
use app\core\rbac\Role;
use think\Config;

class Access {
    /*
     * 根据角色获取用户的权限
     */
    public static function get_access($role_id){
        $access = RoleAccessModel::all(['role_id'=>$role_id]);
        $access_list = array();
        foreach($access as $gg){
            $access_list[] = str_replace('.'.Config::get('url_html_suffix'),'',$gg['access']);
        }
        return $access_list;
    }

    /*
     * 返回用户支持的菜单
     */
    public static function get_user_auth(){
        $user_auth = self::get_auth_menu();
        foreach($user_auth['menus'] as $k=>$v) {
            if (count($v['submenus']) < 1) {
                unset($user_auth['menus'][$k]);
            }
        }
        return $user_auth;
    }

    /**
     * 获取用户的权限菜单列表
     */
    protected static function get_auth_menu(){
        //获取用户的角色
        $role_id = Role::get_role();
        $access_list = self::get_access($role_id);
        $auth_config = config('authorization');
        foreach($auth_config['menus'] as $k=>$v){
            foreach($v['submenus'] as $m=>$s){
                if(isset($s['href'])){
                    if(!in_array($s['href'], $access_list)){
                        unset($auth_config['menus'][$k]['submenus'][$m]);
                    }else{
                        if(isset($s['actives']) && !empty($s['actives'])){
                            foreach($s['actives'] as $o=>$p){
                                if(!in_array($p['href'], $access_list)){
                                    unset($auth_config['menus'][$k]['submenus'][$m]['actives'][$o]);
                                }
                            }
                        }
                    }
                }else{
                    if(isset($s['submenus']) && !empty($s['submenus'])){
                        foreach($s['submenus'] as $n=>$z){
                            if(!in_array($z['href'], $access_list)){
                                unset($auth_config['menus'][$k]['submenus'][$n]);
                            }
                        }
                    }
                }
            }
        }


        return $auth_config;
    }
}
