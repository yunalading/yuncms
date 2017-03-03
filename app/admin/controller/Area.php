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

use app\admin\model\AreaModel;

/**
 * Class Area
 * @package app\admin\controller
 */
class Area extends AdminBaseController {
    /**
     * @return \think\response\View
     */
    public function index() {
        $areaModel = AreaModel::get();
        print_r($areaModel);
        return view();
    }
}
