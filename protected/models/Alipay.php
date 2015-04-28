<?php
class Alipay extends PayBase
{
    public function __construct(){
        $this->pay_code = strtolower(basename(__FILE__, '.php'));
        $this->pay_pass = '0';
    }

    /**
     * 生成支付代码
     * @param   array    $order       订单信息
     */
    public function get_code($order, $payment=0)
    {
        /* 以下是参与签名的参数 */
        // 获得订单号
        $order_sn = $order['order_sn'];
        // 订单描述, 用订单号代替
        $desc = 'U美网的'.($order['amount']*100).'个U币';
        $amount = $order['amount'];
        $button = "<form id=payform name=alipayment action=/pay/jump/to/alipay method=post>";
        //$button = "<form id=payform name=alipayment action=/pay/alipay/alipayapi.php?encoding=UTF-8 method=post>";
        $button .= "<input type=\"hidden\" name=\"WIDout_trade_no\" value=\"$order_sn\"/>";
        $button .= "<input type=\"hidden\" name=\"WIDsubject\" value=\"$desc\"/>";
        $button .= "<input type=\"hidden\" name=\"WIDtotal_fee\" value=\"$amount\"/>";
        $button .= "<input type=\"hidden\" name=\"WIDshow_url\" value=\"\"/>";
        $button .= "<a href=\"javascript:;\" class=\"normalBtn\" onclick=\"document.getElementById('payform').submit()\"><i>支 付</i></a>";
        $button .= "</form>";
        return $button;
    }

    /**
     * 响应操作
     */
    public function respond()
    {

    }
}