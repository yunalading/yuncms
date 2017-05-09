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


namespace app\common\validate;


class BaseLinksValidate extends BaseValidate {
    protected $rule = [
        'link_name' => 'require',
        'link_href' => 'require',
    ];
    protected $message = [
        'link_name.require' => '链接名称必须填写',
        'link_href.require' => '链接地址必须填写',
    ];
}
