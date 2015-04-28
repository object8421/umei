<!--<script type="text/javascript" src="/js/libraries/PIE_IE678.js"></script>-->
<?php
$user_info = User::info();
?>
<?php $this->renderPartial('/account/head') ?>
<!--U豆兑换-->
<div class="uDou">
    <div class="pubform udouList">
        <form action="pay.php?act=act_exchange" method="post">
            <ul>
                <li>
                    <em class="pfTitle">您当前的U豆数为：<?php if (isset($user_info['bean']))echo $user_info['bean'];else echo '0' ?></em>
                </li>

                <li>
                    <em class="pfTitle">第一步：请输入要兑换的Ｕ豆：</em>
                    <em><span class="spanInput"><input name="bean" type="text" id="exbean"/></span></em>
                    <em class="orange">提示：Ｕ豆兑换Ｕ币的比例1:1，单次兑换必须大于10Ｕ豆</em>
                </li>
                <li>
                    <em class="pfTitle">第二步：请输入右边的验证码：</em>
                    <em><span class="spanInput"><input name="captcha" type="text" id="captcha"/></span></em>
                    <em><img src="/captcha" id="regcaptchaimg"/></em>
                    <em class="orange cursor"><a href="javascript;" id="change_captcha">看不清，换一张</a></em>
                </li>
            </ul>
        </form>
    </div>
    <div class="subIco">
        <a href="javascript:;" title="" class="pubLink" id="card_submit" onclick="act_exchange()"><i>确认兑换</i></a>
    </div>
</div>
<!--U豆兑换 end-->
<script type="text/javascript">
    jQuery("#change_captcha").click(function(){
        change_regcaptcha()
        return false
    })
    function act_exchange(){
        jQuery.ajax({
            type: "post",
            data: {"bean":jQuery("#exbean").val(),"captcha":jQuery("#captcha").val()},
            url: "/account/exchange",
            success: function (data,status) {
                var ms = JSON.parse(data);
                if(ms.error==0){
                    jQuery("#okmsg").html(ms.message);
                    jQuery("#okPop").show();
                }else{
                    jQuery("#okmsg").html(ms.message);
                    jQuery("#okPop").show();
                }
            }
        });
    }
</script>
<div class="okPop uArea posZ" style="left:30%;top:35%;display: none;" id="okPop">
    <!--popPubTitle-->
    <div class="popPubTitle">
        <h2><span>U美直播社区提示</span><a href="javascript;" title="" onclick="window.location.reload();" class="popPubClose">×</a></h2>
    </div>
    <!--popPubTitle end-->
    <!--popPubMid-->
    <div class="popPubMid">
        <!--uAreaCont-->
        <div class="uAreaCont uAreaContNew" id="okmsg">
        </div>
        <!--uAreaCont end-->
        <div class="chargeMoneyBtn"><a href="javascript:;" title="" onclick="window.location.reload();" title="" class="pinkBtn"><i>确定</i></a></div>
    </div>
    <!--popPubMid end-->
    <div class="popPubBot"><span></span></div>
</div>
<?php $this->renderPartial('/account/foot')?>
