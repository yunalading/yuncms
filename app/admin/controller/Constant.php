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

use app\admin\validate\ConstantValidate;

/**
 * Class Constant
 * @package app\admin\controller
 */
class Constant extends AdminBaseController {
    //protected $config_path = APP_PATH .'extra' . DS .'custom.json';

    /**
     * 常量列表
     * @return \think\response\View
     */
    public function index() {
        $list = config('custom');
        $this->assign('list', $list);
        return view();
    }

    /**
     * 添加或更改常量
     * @return \think\response\View
     */
    public function update() {
        $action_name = '添加';
        $list = config('custom');
        if ($this->request->isPost()) {
            $con_data = array_filter($this->post['con']);
            $constantValidate = new ConstantValidate();
            if (!$constantValidate->check($con_data, [], 'update')) {
                $this->error($constantValidate->getError());
            }
            $arr = [
                $con_data['key'] => $con_data['val']
            ];
            $newConstant = array_merge($list, $arr);
            writeJsonConfig($this->config_path, $newConstant);
            $this->success('操作成功', url('/admin/constant'));
        } else {
            if (key_exists('key', $this->param)) {
                $key = $this->param['key'];
                if ($key) {
                    if (key_exists($key, $list)) {
                        $this->assign('val', $list[$key]);
                    }
                    $this->assign('key', $key);
                    $action_name = '编辑';
                }
            }
        }
        $this->assign('action_name', $action_name);
        return view();
    }

    /**
     * 删除常量
     */
    public function remove() {
        $key = $this->param['key'];
        $list = config('custom');
        if ($key) {
            if (key_exists($key, $list)) {
                unset($list[$key]);
                writeJsonConfig($this->config_path, $list);
                $this->success('操作成功!');
            }
        } else {
            $this->error('参数错误!');
        }
    }
}
