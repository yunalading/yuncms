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
use app\admin\model\CategoryModel;
use app\admin\model\ContentModel;
use app\admin\model\ModelModel;
use app\admin\validate\ContentValidate;

/**
 * Class Content
 * @package app\admin\controller
 */
class Content extends AdminBaseController
{

    /**
     * @return \think\response\View
     */
    public function index()
    {
        $model = new ContentModel();
        $list = $model->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }
    /**
     * @return \think\response\View
     */
    public function edit()
    {
        $action_name = '添加';
        $models = new CategoryModel();
        $cate = $models->putCateOut();
        $this->assign('cate', $cate);
        $model = new ContentModel();
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['content']);
            $Validate = new ContentValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
            if (isset($this->param['id']) && $this->param['id']) {
                $action_name = '修改';
                $where['content_id'] = $this->param['id'];
                $model->update($param, $where);
            } else {
                $param['push_time'] = time();
                $model->create($param);
            }
            $this->success($action_name . '成功!', url('/admin/content'));
        } else {
            if (!empty($this->param) && $this->param['id']) {
                $content = ContentModel::get($this->param['id']);
                $this->assign('content', $content);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name', $action_name);
        return view();
    }

    /**
     * @return \think\response\View
     */
    public function delete(){
        $model = new ContentModel();
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
