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
namespace app\common\controller;
use think\Db;
use \app\core\adminauth\Auth;
use think\Request;
use app\admin\model\ConfigModel;
/**
 *  后台公共类
 *  @author [chenqianhao] <68527761@qq.com>
 * Class AdminBaseController
 * @package app\common\controller
 */
abstract class AdminBaseController extends BaseController {
    /**
     * AdminBaseController constructor.
     */
    public function __construct() {
        parent::__construct();
        //$request = request();
        //$url=strtolower($request->module()).'/'.strtolower($request->controller()).'/'.strtolower($request->action());
        $url=geturlbase();
        if (!$this->isLogin() and !in_array($url, array('admin/index/login', 'admin/index/logout', 'admin/index/verify'))){
            $this->redirect('admin/index/login');
        }else{
          //获取系统配置
          $this->getConfigAll();
        }

        //print_r(get_defined_constants());
        if (!in_array($url, array('admin/index/login', 'admin/index/logout', 'admin/index/verify'))) {
            // 是否是超级管理员
            if(!defined('IS_ROOT')){
              define('IS_ROOT', $this->is_administrator());
            }
            // 检测系统权限
            if (!IS_ROOT) {
                $access = $this->accessControl();
                if (false === $access) {
                    $errors['msg']="403:禁止访问！";
                    $errors['code']=10;
                    $this->assign('errors',$errors);
                } elseif (null === $access) {
                    $dynamic = $this->checkDynamic(); //检测分类栏目有关的各项动态权限
                    if ($dynamic === null) {
                        //检测访问权限;
                        if (!$this->checkRule($url, array('in', '1,2'))) {
                            $errors['msg']="未授权访问!";
                            $errors['code']=11;
                            $this->assign('errors',$errors);
                        } else {
                            // 检测分类及内容有关的各项动态权限
                            $dynamic = $this->checkDynamic();
                            if (false === $dynamic) {
                                $errors['msg']="未授权访问!";
                                $errors['code']=12;
                                $this->assign('errors',$errors);
                            }
                        }
                    } elseif ($dynamic === false) {
                        $errors['msg']="未授权访问!";
                        $errors['code']=14;
                        $this->assign('errors',$errors);
                    }
                }
            }
            $positionlink=GetPositionLink();//后台的菜单的当前位置
            if($positionlink){
              $this->assign('positionlink',$positionlink);
            }else{
              if(session('positionlinkurl') && session('positionlinkurl')!=''){
                $positionlink=GetPositionLink(session('positionlinkurl'));
                if($positionlink){
                  $this->assign('positionlink',$positionlink);
                }
              }
            }
            //菜单设置
            $this->setMenu();
        }
    }
    public  function isLogin()
    {
        $isLogin = session('islogin');
        if (!$isLogin) {
            //$this->redirect('admin/Index/login');
            return false;
        } else {
            session('islogin', 1);
            return true;
        }
    }

