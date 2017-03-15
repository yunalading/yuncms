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

class GdCheck extends BaseENVCheck {
    public $name = 'GD库';
    public $min = '2.0';
    public $best = '2.0';

    /**
     * 查询服务器GD库版本
     * @return string
     */
    function getCurrentValue() {
        return  str_replace(' compatible)','',str_replace('bundled (','',gd_info()['GD Version']));
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
