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

/*
 * 获取栏目列表
 * @param $default 是否显示默认分类,默认不显示
 */
function get_cate_list($default = false){
    $api = new \app\core\app\Api();
    //dd($api::getCateList($default));
    return $api::getCateList($default);
}

/*
 * 获取栏目url链接地址
 * @param $category_id 栏目标识
 */
function get_cate_url($category_id=0){
    return url('lists/index',array('category_id'=>$category_id));
}

/*
 * 获取友情链接
 * @param $default 是否显示默认分类,默认不显示
 */
function get_link_list(){
    $api = new \app\core\app\Api();
    return $api::getLinkList();
}
