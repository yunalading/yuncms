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
 * @param $ids 指定显示分类,默认所有(指定一级栏目即可)
 */
function get_cate_list($ids = [],$default = false ){
    $api = new \app\core\app\Api();
    //dd($api::getCateList($default));
    return $api::getCateList($ids,$default);
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


/*
 * 获取常量
 * @param $default 是否显示默认分类,默认不显示
 */
function get_const($name){
    $api = new \app\core\app\Api();
    return $api::getConstValue();
}


/*
 * 根据栏目获取文章列表
 * @param $cid 栏目id 默认0所有文章
 */
function get_article_list($cid=0){
    $api = new \app\core\app\Api();
    return $api::getArticleList($cid);
}

/*
 * 获取属性值
 */
function get_attr_value($str){
    $strs = explode('|',$str);
    return  $strs[1];
}
/*
 * 获取属性名
 */
function get_attr_key($str){
    $strs = explode('|',$str);
    return  $strs[0];
}
