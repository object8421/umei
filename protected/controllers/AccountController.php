<?php

class AccountController extends Controller
{
    public $user_info;

    public function init(){
        $this->menu_key = 'account';
        $this->user_info = User::info();
    }

    protected function beforeAction($action){
        $need_auth = array('setRoom', 'roomInfo', 'myRoom', 'recvGiftLog', 'sendGiftLog', 'carLog', 'vip', 'micDay',
            'number', 'car', 'bean', 'info', 'changePwd', 'changeInfo', 'changeName', 'setMail', 'favorite',
            'managed', 'rechargeList', 'exchangeList', 'micTime', 'fans', 'family', 'familyApply', 'familyView');
        if (in_array($action->id, $need_auth) && !$this->user_info) {
            Yii::app()->user->setReturnUrl('/account/'.$action->id);
            $this->redirect('/login');
            return false;
        }
        return true;
    }

	public function actionInfo()
	{
        $this->title = '个人资料';
		$this->render('info', array('info'=>$this->user_info));
	}

    public function actionChangePwd()
    {
        $this->title = '修改密码';
        $msg = '';
        if ($_REQUEST) {
            $old_password = Yii::app()->request->getParam('old_password');
            $password = Yii::app()->request->getParam('password');
            $re_password = Yii::app()->request->getParam('confirm_password');
            if ($password != $re_password) {
                $msg = '两次新密码不相同';
            }else{
                if ($token = $_COOKIE['umei_token']) {
                    $result = Api::get('user', 'changePwd', array('token'=>$token, 'old_password'=>$old_password, 'new_password'=>$password));
                    if (!isset($result['result'])) {
                        $msg = '修改失败';
                    }elseif($result['result'] == 0){
                        $msg = '修改成功';
                    }else{
                        $msg = $result['msg'];
                    }
                }else{
                    $msg = '请先登录';
                }
            }
        }
        $this->render('changePwd', array('msg'=>$msg));
    }

    public function actionChangeName()
    {
        $name = Yii::app()->request->getParam('nickname');
        $token = Logic::getToken();
        $msg = '';
        if ($token && $name) {
            $r = Api::get('user', 'setNickname', array('token'=>$token, 'nickname'=>$name));
            if (!$r) {
                $msg = '修改失败';
            }else{
                $msg = $r['msg'];
                if ($r['result'] == 0) {
                    $this->user_info = User::info();
                }
            }
        }
        $this->title = '修改昵称';
        $this->render('changeName', array('info'=>$this->user_info, 'msg'=>$msg));
    }

    public function actionChangeInfo()
    {
        $msg = '';
        if ($_REQUEST) {
            $sex = Yii::app()->request->getParam('sex');
            $birth = Yii::app()->request->getParam('birth');
            $sign = Yii::app()->request->getParam('sign');
            $token = Logic::getToken();
            $r = Api::get('user', 'changeInfo', array('token'=>$token, 'sex'=>$sex, 'birth'=>$birth, 'sign'=>$sign));
            if (!$r) {
                $msg = '修改失败';
            }else{
                $msg = $r['msg'];
                if ($r['result'] == 0) {
                    $this->user_info = User::info();
                }
            }

        }
        $this->title = '资料修改';
        $this->render('changeInfo', array('info'=>$this->user_info, 'msg'=>$msg));
    }

    public function actionSetMail()
    {
        $verify = Yii::app()->request->getParam('verify');
        if ($verify) {
            $sql = "SELECT uid FROM c_check_email WHERE UNIX_TIMESTAMP(NOW()) < token_exptime AND token='".$verify."' order by id DESC limit 1";
            $uid = Yii::app()->db->createCommand($sql)->queryScalar();
            if(!$uid){
                $msg = "链接已经失效，请重新验证邮箱！";
            }else{
                $sql = "UPDATE c_user_fields SET email_status=1 WHERE uid=".$uid;
                Yii::app()->db->createCommand($sql)->execute();
                Yii::app()->cache->delete('user_'.$uid);
                $msg = "验证成功！";
            }
        }else{
            $msg = '如果没有收到U美系统发送的验证链接，请在5分钟后再次发送';
        }

        $this->title = '设置邮箱';
        $this->render('setMail', array('info'=>$this->user_info, 'msg'=>$msg));
    }

