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
return [
    'default_controller' => 'Dashboard',
    'dispatch_success_tmpl' => APP_PATH . 'admin' . DS . 'view' . DS . 'dispatch_jump.html',
    'dispatch_error_tmpl' => APP_PATH . 'admin' . DS . 'view' . DS . 'dispatch_jump.html',
    'template' => [
        'view_depr' => DS,
    ],
    'paginate' => [
        'type' => 'app\core\paginator\AmazeUI',
        'var_page' => 'page',
        'list_rows' => 15,
    ],

];
