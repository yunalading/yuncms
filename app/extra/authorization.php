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
            'id' => 'dashboard',
            'name' => '控制台',
            'iconClass' => 'am-icon-dashboard',
            'submenus' => [
                [
                    'id' => 'welcome',
                    'name' => '系统信息',
                    'href' => '/admin/system'
                ]
            ]
        ], [
            'id' => 'content',
            'name' => '内容',
            'iconClass' => 'am-icon-file-o',
            'submenus' => [
                [
                    'id' => 'content-list',
                    'name' => '内容列表',
                    'href' => '/admin/content',
                    'actives' => [
                        [
                            'name' => '删除',
                            'href' => '/admin/content/del'
                        ], [
                            'name' => '编辑',
                            'href' => '/admin/content/edit'
                        ],
                    ]
                ], [
                    'id' => 'comment',
                    'name' => '评论',
                    'href' => '/admin/comment'
                ]
            ]
        ], [
            'id' => 'member',
            'name' => '用户',
            'iconClass' => 'am-icon-users',
            'submenus' => [
                [
                    'id' => 'member-list',
                    'name' => '用户列表',
                    'href' => '/admin/member'
                ]
            ]
        ], [
            'id' => 'page',
            'name' => '页面',
            'iconClass' => 'am-icon-circle-o',
            'submenus' => [
                [
                    'id' => 'page-list',
                    'name' => '页面列表',
                    'href' => '/admin/page'
                ]
            ]
        ], [
            'id' => 'category',
            'name' => '分类',
            'iconClass' => 'am-icon-flag',
            'submenus' => [
                [
                    'id' => 'category-list',
                    'name' => '分类列表',
                    'href' => '/admin/category'
                ]
            ]
        ], [
            'id' => 'model',
            'name' => '模型',
            'iconClass' => 'am-icon-reorder',
            'submenus' => [
                [
                    'id' => 'model-list',
                    'name' => '模型列表',
                    'href' => '/admin/model'
                ]
            ]
        ], [
            'id' => 'tag',
            'name' => '标签',
            'iconClass' => 'am-icon-tags',
            'submenus' => [
                [
                    'id' => 'tag-list',
                    'name' => '标签列表',
                    'href' => '/admin/tag'
                ]
            ]
        ], [
            'id' => 'guestbook',
            'name' => '留言',
            'iconClass' => 'am-icon-comment-o',
            'submenus' => [
                [
                    'id' => 'guestbook-list',
                    'name' => '留言列表',
                    'href' => '/admin/guestbook'
                ]
            ]
        ], [
            'id' => 'ads',
            'name' => '广告',
            'iconClass' => 'am-icon-adn',
            'submenus' => [
                [
                    'id' => 'ad-general',
                    'name' => '普通广告',
                    'href' => '/admin/ad/general'
                ], [
                    'id' => 'ad-script',
                    'name' => '脚本广告',
                    'href' => '/admin/ad/script'
                ], [
                    'id' => 'ad-slide',
                    'name' => '幻灯片',
                    'href' => '/admin/ad/slide'
                ]
            ]
        ], [
            'id' => 'system',
            'name' => '系统',
            'iconClass' => 'am-icon-cog',
            'submenus' => [
                [
                    'id' => 'system-general',
                    'name' => '基本信息',
                    'href' => '/admin/system/general'
                ], [
                    'id' => 'nav-manager',
                    'name' => '导航管理',
                    'href' => '/admin/nav'
                ], [
                    'id' => 'email-config',
                    'name' => '邮件配置',
                    'href' => '/admin/email'
                ], [
                    'id' => 'sms-config',
                    'name' => '短信配置',
                    'href' => '/admin/sms'
                ], [
                    'id' => 'oauth-login',
                    'name' => '集成登录',
                    'submenus' => [
                        [
                            'id' => 'qq-login',
                            'name' => 'QQ',
                            'href' => '/admin/oauth/qq'
                        ], [
                            'id' => 'wechat-login',
                            'name' => '微信',
                            'href' => '/admin/oauth/wechat'
                        ], [
                            'id' => 'sina-weibo-login',
                            'name' => '新浪微博',
                            'href' => '/admin/oauth/weibo'
                        ]
                    ]
                ], [
                    'id' => 'auth',
                    'name' => '权限管理',
                    'submenus' => [
                        [
                            'id' => 'user',
                            'name' => '管理员',
                            'href' => '/admin/user'
                        ], [
                            'id' => 'role',
                            'name' => '角色',
                            'href' => '/admin/role'
                        ]
                    ]
                ], [
                    'id' => 'area-manager',
                    'name' => '地区管理',
                    'href' => '/admin/area'
                ], [
                    'id' => 'images',
                    'name' => '图片管理',
                    'href' => '/admin/images'
                ], [
                    'id' => 'upload',
                    'name' => '上传设置',
                    'href' => '/admin/upload'
                ], [
                    'id' => 'constant',
                    'name' => '常量管理',
                    'href' => '/admin/constant'
                ], [
                    'id' => 'links',
                    'name' => '友情链接',
                    'href' => '/admin/links'
                ]
            ]
        ]
    ]
];
