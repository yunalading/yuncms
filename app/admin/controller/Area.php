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

use app\admin\model\AreaModel;
use think\exception\PDOException;

/**
 * Class Area
 * @package app\admin\controller
 */
class Area extends AdminBaseController {
    /**
     * 地区列表
     * @return \think\response\View
     */
    public function index() {
        $areaModel = new AreaModel();
        $list = $areaModel->order('area_sort desc')->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }

    public function update() {

        return view();
    }

    public function remove() {
        if (!empty($this->param) && $this->param['id']) {
            try {
                if (AreaModel::destroy($this->param['id'])) {
                    $this->success('删除成功!');
                } else {
                    $this->error('删除失败!');
                }
            } catch (PDOException $e) {
                $this->error($e->getMessage());
            }
        } else {
            $this->error('参数错误!');
        }
    }
}
