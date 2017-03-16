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

namespace app\core\install\check\file;

use app\core\install\check\BaseFileCheck;

/**
 * Class FileWriteCheck
 * @package app\core\install\check\file
 */
class FileIsWriteCheck extends BaseFileCheck {

    public $path = '';
    public $require = '可写';

    function comparisonConfig() {
        if ($this->path != '') {
            if (is_writable($this->path)) {
                return true;
            }
        } else {
            return false;
        }
    }
}
