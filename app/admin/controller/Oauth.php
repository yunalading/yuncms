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
use app\admin\validate\OauthValidate;

/**
 * Class Oauth
 * @package app\admin\controller
 */
class Oauth extends AdminBaseController {
    /**
     * @return \think\response\View
     */
    public function qq() {
        if ($this->request->isPost()) {
            $qq = $this->post['qq'];
            $validate = new OauthValidate();
            if (!$validate->check($qq, [], 'qq')) {
                $this->error($validate->getError());
            }
            $qq_new['qq'] = $qq;
            $oauth = config('oauth');
            $newOauth = array_merge($oauth, $qq_new);
            writeJsonConfig(APP_PATH . 'extra' . DS . 'oauth.json', $newOauth);
            $this->success('操作成功');
        }
        $this->assign('qq', config('oauth.qq'));
        return view();
    }

    /**
     * @return \think\response\View
     */
    public function wechat() {
        if ($this->request->isPost()) {
            $wechat = $this->post['wechat'];
            $validate = new OauthValidate();
            if (!$validate->check($wechat, [], 'wechat')) {
                $this->error($validate->getError());
            }
            $wechat_new['wechat'] = $wechat;
            $oauth = config('oauth');
            $newOauth = array_merge($oauth, $wechat_new);
            writeJsonConfig(APP_PATH . 'extra' . DS . 'oauth.json', $newOauth);
            $this->success('操作成功');
        }
        $this->assign('wechat', config('oauth.wechat'));
        return view();
    }

    /**
     * @return \think\response\View
     */
    public function weibo() {
        if ($this->request->isPost()) {
            $sina = $this->post['sina'];
            $validate = new OauthValidate();
            if (!$validate->check($sina, [], 'sina')) {
                $this->error($validate->getError());
            }
            $sina_new['sina'] = $sina;
            $oauth = config('oauth');
            $newOauth = array_merge($oauth, $sina_new);
            writeJsonConfig(APP_PATH . 'extra' . DS . 'oauth.json', $newOauth);
            $this->success('操作成功');
        }
        $this->assign('sina', config('oauth.sina'));
        return view();
    }
}
