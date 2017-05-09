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


namespace app\core\app;
use app\admin\model\ContentModel;
use app\home\model\CategoryModel;
use app\home\model\LinkModel;

class Api extends BaseApi {

    /*
    * 获取栏目
    */
    public static function getCateList($ids,$default) {
        $model = new CategoryModel();
        $cate = $model->putCateOut($ids,$default);
        return $cate;
    }

    /*
    * 获取友情链接
    */
    public static function getLinkList() {
        $linkModel = new LinkModel();
        $where['link_is_home'] = array('neq',1);
        $link = $linkModel::all($where);
        return $link;
    }

    /*
    * 获取文章列表
    */
    public static function getArticleList($cid) {
        $articleModel = new ContentModel();
        $where['content_state'] = 0;
        if($cid != 0){
            $where['category_id'] = array('in',$cid);
        }
        $article = $articleModel::all($where);
        return $article;
    }

}
