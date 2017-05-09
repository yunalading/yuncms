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

namespace app\core\install;

/**
 * Interface FormValidateInterface
 * @package app\core\install
 */
interface FormValidateInterface {
    /**
     * 安装表单验证接口，成功需要保存安装表单
     * @return bool
     */
    public function validateForm();
}
