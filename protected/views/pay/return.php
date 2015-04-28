<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>充值结果</title>
    <link href="/css/common.css" rel="stylesheet" type="text/css" />
    <link href="/css/live.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="js/DD_belatedPNG.js"></script>
    <script language="javascript" type="text/javascript">
        DD_belatedPNG.fix(".png24,div,span,li,em,i,b,p,li,ul,ol,a,img");
        DD_belatedPNG.fix(".pngFix,.pngFix:hover");
    </script>
    <![endif]-->
</head>

<body>
<!--充值完成提示--><!--这个提示信息是充值完成的提示信息，不用开启隐藏显示功能，点确定和个人中心，都链到个人中心即可-->
<div class="okPop chargePop posZ" style="position:absolute;z-index:999;display:yes;left:50%;margin-left:-190px;">
    <!--popPubTitle-->
    <div class="popPubTitle">
        <h2><span>U美直播社区提示</span></h2>
    </div>
    <!--popPubTitle end-->
    <!--popPubMid-->
    <div class="popPubMid">
        <!--chargeMoney-->
        <div class="chargeMoney">
            <ul>
                <li>
                    <p style="text-align:center; font-size:18px; padding-bottom:10px;">
                        <?php if ($result == 0): ?>
                        充值成功！请到您的<a href="/account/info" target="_blank" title="" style="text-decoration: underline;">个人中心</a>查看！
                        <?php else:?>
                        U币充值出现了异常！不要关闭页面，请立刻记下U币充值流水号<span>[<?php echo $trade_no ?>]</span>,及时<a href="/service/index">联系网站客服人员</a>解决问题！<br />
                        <?php endif?>
                    </p>
                </li>
                <?php if ($result == 0): ?>
                    <li>
                        <strong>订单编号：</strong>
                        <p><span><?php echo $trade_no ?></span></p>
                    </li>
                    <li>
                        <strong>所属账号：</strong>
                        <p><?php echo $name ?></p>
                    </li>
                    <li>
                        <strong>支付方式：</strong>
                        <p><?php echo $pay_type ?></p>
                    </li>
                    <li>
                        <strong>付款金额：</strong>
                        <p><?php echo $amount ?> 元</p>
                    </li>
                    <li>
                        <strong>结算时间：</strong>
                        <p><?php echo $time ?></p>
                    </li>
                <?php endif?>
            </ul>
        </div>
        <!--chargeMoney end-->
        <div class="chargeqdBtn"><a href="/account/info" title="" class="pinkBtn"><i>确定</i></a></div>
    </div>
    <!--popPubMid end-->
    <div class="popPubBot"><span></span></div>
</div>
</body>

</html>