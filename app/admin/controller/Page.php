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
use app\admin\model\ArticleProModel;
use app\admin\model\ModelAttrModel;
use app\admin\model\ModelModel;
use app\admin\model\PageModel;
use app\admin\model\TagModel;
use app\admin\validate\ModelAttrValidate;
use app\admin\validate\PageValidate;
use app\core\upload\Upload;

/**
 * Class Page
 * @package app\admin\controller
 */
class Page extends AdminBaseController {
    /**
     * @return \think\response\View
     */
    public function index() {
        $model = new PageModel();
        $list = $model->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }
    public function edit(){
        $action_name = '添加';
        //模型列表，选择模型
        $module = new ModelModel();
        $module = ModelModel::all();
        $this->assign('module', $module);
        $tagModule = new TagModel();
        $tag = TagModel::all();
        $this->assign('tag', $tag);
        $model = new PageModel();
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['page']);
            $Validate = new PageValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
//            if (!key_exists('cover', $param)) {
//                $param['cover'] = '';
//            }
            $file = request()->file('uploadimages');
            if($file && $file!=NULL){
                $upload = Upload::getInstance($file);
                if($upload->code == 1){
                    if($upload->pathUrl){
                        $param['cover'] = $upload->pathUrl;
                    }
                }else{
                    return $this->error($upload->msg);
                }
            }
            if(isset($this->post['pro'])){
                $pro = array_filter($this->post['pro']);
                $ProValidate = new ModelAttrValidate();
                if (!$ProValidate->check($pro, [], 'contentupdate')) {
                    $this->error($ProValidate->getError());
                }
            }
            $attrModel = new ModelAttrModel();
            $articleModel = new ArticleProModel();
            if (isset($this->param['id']) && $this->param['id']>0) {
                if(isset($pro) && !empty($pro)){
                    //属性值表也需要修改
                    $article_pro['article_id'] = $this->param['id'];
                    $article_pro['type'] = 2;
                    foreach($pro as $key=>$vv){
                        $attr_row_one = $attrModel::get(array('model_id'=>$param['model_id'],'pro_key'=>$key));
                        if(!empty($attr_row_one)){
                            $article_pro['model_properties_id'] = $attr_row_one['model_properties_id'];
                            $article_pro['value'] = $vv;
                            $where['model_properties_id'] = $attr_row_one['model_properties_id'];
                            $where['article_id'] = $article_pro['article_id'];
                            $attr_row_ones = $articleModel::get($where);
                            if(!empty($attr_row_ones)){
                                $articleModel->update($article_pro,$where);
                            }else{
                                //删除以前的属性值
                                $articleModel::destroy($where);
                                $articleModel->create($article_pro);
                            }
                            unset($where);
                        }
                    }
                }
                $action_name = '修改';
                $where['page_id'] = $this->param['id'];
                $model->update($param, $where);
            } else {
                $create = $model->create($param);
                $art_id = $create->getData('page_id');
                if(isset($pro) && !empty($pro)){
                    //属性值表也需要添加
                    $article_pro['article_id'] = $art_id;
                    $article_pro['type'] = 2;
                    foreach($pro as $key=>$vv){
                        $attr_row_one = $attrModel::get(array('model_id'=>$param['model_id'],'pro_key'=>$key));
                        if(!empty($attr_row_one)){
                            $article_pro['model_properties_id'] = $attr_row_one['model_properties_id'];
                            $article_pro['value'] = $vv;
                            $where['model_properties_id'] = $attr_row_one['model_properties_id'];
                            $where['article_id'] = $article_pro['article_id'];
                            $attr_row_ones = $articleModel::get($where);
                            if(!empty($attr_row_ones)){
                                $articleModel->update($article_pro,$where);
                            }else{
                                //删除以前的属性值
                                $articleModel::destroy($where);
                                $articleModel->create($article_pro);
                            }
                            unset($where);
                        }
                    }
                }
            }
            $this->success($action_name . '成功!', url('/admin/page'));
        } else {
            if (!empty($this->param) && $this->param['id']) {
                $pages = PageModel::get($this->param['id']);
                $this->assign('pages', $pages);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name', $action_name);
        return view();
    }
    public function delete(){
        $model = new PageModel();
        if (!empty($this->param) && $this->param['id']) {
            try {
                if ($model::destroy($this->param['id'])) {
                    $this->success('删除成功!');
                } else {
                    $this->error('删除失败!');
                }
            } catch (PDOException $e) {
                Log::error($e);
                $this->error('删除失败!');
            }
        } else {
            $this->error('参数错误!');
        }
    }

}
