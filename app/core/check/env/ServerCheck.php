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


namespace app\core\check\env;

use app\core\check\BaseENVCheck;
use think\Request;

/**
 * Class ServerCheck
 * @package app\core\check\env
 */
class ServerCheck extends BaseENVCheck {
    public $name = 'Web环境';

    function comparisonConfig() {
        return true;
    }

    function getCurrentValue() {
        return Request::instance()->server('SERVER_SOFTWARE');
    }

}
