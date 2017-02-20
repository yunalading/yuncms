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


namespace app\admin\controller;

use app\common\controller\AdminBaseController;

/**
 * Class System
 * @package app\admin\controller
 */
class System extends AdminBaseController {
    /**
     * 系统信息
     * @return \think\response\View
     */
    public function index() {
        return view();
    }
}
