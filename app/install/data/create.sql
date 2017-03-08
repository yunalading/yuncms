/*==============================================================*/
/* 数据库结构文件                                                 */
/*==============================================================*/

DROP DATABASE IF EXISTS yuncms;

CREATE DATABASE yuncms
  DEFAULT CHARSET utf8
  COLLATE utf8_general_ci;

USE yuncms;


/*==============================================================*/
/* Table: yc_ad_code                                            */
/*==============================================================*/
CREATE TABLE yc_ad_code
(
  ad_code_key VARCHAR(100)  NOT NULL
  COMMENT '代码广告标识',
  ad_name     VARCHAR(50)   NOT NULL
  COMMENT '名称',
  ad_code     VARCHAR(5000) NOT NULL
  COMMENT '代码',
  ad_desc     VARCHAR(200) COMMENT '描述',
  delete_time INT DEFAULT NULL
  COMMENT '软删除',
  update_time INT DEFAULT NULL
  COMMENT '更新时间',
  create_time INT           NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (ad_code_key)
);

ALTER TABLE yc_ad_code
  COMMENT '代码广告表';

/*==============================================================*/
/* Table: yc_ad_images                                          */
/*==============================================================*/
CREATE TABLE yc_ad_images
(
  ad_img_key  VARCHAR(100) NOT NULL
  COMMENT '图片广告标识',
  cover       VARCHAR(200) NOT NULL
  COMMENT '封面',
  title       VARCHAR(20)  NOT NULL
  COMMENT '标题',
  href        VARCHAR(500) NOT NULL
  COMMENT '链接',
  ad_desc     VARCHAR(200) COMMENT '描述',
  content     TEXT COMMENT '内容',
  delete_time INT DEFAULT NULL
  COMMENT '软删除',
  update_time INT DEFAULT NULL
  COMMENT '更新时间',
  create_time INT          NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (ad_img_key)
);

ALTER TABLE yc_ad_images
  COMMENT '图片广告表';

/*==============================================================*/
/* Table: yc_ad_text                                            */
/*==============================================================*/
CREATE TABLE yc_ad_text
(
  ad_text_key VARCHAR(100) NOT NULL
  COMMENT '文字广告标识',
  title       VARCHAR(20)  NOT NULL
  COMMENT '标题',
  href        VARCHAR(500) NOT NULL
  COMMENT '链接',
  ad_desc     VARCHAR(200) COMMENT '描述',
  delete_time INT DEFAULT NULL
  COMMENT '软删除',
  update_time INT DEFAULT NULL
  COMMENT '更新时间',
  create_time INT          NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (ad_text_key)
);

ALTER TABLE yc_ad_text
  COMMENT '文字广告表';

/*==============================================================*/
/* Table: yc_area                                               */
/*==============================================================*/
CREATE TABLE yc_area
(
  area_id        INT NOT NULL AUTO_INCREMENT
  COMMENT '地区编号',
  area_name      VARCHAR(200) COMMENT '地区名称',
  area_parent_id INT          DEFAULT 0
  COMMENT '地区父id',
  area_sort      INT          DEFAULT 0
  COMMENT '排序',
  area_deep      INT COMMENT '地区深度',
  area_region    VARCHAR(20) COMMENT '大区名称',
  PRIMARY KEY (area_id)
);

ALTER TABLE yc_area
  COMMENT '区域表';

/*==============================================================*/
/* Table: yc_category                                           */
/*==============================================================*/
CREATE TABLE yc_category
(
  category_id        INT          NOT NULL AUTO_INCREMENT
  COMMENT '类别编号',
  model_id           INT COMMENT '模型编号',
  seo_title          VARCHAR(200) COMMENT 'SEO标题',
  seo_url            VARCHAR(200) NOT NULL
  COMMENT 'SEOURL',
  seo_key            VARCHAR(200) COMMENT 'SEO关键词',
  seo_desc           VARCHAR(200) COMMENT 'SEO描述',
  category_name      VARCHAR(20)  NOT NULL
  COMMENT '类别名称',
  list_template      VARCHAR(200) NOT NULL
  COMMENT '列表页模板',
  info_template      VARCHAR(200) NOT NULL
  COMMENT '详情页模板',
  category_sort      INT          NOT NULL DEFAULT 0
  COMMENT '排序',
  parent_category_id INT COMMENT '上级类别编号',
  delete_time        INT                   DEFAULT NULL
  COMMENT '软删除',
  update_time        INT                   DEFAULT NULL
  COMMENT '更新时间',
  create_time        INT          NOT NULL
  COMMENT '创建时间',
  del_lock           INT                   DEFAULT 0
  COMMENT '删除锁',
  PRIMARY KEY (category_id)
);

