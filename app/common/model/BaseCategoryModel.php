<?php
// +----------------------------------------------------------------------
// | YunCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://www.yunalading.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: jabber <2898117012@qq.com>
// +----------------------------------------------------------------------
namespace app\common\model;

use traits\model\SoftDelete;

/**
 * 类别
 * Class BaseCategoryModel
 * @package app\common\model
 */
abstract class BaseCategoryModel extends BaseModel {
    use SoftDelete;

    protected $name = 'category';
}
