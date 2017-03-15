# 数据库设计文档

## 说明
> `yc_`为默认表前缀。

## yc_role（管理员角色表）

| 字段 | 类型 | 主键 | 可为空  | 默认值  | 说明 |
| ------------- | ------------- | ------------- | ------------- | ------------- |
| role_id | int | 是 | | | 管理员角色编号(自增长)  |
|role_name|varchar(50)||||角色名称|
|del_lock|int|||0|删除锁|
|delete_time|int||是|NULL|软删除|
|update_time|int||是|NULL|更新时间|
|create_time|int||||创建时间|

## yc_users（管理员用户表）


|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|user_id|int|是|||管理员用户编号(自增长)|
|role_id|int||||管理员角色编号|
|nickname|varchar(50)||是||昵称|
|avatar|varchar(200)||是||头像|
|username|varchar(200)||||用户名|
|password|varchar(200)||||密码|
|email|varchar(50)||是||邮箱|
|phone|varchar(15)||是||手机|
|qq|varchar(15)||是||QQ号|
|last_login_time|int||是||最后登陆时间|
|last_login_ip|varchar(20)||是||最后登陆IP|
|del_lock|int|||0|删除锁|
|state|int|||0|状态|
|delete_time|int|||NULL|软删除|
|update_time|int|||NULL|更新时间|
|create_time|int||||创建时间|

## yc_user_role_access（管理员角色权限表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|user_role_access_id|int|是|||管理员角色权限编号(自增长)|
|role_id|int||||管理员角色编号|
|access|varchar(200)||||角色权限|

## yc_area（地区表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|area_id|int|是|||地区编号(自增长)|
|area_name|varchar(200)||是||地区名称|
|area_parent_id|int||是|0|地区父ID|
|area_sort|int||是|0|排序|
|area_deep|int||是||地区深度|
|area_region|varchar(20)||是||大区名称|

## yc_edu_level（文化程度表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|edu_level_id|int|是|||文化程度编号(自增长)|
|edu_level_name|varchar(20)||||文化程度名称|

## yc_members（会员表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|member_id            int not null auto_increment|会员编号|
|area_id              int|地区编号|
|edu_level_id         int|文化程度编号|
|username             varchar(20)|用户名|
|password             varchar(200)|密码|
|nicename             varchar(50)|昵称|
|avatar               varchar(200)|头像|
|phone                varchar(15)|手机|
|phone_verify         int|手机是否验证|
|email                varchar(50)|邮箱|
|email_verify         int|邮箱是否验证|
|qq                   varchar(15)|QQ号|
|member_addr          varchar(200)|详细地址|
|sex                  int|性别|
|birthday             int|生日|
|summary              varchar(200)|简介|
|state                int not null default 0|状态|
|delete_time          int default NULL|软删除|
|update_time          int default NULL|更新时间|
|create_time          int not null|创建时间|

## yc_oauth_members（第三方登录会员表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|oauth_member_id      int not null auto_increment|编号|
|member_id            int|会员编号|
|platform_type        int not null|平台类别|
|openid               varchar(50) not null|第三方平台用户标识|
|token                varchar(200) not null|口令|
|userinfo             varchar(2000) not null|第三方平台用户信息|

## yc_model（模型表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|model_id             int not null auto_increment|模型编号|
|model_name           varchar(20) not null|模型名称|
|del_lock             int default 0|删除锁|
|delete_time          int default NULL|软删除|
|update_time          int default NULL|更新时间|
|create_time          int not null|创建时间|

## yc_model_properties（模型属性表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|model_properties_id  int not null auto_increment|模型属性编号|
|model_id             int|模型编号|
|pro_name             varchar(20) not null|属性名称|
|pro_key              varchar(20) not null|属性KEY|
|pro_cate             int not null|属性类型|
|pro_desc             varchar(200)|属性说明|

## yc_category（类别表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|category_id          int not null auto_increment|类别编号|
|model_id             int|模型编号|
|seo_title            varchar(200)|SEO标题|
|seo_url              varchar(200) not null|SEOURL|
|seo_key              varchar(200)|SEO关键词|
|seo_desc             varchar(200)|SEO描述|
|category_name        varchar(20) not null|类别名称|
|list_template        varchar(200) not null|列表页模板|
|info_template        varchar(200) not null|详情页模板|
|category_sort        int not null default 0|排序|
|parent_category_id   int|上级类别编号|
|delete_time          int default NULL|软删除|
|update_time          int default NULL|更新时间|
|create_time          int not null|创建时间|
|del_lock             int default 0|删除锁|

