<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 15/1/31
 * Time: 下午4:42
 */

class User {
    static function setID($token, $username){
        setcookie('umei_token', $token, time()+86400, "/");
        /*
        $identify = new CUserIdentity($username, $username);
        $identify->errorCode = CUserIdentity::ERROR_NONE;
        Yii::app()->user->login($identify, 86400);
        */
    }

    static function login(){
        if (isset($_COOKIE['login_fail_count']) && $_COOKIE['login_fail_count'] > 3) {
            $captcha_words = Yii::app()->request->getParam('captcha');
            if (!$captcha_words) {
                return array(1, '请填写验证码');
            }
            $captcha = new Captcha();
            if (!$captcha->check_word($captcha_words)) {
                return array(2, '验证码错误');
            }
        }
        $username = Yii::app()->request->getParam('username');
        $password = Yii::app()->request->getParam('password');
        $result = Api::get('user', 'login', array('username'=>$username, 'password'=>$password, 'ip'=>Logic::getClientIP()));
        if(isset($result['result']) && $result['result'] == 0){
            self::setID($result['data']['token'], $username);
            if (isset($_COOKIE['login_fail_count'])) {
                unset($_COOKIE['login_fail_count']);
                setcookie('login_fail_count', null, -1, '/');
            }
            return array(0, '登录成功');
        }else{
            if (isset($_COOKIE['login_fail_count'])) {
                $_COOKIE['login_fail_count'] += 1;
                setcookie('login_fail_count', $_COOKIE['login_fail_count'], time()+86400, '/');
            }else{
                $_COOKIE['login_fail_count'] = 1;
                setcookie('login_fail_count', 1, time()+86400, '/');
            }
            return array(3, '用户名或密码不正确');
        }
    }

    static public function logout(){
        if (!isset($_COOKIE['umei_token'])) {
            return false;
        }
        $token = $_COOKIE['umei_token'];
        Api::get('user', 'logout', array('token'=>$token));
        //Yii::app()->user->logout();
        unset($_COOKIE['login_fail_count']);
        setcookie('login_fail_count', null, -1, '/');
        unset($_COOKIE['umei_token']);
        setcookie('umei_token', null, -1, '/');
    }

    static public function register($username, $password, $confirm_password, $captcha){
        if (!$password || !$confirm_password || $password != $confirm_password) {
            return array(-1, '密码填写错误，请重试');
        }

        $c = new Captcha();
        if (!$c->check_word($captcha)) {
            return array(-2, '验证码错误');
        }

        $result = Api::get('user', 'register', array('username'=>$username, 'password'=>$password, 'ip'=>Logic::getClientIP()));
        if(isset($result['result'])){
            if($result['result'] == 0) {
                User::setID($result['data']['token'], $username);
                return array(0, json_encode(array('uid'=>$result['data']['uid'], 'username'=>$result['data']['username'])));
            }else{
                return array($result['result'], $result['msg']);
            }
        }else{
            return array(-3, '注册失败');
        }
    }

    static public function info($user_key=0){
        if (is_string($user_key)) {
            $result = Api::get('user', 'info', array('username'=>$user_key));
        }else{
            $uid = $user_key;
            if ($uid) {
                $result = Api::get('user', 'info', array('uid'=>$uid));
            }else{
                if (!isset($_COOKIE['umei_token'])) {
                    return false;
                }
                $result = Api::get('user', 'info', array('token'=>$_COOKIE['umei_token']));
            }
        }
        if(isset($result['result']) && $result['result'] == 0){
            return $result['data'];
        }else{
            return false;
        }
    }

    static function totalOnline(){
        $result = Api::getData('user', 'activeCount');
        if ($result) {
            $all = $result['all'];
            $category = $result['category'];
        }else{
            $all = 0;
            $category = array();
        }
        return array($all, $category);
    }

    static function managedAnchor($page=1, $size=10){
        if (!isset($_COOKIE['umei_token'])) {
            return false;
        }
        $result = Api::get('anchor', 'managed', array('token'=>$_COOKIE['umei_token'], 'page'=>$page, 'size'=>$size));
        if(isset($result['result']) && $result['result'] == 0){
            return $result['data'];
        }else{
            return array();
        }
    }

    static function rechargeList($page=1, $size=10){
        if (!isset($_COOKIE['umei_token'])) {
            return false;
        }
        $result = Api::get('user', 'rechargeList', array('token'=>$_COOKIE['umei_token'], 'page'=>$page, 'size'=>$size));
        if(isset($result['result']) && $result['result'] == 0){
            return $result['data'];
        }else{
            return array();
        }
    }

    static function favoriteAnchor($page=1, $size=10){
        if (!isset($_COOKIE['umei_token'])) {
            return false;
        }
        $result = Api::get('anchor', 'favorite', array('token'=>$_COOKIE['umei_token'], 'page'=>$page, 'size'=>$size));
        if(isset($result['result']) && $result['result'] == 0){
            return $result['data'];
        }else{
            return array();
        }
    }

    static function anchorInfo($anchor_id){
        $result = Api::get('anchor', 'info', array('anchor_id'=>$anchor_id));
        if(isset($result['result']) && $result['result'] == 0) {
            return $result['data'];
        }else{
            return false;
        }
    }

    static function checkFav($anchor_id){
        if (!isset($_COOKIE['umei_token'])) {
            return false;
        }
        $result = Api::get('user', 'checkFav', array('token'=>$_COOKIE['umei_token'], 'anchor_id'=>$anchor_id));
        if(isset($result['result']) && $result['result'] == 0){
            return $result['data']['fav'];
        }else{
            return 0;
        }
    }

    static function anchorLevels(){
        $result = Api::get('anchor', 'levels');
        if(isset($result['result']) && $result['result'] == 0) {
            return $result['data'];
        }else{
            return false;
        }
    }

    static function micCount($uid, $start_date, $end_date){
        $set = array();
        $sum = array();
        $last_endtime = array();
        $sql = "select start_time, ender_time, room_id from c_live_logs where uid=$uid and start_time >= $start_date and start_time < $end_date order by start_time";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($data as $one) {
            $key = date('Y-m-d', $one['start_time']);
            $last = $one['ender_time'] - $one['start_time'];
            if(!isset($set[$key])){
                if (isset($sum[$key])) {
                    if ($one['start_time'] - $last_endtime[$key] > 600) {
                        $sum[$key] = 0;
                    }
                }else{
                    $sum[$key] = 0;
                }
                $last_endtime[$key] = $one['ender_time'];
                $sum[$key] += $last;

                if($sum[$key] >= 7200){
                    $set[$key] = $one['room_id'];
                }
            }
        }
        return $set;
    }
}