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
use think\File;
use think\Exception;

/**
 * Class Server
 * upload.image为公共验证配置
 * 配置文件优先级别：手动设置>server设置>image公共设置
 * 上传到服务器目录
 * @package app\core\upload\driver
 */
class Server extends Upload
{
    public function upload($file,$conf)
    {
        $config = config('upload.server');
        if(isset($conf) && is_array($conf)) {
            $conf = array_merge($config, $conf);
        }else{
            $conf = $config;
        }
        $newConf = array_merge(config('upload.image'), $conf);
        $res = (object)array(); //申明一个空对象返回
        //try{
            $size = ceil($newConf['maxSize']*1048576);
            $info = $file->validate(['size' => $size, 'ext' => $newConf['allowExts']])->move(ROOT_PATH . 'public' . DS . $newConf['savePath']);
            if (!$info) {
                $res->info=$file->getError();
                $res->code=0;
                $res->msg="验证失败!";
                return $res;
            }
            $res->pathUrl =  $newConf['savePath'] .DS. $info->getSaveName();
            $res->info=$info;
            $res->code=1;
            $res->msg="上传成功!";
//        } catch(\Exception $e) {
//            //如果出错这里返回报错信息
//            //return $e;
//            $res->info=$e->getMessage();
//            $res->code=0;
//            $res->msg="上传失败!";
//            return $res;
//        }
        return $res;
    }
}
