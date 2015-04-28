<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 15/3/3
 * Time: 上午10:01
 */
if ($user_info = User::info()) {
    $login = 1;
} else {
    $login = 0;
}
?>
<script>

    var islogined = '<?php echo $login ?>';
</script>
<script src="/js/common/login_reg.js"></script>
<div style="height:10px;font-size:15px;display: none;">
    <span id="tips01">提示01</span>
    <span id="tips02">提示02</span>
    <span id="tips03">提示03</span>
    <span id="tips04">提示04</span>
    <span id="tips05">提示05</span>
    <span id="tips06">提示06</span>
    <span id="tips07">提示07</span>
    <span id="tips08">提示08</span>
    <span id="tips09">提示09</span>
    <span id="registerokBox">注册成功</span>
</div>
<!--演示链接结束-->
<!--注册弹层-->
<div class="windowOpen loginSupernatant" id="registerPop">
    <h2>立即注册U美账号，与美女主播一起High翻天！<a href="#" class="lsClose">关闭</a></h2>
    <!--lsMid-->
    <div class="lsMid">
        <!--erroTipInfor-->
        <div class="erroTipInfor"></div>
        <!--erroTipInfor end-->
        <!--lsLeft-->
        <div class="lsLeft">
            <!--controlGroup-->
            <div class="controlGroup">
                <ul>
                    <li><!--鼠标点击输入框后，小图标变为粉红色-->
                        <div class="cgLabel">
                            <em class="cgIco userNameIco">用户名图标</em>
                            <!--下面注释掉的为删除图标，当输入文字时出现，点击后删掉输入的文字-->
                            <!--em class="keypadIco keypadIcoClose">删除图标</em-->
                            <input id="regusername" type="text" value="" class="cgInput" placeholder="4~16个字符，不能全部为数字" maxlength="16" autocomplete="off"/>
                        </div>
                    </li>
                    <li><!--鼠标点击输入框后，小图标变为粉红色-->
                        <div class="cgLabel">
                            <!--下面注释掉的为删除图标，当输入文字时出现，点击后删掉输入的文字-->
                            <!--em class="keypadIco keypadIcoClose">删除图标</em-->
                            <em class="cgIco passwordIco">密码图标</em>
                            <input id="regpassword" type="password" value="" class="cgInput" placeholder="6~20个字符，区分大小写" autocomplete="off" maxlength="20"/>
                        </div>
                    </li>
                    <li><!--鼠标点击输入框后，小图标变为粉红色-->
                        <div class="cgLabel">
                            <em class="cgIco SSLIco">加密图标</em>
                            <!--下面注释掉的为删除图标，当输入文字时出现，点击后删掉输入的文字-->
                            <!--em class="keypadIco keypadIcoClose">删除图标</em>
                            <em class="keypadIco keypadIcoClose">删除图标</em-->
                            <input id="regconfirm_password" type="password" value="" class="cgInput" placeholder="确认密码" maxlength="20" autocomplete="off"/>
                        </div>
                    </li>
                    <li>
                        <div class="cgCodeBox">
                            <span class="cgCode"><input id="regcaptcha" type="text" class="cgInput" maxlength="4"
                                                        placeholder="验证码" autocomplete="off"/></span>
                            <span class="cgCodeImg"><img src="/captcha" id="regcaptchaimg" alt="验证码"/></span>
                            <span class="cgCodeFress"><a href="javascript:;" onclick="change_regcaptcha()"
                                                         title="">换一张</a></span>
                        </div>
                    </li>
                    <li>
                        <span><input name="CheckboxGroup1" type="checkbox" id="agreeCont" value="复选框"
                                     checked="checked"/> <a href="/service/index/type/2" title="" target="_blank">我已阅读并同意《U美网用户服务协议》</a></span>
                    </li>
                </ul>
            </div>
            <!--controlGroup end-->
            <!--formSubmit-->
            <div class="formSubmit">
                <a href="javascript:;" onclick="reg()" title="" class="pubLinks">立即注册</a>
            </div>
            <!--formSubmit end-->
        </div>
        <!--lsLeft end-->
        <!--lsRight-->
        <div class="lsRight">
            <div class="lsrMain">我有U美账号 <a href="javascript:;" onclick="tologin()" title="" class="NowLogin">直接登录</a>
            </div>
            <!--h3>使用合作账号一键登录</h3>
            <div class="pannerStyle">
            	<a href="#" onclick='toQzoneLogin()' title="用QQ登录" class="QQlogin">QQ账户登录</a>
                <a href="#" title="用新浪微博帐号登录" class="weibologin">微博账户登录</a>
            </div>
            <div class="otherStyle">
            	其它
            	<a href="#" title="用腾讯微博帐号登录" class="osQQ">腾讯微博</a>
                <a href="#" title="用人人网帐号登录" class="osRenren">人人</a>
                <a href="#" title="用百度帐号登录" class="osBaidu">百度</a>
            </div>-->
        </div>
        <!--lsRight end-->
    </div>
    <!--lsMid end-->
