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

class OsCheck extends BaseENVCheck {
    public $name = '操作系统';
    public $min = '无限制';
    public $best = 'Linux';

    /**
     * 查询电脑系统版本
     * @return string
     */
    function getCurrentValue() {
        return PHP_OS;
    }
    /**
     * 查询当前系统是否匹配
     *@return int
     */
    function ComparisonConfig() {
//        if($this->getCurrentValue() == $this->best){
//            return 1;
//        }else{
//            return 0;
//        }
        return 1;
    }
}
