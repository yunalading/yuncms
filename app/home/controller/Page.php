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
use app\home\model\ArticleProModel;
use app\home\model\PageModel;
use app\home\model\ModelAttrModel;
use app\home\controller\HomeBaseController;
use app\home\model\CategoryModel;
/**
 * Class Lists
 * @package app\home\controller
 */
class Page extends HomeBaseController
{
    /**
     * @return \think\response\View
     */
    public function index()
    {
        $template = '';
        $pageModel = new PageModel();
        $list = $pageModel->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        //渲染模板输出
        return $this->show($template);
    }
}
