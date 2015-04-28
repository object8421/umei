<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=8,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta property="qc:admins" content="35501606000165551563757" />
    <meta property="wb:webmaster" content="baf4120dff58920e" />

    <title>用户登录</title>

    <style type="text/css">



    </style>

    <!--[if lte IE 6]>

    <script type="text/javascript" src="/js/libraries/DD_belatedPNG.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('#login');
    </script>

    <![endif]-->
    <link href="/css/common.css" rel="stylesheet" type="text/css" />
    <link href="/css/live.css" rel="stylesheet" type="text/css" />
    <link href="/css/master.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/libraries/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="/js/common/general.js"></script>
    <script type="text/javascript" src="/js/view/login.js"></script>
    <script type="text/javascript">
        var childWindow;
        function toQzoneLogin()
        {
            childWindow = window.open("/qlogin/example/oauth/index.php","TencentLogin","width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
        }

        function closeChildWindow()
        {
            childWindow.close();
        }
    </script>
    
</head>

<body oncontextmenu="return false">

<!--登录弹层-->
<div class="windowOpen loginSupernatant" id="loginPop" style="display: block;top:30%;left: 40%">
    <h2>登录U美直播社区，即刻与美女主播High翻天！<a href="/" class="lsClose">关闭</a></h2>
    <!--lsMid-->
    <div class="lsMid">
        <!--erroTipInfor-->
        <div class="erroTipInfor" id="erroTip"><?php echo $error ?></div>
        <!--erroTipInfor end-->
        <!--lsLeft-->
        <div class="lsLeft">
            <!--controlGroup-->
            <div class="controlGroup">
                <form id="login_form" name="login_form" method="post" action="">
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
                                <em class="cgIco passwordIco">密码图标</em>
                                <!--下面注释掉的为删除图标，当输入文字时出现，点击后删掉输入的文字-->
                                <!--em class="keypadIco keypadIcoClose">删除图标</em-->
                                <input name="password" type="password" id="pass_word" class="cgInput" placeholder="密码" autocomplete="off"/>
                            </div>
                        </li>
                        <!--验证码-->
                        <li id="yzm" <?php if (!isset($_COOKIE['login_fail_count']) || $_COOKIE['login_fail_count'] <= 3): ?>style="display: none;" <?php endif ?>>
                        <div class="cgCodeBox">
                            <span class="cgCode"><input id="captcha" name="captcha" type="text" class="cgInput" maxlength="4" placeholder="验证码" autocomplete="off"/></span>
                            <span class="cgCodeImg"><img src="/captcha" id="captchaimg" alt="验证码"/></span>
                            <span class="cgCodeFress"><a href="javascript:;" onClick="change_regcaptcha()" title="">换一张</a></span>
                        </div>
                        </li
                        ><!--验证码 end-->
                        <li>
                            <div class="remeberInfor">
                                <!-- span><input name="CheckboxGroup1" type="checkbox" id="CheckboxGroup1_0" value="复选框" checked="checked" /> 记住我</span> -->
                                <div class="cgLinks">
                                    <!--  a href="#" title="">忘记用户名</a>|--><a href="/service/getPassword" title="" target="_blank">忘记密码</a>
                                </div>
                            </div>
                            <!--formSubmit-->
                            <div class="formSubmit1">
                                <a href="javascript:;" onClick="loginsubmit()" title="" class="pubLinks">立即登录</a>
                            </div>
                            <!--formSubmit end-->
                        </li>
                    </ul>
                </form>
            </div>
            <!--controlGroup end-->
        </div>
        <!--lsLeft end-->
        <!--lsRight-->
        <div class="lsRight">
            <div class="lsrMain">还没有U美账号 <a href="/register" title="" class="NowLogin">立即注册</a>
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
<script src="/js/common/login_reg.js"></script>
<script type="text/javascript">
    function loginsubmit(){
        if(login()){
            document.getElementById("login_form").submit();
        }
    }

    /* 注册判断 */

    function login()

    {

        if ($('#user_name').val().length == 0){
            $('#user_name').css("border","#FF0000 1px solid");
            $('#erroTip').html("用户名必须填写");
            $('#user_name').focus();

            return false;

        }else if ($('#pass_word').val().length == 0){

            $('#pass_word').css("border","#FF0000 1px solid");
            $('#erroTip').html("密码必须填写");
            $('#pass_word').focus();

            return false;

        }else{
            return true;
        }

    }



    function guest(){

        window.location.href='login.php?act=guest';

    }

    document.getCookie = function(sName){

        var aCookie = document.cookie.split("; ");

        for (var i=0; i < aCookie.length; i++){

            var aCrumb = aCookie[i].split("=");

            if (sName == aCrumb[0])

                return decodeURIComponent(aCrumb[1]);

        }

        return null;

    }

</script>
</body>

</html>