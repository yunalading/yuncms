<?php
// +----------------------------------------------------------------------
// | YunCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://www.yunalading.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: jabber <2898117012@qq.com>
// +----------------------------------------------------------------------


namespace app\admin\controller;

use app\admin\model\LinkModel;
use app\common\model\BaseLinkModel;

/**
 * Class Links
 * @package app\admin\controller
 */
class Links extends AdminBaseController {
    /**
     * 友情链接列表
     * @return \think\response\View
     */
    public function index() {
        $linkModel = new LinkModel();
        $list = $linkModel->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }

    /**
     * 添加或修改友情链接
     * @return \think\response\View
     */
    public function update() {
        $action_name = '添加';
        if ($this->request->isPost()) {

        } else {
            if (!empty($this->param) && $this->param['id']) {

                $action_name = '编辑';
            }
        }
        $this->assign('targets', BaseLinkModel::$targets);
        $this->assign('action_name', $action_name);
        return view();
    }

    /**
     * 删除友情链接
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
