# yuncms数据库说明  
> YunCMS是基于ThinkPHP框架的一套CMS系统，方便用户快速建立企业网站，门户网站，个人博客或其他系统的内容管理系统。


### `yc_admin_user` 管理员用户表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| aid      | int(11) unsigned | | 管理员标识,自增| PRIMARY  |
| aname     | varchar(60)     | | 管理员用户名 |  UNIQUE  |
| password | varchar(32)      | | 登录密码 |   |
| salt | smallint(4)     |   3306 | 密码组合加密字段 |  |
| email | varchar(100)     |  |  管理员邮箱 |  UNIQUE |
| phone | varchar(11)     |   |  用户手机号 | UNIQUE |
| avator | varchar(50)     |  | 用户头像 |  |
| lasttime | int(11) unsigned  | 0  |    用户最后登陆时间 |  |
| lastip | varchar(15)     |  |  最后登陆用户本地ip |  |
| islock | tinyint(1) unsigned     |  0 |  用户是否锁定:0正常1锁定 |   |
| status | tinyint(1) unsigned     |  0 |  用户状态:0正常1删除 |  |
| regtime | int(11) unsigned     |  0 | 注册时间  |  |


### `yc_config` 网站系统配置表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| webname | varchar(30) | | 网站名称 |  |
| domain | varchar(50) |  | 网站域名 |  |
| website | varchar(255) | | 网站备案信息 |  |
| copyright | varchar(100) | | 版权信息 |  |
| theme | varchar(50) |  | 后台默认主题 |   |
| forbitip | text |  | 禁止访问IP（英文逗号隔开） | |
| mail | varchar(100) |  | 站长邮箱 |  |
| QQ | int(15) unsigned | 0 | 站长联系QQ |  |
| keyword | varchar(255) |   | 网站关键字 |  |
| description | text |  |  网站描述，网站简介 |  |
| logo | varchar(255) |  | 网站的logo地址 |  |
| captcha| tinyint(1) | 1 | 是否开启后台登录验证码0关闭1开启 |  |



### `yc_autoconfig` 自定义配置项表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| conf_id | int(11) unsigned | | 自增标识| PRIMARY  |
| conf_title | varchar(50) |  | 名称 |  |
| conf_name | varchar(50) |  | 变量名 |   |
| conf_value | text | | 变量值 |  |
| conf_order | int(5) unsigned  | 100 | 排序|  |
| conf_tips | varchar(150) |  | 描述说明 | |
| conf_type | tinyint(1) unsigned | 0 | 类型0配置项1模型 |  |
| conf_mid | int(11) unsigned | 0 | 如果type=1,此处对应yc_module表的m_id |  |
| conf_addtime | int(11) unsigned     |  0 | 添加时间  |  |
| field_type | varchar(50) |  |  字段类型 |  |
| field_value | varchar(255) |  | 类型值(如field_type值为"radio"时field_value可设为 '1|开启,0|关闭') |  |



### `yc_menu` 后台菜单管理表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| id     | int(11) unsigned | |  菜单标识,自增| PRIMARY  |
| title    | varchar(50)     | | 标题 | |
| type | varchar(10)  | admin | 菜单类别（admin后台，user会员中心） |   |
| icon | varchar(50)  |  | 菜单图标 |  |
| pid | int(10) unsigned | 0 | 上级分类ID |  |
| sort | int(10) unsigned   | 100  |  排序（同级有效） | |
| url | varchar(255) |  | 链接地址 |  |
| hide | tinyint(1) unsigned | 0  | 是否隐藏0显示1隐藏 |  |
| tip | text  |  | 提示说明 |  |
| group | varchar(50) |   | 分组 |   |
| addtime | int(11) |  0 |  添加时间 |  |
| is_dev | tinyint(1) unsigned  |  0 | 是否仅开发者模式可见 |  |
| status | tinyint(1) unsigned  |  0 | 菜单状态:0正常1删除 |  |



