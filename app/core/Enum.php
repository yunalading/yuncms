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
    /**
     *
     */
    const __default = null;
    /**
     * @var null
     */
    private $value;
    /**
     * @var bool
     */
    private $strict;
    /**
     * @var array
     */
    private static $constants = array();

    /**
     * Enum constructor.
     * @param null $initialValue
     * @param bool $strict
     */
    public function __construct($initialValue = null, $strict = true) {
        $class = get_class($this);
        if (!array_key_exists($class, self::$constants)) {
            self::populateConstants();
        }
        if ($initialValue === null) {
            $initialValue = self::$constants[$class]["__default"];
        }
        $temp = self::$constants[$class];
        if (!in_array($initialValue, $temp, $strict)) {
            throw new UnexpectedValueException("Value is not in enum " . $class);
        }
        $this->value = $initialValue;
        $this->strict = $strict;
    }

    /**
     * @param bool $includeDefault
     * @return array|mixed
     */
    public function getConstList($includeDefault = false) {
        $class = get_class($this);
        if (!array_key_exists($class, self::$constants)) {
            self::populateConstants();
        }
        return $includeDefault ? array_merge(self::$constants[__CLASS_], array("__default" => self::__default)) : self::$constants[__CLASS_];
    }

    /**
     *
     */
    private function populateConstants() {
        $class = get_class($this);
        $r = new \ReflectionClass($class);
        $constants = $r->getConstants();
        self::$constants = array($class => $constants);
    }

    /**
     * @return string
     */
    public function __toString() {
        return (string)$this->value;
    }

    /**
     * @param $object
     * @return bool
     */
    public function equals($object) {
        if (!($object instanceof Enum)) {
            return false;
        }
        return $this->strict ? ($this->value === $object->value) : ($this->value == $object->value);
    }
}