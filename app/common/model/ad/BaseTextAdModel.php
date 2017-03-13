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
 * Class BaseTextAdModel
 * @package app\common\model\ad
 */
abstract class BaseTextAdModel extends BaseAdModel {
    //开启软删除
    use SoftDelete;
    protected $name = 'ad_text';
}