ALTER TABLE yc_category
  COMMENT '类别表';

/*==============================================================*/
/* Index: category_unique                                       */
/*==============================================================*/
CREATE UNIQUE INDEX category_unique
  ON yc_category
  (
    seo_url
  );

/*==============================================================*/
/* Table: yc_comments                                           */
/*==============================================================*/
CREATE TABLE yc_comments
(
  content_comment_id INT NOT NULL AUTO_INCREMENT
  COMMENT '内容评论编号',
  content_id         INT COMMENT '内容编号',
  member_id          INT          DEFAULT 0
  COMMENT '会员编号',
  avatar             VARCHAR(200) COMMENT '头像',
  nickname           VARCHAR(20) COMMENT '昵称',
  phone              VARCHAR(20) COMMENT '手机',
  email              VARCHAR(50) COMMENT '邮箱',
  comment_content    VARCHAR(500) COMMENT '评论内容',
  comment_state      INT NOT NULL DEFAULT 0
  COMMENT '状态',
  comment_push_time  INT COMMENT '发布时间',
  parent_commit_id   INT COMMENT '上级评论编号',
  create_time        INT NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (content_comment_id)
);

ALTER TABLE yc_comments
  COMMENT '内容评论表';

/*==============================================================*/
/* Table: yc_content_tags                                       */
/*==============================================================*/
CREATE TABLE yc_content_tags
(
  content_tag_id INT NOT NULL AUTO_INCREMENT
  COMMENT '内容标签编号',
  content_id     INT COMMENT '内容编号',
  tag_id         INT COMMENT '标签编号',
  PRIMARY KEY (content_tag_id)
);

ALTER TABLE yc_content_tags
  COMMENT '内容标签表';

/*==============================================================*/
/* Table: yc_contents                                           */
/*==============================================================*/
CREATE TABLE yc_contents
(
  content_id     INT          NOT NULL AUTO_INCREMENT
  COMMENT '内容编号',
  category_id    INT COMMENT '类别编号',
  user_id        INT COMMENT '管理员用户编号',
  title          VARCHAR(50)  NOT NULL
  COMMENT '标题',
  cover          VARCHAR(200) COMMENT '封面',
  intro          VARCHAR(500) NOT NULL
  COMMENT '简介',
  content        TEXT         NOT NULL
  COMMENT '内容',
  read_number    INT          NOT NULL DEFAULT 0
  COMMENT '阅读量',
  comment_number INT          NOT NULL DEFAULT 0
  COMMENT '评论量',
  seo_title      VARCHAR(200) COMMENT 'SEO标题',
  seo_url        VARCHAR(200) NOT NULL
  COMMENT 'SEOURL',
  seo_key        VARCHAR(200) COMMENT 'SEO关键词',
  seo_desc       VARCHAR(200) COMMENT 'SEO描述',
  model_vlues    VARCHAR(2000) COMMENT '模型属性值',
  content_sort   INT          NOT NULL DEFAULT 0
  COMMENT '排序',
  content_state  INT          NOT NULL DEFAULT 0
  COMMENT '状态',
  push_time      INT COMMENT '发布时间',
  delete_time    INT                   DEFAULT NULL
  COMMENT '软删除',
  update_time    INT                   DEFAULT NULL
  COMMENT '更新时间',
  create_time    INT          NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (content_id)
);

ALTER TABLE yc_contents
  COMMENT '内容表';

/*==============================================================*/
/* Index: content_unique                                        */
/*==============================================================*/
CREATE UNIQUE INDEX content_unique
  ON yc_contents
  (
    seo_url
  );

/*==============================================================*/
/* Table: yc_edu_level                                          */
/*==============================================================*/
CREATE TABLE yc_edu_level
(
  edu_level_id   INT         NOT NULL AUTO_INCREMENT
  COMMENT '文化程度编号',
  edu_level_name VARCHAR(20) NOT NULL
  COMMENT '文化程度名称',
  PRIMARY KEY (edu_level_id)
);

ALTER TABLE yc_edu_level
  COMMENT '文化程度表';

