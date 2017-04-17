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

use app\admin\model\ModelAttrModel;
use app\admin\model\ModelModel;
use app\admin\validate\ModelAttrValidate;
use app\admin\validate\ModelValidate;
use think\Config;

/**
 * Class Model
 * @package app\admin\controller
 */
class Model extends AdminBaseController
{
    /**
     * @return \think\response\View
     */
    public function index()
    {
        $Model = new ModelModel();
        if (isset($this->param['keyword']) && trim($this->param['keyword']) != '') {
            $keyword = trim($this->param['keyword']);
            $list = $Model->whereLike("model_name", '%' . $keyword . '%', 'and')->paginate();
        } else {
            $list = $Model->paginate();
        }
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }

    public function edit()
    {
        $action_name = '添加';
        $model = new ModelModel();
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['model']);
            $Validate = new ModelValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
            if (isset($this->param['id']) && $this->param['id']) {
                $action_name = '修改';
                $where['model_id'] = $this->param['id'];
                $model->update($param, $where);
            } else {
                $model->create($param);
            }
            $this->success($action_name . '成功!', url('/admin/model'));
        } else {
            if (!empty($this->param) && $this->param['id']) {
                $model = ModelModel::get($this->param['id']);
                $this->assign('model', $model);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name', $action_name);
        return view();
    }

    public function attr()
    {
        //判断模型是否存在
        if (!empty($this->param) && $this->param['id']) {
            $attr = ModelModel::get($this->param['id']);
            if (empty($attr)) {
                $this->error('该模型不存在!', url('/admin/model'));
            }
            $model_attr = ModelAttrModel::get(array("model_id" => $this->param['id']));
            $this->assign('model_attr', $model_attr);
            //$this->assign('model_id', $this->param['id']);
            $config = config('model_attr');
            $this->assign('attr_config', $config);

            if ($this->request->isPost()) {
                //验证数据
                $post = $this->post['attr'];
                $param = array_filter($post[$post[$config[$post['type']]]]);
                $Validate = new ModelAttrValidate();
                if (!$Validate->check($param, [], 'update')) {
                    $this->error($Validate->getError());
                }
                if (isset($this->param['attr_id']) && $this->param['attr_id']) {
                    $attr_one = ModelAttrModel::get($this->param['attr_id']);
                    $this->assign('attr_one', $attr_one);
                    $where['id'] = $this->param['attr_id'];
                    $model->update($param, $where);
                } else {
                    $model->create($param);
                }
                $this->success('属性修改成功!', url('/admin/model/attr'), array('id' => $this->param['id'], 'attr_id' => $this->param['attr_id']));
            }
            return view();
        } else {
            $this->error('该模型不存在!', url('/admin/model'));
        }
    }

    public function get_model_attr()
    {
        return json_encode(Config::get('model_attr'));
    }

    /**
     * 软删除
     */
    public function remove()
    {
        $model = new ModelModel();
        $this->delete(false, $model);
    }

    /**
     * 真删除
     */
    public function destroy($model)
    {
        $this->delete(true, $model);
    }

    /**
     * 清空回收站
     */
    public function emptyTrash($model)
    {
        try {
            $model::onlyTrashed()->delete(true);
            $this->success('操作成功!');
        } catch (PDOException $e) {
            Log::error($e);
            $this->error('清空失败!');
        }
    }

    /**
     * 删除
     * @param bool $flag 是否真删除
     * @param string $model 模型名
     */
    private function delete($flag = false, $model)
    {
        if (!empty($this->param) && $this->param['id']) {
            try {
                if ($model::destroy($this->param['id'], $flag)) {
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

    /**
     * 回收站
     * @return \think\response\View
     */
    public function trash()
    {
        $model = new ModelModel();
        $list = $model::onlyTrashed()->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }

    /**
     * 恢复
     */
    public function recovery($model)
    {
        if (!empty($this->param) && $this->param['id']) {
            try {
                $user = $model::onlyTrashed()->find($this->param['id']);
                if ($user->restore()) {
                    $this->success('恢复成功!');
                } else {
                    $this->error('恢复失败!');
                }
            } catch (PDOException $e) {
                Log::error($e);
                $this->error('恢复失败!');
            }
        } else {
            $this->error('参数错误!');
        }
    }

}
