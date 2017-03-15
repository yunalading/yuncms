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
 * 模型
 * Class BaseModelModel
 * @package app\common\model
 */
abstract class BaseModelModel extends BaseModel {
    //开启软删除
    use SoftDelete;
    //开启删除锁
    protected $del_lock_field = 'del_lock';
    protected $name = 'model';
}
