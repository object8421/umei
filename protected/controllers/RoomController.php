<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 15/3/7
 * Time: 下午7:26
 */

class RoomController extends Controller {
    public function actionGiftMessage(){
        $r = Api::getData('room', 'giftMessage');
        $this->layout = false;
        $this->render('message', array('messages'=>$r));
    }

    public function actionBroadcast(){
        $data = Api::getData('room', 'getSpeaker');
        if (!$data) {
            $data = array();
        }
        echo Logic::makeResponse(0, 'ok', json_encode($data));
    }

    public function actionBulletin($id){
        $room_info = Room::getInfoByAnchor($id);
        if ($room_info) {
            echo $room_info['notice'];
        }else{
            echo '';
        }
    }

    public function actionCar($id){
        $info = Room::getCar($id);
        if ($info) {
            $r['error'] = 0;
            $r['content']['msg'] = '开着<span class="red">'.$info['name'].'</span>进入房间<br><span class="lcwordcar"><img src="'.$info['image'].'"></span>';
            $r['content']['swf'] = $info['swf'];
            $r['content']['swf_life'] = $info['swf_life'];
        }else{
            $r['error'] = 1;
        }
        echo json_encode($r);
    }

    public function actionGiftList(){
        $r = array();
        $list = Api::getData('room', 'giftList');
        foreach ($list as $one) {
            $r[$one['gift_cat']][] = $one;
        }

        if ($list) {
            $this->layout = false;
            $this->render('/site/gift', array('list'=>$r));
        }else{
            echo '';
        }
    }

    public function actionFans($id){
        $room_info = Room::getInfoByAnchor($id);
        if ($room_info) {
            $n = $room_info['fans'];
        }else{
            $n = 0;
        }
        echo "粉丝人数（".$n."）";
    }

    public function actionRecommend(){
        $this->layout = false;
        $data = Api::getData('room', 'recommend');
        $this->render('recommend', array('data'=>$data));
    }

    public function actionAddFav(){
        $room_id = Yii::app()->request->getParam('room_id');
        $token = Logic::getToken();
        if (!$token) {
            Logic::outputError('请登录后购买');
        }
        $r = Api::get('room', 'addFav', array('token'=>$token, 'room_id'=>$room_id));
        if(isset($r['result']) && $r['result'] == 0){
            $result['error'] = 0;
            $result['message'] = '成功';
            $result['content'] = 0;
        }else{
            $result['error'] = 1;
            $result['message'] = '失败';
            $result['content'] = 0;
        }
        echo json_encode($result);
    }

    public function actionDelFav(){
        $room_id = Yii::app()->request->getParam('room_id');
        $token = Logic::getToken();
        if (!$token) {
            Logic::outputError('请登录后购买');
        }
        $r = Api::get('room', 'delFav', array('token'=>$token, 'room_id'=>$room_id));
        if(isset($r['result']) && $r['result'] == 0){
            $result['error'] = 0;
            $result['message'] = '成功';
            $result['content'] = 0;
        }else{
            $result['error'] = 1;
            $result['message'] = '失败';
            $result['content'] = 0;
        }
        echo json_encode($result);
    }

    public function actionList($catid=0){
        $rooms = Room::getList(1, 500, $catid);
        $this->layout = false;
        $this->render('list', array('rooms'=>$rooms));
    }

    public function actionData($id){
        if (!$id) {
            $res['res'] = 0;
            $res['reason'] = 'Request failed!';
            echo json_encode($res);
            return;
        }

        $info = Api::getData('room', 'getInfo', array('room_id'=>$id));
        if (!$info) {
            $res['res'] = 0;
            $res['reason'] = '房间不存在！';
            echo json_encode($res);
            return;
        }

        $res['res'] = 1;

        $res['glamour'] = $info['anchor_info']['anchor_level'];
        $res['glamour_next'] = $info['anchor_info']['anchor_next_level'];
        $res['glamour_need'] = $info['anchor_info']['anchor_next_need'];
        $res['glamour_need_percent'] = $info['anchor_info']['anchor_next_percent'];

        // below is no use
        $res['rich'] = 1;
        $res['rich_next'] = 2;
        $res['rich_need'] = 1;
        $res['rich_need_percent'] = 1;

        $gift_count = Api::getData('room', 'giftCount', array('room_id'=>$id));
        if ($gift_count) {
            list($gift_today, $gift_all) = $gift_count;
        }else{
            $gift_today = $gift_all = array();
        }
        $res['fans'] = array($gift_today, $gift_all);
        $gift_list = Api::getData('room', 'sendGiftList', array('room_id'=>$id));
        $res['gift_list'] = $gift_list;

        echo json_encode($res);
    }

    public function actionDisableChat(){
        // TODO: 权限判断
        $room_id = Yii::app()->request->getParam('room_id');
        $uid = Yii::app()->request->getParam('uid');

        Api::get('room', 'disableChat', array('room_id'=>$room_id, 'uid'=>$uid));
        echo json_encode(array('RES'=>1, 'HINT'=>''));
    }

    public function actionKickOut(){
        // TODO: 权限判断
        $room_id = Yii::app()->request->getParam('room_id');
        $uid = Yii::app()->request->getParam('uid');

        Api::get('room', 'kickOut', array('room_id'=>$room_id, 'uid'=>$uid));
        echo json_encode(array('RES'=>1, 'HINT'=>''));
    }
}