<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=8,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>用户注册</title>
    <link href="/css/common.css" rel="stylesheet" type="text/css" />
    <link href="/css/live.css" rel="stylesheet" type="text/css" />
    <link href="/css/master.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/libraries/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="/js/common/bootJs.js"></script>
    <script type="text/javascript" src="/js/view/forbidden.js"></script>
</head>

<body oncontextmenu="return false">
<!--注册弹层-->
<div class="windowOpen loginSupernatant" id="registerPop" style="display: block;top:30%;left: 40%">
    <h2>立即注册U美账号，与美女主播一起High翻天！<a href="/" class="lsClose">关闭</a></h2>
    <!--lsMid-->
    <div class="lsMid">
        <!--erroTipInfor-->
        <div class="erroTipInfor" id="erroTip"></div>
        <!--erroTipInfor end-->
        <!--lsLeft-->
        <div class="lsLeft">
            <!--controlGroup-->
            <div class="controlGroup">
                <form id="reg_form" name="reg_form" method="POST" action="" onsubmit="change_submit()">
                    <ul>
                        <li><!--鼠标点击输入框后，小图标变为粉红色-->
                            <div class="cgLabel">
                                <em class="cgIco userNameIco">用户名图标</em>
                                <!--下面注释掉的为删除图标，当输入文字时出现，点击后删掉输入的文字-->
                                <!--em class="keypadIco keypadIcoClose">删除图标</em-->
                                <input name="username" id="user_name" type="text" value="" class="cgInput" placeholder="用户名" autocomplete="off" />
                            </div>
                        </li>
                        <li><!--鼠标点击输入框后，小图标变为粉红色-->
                            <div class="cgLabel">
                                <!--下面注释掉的为删除图标，当输入文字时出现，点击后删掉输入的文字-->
                                <!--em class="keypadIco keypadIcoClose">删除图标</em-->
                                <em class="cgIco passwordIco">密码图标</em>
                                <input name="password" id="pass_word" type="password" value="" class="cgInput" placeholder="密码" autocomplete="off"/>
                            </div>
                        </li>
                        <li><!--鼠标点击输入框后，小图标变为粉红色-->
                            <div class="cgLabel">
                                <em class="cgIco SSLIco">加密图标</em>
                                <!--下面注释掉的为删除图标，当输入文字时出现，点击后删掉输入的文字-->
                                <!--em class="keypadIco keypadIcoClose">删除图标</em
                                <em class="keypadIco keypadIcoClose">删除图标</em>-->
                                <input name="confirm_password" id="confirm_pass" type="password" value="" class="cgInput" placeholder="确认密码" autocomplete="off"/>
                            </div>
                        </li>
                        <li>
                            <div class="cgCodeBox">
                                <span class="cgCode"><input name="captcha" id="captcha" type="text" class="cgInput" maxlength="4" placeholder="验证码" autocomplete="off"/></span>
                                <span class="cgCodeImg"><img src="/captcha" id="regcaptchaimg" alt="验证码"/></span>
                                <span class="cgCodeFress"><a href="javascript:;" onclick="change_regcaptcha()" title="">换一张</a></span>
                            </div>
                        </li>
                        <li>
                            <span><input name="CheckboxGroup1" type="checkbox" id="agreeCont" value="复选框" checked="checked" /> <a href="/help.php?act=protocol" title="" target="_blank">我已阅读并同意《U美网用户服务协议》</a></span>
                        </li>
                    </ul>
            </div>
            <!--controlGroup end-->
            <!--formSubmit-->
            <div class="formSubmit">
                <a href="javascript:;" onclick="return false" title="" class="pubLinks" id="reg_submit">立即注册</a>
            </div>
            <!--formSubmit end-->
        </div>
        <!--lsLeft end-->
        <!--lsRight-->
        <div class="lsRight">
            <div class="lsrMain">我有U美账号 <a href="/login" title="" class="NowLogin">直接登录</a>
            </div>
            <!--  h3>使用合作账号一键登录</h3>
            <div class="pannerStyle">
            	<a href="#" title="用QQ登录" class="QQlogin">QQ账户登录</a>
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