/*==============================================================*/
/* Table: yc_guestbook                                          */
/*==============================================================*/
CREATE TABLE yc_guestbook
(
  guestbook_id      INT          NOT NULL AUTO_INCREMENT
  COMMENT '留言编号',
  nickname          VARCHAR(20)  NOT NULL
  COMMENT '昵称',
  phone             VARCHAR(20) COMMENT '手机',
  email             VARCHAR(50) COMMENT '邮箱',
  guestbook_title   VARCHAR(50)  NOT NULL
  COMMENT '标题',
  guestbook_content VARCHAR(500) NOT NULL
  COMMENT '内容',
  guestbook_state   INT          NOT NULL DEFAULT 0
  COMMENT '状态',
  create_time       INT          NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (guestbook_id)
);

ALTER TABLE yc_guestbook
  COMMENT '留言表';

/*==============================================================*/
/* Table: yc_img_type                                           */
/*==============================================================*/
CREATE TABLE yc_img_type
(
  img_type_id INT NOT NULL AUTO_INCREMENT
  COMMENT '图片分类编号',
  type_name   VARCHAR(20) COMMENT '分类名称',
  update_time INT          DEFAULT NULL
  COMMENT '更新时间',
  create_time INT NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (img_type_id)
);

ALTER TABLE yc_img_type
  COMMENT '图片分类表';

/*==============================================================*/
/* Index: img_type_unique                                       */
/*==============================================================*/
CREATE UNIQUE INDEX img_type_unique
  ON yc_img_type
  (
    type_name
  );

/*==============================================================*/
/* Table: yc_imgs                                               */
/*==============================================================*/
CREATE TABLE yc_imgs
(
  img_id      INT          NOT NULL AUTO_INCREMENT
  COMMENT '图片编号',
  img_type_id INT COMMENT '图片分类编号',
  img_title   VARCHAR(20)  NOT NULL
  COMMENT '图片标题',
  img_src     VARCHAR(255) NOT NULL
  COMMENT '图片地址',
  img_desc    VARCHAR(200) COMMENT '图片描述',
  create_time INT          NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (img_id)
);

ALTER TABLE yc_imgs
  COMMENT '图片表';

/*==============================================================*/
/* Table: yc_links                                              */
/*==============================================================*/
CREATE TABLE yc_links
(
  link_id      INT          NOT NULL AUTO_INCREMENT
  COMMENT '友情链接编号',
  link_name    VARCHAR(200) COMMENT '链接名称',
  link_logo    VARCHAR(255) COMMENT '链接图标',
  link_href    VARCHAR(255) NOT NULL
  COMMENT '链接地址',
  link_target  VARCHAR(50) COMMENT '打开方式',
  link_is_home INT COMMENT '是否是首页',
  link_sort    INT          NOT NULL DEFAULT 0
  COMMENT '排序编号',
  create_time  INT          NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (link_id)
);

ALTER TABLE yc_links
  COMMENT '友情链接表';

/*==============================================================*/
/* Table: yc_members                                            */
/*==============================================================*/
CREATE TABLE yc_members
(
  member_id    INT NOT NULL AUTO_INCREMENT
  COMMENT '会员编号',
  area_id      INT COMMENT '地区编号',
  edu_level_id INT COMMENT '文化程度编号',
  username     VARCHAR(20) COMMENT '用户名',
  password     VARCHAR(200) COMMENT '密码',
  nicename     VARCHAR(50) COMMENT '昵称',
  avatar       VARCHAR(200) COMMENT '头像',
  phone        VARCHAR(15) COMMENT '手机',
  phone_verify INT COMMENT '手机是否验证',
  email        VARCHAR(50) COMMENT '邮箱',
  email_verify INT COMMENT '邮箱是否验证',
  qq           VARCHAR(15) COMMENT 'QQ号',
  member_addr  VARCHAR(200) COMMENT '详细地址',
  sex          INT COMMENT '性别',
  birthday     INT COMMENT '生日',
  summary      VARCHAR(200) COMMENT '简介',
  state        INT NOT NULL DEFAULT 0
  COMMENT '状态',
  delete_time  INT          DEFAULT NULL
  COMMENT '软删除',
  update_time  INT          DEFAULT NULL
  COMMENT '更新时间',
  create_time  INT NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (member_id)
);

ALTER TABLE yc_members
  COMMENT '会员表';

/*==============================================================*/
/* Index: member_unique                                         */
/*==============================================================*/
CREATE UNIQUE INDEX member_unique
  ON yc_members
  (
    username,
    phone,
    email
  );

