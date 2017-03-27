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


namespace app\install\validate;

use app\common\validate\BaseValidate;

/**
 * Class DbValidate
 * @package app\install\validate
 */
class DbValidate extends BaseValidate {
    protected $rule = [
        'hostname' => 'require',
        'database' => 'require',
        'username' => 'require',
        'prefix' => 'require',
        'hostport' => 'require|integer'
    ];
    protected $message = [
        'hostname.require' => '请填写数据库服务器',
        'database.require' => '请填写数据库名称',
        'username.require' => '请填写数据库用户名',
        'prefix.require' => '请填写数据库表前缀',
        'hostport.require' => '请填写数据库端口号',
        'hostport.integer' => '请正确填写数据库端口号'
    ];
    protected $scene = [
        'install' => [
            'hostname' => 'require|token',
            'database' => 'require',
            'username' => 'require',
            'prefix' => 'require',
            'hostport' => 'require|integer'
        ]
    ];
}
