
create table yc_ad_code
(
   ad_code_key          varchar(100) not null comment '代码广告标识',
   ad_name              varchar(50) not null comment '名称',
   ad_code              varchar(5000) not null comment '代码',
   ad_desc              varchar(200) comment '描述',
   delete_time          int default NULL comment '软删除',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (ad_code_key)
);

alter table yc_ad_code comment '代码广告表';

create table yc_ad_images
(
   ad_img_key           varchar(100) not null comment '图片广告标识',
   cover                varchar(200) not null comment '封面',
   title                varchar(20) not null comment '标题',
   href                 varchar(500) not null comment '链接',
   ad_desc              varchar(200) comment '描述',
   content              text comment '内容',
   delete_time          int default NULL comment '软删除',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (ad_img_key)
);

alter table yc_ad_images comment '图片广告表';

create table yc_ad_text
(
   ad_text_key          varchar(100) not null comment '文字广告标识',
   title                varchar(20) not null comment '标题',
   href                 varchar(500) not null comment '链接',
   ad_desc              varchar(200) comment '描述',
   delete_time          int default NULL comment '软删除',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (ad_text_key)
);

alter table yc_ad_text comment '文字广告表';

create table yc_area
(
   area_id              int not null auto_increment comment '地区编号',
   area_name            varchar(200) comment '地区名称',
   area_parent_id       int default 0 comment '地区父id',
   area_sort            int default 0 comment '排序',
   area_deep            int comment '地区深度',
   area_region          varchar(20) comment '大区名称',
   primary key (area_id)
);

alter table yc_area comment '区域表';

create table yc_category
(
   category_id          int not null auto_increment comment '类别编号',
   model_id             int comment '模型编号',
   seo_title            varchar(200) comment 'SEO标题',
   seo_url              varchar(200) not null comment 'SEOURL',
   seo_key              varchar(200) comment 'SEO关键词',
   seo_desc             varchar(200) comment 'SEO描述',
   category_name        varchar(20) not null comment '类别名称',
   list_template        varchar(200) not null comment '列表页模板',
   info_template        varchar(200) not null comment '详情页模板',
   category_sort        int default 0 comment '排序',
   parent_category_id   int comment '上级类别编号',
   delete_time          int default NULL comment '软删除',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   del_lock             int default 0 comment '删除锁',
   primary key (category_id)
);

alter table yc_category comment '类别表';

create unique index category_unique on yc_category
(
   seo_url
);

create table yc_comments
(
   content_comment_id   int not null auto_increment comment '内容评论编号',
   content_id           int comment '内容编号',
   member_id            int default 0 comment '会员编号',
   avatar               varchar(200) comment '头像',
   nickname             varchar(20) comment '昵称',
   phone                varchar(20) comment '手机',
   email                varchar(50) comment '邮箱',
   comment_content      varchar(500) not null comment '评论内容',
   comment_state        int default 0 comment '状态',
   comment_push_time    int comment '发布时间',
   parent_commit_id     int comment '上级评论编号',
   create_time          int not null comment '创建时间',
   primary key (content_comment_id)
);

alter table yc_comments comment '内容评论表';

create table yc_content_tags
(
   content_tag_id       int not null auto_increment comment '内容标签编号',
   content_id           int comment '内容编号',
   tag_id               int comment '标签编号',
   primary key (content_tag_id)
);

alter table yc_content_tags comment '内容标签表';

create table yc_contents
(
   content_id           int not null auto_increment comment '内容编号',
   category_id          int comment '类别编号',
   user_id              int comment '管理员用户编号',
   title                varchar(50) not null comment '标题',
   cover                varchar(200) not null comment '封面',
   intro                varchar(500) not null comment '简介',
   content              text not null comment '内容',
   read_number          int default 0 comment '阅读量',
   comment_number       int default 0 comment '评论量',
   seo_title            varchar(200) comment 'SEO标题',
   seo_url              varchar(200) not null comment 'SEOURL',
   seo_key              varchar(200) comment 'SEO关键词',
   seo_desc             varchar(200) comment 'SEO描述',
   model_vlues          varchar(2000) comment '模型属性值',
   content_sort         int default 0 comment '排序',
   content_state        int default 0 comment '状态',
   push_time            int comment '发布时间',
   delete_time          int default NULL comment '软删除',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (content_id)
);

alter table yc_contents comment '内容表';

create unique index content_unique on yc_contents
(
   seo_url
);

create table yc_edu_level
(
   edu_level_id         int not null auto_increment comment '文化程度编号',
   edu_level_name       varchar(20) not null comment '文化程度名称',
   primary key (edu_level_id)
);

alter table yc_edu_level comment '文化程度表';

create table yc_guestbook
(
   guestbook_id         int not null auto_increment comment '留言编号',
   nickname             varchar(20) not null comment '昵称',
   phone                varchar(20) comment '手机',
   email                varchar(50) comment '邮箱',
   guestbook_title      varchar(50) not null comment '标题',
   guestbook_content    varchar(500) not null comment '内容',
   create_time          int not null comment '创建时间',
   primary key (guestbook_id)
);

