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

use app\admin\model\EduLevelModel;

/**
 * Class Edu
 * @package app\admin\controller
 */
class Edu extends AdminBaseController {
    /**
     * 文化程度列表
     * @return \think\response\View
     */
    public function index() {
        $eduLevelModel = new EduLevelModel();
        $list = $eduLevelModel->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }
}
