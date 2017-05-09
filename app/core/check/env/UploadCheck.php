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
 * Class FileCheck
 * @package app\core\install\check\env
 */
class UploadCheck extends BaseENVCheck {
    public $name = '附件上传';

    /**
     * 查询服务器文件上传限制
     * @return string
     */
    function getCurrentValue() {
        return @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'unknown';
    }

    /**
     * 查询当前系统是否最优配置
     * @return bool
     */
    function comparisonConfig() {
        return true;
    }
}