### `yc_module` 模型表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| mid | int(11) unsigned | | 自增标识| PRIMARY  |
| mname | varchar(50) | 1 | 模型名称 |  |
| module | varchar(50) | | 模型英文标识 |  UNIQUE |
| addtime | int(11) unsigned    | 0 | 添加时间 |  |



### `yc_auth_group` 用户权限组表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| gid | mediumint(11) unsigned | | 自增标识| PRIMARY  |
| type | tinyint(1) unsigned | 1 | 组类型0前台1后台 |  |
| title| varchar(30) | | 用户组中文名称 |   |
| description | varchar(150)  | | 用户主描述 |  |
| status | tinyint(1) unsigned  | 1 |  用户组状态：为1正常，为0禁用,2为删除 | |
| rules | varchar(100) |   |  用户组拥有的规则id，多个规则 , 隔开 |  |
| addtime | int(11) unsigned    | 0 | 添加时间 |  |


### `yc_auth_group_access` 用户和所在组对应关系表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| aid | int(11) unsigned | 0 | 用户标识 |  |
| gid | int(11) unsigned | 0 | 用户组标识 | |



### `yc_auth_rule` 用户规则表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| id | mediumint(11) unsigned | | 自增标识| PRIMARY  |
| module | varchar(30) |  | 规则所属模型 |  KEY |
| type | tinyint(2) | 1 | 1-url规则;2-主菜单 |  KEY |
| name | varchar(80) | | 规则唯一英文标识 | UNIQUE |
| title | varchar(20)  | | 规则中文描述 |  |
| group| varchar(20) |  | 权限节点分组 | |
| addtime| int(11) unsigned | 0 |  添加时间 |  |
| status | tinyint(1) | 1 | 是否有效(0:无效,1:有效)| KEY |
| sort | int(5) unsigned | 100 | 排序 |  |
| condition | text | | 规则附加条件 |  |


### `yc_category` 网站栏目分类表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| cate_id | int(11) unsigned | | 栏目标识,自增| PRIMARY  |
| cate_name  | varchar(50)  | | 分类名称 | |
| cate_title | varchar(100) | | 栏目分类说明 |   |
| cate_keywords | varchar(150)  |  | 网站描述 |  |
| cate_description | text |  | 网站描述 |  |
| cate_view | int(10) unsigned  | 0 | 查看次数 |   |
| cate_pid | int(5) unsigned | 0 |  父级栏目cate_id |  |
| cate_order | tinyint(4) unsigned  | 100 | 栏目排序 |  |
| cate_module | varchar(50)  |   | 所属模型 |  |
| cate_template | varchar(50)  |   | 栏目列表模板 |  |
| cate_status | tinyint(1) unsigned  |  0 | 栏目前台显示状态:0正常显示，1隐藏 |  |


### `yc_article` 文章内容表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| atr_id    | int(11) unsigned | | 文章id标识,自增| PRIMARY  |
| art_title    | varchar(100)     | | 文章标题 |   |
| art_keywords | varchar(100)      | | 关键词 |   |
| art_description | varchar(255)     |  | 描述|  |
| art_thumb | varchar(100)     |  |  缩略图 |   |
| art_content | text     |   |  内容 |  |
| art_addtime | int(11) unsigned   | 0 | 发布时间 |  |
| art_author | varchar(50)  |   | 文章作者 |  |
| art_view | int(11) unsigned  |  0 | 查看次数 |  |
| art_cate_id | varchar(100)  |   | 所属栏目的cate_id,多个栏目用逗号(,)隔开 |  |
| art_status| tinyint(1) unsigned     |  0 |  文章显示状态：0正常显示，1隐藏 |  |
| art_order | tinyint(5) unsigned     |  100 |  文章排序 |   |
| art_module | varchar(50) |   | 模板指定模型,没指定默认用上级栏目的 |   |
| art_template | varchar(50) |   |  文章模板 |   |


