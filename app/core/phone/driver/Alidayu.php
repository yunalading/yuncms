<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: chenqianhao <68527761@qq.com>
// +----------------------------------------------------------------------

namespace app\core\phone\driver;

use think\Exception;
use think\Config;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Requests\IRequest;

/**
 * 阿里大于短信驱动
 */
class Alidayu
{
    /**
     * 短信发送接口
     * @access public
     * @param array $phone 短信参数
     * @return bool
     */
    public function send(array $phone = [], $conf = [])
    {
        $config = config('sms.alidayu');
        if (isset($conf) && is_array($conf)) {
            $conf = array_merge($config, $conf);
        } else {
            $conf = $config;
        }
        $newConf = array_merge(config('sms.base'), $conf);
        $client = new Client(new App($newConf));
        $req = new AlibabaAliqinFcSmsNumSend;
        $req->setRecNum($phone['sms'])
            ->setSmsParam($phone)
            ->setSmsFreeSignName($newConf['signname'])
            ->setSmsTemplateCode($phone['smsid']);
        $resp = $client->execute($req);

        // 返回结果
        return $resp;
    }
}
