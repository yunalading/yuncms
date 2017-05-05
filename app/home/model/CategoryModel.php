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


namespace app\home\model;


use app\common\model\BaseCategoryModel;

/**
 * Class CategoryModel
 * @package app\admin\model
 */
class CategoryModel extends BaseCategoryModel {
    public $arr;
    private $fields = "category_id,model_id,category_name,parent_category_id,seo_title,seo_key,seo_url,update_time,create_time";
    /**
     * 获取所有的栏目
     */
    public function getAllCategory($ids,$default)
    {
        $where['parent_category_id'] = 0;
        $where['del_lock'] = 0;
        if(!empty($ids)){
            $where['category_id'] = array('in',$ids);
        }
//        if($default == false){
//            $where['category_id'] = array('neq','1');
//        }
        $cat = $this->where($where)->order('category_sort ASC')->field($this->fields)->select();
        if($cat){
            foreach ($cat as $k => $v) {
                $cat[$k]['lev'] = 0;
                $cat[$k]['child'] = $this->getChild($v['category_id'],$cat[$k]['lev']);
                if($cat[$k]['child']==''){
                    unset($cat[$k]['child']);
                }
            }
        }
        return $cat;
    }

    /**
     * 获取子栏目
     */
    public function getChild($pid,$lev)
    {
        $where['parent_category_id'] = $pid;
        $where['del_lock'] = 0;
        $child = $this->where($where)->order('category_sort ASC')->field($this->fields)->select();
        if($child){
            foreach ($child as $k => $v) {
                $child[$k]['lev']= $lev+1;
                $child[$k]['child'] = $this->getChild($v['category_id'],$child[$k]['lev']);
                if($child[$k]['child']==''){
                    unset($child[$k]['child']);
                }
            }
            return $child;
        }else{
            return '';
        }
    }

    /**
     * 转换成一维栏目排序，后期可以在上面循环上再优化
     */
    public function putCateOut($ids,$default){
        $cate = $this->getAllCategory($ids,$default);
        if($this->whileout($cate,array())){
            return $this->arr;
        }
    }

    public function whileout($cate,$arr){
        foreach($cate as $v){
            if(isset($v['child'])){
                $child = $v['child'];
                unset($v['child']);
                $this->arr[] = $v;
                $this->whileout($child,$this->arr);
            }else{
                $this->arr[] = $v;
            }
        }
        return true;
    }
}
