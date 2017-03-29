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
use app\admin\model\TagModel;
use app\admin\validate\TagValidate;

/**
 * Class Tag
 * @package app\admin\controller
 */
class Tag extends AdminBaseController {
    /**
     * 标签列表
     * @return \think\response\View
     */
    public function index() {
        $areaModel = new TagModel();
        $list = $areaModel->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }
    /**
     * 修改/添加标签
     */
    public function edit() {
        $action_name = '添加';
        $model = new TagModel();
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['tag']);
            $Validate = new TagValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
            if(isset($this->param['id']) && $this->param['id']){
                $action_name = '修改';
                $where['tag_id'] = $this->param['id'];
                $model->update($param,$where);
            }else{
                $model->create($param);
            }
            $this->success($action_name.'成功!', url('/admin/tag'));
        } else {
            if (!empty($this->param) && $this->param['id']) {
                $tag = TagModel::get($this->param['id']);
                $this->assign('tag', $tag);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name', $action_name);
        return view();
    }
    /**
     * 删除标签
     */
    public function remove() {
        if (!empty($this->param) && $this->param['id']) {
            try {
                if (TagModel::destroy($this->param['id'])) {
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
