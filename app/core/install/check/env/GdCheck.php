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

namespace app\core\install\check\env;

use app\core\install\check\BaseENVCheck;

/**
 * Class GdCheck
 * @package app\core\install\check\env
 */
class GdCheck extends BaseENVCheck {
    public $name = 'GD库';
    public $min = '2.0';
    public $best = '2.0';

    /**
     * 查询服务器GD库版本
     * @return string
     */
    function getCurrentValue() {
        $tmp = function_exists('gd_info') ? gd_info() : array();
        preg_match("/[\d.]+/", $tmp['GD Version'], $match);
        unset($tmp);
        return $match[0];
    }

    /**
     * 查询当前系统是否最优配置
     * @return bool
     */
    function comparisonConfig() {
        if ($this->current >= $this->min) {
            return true;
        } else {
            return false;
        }
    }
}
