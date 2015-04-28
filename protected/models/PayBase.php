<?php
/* 所有支付基类  */
class PayBase {

    /* 支付通道 */
    public $pay_pass = "";

    /* 支付代码 */
    public $pay_code = "";

    public function __construct() {}

    /* 获取支付代码 */
    public function get_code($order, $payment){
        return 0;
    }

    /* 响应第三方支付 */
    public function respond(){
        return 0;
    }

    /* 获取银行代码 */
    public function get_banks(){
        return 0;
    }

    /* 获取充值卡面额 */
    public function get_card(){
        return 0;
    }

    /* 游戏充值卡渠道 */
    public function get_games(){
        return 0;
    }

    /* 支付成功应答第三方支付的字符串 */
    public function return_style($str=''){
        return 'success';
    }
}