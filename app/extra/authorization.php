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
                    'href' => '/admin/system/index',
                    'actives' => [
                        [
                            'name' => '清除缓存',
                            'href' => '/admin/system/clear'
                        ]
                    ]
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
                    'href' => '/admin/content/index',
                    'actives' => [
                        [
                            'name' => '删除',
                            'href' => '/admin/content/delete'
                        ], [
                            'name' => '添加/编辑',
                            'href' => '/admin/content/edit'
                        ],
                    ]
                ], [
                    'id' => 'comment',
                    'name' => '评论',
                    'href' => '/admin/comment/index',
                    'actives' => [
                        [
                            'name' => '删除',
                            'href' => '/admin/comment/delete'
                        ], [
                            'name' => '编辑',
                            'href' => '/admin/comment/edit'
                        ],
                    ]
                ]
            ]
        ],[
            'id' => 'page',
            'name' => '页面',
            'iconClass' => 'am-icon-circle-o',
            'submenus' => [
                [
                    'id' => 'page-list',
                    'name' => '页面列表',
                    'href' => '/admin/page/index',
                    'actives' => [
                        [
                            'name' => '删除',
                            'href' => '/admin/page/delete'
                        ], [
                            'name' => '添加/编辑',
                            'href' => '/admin/page/edit'
                        ],
                    ]
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
                    'href' => '/admin/category/index',
                    'actives' => [
                        [
                            'name' => '删除',
                            'href' => '/admin/category/remove'
                        ], [
                            'name' => '添加/编辑',
                            'href' => '/admin/category/edit'
                        ],
                    ]
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
                    'href' => '/admin/model/index',
                    'actives' => [
                        [
                            'name' => '删除模型',
                            'href' => '/admin/model/remove'
                        ], [
                            'name' => '添加/编辑模型',
                            'href' => '/admin/model/edit'
                        ], [
                            'name' => '模型属性列表',
                            'href' => '/admin/model/attr'
                        ], [
                            'name' => '删除模型属性',
                            'href' => '/admin/model/attrdelete'
                        ], [
                            'name' => '添加/编辑模型属性',
                            'href' => '/admin/model/attrupdate'
                        ],
                    ]
                ]
            ]
        ], [
            'id' => 'memeber',
            'name' => '前台用户',
            'iconClass' => 'am-icon-group',
            'submenus' => [
                [
                    'id' => 'member-list',
                    'name' => '用户列表',
                    'href' => '/admin/member/index'
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
                    'href' => '/admin/tag/index',
                    'actives' => [
                        [
                            'name' => '删除',
                            'href' => '/admin/tag/remove'
                        ], [
                            'name' => '添加/编辑',
                            'href' => '/admin/tag/edit'
                        ],
                    ]
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
                    'href' => '/admin/guestbook/index'
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
                    'href' => '/admin/ad/general',
                    'actives' => [
                        [
                            'name' => '删除',
                            'href' => '/admin/ad/remove'
                        ], [
                            'name' => '添加/编辑',
                            'href' => '/admin/ad/generaledit'
                        ],
                    ]
                ], [
                    'id' => 'ad-script',
                    'name' => '脚本广告',
                    'href' => '/admin/ad/script',
                    'actives' => [
                         [
                            'name' => '添加/编辑',
                            'href' => '/admin/ad/scriptedit'
                         ],
                    ]
                ], [
                    'id' => 'ad-slide',
                    'name' => '幻灯片',
                    'href' => '/admin/ad/slide',
                    'actives' => [
                        [
                            'name' => '添加/编辑',
                            'href' => '/admin/ad/slideedit'
                        ],
                    ]
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
                    'href' => '/admin/nav/index',
                    'actives' => [
                        [
                            'name' => '删除',
                            'href' => '/admin/nav/remove'
                        ], [
                            'name' => '添加/编辑',
                            'href' => '/admin/nav/edit'
                        ]
                    ]
                ], [
                    'id' => 'menus-manager',
                    'name' => '菜单管理',
                    'href' => '/admin/menus/index',
                    'actives' => [
                        [
                            'name' => '删除',
                            'href' => '/admin/menus/remove'
                        ], [
                            'name' => '添加/编辑',
                            'href' => '/admin/menus/update'
                        ]
                    ]
                ], [
                    'id' => 'email-config',
                    'name' => '邮件配置',
                    'href' => '/admin/email/index',
                    'actives' => [
                        [
                            'name' => '测试邮件',
                            'href' => '/admin/email/testmail'
                        ], [
                            'name' => '发送邮件',
                            'href' => '/admin/email/sendEmail'
                        ]
                    ]
                ], [
                    'id' => 'sms-config',
                    'name' => '短信配置',
                    'href' => '/admin/sms/index'
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
                            'href' => '/admin/user/index',
                            'actives' => [
                                [
                                    'id' => 'user-update',
                                    'name' => '编辑',
                                    'href' => '/admin/user/update'
                                ], [
                                    'id' => 'user-delete',
                                    'name' => '删除',
                                    'href' => '/admin/user/remove'
                                ], [
                                    'id' => 'user-trash',
                                    'name' => '回收站',
                                    'href' => '/admin/user/trash'
                                ]
                            ]
                        ], [
                            'id' => 'role',
                            'name' => '角色',
                            'href' => '/admin/role/index',
                            'actives' => [
                                [
                                    'id' => 'role-update',
                                    'name' => '编辑',
                                    'href' => '/admin/role/update'
                                ], [
                                    'id' => 'role-delete',
                                    'name' => '删除',
                                    'href' => '/admin/role/remove'
                                ], [
                                    'id' => 'role-trash',
                                    'name' => '回收站',
                                    'href' => '/admin/role/trash'
                                ]
                            ]
                        ]
                    ]
                ], [
                    'id' => 'area-manager',
                    'name' => '地区管理',
                    'href' => '/admin/area/index',
                    'actives' => [
                        [
                            'name' => '删除',
                            'href' => '/admin/area/remove'
                        ], [
                            'name' => '添加/编辑',
                            'href' => '/admin/area/edit'
                        ]
                    ]
                ], [
                    'id' => 'edu-level',
                    'name' => '文化程度',
                    'href' => '/admin/edu/index',
                    'actives' => [
                        [
                            'name' => '删除',
                            'href' => '/admin/edu/remove'
                        ], [
                            'name' => '添加/编辑',
                            'href' => '/admin/edu/update'
                        ]
                    ]
                ], [
                    'id' => 'upload',
                    'name' => '上传设置',
                    'href' => '/admin/upload/index',
                    'actives' => [
                        [
                            'name' => '编辑',
                            'href' => '/admin/upload/edit'
                        ]
                    ]
                ], [
                    'id' => 'constant',
                    'name' => '常量管理',
                    'href' => '/admin/constant/index',
                    'actives' => [
                        [
                            'name' => '删除',
                            'href' => '/admin/constant/remove'
                        ], [
                            'name' => '添加/编辑',
                            'href' => '/admin/constant/update'
                        ]
                    ]
                ], [
                    'id' => 'links',
                    'name' => '友情链接',
                    'href' => '/admin/links/index',
                    'actives' => [
                        [
                            'name' => '删除',
                            'href' => '/admin/links/remove'
                        ], [
                            'name' => '添加/编辑',
                            'href' => '/admin/links/update'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