/*==============================================================*/
/* Table: yc_menus                                              */
/*==============================================================*/
CREATE TABLE yc_menus
(
  menu_id        INT          NOT NULL AUTO_INCREMENT
  COMMENT '菜单编号',
  nav_key        VARCHAR(200) COMMENT '导航标识',
  nav_name       VARCHAR(20)  NOT NULL
  COMMENT '菜单名称',
  nav_type       INT          NOT NULL
  COMMENT '菜单分类',
  nav_value      VARCHAR(255) NOT NULL
  COMMENT '菜单值',
  nav_target     VARCHAR(10) COMMENT '菜单打开方式',
  nav_sort       INT          NOT NULL DEFAULT 0
  COMMENT '菜单排序',
  parent_menu_id INT COMMENT '上级菜单编号',
  update_time    INT                   DEFAULT NULL
  COMMENT '更新时间',
  create_time    INT          NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (menu_id)
);

ALTER TABLE yc_menus
  COMMENT '菜单表';

/*==============================================================*/
/* Table: yc_model                                              */
/*==============================================================*/
CREATE TABLE yc_model
(
  model_id    INT         NOT NULL AUTO_INCREMENT
  COMMENT '模型编号',
  model_name  VARCHAR(20) NOT NULL
  COMMENT '模型名称',
  del_lock    INT                  DEFAULT 0
  COMMENT '删除锁',
  delete_time INT                  DEFAULT NULL
  COMMENT '软删除',
  update_time INT                  DEFAULT NULL
  COMMENT '更新时间',
  create_time INT         NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (model_id)
);

ALTER TABLE yc_model
  COMMENT '模型表';

/*==============================================================*/
/* Index: model_unique                                          */
/*==============================================================*/
CREATE UNIQUE INDEX model_unique
  ON yc_model
  (
    model_name
  );

/*==============================================================*/
/* Table: yc_model_properties                                   */
/*==============================================================*/
CREATE TABLE yc_model_properties
(
  model_properties_id INT         NOT NULL AUTO_INCREMENT
  COMMENT '模型属性编号',
  model_id            INT COMMENT '模型编号',
  pro_name            VARCHAR(20) NOT NULL
  COMMENT '属性名称',
  pro_key             VARCHAR(20) NOT NULL
  COMMENT '属性KEY',
  pro_cate            INT         NOT NULL
  COMMENT '属性类型',
  pro_desc            VARCHAR(200) COMMENT '属性说明',
  PRIMARY KEY (model_properties_id)
);

ALTER TABLE yc_model_properties
  COMMENT '模型属性表';

/*==============================================================*/
/* Table: yc_navs                                               */
/*==============================================================*/
CREATE TABLE yc_navs
(
  nav_key     VARCHAR(200) NOT NULL
  COMMENT '导航标识',
  nav_name    VARCHAR(200) NOT NULL
  COMMENT '导航名称',
  del_lock    INT          NOT NULL DEFAULT 0
  COMMENT '删除锁',
  update_time INT                   DEFAULT NULL
  COMMENT '更新时间',
  create_time INT          NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (nav_key)
);

ALTER TABLE yc_navs
  COMMENT '导航表';

/*==============================================================*/
/* Table: yc_oauth_members                                      */
/*==============================================================*/
CREATE TABLE yc_oauth_members
(
  oauth_member_id INT           NOT NULL AUTO_INCREMENT
  COMMENT '编号',
  member_id       INT COMMENT '会员编号',
  platform_type   INT           NOT NULL
  COMMENT '平台类别',
  openid          VARCHAR(50)   NOT NULL
  COMMENT '第三方平台用户标识',
  token           VARCHAR(200)  NOT NULL
  COMMENT '口令',
  userinfo        VARCHAR(2000) NOT NULL
  COMMENT '第三方平台用户信息',
  PRIMARY KEY (oauth_member_id)
);

ALTER TABLE yc_oauth_members
  COMMENT '第三方登录会员表';

/*==============================================================*/
/* Index: oauth_member_unique                                   */
/*==============================================================*/
CREATE UNIQUE INDEX oauth_member_unique
  ON yc_oauth_members
  (
    openid
  );

