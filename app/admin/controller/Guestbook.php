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

use app\admin\model\GuestBookModel;

/**
 * Class Guestbook
 * @package app\admin\controller
 */
class Guestbook extends AdminBaseController {
    /**
     * @return \think\response\View
     */
    public function index() {
        $guestBookModel = new GuestBookModel();
        $list = $guestBookModel->paginate();
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }

    /**
     * 查看留言
     * @return \think\response\View
     */
    public function viewer() {
        if (!empty($this->param) && $this->param['id']) {
            //编辑页面初始化数据
            $guestbook = GuestBookModel::get($this->param['id']);
            $this->assign('guestbook', $guestbook);
        }
        return view();
    }

    /**
     * 删除留言
     */
    public function remove() {
        if (!empty($this->param) && $this->param['id']) {
            try {
                if (GuestBookModel::destroy($this->param['id'])) {
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
