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
use app\admin\model\CommentModel;

/**
 * Class Comment
 * @package app\admin\controller
 */
class Comment extends AdminBaseController {
    /**
     * @return \think\response\View
     */
    public function index() {
        $model = new CommentModel();
        $list = $model->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }
    /**
     * 删除标签
     */
    public function remove() {
        if (!empty($this->param) && $this->param['id']) {
            try {
                if (CommentModel::destroy($this->param['id'])) {
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
