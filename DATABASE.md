# 数据库设计文档

## 说明
> `profile`

# 系统管理员模块

## 管理员角色表

## 管理员用户表

## 管理员角色权限表

# 地区模块

# 用户模块

# 模型模块

# 内容模块

# 页面模块

# 标签模块

# 留言模块

# 评论模块

# 导航模块

# 广告模块

## yc_ad_code（代码广告表）

|字段|类型|主键|可为空|默认值|说明|
|------|------|------|------|------|
|ad_code_key   |varchar(100)  |是|||代码广告标识|
|ad_name       |varchar(50)   ||||名称|
|ad_code       |varchar(5000) ||||代码|
|ad_desc       |varchar(200)  ||||描述|
|delete_time   |int           ||是|NULL|软删除|
|update_time   |int           ||是|NULL|更新时间|
|create_time   |int           ||||创建时间|


## yc_ad_images（图片广告表）
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

## 文字广告表

# 图片模块

# 友情链接模块
