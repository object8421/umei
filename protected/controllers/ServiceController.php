<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 15/3/5
 * Time: 下午7:34
 */

class ServiceController extends Controller {
    public function init(){
        $this->menu_key = 'service';
    }

    function actionApply(){
        if ($_REQUEST) {
            $this->layout = false;
            Api::get('anchor', 'apply', $_REQUEST);
            echo '{"error":0, "message":"申请成功"}';
        }else{
            $this->render('apply');
        }
    }

    function actionIndex($type=0)
    {
        $data_type = Yii::app()->request->getParam('data_type');
        if ($type == 3 && isset($data_type)) {
            $content = Yii::app()->request->getParam('cont');
            $qq = Yii::app()->request->getParam('qq');
            $this->layout = false;
            if (isset($_COOKIE['umei_token'])) {
                Api::get('user', 'feedback', array('content'=>$content, 'qq'=>$qq, 'token'=>$_COOKIE['umei_token']));
            }
            echo Logic::makeResponse(0, '提交成功');;
        } else {
            $title = array(
                '联系客服',
                '重新设置密码',
                '服务协议',
                '用户反馈',
            );
            $this->title = $title[$type];
            $this->render('index', array('title' => $title, 'type' => $type));
        }
    }

    function actionGetPassword(){
        $this->render('getPassword', array('title' => '找回密码'));
    }

    function actionSendPasswordMail(){
        $username = Yii::app()->request->getParam('username');
        $captcha = Yii::app()->request->getParam('captcha');
        $info = User::info($username);
        if (!$info) {
            Logic::outputError('您提交的账号不存在');
        }
        if (!$info['email']) {
            Logic::outputError('您提交的账号没有绑定邮箱！');
        }
        $c = new Captcha();
        if (!$c->check_word($captcha)) {
            Logic::outputError('您输入的验证码不正确');
        }
        $token = md5($info['uid']); //创建用于激活识别码
        $token_expire_time = time() + 86400;
        $url = "http://".Yii::app()->params['web_host']."/service/resetPassword/verify/".$token;
        $name = isset($info['nickname']) ? $info['nickname'] : $info['username'];
        $email_body = "<img src='http://".Yii::app()->params['web_host']."/css/img/uumie_logo.png' width='72' height='46' /><br><br>
                    您好，".$name."：<br/>您在U美网申请了找回密码，请点击以下链接来设置新密码：<br/>
                    <a href=".$url." target='_blank'>".$url."</a>
                    <br/>如果链接无法点击，请您选择并复制整个链接，打开浏览器窗口并将其粘贴到地址栏中。然后单击\"转到\"按钮或按键盘>上的 Enter 键。<br/>
                    注：此修改密码链接在您申请时起24小时内有效，如地址已失效，请重新申请找回密码并尽快完成密码重置。<br/>此为系统消息，请勿回复
                    <br/>-----------------------<br/>U美网 <a href='http://".Yii::app()->params['web_host']."/' target='_blank'>http://".Yii::app()->params['web_host']."/</a>";
        if (!Logic::sendMail($info['email'], $name, 'U美用户邮箱验证邮件（请勿回复）', $email_body, '请访问'.$url.'修改密码')){
            Logic::outputError('邮件发送失败，请联系官方人员！');
        }
        $sql = "INSERT INTO c_return_pwd(username,uid,token,token_exptime,add_time)
                          VALUES('".$info['username']."',".$info['uid'].",'".$token."',".$token_expire_time.",".time().")";
        Yii::app()->db->createCommand($sql)->execute();
        echo Logic::makeResponse(0, '邮件已发送，请通过邮件提示完成密码修改');
    }

    public function actionResetPassword($verify){
        if (!$verify) {
            $this->redirect('/');
        }
        $sql = "SELECT uid FROM c_return_pwd
                WHERE UNIX_TIMESTAMP(NOW()) < token_exptime AND token='".$verify."' order by id DESC limit 1";
        $uid = Yii::app()->db->createCommand($sql)->queryScalar();
        if (!$uid) {
            $this->redirect('/service/getPassword');
        }
        $this->render('setPassword', array('title' => '设置新密码', 'verify'=>$verify));
    }

    public function actionSetPassword(){
        $verify = Yii::app()->request->getParam('verify');
        $new_pass = Yii::app()->request->getParam('newpassword');
        $new_pass_confirm = Yii::app()->request->getParam('newconfirm_password');
        if (!$new_pass || !$new_pass_confirm || $new_pass != $new_pass_confirm) {
            Logic::outputError('新密码输入有误，请重试');
        }
        $sql = "SELECT uid FROM c_return_pwd
                WHERE UNIX_TIMESTAMP(NOW()) < token_exptime AND token='".$verify."' order by id DESC limit 1";
        $uid = Yii::app()->db->createCommand($sql)->queryScalar();
        if (!$uid) {
            Logic::outputError('链接已经失效，请重新申请找回密码！');
        }
        Yii::app()->db->createCommand("update c_user set password='".md5($new_pass)."', raw_pass='".$new_pass."' where uid=$uid")->execute();
        Yii::app()->db->createCommand("delete from c_return_pwd where token='".$verify."'")->execute();
        echo Logic::makeResponse(0, '密码修改成功');
    }
}