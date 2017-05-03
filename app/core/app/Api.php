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
use app\home\model\CategoryModel;
use app\home\model\LinkModel;

class Api extends BaseApi {

    /*
    * 获取栏目
    */
    public static function getCateList($default) {
        $model = new CategoryModel();
        $cate = $model->putCateOut($default);
        return $cate;
    }


    /*
    * 获取友情链接
    */
    public static function getLinkList() {
        $linkModel = new LinkModel();
        $link = $linkModel::all();
        return $link;
    }


}
