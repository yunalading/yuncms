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
 * Class Info
 * @package app\admin\controller
 */

class Info extends HomeBaseController
{
    /**
     * @return \think\response\View
     */
    public function index()
    {
        $template = '';
        if (isset($this->param['article_id']) && $this->param['article_id'] > 0) {
            $articleModel = new ContentModel();
            $article = $articleModel->get(intval($this->param['article_id']));
            $categoryModel = new CategoryModel();
            $cid = $article['category_id'];
            $category_one = $categoryModel->get($cid);
            $this->assign('article',$article);
            $this->assign('category_one',$category_one);
            $template = $category_one['info_template'];
            //属性值
            $articleProModel = new ArticleProModel();
            $where['a.article_id'] = intval($this->param['article_id']);
            $article['category_name'] = $category_one['category_name'];
            $attrs = $articleProModel->alias('a')->where($where)->field('a.*,p.model_properties_id,p.pro_name,p.pro_key,p.model_id,p.pro_value')->join('__MODEL_PROPERTIES__ p','p.model_properties_id = a.model_properties_id')->select();
            if(!empty($attrs)){
                foreach($attrs as $v){
                    $article[$v['pro_key']] = $v['value'];
                }
            }
            //dd($article);
        }else{
            $this->error('请先选择要查看的内容!');
        }
        //渲染模板输出
        return $this->show($template);
    }

}
