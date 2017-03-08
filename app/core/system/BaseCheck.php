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

namespace app\core\system;
use think\Log;

/**
 * Class BaseCheck
 * 1.检测系统环境
 * 2.目录、文件权限检查
 * 3.常用函数支持检查
 */

abstract class BaseCheck {
    abstract function getCurrentValue();
    abstract function ComparisonConfig();
}
