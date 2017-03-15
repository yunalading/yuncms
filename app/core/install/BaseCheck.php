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

namespace app\core\install;
/**
 * 环境检查基础类
 * Class BaseCheck
 * @package app\core\system
 */
abstract class BaseCheck {
    /**
     * 获取当前配置值
     * @return mixed
     */
    abstract function getCurrentValue();

    /**
     * 比较配置
     * @return mixed
     */
    abstract function comparisonConfig();
}
