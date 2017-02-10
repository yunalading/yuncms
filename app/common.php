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

// 应用公共文件

/**
 * 输出缓冲
 */
function flush_out() {
    ob_flush();
    flush();
}

/**
 * 检查是否安装
 * @return bool
 */
function check_install() {
    return false;
}

/**
 * 写入配置文件
 */
function write_config($config_path, $old_config = array(), $new_config = array()) {

}