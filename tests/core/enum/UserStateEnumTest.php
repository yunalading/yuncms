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


namespace tests\core\enum;

use app\core\enum\UserStateEnum;
use tests\TestCase;

class UserStateEnumTest extends TestCase {
    public function testState() {
        $this->assertNotEquals(UserStateEnum::BY,UserStateEnum::HI,'Not Equals');
    }
}