</div>
<!--注册弹层 end-->


<!--注册成功弹层-->
<div class="windowOpen loginSupernatant" id="registerokPop">
    <h2>登录U美直播社区，即刻与美女主播High翻天！<a href="#" class="lsClose">关闭</a></h2>
    <!--lsMid-->
    <div class="lsMid1">
        <!--lsLeft-->
        <div class="lsLeft1">
            <div class="ok01">
                √ 注册成功
            </div>
            <div class="formSubmit2">您的U美账号：<span class="ok02" id="okusername"></span>。
                ID号：<span class="ok02" id="okuid"></span>　
                <span><a href="/account/setMail" title="" class="mbyx01">设置密保邮箱</a></span></div>
            <div class="formSubmit1"><a href="javascript:;" title="" class="pubLinks1" onclick="location.reload()">直接进入网站</a></div>
        </div>
        <!--lsLeft end-->
    </div>
    <!--lsMid end-->
</div>
<!--注册成功弹层 end-->


<!--登录弹层-->
<div class="windowOpen loginSupernatant" id="loginPop">
    <h2>登录U美直播社区，即刻与美女主播High翻天！<a href="#" class="lsClose">关闭</a></h2>
    <!--lsMid-->
    <div class="lsMid">
        <!--erroTipInfor-->
        <div class="erroTipInfor"></div>
        <!--erroTipInfor end-->
        <!--lsLeft-->
        <div class="lsLeft">
            <!--controlGroup-->
            <div class="controlGroup">
                <ul>
                    <li><!--鼠标点击输入框后，小图标变为粉红色-->
                        <div class="cgLabel">
                            <em class="cgIco userNameIco">用户名图标</em>
                            <!--下面注释掉的为删除图标，当输入文字时出现，点击后删掉输入的文字-->
                            <!--em class="keypadIco keypadIcoClose">删除图标</em-->
                            <input id="username" type="text" value="" class="cgInput" placeholder="用户名"
                                   autocomplete="off"/>
                        </div>
                    </li>
                    <li><!--鼠标点击输入框后，小图标变为粉红色-->
                        <div class="cgLabel">
                            <em class="cgIco passwordIco">密码图标</em>
                            <!--下面注释掉的为删除图标，当输入文字时出现，点击后删掉输入的文字-->
                            <!--em class="keypadIco keypadIcoClose">删除图标</em-->
                            <input id="password" type="password" value="" class="cgInput" placeholder="密码"
                                   autocomplete="off"/>
                        </div>
                    </li>
                    <!--验证码-->
                    <li id="yzm" <?php if (!isset($_COOKIE['login_fail_count']) || $_COOKIE['login_fail_count'] <= 3): ?>style="display: none;" <?php endif ?>>
                    <div class="cgCodeBox">
                        <span class="cgCode"><input id="captcha" type="text" class="cgInput" maxlength="4" placeholder="验证码" autocomplete="off"/></span>
                        <span class="cgCodeImg"><img src="/captcha" id="captchaimg" alt="验证码"/></span>
                        <span class="cgCodeFress"><a href="javascript:;" onclick="change_regcaptcha()"
                                                     title="">换一张</a></span>
                    </div>
                    </li>
                    <!--验证码 end-->
                    <li>
                        <div class="remeberInfor">
                            <!--span><input name="CheckboxGroup1" type="checkbox" id="CheckboxGroup1_0" value="复选框" checked="checked" /> 记住我</span-->
                            <div class="cgLinks">
                                <!--  ><a href="#" title="">忘记用户名</a>|--><a href="/service/getPassword" title="" target="_blank">忘记密码</a>
                            </div>
                        </div>
                        <!--formSubmit-->
                        <div class="formSubmit1">
                            <a href="javascript:;" onclick="login()" title="" class="pubLinks">立即登录</a>
                        </div>
                        <!--formSubmit end-->
                    </li>
                </ul>
            </div>
            <!--controlGroup end-->
        </div>
        <!--lsLeft end-->
        <!--lsRight-->
        <div class="lsRight">
            <div class="lsrMain">还没有U美账号 <a href="javascript:;" onclick="toreg();" title="" class="NowLogin">立即注册</a>
            </div>
            <!--h3>使用合作账号一键登录</h3>
            <div class="pannerStyle">
            	<a href="javascript:;" onclick='toQzoneLogin()' title="用QQ登录" class="QQlogin">QQ账户登录</a>
                <a href="#" title="用新浪微博帐号登录" class="weibologin">微博账户登录</a>
            </div>
            <div class="otherStyle">
            	其它
            	<a href="#" title="用腾讯微博帐号登录" class="osQQ">腾讯微博</a>
                <a href="#" title="用人人网帐号登录" class="osRenren">人人</a>
                <a href="#" title="用百度帐号登录" class="osBaidu">百度</a>
            </div>-->
        </div>
        <!--lsRight end-->
    </div>
    <!--lsMid end-->
