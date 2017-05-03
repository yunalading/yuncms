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
        $category = get_cate_list();
        $this->assign('category',$category);
        //友情链接列表
        $link = get_link_list();
        $this->assign('link',$link);
        dd($link);

        return view('/index');
    }
}