## yc_contents（内容表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|content_id           int not null auto_increment|内容编号|
|category_id          int|类别编号|
|user_id              int|管理员用户编号|
|title                varchar(50) not null|标题|
|cover                varchar(200)|封面|
|intro                varchar(500) not null|简介|
|content              text not null|内容|
|read_number          int not null default 0|阅读量|
|comment_number       int not null default 0|评论量|
|seo_title            varchar(200)|SEO标题|
|seo_url              varchar(200) not null|SEOURL|
|seo_key              varchar(200)|SEO关键词|
|seo_desc             varchar(200)|SEO描述|
|model_vlues          varchar(2000)|模型属性值|
|content_sort         int not null default 0|排序|
|content_state        int not null default 0|状态|
|push_time            int|发布时间|
|delete_time          int default NULL|软删除|
|update_time          int default NULL|更新时间|
|create_time          int not null|创建时间|

## yc_pages（页面表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|page_id              int not null auto_increment|页面编号|
|title                varchar(50)|标题|
|cover                varchar(200)|封面|
|intro                varchar(500)|简介|
|seo_title            varchar(200)|SEO标题|
|seo_url              varchar(200) not null|SEOURL|
|seo_key              varchar(200)|SEO关键词|
|seo_desc             varchar(200)|SEO描述|
|content              text|内容|
|template             varchar(200) not null|模板|
|read_number          int not null default 0|阅读量|
|page_sort            int not null default 0|排序|
|page_state           int not null default 0|状态|
|delete_time          int default NULL|软删除|
|update_time          int default NULL|更新时间|
|create_time          int not null|创建时间|

## yc_tags（标签表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|tag_id               int not null auto_increment|标签编号|
|tag_name             varchar(50) not null|标签名称|

## yc_content_tags（内容标签表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|content_tag_id       int not null auto_increment|内容标签编号|
|content_id           int|内容编号|
|tag_id               int|标签编号|

## yc_guestbook（留言表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|guestbook_id         int not null auto_increment|留言编号|
|nickname             varchar(20) not null|昵称|
|phone                varchar(20)|手机|
|email                varchar(50)|邮箱|
|guestbook_title      varchar(50) not null|标题|
|guestbook_content    varchar(500) not null|内容|
|guestbook_state      int not null default 0|状态|
|create_time          int not null|创建时间|

## yc_comments（内容评论表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|content_comment_id   int not null auto_increment|内容评论编号|
|content_id           int|内容编号|
|member_id            int default 0|会员编号|
|avatar               varchar(200)|头像|
|nickname             varchar(20)|昵称|
|phone                varchar(20)|手机|
|email                varchar(50)|邮箱|
|comment_content      varchar(500)|评论内容|
|comment_state        int not null default 0|状态|
|comment_push_time    int|发布时间|
|parent_commit_id     int|上级评论编号|
|create_time          int not null|创建时间|

## yc_navs（导航表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|nav_key              varchar(200) not null|导航标识|
|nav_name             varchar(200) not null|导航名称|
|del_lock             int not null default 0|删除锁|
|update_time          int default NULL|更新时间|
|create_time          int not null|创建时间|

## yc_menus（菜单表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|menu_id              int not null auto_increment|菜单编号|
|nav_key              varchar(200)|导航标识|
|nav_name             varchar(20) not null|菜单名称|
|nav_type             int not null|菜单分类|
|nav_value            varchar(255) not null|菜单值|
|nav_target           varchar(10)|菜单打开方式|
|nav_sort             int not null default 0|菜单排序|
|parent_menu_id       int|上级菜单编号|
|update_time          int default NULL|更新时间|
|create_time          int not null|创建时间|
=======
## yc_role（管理员角色表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|role_id|int|是|||是|管理员角色编号(自增长)|
|role_name|varchar(50)||||是|角色名称|
|del_lock|int||是|0||删除锁|
|delete_time|int||是|NULL||软删除|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|

## yc_users（管理员用户表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|user_id|int|是|||是|管理员用户编号(自增长)|
|role_id|int|||||管理员角色编号|
|nickname|varchar(50)||是|||昵称|
|avatar|varchar(200)||是|||头像|
|username|varchar(200)||||是|用户名|
|password|varchar(200)|||||密码|
|email|varchar(50)||是|||邮箱|
|phone|varchar(15)||是|||手机|
|qq|varchar(15)||是|||QQ号|
|last_login_time|int||是|||最后登陆时间|
|last_login_ip|varchar(20)||是|||最后登陆IP|
|del_lock|int||是|0||删除锁|
|state|int||是|0||状态|
|delete_time|int||是|NULL||软删除|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|

