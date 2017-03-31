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

use app\admin\model\AdTextModel;
use app\admin\model\AdCodeModel;
use app\admin\model\AdImagesModel;
use app\admin\validate\AdTextValidate;
use app\admin\validate\AdCodeValidate;
use app\admin\validate\AdImagesValidate;
use think\exception\PDOException;
use think\Log;
/**
 * Class Ad
 * @package app\admin\controller
 */
class Ad extends AdminBaseController
{
    /**
     * 普通广告列表
     * @return \think\response\View
     */
    public function general()
    {
        $adTextModel = new AdTextModel();
        if (isset($this->param['keyword']) && trim($this->param['keyword']) != '') {
            $keyword = trim($this->param['keyword']);
            $list = $adTextModel->whereLike("title", '%' . $keyword . '%', 'or')->paginate();
        } else {
            $list = $adTextModel->paginate();
        }
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }

    /*
     * 添加/修改普通广告
     */
    public function generaledit()
    {
        $action_name = '添加';
        $model = new AdTextModel();
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['adtext']);
            $Validate = new AdTextValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
            if (isset($this->param['id']) && $this->param['id']) {
                $action_name = '修改';
                $where['ad_text_key'] = $this->param['id'];
                $model->update($param, $where);
            } else {
                $model->create($param);
            }
            $this->success($action_name . '成功!', url('/admin/ad/general'));
        } else {
            if (!empty($this->param) && $this->param['id']) {
                $adtext = AdTextModel::get($this->param['id']);
                $this->assign('adtext', $adtext);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name', $action_name);
        return view();
    }


    /**
     * 软删除
     */
    public function remove()
    {
        if(isset($this->param) && $this->param['style']){
            switch ($this->param['style']){
                case 'general':
                    $model = new AdTextModel();
                    break;
                case 'script':
                    $model = new AdCodeModel();
                    break;
                case 'slide':
                    $model = new AdImagesModel();
                    break;
                default:
                    $model = new AdTextModel();
            }
            $this->delete(false, $model);
        }else{
            $this->error('参数错误!');
        }
    }

    /**
     * 真删除
     */
    public function destroy($model)
    {
        $this->delete(true,$model);
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
        if(isset($this->param) && $this->param['style']){
            switch ($this->param['style']){
                case 'general':
                    $model = new AdTextModel();
                    $tpl = 'generaldelete';
                    break;
                case 'script':
                    $model = new AdCodeModel();
                    $tpl = 'scriptdelete';
                    break;
                case 'slide':
                    $model = new AdImagesModel();
                    $tpl = 'slidedelete';
                    break;
                default:
                    $model = new AdTextModel();
                    $tpl = 'generaldelete';
            }
            $list = $model::onlyTrashed()->paginate();
            $page = $list->render();
            $this->assign('list', $list);
            $this->assign('page', $page);
            return view($tpl);
        }else{
            $this->error('参数错误!');
        }
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


    /**
     * 脚本广告列表
     * @return \think\response\View
     */
    public function script()
    {
        $adCodeModel = new AdCodeModel();
        if (isset($this->param['keyword']) && trim($this->param['keyword']) != '') {
            $keyword = trim($this->param['keyword']);
            $list = $adCodeModel->whereLike("ad_name", '%' . $keyword . '%', 'or')->paginate();
        } else {
            $list = $adCodeModel->paginate();
        }
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }

    /**
     * 幻灯片广告列表
     * @return \think\response\View
     */
    public function slide()
    {
        $adImagesModel = new AdImagesModel();
        if (isset($this->param['keyword']) && trim($this->param['keyword']) != '') {
            $keyword = trim($this->param['keyword']);
            $list = $adImagesModel->whereLike("title", '%' . $keyword . '%', 'or')->paginate();
        } else {
            $list = $adImagesModel->paginate();
        }
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }


    public function scriptedit()
    {
        $action_name = '添加';
        $model = new AdCodeModel();
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['adcode']);
            $Validate = new AdTextValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
            if (isset($this->param['id']) && $this->param['id']) {
                $action_name = '修改';
                $where['ad_code_key'] = $this->param['id'];
                $model->update($param, $where);
            } else {
                $model->create($param);
            }
            $this->success($action_name . '成功!', url('/admin/ad/script'));
        } else {
            if (!empty($this->param) && $this->param['id']) {
                $adcode = AdCodeModel::get($this->param['id']);
                $this->assign('adcode', $adcode);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name', $action_name);
        return view();
    }

    public function slideedit()
    {
        $action_name = '添加';
        $model = new AdImagesModel();
        if ($this->request->isPost()) {
            //验证数据
            $param = array_filter($this->post['adimages']);
            $Validate = new AdTextValidate();
            if (!$Validate->check($param, [], 'update')) {
                $this->error($Validate->getError());
            }
            if (isset($this->param['id']) && $this->param['id']) {
                $action_name = '修改';
                $where['ad_img_key'] = $this->param['id'];
                $model->update($param, $where);
            } else {
                $model->create($param);
            }
            $this->success($action_name . '成功!', url('/admin/ad/slide'));
        } else {
            if (!empty($this->param) && $this->param['id']) {
                $adimages = AdImagesModel::get($this->param['id']);
                $this->assign('adimages', $adimages);
                $action_name = '编辑';
            }
        }
        $this->assign('action_name', $action_name);
        return view();
    }

//    public function generaldelete()
//    {
//        return view();
//    }
//
//    public function scriptdelete()
//    {
//        return view();
//    }
//
//    public function slidedelete()
//    {
//        return view();
//    }
}
