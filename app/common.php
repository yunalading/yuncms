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

// 应用公共文件


function write_config(){

}


/**
 * Url生成
 * @param string $url 路由地址
 * @param string|array $value 变量
 * @param bool|string $suffix 前缀
 * @param bool|string $domain 域名
 * return string
 */
function U($url = '', $vars = '', $suffix = true, $domain = false)
{
    return \think\Url::build($url, $vars, $suffix, $domain);
}
