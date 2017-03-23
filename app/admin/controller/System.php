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


namespace app\admin\controller;

use app\admin\validate\AppValidate;
use think\Cache;

/**
 * Class System
 * @package app\admin\controller
 */
class System extends AdminBaseController {
    /**
     * 系统信息
     * @return \think\response\View
     */
    public function index() {
        $env = config('require.env');
        $env[] = [
            'name' => 'server',
            'class' => '\app\core\check\env\ServerCheck'
        ];
        $env[] = [
            'name' => 'mysql',
            'class' => '\app\core\check\env\MySqlCheck'
        ];
        $envs = array();
        foreach ($env as $key => $value) {
            $en = new $value['class']();
            $envs[] = $en;
        }
        $this->assign('envs', $envs);
        return view();
    }

    /**
     * 基本信息
     * @return \think\response\View
     */
    public function general() {
        if ($this->request->isPost()) {
            $app_data = $this->post['app'];
            $appValidate = new AppValidate();
            if (!$appValidate->check($app_data, [], 'update')) {
                $this->error($appValidate->getError());
            }
            if (!key_exists('close', $app_data)) {
                $app_data['close'] = 0;
            }
            $app = config('app');
            $newApp = array_merge($app, $app_data);
            writeConfig(APP_PATH . 'extra' . DS . 'app.json', $newApp);
            $this->success('操作成功');
        }
        $this->assign('themes', themes());
        $this->assign('app', config('app'));
        return view();
    }

    /**
     * 清空缓存
     * @return \think\response\View
     */
    public function clear() {
        Cache::clear();
        $this->success('操作成功!', url('/admin/system'));
    }
}
