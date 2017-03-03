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
 * Class Area
 * @package app\admin\controller
 */
class Area extends AdminBaseController {
    /**
     * @return \think\response\View
     */
    public function index() {
        print_r(in_array('/admin/tag',config('authorization.menus')));
        return view();
    }
}
