<?php
// +----------------------------------------------------------------------
// | YunCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://www.yunalading.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: cqh <68527761@qq.com>
// +----------------------------------------------------------------------

namespace app\core\upload;

use think\App;
use think\Log;

/**
 * Class Upload
 * @package app\core\upload
 */
abstract class Upload
{
    /**
     * @param FileMate $mete
     * @return mixed
     */
    abstract public function upload($file,$config);

    public static function getInstance($file,$config = [])
    {
        $type = isset($config['uploadType']) ? $config['uploadType'] : 'Server';
        $class = false !== strpos($type, '\\') ? $type : '\\app\\core\\upload\\driver\\' . ucwords($type);
        if (class_exists($class)) {
            // 记录初始化信息
            App::$debug && Log::record('[ ImagesUpload ] INIT ' . $type, 'info');
            $upload = new $class();
            return $upload->upload($file,$config);
        } else {
            throw new ClassNotFoundException('class not exists:' . $class, $class);
        }
    }
}