### 关系
- `yc_users.role_id` = `yc_role.role_id`

## yc_role_access（管理员角色权限表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|user_role_access_id|int|是|||是|管理员角色权限编号(自增长)|
|role_id|int|||||管理员角色编号|
|access|varchar(200)|||||角色权限|

### 关系
- `yc_role_access.role_id` = `yc_role.role_id`

## yc_area（地区表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|area_id|int|是|||是|地区编号(自增长)|
|area_name|varchar(200)||是|||地区名称|
|area_parent_id|int||是|0||地区父ID|
|area_sort|int||是|0||排序|
|area_deep|int||是|||地区深度|
|area_region|varchar(20)||是|||大区名称|

## yc_edu_level（文化程度表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|edu_level_id|int|是|||是|文化程度编号(自增长)|
|edu_level_name|varchar(20)|||||文化程度名称|

## yc_members（会员表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|member_id|int|是|||是|会员编号(自增长)|
|area_id|int|||||地区编号|
|edu_level_id|int|||||文化程度编号|
|username|varchar(20)||||是|用户名|
|password|varchar(200)|||||密码|
|nicename|varchar(50)||是|||昵称|
|avatar|varchar(200)||是|||头像|
|phone|varchar(15)||是|||手机|
|phone_verify|int||是|||手机是否验证|
|email|varchar(50)||是|||邮箱|
|email_verify|int||是|||邮箱是否验证|
|qq|varchar(15)||是|||QQ号|
|member_addr|varchar(200)||是|||详细地址|
|sex|int||是|0||性别|
|birthday|int||是|||生日|
|summary|varchar(200)||是|||简介|
|state|int||是|0||状态|
|delete_time|int||是|NULL||软删除|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|

### 关系
- `yc_members.area_id` = `yc_area.area_id`
- `yc_members.edu_level_id` = `yc_edu_level.edu_level_id`

## yc_oauth_members（第三方登录会员表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|oauth_member_id|int|是|||是|编号(自增长)|
|member_id|int|||||会员编号|
|platform_type|int|||||平台类别|
|openid|varchar(50)||||是|平台用户标识|
|token|varchar(200)|||||口令|
|userinfo|varchar(2000)|||||平台用户信息|

### 关系
- `yc_oauth_members.member_id` = `yc_members.member_id`

## yc_model（模型表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|model_id|int|是|||是|模型编号(自增长)|
|model_name|varchar(20)||||是|模型名称|
|del_lock|int||是|0||删除锁|
|delete_time|int||是|NULL||软删除|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|

## yc_model_properties（模型属性表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|model_properties_id|int|是|||是|模型属性编号(自增长)|
|model_id|int|||||模型编号|
|pro_name|varchar(20)|||||属性名称|
|pro_key|varchar(20)|||||属性KEY|
|pro_cate|int|||||属性类型|
|pro_desc|varchar(200)||是|||属性说明|

### 关系
- `yc_model_properties.model_id` = `yc_model.model_id`

## yc_category（类别表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|category_id|int|是|||是|类别编号(自增长)|
|model_id|int|||||模型编号|
|seo_title|varchar(200)||是|||SEO标题|
|seo_url|varchar(200)||||是|SEOURL|
|seo_key|varchar(200)||是|||SEO关键词|
|seo_desc|varchar(200)||是|||SEO描述|
|category_name|varchar(20)|||||类别名称|
|list_template|varchar(200)|||||列表页模板|
|info_template|varchar(200)|||||详情页模板|
|category_sort|int||是|0||排序|
|parent_category_id|int|||||上级类别编号|
|delete_time|int||是|NULL||软删除|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|
|del_lock|int||是|0||删除锁|

### 关系
- `yc_category.model_id` = `yc_model.model_id`

## yc_contents（内容表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|content_id|int|是|||是|内容编号(自增长)|
|category_id|int|||||类别编号|
|user_id|int|||||管理员用户编号|
|title|varchar(50)|||||标题|
|cover|varchar(200)|||||封面|
|intro|varchar(500)|||||简介|
|content|text|||||内容|
|read_number|int||是|0||阅读量|
|comment_number|int||是|0||评论量|
|seo_title|varchar(200)||是|||SEO标题|
|seo_url|varchar(200)||||是|SEOURL|
|seo_key|varchar(200)||是|||SEO关键词|
|seo_desc|varchar(200)||是|||SEO描述|
|model_vlues|varchar(2000)||是|||模型属性值|
|content_sort|int||是|0||排序|
|content_state|int||是|0||状态|
|push_time|int||是|||发布时间|
|delete_time|int||是|NULL||软删除|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|

