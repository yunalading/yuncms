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

namespace app\core\upload\driver;

use think\Exception;
use app\core\phone\Phone;
/**
 * 云之讯短信接口
 */
class Ucpaas
{
    /**
     * 短信发送接口
     * @access public
     * @param array $phone 短信信息
     * @return bool
     */
    public function send(array $phone = [], $conf = [])
    {
        $config = config('phone.ucpaas');
        if (isset($conf) && is_array($conf)) {
            $conf = array_merge($config, $conf);
        } else {
            $conf = $config;
        }
        $newConf = array_merge(config('sms.base'), $conf);

        //$resp = UcpaasSms::templateSMS('9635', '123456,3', '18671418772');

        // 返回结果
        return $resp;
    }

}
