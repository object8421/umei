<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 15/3/3
 * Time: 下午5:12
 */

class Logic {
    static public function getClientIP(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    static public function makeResponse($error='0', $msg='ok', $content=''){
        return json_encode(array('error'=>$error, 'message'=>$msg, 'content'=>$content));
    }

    static public function outputError($content){
        echo self::makeResponse('1', $content);
        Yii::app()->end();
    }
    
    static public function unserializeConfig($cfg) {
        if(is_string($cfg) && ($arr = unserialize($cfg)) !== false){
                $config = array();
            
                foreach($arr as $key=>$val){
                        $config[$val['name']] = $val['value'];
                }
            
                return $config;
        }else{
                return false;
        }
    }

    static public function get_order_sn() {
        $rand24 = mt_rand(10000000, 99999999) . mt_rand(10000000, 99999999) . mt_rand(10000000, 99999999);
        $rand8 = substr($rand24, mt_rand(0, 16), 8);
        return date('ymd') . str_pad($rand8, 8, '0', STR_PAD_LEFT);
    }

    static public function pageInfo($page, $all_page){
        $prev = $page - 1;
        if ($prev < 1) {
            $prev = 1;
        }
        $next = $page + 1;
        if ($next > $all_page) {
            $next = $all_page;
            if ($next < 1) {
                $next = 1;
            }
        }
        $more = 3;
        $more_start = $page - $more;
        if ($more_start < 1) {
            $more_start = 1;
        }
        $more_end = $page + $more;
        if ($more_end > $all_page) {
            $more_end = $all_page;
        }
        return array($prev, $next, $more_start, $more_end);
    }

    static public function getToken(){
        if (isset(Yii::app()->request->cookies['umei_token'])) {
            return Yii::app()->request->cookies['umei_token']->value;
        }else{
            return '';
        }
    }

    static public function chineseNumber($i){
        $num = array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九');
        return $num[$i];
    }

    static function gift_rank($type, $start, $end, $sum)
    {
        $sum_bak = $sum;
        if ($type == 2){
            $sum = 100;
        }
        $uid = ($type == 2) ? 'to_uid' : 'from_uid';//1 用户  2 主播
        $sql = "SELECT $uid as uid, SUM(total_price) AS total FROM c_gift_logs WHERE add_time >= '$start' AND add_time <= '$end' GROUP BY $uid ORDER BY total DESC LIMIT $sum";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        $index = 1;
        for($i=0; $i<count($res); $i++){
            $user_info = User::info(intval($res[$i]['uid']));
            if (!$user_info) {
                continue;
            }
            $res[$i]['rank'] = $index;
            $res[$i]['gid']  = $user_info['anchor_id'];
            $res[$i]['nick'] = $user_info['nickname'];
            if ($user_info['avatar']){
                $res[$i]['avatar'] = $user_info['avatar'];
            }
            else{
                $res[$i]['avatar'] = '/images/avatar.jpg';
            }
            if ($type == 1){
                $res[$i]['vip'] = $user_info['user_level'];
                $index += 1;
            }
            if ($type == 2){
                $res[$i]['star']  = $user_info['anchor_level'];
                $room_info = Room::getInfoByAnchor($user_info['anchor_id']);
                $res[$i]['room_id']  = $room_info['room_id'];
                if ($res[$i]['room_id'] > 0){
                    $index += 1;
                }
            }
            unset($res[$i]['uid'], $res[$i]['total']);
        }
        if ($type == 1){
            return $res;
        }

        $result = array();
        for($i=0; $i<count($res); $i++){
            if ($res[$i]['room_id']>0){
                $result[] = $res[$i];
                if (count($result) == $sum_bak){
                    break;
                }
            }
        }
        return $result;
    }

    static function gift_supe($type, $sum)
    {
        $sum_bak = $sum;
        if ($type == 2){
            $sum = 100;
        }

        if($type==1){
            $sql = "SELECT uid FROM c_user_account ORDER BY expense_point DESC LIMIT $sum";
        }
        if($type==2){
            $sql = "SELECT uid FROM c_user_account ORDER BY income_point DESC LIMIT $sum";
        }
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        $index = 1;
        for($i=0; $i<count($res); $i++){
            $user_info = User::info(intval($res[$i]['uid']));
            if (!$user_info) {
                continue;
            }
            $res[$i]['rank'] = $index;
            $res[$i]['gid']  = $user_info['anchor_id'];
            if (!isset($user_info['nickname'])) {
                var_dump($user_info);exit;
            }
            $res[$i]['nick'] = $user_info['nickname'];
            if ($user_info['avatar']){
                $res[$i]['avatar'] = $user_info['avatar'];
            }
            else{
                $res[$i]['avatar'] = '/images/avatar.jpg';
            }
            if ($type == 1){
                $res[$i]['vip'] = $user_info['user_level'];
                $index += 1;
            }
            if ($type == 2){
                $res[$i]['star']  = $user_info['anchor_level'];
                $room_info = Room::getInfoByAnchor($user_info['anchor_id']);
                $res[$i]['room_id']  = $room_info['room_id'];
                if ($res[$i]['room_id'] > 0){
                    $index += 1;
                }
            }
            unset($res[$i]['uid']);
        }
        if ($type == 1){
            return $res;
        }

        $result = array();
        for($i=0; $i<count($res); $i++){
            if ($res[$i]['room_id']>0){
                $result[] = $res[$i];
                if (count($result) == $sum_bak){
                    break;
                }
            }
        }

        return $result;
    }

    static public function sendMail($email, $name, $title, $body, $altBody='')
    {
        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.exmail.qq.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'kefu@uumie.com';                 // SMTP username
        $mail->Password = 'Ke9!^8Fu';                           // SMTP password
        $mail->CharSet = 'utf-8';
        //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                                    // TCP port to connect to
        $mail->From = 'kefu@uumie.com';
        $mail->FromName = 'U美管理员';
        $mail->addAddress($email, $name);     // Add a recipient
        $mail->addReplyTo('kefu@uumie.com', 'U美管理员');
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $title;
        $mail->Body = $body;
        $mail->AltBody = $altBody;
        return $mail->send();
    }

    static public function formatTime($time){
        if(!is_numeric($time)) {
            return false;
        }
        $str = '';
        if($time >= 31556926){
            $str .= floor($time/31556926).'年';
            $time = ($time%31556926);
        }
        if($time >= 86400){
            $str .= floor($time/86400).'天';
            $time = ($time%86400);
        }
        if($time >= 3600){
            $str .= floor($time/3600).'小时';
            $time = ($time%3600);
        }
        if($time >= 60){
            $str .= floor($time/60).'分钟';
            $time = ($time%60);
        }
        $str .= floor($time).'秒';
        return $str;
    }
}