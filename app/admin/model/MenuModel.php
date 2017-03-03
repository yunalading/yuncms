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
// use think\Db;
use think\Config;
class MenuModel extends BaseModel
{
    // protected $table='menu';
    protected $name='menu';
    /**
     * 获取菜单树
     * @param $where [array] 条件
     * @return array|null
     * @author [chenqianhao] <68527761@qq.com>
     */
    public function tree($where)
    {
        // $menus = Db::name($this->table)->order('sort','asc')->where($where)->select();
        // return $this->getTree($menus,'title','id','pid');

        $table=$this->gettable();
        // $menus = Db::name($table)->order('sort','asc')->where($where)->select();
        $menus = $this->order('sort','asc')->where($where)->select();
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

    /**
     * 过滤要操作的数据，返回操作的数组
     * @param $request [array] 请求过来的参数
     * @return array|null
     * @author [chenqianhao] <68527761@qq.com>
     */
     function getparaminfo($request){
       $info=array();
       $param=$request->param();
       $url=geturlbase();
       if(isset($param['id']) && $param['id']=='select'){//多选
         if(isset($param['ids']) && $param['ids']!=''){
           $info['info']=explode(',',$param['ids']);
           $info['status']=1;
          //  $info['hide']=intval($param['hide']);
           $info['url']=$url;
           return $info;
         }else{
            $info['info']='请选择要操作的数据！';
            $info['status']=0;
            $info['url']=$url;
            return $info;
         }
       }else{//单选中
         $ids=intval($param['id']);
         $info['info'][0]=$ids;
         $info['status']=1;
        //  $info['hide']=intval($param['hide']);
         $info['url']=$url;
         return $info;
       }
     }

     /**
      * 获取所有一级菜单
      * @return array|null
      * @author [chenqianhao] <68527761@qq.com>
      */
      function get_menu_shangji(){
        $where['pid']=0;
        $where['status']=0;
        $where['type']='admin';
        $field=['id','title','group'];
        $data=$this->getAll($where,$field);
        return $data;
      }
}
