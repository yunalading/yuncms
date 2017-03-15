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

/**
 * Class Dashboard
 * @package app\admin\controller
 */
class Dashboard extends AdminBaseController {
    /**
     * @return \think\response\View
     */
    public function index() {
        $this->assign('menus',json_encode(config('authorization')));
        return view();
    }

}