    public function actionFavorite($page=1, $size=10)
    {
        $this->title = '我的关注';
        $data = User::favoriteAnchor($page, $size);
        if ($data) {
            $fav = $data['list'];
            $pager['total'] = $data['all'];
            $pager['pages'] = $data['all_page'];
            $pager['page'] = $page;
        }else{
            $fav = array();
            $pager['total'] = 0;
            $pager['pages'] = 0;
            $pager['page'] = 0;

        }
        $this->render('favorite', array('fav'=>$fav, 'pager'=>$pager, 'size'=>$size));
    }

    public function actionManaged($page=1, $size=10)
    {
        $this->title = '我的管理';
        $data = User::managedAnchor($page, $size);
        if ($data) {
            $m = $data['list'];
            $pager['total'] = $data['all'];
            $pager['pages'] = $data['all_page'];
            $pager['page'] = $page;
        }else{
            $m = array();
            $pager['total'] = 0;
            $pager['pages'] = 0;
            $pager['page'] = 0;

        }
        $this->render('managed', array('data'=>$m, 'pager'=>$pager, 'size'=>$size));
    }

    public function actionRechargeList($page=1, $size=10)
    {
        $this->title = '充值记录';
        $r = User::rechargeList($page, $size);
        if ($r) {
            $data = $r['list'];
            $pager['total'] = $r['all'];
            $pager['pages'] = $r['all_page'];
            $pager['page'] = $page;
        }else{
            $data = array();
            $pager['total'] = 0;
            $pager['pages'] = 0;
            $pager['page'] = 0;

        }
        $this->render('rechargeList', array('data'=>$data, 'pager'=>$pager, 'size'=>$size));
    }

    public function actionBean(){
        $this->title = 'U豆兑换';
        $this->render('bean');
    }

    public function actionExchange(){
        $bean = Yii::app()->request->getParam('bean');
        $captcha_word = Yii::app()->request->getParam('captcha');
        if ($bean < 10) {
            Logic::outputError('单次兑换必须大等于 10 Ｕ豆');
        }
        $token = Logic::getToken();
        if (!$token) {
            Logic::outputError('请登录后购买');
        }
        $captcha = new Captcha();
        if (!$captcha->check_word($captcha_word)) {
            Logic::outputError('验证码不正确');
        }
        $r = Api::get('pay', 'exchange', array('token'=>$token, 'bean'=>$bean));
        echo Logic::makeResponse($r['result'], $r['msg']);
    }

