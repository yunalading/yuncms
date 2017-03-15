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
use app\admin\validate\UserValidate;
use app\admin\model\UserModel;
use think\Log;


/**
 * Class Dashboard
 * @package app\admin\controller
 */
class Dashboard extends AdminBaseController {
    /**
     * @return \think\response\View
     */
    public function index() {
        $userModel = new UserModel();
        $param = $this->request->param();
        Log::debug('后台用户登录');
        //验证数据
        $user_data = array_filter($param);
        $userValidate = new  UserValidate();
        if (!$userValidate->check($user_data, [], 'index')) {
            $this->error($userValidate->getError());
        }
        dump($param);
        $user_id = $userModel->where('username',$param['username'])->value('user_id');
        if($user_id<1){
            session('islogin', 0);
            return $this->error("您输入的用户不存在！");
        }
        $admin_user = $userModel->get($user_id);
        dump($admin_user);
        die();

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
        session('username', $user_name);
        session('user_id', $admin_id);





        $this->assign('menus',json_encode(config('authorization')));
        return view();
    }

}