    /**
     * 检测当前用户是否为管理员
     * @return boolean true-管理员，false-非管理员
     * @author 陈前号 <68527761@qq.com>
     */
    public  function is_administrator($uid = null) {
        //$uid = is_null($uid) ? $this->isLogin() : $uid;
        $uid = is_null($uid) ? session('aid') : $uid;
        if(intval($uid)>0){
          $gid=db('auth_group_access')->where('aid',$uid)->value('gid');
          if($gid<1){
            return false;
          }
          if(intval($gid) === config('authorization.admin_gid')){
              return true;
          }
        }else{
          return false;
        }
        //return $uid && (intval($uid) === config('authorization.user_administrator'));
    }
    /**
     * 权限检测
     * @param string  $rule    检测的规则
     * @param string  $mode    check模式
     * @return boolean
     * @author [chenqianhao] <68527761@qq.com>
     */
    final protected function checkRule($rule, $type = 2, $mode = 'url') {
        static $Auth = null;
        if (!$Auth) {
            $Auth = new Auth();
        }
        //return $Auth->check('admin/config/index',1,2, null);
        if (!$Auth->check($rule, session('user_auth.uid'), $type, $mode)) {
            return false;
        }
        return true;
    }
    /**
     * 检测是否是需要动态判断的权限
     * @return boolean|null
     *      返回true则表示当前访问有权限
     *      返回false则表示当前访问无权限
     *      返回null，则表示权限不明
     *
     * @author [chenqianhao] <68527761@qq.com>
     */
    protected function checkDynamic() {
        if (IS_ROOT) {
            return true; //管理员允许访问任何页面
        }
        return null; //不明,需checkRule
    }
    /**
     * action访问控制,在 **登陆成功** 后执行的第一项权限检测任务
     *
     * @return boolean|null  返回值必须使用 `===` 进行判断
     *
     *   返回 **false**, 不允许任何人访问(超管除外)
     *   返回 **true**, 允许任何管理员访问,无需执行节点权限检测
     *   返回 **null**, 需要继续执行节点权限检测决定是否允许访问
     * @author [chenqianhao] <68527761@qq.com>
     */
    final protected function accessControl() {
        $allow = \think\Config::get('allow_visit');
        $deny  = \think\Config::get('deny_visit');
        $check = strtolower($this->request->controller() . '/' . $this->request->action());
        if (!empty($deny) && in_array_case($check, $deny)) {
            return false; //非超管禁止访问deny中的方法
        }
        if (!empty($allow) && in_array_case($check, $allow)) {
            return true;
        }
        return null; //需要检测节点权限
    }
    protected function setMenu() {
        $hover_url  = $this->request->module() . '/' . $this->request->controller();
        //$controller = $this->request->url();
        $controller=strtolower($this->request->module()).'/'.strtolower($this->request->controller()).'/'.strtolower($this->request->action());
        $menu       = array(
            'main'  => array(),
            'child' => array(),
        );
        $where['pid']  = 0;
        $where['hide'] = 0;
        $where['type'] = 'admin';
        $where['status'] = 0;
        if (!config('develop_mode')) {
            // 是否开发者模式
            //$where['is_dev'] = 0;
            $where['is_dev'] = 1;
        }else{
            $where['is_dev'] = 0;
        }
        $row = db('menu')->field('id,title,url,icon,sort,"" as style')->where($where)->order('sort','asc')->select();
        // print_r($row);die();
        foreach ($row as $key => $value) {
            $value['nav_number']=0;
            //此处用来做权限判断
            //$str.='ddd'.$value['url'];
            if (!IS_ROOT && !$this->checkRule($value['url'], 2, null)) {
                unset($menu['main'][$value['id']]);
                continue; //继续循环
            }
            if ($controller == $value['url']) {
                $value['style'] = "active";//当前选中的菜单
            }
            $menu['main'][$value['id']] = $value;
            $map['pid']  = $value['id'];
            $map['hide'] = 0;
            $map['type'] = 'admin';
            $where['status'] = 0;
            $rows= db('menu')->field('id,title,url,icon,group,pid')->where($map)->select();
            foreach ($rows as $k=>$values) {
                if (IS_ROOT || $this->checkRule($values['url'], 2, null)) {
                    if ($controller == $values['url']) {
                        $menu['main'][$values['pid']]['style'] = "active";
                        $values['style']                       = "active";
                    }
                    $menu['child'][$values['pid']][] = $values;
                    $menu['main'][$value['id']]['nav_number']+=1; //总的子菜单的个数
                }
            }
        }
        // echo '<pre>';
        // print_r($menu);
        $this->assign('menus', $menu);
    }

    /**
     * 获取系统配置项
     * @return array 系统配置参数
     * @author [chenqianhao] <68527761@qq.com>
     */
    protected function getConfigAll() {
      $Mconfig = new ConfigModel();
      $config=$Mconfig->getAllConfig();
      $this->assign('config', $config);
      return $config;
    }

    /**
     * 记录管理员操作日志
     * @param  $data  [array]  要插入的数据
     * @return int 插入的主键id
     * @author [chenqianhao] <68527761@qq.com>
     */
    public function inserLog($data) {
      $data['log_addtime']=isset($data['log_addtime'])?$data['log_addtime']:time();
      $data['log_action']=isset($data['log_action'])?trim($data['log_action']):geturlbase();
      $data['log_value']=isset($data['log_value'])?intval($data['log_value']):$this->request->controller();
      $data['log_addip']=isset($data['log_addip'])?intval($data['log_addip']):$this->request->ip();
      $data['log_aid']=isset($data['log_aid'])?intval($data['log_aid']):session('aid');
      $data['log_type']=isset($data['log_type'])?intval($data['log_type']):0;
      $adminlog = new \app\admin\model\AdminLogModel();
      $id = $adminlog->autoinsert($data,'admin_log');
      return $id;
    }


}
