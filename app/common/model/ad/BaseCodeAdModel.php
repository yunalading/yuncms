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

namespace app\common\model\ad;

use app\common\model\BaseAdModel;
use traits\model\SoftDelete;
/**
 * 代码广告
 * Class CodeAdModel
 * @package app\common\model\ad
 */
abstract class BaseCodeAdModel extends BaseAdModel {
    use SoftDelete;
    protected $name = 'ad_code';
}
