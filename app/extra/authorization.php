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
            'id' => 'content',
            'name' => '内容',
            'submenus' => [
                [
                    'id' => '',
                    'name' => '内容列表',
                    'href' => ''
                ]
            ]
        ], [
            'id' => 'user',
            'name' => '用户',
            'submenus' => [
                [
                    'id' => '',
                    'name' => '用户列表',
                    'href' => ''
                ]
            ]
        ], [
            'id' => 'subject',
            'name' => '专题',
            'submenus' => [
                [
                    'id' => '',
                    'name' => '专题列表',
                    'href' => ''
                ]
            ]
        ], [
            'id' => 'category',
            'name' => '分类',
            'submenus' => [
                [
                    'id' => '',
                    'name' => '分类列表',
                    'href' => ''
                ]
            ]
        ], [
            'id' => 'model',
            'name' => '模型',
            'submenus' => [
                [
                    'id' => '',
                    'name' => '模型列表',
                    'href' => ''
                ]
            ]
        ], [
            'id' => 'tag',
            'name' => '标签',
            'submenus' => [
                [
                    'id' => '',
                    'name' => '标签列表',
                    'href' => ''
                ]
            ]
        ], [
            'id' => 'comment',
            'name' => '留言',
            'submenus' => [
                [
                    'id' => '',
                    'name' => '留言列表',
                    'href' => ''
                ]
            ]
        ], [
            'id' => 'ads',
            'name' => '广告',
            'submenus' => [
                [
                    'id' => '',
                    'name' => '普通广告',
                    'href' => ''
                ], [
                    'id' => '',
                    'name' => '脚本广告',
                    'href' => ''
                ], [
                    'id' => '',
                    'name' => '幻灯片',
                    'href' => ''
                ]
            ]
        ], [
            'id' => 'system',
            'name' => '系统',
            'submenus' => [
                [
                    'id' => '',
                    'name' => '基本信息',
                ], [
                    'id' => 'nav',
                    'name' => '导航管理',
                ], [
                    'id' => '',
                    'name' => '邮件配置',
                ], [
                    'id' => '',
                    'name' => '短信配置',
                ], [
                    'id' => '',
                    'name' => '集成登录',
                    'submenus' => [
                        [
                            'id' => '',
                            'name' => 'QQ',
                            'href' => ''
                        ], [
                            'id' => '',
                            'name' => '微信',
                            'href' => ''
                        ], [
                            'id' => '',
                            'name' => '新浪微博',
                            'href' => ''
                        ]
                    ]
                ], [
                    'id' => '',
                    'name' => '权限管理',
                    'submenus' => [
                        [
                            'id' => '',
                            'name' => '管理员',
                            'href' => ''
                        ], [
                            'id' => '',
                            'name' => '角色',
                            'href' => ''
                        ]
                    ]
                ], [
                    'id' => '',
                    'name' => '地区管理',
                ], [
                    'id' => '',
                    'name' => '图片管理',
                ], [
                    'id' => '',
                    'name' => '上传设置',
                ], [
                    'id' => '',
                    'name' => '常量管理',
                ], [
                    'id' => '',
                    'name' => '友情链接',
                ]
            ]
        ]
    ]
];
