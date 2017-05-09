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
use app\admin\model\CategoryModel;
use app\admin\model\ContentModel;
use app\admin\model\ModelModel;
use app\admin\model\TagModel;
use app\admin\validate\ContentValidate;
use app\admin\validate\ModelAttrValidate;
use app\core\upload\Upload;
use app\admin\model\ModelAttrModel;
use think\Config;
use think\Request;

/**
 * Class Content
 * @package app\admin\controller
 */
class Content extends AdminBaseController
{

    /**
     * @return \think\response\View
     */
    public function index()
    {
        $model = new ContentModel();
        $list = $model->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }
    /**
     * @return \think\response\View
     */
    public function edit()
    {
        $action_name = '添加';
        $models = new CategoryModel();
        $cate = $models->putCateOut();
        $this->assign('cate', $cate);
        $tagModule = new TagModel();
        $tag = TagModel::all();
        $this->assign('tag', $tag);
        $model = new ContentModel();
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['content']);
            $Validate = new ContentValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
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
                //属性值由于换栏目引发的改变需要删除原来的属性再添加此属性值
                if(isset($pro) && !empty($pro)){
                    //属性值表也需要修改
                    $article_pro['article_id'] = $this->param['id'];
                    $article_pro['type'] = 1;
                    $cate = $models::get(array('category_id'=>$param['category_id']));
                    foreach($pro as $key=>$vv){
                        $attr_row_one = $attrModel::get(array('model_id'=>$cate['model_id'],'pro_key'=>$key));
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
                $where['content_id'] = $this->param['id'];
                $model->update($param, $where);
            } else {
                $param['push_time'] = time();
                $param['user_id'] = session('user.user_id');
                $create = $model->create($param);
                $art_id = $create->getData('content_id');
                //通过栏目查询出所有的属性值
                $cate = $models::get(array('category_id'=>$param['category_id']));
                if(isset($pro) && !empty($pro)){
                    //属性值表也需要添加
                    $article_pro['article_id'] = $art_id;
                    $article_pro['type'] = 1;
                    foreach($pro as $key=>$vv){
                        $attr_row_one = $attrModel::get(array('model_id'=>$cate['model_id'],'pro_key'=>$key));
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
                            //$articleModel->create($article_pro);
                        }
                    }
                }
            }
            $this->success($action_name . '成功!', url('/admin/content'));
        } else {
            if (!empty($this->param) && $this->param['id']) {
                $content = ContentModel::get($this->param['id']);
                $this->assign('content', $content);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name', $action_name);
        return view();
    }

    /**
     * 根据栏目ids获取模型的属性值
     */
    public function get_module_pro(){
        $param = Request::instance()->param();
        if(empty($param)){
            $res['msg'] = "非法访问!";
            $res['code'] = 0;
            return json($res);
        }
        $attrModel = new ModelAttrModel();
        $where['model_id'] = $param['model_id'];
        $data = $attrModel->where($where)->select();
        unset($where);
        if(!empty($data)){
            $articleModel = new ArticleProModel();
            foreach($data as &$v){
                $v['type'] = config('model_attr')[$v['pro_cate']];
                //如果有属性值可以在此处查询出来
                if($param['article_id']>0){
                    $where['article_id'] = $param['article_id'];
                    $where['type'] = $param['type'];
                    $where['model_properties_id'] = $v['model_properties_id'];
                    $article = ArticleProModel::get($where);
                    if($article && !empty($article)){
                        $v['value'] = $article['value'];
                    }else{
                        $v['value'] = '';
                    }
                    unset($where);
                }else{
                    $v['value'] = '';
                }
            }
        }
        $res['msg'] = "获取模型的属性字段成功!";
        $res['info'] = $data;
        $res['code'] = 1;
        return json($res);
    }

    /**
     * @return \think\response\View
     */
    public function delete(){
        $model = new ContentModel();
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
