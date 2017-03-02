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
use think\Cache;
use app\common\controller\AdminBaseController;
use app\admin\model\AdminUserModel;

/**
 * Class Index 默认控制器
 * @package app\admin\controller
 */
class Index extends AdminBaseController {
  /**
   * 欢迎页面
   * @author [chenqianhao] <68527761@qq.com>
  */
    public function index() {
        //查询数据库的版本
        //$mysqlversion=getmysqlversion();
        $mysqlversion=\app\core\db\DbHelp::ShowVersion();
        if(!$mysqlversion || $mysqlversion==''){
          $mysqlversion='unknow';
        }
        $this->assign('mysqlversion',$mysqlversion);
        return view();
    }
    /**
     * 用户登录
     * @author [chenqianhao] <68527761@qq.com>
     */
    public function login(){
      //获取系统配置
      $config = $this->getconfigall();
      $input=Request::instance()->post();
      if($input){
          $aname=trim($input['aname']);
          if($config['captcha']==1){
            $rules = [
                'aname'  => 'require|max:25|token',
                'password' => 'require|min:6',
                'captcha'=>'require|captcha',
            ];
            $msg = [
                'aname.require' => '用户名必须填写',
                'aname.max'     => '用户名最多不能超过25个字符',
                'password.require' => '登录密码必须填写',
                'password.alphaDash' => '密码最少6位',
                'captcha.require' => '验证码必须填写',
                'captcha.captcha' => '验证码输入错误',
            ];
          }else{
            $rules = [
                'aname'  => 'require|max:25|token',
                'password' => 'require|min:6',
            ];
            $msg = [
                'aname.require' => '用户名必须填写',
                'aname.max'     => '用户名最多不能超过25个字符',
                'password.require' => '登录密码必须填写',
                'password.alphaDash' => '密码最少6位',
            ];
          }

          $validate = new Validate($rules,$msg);
          $result   = $validate->check($input);
          if(!$result){
              //echo $validate->getError();
              session('islogin', 0);
              $errors['msg']=$validate->getError();
              $errors['code']=1;
              //$error=json_encode($errors);
              // $this->assign('errors',$errors);
              // return $this->fetch();
              return $this->error($errors['msg']);
          }
          $adminusermodel = new AdminUserModel();
          $where['aname']=$aname;
          $field="aid";
          $aid=$adminusermodel->getOne($field,$where,'admin_user');
          if($aid<1){
              session('islogin', 0);
              $errors['msg']="您输入的用户不存在！";
              $errors['code']=2;
              return $this->error($errors['msg']);
              // $this->assign('errors',$errors);
              // return $this->fetch();
          }
          $wheres['aid']=$aid;
          $admin_user=$adminusermodel->getRow($wheres,'*','admin_user');
          //验证用户密码是否输入正确
          $md_password=md5($input['password'].$admin_user['salt']);
          if($md_password != $admin_user['password']){
              session('islogin', 0);
              $errors['msg']="您输入的密码不正确！";
              $errors['code']=3;
              return $this->error($errors['msg']);
              // $this->assign('errors',$errors);
              // return $this->fetch();
          }
          session('islogin', 1);
          session('aname', $aname);
          session('aid', $aid);
          //更新最后登陆时间和ip
          $data['lasttime']=time();
          $data['lastip']=request()->ip();
          $adminusermodel->autoupdate($data,$wheres,'admin_user');
          return $this->redirect('Index/index');
      }
      //$this->view->engine->layout(false);
      return $this->fetch();
    }
    /**
     * 删除缓存
     * @author 【chenqianhao】<68527761@qq.com>
     */
    public function removeRuntime()
    {
        $result = \think\Cache::clear(); //清空缓存
        if ($result) {
            echo "缓存清理成功";
        } else {
            echo "缓存清理失败";
        }
    }

    /**
     * 退出登录
     * @author [chenqianhao] <68527761@qq.com>
     */
    public function logout() {
        session(null);
        //$this->redirect('/');
        return $this->redirect('admin/index/login');
    }

    // public function AddDbOne(){
    //     $help=new \app\core\db\DbHelp();
    //     $a=$help->AddDb('lctest');
    //     print_r($a);
    //     die();
    // }
    // public function DelDbOne(){
    //     $help=new \app\core\db\DbHelp();
    //     $a=$help->DelDb('lctest');
    //     print_r($a);
    //     die();
    // }
    // public function ShowDbVersion(){
    //     $help=new \app\core\db\DbHelp();
    //     $a=$help->ShowVersion();
    //     print_r($a);
    //     die();
    // }
}
