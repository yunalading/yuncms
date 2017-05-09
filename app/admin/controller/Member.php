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
use app\admin\model\MemberModel;

/**
 * Class Member
 * @package app\admin\controller
 */
class Member extends AdminBaseController {
    /**
     * @return \think\response\View
     */
    public function index() {
        $Model = new MemberModel();
        if (isset($this->param['keyword']) && trim($this->param['keyword']) != '') {
            $keyword = trim($this->param['keyword']);
            $list = $Model->whereLike("username", '%' . $keyword . '%', 'and')->paginate();
        } else {
            $list = $Model->paginate();
        }
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return view();
    }
}
