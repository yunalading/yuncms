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

/**
 * Class Enum 自定义枚举类
 * @package app\core\enum
 */
abstract class Enum {
    const __default = null;
    private $value;
    private $strict;
    private static $constants = array();

    public function __construct($initialValue = null, $strict = true) {

    }

    public function getConstList($includeDefault = false) {

    }

}