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
use app\admin\validate\MailValidate;
use think\App;
use think\Config;

/**
 * Class Email
 * @package app\admin\controller
 */
class Email extends AdminBaseController
{
    /**
     * @return \think\response\View
     */
    public function index()
    {
        if ($this->request->isPost()) {
            $email = $this->post['mail'];
            $validate = new MailValidate();
            if (!$validate->check($email, [], 'update')) {
                $this->error($validate->getError());
            }
            if (!key_exists('auth', $email)) {
                $email['auth'] = true;
            }else{
                $email['auth'] = false;
            }
            $mail = config('email');
            if(isset($mail) && is_array($mail)){
                $newMail = array_merge($mail, $email);
            }else{
                $newMail =  $email;
            }
            writeJsonConfig(APP_PATH . 'extra' . DS . 'email.json', $newMail);
            $this->success('操作成功');
        }
        $this->assign('mail', config('email'));
        return view();
    }

    public function testmail(){
        if ($this->request->isPost()) {
            $send = $this->post['send'];
            $validate = new MailValidate();
            if (!$validate->check($send, [], 'send')) {
                $this->error($validate->getError());
            }
            $res = $this->sendEmail($send);
            if($res['code']>0){
                $this->success($res['msg']);
            }else{
                $this->error($res['msg']);
            }
        }
    }

    protected function  sendEmail($mails=array()){
        $email_config = Config::get('email');
        $mail = new \PHPMailer();
        try {
            $mail->IsSMTP();
            $mail->CharSet = isset($mails['charset'])?$mails['charset']:$email_config['charset']; //设置邮件的字符编码，这很重要，不然中文乱码 'UTF-8'
            $mail->SMTPAuth = isset($mails['auth'])?$mails['auth']:$email_config['auth']; //开启认证 true
            $mail->Port = isset($mails['port'])?$mails['port']:$email_config['port'];
            $mail->Host = isset($mails['host'])?$mails['host']:$email_config['host'];//如163邮箱为"smtp.163.com"
            $mail->Username = isset($mails['servername'])?$mails['servername']:$email_config['servername'];
            $mail->Password = isset($mails['serverpass'])?$mails['serverpass']:$email_config['serverpass'];
            //$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could not execute: /var/qmail/bin/sendmail ”的错误提示
            $mails['re_email'] = isset($mails['re_email'])?$mails['re_email']:$email_config['serveremail'];
            $mails['re_name'] = isset($mails['re_name'])?$mails['re_name']:$email_config['servername'];
            $mail->AddReplyTo($mails['re_email'],$mails['re_name']);//回复地址
            $mail->From = isset($mails['serveremail'])?$mails['serveremail']:$email_config['serveremail'];//发件邮箱
            $mail->FromName = isset($mails['servername'])?$mails['servername']:$email_config['servername'];//发件人
            $mails['sendemail'] =  isset($mails['sendemail'])?$mails['sendemail']:$email_config['sendemail'];//收件人
            $mail->AddAddress($mails['sendemail']);
            $mail->Subject = $mails['title'];
            $mail->Body = $mails['content'];
            $mail->AltBody = "要查看邮件，请使用HTML兼容的电子邮件查看器!"; //当邮件不支持html时备用显示，可以省略
            $mail->WordWrap = 80; // 设置每行字符串的长度
            if(isset($mails['filepath']) && $mails['filepath']!=''){
                $mail->AddAttachment($mails['filepath']); //可以添加附件
            }
            $mail->IsHTML(true);
            $mail->Send();
            $res['msg'] = '邮件已发送';
            $res['code'] = 1;
        } catch (phpmailerException $e) {
            $res['msg'] = "邮件发送失败：".$e->errorMessage();
            $res['code'] = 0;
            return $res;
        }
        return $res;
    }
}