alter table yc_guestbook comment '留言表';

create table yc_img_type
(
   img_type_id          int not null auto_increment comment '图片分类编号',
   type_name            varchar(20) comment '分类名称',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (img_type_id)
);

alter table yc_img_type comment '图片分类表';

create unique index img_type_unique on yc_img_type
(
   type_name
);

create table yc_imgs
(
   img_id               int not null auto_increment comment '图片编号',
   img_type_id          int comment '图片分类编号',
   img_title            varchar(20) not null comment '图片标题',
   img_src              varchar(255) not null comment '图片地址',
   img_desc             varchar(200) comment '图片描述',
   create_time          int not null comment '创建时间',
   primary key (img_id)
);

alter table yc_imgs comment '图片表';

create table yc_links
(
   link_id              int not null auto_increment comment '友情链接编号',
   link_name            varchar(200) comment '链接名称',
   link_logo            varchar(255) comment '链接图标',
   link_href            varchar(255) not null comment '链接地址',
   link_target          varchar(50) comment '打开方式',
   link_is_home         int default 0 comment '是否是首页',
   link_sort            int default 0 comment '排序编号',
   create_time          int not null comment '创建时间',
   primary key (link_id)
);

alter table yc_links comment '友情链接表';

create table yc_members
(
   member_id            int not null auto_increment comment '会员编号',
   area_id              int comment '地区编号',
   edu_level_id         int comment '文化程度编号',
   username             varchar(20) not null comment '用户名',
   password             varchar(200) not null comment '密码',
   nicename             varchar(50) comment '昵称',
   avatar               varchar(200) comment '头像',
   phone                varchar(15) comment '手机',
   phone_verify         int comment '手机是否验证',
   email                varchar(50) comment '邮箱',
   email_verify         int comment '邮箱是否验证',
   qq                   varchar(15) comment 'QQ号',
   member_addr          varchar(200) comment '详细地址',
   sex                  int default 0 comment '性别',
   birthday             int comment '生日',
   summary              varchar(200) comment '简介',
   state                int default 0 comment '状态',
   delete_time          int default NULL comment '软删除',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (member_id)
);

alter table yc_members comment '会员表';

create unique index member_unique on yc_members
(
   username
);

create table yc_menus
(
   menu_id              int not null auto_increment comment '菜单编号',
   nav_key              varchar(200) comment '导航标识',
   menu_name            varchar(20) not null comment '菜单名称',
   menu_type            int not null comment '菜单分类',
   menu_value           varchar(255) not null comment '菜单值',
   menu_target          varchar(10) comment '菜单打开方式',
   menu_sort            int default 0 comment '菜单排序',
   parent_menu_id       int comment '上级菜单编号',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (menu_id)
);

alter table yc_menus comment '菜单表';

create table yc_model
(
   model_id             int not null auto_increment comment '模型编号',
   model_name           varchar(20) not null comment '模型名称',
   del_lock             int default 0 comment '删除锁',
   delete_time          int default NULL comment '软删除',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (model_id)
);

alter table yc_model comment '模型表';

create unique index model_unique on yc_model
(
   model_name
);

create table yc_model_properties
(
   model_properties_id  int not null auto_increment comment '模型属性编号',
   model_id             int comment '模型编号',
   pro_name             varchar(20) not null comment '属性名称',
   pro_key              varchar(20) not null comment '属性KEY',
   pro_cate             int not null comment '属性类型',
   pro_desc             varchar(200) comment '属性说明',
   primary key (model_properties_id)
);

alter table yc_model_properties comment '模型属性表';

create table yc_navs
(
   nav_key              varchar(200) not null comment '导航标识',
   nav_name             varchar(200) not null comment '导航名称',
   del_lock             int default 0 comment '删除锁',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (nav_key)
);

alter table yc_navs comment '导航表';

create table yc_oauth_members
(
   oauth_member_id      int not null auto_increment comment '编号',
   member_id            int comment '会员编号',
   platform_type        int not null comment '平台类别',
   openid               varchar(50) not null comment '平台用户标识',
   token                varchar(200) not null comment '口令',
   userinfo             varchar(2000) not null comment '平台用户信息',
   primary key (oauth_member_id)
);

alter table yc_oauth_members comment '第三方登录会员表';

create unique index oauth_member_unique on yc_oauth_members
(
   openid
);

create table yc_s
(
   page_id              int not null auto_increment comment '页面编号',
   title                varchar(50) not null comment '标题',
   cover                varchar(200) not null comment '封面',
   intro                varchar(500) not null comment '简介',
   seo_title            varchar(200) comment 'SEO标题',
   seo_url              varchar(200) not null comment 'SEOURL',
   seo_key              varchar(200) comment 'SEO关键词',
   seo_desc             varchar(200) comment 'SEO描述',
   content              text not null comment '内容',
   template             varchar(200) not null comment '模板',
   read_number          int default 0 comment '阅读量',
   page_sort            int default 0 comment '排序',
   page_state           int default 0 comment '状态',
   delete_time          int default NULL comment '软删除',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (page_id)
);

