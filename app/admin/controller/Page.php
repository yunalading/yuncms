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
use app\admin\model\ModelModel;
use app\admin\model\PageModel;
use app\admin\validate\PageValidate;

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
        $model = new PageModel();
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['page']);
            $Validate = new PageValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
            if (!key_exists('cover', $param)) {
                $param['cover'] = '';
            }
            if (isset($this->param['id']) && $this->param['id']) {
                $action_name = '修改';
                $where['page_id'] = $this->param['id'];
                $model->update($param, $where);
            } else {
                $model->create($param);
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
