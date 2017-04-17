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

namespace app\core\phone;

use think\exception\ClassNotFoundException;
use think\App;
use think\Log;

/**
 * Class Phone
 * @package app\core\phone
 * 短信
 */
class Phone
{
    // 配置参数
    protected static $config = [];
    //驱动名
    protected static $type;
    // 写入驱动
    protected static $driver;

    /**
     * @param $data
     * 短信初始化
     */
    public static function init($config = [])
    {
        $type = isset($config['phoneType']) ? $config['phoneTpe'] : "Alidaye";
        self::$type = $type;
        $class = false !== strpos($type, '\\') ? $type : '\\app\\core\\phone\\driver\\' . ucwords($type);
        self::$config = $config;
        unset($config['phoneType']);
        if (class_exists($class)) {
            self::$driver = new $class($config);
        } else {
            throw new ClassNotFoundException('class not exists:' . $class, $class);
        }
    }

    /**
     * 发送短信
     * @return bool
     */
    public static function send($data=[])
    {
        if (is_null(self::$driver)) {
            self::init(Config::get('phone'));
        }
        //验证数据
        $param = array_filter($data);
        $Validate = new {self::$type}Validate();
        if (!$Validate->check($param, [], self::$type) {
            $this->error($Validate->getError());
            return  false;
        }
        return self::$driver->send($param);
    }
}
