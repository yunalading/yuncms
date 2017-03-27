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

namespace app\core\check;

/**
 * Class BaseFunCheck
 * @package app\core\system\check
 */
abstract class BaseFunCheck extends BaseCheck {
    public $name = '';
    public $require = '';
    public $comparison = true;

    public function __construct($name = '') {
        $this->name = $name;
        $this->comparison = $this->comparisonConfig();
    }
}
