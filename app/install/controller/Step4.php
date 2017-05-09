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
use app\install\model\UserModel;
use app\install\validate\InstallFormValidate;
use think\Log;
use think\Cookie;
use think\Session;

/**
 * Class Complete
 * @package app\install\controller
 */
class Step4 extends InstallWizard {

    public function __construct() {
        parent::__construct();
        if (!$this->request->isPost()) {
            $this->error('无效操作！');
        }
    }

    /**
     * @return \think\response\View
     */
    public function index() {
        if (!Install::checkEnv() || !Install::checkMode()) {
            $this->error('请检查安装环境!', url('/install/step1'));
        }
        if (!Install::checkConfig(new InstallFormValidate($this->post))) {
            $this->error('数据库连接失败!');
        }
        if (Install::checkDatabaseExists()) {
            $this->error('数据库已经存在,不能进行安装!');
        }
        return view();
    }

    /**
     * 执行安装
     * @return array
     */
    public function setup() {
        $result = array();
        if (!Install::checkEnv() || !Install::checkMode()) {
            $result['code'] = -1;
            $result['message'] = '请检查安装环境!';
            return $result;
        }
        $config = Install::getConfig();
        $config['__token__'] = $this->post['__token__'];
        if (!Install::checkConfig(new InstallFormValidate($config))) {
            $result['code'] = -1;
            $result['message'] = '数据库连接失败!';
            return $result;
        }
        if (Install::checkDatabaseExists()) {
            $result['code'] = -1;
            $result['message'] = '数据库已经存在,不能进行安装!';
            return $result;
        }
        //创建数据库
        Install::createDabase();
        //创建表结构
        Install::createTables();
        //添加初始数据
        Install::initData();
        //保存配置文件
        Install::writeConfig();
        //配置管理员账号
        $userModel = UserModel::get(1);
        $userModel->save(['username' => $config['app']['username'], 'password' => $userModel->createPassWord($config['app']['password']),'create_time' => time()]);
        //演示数据
        if(session('install_mode') && session('install_mode') == 'demo'){
            Install::initDemo();
        }
        //写入安装锁
        Install::writeInstallLock();
        //返回安装成功信息
        return array('code' => 1);
    }
}
