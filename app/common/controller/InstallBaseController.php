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

/**
 * Class InstallBaseController
 * @package app\common\controller
 */
abstract class InstallBaseController extends BaseController {
    /**
     * InstallBaseController constructor.
     */
    public function __construct() {
        parent::__construct();
        //检测是否已经安装

    }
}
