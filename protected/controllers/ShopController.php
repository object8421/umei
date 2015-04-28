<?php

class ShopController extends Controller
{
    public function init(){
        $this->menu_key = 'shop';
    }

	public function actionCar()
	{
        $this->title = '座驾商城';
        $cars = Api::getData('shop', 'car');
		$this->render('car', array('car_list'=>$cars));
	}

    public function actionBuyGift(){
        $gift_id = Yii::app()->request->getParam('gift_id');
        $to_uid = Yii::app()->request->getParam('to_uid');
        $sum = Yii::app()->request->getParam('sum');
        $room_id = Yii::app()->request->getParam('room_id');
        if (!$gift_id || !$to_uid || $sum < 1 || !$room_id) {
            Logic::outputError('数据错误');
        }
        $token = Logic::getToken();
        if (!$token) {
            Logic::outputError('请登录后购买');
        }
        $this->layout = false;
        $r = Api::get('shop', 'buyGift', array('gift_id'=>$gift_id, 'token'=>$token, 'sum'=>$sum, 'room_id'=>$room_id, 'to_uid'=>$to_uid));
        if (isset($r['result']) && $r['result'] == 0) {
            echo $r['data'];
        }else{
            Logic::outputError($r['msg']);
        }
    }

    public function actionBuyCar($id){
        $this->layout = false;
        if (!$id) {
            Logic::outputError('请选择座驾进行购买');
        }
        $token = Logic::getToken();
        if (!$token) {
            Logic::outputError('请登录后购买');
        }
        $r = Api::get('shop', 'buyCar', array('car_id'=>$id, 'token'=>$token));
        echo Logic::makeResponse($r['result'], $r['msg']);
    }

    public function actionBuyNumber($id){
        $this->layout = false;
        if (!$id) {
            Logic::outputError('请选择靓号进行购买');
        }
        $token = Logic::getToken();
        if (!$token) {
            Logic::outputError('请登录后购买');
        }
        $r = Api::get('shop', 'buyNumber', array('number'=>$id, 'token'=>$token));
        echo Logic::makeResponse($r['result'], $r['msg']);
    }

    public function actionBuyVip($id){
        $this->layout = false;
        if (!$id) {
            Logic::outputError('请选择VIP进行购买');
        }
        $token = Logic::getToken();
        if (!$token) {
            Logic::outputError('请登录后购买');
        }
        $r = Api::get('shop', 'buyVip', array('vip'=>$id, 'token'=>$token));
        echo Logic::makeResponse($r['result'], $r['msg']);
    }

	public function actionNumber($page=1, $size=20)
	{
        $this->title = '靓号商城';
        $data = Api::getData('shop', 'number', array('page'=>$page, 'size'=>$size));
		$this->render('number', array('data'=>$data, 'size'=>$size));
	}

	public function actionVip()
	{
        $this->title = 'VIP商城';
        $data = Api::getData('shop', 'vip');
        $this->render('vip', array('data'=>$data));
	}
}