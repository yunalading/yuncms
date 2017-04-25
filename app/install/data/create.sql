SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `yc_ad_code`;
CREATE TABLE `yc_ad_code` (
  `ad_code_key` varchar(100) NOT NULL COMMENT '代码广告标识',
  `ad_name` varchar(50) NOT NULL COMMENT '名称',
  `ad_code` varchar(5000) NOT NULL COMMENT '代码',
  `ad_desc` varchar(200) DEFAULT NULL COMMENT '描述',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`ad_code_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='代码广告表';

DROP TABLE IF EXISTS `yc_ad_images`;
CREATE TABLE `yc_ad_images` (
  `ad_img_key` varchar(100) NOT NULL COMMENT '图片广告标识',
  `cover` varchar(200) NOT NULL COMMENT '封面',
  `title` varchar(20) NOT NULL COMMENT '标题',
  `href` varchar(500) NOT NULL COMMENT '链接',
  `ad_desc` varchar(200) DEFAULT NULL COMMENT '描述',
  `content` text COMMENT '内容',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`ad_img_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='图片广告表';

DROP TABLE IF EXISTS `yc_ad_text`;
CREATE TABLE `yc_ad_text` (
  `ad_text_key` varchar(100) NOT NULL COMMENT '文字广告标识',
  `title` varchar(20) NOT NULL COMMENT '标题',
  `href` varchar(500) NOT NULL COMMENT '链接',
  `ad_desc` varchar(200) DEFAULT NULL COMMENT '描述',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`ad_text_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文字广告表';

DROP TABLE IF EXISTS `yc_area`;
CREATE TABLE `yc_area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '地区编号',
  `area_name` varchar(200) DEFAULT NULL COMMENT '地区名称',
  `area_parent_id` int(11) DEFAULT '0' COMMENT '地区父id',
  `area_sort` int(11) DEFAULT '0' COMMENT '排序',
  `area_deep` int(11) DEFAULT NULL COMMENT '地区深度',
  `area_region` varchar(20) DEFAULT NULL COMMENT '大区名称',
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='区域表';

DROP TABLE IF EXISTS `yc_article_properties`;
CREATE TABLE `yc_article_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '字段编号',
  `article_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章内容编号',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '文章类型:1.文章内容 2.单页内容',
  `model_properties_id` int(11) NOT NULL DEFAULT '0' COMMENT '模型属性',
  `value` text NOT NULL COMMENT '属性值',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='内容属性表';

DROP TABLE IF EXISTS `yc_category`;
CREATE TABLE `yc_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '类别编号',
  `model_id` int(11) DEFAULT NULL COMMENT '模型编号',
  `seo_title` varchar(200) DEFAULT NULL COMMENT 'SEO标题',
  `seo_url` varchar(200) NOT NULL COMMENT 'SEOURL',
  `seo_key` varchar(200) DEFAULT NULL COMMENT 'SEO关键词',
  `seo_desc` varchar(200) DEFAULT NULL COMMENT 'SEO描述',
  `category_name` varchar(20) NOT NULL COMMENT '类别名称',
  `list_template` varchar(200) NOT NULL COMMENT '列表页模板',
  `info_template` varchar(200) NOT NULL COMMENT '详情页模板',
  `category_sort` int(11) DEFAULT '0' COMMENT '排序',
  `parent_category_id` int(11) DEFAULT NULL COMMENT '上级类别编号',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `del_lock` int(11) DEFAULT '0' COMMENT '删除锁',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_unique` (`seo_url`),
  KEY `FK_CATEGORY_MODEL` (`model_id`),
  CONSTRAINT `FK_CATEGORY_MODEL` FOREIGN KEY (`model_id`) REFERENCES `yc_model` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='类别表';

DROP TABLE IF EXISTS `yc_comments`;
CREATE TABLE `yc_comments` (
  `content_comment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '内容评论编号',
  `content_id` int(11) DEFAULT NULL COMMENT '内容编号',
  `member_id` int(11) DEFAULT '0' COMMENT '会员编号',
  `avatar` varchar(200) DEFAULT NULL COMMENT '头像',
  `nickname` varchar(20) DEFAULT NULL COMMENT '昵称',
  `phone` varchar(20) DEFAULT NULL COMMENT '手机',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `comment_content` varchar(500) NOT NULL COMMENT '评论内容',
  `comment_state` int(11) DEFAULT '0' COMMENT '状态',
  `comment_push_time` int(11) DEFAULT NULL COMMENT '发布时间',
  `parent_commit_id` int(11) DEFAULT NULL COMMENT '上级评论编号',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`content_comment_id`),
  KEY `FK_CONTENT_COMMENTS` (`content_id`),
  CONSTRAINT `FK_CONTENT_COMMENTS` FOREIGN KEY (`content_id`) REFERENCES `yc_contents` (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='内容评论表';

DROP TABLE IF EXISTS `yc_content_tags`;
CREATE TABLE `yc_content_tags` (
  `content_tag_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '内容标签编号',
  `content_id` int(11) DEFAULT NULL COMMENT '内容编号',
  `tag_id` int(11) DEFAULT NULL COMMENT '标签编号',
  PRIMARY KEY (`content_tag_id`),
  KEY `FK_CONTENT_TAGS` (`content_id`),
  KEY `FK_TAG_CONTENTS` (`tag_id`),
  CONSTRAINT `FK_CONTENT_TAGS` FOREIGN KEY (`content_id`) REFERENCES `yc_contents` (`content_id`),
  CONSTRAINT `FK_TAG_CONTENTS` FOREIGN KEY (`tag_id`) REFERENCES `yc_tags` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='内容标签表';

DROP TABLE IF EXISTS `yc_contents`;
CREATE TABLE `yc_contents` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '内容编号',
  `category_id` int(11) DEFAULT NULL COMMENT '类别编号',
  `user_id` int(11) DEFAULT NULL COMMENT '管理员用户编号',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `cover` varchar(200) NOT NULL COMMENT '封面',
  `intro` varchar(500) NOT NULL COMMENT '简介',
  `content` text NOT NULL COMMENT '内容',
  `read_number` int(11) DEFAULT '0' COMMENT '阅读量',
  `comment_number` int(11) DEFAULT '0' COMMENT '评论量',
  `seo_title` varchar(200) DEFAULT NULL COMMENT 'SEO标题',
  `seo_url` varchar(200) NOT NULL COMMENT 'SEOURL',
  `seo_key` varchar(200) DEFAULT NULL COMMENT 'SEO关键词',
  `seo_desc` varchar(200) DEFAULT NULL COMMENT 'SEO描述',
  `model_vlues` varchar(2000) DEFAULT NULL COMMENT '模型属性值',
  `content_sort` int(11) DEFAULT '0' COMMENT '排序',
  `content_state` int(11) DEFAULT '0' COMMENT '状态',
  `push_time` int(11) DEFAULT NULL COMMENT '发布时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`content_id`),
  UNIQUE KEY `content_unique` (`seo_url`),
  KEY `FK_CATEGORY_CONTENTS` (`category_id`),
  KEY `FK_USER_CEONTENTS` (`user_id`),
  CONSTRAINT `FK_CATEGORY_CONTENTS` FOREIGN KEY (`category_id`) REFERENCES `yc_category` (`category_id`),
  CONSTRAINT `FK_USER_CEONTENTS` FOREIGN KEY (`user_id`) REFERENCES `yc_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='内容表';

DROP TABLE IF EXISTS `yc_edu_level`;
CREATE TABLE `yc_edu_level` (
  `edu_level_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文化程度编号',
  `edu_level_name` varchar(20) NOT NULL COMMENT '文化程度名称',
  PRIMARY KEY (`edu_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='文化程度表';

DROP TABLE IF EXISTS `yc_guestbook`;
CREATE TABLE `yc_guestbook` (
  `guestbook_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '留言编号',
  `nickname` varchar(20) NOT NULL COMMENT '昵称',
  `phone` varchar(20) DEFAULT NULL COMMENT '手机',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `guestbook_title` varchar(50) NOT NULL COMMENT '标题',
  `guestbook_content` varchar(500) NOT NULL COMMENT '内容',
  `guestbook_state` int(11) DEFAULT '0' COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`guestbook_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='留言表';

DROP TABLE IF EXISTS `yc_img_type`;
CREATE TABLE `yc_img_type` (
  `img_type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '图片分类编号',
  `type_name` varchar(20) DEFAULT NULL COMMENT '分类名称',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`img_type_id`),
  UNIQUE KEY `img_type_unique` (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='图片分类表';

DROP TABLE IF EXISTS `yc_imgs`;
CREATE TABLE `yc_imgs` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '图片编号',
  `img_type_id` int(11) DEFAULT NULL COMMENT '图片分类编号',
  `img_title` varchar(20) NOT NULL COMMENT '图片标题',
  `img_src` varchar(255) NOT NULL COMMENT '图片地址',
  `img_desc` varchar(200) DEFAULT NULL COMMENT '图片描述',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`img_id`),
  KEY `FK_TYPE_IMGS` (`img_type_id`),
  CONSTRAINT `FK_TYPE_IMGS` FOREIGN KEY (`img_type_id`) REFERENCES `yc_img_type` (`img_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='图片表';

DROP TABLE IF EXISTS `yc_links`;
CREATE TABLE `yc_links` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '友情链接编号',
  `link_name` varchar(200) DEFAULT NULL COMMENT '链接名称',
  `link_logo` varchar(255) DEFAULT NULL COMMENT '链接图标',
  `link_href` varchar(255) NOT NULL COMMENT '链接地址',
  `link_target` varchar(50) DEFAULT NULL COMMENT '打开方式',
  `link_is_home` int(11) DEFAULT NULL COMMENT '是否是首页',
  `link_sort` int(11) DEFAULT '0' COMMENT '排序编号',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='友情链接表';

DROP TABLE IF EXISTS `yc_members`;
CREATE TABLE `yc_members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '会员编号',
  `area_id` int(11) DEFAULT NULL COMMENT '地区编号',
  `edu_level_id` int(11) DEFAULT NULL COMMENT '文化程度编号',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(200) NOT NULL COMMENT '密码',
  `nicename` varchar(50) DEFAULT NULL COMMENT '昵称',
  `avatar` varchar(200) DEFAULT NULL COMMENT '头像',
  `phone` varchar(15) DEFAULT NULL COMMENT '手机',
  `phone_verify` int(11) DEFAULT NULL COMMENT '手机是否验证',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `email_verify` int(11) DEFAULT NULL COMMENT '邮箱是否验证',
  `qq` varchar(15) DEFAULT NULL COMMENT 'QQ号',
  `member_addr` varchar(200) DEFAULT NULL COMMENT '详细地址',
  `sex` int(11) DEFAULT '0' COMMENT '性别',
  `birthday` int(11) DEFAULT NULL COMMENT '生日',
  `summary` varchar(200) DEFAULT NULL COMMENT '简介',
  `state` int(11) DEFAULT '0' COMMENT '状态',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `member_unique` (`username`),
  KEY `FK_MEMBER_AREA` (`area_id`),
  KEY `FK_MEMBER_EDU_LEVEL` (`edu_level_id`),
  CONSTRAINT `FK_MEMBER_AREA` FOREIGN KEY (`area_id`) REFERENCES `yc_area` (`area_id`),
  CONSTRAINT `FK_MEMBER_EDU_LEVEL` FOREIGN KEY (`edu_level_id`) REFERENCES `yc_edu_level` (`edu_level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员表';

DROP TABLE IF EXISTS `yc_menus`;
CREATE TABLE `yc_menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜单编号',
  `nav_key` varchar(200) DEFAULT NULL COMMENT '导航标识',
  `menu_name` varchar(20) NOT NULL COMMENT '菜单名称',
  `menu_type` int(11) NOT NULL COMMENT '菜单分类',
  `menu_value` varchar(255) NOT NULL COMMENT '菜单值',
  `menu_target` varchar(10) DEFAULT NULL COMMENT '菜单打开方式',
  `menu_sort` int(11) DEFAULT '0' COMMENT '菜单排序',
  `parent_menu_id` int(11) DEFAULT NULL COMMENT '上级菜单编号',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`menu_id`),
  KEY `FK_NAV_MENUS` (`nav_key`),
  CONSTRAINT `FK_NAV_MENUS` FOREIGN KEY (`nav_key`) REFERENCES `yc_navs` (`nav_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜单表';

DROP TABLE IF EXISTS `yc_model`;
CREATE TABLE `yc_model` (
  `model_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '模型编号',
  `model_name` varchar(20) NOT NULL COMMENT '模型名称',
  `del_lock` int(11) DEFAULT '0' COMMENT '删除锁',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`model_id`),
  UNIQUE KEY `model_unique` (`model_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='模型表';

DROP TABLE IF EXISTS `yc_model_attr`;
CREATE TABLE `yc_model_attr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '变量英文标识',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型',
  `model_id` int(11) unsigned DEFAULT '0' COMMENT '对应model表的model_id',
  `tips` varchar(50) NOT NULL DEFAULT '' COMMENT '字段中文说明',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `field_value` text COMMENT '类型值(如field_type值为"radio"时field_value可设为 "1|开启,0|关闭")',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='模型属性值';

DROP TABLE IF EXISTS `yc_model_properties`;
CREATE TABLE `yc_model_properties` (
  `model_properties_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '模型属性编号',
  `model_id` int(11) DEFAULT NULL COMMENT '模型编号',
  `pro_name` varchar(20) NOT NULL COMMENT '属性名称',
  `pro_key` varchar(20) NOT NULL COMMENT '属性KEY',
  `pro_cate` int(11) NOT NULL COMMENT '属性类型',
  `pro_desc` varchar(200) DEFAULT NULL COMMENT '属性说明',
  `pro_value` text COMMENT '类型值(如pro_cate值为"radio"时pro_value可设为"1|开启,0|关闭")',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`model_properties_id`),
  KEY `FK_MODEL_PROPERTIES` (`model_id`),
  CONSTRAINT `FK_MODEL_PROPERTIES` FOREIGN KEY (`model_id`) REFERENCES `yc_model` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='模型属性表';

DROP TABLE IF EXISTS `yc_navs`;
CREATE TABLE `yc_navs` (
  `nav_key` varchar(200) NOT NULL COMMENT '导航标识',
  `nav_name` varchar(200) NOT NULL COMMENT '导航名称',
  `del_lock` int(11) DEFAULT '0' COMMENT '删除锁',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`nav_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='导航表';

DROP TABLE IF EXISTS `yc_oauth_members`;
CREATE TABLE `yc_oauth_members` (
  `oauth_member_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `member_id` int(11) DEFAULT NULL COMMENT '会员编号',
  `platform_type` int(11) NOT NULL COMMENT '平台类别',
  `openid` varchar(50) NOT NULL COMMENT '平台用户标识',
  `token` varchar(200) NOT NULL COMMENT '口令',
  `userinfo` varchar(2000) NOT NULL COMMENT '平台用户信息',
  PRIMARY KEY (`oauth_member_id`),
  UNIQUE KEY `oauth_member_unique` (`openid`),
  KEY `FK_MEMBER_OAUTH` (`member_id`),
  CONSTRAINT `FK_MEMBER_OAUTH` FOREIGN KEY (`member_id`) REFERENCES `yc_members` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='第三方登录会员表';

DROP TABLE IF EXISTS `yc_pages`;
CREATE TABLE `yc_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '页面编号',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `cover` varchar(200) NOT NULL COMMENT '封面',
  `intro` varchar(500) NOT NULL COMMENT '简介',
  `seo_title` varchar(200) DEFAULT NULL COMMENT 'SEO标题',
  `seo_url` varchar(200) NOT NULL COMMENT 'SEOURL',
  `seo_key` varchar(200) DEFAULT NULL COMMENT 'SEO关键词',
  `seo_desc` varchar(200) DEFAULT NULL COMMENT 'SEO描述',
  `content` text NOT NULL COMMENT '内容',
  `template` varchar(200) NOT NULL COMMENT '模板',
  `read_number` int(11) DEFAULT '0' COMMENT '阅读量',
  `page_sort` int(11) DEFAULT '0' COMMENT '排序',
  `page_state` int(11) DEFAULT '0' COMMENT '状态',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `model_id` int(11) NOT NULL DEFAULT '1' COMMENT '模型编号',
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `page_unique` (`seo_url`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='页面表';

DROP TABLE IF EXISTS `yc_role`;
CREATE TABLE `yc_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员角色编号',
  `role_name` varchar(50) NOT NULL COMMENT '角色名称',
  `del_lock` int(11) DEFAULT '0' COMMENT '删除锁',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_unique` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='管理员角色表';

DROP TABLE IF EXISTS `yc_role_access`;
CREATE TABLE `yc_role_access` (
  `user_role_access_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员角色权限编号',
  `role_id` int(11) DEFAULT NULL COMMENT '管理员角色编号',
  `access` varchar(200) NOT NULL COMMENT '角色权限',
  PRIMARY KEY (`user_role_access_id`),
  KEY `FK_ROLE_ACCESS` (`role_id`),
  CONSTRAINT `FK_ROLE_ACCESS` FOREIGN KEY (`role_id`) REFERENCES `yc_role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='管理员角色权限表';

DROP TABLE IF EXISTS `yc_slides`;
CREATE TABLE `yc_slides` (
  `slide_key` varchar(100) NOT NULL COMMENT '幻灯片标识',
  `slide_name` varchar(200) NOT NULL COMMENT '幻灯片名称',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`slide_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='幻灯片广告表';

DROP TABLE IF EXISTS `yc_slides_imgs`;
CREATE TABLE `yc_slides_imgs` (
  `slide_img_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '幻灯片图片编号',
  `slide_key` varchar(100) DEFAULT NULL COMMENT '幻灯片标识',
  `cover` varchar(200) NOT NULL COMMENT '封面',
  `title` varchar(20) NOT NULL COMMENT '标题',
  `href` varchar(500) NOT NULL COMMENT '链接',
  `ad_desc` varchar(200) DEFAULT NULL COMMENT '描述',
  `content` text COMMENT '内容',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`slide_img_id`),
  KEY `FK_SLIDE_IMGS` (`slide_key`),
  CONSTRAINT `FK_SLIDE_IMGS` FOREIGN KEY (`slide_key`) REFERENCES `yc_slides` (`slide_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='幻灯片图片表';

DROP TABLE IF EXISTS `yc_tags`;
CREATE TABLE `yc_tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '标签编号',
  `tag_name` varchar(50) NOT NULL COMMENT '标签名称',
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `tag_unique` (`tag_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='标签表';

DROP TABLE IF EXISTS `yc_users`;
CREATE TABLE `yc_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员用户编号',
  `role_id` int(11) DEFAULT NULL COMMENT '管理员角色编号',
  `nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `avatar` varchar(200) DEFAULT NULL COMMENT '头像',
  `username` varchar(200) NOT NULL COMMENT '用户名',
  `password` varchar(200) NOT NULL COMMENT '密码',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `phone` varchar(15) DEFAULT NULL COMMENT '手机',
  `qq` varchar(15) DEFAULT NULL COMMENT 'QQ号',
  `last_login_time` int(11) DEFAULT NULL COMMENT '最后登陆时间',
  `last_login_ip` varchar(20) DEFAULT NULL COMMENT '最后登陆IP',
  `del_lock` int(11) DEFAULT '0' COMMENT '删除锁',
  `state` int(11) DEFAULT '0' COMMENT '状态',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_unique` (`username`),
  KEY `FK_ROLE_USERS` (`role_id`),
  CONSTRAINT `FK_ROLE_USERS` FOREIGN KEY (`role_id`) REFERENCES `yc_role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='管理员用户表';

SET FOREIGN_KEY_CHECKS = 1;
