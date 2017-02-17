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

/**
 * [获取数据库的版本]
 * @return [string] [数据库版本]
 */
function getmysqlversion(){
    $sql="select version() as version";
    $a=\think\Db::query($sql);
    if($a){
      return $a[0]['version'];
    }else{
      return false;
    }
}
