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

use app\common\controller\BaseController;
use app\common\model\BaseUserModel;
use app\core\rbac\Access;
use app\core\rbac\Role;
use think\Log;
use think\Config;

/**
 * Class AdminBaseController
 * @package app\common\controller
 */
abstract class AdminBaseController extends BaseController {
    /**
     * 不需要验证登录的action
     * @var array
     */
    protected $allow_actions = [];

    /**
     * AdminBaseController constructor.
     */
    public function __construct() {
        parent::__construct();
        //检查是否已安装
        $this->checkInstall();
        //是否需要登录验证
        if (!in_array($this->request->action(), $this->allow_actions)) {
            //验证是否登录
            Log::debug('验证是否登录');
            if (BaseUserModel::isLogin()) {
                //验证权限
                Log::debug('验证验证权限');
                $role_id = Role::get_role();
                $access_list = Access::get_access($role_id);
                $url = str_replace('.'.Config::get('url_html_suffix'),'',parent::getCurrentAccess());
                //echo $url;
                if (!in_array($url, Config("nocheck"))) {
                    if (!in_array($url, $access_list)) {
                        $this->error('无访问权限!');
                    }
                }
            } else {
                //去登录
                $this->redirect(url('/admin/user/login'));
            }
        }
    }
}
