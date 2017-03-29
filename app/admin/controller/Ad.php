<?php
// +----------------------------------------------------------------------
// | YunCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://www.yunalading.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: jabber <2898117012@qq.com>
// +----------------------------------------------------------------------


namespace app\admin\controller;
use app\admin\model\AdTextModel;
use app\admin\model\AdCodeModel;
use app\admin\model\AdImagesModel;
use app\admin\validate\AdTextValidate;
use app\admin\validate\AdCodeValidate;
use app\admin\validate\AdImagesValidate;

/**
 * Class Ad
 * @package app\admin\controller
 */
class Ad extends AdminBaseController {
    /**
     * 普通广告列表
     * @return \think\response\View
     */
    public function general() {
        $adTextModel = new AdTextModel();
        return view();
    }

    /**
     * 脚本广告列表
     * @return \think\response\View
     */
    public function script() {
        return view();
    }

    /**
     * 幻灯片广告列表
     * @return \think\response\View
     */
    public function slide() {
        return view();
    }

    public function edit(){
        return view();
    }
    public function scriptedit(){
        return view();
    }
    public function slideedit(){
        return view();
    }
    public function delete(){
        return view();
    }
    public function scriptdelete(){
        return view();
    }
    public function slidedelete(){
        return view();
    }
}