### 关系
- `yc_contents.category_id` = `yc_category.category_id`
- `yc_contents.user_id` = `yc_users.user_id`

## yc_pages（页面表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|page_id|int|是|||是|页面编号(自增长)|
|title|varchar(50)|||||标题|
|cover|varchar(200)|||||封面|
|intro|varchar(500)|||||简介|
|seo_title|varchar(200)||是|||SEO标题|
|seo_url|varchar(200)||||是|SEOURL|
|seo_key|varchar(200)||是|||SEO关键词|
|seo_desc|varchar(200)||是|||SEO描述|
|content|text||是|||内容|
|template|varchar(200)|||||模板|
|read_number|int||是|0||阅读量|
|page_sort|int||是|0||排序|
|page_state|int||是|0||状态|
|delete_time|int||是|NULL||软删除|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|

## yc_tags（标签表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|tag_id|int|是|||是|标签编号(自增长)|
|tag_name|varchar(50)||||是|标签名称|

## yc_content_tags（内容标签表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|content_tag_id|int|是|||是|内容标签编号(自增长)|
|content_id|int|||||内容编号|
|tag_id|int|||||标签编号|

### 关系
- `yc_content_tags.tag_id` = `yc_tags.tag_id`
- `yc_content_tags.content_id` = `yc_contents.content_id`

## yc_guestbook（留言表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|guestbook_id|int|是|||是|留言编号(自增长)|
|nickname|varchar(20)|||||昵称|
|phone|varchar(20)||是|||手机|
|email|varchar(50)||是|||邮箱|
|guestbook_title|varchar(50)|||||标题|
|guestbook_content|varchar(500)|||||内容|
|guestbook_state|int||是|0||状态|
|create_time|int|||||创建时间|

## yc_comments（内容评论表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|content_comment_id|int|是|||是|内容评论编号(自增长)|
|content_id|int|||||内容编号|
|member_id|int||是|0||会员编号|
|avatar|varchar(200)||是|||头像|
|nickname|varchar(20)||是|||昵称|
|phone|varchar(20)||是|||手机|
|email|varchar(50)||是|||邮箱|
|comment_content|varchar(500)|||||评论内容|
|comment_state|int||是|0||状态|
|comment_push_time|int||是|||发布时间|
|parent_commit_id|int||是|||上级评论编号|
|create_time|int|||||创建时间|

### 关系
- `yc_comments.content_id` = `yc_contents.content_id`

## yc_navs（导航表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|nav_key|varchar(200)|是|||是|导航标识|
|nav_name|varchar(200)|||||导航名称|
|del_lock|int||是|0||删除锁|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|

## yc_menus（菜单表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|menu_id|int|是|||是|菜单编号(自增长)|
|nav_key|varchar(200)|||||导航标识|
|menu_name|varchar(20)|||||菜单名称|
|menu_type|int|||||菜单分类|
|menu_value|varchar(255)|||||菜单值|
|menu_target|varchar(10)||是|||菜单打开方式|
|menu_sort|int||是|0||菜单排序|
|parent_menu_id|int|||||上级菜单编号|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|

### 关系
- `yc_menus.nav_key` = `yc_navs.nav_key`
>>>>>>> upstream/develop

## yc_ad_code（代码广告表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|ad_code_key|varchar(100)|是|||是|代码广告标识|
|ad_name|varchar(50)|||||名称|
|ad_code|varchar(5000)|||||代码|
|ad_desc|varchar(200)|||||描述|
|delete_time|int||是|NULL||软删除|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|


## yc_ad_images（图片广告表）

<<<<<<< HEAD
|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|ad_img_key|varchar(100)|是|||图片广告标识|
|cover|varchar(200)||||封面|
|title|varchar(20)||||标题|
|href|varchar(500)||||链接|
|ad_desc|varchar(200)||是||描述|
|content|text||是||内容|
|delete_time|int||是|NULL|软删除|
|update_time|int||是|NULL|更新时间|
|create_time|int||||创建时间|

## yc_ad_text（文字广告表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|ad_text_key|varchar(100)|是|||文字广告标识|
|title|varchar(20)||||标题|
|href|varchar(500)||||链接|
|ad_desc|varchar(200)||是||描述|
|delete_time|int||是|NULL|软删除|
|update_time|int||是|NULL|更新时间|
|create_time|int||||创建时间|

