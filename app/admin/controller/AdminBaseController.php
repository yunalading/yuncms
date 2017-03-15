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

use app\common\controller\BaseController;
use think\Config;
use think\Log;

/**
 * Class AdminBaseController
 * @package app\common\controller
 */
abstract class AdminBaseController extends BaseController {
    /**
     * AdminBaseController constructor.
     */
    public function __construct() {
        parent::__construct();
        //检查是否已安装
        $this->checkInstall();
        //url去除伪静态后缀
        $url = str_replace(".".config('url_html_suffix'),"",$this->request->url());
        //无需验证登录的控制器
        $notlogin = config('notlogin');
        //是否需要登录验证
        if (!in_array($url,$notlogin)) {
            //验证是否登录
            Log::debug('验证是否登录');
            if (!session('islogin')) {
                $this->redirect(url('/admin/user/login'));
            }
        }
    }

}