    public function actionCar(){
        $this->title = '我的座驾';
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/');
        }else{
            $data = Api::getData('user', 'car', array('token'=>$token));
        }
        $this->render('car', array('data'=>$data));
    }

    public function actionNumber($page=1, $size=10){
        $this->title = '我的靓号';
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/');
        }else{
            $r = Api::getData('user', 'number', array('token'=>$token, 'page'=>$page, 'size'=>$size));
            if ($r) {
                $data = $r['list'];
                $pager['total'] = $r['all'];
                $pager['pages'] = $r['all_page'];
                $pager['page'] = $page;
            }else{
                $data = array();
                $pager['total'] = 0;
                $pager['pages'] = 0;
                $pager['page'] = 0;

            }
        }
        $this->render('number', array('data'=>$data, 'pager'=>$pager, 'size'=>$size));
    }

    public function actionSetCar($id){
        if ($id > 0) {
            $token = Logic::getToken();
            if ($token) {
                Api::get('user', 'setCar', array('token'=>$token, 'car_id'=>$id));
            }
        }
        $this->redirect('/account/car');
    }

    public function actionSetNumber($id){
        if ($id <= 0) {
            Logic::outputError('靓号不存在');
        }
        $token = Logic::getToken();
        if (!$token) {
            Logic::outputError('未登录');
        }
        $r = Api::get('user', 'setNumber', array('token'=>$token, 'number'=>$id));
        echo Logic::makeResponse($r['result'], $r['msg']);
    }

    public function actionGiftNumber($num, $to){
        if ($num <= 0 || $to <= 0) {
            Logic::outputError('数据错误');
        }
        $token = Logic::getToken();
        if (!$token) {
            Logic::outputError('未登录');
        }
        $r = Api::get('user', 'giftNumber', array('token'=>$token, 'number'=>$num, 'to'=>$to));
        echo Logic::makeResponse($r['result'], $r['msg']);
    }

    public function actionVip(){
        $this->title = '我的会员';
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/');
        }else{
            $data = Api::getData('user', 'vip', array('token'=>$token));
        }
        $this->render('vip', array('data'=>$data));
    }

    public function actionCarLog(){
        $this->title = '座驾购买记录';
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/');
        }else{
            $data = Api::getData('user', 'carLog', array('token'=>$token));
        }
        $this->render('carLog', array('data'=>$data));
    }

    public function actionSendGiftLog($page=1, $size=10){
        $this->title = '我送出的礼物';
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/');
        }else{
            $r = Api::getData('user', 'sendGiftLog', array('token'=>$token, 'page'=>$page, 'size'=>$size));
            if ($r) {
                $data = $r['list'];
                $pager['total'] = $r['all'];
                $pager['pages'] = $r['all_page'];
                $pager['page'] = $page;
            }else{
                $data = array();
                $pager['total'] = 0;
                $pager['pages'] = 0;
                $pager['page'] = 0;

            }
        }
        $this->render('giftLog', array('type'=>'send', 'data'=>$data, 'pager'=>$pager, 'size'=>$size));
    }

    public function actionRecvGiftLog($page=1, $size=10){
        $this->title = '我收到的礼物';
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/');
        }else{
            $r = Api::getData('user', 'recvGiftLog', array('token'=>$token, 'page'=>$page, 'size'=>$size));
            if ($r) {
                $data = $r['list'];
                $pager['total'] = $r['all'];
                $pager['pages'] = $r['all_page'];
                $pager['page'] = $page;
            }else{
                $data = array();
                $pager['total'] = 0;
                $pager['pages'] = 0;
                $pager['page'] = 0;

            }
        }
        $this->render('giftLog', array('type'=>'recv', 'data'=>$data, 'pager'=>$pager, 'size'=>$size));
    }

    public function actionMyRoom(){
        $this->title = '我的房间';
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/');
        }else{
            $data = Api::getData('user', 'myRoom', array('token'=>$token));
        }
        $this->render('myRoom', array('data'=>$data));
    }

    public function actionRoomInfo($id){
        $welcome = Yii::app()->request->getParam('welcome');
        $notice = Yii::app()->request->getParam('notice');
        if ($welcome !== null || $notice !== null) {
            $token = Logic::getToken();
            if ($token) {
                Api::get('room', 'changeInfo', array('token'=>$token, 'room_id' => $id, 'welcome' => $welcome, 'notice' => $notice));
            }
        }

        if ($_FILES) {
            list($r, $msg) = $this->uploadImage('room_icon');
            if ($r == 0) {
                $token = Logic::getToken();
                if ($token) {
                    Api::get('room', 'setRoomIcon', array('token'=>$token, 'room_id' => $id, 'file' => $msg));
                }
            }
        }

        $this->title = '我的房间信息';
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/');
        }
        $data = Api::getData('room', 'info', array('token'=>$token, 'room_id'=>$id));
        if (!$data) {
            $this->redirect('/');
        }
        $this->render('roomInfo', array('data'=>$data));
    }

    public function actionSetRoom($id){
        $this->title = '管理我的房间';
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/');
        }
        $data = Api::getData('room', 'info', array('token'=>$token, 'room_id'=>$id));
        $sql = "SELECT l.uid, u.username, u.gid, f.nickname
                  FROM c_room_limits AS l
                  LEFT JOIN c_user AS u ON (u.uid = l.uid)
                  LEFT JOIN c_user_fields AS f ON (f.uid = l.uid)
                  WHERE l.room_id='$id' AND l.type in (2,3) GROUP BY l.uid";
        $m = Yii::app()->db->createCommand($sql)->queryAll();
        $this->render('setRoom', array('data'=>$data, 'manager'=>$m));
    }

    // TODO: better alert
    public function actionDelFromRoom($user, $room){
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/account/setRoom/'.$room);
            return;
            //Logic::outputError('请先登录');
        }
        $user_info = User::info();
        $r = Yii::app()->db->createCommand("select type from c_room_limits where uid=".$user_info['uid']." and room_id=$room")->queryScalar();
        if ($r != 1) {
            $this->redirect('/account/setRoom/'.$room);
            return;
            //Logic::outputError('无权删除');
        }
        Yii::app()->db->createCommand("delete from c_room_limits where uid=$user and room_id=$room")->execute();
        //$this->redirect('/account/setRoom/'+$room);
        $this->redirect('/account/setRoom/'.$room);
        //echo Logic::makeResponse(0, "成功");
    }

    // TODO: better alert
    public function actionAddRoomAdmin($uid, $room_id){
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/account/setRoom/'.$room_id);
            return;
            //Logic::outputError('请先登录');
        }
        if ($uid < 1) {
            $this->redirect('/account/setRoom/'.$room_id);
            return;
            //Logic::outputError('用户不存在');
        }
        // TODO: more check
        Yii::app()->db->createCommand("insert into c_room_limits values($uid, $room_id, 3)")->execute();
        $this->redirect('/account/setRoom/'.$room_id);
    }

    public function actionExchangeList($page=1, $size=10){
        $this->title = '兑换记录';
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/');
        }else{
            $sql = 'select count(*) from c_cash where uid='.$this->user_info['uid'];
            $all_records = Yii::app()->db->createCommand($sql)->queryScalar();
            if (!$all_records) {
                $all_records = 0;
            }
            $all_page = ceil($all_records/$size);
            $sql = 'select sum(bean) from c_cash where uid='.$this->user_info['uid'];
            $all_beans = Yii::app()->db->createCommand($sql)->queryScalar();
            if (!$all_beans) {
                $all_beans = 0;
            }
            $offset = ($page-1)*$size;
            $sql = 'select * from c_cash where uid='.$this->user_info['uid']." order by add_time desc limit $offset, $size";
            $r = Yii::app()->db->createCommand($sql)->queryAll();
            if ($r) {
                $data = $r;
                $pager['total'] = $all_records;
                $pager['pages'] = $all_page;
                $pager['page'] = $page;
            }else{
                $data = array();
                $pager['total'] = 0;
                $pager['pages'] = 0;
                $pager['page'] = 0;

            }
        }
        $this->render('exchange', array('data'=>$data, 'pager'=>$pager, 'size'=>$size, 'all_beans'=>$all_beans));
    }

    public function actionMicTime($page=1, $size=10){
        $this->title = '在麦时长';
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/');
            return;
        }
        $start_time = strtotime(Yii::app()->request->getParam('startTime'));
        $end_time = strtotime(Yii::app()->request->getParam('endTime'));
        $time_sql = array();
        if ($start_time) {
            $time_sql[] = "ender_time >= '".$start_time."'";
        }
        if ($end_time) {
            $time_sql[] = "ender_time <= '".$end_time."'";
        }
        if (!$time_sql) {
            $time_sql[] = "ender_time >= '".(strtotime(date('Y-m-d', time())) - ((date('j', time())-1) * 3600 * 24))."'";
        }
        $tsql = implode(' and ', $time_sql);

        $sql = 'select count(*) from c_live_logs where uid='.$this->user_info['uid'].' and '.$tsql;
        $all_records = Yii::app()->db->createCommand($sql)->queryScalar();
        if (!$all_records) {
            $all_records = 0;
        }
        $all_page = ceil($all_records/$size);
        $sql = 'select sum(seconds) from c_live_logs where uid='.$this->user_info['uid'].' and '.$tsql;
        $all_times = Yii::app()->db->createCommand($sql)->queryScalar();
        if (!$all_times) {
            $all_times = 0;
        }
        $offset = ($page-1)*$size;
        $sql = 'select * from c_live_logs where uid='.$this->user_info['uid'].' and '.$tsql." order by ender_time desc limit $offset, $size";
        $r = Yii::app()->db->createCommand($sql)->queryAll();
        if ($r) {
            foreach ($r as $k => $one) {
                $room_info = Api::getData('room', 'getInfo', array('room_id'=>$one['room_id']));
                $r[$k]['room_name'] = $room_info['room_name'];
            }
            $data = $r;
            $pager['total'] = $all_records;
            $pager['pages'] = $all_page;
            $pager['page'] = $page;
        }else{
            $data = array();
            $pager['total'] = 0;
            $pager['pages'] = 0;
            $pager['page'] = 0;

        }
        $this->render('micTime', array('data'=>$data, 'pager'=>$pager, 'size'=>$size, 'all_times'=>$all_times, 'start_time'=>$start_time, 'end_time'=>$end_time));
    }

    public function actionMicDay(){
        $user = User::info();
        if (!$user) {
            $this->redirect('/');
            return;
        }

        $start_date = strtotime(date('Y-m-01'));
        $end_date = strtotime(date('Y-m-d', strtotime('first day of +1 month')));
        $mic_day = User::micCount($user['uid'], $start_date, $end_date);

        $r = array();
        for($i = $start_date; $i < $end_date; $i+=86400){
            $day = date('Y-m-d', $i);
            if (isset($mic_day[$day])) {
                $r[$day] = array(1, Yii::app()->db->createCommand('select room_name from c_room where room_id='.$mic_day[$day])->queryScalar());
            }else{
                $r[$day] = array(0, '');
            }
        }

        $this->title = '有效天数';
        $this->render('micDay', array('data'=>$r, 'all'=>count($mic_day)));
    }

    public function actionSetAvatar(){
        list($r, $msg) = $this->uploadImage('avatar');
        if ($r == 0) {
            $token = Logic::getToken();
            if (!$token) {
                $msg = '请先登录';
            }else{
                Api::get('user', 'setAvatar', array('token'=>$token, 'file'=>$msg));
                $msg = '修改成功';
            }
        }
        $this->redirect('info', array('msg'=>$msg));
    }

    protected function uploadImage($type){
        if (!$_FILES) {
            return array(1, '文件不存在');
        }
        if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/pjpeg")
                || ($_FILES["file"]["type"] == "image/x-png")
                || ($_FILES["file"]["type"] == "image/png"))
            && ($_FILES["file"]["size"] <= 1024*800)
        ) {
            if ($_FILES["file"]["error"] > 0) {
                return array(2, "错误: " . $_FILES["file"]["error"]);
            }else {
                $new_name = "i_".$this->user_info['uid']."_".md5($_FILES["file"]["name"]);
                move_uploaded_file($_FILES["file"]["tmp_name"], Yii::getPathOfAlias('webroot.upload.'.$type).'/'.$new_name);
                return array(0, $new_name);
            }
        }
        else {
            return array(3, "请检查文件的尺寸和大小！");
        }
    }

    public function actionFans($page=1, $size=10){
        $this->title = '我的粉丝';
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/');
        }else{
            $sql = "SELECT count(f.uid) FROM c_room_limits l,c_room_fav f  WHERE l.room_id=f.room_id AND l.type =1 AND l.uid=".$this->user_info['uid'];
            $all_records = Yii::app()->db->createCommand($sql)->queryScalar();
            if (!$all_records) {
                $all_records = 0;
            }
            $all_page = ceil($all_records/$size);
            $offset = ($page-1)*$size;
            $sql = "SELECT f.uid as uid FROM c_room_limits l,c_room_fav f  WHERE l.room_id=f.room_id AND l.type =1 AND l.uid=".$this->user_info['uid']." limit $offset, $size";
            $r = Yii::app()->db->createCommand($sql)->queryAll();
            if ($r) {
                foreach ($r as $key => $one) {
                    $user_info = User::info(intval($one['uid']));
                    $r[$key]['nickname'] = $user_info['nickname'];
                    $r[$key]['gid'] = $user_info['anchor_id'];
                    $r[$key]['level'] = $user_info['user_level'];
                }
                $data = $r;
                $pager['total'] = $all_records;
                $pager['pages'] = $all_page;
                $pager['page'] = $page;
            }else{
                $data = array();
                $pager['total'] = 0;
                $pager['pages'] = 0;
                $pager['page'] = 0;

            }
        }
        $this->render('fans', array('data'=>$data, 'pager'=>$pager, 'size'=>$size));
    }

    public function actionFamily($page=1, $size=10){
        $this->title = '主播信息';
        $token = Logic::getToken();
        if (!$token) {
            $this->redirect('/');
        }else{
            $family_id = Api::getData('user', 'getFamily', array('token'=>$token));
            if (!$family_id) {
                $this->redirect('/');
            }
            $start_time = strtotime(Yii::app()->request->getParam('startTime'));
            $end_time = strtotime(Yii::app()->request->getParam('endTime'));
            $time_sql = array();
            if ($start_time) {
                $time_sql[] = "add_time >= '".$start_time."'";
            }
            if ($end_time) {
                $time_sql[] = "add_time <= '".$end_time."'";
            }
            if (!$time_sql) {
                $start_time = strtotime(date('Y-m-d', time())) - ((date('j', time())-1) * 3600 * 24);
                $end_time = time();
                $time_sql[] = "add_time >= '$start_time'";
            }
            $tsql = implode(' and ', $time_sql);

            $sql = "SELECT COUNT(*) FROM c_family_limits WHERE family_id = ". $family_id ." AND is_anchor=2 AND del_flag=0";
            $all_records = Yii::app()->db->createCommand($sql)->queryScalar();
            if (!$all_records) {
                $all_records = 0;
            }
            $all_page = ceil($all_records/$size);
            $offset = ($page-1)*$size;
            $sql = "SELECT * FROM c_family_limits WHERE family_id=".$family_id." AND del_flag=0 AND is_anchor=2 limit $offset, $size";
            $d = Yii::app()->db->createCommand($sql)->queryAll();
            $data = array();
            if ($d) {
                foreach ($d as $one) {
                    $user_info = User::info(intval($one['uid']));
                    $o['fname'] = $user_info['family_name'];
                    $o['uname'] = $user_info['nickname'];
                    $o['fid'] = $one['family_id'];
                    $sql = "SELECT SUM(total_price) FROM c_gift_logs WHERE to_uid = ".$one['uid'].' and '.$tsql;
                    $o['income'] = Yii::app()->db->createCommand($sql)->queryScalar();
                    $o['gid'] = $user_info['anchor_id'] ? $user_info['anchor_id'] : $user_info['uid'];
                    $sql = "SELECT SUM(seconds) FROM c_live_logs WHERE uid = ".$one['uid'].' and '.str_replace('add_time', 'ender_time', $tsql);
                    $sec = Yii::app()->db->createCommand($sql)->queryScalar();
                    $o['live_count'] = round($sec/3600,3);
                    $o['uid'] = $one['uid'];
                    $mic_day = User::micCount($one['uid'], $start_time, $end_time);
                    $o['mic_day'] = count($mic_day);
                    $data[] = $o;
                }
                $pager['total'] = $all_records;
                $pager['pages'] = $all_page;
                $pager['page'] = $page;
            }else{
                $pager['total'] = 0;
                $pager['pages'] = 0;
                $pager['page'] = 0;
            }
        }
        $this->render('family', array('data'=>$data, 'pager'=>$pager, 'size'=>$size, 'start_time'=>$start_time, 'end_time'=>$end_time));
    }

    public function actionFamilyApply($page=1, $size=10, $pass='', $uid=0){
        $info = User::info();
        $fid = $info['family_id'];
        if ($pass && $uid) {
            if($pass=='yes'){
                Yii::app()->db->createCommand("UPDATE c_family_limits SET del_flag=1 WHERE uid=".$uid." AND family_id<>".$fid)->execute();
                Yii::app()->db->createCommand("UPDATE c_family_limits SET TYPE=3 WHERE uid=".$uid." AND family_id=" .$fid)->execute();
            }
            else{
                Yii::app()->db->createCommand("UPDATE c_family_limits SET del_flag=1 WHERE uid=".$uid." AND family_id=" .$fid)->execute();
            }
        }

        //统计总数
        $all_records = Yii::app()->db->createCommand("SELECT COUNT(*) FROM c_family_limits WHERE type=4 AND del_flag=0 AND family_id = '$fid'")->queryScalar();
        if (!$all_records) {
            $all_records = 0;
        }
        $all_page = ceil($all_records/$size);
        $offset = ($page-1)*$size;
        $sql = "SELECT * FROM c_family_limits WHERE type=4 AND del_flag=0 AND family_id =".$fid." limit $offset, $size";
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        if ($res) {
            for ($i=0; $i < count($res); $i++)
            {
                $user_info = User::info(intval($res[$i]['uid']));
                $res[$i]['fname']    = Yii::app()->db->createCommand("SELECT family_name FROM c_family WHERE family_id = ".$res[$i]['family_id'])->queryScalar();
                $res[$i]['uname']    = $user_info['nickname'];
                $res[$i]['uid']    = $res[$i]['uid'];
                $res[$i]['isAnchor']    = $res[$i]['is_anchor'];
                $res[$i]['gid']    = $user_info['anchor_id'] ? $user_info['anchor_id'] : $user_info['uid'];
            }
            $pager['total'] = $all_records;
            $pager['pages'] = $all_page;
            $pager['page'] = $page;
        }else{
            $pager['total'] = 0;
            $pager['pages'] = 0;
            $pager['page'] = 0;
        }
        $this->render('familyApply', array('family_user_list'=>$res, 'pager'=>$pager, 'size'=>$size));
    }

    public function actionFamilyView($uid, $page=1, $size=10){
        //总兑换U豆
        $cash_count = Yii::app()->db->createCommand("SELECT SUM(bean) FROM c_cash WHERE uid = '$uid'")->queryScalar();

        //获取数据
        $sql = "SELECT COUNT(*) FROM c_cash WHERE uid = $uid";
        $all_records = Yii::app()->db->createCommand($sql)->queryScalar();
        if (!$all_records) {
            $all_records = 0;
        }
        $all_page = ceil($all_records/$size);
        $offset = ($page-1)*$size;
        $sql = "SELECT * FROM c_cash WHERE uid = '$uid' ORDER BY add_time DESC limit $offset, $size";
        $logs = Yii::app()->db->createCommand($sql)->queryAll();;
        if ($logs) {
            for ($i=0; $i < count($logs); $i++){
                $logs[$i]['add_time'] = $logs[$i]['add_time'] ? date('Y-m-d H:i:s', $logs[$i]['add_time']) : '';
            }
            $pager['total'] = $all_records;
            $pager['pages'] = $all_page;
            $pager['page'] = $page;
        }else{
            $pager['total'] = 0;
            $pager['pages'] = 0;
            $pager['page'] = 0;
        }
        $user_info = User::info(intval($uid));
        //$scale = Yii::app()->redis->getClient()->hGet('config', 'exchange_scale');
        $scale = 0.01;
        $changeRMB = round(intval($user_info['bean']) * $scale);
        $p['anchor_bean'] = $user_info['bean'];
        $p['changeRMB'] = $changeRMB;
        $p['cash_count'] = $cash_count;
        $p['logs'] = $logs;
        $p['pager'] = $pager;
        $p['size'] = $size;
        $p['uid'] = $uid;
        $this->render('familyView', $p);
    }

    public function actionVerifyEmail(){
        $password = Yii::app()->request->getParam('password');
        $email = Yii::app()->request->getParam('email');
        $info = User::info();
        if (!$info) {
            Logic::outputError('请先登录');
        }
        $p = Yii::app()->db->createCommand('select password from c_user where uid='.$info['uid'])->queryScalar();
        if ($p != md5($password)) {
            Logic::outputError('密码错误');
        }
        $token = md5($info['username'].$info['uid'].rand(1000, 9999)); //创建用于激活识别码
        $token_exptime = time()+3600;
        $subject = "U美用户邮箱验证邮件（请勿回复）";
        $url = "http://".$_SERVER['HTTP_HOST'];
        $name = $info['nickname'] ? $info['nickname'] : $info['username'];
        $body = "<img src='".$url."/css/img/uumie_logo.png' width='72' height='46' /><br><br>您好，".$info['username']."：<br/>
        您在U美网申请了验证密保邮箱，请点击以下链接来完成验证：<br/><a href=".$url."/account/setMail/verify/".$token." target='_blank'>".$url."/account/setMail/verify/".$token."</a>
        <br/>如果链接无法点击，请您选择并复制整个链接，打开浏览器窗口并将其粘贴到地址栏中。然后单击\"转到\"按钮或按键盘上的 Enter 键。<br/>
        注：此验证邮箱链接在您申请时起24小时内有效，如地址已失效，请重新申请验证密保邮箱并尽快完验证。<br/>此为系统消息，请勿回复。<br/>
        -----------------------<br/>U美网 <a href='http://www.uumie.com/' target='_blank'>".$url."</a>";
        if(!Logic::sendMail($email, $name, $subject, $body)){
            Logic::outputError('邮件发送失败，请联系官方人员！');
        }
        $sql = "INSERT INTO c_check_email(username,uid,token,token_exptime,add_time) VALUES('".$info['username']."',".$info['uid'].",'".$token."',".$token_exptime.",".time().")";
        Yii::app()->db->createCommand($sql)->execute();
        $sql = "UPDATE c_user_fields SET email_status=0, email='".$email."' WHERE uid=".$info['uid'];
        Yii::app()->db->createCommand($sql)->execute();
        echo Logic::makeResponse(0,"ok");
    }
}