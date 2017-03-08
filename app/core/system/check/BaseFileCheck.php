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

namespace app\core\system\check;
use app\core\system\BaseCheck;
/**
 * 目录、文件权限检查
 */

abstract class BaseFileCheck extends BaseCheck {
    public $path = '';
    public $require = 1;
    public $current = 0;
    public $comparison = 0;
    public function __construct($path='') {
        $this->path = $path;
        $this->current = $this->getCurrentValue($this->path);
        $this->comparison = $this->ComparisonConfig();
    }
}