### `yc_zt` 单页面/专题表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| zt_id | int(11) unsigned | |  自增| PRIMARY  |
| zt_title | varchar(100)  | | 专题标题 | |
| zt_keywords | varchar(100) |  | 关键词 | |
| zt_description | text  |  | 描述 |  |
| zt_thumb | varchar(255) |  | 缩略图 |  |
| zt_content | text     |   |  内容 |  |
| zt_addtime | int(11) unsigned   | 0 | 发布时间 |  |
| zt_author | varchar(50)  |   | 作者 |  |
| zt_view | int(11) unsigned  |  0 | 查看次数 |  |
| zt_status | tinyint(1) unsigned |  0 |  显示状态：0正常显示，1隐藏 |  |
| zt_order | tinyint(5) unsigned |  100 |  排序 |   |
| zt_module | varchar(50) |   | 模板指定模型 |   |
| zt_template | varchar(50) | |  专题模板 |  |




### `yc_comment` 用户文章评论表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| com_id   | int(11) unsigned | | 文章id标识,自增| PRIMARY  |
| com_user_id | int(11) unsigned | 0 | 评论用户的id,0为匿名用户 |   |
| com_user_name | varchar(50)  | | 评论用户的名称 |   |
| com_art_id | int(11) unsigned |  | 评论的文章id |  |
| com_addtime | int(11) unsigned | 0 | 评论的时间 |  |
| com_content | text |  |  评论内容 |   |
| com_reply_id | int(11) unsigned | 0 | 管理员回复人id |  |
| com_reply_msg | text  |  | 管理员回复内容 |  |
| com_reply_time | int(11) unsigned | 0 | 回复的时间 |  |
| com_is_sh | tinyint(1) unsigned | 0  | 是否审核（0未审核1审核通过2审核不通过） |  |
| com_sh_time | int(11) unsigned | 0 | 审核的时间 |  |
| com_sh_aid | int(11) unsigned | 0 | 审核管理员 |  |
| com_order | int(5) unsigned | 100 | 排序 |  |


### `yc_guestbook` 用户留言表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| guest_id  | int(11) unsigned | | 自增 | PRIMARY  |
| guest_name | varchar(255) |  | 姓名 |   |
| guest_email | varchar(255)  | | 邮箱 |   |
| guest_tel | varchar(11) |  | 电话|  |
| guest_order | tinyint(5) unsigned  | 100 |  排序编号 |   |
| guest_msg | text | 0 | 留言内容 |  |
| guest_addtime | int(11) unsigned | 0 | 留言时间 |  |
| guest_view | tinyint(1) unsigned | 0  | 是否查看（0未查看1已经查看） |  |
| guest_status | tinyint(1) unsigned | 0 | 是否删除:0未删除1已删除 |  |



### `yc_links` 友情链接表
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| link_id | int(11) unsigned | | 自增 | PRIMARY  |
| link_name | varchar(150) |  | 链接名称 |   |
| link_logo | varchar(255)  | | 链接图标 |   |
| link_url | varchar(255) |  | 链接 |  |
| link_order | tinyint(5) unsigned | 100 |  排序编号 |   |
| link_type | tinyint(1) unsigned | 1 | 1站内链接2外网链接 |  |
| link_show| tinyint(1) unsigned | 1 | 0隐藏1正常显示 |  |
| link_addtime| int(11) unsigned | 0 | 添加时间 |  |




### `yc_admin_log` 后台管理员操作日志表  
| 字段           | 类型           | 默认值 | 注释  | 索引  |
| ------------- |-------------| ----- | -----| -----|
| log_id      | int(11) | | 自增| PRIMARY  |
| log_type     | tinyint(1)  | 0 |日志类型：0管理员；1用户中心 |    |
| log_aid     | int(11) unsigned     | | 操作的管理员标识 |    |
| log_action | varchar(150)      | | 操作的控制器和方法 |   |
| log_value | varchar(30)     |    | 操作该动作的英文标识 |  |
| log_desc | text     |  |  中文描述 |   |
| log_remark | text     |   |  其它备注 |  |
| log_addtime | int(11) unsigned    | 0  | 日志添加时间 |  |
| log_del | tinyint(1) unsigned  | 0  |    是否删除1删除0未删除 |  |
| log_addip| varchar(15)     |  |  记录操作用户ip |  |
