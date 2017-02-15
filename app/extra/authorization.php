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
    'menus' => [
        [
            'id' => 'command',
            'name' => '控制台',
            'submenus' => [
                [
                    'id' => 'welcome',
                    'name' => '欢迎页面',
                    'href' => '/admin/index/welcome'
                ]
            ]
        ], [
            'id' => 'fdsa',
            'name' => '内容',
            'submenus' => [
                [
                    'id' => 'welcome',
                    'name' => '欢迎页面',
                    'submenus' => [
                        [
                            'id' => 'welcome',
                            'name' => '欢迎页面',
                            'href' => '/admin/index/welcome'
                        ]
                    ]
                ], [
                    'id' => 'welcome',
                    'name' => '欢迎页面',
                    'href' => '/admin/index/welcome'
                ]
            ]
        ], [
            'id'=>'',
            'name'=>'用户',
        ],[
            'id' => '',
            'name' => '专题',
        ], [
            'id' => '',
            'name' => '分类',
        ], [
            'id' => '',
            'name' => '模型',
        ], [
            'id' => '',
            'name' => '标签',
        ],[
            'id'=>'',
            'name'=>'留言',
        ],[
            'id'=>'',
            'name'=>'广告',
        ],[
            'id'=>'',
            'name'=>'系统',
            'submenus'=>[
                [
                    'id'=>'',
                    'name'=>'导航',
                ]
            ]
        ]
    ]
];
