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
/**
 * 导航
 * Class BaseNavModel
 * @package app\common\model
 */
abstract class BaseNavModel extends BaseModel {
    //开启删除锁
    protected $del_lock_field = 'del_lock';
    protected $name = 'navs';
}
