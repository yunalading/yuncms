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

namespace app\core;

use app\core\system\check\env\PhpVersionCheck;
use app\core\system\check\env\GdCheck;
use app\core\system\check\env\OsCheck;
use app\core\system\check\env\DiskCheck;
use app\core\system\check\env\FileCheck;
use app\core\system\check\file\FileWriteCheck;
use app\core\system\check\func\FunctionCheck;
use think\Log;
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
        return file_exists('data/install.lock');
    }

    /**
     * 写入安装锁
     */
    public static function writeInstallLock() {
        $file = new \SplFileObject('data/install.lock', 'w+');
        //写入安装时间
        $file->fwrite(time());
    }

    /**
     * 获取安装时间
     * @return int
     */
    public static function getInstallTime() {
        $file = new \SplFileObject('data/install.lock');
        return $file->getCurrentLine();
    }

    /**
     * 检查环境[步骤一]
     * @return array
     */
    public static function checkStep1() {
        $info = array();
        $checkno = array();
        $env_check = [
            'phpversion' => new PhpVersionCheck(),
            'os' => new OsCheck(),
            'gd' => new GdCheck(),
            'file' => new FileCheck(),
            'disk' => new DiskCheck(),
        ];
        foreach($env_check as $v){
            if($v->comparison < 1 ){
                $checkno[]=$v->name;
            }
        }
        //目录、文件权限检查
        $file_check = [
            new FileWriteCheck('runtime'),
            new FileWriteCheck('upload/images'),
        ];
        foreach($file_check as $v){
            if($v->comparison < 1 ){
                $checkno[]=$v->path;
            }
        }
        //函数检查
        $fun_check= [
            new FunctionCheck('json_encode'),
            new FunctionCheck('fsockopen'),
        ];
        foreach($fun_check as $v){
            if($v->comparison < 1 ){
                $checkno[]=$v->path;
            }
        }
        $info['env_check']=$env_check;
        $info['file_check']=$file_check;
        $info['fun_check']=$fun_check;
        $info['checkno']=$checkno;
        return $info;
    }
    /**
     * 选择数据安装方式[步骤二]
     * @return bool
     */
    public static function checkStep2() {
        $info=self::checkStep1();
        if(!empty($info['checkno'])){
            return false;
        }else{
            return true;
        }
    }
    /**
     * 填写配置信息[步骤三]
     * @return bool|array
     */
    public static function checkStep3() {
        $info = self::checkStep2();
        if(!$info){
            return false;
        }
        if(!Cookie::has('install-mode')){
            return false;
        }
        //直接刷新，没有表单提交,进行跳转
        $request = Request::instance();
        $param = $request->param();
        if(empty($param)){
            return false;
        }
        return $param;
    }

}
