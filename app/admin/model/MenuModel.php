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
namespace app\admin\model;
use app\common\model\BaseModel;
use think\Db;
use think\Config;
class MenuModel extends BaseModel
{
    protected $tableName='menu';
    /**
     * 根据条件获取指定的一个值
     * @param $where [array] 条件
     * @param $field 查查询的字段
     * @return string
     * @author [chenqianhao] <68527761@qq.com>
     */
    public function getOne($field,$where=array())
    {
        if(empty($where)){
          $value=Db::name($this->tableName)->value($field);
        }else{
          $value=Db::name($this->tableName)->where($where)->value($field);
        }
        return $value;
    }
    /**
     * 根据条件获取指定的一组数据
     * @param $where [array] 条件
     * @return array|null
     * @author [chenqianhao] <68527761@qq.com>
     */
    public function getRow($where)
    {
        //$admin_user=Db::table('yc_admin_user')->where($where)->find();
        //助手函数需加入第三个参数才和Db::table或Db::name一样是单例模式，否则每次都要连接一下数据库
        $row = db('admin_user',[],false)->where($where)->find();
        return $row;
    }
    /**
     * 根据条件获更新数据数据
     * @param $data 要更新的字段和值组成的二元数组
     * @param $where [array] 条件
     * @return int 影响的条数
     * @author [chenqianhao] <68527761@qq.com>
     */
    public function autoupdate($data,$where)
    {
       $update=Db::table(Config::get('database.prefix').$this->tableName)->where($where)->update($data);
       return $update;
    }

    /**
     * 根据条件获取指定的所有数据
     * @param $where [array] 条件
     * @return array|null
     * @author [chenqianhao] <68527761@qq.com>
     */
    public function getAll($where=array())
    {
      if(empty($where)){
        $info = Db::name($this->tableName)->select();
      }else{
        $info = Db::name($this->tableName)->where($where)->select();
      }
      return $info;
    }


    /**
     * 获取菜单树
     * @param $where [array] 条件
     * @return array|null
     * @author [chenqianhao] <68527761@qq.com>
     */
    public function tree($where)
    {
        $menus = Db::name($this->tableName)->order('sort','asc')->where($where)->select();
        return $this->getTree($menus,'title','id','pid');
    }
    /**
     * 菜单树样式重新排列，目前只支持二级菜单
     * @return array|null
     * @author [chenqianhao] <68527761@qq.com>
     */
    public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0)
    {
        $arr = array();
        foreach ($data as $k=>$v){
            if($v[$field_pid]==$pid){
                $data[$k]["_".$field_name] = $data[$k][$field_name];
                $arr[] = $data[$k];
                foreach ($data as $m=>$n){
                    if($n[$field_pid] == $v[$field_id]){
                        $data[$m]["_".$field_name] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├─ '.$data[$m][$field_name];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }






}
