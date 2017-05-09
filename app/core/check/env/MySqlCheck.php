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
use app\core\db\helper\Mysql;

/**
 * Class MySqlCheck
 * @package app\core\check\env
 */
class MySqlCheck extends BaseENVCheck {
    public $name = 'MySQL版本';

    function comparisonConfig() {
        return true;
    }

    function getCurrentValue() {
        $mysql = new Mysql(config('database.hostname'), config('database.username'), config('database.password'), config('database.hostport'));
        return $mysql->version();
    }

}