<script type="text/javascript">
    function regsubmit(){
        document.getElementById("reg_form").submit();
    }
</script>
<script src="/js/common/ajax.js"></script>
<script src="/js/common/login_reg.js"></script>
<script type="text/javascript">

    $('#user_name').blur(function()
    {
        if(!$('#user_name').val()){
            $('#erroTip').html("* 最少2个字母!最多只能是8个汉字或12字母!");
            return false;
        }else if($('#user_name').val().length > 16 || $('#user_name').val().length < 2){
            $('#erroTip').html('<img src="images/error_icon.png"> <font color="#FF0000">最少2个字母!最多8个汉字或12字母!</font>');
            return false;
        }else if($('#user_name').val().match(/^[0-9]+.?[0-9]*$|^(\s|　)$/) != null){
            $('#user_name').val("");
            $('#erroTip').html('<img src="images/error_icon.png"> <font color="#FF0000">账号不能是纯数字,且不能有空格</font>');
            return false;
        }else if($('#user_name').val()){
            var username = encodeURIComponent($('#user_name').val());
            Ajax.call('?act=check_username', 'username='+username, usrcallback, 'POST', 'TEXT', true, true);
        }
    });

    $('#pass_word').focus(function(){
        if(!$('#user_name').val()){
            $('#user_name').focus();
            return false;
        }
    });
    $('#pass_word').blur(function()
    {
        if(!$('#pass_word').val()){
            $('#erroTip').html('* 密码至少2个字母!最多只能是16字母!');
            return false;
        }else if($('#pass_word').val().length > 16 || $('#pass_word').val().length < 2){
            $('#erroTip').html('<img src="images/error_icon.png"> <font color="#FF0000">密码至少2个字母!最多只能是16字母!</font>');
            return false;
        }else{
            $('#erroTip').html('<img src="images/right_icon.png"> <font color="#009900">输入正确</font>');
            change_submit();
        }
    });

    $('#confirm_pass').focus (function(){
        if(!$('#pass_word').val()){
            $('#pass_word').focus();
            return false;
        }
    });

    $('#confirm_pass').blur(function()
    {
        if(!$('#confirm_pass').val()){
            $('rpw_notice').innerHTML = '* 重复输入一次上面的密码';
            return false;
        }
        else if($('#confirm_pass').val().length > 16 || $('#confirm_pass').val().length < 2){
            $('#erroTip').html('<img src="images/error_icon.png"> <font color="#FF0000">确认密码至少2个字母!最多只能是16字母!</font>');
            return false;
        }else if($('#confirm_pass').val() != $('#pass_word').val()){
            $('#erroTip').html('<img src="images/error_icon.png"> <font color="#FF0000">两次输入的密码不一致</font>');
            return false;
        }else{
            $('#erroTip').html('<img src="images/right_icon.png"> <font color="#009900">输入正确</font>');
            change_submit();
        }
    });

    function change_submit()
    {
        if($('#user_name').val() && $('#pass_word').val() && $('#confirm_pass').val()){
            $('#reg_submit').click(function(){
                if($('#agreeCont').prop('checked')){
                    regsubmit();
                }else{
                    alert("请同意协议");
                }
            });

        }else{return;}
    }

    function usrcallback(res)
    {
        if(res== '-1'){
            $('#erroTip').html('<img src="images/error_icon.png"> <font color="#FF0000">该账号包含了系统不允许的字符</font>');
            return false;
        }else if(res=='1'){
            $('#erroTip').html('<img src="images/error_icon.png"> <font color="#FF0000">该账号已经被别人使用了</font>');
            return false;
        }else if(res== '0'){
            $('#erroTip').html('<img src="images/right_icon.png"> <font color="#009900">恭喜，该账号可以注册</font>');
            change_submit();
        }
    }
</script>
</body>
</html>