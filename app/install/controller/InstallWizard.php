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


namespace app\install\controller;
use app\core\Install;
use think\Request;
/**
 * 安装向导
 * Class InstallWizard
 * @package app\install\controller
 */
abstract class InstallWizard extends InstallBaseController
{
    public function __construct()
    {
        parent::__construct();
        //检查是否安装
        $this->checkInstall();
        $this->checkPrevious();
    }

    /**
     * 检查是否安装，已安装提示
     */
    protected function checkInstall()
    {
        if (Install::checkInstall()) {
            $this->success('安装成功', url('/'), '系统已安装，可正常使用！');
        }
    }
    /**
     * 检查上一步是否合格
     */
    protected function checkPrevious()
    {
        $request = Request::instance();
        $ctrl = strtolower($request->controller());
        $step = array('step2','step3','step4');//只检测这几步
        if(in_array($ctrl, $step)){
            $param = $request->param();
            if(isset($param['checkno'])){
                $pre=intval(str_replace('step','',$ctrl))-1;
                $this->redirect('/install/step'.$pre);
            }
        }
    }
    /**
     * 检查第一步是否合格
     */
    protected function checkStep1(){

    }

}
