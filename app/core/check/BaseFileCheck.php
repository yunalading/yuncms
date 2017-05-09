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
 * 目录文件检查
 * Class BaseFileCheck
 * @package app\core\install\check
 */
abstract class BaseFileCheck extends BaseCheck {
    public $path = '';
    public $require = '';
    public $comparison = true;

    public function __construct($path = '') {
        $this->path = $path;
        $this->comparison = $this->comparisonConfig();
    }
}
