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


namespace app\admin\controller;

use app\admin\validate\UploadValidate;
use think\Config;

/**
 * Class Upload
 * @package app\admin\controller
 */
class Upload extends AdminBaseController
{
    /**
     * @return \think\response\View
     */
    public function index()
    {
        $config = config::get('upload');
        //$config['image']['maxSize'] = str_replace('MB','',byteFormat($config['image']['maxSize'],"MB"));
        $config['image']['ext'] = explode(',',$config['image']['allowExts']);
        $this->assign('config',$config);
        return view();
    }

    /**
     * 修改上传配置
     */
    public function edit(){
        if ($this->request->isPost()) {
            $post = $this->post['upload'];
            $valiDate = new UploadValidate();
            if (!$valiDate->check($post, [], 'update')) {
                $this->error($valiDate->getError());
            }
            unset($post['allowExts']);
            //savePath 需要根据网站路径进行处理
            $config = config::get('upload');
            if (!key_exists('savePath', $post['qiniu'])) {
                $post['qiniu']['savePath'] = $config['qiniu']['savePath'];
            }
            if (!key_exists('savePath', $post['oss'])) {
                $post['oss']['savePath'] = $config['oss']['savePath'];
            }
            $newConfig = array_merge($config,$post);
            writeJsonConfig(APP_PATH . 'extra' . DS . 'upload.json', $newConfig);
            $this->success('操作成功');
        }else{
            $this->error('未做任何修改！');
        }
    }
}
