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

class DiskCheck extends BaseENVCheck {
    public $name = '磁盘空间';
    public $min = '100M';
    public $best = '>100M';

    /**
     * 查询服务器文件上传限制
     * @return string
     */
    function getCurrentValue() {
        $size=disk_free_space(ROOT_PATH);
        return byteFormat($size, "MB",0);
    }
    /**
     * 查询当前系统是否最优配置
     *@return int
     */
    function ComparisonConfig() {
        if($this->getCurrentValue() >= intval(str_replace('>','',$this->best))){
            return 1;
        }else{
            return 0;
        }
    }
}
