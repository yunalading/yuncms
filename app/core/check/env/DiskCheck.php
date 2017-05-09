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

namespace app\core\check\env;

use app\core\check\BaseENVCheck;

/**
 * Class DiskCheck
 * @package app\core\install\check\env
 */
class DiskCheck extends BaseENVCheck {
    public $name = '磁盘空间';

    /**
     * 查询服务器文件上传限制
     * @return string
     */
    function getCurrentValue() {
        $size = disk_free_space(ROOT_PATH);
        return byteFormat($size, "MB", 0);
    }

    /**
     * 查询当前系统是否最优配置
     * @return bool
     */
    function comparisonConfig() {
        if (floatval($this->current) >= floatval($this->min)) {
            return true;
        } else {
            return false;
        }
    }
}