## yc_slides（幻灯片广告表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|slide_key            varchar(100) not null|幻灯片标识|
|slide_name           varchar(200) not null|幻灯片名称|
|delete_time          int default NULL|软删除|
|update_time          int default NULL|更新时间|
|create_time          int not null|创建时间|

## yc_slides_imgs（幻灯片图片表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|slide_img_id         int not null auto_increment|幻灯片图片编号|
|slide_key            varchar(100)|幻灯片标识|
|cover                varchar(200) not null|封面|
|title                varchar(20) not null|标题|
|href                 varchar(500) not null|链接|
|ad_desc              varchar(200)|描述|
|content              text|内容|
|sort                 int not null default 0|排序|
|update_time          int default NULL|更新时间|
|create_time          int not null|创建时间|

## yc_img_type（图片分类表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|img_type_id|int|是|||图片分类编号(自增长)|
|type_name|varchar(20)||||分类名称|
|update_time|int||是|NULL|更新时间|
|create_time|int||||创建时间|

## yc_imgs（图片表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|img_id|int|是|||图片编号(自增长)|
|img_type_id|int||||图片分类编号|
|img_title|varchar(20)||||图片标题|
|img_src|varchar(255)||||图片地址|
|img_desc|varchar(200)||是||图片描述|
|create_time|int||||创建时间|

## yc_links（友情链接表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|link_id|int|是|||友情链接编号(自增长)|
|link_name|varchar(200)||是||链接名称|
|link_logo|varchar(255)||是||链接图标|
|link_href|varchar(255)||||链接地址|
|link_target|varchar(50)||是||打开方式|
|link_is_home|int||是||是否是首页|
|link_sort|int|||0|排序编号|
|create_time|int||||创建时间|
=======
|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|ad_img_key|varchar(100)|是|||是|图片广告标识|
|cover|varchar(200)|||||封面|
|title|varchar(20)|||||标题|
|href|varchar(500)|||||链接|
|ad_desc|varchar(200)||是|||描述|
|content|text||是|||内容|
|delete_time|int||是|NULL||软删除|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|

## yc_ad_text（文字广告表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|ad_text_key|varchar(100)|是|||是|文字广告标识|
|title|varchar(20)|||||标题|
|href|varchar(500)|||||链接|
|ad_desc|varchar(200)||是|||描述|
|delete_time|int||是|NULL||软删除|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|

## yc_slides（幻灯片广告表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|slide_key|varchar(100)|是|||是|幻灯片标识|
|slide_name|varchar(200)|||||幻灯片名称|
|delete_time|int||是|NULL||软删除|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|

## yc_slides_imgs（幻灯片图片表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|slide_img_id|int|是|||是|幻灯片图片编号(自增长)|
|slide_key|varchar(100)|||||幻灯片标识|
|cover|varchar(200)|||||封面|
|title|varchar(20)|||||标题|
|href|varchar(500)|||||链接|
|ad_desc|varchar(200)||是|||描述|
|content|text||是|||内容|
|sort|int||是|0||排序|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|

### 关系
- `yc_slides_imgs.slide_key` = `yc_slides.slide_key`

## yc_img_type（图片分类表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|img_type_id|int|是|||是|图片分类编号(自增长)|
|type_name|varchar(20)||||是|分类名称|
|update_time|int||是|NULL||更新时间|
|create_time|int|||||创建时间|

## yc_imgs（图片表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|img_id|int|是|||是|图片编号(自增长)|
|img_type_id|int|||||图片分类编号|
|img_title|varchar(20)|||||图片标题|
|img_src|varchar(255)|||||图片地址|
|img_desc|varchar(200)||是|||图片描述|
|create_time|int|||||创建时间|

### 关系
- `yc_imgs.img_type_id` = `yc_img_type.img_type_id`

## yc_links（友情链接表）

|字段|类型|主键|可为空|默认值|是否唯一|说明|
|------|------|------|------|------|------|------|
|link_id|int|是|||是|友情链接编号(自增长)|
|link_name|varchar(200)||是|||链接名称|
|link_logo|varchar(255)||是|||链接图标|
|link_href|varchar(255)|||||链接地址|
|link_target|varchar(50)||是|||打开方式|
|link_is_home|int||是|||是否是首页|
|link_sort|int||是|0||排序编号|
|create_time|int|||||创建时间|
>>>>>>> upstream/develop
