<?php

class SiteController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $this->menu_key = 'index';
		$info = User::info();
        $rooms = Room::getList();
        $room_recommend = Api::getData('room', 'topRecommend', array('size'=>3));
        list($active_all, $active_category) = User::totalOnline();
		$this->render('index', array('user_info'=>$info, 'rooms'=>$rooms, 'recommend'=>$room_recommend, 'active_all'=>$active_all, 'active_category'=>$active_category));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionApply(){
		$this->render('apply');
	}

	public function actionRoom($id){
		$room_info = Room::getInfoByAnchor($id);
        if (!$room_info) {
            $this->redirect('/');
        }
        if (Yii::app()->redis->getClient()->sIsMember('room_lock', $room_info['room_id'])){
            $this->redirect('/');
        }

        $is_fav = User::checkFav($id);
        $user_info = User::info();
        $common_info = Room::getCommonInfo();

        if ($user_info) {
            Api::get('user', 'setLastServer', array('uid'=>$user_info['uid'], 'ip'=>$room_info['mserver_ip']));
        }

        $info = Api::getData('room', 'userInfo', array('room_id'=>$room_info['room_id'], 'uid'=>$user_info['uid']));
        if ($info) {
            $level = $info['level'];
        }else{
            $level = 1;
        }

        $kickout = 0;
        if ($user_info && $room_info) {
            $sql = "select expire from c_room_kicklist where uid=".$user_info['uid']." and room_id=".$room_info['room_id']." and expire >= ".time();
            $r = Yii::app()->db->createCommand($sql)->queryScalar();
            if ($r) {
                $kickout = $r - time();
            }
        }

        $last_broad = Api::getData('room', 'lastBroad');
        if (!$last_broad) {
            $last_broad = '{}';
        }

        $this->layout = false;
        $param = array('room_info'=>$room_info, 'is_fav'=>$is_fav, 'last_broad'=>$last_broad,
            'common_info'=>$common_info, 'user_info'=>$user_info, 'level'=>$level, 'kickout'=>$kickout);
		$this->render('room', $param);
	}

    public function actionRank(){
        $top = Api::getData('rank', 'top', array('top'=>5));
        echo json_encode($top);
    }

    public function actionFamilyRecommend(){
        // TODO: anchor/familyRecommended
        $this->layout = false;
        $this->render('familyRecommend');
    }

    public function actionTop(){
        $this->menu_key = 'top';
        $top = Api::getData('rank', 'top', array('top'=>20));
        $this->render('top', array('rank'=>json_encode($top)));
    }

    public function actionLogin()
    {
        $msg = '';
        if ($_REQUEST) {
            list($r,$msg) = User::login();
            if($r == 0){
                $url = Yii::app()->user->getReturnUrl();
                if (!$url) {
                    $url = '/';
                }
                $this->redirect($url);
                return;
            }
        }
        $this->layout = false;
        $this->render('login', array('error'=>$msg));
    }

    public function actionRegister(){
        $username = Yii::app()->request->getParam('username');
        $password = Yii::app()->request->getParam('password');
        $confirm_password = Yii::app()->request->getParam('confirm_password');
        $captcha = Yii::app()->request->getParam('captcha');

        list($r, $msg) = User::register($username, $password, $confirm_password, $captcha);
        if ($r == 0) {
            $this->redirect('/');
        }
        $this->layout = false;
        $this->render('register', array('error'=>$msg));
    }

    public function actionCaptcha(){
        $img = new Captcha(Yii::getPathOfAlias('webroot.images.captcha'), 50, 22);
        $img->generate_image();
    }

    public function actionDesktop(){
        $this->layout = false;
        $Shortcut = "[InternetShortcut]
                URL=http://".$_SERVER['HTTP_HOST']."
                IDList=
                [{000214A0-0000-0000-C000-000000000046}]
                IconFile=favicon.ico
                HotKey=1626
                Prop3=19,2
                ";
        $filename = "U美直播社区.url";
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=".$filename.";");
        echo $Shortcut;
    }
}
