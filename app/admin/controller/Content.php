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


namespace app\admin\controller;
use app\admin\model\ContentModel;

/**
 * Class Content
 * @package app\admin\controller
 */
class Content extends AdminBaseController
{

    /**
     * @return \think\response\View
     */
    public function index()
    {
        $model = new ContentModel();
        $list = $model->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }

    /**
     * @return \think\response\View
     */
    public function add()
    {
        return view();
    }

    /**
     * @return \think\response\View
     */
    public function edit()
    {
        return view();
    }

    /**
     * @return \think\response\View
     */
    public function delete()
    {
        return view();
    }

    /**
     * @return \think\response\View
     */
    public function trash()
    {
        return view();
    }

    public function editor()
    {
        return view();
    }
}
