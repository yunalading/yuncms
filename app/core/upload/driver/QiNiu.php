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

use think\Exception;
use app\core\upload\Upload;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;

/**
 * Class Oss
 * 七牛云存储上传
 * 配置文件优先级别：手动设置>qiniu设置>image公共设置
 * @package app\core\upload\driver
 * 先上传到本地服务器，然后上传到七牛云存储
 */
class QiNiu extends Upload
{
    public function upload($file, $conf)
    {
        $config = config('upload.qiniu');
        if (isset($conf) && is_array($conf)) {
            $conf = array_merge($config, $conf);
        } else {
            $conf = $config;
        }
        $newConf = array_merge(config('upload.image'), $conf);
        $res = (object)array(); //申明一个空对象返回
        try {
            $info = $file->validate(['size' => $newConf['maxSize'], 'ext' => $newConf['allowExts']])->move(ROOT_PATH . 'public' . DS . $newConf['savePath']);
            if (!$info) {
                $res->info = $file->getError();
                $res->code = 0;
                $res->msg = $file->getError();
                return $res;
            }
            // 构建鉴权对象
            $auth = new Auth($newConf['KeyId'], $newConf['KeySecret']);
            // 生成上传 Token
            $token = $auth->uploadToken($newConf['Bucket']);
            // 初始化 UploadManager 对象并进行文件的上传。
            $upManager = new UploadManager();
            // 调用 UploadManager 的 putFile 方法进行文件的上传。
            $fileName =  $newConf['savePath'] .DS. $info->getSaveName();
            list($ret, $err) = $upManager->putFile($token, $fileName, $fileName);
            if ($err !== null) {
                $res->info = $err;
                $res->code = 0;
                $res->msg = "七牛上传失败！";
                return $res;
            } else {
                $res->pathUrl = $newConf['Endpoint'].DS.$ret['key'];
                $res->info = $ret;
                $res->code = 1;
                $res->msg = "七牛上传成功!";
            }
        } catch (\Exception $e) {
            $res->info = $e->getMessage();
            $res->code = 0;
            $res->msg = "上传失败!";
            return $res;
        }
        return $res;
    }

}
