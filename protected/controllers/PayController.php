<?php

class PayController extends Controller
{
	public function actionDeal()
	{
        $user_info = User::info();
        if (!$user_info) {
            Logic::outputError('用户未登录');
        }

        // 变量初始化
        $surplus = array(
            'uid'      => $user_info['uid'],
            'pay_code' => isset($_REQUEST['pay_code'])   ? trim($_REQUEST['pay_code'])   : '',
            'amount'   => isset($_REQUEST['amount'])     ? intval($_REQUEST['amount'])   : 0,
            'order_sn' => isset($_REQUEST['virtual_sn']) ? trim($_REQUEST['virtual_sn']) : 0,
            'orid'     => isset($_REQUEST['orid'])       ? intval($_REQUEST['orid'])     : 0, //充值所在房间ID
            'pay_pass' => isset($_REQUEST['pay_pass'])   ? trim($_REQUEST['pay_pass'])   : 0  //支付通道
        );

        // 钱不能为负数，提示
        if($surplus['amount'] <= 0) {
            Logic::outputError('ps:要充值的金额必须大于零');
        }

        // 如果没有选择支付方式，提示
        if($surplus['pay_code'] == 'null') {
            Logic::outputError('ps:请选择支付方式');
        }

        // 序列化已安装的支付方式配置参数
        $payment_info = Api::getData('pay', 'getType', array('pay_code'=>$surplus['pay_code']));

        // 如果没有获取到支付方式提示
        if(! is_array($payment_info)) {
            Logic::outputError('ps:当前支付方式已停用');
        }

        $payment = Logic::unserializeConfig($payment_info['pay_config']);

        // 生成订单,如果虚拟订单号长度和系统规定的订单号一样
        $order['order_sn'] = (strlen($surplus['order_sn']) == strlen(Logic::get_order_sn())) ? $surplus['order_sn'] : Logic::get_order_sn();

        // 如果订单已经支付过了
        $data = Api::getData('pay', 'getLog', array('sn'=>$order['order_sn']));
        if($data && $data['is_pay']) {
            Logic::outputError('ps:该订单已经成功支付过了，请重新发起充值！');
        }

        $order['amount'] = $surplus['amount'];

        // 计算充值的金币数量
        if(isset($payment['coin_scale'])){
            $coin_scale = intval($payment['coin_scale']);
        }else{
            $coin_scale = intval(Yii::app()->params['coin_scale']);
        }

        $addcoin = $order['amount'] * $coin_scale;

        // 是否在房间中打开充值页面, 获取代理
        if ($surplus['orid']){
            /*
            $room_agency_uid = $room->get_room_agency($surplus['orid']);
            if ($room_agency_uid){
                $from_uid = $agency->is_agency($room_agency_uid);
            }else{
                $from_uid = 0;
            }
            */
            $from_uid = 0;
        }else{
            $from_uid = 0;
        }

        // 创建订单log, 并得到log_id
        $data = array(
            'token' => Logic::getToken(),
            'sn' => $order['order_sn'],
            'room_id' => $surplus['orid'],
            'from_uid' => $from_uid,
            'pay_code' => $payment_info['pay_code'],
            'pay_name' => $payment_info['pay_name'],
            'amount' => $order['amount'],
            'addcoin' => $addcoin,
        );
        $log_id = Api::getData('pay', 'addLog', $data);
        if (!$log_id) {
            Logic::outputError('建立订单失败');
        }
        $order['log_id'] = $log_id;

        $pay_class = ucfirst($payment_info['pay_code']);
        if ( !class_exists($pay_class)){
            Logic::outputError('ps:当前支付方式已停用！');
        }

        // 取得在线支付方式的支付按钮
        $pay_obj = new $pay_class;
        if($surplus['pay_pass']){
            $pay_obj->pay_pass = $surplus['pay_pass'];
        }
        $pay_obj->paycode = $payment_info['pay_code'];

        // 需要返回的参数
        $result['username']   = $user_info['username'];                     // 充值的用户名
        $result['uid']        = $user_info['uid']; // 充值的账号
        $result['amount']     = $order['amount'];                          // 充值金额
        $result['payname']    = $payment_info['pay_name'];                 // 充值方式
        $result['order_sn']   = $order['order_sn'];                        // 此次充值的订单号
        $result['paybtn']     = $pay_obj->get_code($order, $payment);      // 支付按钮

        if ( empty($result['paybtn']) ){
            Logic::outputError('ps:当前支付方式已停用！！');
        }

        echo json_encode($result);
	}