/*==============================================================*/
/* Table: yc_pages                                              */
/*==============================================================*/
CREATE TABLE yc_pages
(
  page_id     INT          NOT NULL AUTO_INCREMENT
  COMMENT '页面编号',
  title       VARCHAR(50) COMMENT '标题',
  cover       VARCHAR(200) COMMENT '封面',
  intro       VARCHAR(500) COMMENT '简介',
  seo_title   VARCHAR(200) COMMENT 'SEO标题',
  seo_url     VARCHAR(200) NOT NULL
  COMMENT 'SEOURL',
  seo_key     VARCHAR(200) COMMENT 'SEO关键词',
  seo_desc    VARCHAR(200) COMMENT 'SEO描述',
  content     TEXT COMMENT '内容',
  template    VARCHAR(200) NOT NULL
  COMMENT '模板',
  read_number INT          NOT NULL DEFAULT 0
  COMMENT '阅读量',
  page_sort   INT          NOT NULL DEFAULT 0
  COMMENT '排序',
  page_state  INT          NOT NULL DEFAULT 0
  COMMENT '状态',
  delete_time INT                   DEFAULT NULL
  COMMENT '软删除',
  update_time INT                   DEFAULT NULL
  COMMENT '更新时间',
  create_time INT          NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (page_id)
);

ALTER TABLE yc_pages
  COMMENT '页面表';

/*==============================================================*/
/* Index: page_unique                                           */
/*==============================================================*/
CREATE UNIQUE INDEX page_unique
  ON yc_pages
  (
    seo_url
  );

/*==============================================================*/
/* Table: yc_role                                               */
/*==============================================================*/
CREATE TABLE yc_role
(
  role_id     INT         NOT NULL AUTO_INCREMENT
  COMMENT '管理员角色编号',
  role_name   VARCHAR(50) NOT NULL
  COMMENT '角色名称',
  del_lock    INT         NOT NULL DEFAULT 0
  COMMENT '删除锁',
  delete_time INT                  DEFAULT NULL
  COMMENT '软删除',
  update_time INT                  DEFAULT NULL
  COMMENT '更新时间',
  create_time INT         NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (role_id)
);

ALTER TABLE yc_role
  COMMENT '管理员角色表';

/*==============================================================*/
/* Index: role_unique                                           */
/*==============================================================*/
CREATE UNIQUE INDEX role_unique
  ON yc_role
  (
    role_name
  );

/*==============================================================*/
/* Table: yc_slides                                             */
/*==============================================================*/
CREATE TABLE yc_slides
(
  slide_key   VARCHAR(100) NOT NULL
  COMMENT '幻灯片标识',
  slide_name  VARCHAR(200) NOT NULL
  COMMENT '幻灯片名称',
  delete_time INT DEFAULT NULL
  COMMENT '软删除',
  update_time INT DEFAULT NULL
  COMMENT '更新时间',
  create_time INT          NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (slide_key)
);

ALTER TABLE yc_slides
  COMMENT '幻灯片广告表';

/*==============================================================*/
/* Table: yc_slides_imgs                                        */
/*==============================================================*/
CREATE TABLE yc_slides_imgs
(
  slide_img_id INT          NOT NULL AUTO_INCREMENT
  COMMENT '幻灯片图片编号',
  slide_key    VARCHAR(100) COMMENT '幻灯片标识',
  cover        VARCHAR(200) NOT NULL
  COMMENT '封面',
  title        VARCHAR(20)  NOT NULL
  COMMENT '标题',
  href         VARCHAR(500) NOT NULL
  COMMENT '链接',
  ad_desc      VARCHAR(200) COMMENT '描述',
  content      TEXT COMMENT '内容',
  sort         INT          NOT NULL DEFAULT 0
  COMMENT '排序',
  update_time  INT                   DEFAULT NULL
  COMMENT '更新时间',
  create_time  INT          NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (slide_img_id)
);

ALTER TABLE yc_slides_imgs
  COMMENT '幻灯片图片表';

/*==============================================================*/
/* Table: yc_tags                                               */
/*==============================================================*/
CREATE TABLE yc_tags
(
  tag_id   INT         NOT NULL AUTO_INCREMENT
  COMMENT '标签编号',
  tag_name VARCHAR(50) NOT NULL
  COMMENT '标签名称',
  PRIMARY KEY (tag_id)
);

ALTER TABLE yc_tags
  COMMENT '标签表';

/*==============================================================*/
/* Index: tag_unique                                            */
/*==============================================================*/
CREATE UNIQUE INDEX tag_unique
  ON yc_tags
  (
    tag_name
  );

