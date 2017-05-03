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
use app\home\controller\HomeBaseController;
use app\home\model\CategoryModel;


/**
 * Class Category
 * @package app\admin\controller
 */

class Lists extends HomeBaseController {
    /**
     * @return \think\response\View
     */
    public function index() {
        //获取所有栏目
        dump($this->param);
        die();
        return view();
    }


}
