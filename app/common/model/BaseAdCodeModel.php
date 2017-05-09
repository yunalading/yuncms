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
namespace app\common\model;

use traits\model\SoftDelete;

/**
 * 标签
 * Class BaseAdCodeModel
 * @package app\common\model
 */
abstract class BaseAdCodeModel extends BaseModel
{
    //开启软删除
    use SoftDelete;
    protected $name = 'ad_code';
}
