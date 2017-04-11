<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: chenqianhao <68527761@qq.com>
// +----------------------------------------------------------------------

namespace app\core\upload\driver;

use app\core\upload\Upload;

/**
 * 本地化调试输出到文件
 */
class Server extends Upload
{
    public function upload($conf,$file)
    {
        $config = config('upload.image');
        if(isset($conf) && is_array($conf)){
            $newConf = array_merge($config, $conf);
        }else{
            $newConf =  $config;
        }
        $info = $file->move(ROOT_PATH . 'public' . DS . 'data' . DS . 'upload' .DS. 'images');
        $info->pathUrl =  'data' . DS . 'upload' .DS. 'images' .DS.$info->getSaveName();
        return $info;
    }
}
