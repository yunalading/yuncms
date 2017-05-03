<?php
// +----------------------------------------------------------------------
// | YunCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://www.yunalading.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: chenqianhao <685277861@qq.com>
// +----------------------------------------------------------------------


namespace app\admin\controller;

use app\admin\model\MenusModel;
use app\admin\model\NavModel;
use app\admin\validate\MenusValidate;

/**
 * Class Menus
 * @package app\admin\controller
 */
class Menus extends AdminBaseController {
    /**
     * 菜单列表
     * @return \think\response\View
     */
    public function index() {
        $linkModel = new MenusModel();
        $list = $linkModel->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }

    /**
     * 添加或修改菜单
     * @return \think\response\View
     */
    public function update() {
        $action_name = '添加';
        $model = new MenusModel();
        $navModule = new NavModel();
        $nav = NavModel::all();
        $this->assign('nav', $nav);
        $menus_all = MenusModel::all();
        $this->assign('menus_all', $menus_all);
        $nav_type = config('nav');
        $this->assign('nav_type', $nav_type);
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['menus']);
            $Validate = new MenusValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
            if (!key_exists('menu_target', $param)) {
                $param['menu_target'] = 0;
            }
            unset($param['__token__']);
            $model->saveAll([$param])[0];
            $this->success($action_name.'成功!', url('/admin/links'));

        } else {
            if (!empty($this->param) && $this->param['id']) {
                $menus = MenusModel::get($this->param['id']);
                $this->assign('menus', $menus);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name', $action_name);
        return view();
    }

    /**
     * 删除菜单
     */
    public function remove() {
        if (!empty($this->param) && $this->param['id']) {
            try {
                if (LinkModel::destroy($this->param['id'])) {
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