</div>
<!--登录弹层 end-->


<!--提示01-->
<div class="windowOpen okPop uArea posZ" id="tips01Pop">
    <!--popPubTitle-->
    <div class="popPubTitle">
        <h2><span>U美直播社区提示</span><a href="#" class="popPubClose">×</a></h2>
    </div>
    <!--popPubTitle end-->
    <!--popPubMid-->
    <div class="popPubMid">
        <!--uAreaCont-->
        <div class="uAreaCont uAreaContNew">
            U币账户余额不足，请<a href="#" title="">充值</a>
        </div>
        <!--uAreaCont end-->
        <div class="chargeMoneyBtn"><a href="#" title="" class="pinkBtn"><i>充值</i></a></div>
    </div>
    <!--popPubMid end-->
    <div class="popPubBot"><span></span></div>
</div>
<!--提示01 end-->


<!--提示02-->
<div class="windowOpen okPop uArea posZ" id="tips02Pop">
    <!--popPubTitle-->
    <div class="popPubTitle">
        <h2><span>U美直播社区提示</span><a href="#" class="popPubClose">×</a></h2>
    </div>
    <!--popPubTitle end-->
    <!--popPubMid-->
    <div class="popPubMid">
        <!--uAreaCont-->
        <div class="uAreaCont uAreaContNew" id="returnmsg">
            购买的道具数量必须大于0
            靓号6688666购买成功！
            vip(30天)购买成功！
            加迪威龙购买成功！
            请输入要充值的金额。
            提交成功，请等待客服人员审核。
            单次兑换必须大于/等于10U豆。
            您输入的验证码不正确。
            兑换成功！
            购买成功！
            <!--各类提示使用这个样式即可-->
        </div>
        <!--uAreaCont end-->
        <div class="chargeMoneyBtn"><a href="javascript:void(0);" title="" class="pinkBtn"><i>确定</i></a>
        </div>
    </div>
    <!--popPubMid end-->
    <div class="popPubBot"><span></span></div>
</div>
<!--提示02 end-->


