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
   * 规则列表
   * get
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function index(){
    $request = request();
    $param=$request->param();
    if(isset($param['keyword']) && trim($param['keyword'])!=''){
      $keyword=trim($param['keyword']);
      $where['name']= array('like','%'.$keyword.'%');
    }
    $model = new AuthRuleModel();
    $where['status']=1;
    $datas = $model->getAll($where,'*',10);
    $datalist=$datas->toArray();
    $datalist['lastpage']=$datas->lastPage();
    $this->assign('datalist',$datalist);
    return $this->fetch();
  }

  /**
   * get
   * 新增权限规则
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function create(){
    $model = new \app\admin\model\MenuModel();
    //所属菜单
    $topmenu=$model->get_menu_shangji();
    $this->assign('topmenu',$topmenu);
    return $this->fetch();
  }

  /**
   * post
   * 保存新增规则数据
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function save($id=0){
      $param = Request::instance()->param(false);
      $param['addtime']=time();
      $param['condition']=isset($param['condition'])?trim($param['condition']):'';
      $param['group']=isset($param['group'])?trim($param['group']):'';
      $param['name']=isset($param['name'])?trim($param['name']):'';
      $param['title']=isset($param['title'])?trim($param['title']):'';
      $param['sort']=isset($param['sort'])?intval($param['sort']):100;
      $param['type']=isset($param['type'])?intval($param['type']):1;
      if($param['title']==''){
        return $this->error('新增规则失败,必须填写规则名称','index');
      }
      if($param['group']==''){
        return $this->error('新增规则失败,必须填写规则所属菜单组','index');
      }
      $model = new AuthRuleModel();
      //url必须是唯一的
      if($param['name']!=''){
        $where['name']=$param['name'];
        $where['status']=1;
        $count=$model->getcount($where);
        if($count>0){
          return $this->error('该规则已经存在无法重复添加！','index');
        }
      }
      $insertid=$model->autoinsert($param);
      if($insertid>0){
        $log['log_desc']="新增规则";
        $log['log_remark']="管理员".session('aname').$log['log_desc']."'". $param['title']."'".'('.$param['name'].")成功![".geturlbase()."]";
        $this->inserlog($log);
        return $this->success('新增规则成功','index');
      }else{
        $log['log_desc']="新增菜单";
        $log['log_remark']="管理员".session('aname').$log['log_desc'].$param['title'].'('.$param['name'].")失败![".geturlbase()."]";
        $this->inserlog($log);
        return $this->error('新增规则失败','index');
      }
  }

  /**
   * get
   * 编辑规则
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function edit($id=0){
      $model = new AuthRuleModel();
      $where['id']=$id;
      $data=$model->getRow($where);
      //所属菜单
      $menus = new \app\admin\model\MenuModel();
      $topmenu=$menus->get_menu_shangji();
      $this->assign('data',$data);
      $this->assign('topmenu',$topmenu);
      return $this->fetch();
  }

  /**
   * put
   * 编辑保存规则
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function update($id=0){
     $param = Request::instance()->param(false);
     $param['addtime']=time();
     $param['condition']=isset($param['condition'])?trim($param['condition']):'';
     $param['group']=isset($param['group'])?trim($param['group']):'';
     $param['name']=isset($param['name'])?trim($param['name']):'';
     $param['title']=isset($param['title'])?trim($param['title']):'';
     $param['sort']=isset($param['sort'])?intval($param['sort']):100;
     $param['type']=isset($param['type'])?intval($param['type']):1;
     $model = new AuthRuleModel();
     if($param['name']!=''){
       $where['name']=$param['name'];
       $where['status']=1;
       $where['id']=array('neq',$param['id']);
       $count=$model->getcount($where);
       if($count>0){
         return $this->error('该规则'.$param['name'].'已经存在无法重复添加！','index');
       }
     }
     $wheres['id']=$param['id'];
     $update=$model->autoupdate($param,$wheres);
     $log['log_desc']="编辑规则";
     $log['log_remark']="管理员".session('aname').$log['log_desc'].$param['title'].'('.geturlbase().")成功!";
     $this->inserlog($log);
     return $this->success('修改规则数据成功','index');
  }


  /**
   * delete
   * 删除规则
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function delete($id=0){
    $request = Request::instance();
    $model = new AuthRuleModel();
    //有子菜单的菜单不能删除[后期完善]
    $data=$model->getparaminfo($request);
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
