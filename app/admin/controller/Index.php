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
use app\admin\model\AdminUserModel;

class Index extends AdminBaseController {
    public function index() {
        return view();
    }
    public function test(){
      return 'Hello world!';
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
          $aid=Db::name('admin_user')->where('aname',$aname)->value('aid');//设置了前缀用name,table方法需要带上前缀
          if($aid<1){
              session('islogin', 0);
              $errors['msg']="您输入的用户不存在！";
              $errors['code']=2;
              $this->assign('errors',$errors);
              return $this->fetch();
          }
          //$admin_user=Db::table('ghq_admin_user')->where('aid',1)->find();
          //助手函数需加入第三个参数才和Db::table或Db::name一样是单例模式，否则每次都要连接一下数据库
          $admin_user=db('admin_user',[],false)->where('aid',$aid)->find();
          //验证用户密码是否输入正确
          $md_password=md5($input['password'].$admin_user['salt']);
          if($md_password != $admin_user['password']){
              session('islogin', 0);
              $errors['msg']="您输入的密码不正确！";
              $errors['code']=3;
              $this->assign('errors',$errors);
              return $this->fetch();
          }
          session('islogin', 1);
          session('aname', $aname);
          session('aid', $aid);
          session('user_auth.uid', $aid);//权限验证使用
          //更新最后登陆时间和ip
          return $this->redirect('Index/index');
      }
      //\think\Cache::clear(); //清空缓存
      $this->view->engine->layout(false);
      return $this->fetch();
    }
}
