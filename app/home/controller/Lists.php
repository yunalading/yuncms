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
use app\admin\model\ArticleProModel;
use app\admin\model\ContentModel;
use app\admin\model\ModelAttrModel;
use app\home\controller\HomeBaseController;
use app\home\model\CategoryModel;


/**
 * Class Lists
 * @package app\admin\controller
 */

class Lists extends HomeBaseController {
    /**
     * @return \think\response\View
     */
    public function index() {
        $template = '';
        if(isset($this->param['category_id']) && $this->param['category_id']>0){
            $categoryModel = new CategoryModel();
            $cid = intval($this->param['category_id']);
            $this->assign('cid', $cid);
            $category_one = $categoryModel->get($cid);
            $this->assign('category_one',$category_one);
            $template = $category_one['list_template'];
            //模型属性
            $model_attr = ModelAttrModel::all(array("model_id" => $category_one['model_id']));
            $attrs = array();
            $first = array();
            if (!empty($model_attr)) {
                foreach ($model_attr as $mm) {
                    $mm['values'] = explode(',',$mm['pro_value']);
                    $attrs[$mm['pro_key']] = $mm;
                    if(!empty($mm['values'])){
                        if(!empty(explode('|',$mm['values'][0])[0])){
                            $first[$mm['pro_key']] = explode('|',$mm['values'][0])[1];
                        }
                    }
                }
            }
            $this->assign('attrs', $attrs);
            unset($this->param['category_id']);
            //dd($this->param);
            //根据栏目获取所有文章
            $articleModel = new ContentModel();
            //unset($where);
            //有属性值选择提交过来
            if(isset($this->param) && !empty($this->param)){
                $where['a.category_id'] = $cid;
                foreach($this->param as $k=>$pp){
                    $where['ap.value'] = $pp;
                }
                $list = $articleModel->alias('a')->where($where)->group('a.content_id')->field('a.content_id,a.category_id,a.cover,c.model_id,p.model_properties_id,p.pro_name')->join('__CATEGORY__ c','a.category_id = c.category_id')->join('__MODEL_PROPERTIES__ p','c.model_id = p.model_id')->join('__ARTICLE_PROPERTIES__ ap','a.content_id = ap.article_id')->paginate();
                $selects = $this->param;
            }else{
                $where['category_id'] = $cid;
                $list = $articleModel->where($where)->field('content_id,category_id,cover')->paginate();
                $selects = $first;
            }
            $this->assign('selects', $selects);
            //dd($selects);
            unset($where);
            //属性值
            if(!empty($list)){
                $articleProModel = new ArticleProModel();
                foreach($list as &$v){
                    $where['a.article_id'] = intval($v['content_id']);
                    $attrss = $articleProModel->alias('a')->where($where)->field('a.*,p.model_properties_id,p.pro_name,p.pro_key,p.model_id,p.pro_value')->join('__MODEL_PROPERTIES__ p','p.model_properties_id = a.model_properties_id')->select();
                    if(!empty($attrss)){
                        foreach($attrss as $vv){
                            $v[$vv['pro_key']] = $vv['value'];
                        }
                    }
                }
            }
            $page = $list->render();
            $this->assign('list', $list);
            $this->assign('page', $page);
            //dd($list);
        }else{
            dump($this->param);
            die();
            //所有栏目
            $this->error('请先选择栏目分类!');
            $cid = 0;
            $articleModel = new ContentModel();
            $list = $articleModel->paginate();
            $page = $list->render();
            $this->assign('list', $list);
            $this->assign('page', $page);
        }
        //渲染模板输出
        return $this->show($template);
    }


}
