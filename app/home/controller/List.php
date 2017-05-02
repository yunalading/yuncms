<?php
// +----------------------------------------------------------------------
// | YunCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://www.yunalading.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: chenqianhao <68527761@qq.com>
// +----------------------------------------------------------------------


namespace app\home\controller;
use app\home\model\CategoryModel;


/**
 * Class Category
 * @package app\admin\controller
 */

class List extends HomeBaseController {
    /**
     * @return \think\response\View
     */
    public function index() {
        //获取所有栏目
        $model = new CategoryModel();
        $category = $model->putCateOut();
        $this->assign('category', $category);
        return view();
    }


}
