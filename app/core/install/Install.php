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

namespace app\core\install;

use app\core\db\helper\Mysql;
use app\core\check\file\FileIsWriteCheck;
use app\core\check\func\FunctionCheck;
use think\Cookie;
use think\Session;

class Install {

    /**
     * 检查是否安装
     * @return bool
     */
    public static function checkInstall() {
        return file_exists(ROOT_PATH . DS . 'public' . DS . 'data' . DS . 'install.lock');
    }

    /**
     * 写入安装锁
     */
    public static function writeInstallLock() {
        $file = new \SplFileObject(ROOT_PATH . DS . 'public' . DS . 'data' . DS . 'install.lock', 'w+');
        //写入安装时间
        $file->fwrite(time());
    }

    /**
     * 获取安装时间
     * @return int
     */
    public static function getInstallTime() {
        $file = new \SplFileObject(ROOT_PATH . DS . 'public' . DS . 'data' . DS . 'install.lock');
        return $file->getCurrentLine();
    }

    /**
     * 获取环境列表
     * @return array
     */
    public static function getEnvList() {
        $env_array = array();
        $file_array = array();
        $fun_array = array();
        /**
         * 创建环境检查列表
         */
        foreach (config('require.env') as $env) {
            $env_check = new $env['class']($env['min'], $env['good']);
            $env_array[] = $env_check;
        }
        /**
         * 创建文件检查列表
         */
        foreach (config('require.file') as $file) {
            $file_check = new FileIsWriteCheck($file['path']);
            $file_array[] = $file_check;
        }
        /**
         * 创建函数检查列表
         */
        foreach (config('require.funs') as $fun) {
            $fun_check = new FunctionCheck($fun['fun']);
            $fun_array[] = $fun_check;
        }
        return array('env' => $env_array, 'file' => $file_array, 'fun' => $fun_array);
    }

    /**
     * 检查环境
     * @return bool
     */
    public static function checkEnv() {
        $list = self::getEnvList();
        $flag = true;
        foreach ($list['env'] as $env) {
            if (!$env->comparison) {
                $flag = false;
            }
        }
        foreach ($list['file'] as $file) {
            if (!$file->comparison) {
                $flag = false;
            }
        }
        foreach ($list['fun'] as $fun) {
            if (!$fun->comparison) {
                $flag = false;
            }
        }
        return $flag;
    }

    /**
     * 获取安装方式
     * @return mixed|string
     */
    public static function getMode() {
        return Cookie::has('install-mode') ? Cookie::get('install-mode') : 'default';
    }

    /**
     * 检查安装方式
     * @return bool
     */
    public static function checkMode() {
        return self::getMode() ? true : false;
    }

    /**
     * 保存安装配置
     * @param $config
     */
    public static function saveConfig($config) {
        Session::set('install-config', $config);
    }

    /**
     * 获取安装配置
     * @return mixed
     */
    public static function getConfig() {
        return Session::get('install-config');
    }

    /**
     * 获取数据库帮助类
     * @return Mysql
     */
    public static function getDbHelper() {
        $config = self::getConfig();
        $dbConfig = $config['db'];
        return new Mysql($dbConfig['hostname'], $dbConfig['username'], $dbConfig['password'], $dbConfig['hostport']);
    }

    /**
     * 测试安装配置的数据库连接
     * @return bool
     */
    public static function testConfig() {
        return self::getDbHelper()->connectionTest();
    }

    /**
     * 验证安装配置
     * @param FormValidateInterface $validate
     * @return bool
     */
    public static function checkConfig(FormValidateInterface $validate) {
        if ($validate->validateForm()) {
            return self::testConfig();
        } else {
            return false;
        }
    }

    /**
     * 验证数据库是否存在
     * @return bool
     */
    public static function checkDatabaseExists() {
        return self::getDbHelper()->databaseExists(self::getConfig()['db']['database']);
    }

    /**
     * 创建数据库
     * @return bool
     */
    public static function createDabase() {
        return self::getDbHelper()->createDatabase(self::getConfig()['db']['database']);
    }

    /**
     * 处理表前缀
     * @param string $sql
     * @return string
     */
    private static function tablePrefix($sql = '') {
        return str_replace('yc_', self::getConfig()['db']['prefix'], $sql);
    }

    /**
     * 创建数据表
     * @return int
     */
    public static function createTables() {
        $dbHelper = self::getDbHelper();
        $dbHelper->setDatabase(self::getConfig()['db']['database']);
        $sql = file_get_contents(APP_PATH . 'install' . DS . 'data' . DS . 'create.sql');
        return $dbHelper->exeSQL(self::tablePrefix($sql));
    }

    /**
     * 初始化数据
     * @return int
     */
    public static function initData() {
        $dbHelper = self::getDbHelper();
        $dbHelper->setDatabase(self::getConfig()['db']['database']);
        $sql = file_get_contents(APP_PATH . 'install' . DS . 'data' . DS . 'init.sql');
        return $dbHelper->exeSQL(self::tablePrefix($sql));
    }

    /**
     * 保存配置文件
     */
    public static function writeConfig() {
        $db = config('database');
        $newConfig = array_merge($db, self::getConfig()['db']);
        writeConfig(APP_PATH . 'database.php', APP_PATH . 'sample' . DS . 'database.php', $newConfig);
        $app = config('app');
        $newApp = array_merge($app, self::getConfig()['app']);
        writeConfig(APP_PATH . 'extra' . DS . 'app.php', APP_PATH . 'sample' . DS . 'app.php', $newApp);
    }

    /**
     * 导入演示数据
     */
    public static function initDemo() {
        if (self::getMode() != 'default') {
            $dbHelper = self::getDbHelper();
            $dbHelper->setDatabase(self::getConfig()['db']['database']);
            $sql = file_get_contents(APP_PATH . 'install' . DS . 'data' . DS . 'data.sql');
            return $dbHelper->exeSQL(self::tablePrefix($sql));
        }
    }
}
