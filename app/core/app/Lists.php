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

class Lists extends BaseApp {

    /*
    * 添加修改栏目
    */
    public static function getCateList() {
        $model = new CategoryModel();
        $cate = $model->putCateOut();
        return json($cate);
    }



}