/*==============================================================*/
/* Table: yc_user_role_access                                   */
/*==============================================================*/
CREATE TABLE yc_user_role_access
(
  user_role_access_id INT          NOT NULL AUTO_INCREMENT
  COMMENT '管理员角色权限编号',
  role_id             INT COMMENT '管理员角色编号',
  access              VARCHAR(200) NOT NULL
  COMMENT '角色权限',
  PRIMARY KEY (user_role_access_id)
);

ALTER TABLE yc_user_role_access
  COMMENT '管理员角色权限表';

/*==============================================================*/
/* Table: yc_users                                              */
/*==============================================================*/
CREATE TABLE yc_users
(
  user_id         INT          NOT NULL AUTO_INCREMENT
  COMMENT '管理员用户编号',
  role_id         INT COMMENT '管理员角色编号',
  nickname        VARCHAR(50) COMMENT '昵称',
  avatar          VARCHAR(200) COMMENT '头像',
  username        VARCHAR(200) NOT NULL
  COMMENT '用户名',
  password        VARCHAR(200) NOT NULL
  COMMENT '密码',
  email           VARCHAR(50) COMMENT '邮箱',
  phone           VARCHAR(15) COMMENT '手机',
  qq              VARCHAR(15) COMMENT 'QQ号',
  last_login_time INT COMMENT '最后登陆时间',
  last_login_ip   VARCHAR(20) COMMENT '最后登陆IP',
  del_lock        INT          NOT NULL DEFAULT 0
  COMMENT '删除锁',
  state           INT          NOT NULL DEFAULT 0
  COMMENT '状态',
  delete_time     INT                   DEFAULT NULL
  COMMENT '软删除',
  update_time     INT                   DEFAULT NULL
  COMMENT '更新时间',
  create_time     INT          NOT NULL
  COMMENT '创建时间',
  PRIMARY KEY (user_id)
);

ALTER TABLE yc_users
  COMMENT '管理员用户表';

/*==============================================================*/
/* Index: user_unique                                           */
/*==============================================================*/
CREATE UNIQUE INDEX user_unique
  ON yc_users
  (
    username,
    email,
    phone
  );

ALTER TABLE yc_category
  ADD CONSTRAINT FK_CATEGORY_MODEL FOREIGN KEY (model_id)
REFERENCES yc_model (model_id)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_comments
  ADD CONSTRAINT FK_CONTENT_COMMENTS FOREIGN KEY (content_id)
REFERENCES yc_contents (content_id)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_content_tags
  ADD CONSTRAINT FK_CONTENT_TAGS FOREIGN KEY (content_id)
REFERENCES yc_contents (content_id)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_content_tags
  ADD CONSTRAINT FK_TAG_CONTENTS FOREIGN KEY (tag_id)
REFERENCES yc_tags (tag_id)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_contents
  ADD CONSTRAINT FK_CATEGORY_CONTENTS FOREIGN KEY (category_id)
REFERENCES yc_category (category_id)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_contents
  ADD CONSTRAINT FK_USER_CEONTENTS FOREIGN KEY (user_id)
REFERENCES yc_users (user_id)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_imgs
  ADD CONSTRAINT FK_TYPE_IMGS FOREIGN KEY (img_type_id)
REFERENCES yc_img_type (img_type_id)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_members
  ADD CONSTRAINT FK_MEMBER_AREA FOREIGN KEY (area_id)
REFERENCES yc_area (area_id)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_members
  ADD CONSTRAINT FK_MEMBER_EDU_LEVEL FOREIGN KEY (edu_level_id)
REFERENCES yc_edu_level (edu_level_id)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_menus
  ADD CONSTRAINT FK_NAV_MENUS FOREIGN KEY (nav_key)
REFERENCES yc_navs (nav_key)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_model_properties
  ADD CONSTRAINT FK_MODEL_PROPERTIES FOREIGN KEY (model_id)
REFERENCES yc_model (model_id)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_oauth_members
  ADD CONSTRAINT FK_MEMBER_OAUTH FOREIGN KEY (member_id)
REFERENCES yc_members (member_id)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_slides_imgs
  ADD CONSTRAINT FK_SLIDE_IMGS FOREIGN KEY (slide_key)
REFERENCES yc_slides (slide_key)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_user_role_access
  ADD CONSTRAINT FK_ROLE_ACCESS FOREIGN KEY (role_id)
REFERENCES yc_role (role_id)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE yc_users
  ADD CONSTRAINT FK_ROLE_USERS FOREIGN KEY (role_id)
REFERENCES yc_role (role_id)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

