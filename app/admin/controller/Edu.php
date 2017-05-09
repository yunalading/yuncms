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

use app\admin\model\EduLevelModel;
use app\admin\validate\EduLevelValidate;

/**
 * Class Edu
 * @package app\admin\controller
 */
class Edu extends AdminBaseController {
    /**
     * 文化程度列表
     * @return \think\response\View
     */
    public function index() {
        $eduLevelModel = new EduLevelModel();
        $list = $eduLevelModel->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }
    /**
     * 添加或修改文化程度
     * @return \think\response\View
     */
    public function update() {
        $action_name = '添加';
        $model = new EduLevelModel();
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['edu']);
            $Validate = new EduLevelValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
            if(isset($this->param['id']) && intval($this->param['id'])>0){
                $action_name = '修改';
                $where['edu_level_id'] = intval($this->param['id']);
                $model->update($param,$where);
            }else{
                $model->create($param);
            }
            $this->success($action_name.'成功!', url('/admin/edu'));
        } else {
            if (!empty($this->param) && $this->param['id']) {
                $edu_level = EduLevelModel::get(intval($this->param['id']));
                $this->assign('edu_level', $edu_level);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name', $action_name);
        return view();
    }

    /**
     * 删除文化程度
     */
    public function remove() {
        if (!empty($this->param) && $this->param['id']) {
            try {
                if (EduLevelModel::destroy($this->param['id'])) {
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
