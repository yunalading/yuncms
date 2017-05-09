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


namespace app\core\db;

use think\Db;
use think\db\Connection;

/**
 * Class DbHelper
 * @package app\core\db
 */
abstract class DbHelper {
    protected $host;
    protected $username;
    protected $password;
    protected $database;
    protected $port = 3306;
    protected $type = '';

    /**
     * 获取数据库连接
     * @return Connection
     */
    protected function connection() {
        return Db::connect(array(
            'type' => $this->type,
            'hostname' => $this->host,
            'database' => $this->database,
            'username' => $this->username,
            'password' => $this->password,
            'hostport' => $this->port
        ));
    }

    /**
     * 连接测试
     * @return bool
     */
    public abstract function connectionTest();

    /**
     * 数据库是否存在
     * @param $database
     * @return bool
     */
    public abstract function databaseExists($database);

    public function setDatabase($database) {
        $this->database = $database;
    }

    /**
     * 创建数据库
     * @param $database
     * @return bool
     */
    public abstract function createDatabase($database, $charset);

    /**
     * 数据库版本
     * @return string
     */
    public abstract function version();

    /**
     * 执行SQL语句
     * @param $sql
     * @return int
     */
    public abstract function exeSQL($sql);
}
