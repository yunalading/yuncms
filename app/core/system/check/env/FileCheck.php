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

namespace app\core\system\check\env;


use app\core\system\check\BaseENVCheck;

class FileCheck extends BaseENVCheck {
    public $name = '附件上传';
    public $min = '未限制';
    public $best = '2M';

    /**
     * 查询服务器文件上传限制
     * @return string
     */
    function getCurrentValue() {
        return @ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown';
    }
    /**
     * 查询当前系统是否最优配置
     *@return int
     */
    function ComparisonConfig() {
        if($this->getCurrentValue()=='unknown'){
            return  0;
        }else if(intval($this->getCurrentValue()) >= intval(str_replace('>','',$this->best))){
            return 1;
        }else{
            return 0;
        }
    }
}
