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
            'iconClass'=>'am-icon-dashboard',
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
            'iconClass'=>'am-icon-file-o',
            'submenus' => [
                [
                    'id' => 'content-list',
                    'name' => '内容列表',
                    'href' => '/admin/content',
                    'actives'=>[
                        [
                            'name'=>'删除',
                            'href'=>'/admin/content/del'
                        ],[
                            'name'=>'编辑',
                            'href'=>'/admin/content/edit'
                        ],
                    ]
                ],[
                    'id'=>'',
                    'name'=>'评论',
                    'href'=>'/admin/comment'
                ]
            ]
        ], [
            'id' => 'user',
            'name' => '用户',
            'iconClass'=>'am-icon-users',
            'submenus' => [
                [
                    'id' => 'user-list',
                    'name' => '用户列表',
                    'href' => ''
                ]
            ]
        ], [
            'id' => 'subject',
            'name' => '专题',
            'iconClass'=>'am-icon-circle-o',
            'submenus' => [
                [
                    'id' => 'subject-list',
                    'name' => '专题列表',
                    'href' => ''
                ]
            ]
        ], [
            'id' => 'category',
            'name' => '分类',
            'iconClass'=>'am-icon-flag',
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
            'iconClass'=>'am-icon-reorder',
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
            'iconClass'=>'am-icon-tags',
            'submenus' => [
                [
                    'id' => '',
                    'name' => '标签列表',
                    'href' => ''
                ]
            ]
        ], [
            'id' => 'message',
            'name' => '留言',
            'iconClass'=>'am-icon-comment-o',
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
            'iconClass'=>'am-icon-adn',
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
            'iconClass'=>'am-icon-cog',
            'submenus' => [
                [
                    'id' => '',
                    'name' => '基本信息',
                ], [
                    'id' => 'nav-manager',
                    'name' => '导航管理',
                ], [
                    'id' => 'email-config',
                    'name' => '邮件配置',
                ], [
                    'id' => 'sms-config',
                    'name' => '短信配置',
                ], [
                    'id' => 'oauth-login',
                    'name' => '集成登录',
                    'submenus' => [
                        [
                            'id' => 'qq-login',
                            'name' => 'QQ',
                            'href' => ''
                        ], [
                            'id' => 'wechat-login',
                            'name' => '微信',
                            'href' => ''
                        ], [
                            'id' => 'sina-weibo-login',
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
                    'id' => 'area-manager',
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
