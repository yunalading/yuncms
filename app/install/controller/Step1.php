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


namespace app\install\controller;

use app\core\Install;
use think\Log;


/**
 * Class Complete
 * @package app\install\controller
 */
class Step1 extends InstallWizard {
    /**
     * @return \think\response\View
     */
    public function index() {
        //print_r(get_loaded_extensions());
        //echo extension_loaded('PDO')?'yes':'no';
        $info=Install::checkStep1();
        $this->assign('info',$info);
        Log::debug("安装第一步");
        return view();
    }
}
