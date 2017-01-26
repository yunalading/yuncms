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


namespace app\common\controller;

use think\App;

abstract class HomeBaseController extends BaseController {
    public function __construct() {
        parent::__construct();
        //设置主题路径
        config('template.view_path',App::$modulePath.'view'.DS.config('app.theme').DS);
    }
}