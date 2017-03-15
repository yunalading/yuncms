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

/**
 * 检测系统环境(操作系统 PHP版本 GD库 附件上传 磁盘空间)
 * @return array
 */
use app\core\system\BaseCheck;

abstract class BaseENVCheck extends BaseCheck {
    public $name = '';
    public $min = '';
    public $best = '';
    public $current = '';
    public $comparison = 0;

    public function __construct() {
        $this->current = $this->getCurrentValue();
        $this->comparison = $this->ComparisonConfig();
    }
}
