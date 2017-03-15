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

namespace app\core\install\check;

use app\core\install\BaseCheck;

/**
 * Class BaseFunCheck
 * @package app\core\system\check
 */
abstract class BaseFunCheck extends BaseCheck {
    public $name = '';
    public $require = 1;
    public $current = 0;
    public $comparison = 0;

    public function __construct($name = '') {
        $this->name = $name;
        $this->current = $this->getCurrentValue($this->name);
        $this->comparison = $this->comparisonConfig();
    }
}
