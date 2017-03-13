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
 * 会员
 * Class BaseMemberModel
 * @package app\common\model
 */
abstract class BaseMemberModel extends BaseModel {
    use SoftDelete;
    protected $name = 'members';
}
