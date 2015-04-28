<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php if (isset($this->title) && $this->title) echo $this->title; else echo "U美网"; ?> | U美网直播社区 - 美女主播 - 美女秀场
        - 视频聊天 - 视频交友 </title>
    <meta name="keywords" content="美女,主播,秀场,视频,直播间,交友,美女主播,美女秀场,美女视频,美女聊天,视频直播,视频聊天,视频交友"/>
    <meta name="description" content="U美直播社区是U美网旗下的大型真人视频互动直播社区,拥有众多美女主播,支持多人同时在线视频聊天,K歌跳舞,才艺表演.赶快加入,免费与美女主播互动聊天."/>
    <meta property="qc:admins" content="35501602246555156375"/>
    <link href="/css/common.css" rel="stylesheet" type="text/css"/>
    <link href="/css/live.css" rel="stylesheet" type="text/css"/>
    <link href="/css/master.css" rel="stylesheet" type="text/css"/>
    <link href="/css/showLoading.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<!--wrapOuter-->
<div class="wrapOuter">
    <!--wrapIn-->
    <div class="wrapIn">
        <!--头部-->
        <div class="headerOuter">
            <!--headerIn-->
            <div class="headerIn">
                <div class="logo"><a href="#" title="">U美</a></div>
                <!--导航-->
                <div class="nav">
                    <?php $this->renderPartial('/layouts/nav') ?>
                </div>
                <!--导航 end-->
                <!--登录注册-->
                <div class="loginRegister">
                    <?php if (!$info = User::info()): ?>
                        <!--登录前-->
                        <div class="lrBefore">
                            <!--
                            <span><img src="http://qzonestyle.gtimg.cn/qzone/vas/opensns/res/img/Connect_logo_1.png" border="0" /><a href="#">QQ登录</a>　</span>
                            -->
                            <span class="loginLink"><a href="javascript:;" id="loginBox" title="">登录</a></span>
                            <span class="registerLink"><a href="javascript:;" id="registerBox" title="">注册</a></span>
                            <span class="registerLink"><a href="/service/index/type/3" title=""
                                                          target="_blank">反馈</a></span>
                        </div>
                        <!--登录前 end-->
                    <?php else: ?>
                        <!--登录后-->
                        <div class="lrAfter">
                            <!--用户名-->
                            <span class="userName"><a href="/account/info" title=""
                                                      target="_blank"><?php if($info['nickname'])echo $info['nickname'];else echo $info['username'] ?></a></span>
                            <!--用户名 end-->
                            <!--U币数量-->
                            <span class="goldCoin"><i class="ubIco"></i><a href="/pay/index" title=""
                                                                           target="_blank"><?php if (isset($info['coin'])) echo $info['coin']; else echo 0; ?></a></span>
                            <!--U币数量 end-->
                            <span class="reCharge"><a href="/pay/index" title="" target="_blank">充值</a></span>
                            <span class="exitIco"><a href="/user/logout" title="" id="out">退出</a></span>
                            <span class="registerLink"><a href="/service/index/type/3" title=""
                                                          target="_blank">反馈</a></span>
                        </div>
                        <!--登录后 end-->
                    <?php endif ?>
                </div>
                <!--登录注册 end-->
                <!--添加到桌面-->
                <div class="AddDesktop"><a href="/desktop" title="">添加到桌面</a></div>
                <!--添加到桌面 end-->
            </div>
            <!--headerIn end-->
            <div class="outZone"><span>分离区</span></div>
        </div>
        <!--头部 end-->
        <script type="text/javascript" src="/js/libraries/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="/js/common/general.js"></script>
        <script type="text/javascript" src="/js/libraries/jquery.showLoading.js"></script>
        <script src="/js/common/xid.js"></script>
        <!--[if IE 6]>
        <script type="text/javascript" src="js/DD_belatedPNG.js"></script>
        <script language="javascript" type="text/javascript">
            DD_belatedPNG.fix(".png24,div,span,li,em,i,b,p,li,ul,ol,a");
            DD_belatedPNG.fix(".pngFix,.pngFix:hover");
        </script>
        <![endif]-->
        <script>

            var _hmt = _hmt || [];
            (function () {
                var hm = document.createElement("script");
                hm.src = "//hm.baidu.com/hm.js?b2f6208338d5d0e7314443606931adf7";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
            $(function () {
                if (readcookie("xid") == '') {
                    setCookie("xid", new Date().getTime() + ":" + "");
                }
            });
        </script>

        <?php echo $content; ?>

        <?php $this->renderPartial('/layouts/all_div'); ?>
        <!--版权-->
        <div class="footerOut">
            <div class="footerIn">
                <p class="backHome"><a href="#">返回首页</a></p>

                <p class="footerRaletion">
                    <a href="/help/anchor" title="" target="_blank">帮助中心</a>|
                    <a href="/service/index" title="" target="_blank">客服中心</a>|
                    <a href="/service/index/type/2" title="" target="_blank">服务条款</a>
                    <a href="#" title="" target="_blank"></a>
                </p>

                <p class="footerContact">Copyright © 2015 北京星烨互动娱乐科技有限公司 京ICP 备14057547号-1</p>
            </div>
        </div>
        <!--版权 end-->
    </div>
    <!--wrapIn end-->
</div>
<!--wrapOuter end-->

</body>
</html>
