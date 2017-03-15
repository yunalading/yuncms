# 删除锁
在系统初始的信息是不充许做删除操作的。如默认的`超级管理员`账号。我们在`app\common\model\BaseModel.php`中定义了删除锁字段`$del_lock_field`，用来指定表的删除锁字段，指定了表删除锁字段的模型，在删除数据库的时候会难证数据是否可以被删除。
- BaseModel::DEL_LOCK_OFF = 0  表示可以被删除，数据添加时默认为DEL_LOCK_OFF。
- BaseModel::DEL_LOCK_ON = 1 表示不能被删除。
