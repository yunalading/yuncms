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

namespace app\admin\model;
use app\common\model\BaseModel;
use think\Db;
class ConfigModel extends BaseModel
{
    protected $tableName='config';
    /**
     * 获取配置列表信息
     * @Author [chenqianhao] <68527761@qq.com>
     */
    public function getAllConfig()
    {
        return Db::name($this->tableName)->find();
    }







}
