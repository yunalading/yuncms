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
/**
 * 配置要求检查配置
 */
return [
    'env' => [
        [
            'name' => 'phpversion',
            'class' => '\app\core\install\check\env\PhpVersionCheck'
        ], [
            'name' => 'os',
            'class' => '\app\core\install\check\env\OsCheck'
        ], [
            'name' => 'gd',
            'class' => '\app\core\install\check\env\GdCheck'
        ], [
            'name' => 'upload',
            'class' => '\app\core\install\check\env\UploadCheck'
        ], [
            'name' => 'disk',
            'class' => '\app\core\install\check\env\DiskCheck'
        ]
    ],
    'file' => [
        [
            'name' => 'runtime',
            'path' => ROOT_PATH . 'runtime'
        ], [
            'name' => 'database',
            'path' => ROOT_PATH . 'app' . DS . 'database.php'
        ], [
            'name' => 'app',
            'path' => ROOT_PATH . 'app' . DS . 'extra' . DS . 'app.php'
        ], [
            'name' => 'data',
            'path' => ROOT_PATH . 'public' . DS . 'data'
        ]
    ],
    'funs' => [
        [
            'name' => 'json',
            'fun' => 'json_encode'
        ], [
            'name' => 'fsocker',
            'fun' => 'fsockopen'
        ]
    ]
];
