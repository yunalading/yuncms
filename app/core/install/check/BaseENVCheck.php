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
 * 环境检查
 * Class BaseENVCheck
 * @package app\core\system\check
 */
abstract class BaseENVCheck extends BaseCheck {
    /**
     * 环境名称
     * @var string
     */
    public $name = '';
    /**
     * 最低配置
     * @var string
     */
    public $min = '';
    /**
     * 最佳配置
     * @var string
     */
    public $best = '';
    /**
     * 当前配置
     * @var string
     */
    public $current = '';
    /**
     * 是否满足
     * @var int
     */
    public $comparison = 0;

    public function __construct() {
        //获取当前配置
        $this->current = $this->getCurrentValue();
        //获取配置比较结果
        $this->comparison = $this->comparisonConfig();
    }
}
