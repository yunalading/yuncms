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
use think\Request;
use think\Validate;
use app\common\controller\AdminBaseController;
use app\admin\model\MenuModel;

class Menu extends AdminBaseController {
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
    $menus = new MenuModel();
    $where['status']=0;
    $where['type']='admin';
    $menulist = $menus->tree($where);
    $this->assign('menulist',$menulist);
    return $this->fetch();
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
     $param['addtime']=time();
     $param['tip']=isset($param['tip'])?trim($param['tip']):'';
     $param['icon']=isset($param['icon'])?trim($param['icon']):'';
     $where['id']=$param['id'];
     unset($param["id"]);
     $menus= new MenuModel();
     $update=$menus->autoupdate($param,$where);
     return $this->success('修改菜单数据成功','index');
  }
  /**
   * get
   * 新增菜单
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function create(){
    $menus = new MenuModel();
    //顶级菜单
    $topmenu=$menus->get_menu_shangji();
    $this->assign('topmenu',$topmenu);
    return $this->fetch();


      // $menu = new Menu();
      // $menu->data($param);
      // $menu->save();
      // return $this->redirect('index');
  }
  /**
   * post
   * 保存新增菜单数据
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function save($id=0){
      $param = Request::instance()->param(false);
      $param['addtime']=time();
      $param['tip']=isset($param['tip'])?trim($param['tip']):'';
      $param['icon']=isset($param['icon'])?trim($param['icon']):'';
      $menus = new MenuModel();
      $insertid=$menus->autoinsert($param);
      if($insertid>0){
        return $this->success('新增菜单成功','index');
      }else{
        return $this->error('新增菜单失败','index');
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
      }else{
        $info['info']="修改排序失败！";
        $info['status']=0;
      }
      return json($info);
  }

}
