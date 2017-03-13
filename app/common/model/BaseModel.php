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
namespace app\common\model;

use think\Model;

/**
 * Class BaseModel
 * @package app\common\model
 */
abstract class BaseModel extends Model {
    //设置删除锁字段，如果设置就会开启删除锁
    protected $del_lock_field = '';
    //不允许删除
    const DEL_LOCK_ON = 1;
    //允许删除
    const DEL_LOCK_OFF = 0;

    public function __construct($data = []) {
        parent::__construct($data);
        //添加删除锁处理
        static::event('before_delete', function ($model) {
            if ($this->del_lock_field) {
                //已开启删除锁
                if ($model[$this->del_lock_field] == BaseModel::DEL_LOCK_ON) {
                    //不删除
                    return false;
                }
            }
            return true;
        });
    }
}
