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
use think\Cache;
use app\common\controller\AdminBaseController;
use app\admin\model\AdminLogModel;
class AdminLog extends AdminBaseController {
  /**
   * 管理员日志列表
   * get
   * @author [chenqianhao] <68527761@qq.com>
  */
  public function index(){
    $request = request();
    $param=$request->param();
    if(isset($param['keyword']) && trim($param['keyword'])!=''){
      $keyword=trim($param['keyword']);
      $where['log_remark']= array('like','%'.$keyword.'%');
    }
    $adminlog = new AdminLogModel();
    // print_r($adminlog);exit;
    $where['log_del']=0;
    $where['log_type']=0;
    $adminlogs = $adminlog->getAll($where,'*',10);
    $data=$adminlogs->toArray();
    $data['lastpage']=$adminlogs->lastPage();
    $adminuser=new \app\admin\model\AdminUserModel();
    foreach($data['data'] as &$v){
      $v['aname'] = $adminuser->getOne('aname',array('aid'=>$v['log_aid']),'admin_user');
    }
    $this->assign('adminlog',$data);
    return $this->fetch();
  }
  /**
   * delete
   * 删除日志
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


}
