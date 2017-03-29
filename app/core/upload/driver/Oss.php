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

use app\core\upload\FileMate;
use app\core\upload\Upload;


class Oss extends Upload
{
    public function upload(FileMate $mete)
    {
        // TODO: Implement upload() method.
        return self::class;
    }

}
