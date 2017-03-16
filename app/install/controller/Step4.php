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
        if (!Install::checkEnv() || !Install::checkMode()) {
            return $this->redirect(url('/install/step1'));
        }

        $param = Install::checkStep3();
        $db = $param['db'];
        //验证数据库数据
        $db['__token__'] = $param['__token__'];
        $rules = [
            'hostname' => 'require|token',
            'database' => 'require',
            'username' => 'require',
            'prefix' => 'require|min:2|max:10',
        ];
        $msg = [
            'hostname.require' => '服务器主机必须填写',
            'database.require' => '创建的数据库名称必须填写',
            'username.require' => '数据库名称必须',
            'prefix.require' => '数据库前缀必须填写',
            'prefix.min' => '数据库前缀最少2个字符',
            'prefix.max' => '数据库前缀最多10个字符',
        ];
        $validate = new Validate($rules, $msg);
        if (!$validate->check($db)) {
            $this->error($validate->getError());
        }
        unset($db['__token__']);
        //验证网站数据
        $param['app']['email'] = $param['users']['email'];
        $validate = new Validate(
            [
                'site_name' => 'require',
                'email' => 'email',
            ],
            [
                'site_name.require' => '网站名称必须填写',
                'email' => '管理员邮箱格式填写错误',
            ]
        );
        if (!$validate->check($param['app'])) {
            $this->error($validate->getError());
        }
        try {
            $dbconfig = DbHelp::getDbConfig($db);
            $coon = \think\Db::connect($dbconfig);
            DbHelp::addDb($db['database'], $coon);
        } catch (\PDOException $e) {
            if (substr($e->getMessage(), 0, 39) == 'SQLSTATE[HY000] [1049] Unknown database') {
                try {
                    $dbname = $db['database'];
                    $db['database'] = 'mysql';
                    $dbconfig = DbHelp::getDbConfig($db);
                    $coon = \think\Db::connect($dbconfig);
                    DbHelp::addDb($dbname, $coon);
                } catch (\PDOException $e) {
                    $this->error("请检查数据库账号或密码是否输入有误!");
                }
            } else {
                //$this->error("请检查数据库账号或密码是否输入有误!");
                $this->error($e->getMessage());
            }
        }
        //写入数据库配置
        $dbconfig['database'] = $param['db']['database'];
        $path_config = APP_PATH . 'database.php';
        if (!is_writable($path_config)) {
            $this->error("配置文件" . $path_config . "没有写入权限!");
        }
        //writeConfig($path_config,$dbconfig);
        if (!writeConfig($path_config, $dbconfig)) {
            $this->error("配置文件" . $path_config . "写入失败!");
        }
        //写入网站配置
        $app_config = array_merge(Config::get('app'), $param['app']);
        $path_app = APP_PATH . 'extra' . DS . 'app.php';
        if (!is_writable($path_app)) {
            $this->error("配置文件" . $path_app . "没有写入权限!");
        }
        if (!writeConfig($path_app, $app_config)) {
            $this->error("配置文件" . $path_app . "写入失败!");
        }
        //写入用户信息
        $users = $param['users'];
        unset($users['con-password']);
        $users['nickname'] = "超级管理员";
        $users['password'] = md5(md5($users['password']));
        $users['create_time'] = time();
        $this->assign('users', json_encode($users));
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
