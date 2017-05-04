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
use app\admin\model\ArticleProModel;
use app\admin\model\ContentModel;
use app\admin\model\ModelAttrModel;
use app\home\controller\HomeBaseController;
use app\home\model\CategoryModel;


/**
 * Class Info
 * @package app\admin\controller
 */

class Info extends HomeBaseController
{
    /**
     * @return \think\response\View
     */
    public function index()
    {
        //栏目列表
        $category = get_cate_list(['2', '3', '4', '5']);
        $this->assign('category', $category);
        //友情链接列表
        $link = get_link_list();
        $this->assign('link', $link);
        $template = '';
        if (isset($this->param['article_id']) && $this->param['article_id'] > 0) {
            $articleModel = new ContentModel();
            $article_one = $articleModel->get(intval($this->param['article_id']));
            $categoryModel = new CategoryModel();
            $cid = $article_one['category_id'];
            $category_one = $categoryModel->get($cid);
            $this->assign('article_one',$article_one);
            $this->assign('category_one',$category_one);
            $template = $category_one['info_template'];
            //属性值
            $articleProModel = new ArticleProModel();
            $attrs = $articleProModel::all(array("article_id" => intval($this->param['article_id'])));
            $this->assign('attrs', $attrs);
            dd($attrs);
        }else{
            $this->error('请先选择要查看的内容!');
        }
        //渲染模板输出
        return $this->show($template);
    }

}
