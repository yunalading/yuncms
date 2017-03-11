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


namespace app\core\db;
use think\Db;
use think\Config;

class DbHelp extends \think\Db {

    /**
     *  获取数据库配置
     *  @author [chenqianhao] <68527761@qq.com>
     *  @param $db 数据库其它配置文件
     *  @return bool
     */
    public static function getDbConfig($db=array()){
        $database = Config::get('database');
        $dbconfig = array_merge($database,$db);
        return $dbconfig;
    }

  /**
   *  创建数据库
   *  @author [chenqianhao] <68527761@qq.com>
   *  @param $daname 数据库名称
   *  @param $coon 数据库连接句柄
   *  @return bool
   */
    public static function addDb($dbname='',$coon=''){
        try{
            self::delDb($dbname,$coon);
        }catch(\Exception $e){
           //数据库不存在无需操作
        }
        if($dbname==''){
            return false;
        }
        $sql='CREATE DATABASE IF NOT EXISTS '.$dbname.' charset utf8';
        if($coon != ''){
            if($coon->execute($sql)){
                return true;
            }else {
                return false;
            }
        }else{
            if(Db::execute($sql)){
                return true;
            }else{
                return false;
            }
        }
    }
    /**
     *  删除数据库
     *  @author [chenqianhao] <68527761@qq.com>
     *  @param $daname 数据库名称
     *  @return bool
     */
      public static function delDb($dbname='',$coon=''){
          if($dbname==''){
              return false;
          }
          $sql='drop database '.$dbname;
          if($coon == ''){
              if(Db::execute($sql)){
                  return true;
              }else{
                  return false;
              }
          }else{
              if($coon->execute($sql)){
                  return true;
              }else{
                  return false;
              }
          }

      }
      /**
       *  查询数据库版本
       *  @author [chenqianhao] <68527761@qq.com>
       *  @return string
       */
        public static function showVersion(){
          $sql="select version() as version";
          $a=Db::query($sql);
          if($a){
            return $a[0]['version'];
          }else{
            return 'unknown';
          }
        }

    /**
     *  导入sql到数据库
     *  @author [chenqianhao] <68527761@qq.com>
     *  @return bool
     */
    public static function sourceSql($path_sql){
//        $sql="source ".$path_sql;
//        $a = Db::execute($sql);
//        if($a){
//            return true;
//        }else{
//            return fale;
//        }
          $_sql = file_get_contents($path_sql);
          $_arr = explode(';', $_sql);
          foreach ($_arr as $_value) {
              if(trim($_value) !='' ){
                  Db::query($_value.';');
              }
          }
    }


//        /**
//         *  判断某数据库是否存在
//         *  @author [chenqianhao] <68527761@qq.com>
//         *  @param $daname 数据库名称
//         *  @param $coon 数据库连接句柄
//         *  @return bool
//         */
//        public static function hasDb($dbname='',$coon=''){
//            if($dbname==''){
//                return false;
//            }
//            $sql='SELECT count(1) FROM information_schema.SCHEMATA where SCHEMA_NAME='.$dbname;
//            if($coon == ''){
//                return Db::query($sql);
//                if(Db::query($sql)){
//                    return true;
//                }else{
//                    return false;
//                }
//            }else{
//                return $coon->query($sql);
//                if($coon->query($sql)){
//                    return true;
//                }else{
//                    return false;
//                }
//            }
//
//        }


}
