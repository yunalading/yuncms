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
      $where['']=;
    }
    $menus = new MenuModel();
    $where['status']=0;
    $where['type']='admin';
    $menulist = $menus->tree($where);
    $this->assign('menulist',$menulist);
    return $this->fetch();
  }


  //get
  public function read($id){
    $menus = new Menu();
    $menu = $menus->tree();
    //print_r($menu);
    //die();
    //$m = $menu[0];
    //print_r($m->toArray());exit;
    // $nav=getAll($menu);
    // print_r($nav);
    // die();
    //获取前后台所有一级菜单
    //$menus_one = $menus->order('sort','asc')->where('pid','0')->select();
    $menus_one=$this->get_menu_shangji();
    $this->assign('menus_one',$menus_one);
    $this->assign('menu',$menu);
    return $this->fetch();
  }
  //get
  public function create(){
      $request = Request::instance()->param(false);
      $request['addtime']=time();
      $request['tip']=isset($request['tip'])?trim($request['tip']):'';
      //图标被过滤了如何处理？
/*        echo '<pre>';
      print_r($request);
      echo '</pre>';
      die();*/
      $menu = new Menu();
      $menu->data($request);
      $menu->save();
      return $this->redirect('index');
  }
  //post
  public function save($id){
  }
  //get
  public function edit($id=0){
      if($id && $id>0){
          $row=Menu::where('id',$id)->find();
          $menus_one=$this->get_menu_shangji();
          $data = [
              'status' => 1,
              'msg' => '获取当前菜单信息成功！',
              'row' => $row,
              'menus_one' => $menus_one,
          ];
          return $data;
      }
      $request = Request::instance()->get();
      $ids=$request['ids'];
      unset($request['ids']);
      //print_r($request);
      $res=Menu::where('id',$ids)->update($request);
      if($res){
          $data = [
              'status' => 2,
              'id' => $ids,
              'msg' => '编辑菜单成功！',
          ];
      }else{
          $data = [
              'status' => 0,
              'msg' => '编辑菜单失败，请稍后重试！',
          ];
      }
      return $this->redirect('index');
  }
  //put
  public function update($id){
  }
  //delete
  public function delete($id=0){
      $request = Request::instance()->param();
      //有子菜单的菜单不能删除
      $child_count = Menu::where('pid',$request['id'])->count();
      if($child_count>0){
          $data = [
              'status' => 0,
              'msg' => '请先删除下级菜单！',
          ];
          return $data;
      }
      //$re = Menu::where('id',$request['id'])->delete();
      //Menu::where('pid',$request['id'])->update(['pid'=>0]);//更新下级菜单为一级菜单
      $res=Menu::where('id',$request['id'])->update(['status'=>1]);
      if($res>0){
          $data = [
              'status' => 0,
              'msg' => '菜单删除成功！',
              'ids' => $res,
          ];
      }else{
          $data = [
              'status' => 1,
              'msg' => '菜单删除失败，请稍后重试！',
          ];
      }
      return $data;
  }
  public function changeOrder()
  {
      $request = Request::instance()->post();
      $menu= Menu::find($request['id']);
      $menu->sort = $request['sort'];
      $re = $menu->save();
      if($re){
          $data = [
              'status' => 1,
              'msg' => '菜单排序更新成功！',
          ];
      }else{
          $data = [
              'status' => 0,
              'msg' => '菜单排序更新失败，请稍后重试！',
          ];
      }
      return json(['data'=>$data]);
  }
  public function changehide()
  {
      $request = Request::instance()->post();
      $menu= Menu::find($request['id']);
      $menu->hide = $request['hide'];
      $re = $menu->save();
      if($re){
          $data = [
              'status' => 1,
              'id' => $request['id'],
              'hide' => $request['hide'],
              'msg' => '修改显示菜单成功！',
          ];
      }else{
          $data = [
              'status' => 0,
              'msg' => '修改显示菜单失败，请稍后重试！',
          ];
      }
      return json(['data'=>$data]);
  }
  private function get_menu_shangji(){
      return Menu::order('sort','asc')->where('pid','0')->select();
/*        $menu = new Menu();
      return $menu->order('sort','asc')->where('pid','0')->select();*/
  }



















}
