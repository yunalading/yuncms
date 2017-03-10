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
 * 写入配置文件
 */
function writeConfig($config_path,$new_config = array()) {
    //return substr(sprintf('%o', fileperms($config_path)), -4);//0755
//    $old_config = file_get_contents($config_path);
//    if(!empty($new_config)){
//        file_put_contents($config_path,var_export($new_config,true));
//    }
//    return $old_config;

    $path_array = explode('/',$config_path);
    $tpl_name = end($path_array);
    if (!empty($new_config)) {
        //读取配置内容
        $conf = file_get_contents(APP_PATH.'tpl/'.$tpl_name);
        //替换配置项
        foreach ($new_config as $name => $value) {
            if(is_array($value)){
                $value = json_encode($value);
            }
            $conf = str_replace("[{$name}]", $value, $conf);
        }
        //写入应用配置文件
        if (file_put_contents($config_path, $conf)) {
            return true;
        } else {
            return false;
        }
    }

}

/*
 * PHP 的字节格式化函数：byteFormat
 * echo byteFormat(1073741824, "B", 0) . "\n";
 * echo byteFormat(1073741824, "KB", 0) . "\n";
 * echo byteFormat(1073741824, "MB") . "\n";
 * echo byteFormat(1073741824) . "\n";
 * echo byteFormat(1073741824, "TB", 10) . "\n";
 * echo byteFormat(1099511627776, "PB", 6) . "\n";
 */
function byteFormat($bytes, $unit = "", $decimals = 2) {
    $units = array('B' => 0, 'KB' => 1, 'MB' => 2, 'GB' => 3, 'TB' => 4, 'PB' => 5, 'EB' => 6, 'ZB' => 7, 'YB' => 8);

    $value = 0;
    if ($bytes > 0) {
        // Generate automatic prefix by bytes
        // If wrong prefix given
        if (!array_key_exists($unit, $units)) {
            $pow = floor(log($bytes)/log(1024));
            $unit = array_search($pow, $units);
        }

        // Calculate byte value by prefix
        $value = ($bytes/pow(1024,floor($units[$unit])));
    }

    // If decimals is not numeric or decimals is less than 0
    // then set default value
    if (!is_numeric($decimals) || $decimals < 0) {
        $decimals = 2;
    }

    // Format output
    return sprintf('%.'.$decimals.'f'.$unit, $value);
}
