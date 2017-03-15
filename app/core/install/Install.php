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

use app\core\install\check\env\PhpVersionCheck;
use app\core\install\check\env\GdCheck;
use app\core\install\check\env\OsCheck;
use app\core\install\check\env\DiskCheck;
use app\core\install\check\env\UploadCheck;
use app\core\install\check\file\FileWriteCheck;
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
            $env_check = new $env['class'];
            $env_array[] = $env_check;
        }
        /**
         * 创建文件检查列表
         */
        foreach (config('require.file') as $file) {
            $file_check = new FileWriteCheck($file['path']);
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
            if ($env->comparison){

            }
        }
        foreach ($list['file'] as $file) {

        }
        foreach ($list['fun'] as $fun) {

        }
        return $flag;
    }

    /**
     * 选择数据安装方式[步骤二]
     * @return bool
     */
    public static function checkStep2() {
        $info = self::checkEnv();
        if (!empty($info['checkno'])) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 填写配置信息[步骤三]
     * @return bool|array
     */
    public static function checkStep3() {
        $info = self::checkStep2();
        if (!$info) {
            return false;
        }
        if (!Cookie::has('install-mode')) {
            return false;
        }
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
