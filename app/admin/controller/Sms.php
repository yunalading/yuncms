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

use think\Config;
use app\admin\validate\PhoneValidate;
use app\core\phone\Phone;

/**
 * Class Sms
 * @package app\admin\controller
 */
class Sms extends AdminBaseController {
    /**
     * @return \think\response\View
     */
    public function index() {
//        $phone['number'] = rand(100000, 999999);//验证码
//        $phone['phone'] = 13042701942;
//        $phone['name'] = "卢超";
//        $phone['smsid'] = "SMS_62535144";
//        $smsRes = Phone::send($phone);
//        dump($smsRes);
        if ($this->request->isPost()) {
            $base = $this->post['base'];
            $validate = new PhoneValidate();
            if (!$validate->check($base, [], 'base')) {
                return $this->error($validate->getError());
            }
            $phoneType = strtolower($base['phoneType']);
            $post = $this->post[$phoneType];
            $config_new['base'] = $base;
            $config_new[$phoneType] = $post;
            $sms = config('sms');
            $newConfig = array_merge($sms, $config_new);
            writeJsonConfig(APP_PATH . 'extra' . DS . 'sms.json', $newConfig);
            $this->success('操作成功');
        }
        $basconfig = config('sms.base');
        $config = array_merge($basconfig,config('sms.'.strtolower($basconfig['phoneType'])));
        $this->assign('sms', $config);
        return view();
    }
}
