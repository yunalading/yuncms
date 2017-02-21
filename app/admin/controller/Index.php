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

use app\common\controller\AdminBaseController;

/**
 * Class Index 默认控制器
 * @package app\admin\controller
 */
class Index extends AdminBaseController {
    /**
     * 默认首页
     */
    public function index() {
        $this->redirect(url('/admin/user/login'));
    }
}
