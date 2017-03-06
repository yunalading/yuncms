# 角色权限控制系统
YunCMS实现了简单的RBAC权限控制系统。

## RBAC在YunCMS的实现步聚
- 判断是否登录
- 判断请求是否需要验证权限。
- 获取当前用户的角色信息。
- 验证当前角色是否可以访问当前操作。

## `authorization.php`文件
`/app/extra/authorization.php`文件定义了以下规则：
- 后台管理系统的菜单结构。
- RBAC权限管理系统的授权目录。

~~只有在authorization.php文件中配置的操作才会进入权限验证，用来区分请求是否需要验证权限。如登录页面，错误提示页面等是不需要进行权限验证的。~~

需要登录才可以访问的控制器是需要权限权限验证的。