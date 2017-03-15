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

namespace app\core\install\check\func;

use app\core\install\check\BaseFunCheck;

/**
 * Class FunctionCheck
 * @package app\core\install\check\func
 */
class FunctionCheck extends BaseFunCheck {

    public $name = '';
    public $require = 1;

    function getCurrentValue($name = '') {
        if (function_exists($name)) {
            return 1;
        } else {
            return 0;
        }
    }

    function comparisonConfig() {
        return $this->require && $this->current ? 1 : 0;
    }
}
