<?php
// +----------------------------------------------------------------------
// | YunCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://www.yunalading.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: jabber <2898117012@qq.com>
// +----------------------------------------------------------------------


namespace app\install\controller;

use app\core\install\Install;
use app\core\db\DbHelp;
use think\Config;
use think\Cookie;
use think\Validate;

/**
 * Class Complete
 * @package app\install\controller
 */
class Step4 extends InstallWizard {
    /**
     * @return \think\response\View
     */
    public function index() {
        if (!Install::checkEnv() || !Install::checkMode() || !Install::checkConfig()) {
            return $this->redirect(url('/install/step1'));
        }

        return view();
    }

    /**
     * 执行安装
     * @return string
     */
    public function setup() {
        $param = Install::checkStep4();
        if (!$param) {
            $res['msg'] = "请先填写网站配置信息再执行安装!";
            $res['url'] = '/install/step3';
            $res['code'] = 2;
            return $res;
        }
        $model = new InstallModel();
        $user = json_decode($param['users']);
        $user = object_array($user);//变成数组
        $user['__token__'] = $param['__token__'];
        $validate = new Validate(
            [
                'username' => 'require|min:5|token',
                'password' => 'require',
                'email' => 'email',
            ],
            [
                'userame.require' => '名称必须',
                'username.min' => '名称最少5个字符',
                'password.require' => '管理员密码必须填写',
                'email' => '邮箱格式错误',
            ]
        );
        if (!$validate->check($user)) {
            $res['code'] = 0;
            $res['msg'] = $validate->getError();
            return $res;
        }
        unset($user['__token__']);

        //导入数据库[进度条]
        $path_sql = ROOT_PATH . 'app' . DS . 'install' . DS . 'data' . DS . 'create.sql';
        if (!DbHelp::sourceSql($path_sql)) {
            $res['msg'] = "插入数据库文件" . $path_sql . "失败!";
            $res['code'] = 0;
            return $res;
        }

        //初始化数据
        $path_sql = ROOT_PATH . 'app' . DS . 'install' . DS . 'data' . DS . 'init.sql';
        DbHelp::sourceSql($path_sql);

        $install_mode = Cookie::has('install-mode') ? Cookie::get('install-mode') : 'default';
        //演示数据
        if ($install_mode == 'demo') {
            $path_sql = ROOT_PATH . 'app' . DS . 'install' . DS . 'data' . DS . 'data.sql';
            DbHelp::sourceSql($path_sql);
        }

        //插入用户数据
        $model->insert($user);
        Install::writeInstallLock();
        $res['msg'] = "安装数据成功!";
        $res['code'] = 1;
        return $res;
        //return json_encode([]);
    }
}