<!--提示03-->
<div class="windowOpen okPop uArea posZ" id="tips03Pop">
    <!--popPubTitle-->
    <div class="popPubTitle">
        <h2><span>U美直播社区提示</span><a href="#" class="popPubClose">×</a></h2>
    </div>
    <!--popPubTitle end-->
    <!--popPubMid-->
    <div class="popPubMid">
        <!--uAreaCont-->
        <div class="uAreaCont uAreaContNew">
            <ul class="uPubUl">
                <li>
                    <div class="uNav">您购买了：</div>
                    <div class="uCont">vip</div>
                </li>
                <li>
                    <div class="uNav">请输入数量：</div>
                    <div class="uCont"><span class="spanInput"><input type="text" name=""></span></div>
                </li>
                <li>
                    <div class="uNav">此次总价为：</div>
                    <div class="uCont">10 U币</div>
                </li>
            </ul>
        </div>
        <!--uAreaCont end-->
        <div class="chargeMoneyBtn"><a href="#" title="" class="pinkBtn"><i>购买</i></a></div>
    </div>
    <!--popPubMid end-->
    <div class="popPubBot"><span></span></div>
</div>
<!--提示03 end-->

<!--提示03-->
<div class="windowOpen okPop uArea posZ" id="tips09Pop">
    <!--popPubTitle-->
    <div class="popPubTitle">
        <h2><span>U美直播社区提示</span><a href="#" class="popPubClose">×</a></h2>
    </div>
    <!--popPubTitle end-->
    <!--popPubMid-->
    <div class="popPubMid">
        <!--uAreaCont-->
        <div class="uAreaCont uAreaContNew">
            <ul class="uPubUl">
                <li>
                    <div class="uNav">赠送给：</div>
                    <div class="uCont">
                        <span class="spanInput">
                            <input type="text" id="togid" placeholder="请输入接收者的号码">
                            <input type="text" id="nicegid">
                        </span>
                    </div>
                </li>
            </ul>
        </div>
        <!--uAreaCont end-->
        <div class="chargeMoneyBtn"><a href="javascript:;" title="" onclick="do_give_gid()"
                                       class="pinkBtn"><i>赠送</i></a></div>
    </div>
    <!--popPubMid end-->
    <div class="popPubBot"><span></span></div>
</div>
<!--提示03 end-->


<!--提示04-->
<div class="windowOpen okPop uArea posZ" id="tips04Pop">
    <!--popPubTitle-->
    <div class="popPubTitle">
        <h2><span>U美直播社区提示</span><a href="#" class="popPubClose">×</a></h2>
    </div>
    <!--popPubTitle end-->
    <!--popPubMid-->
    <div class="popPubMid">
        <!--chargeMoney-->
        <div class="chargeMoney">
            <ul>
                <li>
                    <strong>充值账号：</strong>

                    <p>美色当前（32020366）</p>
                </li>
                <li>
                    <strong>充值金额：</strong>

                    <p>100元</p>
                </li>
                <li>
                    <strong>支付方式：</strong>

                    <p>支付宝</p>
                </li>
                <li>
                    <strong>订单编号：</strong>

                    <p><span>14120898384994</span></p>
                </li>
            </ul>
        </div>
        <!--chargeMoney end-->
        <div class="chargeMoneyBtn"><a href="#" title="" class="pinkBtn"><i>确认充值</i></a></div>
        <div class="red">提示：如果当前充值账号和您的账号不一致，请勿进行付款操作。</div>
    </div>
    <!--popPubMid end-->
    <div class="popPubBot"><span></span></div>
</div>
<!--提示04 end-->


<!--提示05-->
<div class="windowOpen berryTip posZ" id="tips05Pop">
    <!--popPubTitle-->
    <div class="popPubTitle">
        <h2><span>提示信息</span><a href="#" class="popPubClose">×</a></h2>
    </div>
    <!--popPubTitle end-->
    <!--popPubMid-->
    <div class="popPubMid">
        <!--berryValue-->
        <div class="berryValue">
            <h2>您当前的草莓数：<b>0</b></h2>

            <p>一个草莓<b>200</b>U币</p>

            <p>
                <span>购买</span>
                <span class="spanInput"><input type="text" name=""></span>
                <span>个</span>
            </p>

            <p class="tc"><a href="#" title="" class="redBtn"><i>马上购买</i></a></p>
        </div>
        <!--berryValue end-->
        <!--berryMoney-->
        <div class="berryValue berryMoney">
            <h2>您的账户余额</h2>

            <p><b>10000</b>币</p>

            <p class="tc"><a href="#" title="" class="redBtn"><i>充值</i></a></p>
        </div>
        <!--berryMoney end-->
    </div>
    <!--popPubMid end-->
    <!--popPubBot-->
    <div class="popPubBot"><span></span></div>
    <!--popPubBot end-->
