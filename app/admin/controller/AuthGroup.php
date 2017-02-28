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
namespace app\admin\controller;
use think\Validate;
use think\Request;
use app\common\controller\AdminBaseController;
use app\admin\model\AuthRuleModel;

class AuthRule extends AdminBaseController {
  /**
   * 菜单列表
   * get
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function index(){
    $request = request();
    $param=$request->param();
    if(isset($param['keyword']) && trim($param['keyword'])!=''){
      $keyword=trim($param['keyword']);
      $where['title']= array('like','%'.$keyword.'%');
    }
    $AuthGroup = new AuthGroupModel();
    // $where['status']=1;
    $where['type']=1;
    $AuthGroups = $AuthGroup->getAll($where,'*',10);
    $data=$AuthGroups->toArray();
    $data['lastpage']=$AuthGroups->lastPage();
    $this->assign('authGroup',$data);
    return $this->fetch();
  }
  /**
   * get
   * 新增用户组
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function create(){
    // $menus = new MenuModel();
    // //顶级菜单
    // $topmenu=$menus->get_menu_shangji();
    // $this->assign('topmenu',$topmenu);
    return $this->fetch();
  }

  /**
   * post
   * 保存新增菜单数据
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function save($id=0){
      $param = Request::instance()->param(false);
      $param['addtime']=time();
      $param['description']=isset($param['description'])?trim($param['description']):'';
      if($param['description']!=''){
        $param['description']=str_replace("\r\n","<br />",$param['description']);
        $param['description']=htmlspecialchars_decode($param['description']);
      }
      $param['status']=isset($param['status'])?intval($param['status']):'';
      $param['rules']=isset($param['rules'])?trim($param['rules']):'';
      $param['title']=isset($param['title'])?trim($param['title']):'';
      if($param['title']==''){
        return $this->error('新增用户组失败,必须填写用户组名称','index');
      }
      $authGroup = new AuthGroupModel();
      //用户组名必须是唯一的
      $where['title']=$param['title'];
      $where['status']=1;
      $count=$authGroup->getcount($where);
      if($count>0){
        return $this->error('该用户组已经存在无法重复添加！','index');
      }
      $insertid=$authGroup->autoinsert($param);
      if($insertid>0){
        $log['log_desc']="新增用户组";
        $log['log_remark']="管理员".session('aname').$log['log_desc'].  $param['title']."成功!";
        $this->inserlog($log);
        return $this->success('新增用户组成功','index');
      }else{
        $log['log_desc']="新增菜单";
        $log['log_remark']="管理员".session('aname').$log['log_desc'].$param['title']."失败!";
        $this->inserlog($log);
        return $this->error('新增用户组失败','index');
      }
  }

  /**
   * delete
   * 删除菜单
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function delete($id=0){
    $request = Request::instance();
    $menus = new MenuModel();
    //有子菜单的菜单不能删除[后期完善]
    $data=$menus->getparaminfo($request);
    $data['statuss']=intval($request->param()['status']);
    if($data['status']==0){
      return json($data);
    }else{
      foreach($data['info'] as $v){
        $datas['status']=$data['statuss'];
        $where['id']=$v;
        $menus->autoupdate($datas,$where);
      }
      $data['info']='删除菜单成功!';
      $log['log_desc']="删除菜单";
      $log['log_remark']="管理员".session('aname').$log['log_desc'].geturlbase()."成功!";
      $this->inserlog($log);
      return json($data);
    }
  }

  /**
   * get
   * 编辑菜单
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function edit($id=0){
      $menus = new MenuModel();
      $where['id']=$id;
      $menus_one=$menus->getRow($where);
      //顶级菜单
      $topmenu=$menus->get_menu_shangji();
      $this->assign('menus_one',$menus_one);
      $this->assign('topmenu',$topmenu);
      return $this->fetch();
  }
  /**
   * put
   * 编辑菜单
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function update($id=0){
     $param = Request::instance()->param(false);
     $menus= new MenuModel();
     $param['addtime']=time();
     $param['tip']=isset($param['tip'])?trim($param['tip']):'';
     $param['icon']=isset($param['icon'])?trim($param['icon']):'';
     $param['url']=isset($param['url'])?trim($param['url']):'';
     $param['title']=isset($param['title'])?trim($param['title']):'';
     $param['id']=isset($param['id'])?intval($param['id']):0;
     if($param['url']!=''){
       $where['url']=$param['url'];
       $where['status']=0;
       $where['id']=array('neq',$param['id']);
       $count=$menus->getcount($where);
       if($count>0){
         return $this->error('该菜单已经存在无法重复添加！','index');
       }
     }
     $where['id']=$param['id'];
     unset($param["id"]);
     $update=$menus->autoupdate($param,$where);
     $log['log_desc']="编辑菜单";
     $log['log_remark']="管理员".session('aname').$log['log_desc'].$param['title'].'('.geturlbase().")成功!";
     $this->inserlog($log);
     return $this->success('修改菜单数据成功','index');
  }


  //get
  public function read($id=0){

  }
  /**
   * 菜单显示隐藏
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function changehide()
  {
      $request = Request::instance();
      $menus = new MenuModel();
      $data=$menus->getparaminfo($request);
      $data['hide']=intval($request->param()['hide']);
      if($data['status']==0){
        return json($data);
      }else{
        foreach($data['info'] as $v){
          $datas['hide']=$data['hide'];
          $where['id']=$v;
          $menus->autoupdate($datas,$where);
        }
        $data['info']='修改成功!';
        $log['log_desc']="修改菜单显示隐藏";
        $zhauntgai=$data['hide']>0?'隐藏':'显示';
        $log['log_remark']="管理员".session('aname')."修改菜单".geturlbase().$zhuantai."状态成功!";
        $this->inserlog($log);
        return json($data);
      }
      //return json(["info"=>"test","status"=>0,"url"=>"admin/index/index"]);
  }

  /**
   * 修改菜单排序
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function changeorder()
  {
      $request = Request::instance();
      $data=$request->param();
      $menus = new MenuModel();
      $datas['sort']=intval($data['sort']);
      $where['id']=intval($data['id']);
      $update=$menus->autoupdate($datas,$where);
      if($update>0){
        $info['info']="修改排序成功！";
        $info['status']=1;
        $log['log_desc']="修改菜单排序";
        $log['log_remark']="管理员".session('aname')."修改菜单".geturlbase()."排序成功!";
        $this->inserlog($log);
      }else{
        $info['info']="修改排序失败！";
        $info['status']=0;
        $log['log_desc']="修改菜单排序";
        $log['log_remark']="管理员".session('aname')."修改菜单".geturlbase()."排序失败!";
        $this->inserlog($log);
      }
      return json($info);
  }

}