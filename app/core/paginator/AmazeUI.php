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
namespace app\core\paginator;

use think\paginator\driver\Bootstrap;

/**
 * Class AmazeUI
 * @package app\core\paginator
 */
class AmazeUI extends Bootstrap {

    public function render() {
        if ($this->hasPages()) {
            if ($this->simple) {
                return sprintf(
                    '<ul class="pager">%s %s</ul>',
                    $this->getPreviousButton(),
                    $this->getNextButton()
                );
            } else {
                return sprintf(
                    '<ul class="am-pagination am-pagination-right">%s %s %s</ul>',
                    $this->getPreviousButton(),
                    $this->getLinks(),
                    $this->getNextButton()
                );
            }
        }
    }

    protected function getDisabledTextWrapper($text) {
        return '<li class="am-disabled"><span>' . $text . '</span></li>';
    }

    protected function getActivePageWrapper($text) {
        return '<li class="am-active"><span>' . $text . '</span></li>';
    }

}
