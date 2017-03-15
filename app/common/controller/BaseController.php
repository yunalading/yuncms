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
     * 请求的POST数据
     * @var array|mixed
     */
    protected $post = [];
    /**
     * 请求的数据，用来获取get数据
     * @var array|mixed
     */
    protected $param = [];

    /**
     * BaseController constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->post = $this->request->post();
        $this->param = $this->request->param();
    }

    /**
     * 获取当前请求资源
     * @return string
     */
    protected function getCurrentAccess() {
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
