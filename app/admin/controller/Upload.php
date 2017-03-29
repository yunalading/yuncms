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
use app\core\upload\FileMate;
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
        $config = config::get('upload.image');
//        $upload = \app\core\upload\Upload::getInstance(['uploadType' => 'Server']);
//        echo $upload->upload(null);
        $this->assign('config',$config);
        return view();
    }

    /**
     * 修改上传配置
     */
    public function edit(){
        if ($this->request->isPost()) {
            $post = $this->post;
            $valiDate = new UploadValidate();
            if (!$valiDate->check($post, [], 'update')) {
                $this->error($valiDate->getError());
            }
            $upload = config('upload');
            unset($post['__token__']);
            //savePath 需要根据网站路径进行处理
            $config['image'] = $post;
            $newConfig = array_merge($upload, $config);
            writeJsonConfig(APP_PATH . 'extra' . DS . 'upload.json', $newConfig);
            $this->success('操作成功');
        }else{
            $this->error('未做任何修改！');
        }
    }
}
