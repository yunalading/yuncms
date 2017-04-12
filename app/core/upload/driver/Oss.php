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
use OSS\OssClient;
use OSS\Core\OssException;

/**
 * Class Oss
 * 阿里云oss存储上传
 * 配置文件优先级别：手动设置>oss设置>image公共设置
 * @package app\core\upload\driver
 * 先上传到本地服务器，然后上传到阿里云服务器
 */
class Oss extends Upload
{
    public function upload($file,$conf)
    {
        $conf = array_merge(config('upload.image'), $conf);
        $config = config('upload.oss');
        if(isset($conf) && is_array($conf)){
            $newConf = array_merge($config, $conf);
        }else{
            $newConf =  $config;
        }
        //实例化OSS
        $ossClient=new OssClient($newConf['KeyId'],$newConf['KeySecret'],$newConf['Endpoint']);
        $res = (object)array(); //申明一个空对象返回
        try{
            //$info = $file->validate(['size' => $newConf['maxSize'], 'ext' => $newConf['allowExts']])->move(ROOT_PATH . 'public' . DS . 'data' . DS . 'upload' .DS. 'images' .DS. 'oss');
            $info = $file->validate(['size' => $newConf['maxSize'], 'ext' => $newConf['allowExts']])->move(ROOT_PATH . 'public' . DS . $newConf['savePath']);
            if (!$info) {
                $res->info=$file->getError();
                $res->code=0;
                $res->msg=$file->getError();
                return $res;
            }
            //$fileName = 'data' . DS .'upload' .DS. 'images' .DS. 'oss' .DS. $info->getSaveName();
            $fileName =  $newConf['savePath'] .DS. $info->getSaveName();
            $oss_info = $ossClient->uploadFile($newConf['Bucket'],$fileName, $info->getPathname());
            $res->pathUrl =  $oss_info['oss-request-url'];
            $res->info=$oss_info;//oss-request-url
            $res->code=1;
            $res->msg="上传成功!";
        } catch(OssException $e) {
            //如果出错这里返回报错信息
            //return $e;
            $res->info=$e->getMessage();
            $res->code=0;
            $res->msg="上传失败!";
            return $res;
        }
        return $res;
    }

}
