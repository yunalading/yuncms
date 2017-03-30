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
        if(isset($this->param['keyword']) && trim($this->param['keyword'])!=''){
            $keyword=trim($this->param['keyword']);
            $list = $adTextModel->whereLike("title,ad_desc",'%'.$keyword.'%', 'or')->paginate();
        }else{
            $list = $adTextModel->paginate();
        }
        $page = $list->render();
//        dump($list);
//        die();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }
    /*
     * 添加/修改普通广告
     */
    public function generaledit(){
        $action_name = '添加';
        $model = new AdTextModel();
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['adtext']);
            $Validate = new AdTextValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
            if(isset($this->param['id']) && $this->param['id']){
                $action_name = '修改';
                $where['ad_text_key'] = $this->param['id'];
                $model->update($param,$where);
            }else{
                $model->create($param);
            }
            $this->success($action_name.'成功!', url('/admin/ad/general'));
        } else {
            if (!empty($this->param) && $this->param['id']) {
                $tag = AdTextModel::get($this->param['id']);
                $this->assign('adtext', $adtext);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name', $action_name);
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
