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

        /*
        $mail = new \PHPMailer();
        try {
            $mail->IsSMTP();
            $mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
            $mail->SMTPAuth = true; //开启认证
            $mail->Port = 25;
            $mail->Host = "smtp.163.com";
            $mail->Username = "18671418772@163.com";
            $mail->Password = "frank654321";
            //$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could not execute: /var/qmail/bin/sendmail ”的错误提示
            $mail->AddReplyTo("18671418772@163.com","mckee");//回复地址
            $mail->From = "18671418772@163.com";//发件邮箱
            $mail->FromName = "www.yunalading.com";//发件人
            $to = "498931984@qq.com";//发给谁
            $mail->AddAddress($to);
            $mail->Subject = "phpmailer测试标题";
            $mail->Body = "<h1>phpmail演示</h1>这是云阿拉丁（<font color=red>www.yunalading.com</font>）对phpmailer的测试内容";
            $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
            $mail->WordWrap = 80; // 设置每行字符串的长度
            //$mail->AddAttachment("f:/test.png"); //可以添加附件
            $mail->IsHTML(true);
            $mail->Send();
            echo '邮件已发送';
        } catch (phpmailerException $e) {
            echo "邮件发送失败：".$e->errorMessage();
        }
        */

    }

    public function testmail(){
        $mail['title'] = "phpmailer测试标题";
        $mail['content'] = "<h1>phpmail演示</h1>这是云阿拉丁（<font color=red>www.yunalading.com</font>）对phpmailer的测试内容";
        $mail['filepath'] = '';
        $replyTo['email'] = "18671418772@163.com";//回复邮箱
        $replyTo['name'] = "yald";//回复人
        $mail['sendemail'] = isset($this->post['sendemail'])?$this->post['sendemail']:$email_config['sendemail'];
        $mail['title'] = "phpmailer测试标题";
        $mail['sendemail'] = "phpmailer测试标题";
        $this->sendEmail($mail,$replyTo);
    }

    protected function  sendEmail($mails=array(),$replyTo=array()){
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
            $replyTo['email'] = isset($mails['email'])?$mails['email']:$email_config['name'];
            $replyTo['name'] = isset($mails['name'])?$mails['name']:$email_config['name'];
            $mail->AddReplyTo($replyTo['email'],$replyTo['name']);//回复地址
            $mail->From = isset($mails['fromemail'])?$mails['fromemail']:$email_config['fromemail'];//发件邮箱
            $mail->FromName = isset($mails['serveremail'])?$mails['serveremail']:$email_config['serveremail'];//发件人
            $mail['sendemail'] =  isset($mails['sendemail'])?$mails['sendemail']:$email_config['sendemail'];//收件人
            $mail->AddAddress($mail['sendemail']);
            $mail->Subject = $mails['title'];
            $mail->Body = $mails['content'];
            $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
            $mail->WordWrap = 80; // 设置每行字符串的长度
            if(isset($mails['filepath']) && $mails['filepath']!=''){
                $mail->AddAttachment($mails['filepath']); //可以添加附件
            }
            $mail->IsHTML(true);
            $mail->Send();
            $res['msg'] = '邮件已发送';
            $res['code'] = 1;
            return $res;
        } catch (phpmailerException $e) {
            $res['msg'] = "邮件发送失败：".$e->errorMessage();
            $res['code'] = 0;
            return $res;
        }
    }
}
