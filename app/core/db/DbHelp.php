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

class DbHelp extends \think\Db {

  /**
   *  删除数据库
   *  @author [chenqianhao] <68527761@qq.com>
   *  @param $daname 数据库名称
   *  @return bool
   */
    public static function addDb($dbname=''){
        if($dbname==''){
            return false;
        }
        $sql='create database '.$dbname.' charset utf8';
        if(Db::query($sql)){
            return true;
        }else{
            return false;
        }
    }
    /**
     *  删除数据库
     *  @author [chenqianhao] <68527761@qq.com>
     *  @param $daname 数据库名称
     *  @return bool
     */
      public static function delDb($dbname=''){
          if($dbname==''){
              return false;
          }
          $sql='drop database '.$dbname;
          if(Db::query($sql)){
              return true;
          }else{
              return false;
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
            return '';
          }
        }
}
