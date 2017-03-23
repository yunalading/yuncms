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

namespace app\core\check\func;

use app\core\check\BaseFunCheck;

/**
 * Class FunctionCheck
 * @package app\core\install\check\func
 */
class FunctionCheck extends BaseFunCheck {

    public $name = '';
    public $require = '支持';

    function comparisonConfig() {
        if (function_exists($this->name)) {
            return true;
        } else {
            return false;
        }
    }
}
