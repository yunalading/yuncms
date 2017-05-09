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

use app\admin\model\AreaModel;
use app\admin\validate\AreaValidate;
use think\exception\PDOException;

/**
 * Class Area
 * @package app\admin\controller
 */
class Area extends AdminBaseController {
    /**
     * 地区列表
     * @return \think\response\View
     */
    public function index() {
        $areaModel = new AreaModel();
        $list = $areaModel->order('area_sort desc')->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }
    public function edit() {
        $action_name = '添加';
        $model = new AreaModel();
        $area_all = $model->all();
        $this->assign('area_all', $area_all);
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['area']);
            $Validate = new AreaValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
            if (!key_exists('area_parent_id', $param)) {
                $param['area_parent_id'] = 0;
            }
            if(isset($this->param['id']) && $this->param['id']){
                $action_name = '修改';
                $where['area_id'] = $this->param['id'];
                $model->update($param,$where);
            }else{
                $model->create($param);
            }
            $this->success($action_name.'成功!', url('/admin/area'));
        } else {
            if (!empty($this->param) && $this->param['id']) {
                $area = AreaModel::get($this->param['id']);
                $this->assign('area', $area);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name', $action_name);
        return view();
    }
    /**
     * 删除地区
     */
    public function remove() {
        if (!empty($this->param) && $this->param['id']) {
            try {
                if (AreaModel::destroy($this->param['id'])) {
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
