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

namespace app\common\controller;

use app\core\Install;
use think\Controller;

/**
 * Class BaseController
 * @package app\common\controller
 */
abstract class BaseController extends Controller {
    /**
     * BaseController constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 获取当前请求URL
     * @return string
     */
    protected function getCurrentRequestURL() {
        return url($this->request->module() . '/' . $this->request->controller() . '/' . $this->request->action());
    }

    /**
     * 检查是否已安装，未安装进入安装流程。
     */
    protected function checkInstall() {
        if (!Install::checkInstall()) {
            $this->redirect(url('/install'));
        }
    }
}
