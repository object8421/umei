<?php

define('IN_NCT', true);
define('INIT_NO_ROOMS', true); // 不启用room类

if ( ! defined('BIN_PATH') ){
   define('BIN_PATH', '/opt/uu89/web/chat/bin/');
}
include BIN_PATH . 'inc.init.php';
include BIN_PATH . 'cls.account.php';

$accobj = new account();

function get_logid($order_sn)
{
	//echo "get_logid";
    $data = Api::getData('pay', 'getLog', array('sn'=>$order_sn));
	if($data){
		return $data['log_id'];
	}

	return false;
}

function finish_trade($order_sn,$silent)
{
	//echo "您的U币充值已经成功！请到您的<a href='/account.php'>个人中心</a>查看！<br />";
	$log_id = get_logid($order_sn);
	//echo "finish_trade";
	if ($log_id){
		//do_pay($log_id);
		if ($silent==false){
			echo "您的U币充值已经成功！请到您的<a href='/account/info'>个人中心</a>查看！<br />";
		}
	}
	else{
		if ($silent==false){
			echo "U币充值出现了异常！不要关闭页面，请立刻记下U币充值流水号[".$order_sn."],及时联系网站客服人员解决问题！<br />";
		}	
	}
}





//finish_trade('14111256983878',true);
?>