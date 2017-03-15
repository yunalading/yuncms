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

namespace app\core\system\check\file;


use app\core\system\check\BaseFileCheck;

class FileWriteCheck extends BaseFileCheck {

    public $path = '';
    public $require = 1;

    function getCurrentValue($path='') {
        if($path != ''){
            if (is_writable(ROOT_PATH.$path)){
                return 1;
            }
        }else{
            return 0;
        }
    }

    function ComparisonConfig() {
        return $this->require && $this->current?1:0;
    }
}