alter table yc_pages comment '页面表';

create unique index page_unique on yc_pages
(
   seo_url
);

create table yc_role
(
   role_id              int not null auto_increment comment '管理员角色编号',
   role_name            varchar(50) not null comment '角色名称',
   del_lock             int default 0 comment '删除锁',
   delete_time          int default NULL comment '软删除',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (role_id)
);

alter table yc_role comment '管理员角色表';

create unique index role_unique on yc_role
(
   role_name
);

create table yc_role_access
(
   user_role_access_id  int not null auto_increment comment '管理员角色权限编号',
   role_id              int comment '管理员角色编号',
   access               varchar(200) not null comment '角色权限',
   primary key (user_role_access_id)
);

alter table yc_role_access comment '管理员角色权限表';

create table yc_slides
(
   slide_key            varchar(100) not null comment '幻灯片标识',
   slide_name           varchar(200) not null comment '幻灯片名称',
   delete_time          int default NULL comment '软删除',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (slide_key)
);

alter table yc_slides comment '幻灯片广告表';

create table yc_slides_imgs
(
   slide_img_id         int not null auto_increment comment '幻灯片图片编号',
   slide_key            varchar(100) comment '幻灯片标识',
   cover                varchar(200) not null comment '封面',
   title                varchar(20) not null comment '标题',
   href                 varchar(500) not null comment '链接',
   ad_desc              varchar(200) comment '描述',
   content              text comment '内容',
   sort                 int default 0 comment '排序',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (slide_img_id)
);

alter table yc_slides_imgs comment '幻灯片图片表';

create table yc_tags
(
   tag_id               int not null auto_increment comment '标签编号',
   tag_name             varchar(50) not null comment '标签名称',
   primary key (tag_id)
);

alter table yc_tags comment '标签表';

create unique index tag_unique on yc_tags
(
   tag_name
);

create table yc_users
(
   user_id              int not null auto_increment comment '管理员用户编号',
   role_id              int comment '管理员角色编号',
   nickname             varchar(50) comment '昵称',
   username             varchar(200) not null comment '用户名',
   password             varchar(200) not null comment '密码',
   email                varchar(50) comment '邮箱',
   phone                varchar(15) comment '手机',
   qq                   varchar(15) comment 'QQ号',
   last_login_time      int comment '最后登陆时间',
   last_login_ip        varchar(20) comment '最后登陆IP',
   del_lock             int default 0 comment '删除锁',
   state                int default 0 comment '状态',
   delete_time          int default NULL comment '软删除',
   update_time          int default NULL comment '更新时间',
   create_time          int not null comment '创建时间',
   primary key (user_id)
);

alter table yc_users comment '管理员用户表';

create unique index user_unique on yc_users
(
   username
);

alter table yc_category add constraint FK_CATEGORY_MODEL foreign key (model_id)
references yc_model (model_id) on delete restrict on update restrict;

alter table yc_comments add constraint FK_CONTENT_COMMENTS foreign key (content_id)
references yc_contents (content_id) on delete restrict on update restrict;

alter table yc_content_tags add constraint FK_CONTENT_TAGS foreign key (content_id)
references yc_contents (content_id) on delete restrict on update restrict;

alter table yc_content_tags add constraint FK_TAG_CONTENTS foreign key (tag_id)
references yc_tags (tag_id) on delete restrict on update restrict;

alter table yc_contents add constraint FK_CATEGORY_CONTENTS foreign key (category_id)
references yc_category (category_id) on delete restrict on update restrict;

alter table yc_contents add constraint FK_USER_CEONTENTS foreign key (user_id)
references yc_users (user_id) on delete restrict on update restrict;

alter table yc_imgs add constraint FK_TYPE_IMGS foreign key (img_type_id)
references yc_img_type (img_type_id) on delete restrict on update restrict;

alter table yc_members add constraint FK_MEMBER_AREA foreign key (area_id)
references yc_area (area_id) on delete restrict on update restrict;

alter table yc_members add constraint FK_MEMBER_EDU_LEVEL foreign key (edu_level_id)
references yc_edu_level (edu_level_id) on delete restrict on update restrict;

alter table yc_menus add constraint FK_NAV_MENUS foreign key (nav_key)
references yc_navs (nav_key) on delete restrict on update restrict;

alter table yc_model_properties add constraint FK_MODEL_PROPERTIES foreign key (model_id)
references yc_model (model_id) on delete restrict on update restrict;

alter table yc_oauth_members add constraint FK_MEMBER_OAUTH foreign key (member_id)
references yc_members (member_id) on delete restrict on update restrict;

alter table yc_role_access add constraint FK_ROLE_ACCESS foreign key (role_id)
references yc_role (role_id) on delete restrict on update restrict;

alter table yc_slides_imgs add constraint FK_SLIDE_IMGS foreign key (slide_key)
references yc_slides (slide_key) on delete restrict on update restrict;

alter table yc_users add constraint FK_ROLE_USERS foreign key (role_id)
references yc_role (role_id) on delete restrict on update restrict
