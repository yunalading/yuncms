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
// use think\Db;
// use think\Config;


/**
 * Class BaseModel
 * @package app\common\model
 */
class BaseModel extends Model{
  /**
   * 获取当前表名
   * @param $table [string] 条件
   * @return string 表名
   * @author [chenqianhao] <68527761@qq.com>
   */
  public function getTable($table='')
  {
      if($table != ''){
        $this->name=$table;
        return $this->name;
      }
      // if(isset($this->table) && trim($this->table)!=''){
      //   return strtolower(trim($this->table));
      // }
      if(isset($this->name) && trim($this->name)!=''){
        $this->name=strtolower(trim($this->name));
        return $this->name;
      }
      $request = \think\Request::instance();
      $controller = strtolower($request->controller());
      //AdminUser对应'admin_user'表
      if(isset($controller) && $controller !=''){
        $controllers=strtolower(substr($controller,0,1)).substr($controller,1);
        $this->name=strtolower(preg_replace('/([A-Z])/', '_$1', $controllers));
        return $this->name;
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
      $table=$this->getTable($table);
      if(empty($where)){
        // $value=Db::name($table)->value($field);
        $value=$this->value($field);
      }else{
        // $value=Db::name($table)->where($where)->value($field);
        $value=$this->where($where)->value($field);
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
  public function getRow($where=array(),$field='*',$table='')
  {
      //$admin_user=Db::table('yc_admin_user')->where($where)->find();
      //助手函数需加入第三个参数才和Db::table或Db::name一样是单例模式，否则每次都要连接一下数据库
      //$row = db($this->tableName,[],false)->field($field)->where($where)->find();
      //return $row;
      $table=$this->getTable($table);
      // return  Db::name($table)->field($field)->where($where)->find();
      return  $this->field($field)->where($where)->find();
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
     $table=$this->getTable($table);
     //  $update=Db::name($table)->where($where)->update($data);
     $update=$this->where($where)->update($data);
     return $update;
  }

  /**
   * 根据条件获取指定的所有数据
   * @param $where [array] 条件
   * @param $field [string] 查询字段，默认全部字段
   * @param $paginate [string] 分页时每页显示的条数(默认0不分页)
   * @param $table [string] 查询的表名
   * @return array|null
   * @author [chenqianhao] <68527761@qq.com>
   */
  public function getAll($where=array(),$field='*',$paginate=0,$table='')
  {
    $table=$this->getTable($table);
    if($paginate>0){
      if(empty($where)){
        // $info = Db::name($table)->field($field)->paginate($paginate);
        $info = $this->field($field)->paginate($paginate);
      }else{
        // $info = Db::name($table)->field($field)->where($where)->paginate($paginate);
        $info = $this->field($field)->where($where)->paginate($paginate);
      }
    }else{
      if(empty($where)){
        // $info = Db::name($table)->field($field)->select();
        $info = $this->field($field)->select();
      }else{
        // $info = Db::name($table)->field($field)->where($where)->select();
        $info = $this->field($field)->where($where)->select();
      }
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
    $table=$this->getTable($table);
    // Db::name($table)->insert($data);
    $this->insert($data);
    // $id = Db::name($table)->getLastInsID();
    $id = $this->getLastInsID();
    return $id;
  }

  /**
   * 根据条件获取指定的数据的条数
   * @param $where [array] 条件
   * @return int|0
   * @author [chenqianhao] <68527761@qq.com>
   */
  public function getcount($where=array(),$table='')
  {
    $table=$this->getTable($table);
    if(empty($where)){
      // $count = Db::name($table)->count();
      $count = $this->count();
    }else{
      // $count = Db::name($table)->where($where)->count();
      $count = $this->where($where)->count();
    }
    return $count;
  }

}
