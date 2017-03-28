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

use app\core\upload\FileMate;
use phpDocumentor\Reflection\Types\Null_;
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
        //$config =  isset(Config::get('upload.image'))?Config::get('upload.image'):'';

//        $upload = \app\core\upload\Upload::getInstance(['uploadType' => 'Server']);
//        echo $upload->upload(null);
        return view();
    }

    /**
     *
     */
    public function add(){

    }
}
