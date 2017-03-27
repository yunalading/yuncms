<?php
// +----------------------------------------------------------------------
// | YunCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://www.yunalading.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: chenqianhao <68527761@qq.com>
// +----------------------------------------------------------------------

namespace app\core\upload;
use app\core\upload\Upload;
use think\Config;


class Image {
    static $config;
    static $driver;
    /**
     * 1.确定图片上传的存储方式
     * 2.执行图片上传的动作
     */
    public static function init($config = []) {
        //确定图片上传的存储方式
        //$config = Config::get('upload');
        $type         = isset($config['uploadType']) ? $config['uploadType'] : 'Server';
        $class        = false !== strpos($type, '\\') ? $type : '\\app\\core\\upload\\images\\driver\\' . ucwords($type);
        self::$config = $config;
        unset($config['uploadType']);
        if (class_exists($class)) {
            self::$driver = new $class($config);
        } else {
            throw new ClassNotFoundException('class not exists:' . $class, $class);
        }
        // 记录初始化信息
        App::$debug && Log::record('[ ImagesUpload ] INIT ' . $type, 'info');
    }
    public function imagesUpload(){
        if (is_null(self::$driver)) {
            self::init(Config::get('upload'));
        }
        $result = self::$driver->imagesUpload(self::$config);
    }$config
}
