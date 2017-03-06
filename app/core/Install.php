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
}
