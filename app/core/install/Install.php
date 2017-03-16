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

use app\core\install\check\file\FileIsWriteCheck;
use app\core\install\check\func\FunctionCheck;
use think\Cookie;
use think\Request;

class Install {
    /**
     * 1.检查环境
     * 2.选择安装方式
     * 3.填写配置信息(1.数据库，2网站)
     * 4.执行安装
     */

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
     * 检查配置信息
     * @return bool|array
     */
    public static function checkConfig() {

        //直接刷新，没有表单提交,进行跳转
        $request = Request::instance();
        $param = $request->param();
        if (empty($param)) {
            return false;
        }
        return $param;
    }

    /**
     * 填写配置信息[步骤四]
     * @return bool|array
     */
    public static function checkStep4() {
        //直接刷新，没有表单提交,进行跳转
        $request = Request::instance();
        $param = $request->param();
        if (empty($param)) {
            return false;
        }
        return $param;
    }
}
