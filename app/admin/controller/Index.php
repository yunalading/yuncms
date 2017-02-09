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

use app\common\controller\AdminBaseController;
use think\Request;
use think\Validate;

class Index extends AdminBaseController {
    public function index() {
        return view();
    }
    public function test(){
      return 'Hello world!';
    }
    /**
     * 检测当前用户是否为管理员
     * @author [chenqianhao] <68527761@qq.com>
     */
    public function login(){
      //获取系统配置
      $config = $this->getconfigall();
      $input=Request::instance()->post();
      if($input){
          $user_name=trim($input['username']);
          $rules = [
              'username'  => 'require|max:25|token',
              'passwd' => 'require|min:6',
              'captcha'=>'require|captcha',
          ];
          $msg = [
              'username.require' => '用户名必须填写',
              'username.max'     => '用户名最多不能超过25个字符',
              'passwd.require' => '登录密码必须填写',
              'passwd.alphaDash' => '密码最少6位',
              'captcha.require' => '验证码必须填写',
              'captcha.captcha' => '验证码输入错误',
          ];
          $validate = new Validate($rules,$msg);
          $result   = $validate->check($input);
          if(!$result){
              //echo $validate->getError();
              session('islogin', 0);
              $errors['msg']=$validate->getError();
              $errors['code']=1;
              //$error=json_encode($errors);
              $this->assign('errors',$errors);
              return $this->fetch();
          }
          $admin_id=Db::name('admin_user')->where('user_name',$user_name)->value('admin_id');//设置了前缀用name,table方法需要带上前缀
          if($admin_id<1){
              session('islogin', 0);
              $errors['msg']="您输入的用户不存在！";
              $errors['code']=2;
              $this->assign('errors',$errors);
              return $this->fetch();
          }
          //$admin_user=Db::table('ghq_admin_user')->where('admin_id',1)->find();
          $admin_user=db('admin_user',[],false)->where('admin_id',$admin_id)->find();//助手函数需加入第三个参数才和Db::table或Db::name一样是单例模式，否则每次都要连接一下数据库
          //验证用户密码是否输入正确
          $md_password=md5($input['passwd'].$admin_user['ec_salt']);
          if($md_password != $admin_user['password']){
              session('islogin', 0);
              $errors['msg']="您输入的密码不正确！";
              $errors['code']=3;
              $this->assign('errors',$errors);
              return $this->fetch();
          }
          session('islogin', 1);
          session('user_name', $user_name);
          session('admin_id', $admin_id);
          session('user_auth.uid', $admin_id);//权限验证使用
          return $this->redirect('Index/index');
      }

      //\think\Cache::clear(); //清空缓存
      $this->view->engine->layout(false);
      return $this->fetch();
    }
}
