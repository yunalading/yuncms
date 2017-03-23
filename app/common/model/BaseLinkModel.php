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
 * 友情链接
 * Class BaseLinkModel
 * @package app\common\model
 */
abstract class BaseLinkModel extends BaseModel {
    protected $name = 'links';
    protected $auto = ['create_time'];
}
