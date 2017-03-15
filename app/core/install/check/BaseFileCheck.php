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
 * 目录文件检查
 * Class BaseFileCheck
 * @package app\core\install\check
 */
abstract class BaseFileCheck extends BaseCheck {
    public $path = '';
    public $require = 1;
    public $current = 0;
    public $comparison = 0;
    public function __construct($path='') {
        $this->path = $path;
        $this->current = $this->getCurrentValue($this->path);
        $this->comparison = $this->comparisonConfig();
    }
}
