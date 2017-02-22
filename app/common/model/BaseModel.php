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


namespace app\common\model;

use think\Model;
use think\Db;
// use think\Config;
class BaseModel extends Model {
  /**
   * 获取当前表名
   * @param $table [string] 条件
   * @return string 表名
   * @author [chenqianhao] <68527761@qq.com>
   */
  public function gettable($table='')
  {
      if($table != ''){
        return $table;
      }
      if(isset($this->table) && trim($this->table)!=''){
        return strtolower(trim($this->table));
      }
      $request = \think\Request::instance();
      $controller = strtolower($request->controller());
      //AdminUser对应'admin_user'表
      if(isset($controller) && $controller !=''){
        $controllers=strtolower(substr($controller,0,1)).substr($controller,1);
        return strtolower(preg_replace('/([A-Z])/', '_$1', $controllers));
      }
      //该表不存在
      return '';
  }
  /**
   * 根据条件获取指定的一个值
   * @param $where [array] 条件
   * @param $field 查查询的字段
   * @return string
   * @author [chenqianhao] <68527761@qq.com>
   */
  public function getOne($field,$where=array(),$table='')
  {
      $table=$this->gettable($table);
      if(empty($where)){
        $value=Db::name($table)->value($field);
      }else{
        $value=Db::name($table)->where($where)->value($field);
      }
      return $value;
  }
  /**
   * 根据条件获取指定的一组数据
   * @param $where [array] 条件
   * @param $field [string] 查询的字段
   * @return array|null
   * @author [chenqianhao] <68527761@qq.com>
   */
  public function getRow($where,$field='*',$table='')
  {
      //$admin_user=Db::table('yc_admin_user')->where($where)->find();
      //助手函数需加入第三个参数才和Db::table或Db::name一样是单例模式，否则每次都要连接一下数据库
      //$row = db($this->tableName,[],false)->field($field)->where($where)->find();
      //return $row;
      $table=$this->gettable($table);
      return  Db::name($table)->field($field)->where($where)->find();

  }
  /**
   * 根据条件获更新数据数据
   * @param $data 要更新的字段和值组成的二元数组
   * @param $where [array] 条件
   * @return int 影响的条数
   * @author [chenqianhao] <68527761@qq.com>
   */
  public function autoupdate($data,$where,$table='')
  {
     $table=$this->gettable($table);
     $update=Db::name($table)->where($where)->update($data);
     return $update;
  }

  /**
   * 根据条件获取指定的所有数据
   * @param $where [array] 条件
   * @return array|null
   * @author [chenqianhao] <68527761@qq.com>
   */
  public function getAll($where=array(),$field='*',$table='')
  {
    $table=$this->gettable($table);
    if(empty($where)){
      $info = Db::name($table)->field($field)->select();
    }else{
      $info = Db::name($table)->field($field)->where($where)->select();
    }
    return $info;
  }

  /**
   * 根据条件获取指定的所有数据
   * @param $data [array] 要插入的数据数组
   * @return int 插入的主键id
   * @author [chenqianhao] <68527761@qq.com>
   */
  public function autoinsert($data,$table='')
  {
    $table=$this->gettable($table);
    Db::name($table)->insert($data);
    $id = Db::name($table)->getLastInsID();
    return $id;
  }
}
