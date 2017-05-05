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

class Index extends HomeBaseController {

    /**
     * @return \think\response\View
     */
    public function index() {
        //栏目列表
        $category = get_cate_list(['2','3','4','5']);
        $this->assign('category',$category);
        //友情链接列表
        $link = get_link_list();
        $this->assign('link',$link);
        $article_one = get_article_list(6);
        $this->assign('article_one',$article_one);
        //dd($article_one);
        $template ='index';
        return $this->show($template);
    }
}