    public function actionIndex(){
        $user_info = User::info();
        if (!$user_info) {
            Yii::app()->user->setReturnUrl('/pay/index');
            $this->redirect('/login');
        }
        $pay_type = Yii::app()->request->getParam('paytype');
        if (!$pay_type) {
            $pay_type = 'alipay';
        }
        $this->menu_key = 'payment';
        //$pay_list = Api::getData('pay', 'getType');
        $pay_one = Api::getData('pay', 'getType', array('pay_code'=>'alipay'));  // TODO: Add more pay method
        $pay_list = array($pay_one);
        foreach ($pay_list as $one) {
            if ($one['pay_code'] == $pay_type) {
                $now = $one;
            }
        }
        $className = ucfirst($pay_type);
        $pay = new $className;
        $coin_scale = Api::getData('pay', 'coinScale');
        $param = array(
            'mod'=>'payment',
            'pay_list'=>$pay_list,
            'pay_type'=>$pay_type,
            'user_info'=>$user_info,
            'now'=>$now,
            'coin_scale'=>$coin_scale,
            'pay'=>$pay,
            'orid'=>0,
            'virtual_sn'=>Logic::get_order_sn(),
        );
        $this->render('index', $param);
    }

    public function actionReturn($from){
        $name = '';
        $amount = 0;
        $time = '';
        if ($from == 'alipay') {
            //商户订单号
            $out_trade_no = $_GET['out_trade_no'];

            //支付宝交易号
            $trade_no = $_GET['trade_no'];

            //交易状态
            $trade_status = $_GET['trade_status'];
            $pay_type = '支付宝';
            //计算得出通知验证结果
            $alipayNotify = new AlipaySDK();
            $verify_result = $alipayNotify->verifyReturn();
            if($verify_result) { //验证成功
                if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                    //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                    $data = Api::getData('pay', 'getLog', array('sn'=>$out_trade_no));
                    if ($data){
                        $user_info = User::info($data['uid']);
                        $name = $user_info['username'];
                        $amount = $data['amount'];
                        $time = date('Y-m-d H:i:s');  //TODO: alipay time
                        $result = 0;
                    }else{
                        $result = 1;
                    }
                } else {
                    $result = 2;
                }
            } else {
                //验证失败
                //如要调试，请看alipay_notify.php页面的verifyReturn函数
                $result = 3;
            }
        }

        $param = array(
            'result'=>$result,
            'trade_status'=>$trade_status,
            'trade_no'=>$out_trade_no,
            'alipay_no'=>$trade_no,
            'name'=>$name,
            'pay_type' => $pay_type,
            'amount' => $amount,
            'time' => $time,
        );
        $this->layout = false;
        $this->render('return', $param);
    }

    public function actionJump($to){
        if ($to == 'alipay') {
            //支付类型
            $payment_type = "1";
            //必填，不能修改
            //服务器异步通知页面路径
            $notify_url = "http://".Yii::app()->params['api_host']."/pay/notify/from/alipay";
            //需http://格式的完整路径，不能加?id=123这类自定义参数        //页面跳转同步通知页面路径
            $return_url = "http://".Yii::app()->params['web_host']."/pay/return/from/alipay";
            //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/        //卖家支付宝帐户
            $seller_email = Yii::app()->params['alipay_seller_email'];
            //必填        //商户订单号
            $out_trade_no = $_POST['WIDout_trade_no'];
            //商户网站订单系统中唯一订单号，必填        //订单名称
            $subject = $_POST['WIDsubject'];
            //必填        //付款金额
            $total_fee = $_POST['WIDtotal_fee'];
            //必填        //订单描述
            $body = "U币";
            //商品展示地址
            $show_url = $_POST['WIDshow_url'];
            //需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html        //防钓鱼时间戳
            $anti_phishing_key = "";
            //若要使用请调用类文件submit中的query_timestamp函数        //客户端的IP地址
            $exter_invoke_ip = "";
            //非局域网的外网IP地址，如：221.0.0.1

            //构造要请求的参数数组，无需改动
            $parameter = array(
                "service" => "create_direct_pay_by_user",
                "partner" => Yii::app()->params['alipay_partner'],
                "payment_type"	=> $payment_type,
                "notify_url"	=> $notify_url,
                "return_url"	=> $return_url,
                "seller_email"	=> $seller_email,
                "out_trade_no"	=> $out_trade_no,
                "subject"	=> $subject,
                "total_fee"	=> $total_fee,
                "body"	=> $body,
                "show_url"	=> $show_url,
                "anti_phishing_key"	=> $anti_phishing_key,
                "exter_invoke_ip"	=> $exter_invoke_ip,
                "_input_charset"	=> 'utf-8',
            );

            //建立请求
            $alipaySubmit = new AlipaySDK();
            $code = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
            $this->layout = false;
            $this->render('jump', array('code'=>$code));
        }
    }
}