</div>
<!--提示05 end-->


<!--提示06-->
<div class="windowOpen carPos posZ" id="tips06Pop">
    <!--popPubTitle-->
    <div class="popPubTitle">
        <h2><span>我的座驾</span><a href="#" class="popPubClose">×</a></h2>
    </div>
    <!--popPubTitle end-->
    <!--popPubMid-->
    <div class="popPubMid">
        <!--carPosList-->
        <div class="carPosList">
            <ul>
                <li>
                    <span class="carPosPic"><i></i><img src="/images/carShopPic01.png"/></span>
                    <dl>
                        <dd>
                            <strong>座驾名称：</strong>

                            <p>布加迪威龙</p>
                        </dd>
                        <dd>
                            <strong>获得时间：</strong>

                            <p>2014.09.12</p>
                        </dd>
                        <dd>
                            <strong>有 效 期：</strong>

                            <p>30天</p>
                        </dd>
                        <dd>
                            <strong>当前状态：</strong>

                            <p><i class="zhiIco z2"></i>使用中</p>
                        </dd>
                    </dl>
                    <div class="tr"><a class="pinkBtn" title="" href="#"><i>停用</i></a></div>
                </li>
                <li>
                    <span class="carPosPic"><i></i><img src="/images/carShopPic02.png"/></span>
                    <dl>
                        <dd>
                            <strong>座驾名称：</strong>

                            <p>布加迪威龙</p>
                        </dd>
                        <dd>
                            <strong>获得时间：</strong>

                            <p>2014.09.12</p>
                        </dd>
                        <dd>
                            <strong>有 效 期：</strong>

                            <p>30天</p>
                        </dd>
                        <dd>
                            <strong>当前状态：</strong>

                            <p><i class="zhiIco z2"></i>停用中</p>
                        </dd>
                    </dl>
                    <div class="tr"><a class="pinkBtn" title="" href="#"><i>启用</i></a></div>
                </li>
            </ul>
        </div>
        <!--carPosList end-->
        <!--分页-->
        <div class="pageList pageListNew">
            <a href="#" title="">1</a>
            <a href="#" title="" class="current">2</a>
            <a href="#" title="">3</a>
            <a href="#" title="">4</a>
        </div>
        <!--分页 end-->
    </div>
    <!--popPubMid end-->
    <!--popPubBot-->
    <div class="popPubBot"><span></span></div>
    <!--popPubBot end-->
</div>
<!--提示06 end-->


