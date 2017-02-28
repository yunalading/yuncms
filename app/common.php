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

// 应用公共文件

/**
 * 检查是否安装
 * @return bool
 */
function check_install() {
    return false;
}

/**
 * 写入配置文件
 */
function write_config($config_path, $old_config = array(), $new_config = array()) {


}

/**
 * Url生成
 * @param string $url 路由地址
 * @param string|array $value 变量
 * @param bool|string $suffix 前缀
 * @param bool|string $domain 域名
 * @return [string] url地址
 */
function U($url = '', $vars = '', $suffix = true, $domain = false)
{
    return \think\Url::build($url, $vars, $suffix, $domain);
}

/**
 * 获取用户的面包屑导航的数据
 * @param string $str 当前的位置
 * @return [array] 网站位置集合
 */
function GetPositionLink($str='')
{
    $position=array();
    $request = request();
    $module=strtolower($request->module());
    if($str!=''){
      $url=$str;
    }else{
      $url=strtolower($request->module()).'/'.strtolower($request->controller()).'/'.strtolower($request->action());
    }
    //后台面包屑导航
    if($module == 'admin'){
      $row=\think\Db::name('menu')->where('url', $url)->find();
      if($row && !empty($row)){
         $position[]=$row;
         session('positionlinkurl', $url);
      }else{
        return false;
      }
      $pid=$row['pid'];
      if($pid>0){
        $rows=\think\Db::name('menu')->where('id', $pid)->find();
        while($rows && !empty($rows)){
          $position[]=$rows;
          $pids=$rows['pid'];
          if($pids>0){
            $rows=\think\Db::name('menu')->where('id', $pids)->find();
          }else{
            break;
          }
        }
      }
      return array_reverse($position);
    }else{ //前台面包屑导航

      return  "面包屑导航";
    }
}
