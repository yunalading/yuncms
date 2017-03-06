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
use think\Log;

/**
 * Class AdminBaseController
 * @package app\common\controller
 */
abstract class AdminBaseController extends BaseController {
    protected $allow_actions = [];
    /**
     * AdminBaseController constructor.
     */
    public function __construct() {
        parent::__construct();
        if(!in_array($this->request->action(),$this->allow_actions)){
            //验证是否登录
            Log::debug('验证是否登录');
            echo url($this->request->module().'/'.$this->request->controller().'/'.$this->request->action());
        }
    }

}
