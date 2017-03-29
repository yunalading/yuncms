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
use app\admin\model\NavModel;
use app\admin\validate\NavValidate;

/**
 * Class Nav
 * @package app\admin\controller
 */
class Nav extends AdminBaseController {
    /**
     * @return \think\response\View
     */
    public function index() {
        $navModel = new NavModel();
        $list = $navModel->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }

    /**
     * 添加或修改导航
     * @return \think\response\View
     */
    public function edit() {
        $action_name = '添加';
        $model = new NavModel();
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['nav']);
            $Validate = new NavValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
            $model->create($param);
            $this->success($action_name.'成功!', url('/admin/nav'));

        } else {
            if (!empty($this->param) && $this->param['nav_key']) {
                $nav = NavModel::get(trim($this->param['nav_key']));
                $this->assign('nav', $nav);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name', $action_name);
        return view();
    }

    /**
     * 删除留言
     */
    public function remove() {
        if (!empty($this->param) && $this->param['nav_key']) {
            try {
                if (NavModel::destroy($this->param['nav_key'])) {
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
