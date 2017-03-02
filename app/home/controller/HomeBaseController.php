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


namespace app\home\controller;

use app\common\controller\BaseController;
use think\App;

/**
 * Class HomeBaseController
 * @package app\common\controller
 */
abstract class HomeBaseController extends BaseController {
    /**
     * HomeBaseController constructor.
     */
    public function __construct() {
        parent::__construct();
        //设置主题路径
        $this->view->config('view_path', App::$modulePath . 'view' . DS . config('app.theme') . DS);
    }
}
