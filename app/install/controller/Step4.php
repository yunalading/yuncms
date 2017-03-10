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


namespace app\install\controller;
use app\core\Install;
use app\core\db\DbHelp;
use think\Config;

/**
 * Class Complete
 * @package app\install\controller
 */
class Step4 extends InstallWizard {
    /**
     * @return \think\response\View
     */
    public function index() {
        $param = Install::checkStep3();
        if($param === false){
            return $this->redirect('/install/step3');
        }
        $db = $param['db'];
        try{
            $dbconfig = DbHelp::getDbConfig($db);
            $coon = \think\Db::connect($dbconfig);
            DbHelp::addDb($db['database'],$coon);
        }catch(\PDOException $e){
            if(substr($e->getMessage(),0,39) == 'SQLSTATE[HY000] [1049] Unknown database'){
                try{
                    $dbname = $db['database'];
                    $db['database']='mysql';
                    $dbconfig = DbHelp::getDbConfig($db);
                    $coon = \think\Db::connect($dbconfig);
                    DbHelp::addDb($dbname,$coon);
                }catch(\PDOException $e){
                    $this->error("请检查数据库账号或密码是否输入有误!");
                }
            }else {
                $this->error("请检查数据库账号或密码是否输入有误!");
                //$this->error($e->getMessage());
            }
        }
        $dbconfig['database'] = $param['db']['database'];
        $path_config = APP_PATH.'database.php';
        if (!is_writable($path_config)) {
            $this->error("配置文件".$path_config."没有写入权限!");
        }
        //writeConfig($path_config,$dbconfig);
        if(!writeConfig($path_config,$dbconfig)){
            $this->error("配置文件".$path_config."写入失败!");
        }


        return view();
    }

    /**
     * 执行安装
     * @return string
     */
    public function setup() {

        return json_encode([]);
    }
}
