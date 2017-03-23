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

/**
 * 核心常量定义
 */
define('APP_VERSION', '1.0.0');
define('APP_NAME', 'YunCMS');
define('APP_SITE', 'http://www.yunalading.com');


//数据库配置文件
\think\Config::parse(APP_PATH . 'extra' . DS . 'database.json', 'json', 'database');

//常量配置文件
\think\Config::parse(APP_PATH . 'extra' . DS . 'custom.json', 'json', 'custom');