<!--提示07--><!--这个提示层目前没有使用，前段时间设计做的时候还有领座驾的活动呢-->
<div class="windowOpen carPos carRide posZ" id="tips07Pop">
    <!--popPubTitle-->
    <div class="popPubTitle">
        <h2><span>座驾信息</span><a href="#" class="popPubClose">×</a></h2>
    </div>
    <!--popPubTitle end-->
    <!--popPubMid-->
    <div class="popPubMid">
        <!--carPosTitle-->
        <div class="carPosTitle">
            <h4>小猪宝贝房间<b>可领取座驾</b></h4>

            <p class="red">只可领取一款座驾</p>
        </div>
        <!--carPosTitle end-->
        <!--carPosList-->
        <div class="carPosList">
            <ul>
                <li>
                    <span class="carPosPic"><i></i><img src="/images/carShopPic05.png"/></span>
                    <dl>
                        <dd>
                            <strong>座驾名称：</strong>

                            <p>布加迪威龙</p>
                        </dd>
                        <dd>
                            <strong>所属房间：</strong>

                            <p><i class="zhiIco z2"></i>小猪宝贝（5209999）</p>
                        </dd>
                        <dd>
                            <strong>获得时间：</strong>

                            <p>2014.09.12</p>
                        </dd>
                        <dd>
                            <strong>有 效 期：</strong>

                            <p>30天</p>
                        </dd>
                    </dl>
                    <div class="tr"><a class="pinkBtn" title="" href="#"><i>领取</i></a></div>
                </li>
                <li>
                    <span class="carPosPic"><i></i><img src="/images/carShopPic06.png"/></span>
                    <dl>
                        <dd>
                            <strong>座驾名称：</strong>

                            <p>布加迪威龙</p>
                        </dd>
                        <dd>
                            <strong>所属房间：</strong>

                            <p><i class="zhiIco z2"></i>小猪宝贝（5209999）</p>
                        </dd>
                        <dd>
                            <strong>获得时间：</strong>

                            <p>2014.09.12</p>
                        </dd>
                        <dd>
                            <strong>有 效 期：</strong>

                            <p>30天</p>
                        </dd>
                    </dl>
                    <div class="tr"><a class="pinkBtn" title="" href="#"><i>领取</i></a></div>
                </li>
                <li>
                    <span class="carPosPic"><i></i><img src="/images/carShopPic04.png"/></span>
                    <dl>
                        <dd>
                            <strong>座驾名称：</strong>

                            <p>布加迪威龙</p>
                        </dd>
                        <dd>
                            <strong>所属房间：</strong>

                            <p><i class="zhiIco z2"></i>小猪宝贝（5209999）</p>
                        </dd>
                        <dd>
                            <strong>获得时间：</strong>

                            <p>2014.09.12</p>
                        </dd>
                        <dd>
                            <strong>有 效 期：</strong>

                            <p>30天</p>
                        </dd>
                    </dl>
                    <div class="tr"><a class="pinkBtn" title="" href="#"><i>领取</i></a></div>
                </li>
            </ul>
        </div>
        <!--carPosList end-->
        <!--分页-->
        <div class="pageList pageListNew">
            <a href="#" title="">1</a>
            <a href="#" title="" class="current">2</a>
            <a href="#" title="">3</a>
            <a href="#" title="">4</a>
        </div>
        <!--分页 end-->
    </div>
    <!--popPubMid end-->
    <!--popPubBot-->
    <div class="popPubBot"><span></span></div>
    <!--popPubBot end-->
</div>
<!--提示07 end-->

<!--充值完成提示--><!--这个提示信息是充值完成的提示信息，不用开启隐藏显示功能，点确定和个人中心，都链到个人中心即可-->
<div class="okPop chargePop posZ"
     style="position:absolute;z-index:999;display:yes;left:50%;margin-left:-190px;display:none;">
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
                    <p style="text-align:center; font-size:18px; padding-bottom:10px;">充值成功！请到您的<a href=""
                                                                                                   target="_blank"
                                                                                                   title=""
                                                                                                   style="text-decoration: underline;">个人中心</a>查看！
                    </p>
                </li>
                <li style="text-align:center">
                    <strong>MD5校验码：</strong>

                    <p>897ADF7AAJH23JJKKJ32UJ2IURIKJHJK234234JKJKKJ</p>
                </li>
                <li>
                    <strong>订单编号：</strong>

                    <p><span>14120898384994</span></p>
                </li>
                <li>
                    <strong>支付卡种：</strong>

                    <p>招商银行</p>
                </li>
                <li>
                    <strong>支付结果：</strong>

                    <p>支付成功</p>
                </li>
                <li>
                    <strong>支付金额：</strong>

                    <p>1.00</p>
                </li>
                <li>
                    <strong>支付币种：</strong>

                    <p>CNY</p>
                </li>
            </ul>
        </div>
        <!--chargeMoney end-->
        <div class="chargeqdBtn"><a href="#" title="" class="pinkBtn"><i>确定</i></a></div>
    </div>
    <!--popPubMid end-->
    <div class="popPubBot"><span></span></div>
</div>
<!--充值完成提示 end-->
<!--遮罩-->
<div class="masterEle" style="display:none;">遮罩</div>
<!--遮罩 end-->
<!--用户列表菜单 end-->