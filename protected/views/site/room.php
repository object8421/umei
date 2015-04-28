<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta property="qc:admins" content="35501606000165551563757"/>
    <meta property="wb:webmaster" content="baf4120dff58920e"/>
    <title><?php if ($room_info) echo $room_info['room_name'] ?>直播间 | U美直播社区 - 美女主播 - 才艺表演 - 视频聊天 - 视频交友</title>
    <meta name="description"
          content="U美直播社区是U美网旗下的大型真人视频互动直播社区,拥有众多美女主播,支持多人同时在线视频聊天,K歌跳舞,才艺表演,视频交友.赶快加入,免费与美女主播在线互动."/>
    <meta name="keywords" content="美女,主播,秀场,视频,直播间,交友,美女主播,美女秀场,美女视频,美女聊天,视频直播,视频聊天,视频交友"/>
    <!-- beginmin: dist/css/room-app.css -->
    <link href="/css/master.css" rel="stylesheet" type="text/css"/>
    <link href="/css/showLoading.css" rel="stylesheet" type="text/css"/>
    <link href="/css/kefu.css" rel="stylesheet" type="text/css"/>
    <link href="/css/common.css" rel="stylesheet" type="text/css"/>
    <link href="/css/live.css" rel="stylesheet" type="text/css"/>
    <link href="/css/room.css" rel="stylesheet">
    <link href="/css/master.css" rel="stylesheet" type="text/css"/>
    <!-- endmin -->
    <style type="text/css">
        body {
            background: url(/css/img/liveBg.jpg) no-repeat center top #000;
            margin: 0;
            padding: 0;
        }

        article, aside, dialog, footer, header, section, footer, nav, figure, menu {
            display: block
        }
    </style>
    <!--[if IE 8]>
    <style type="text/css">
        #gift_message div.lcWord {
            display: inline;
        }
    </style>
    <![endif]-->
</head>

<body>
<!--直播间-->
<div class="liveWrap">
    <!--liveIn-追加forbid为踢出房间样式-->
    <div class="liveIn">
        <!--头部-->
        <div class="liveHeaderOut">
            <!--liveHeaderIn-->
            <div class="liveHeaderIn wd">
                <div class="liveLogo"><a href="#" title="">U美</a></div>
                <!--导航-->
                <div class="liveNav">
                    <?php $this->renderPartial('/layouts/nav') ?>
                </div>
                <!--导航 end-->
                <!--登录注册-->
                <div class="loginRegister">
                    <?php if (!$user_info = User::info()): ?>
                        <!--登录前-->
                        <div class="lrBefore">
                            <span class="loginLink"><a href="javascript:void(0)" id="loginBox" title="">登录</a></span>
                            <span class="registerLink"><a href="javascript:void(0)" id="registerBox"
                                                          title="">注册</a></span>
                            <span class="registerLink"><a href="/service/index/type/3" title=""
                                                          target="_blank">反馈</a></span>
                        </div>
                    <?php else: ?>
                        <!--登录前 end-->
                        <!--登录后-->
                        <div class="lrAfter">
                            <!--用户名-->
                            <span class="userName"><a href="/account/info" title=""
                                                      target="_blank"><?php echo $user_info['nickname'] ?></a></span>
                            <!--用户名 end-->
                            <!--U币数量-->
                            <span class="goldCoin"><i class="ubIco"></i><a href="/pay/index" title="" target="_blank"
                                                                           id="mycoin"><?php echo $user_info['coin'] ?></a></span>
                            <!--U币数量 end-->
                            <span class="reCharge"><a href="/pay/index" title="" target="_blank">充值</a></span>
                            <span class="exitIco"><a href="/user/logout" id="out" title="">退出</a></span>
                            <span class="registerLink"><a href="/service/index/type/3" title=""
                                                          target="_blank">反馈</a></span>
                        </div>
                        <!--登录后 end-->
                    <?php endif ?>
                </div>
                <!--登录注册 end-->
            </div>
            <!--liveHeaderIn end-->
        </div>
        <!--头部 end-->
        <!--滚动区-->
        <div class="liveGiftTip" id="p1">
            <div class="liveScrollEle">
                <ul id="gift_message">
                </ul>
            </div>
        </div>
        <!--滚动区 end-->
        <!--内容区-->
        <div class="liveMain">
            <!--左侧-->
            <div class="liveSider">
                <!--主播信息-->
                <div class="livePlayer">
                    <!--lpMsn-->
                    <div class="lpMsn">
                        <span class="lpUserPic"><img src="<?php echo $room_info['anchor_info']['avatar'] ?>"/><i>遮罩</i></span>
                    </div>
                    <!--lpMsn end-->
                    <!--lpInfor-->
                    <div class="lpInfor">
                        <h2>
                            <b><?php echo $room_info['anchor_info']['nickname'] ?></b>
                            <b class="ipInforId">（<?php if ($room_info['anchor_info']['anchor_id'] > 0) echo $room_info['anchor_info']['anchor_id']; else echo $room_info['anchor_info']['uid'] ?>
                                ）</b>
                            <?php if ($room_info['anchor_info']['family_sign']): ?><i class="clubIcoText">
                                <em><?php echo $room_info['anchor_info']['family_sign'] ?></em></i><?php endif ?>
                        </h2>

                        <div class="lpLevel" id="star_levl_next">

                        </div>
                    </div>
                    <!--lpInfor end-->
                    <!--lpRelation-->
                    <div class="lpRelation">
                        <!--关注-->
                        <span class="lpFocusIco" id="userfav"><?php if ($is_fav): ?><a href="javascript:void(0)"
                                                                                       onclick="followAnchor(0)"
                                                                                       class="orangeBtn"><i>取消关注</i>
                            </a><?php else: ?><a href="javascript:void(0)"
                                                 onclick="followAnchor(1)"
                                                 class="orangeBtn"><i>添加关注</i></a><?php endif ?></span>
                        <!--关注 end-->
                        <span class="lpFocusIco1">粉丝人数（<span id="anchor_fans"><?php echo $room_info['fans'] ?></span>）
                        </span>
                    </div>
                    <!--lpRelation end-->
                </div>
                <!--主播信息 end-->
                <!--管理|全部-->
                <div class="liveManageAll pngBg">
                    <!--lmaTab-->
                    <div class="lmaTab manageNav">
                        <ul>
                            <li class="current" id="th1"><a href="#" title=""><i>全部<label
                                            id="user_count">(0)</label></i></a></li>
                            <li id="th2"><a href="#" title=""><i>管理 <label id="admin_count">(0)</label></i></a></li>
                        </ul>
                    </div>
                    <!--lmaTab end-->
                    <!--lmaSearch-->
                    <div class="lmaSearch">
                        <div class="lmaSearchBox">
                            <input name="" type="text" class="lmaInputStyle" placeholder="输入昵称或ID查找"
                                   autocomplete="off"/>
                            <a href="#" title="" class="lmaBut">搜索</a>
                        </div>
                    </div>
                    <!--lmaSearch end-->
                    <!--lmaMain-->
                    <div class="lmaMain">
                        <!--管理列表-->
                        <div class="liveScrollMain">
                            <!--模拟滚条-->
                            <div class="liveScrollBg"><span style="top:20px" class="liveScrollBtn">滚动条</span></div>
                            <!--模拟滚条 end-->
                            <div class="liveScrollCon" id="reportBox">
                                <!--liveManageList-->
                                <div class="liveManageList posR">
                                    <ul id="con_th_1">
                                    </ul>
                                </div>
                                <!--liveManageList end-->
                            </div>
                        </div>
                        <!--管理列表 end-->
                        <!--全部列表-->
                        <div class="liveScrollMain" style="display:none;">
                            <!--模拟滚条-->
                            <div class="liveScrollBg"><span style="top:20px" class="liveScrollBtn">滚动条</span></div>
                            <!--模拟滚条 end-->
                            <div class="liveScrollCon" id="guanli">
                                <!--liveManageList-->
                                <div class="liveManageList posR">
                                    <ul id="con_th_2">

                                    </ul>
                                </div>
                                <!--liveManageList end-->
                            </div>
                        </div>
                        <!--全部列表 end-->
                    </div>
                    <!--lmaMain end-->
                </div>
                <!--管理|全部 end-->
            </div>
            <!--左侧 end-->
            <!--中间-->

            <div class="liveContent">
                <div class="noliveVideo">
                    <div id="video_zone"></div>
                </div>
                <!--视频区-->
                <div class="J_kickoutVideo none kickoutArea">
                    <!--您被踢出房间-->
                    <div class="liveVideoForce">
                        <h2>您被管理员踢出本房间15分钟，请在<span class="J_countdown">15</span>分钟后重新进入。</h2>

                        <p><a class="normalBtn" title="" href="/"><i>返回大厅看看其他的</i></a></p>
                    </div>
                    <!--您被踢出房间 end-->
                </div>
                <div class="liveVideo" style="display: none">
                    <!--直播尚未开始，看看别的-->
                    <div class="scanOther">
                        <h2><i></i><span>直播尚未开始，看看别的</span></h2>
                        <!--scanOtherShow-->
                        <div class="scanOtherShow">
                            <ul id="room_recommended">
                            </ul>
                        </div>
                        <!--scanOtherShow end-->
                    </div>
                    <!--直播尚未开始，看看别的 end-->
                    <!--视频框-->
                    <div class="liveVideoSwf">
                        <img src="images/livePic.jpg" alt=""/>
                    </div>
                    <!--视频框 end-->
                    <!--您被踢出房间-->
                    <div class="liveVideoForce">
                        <h2>您被踢出房间</h2>

                        <p><a class="normalBtn" title="" href="#"><i>返回大厅看看其他的</i></a></p>
                    </div>
                    <!--您被踢出房间 end-->
                    <!--直播刚刚结束-->
                    <div class="liveVideoForce liveVideoForceNew">
                        <h2>直播刚刚结束</h2>

                        <p><a class="normalBtn" title="" href="#"><i>返回大厅看看其他的</i></a></p>
                    </div>
                    <!--直播刚刚结束 end-->
                </div>
                <!--视频区 end-->
                <!--礼物-->
                <div class="liveGifts">
                    <!--lgTab-->
                    <div class="lgTab">
                        <!--liveSpecialGift-->
                        <div class="liveSpecialGift">
                            <!--span class="lsgIco"><img src="css/img/caomeiIco.png" alt="草莓"/></span>                            
                            <span class="lsgNumber">2242</span-->
                        </div>
                        <!--liveSpecialGift end-->
                        <!--lgTbaUl-->
                        <div class="lgTbaUl">
                            <ul>
                                <li class="current"><a href="#" title="">普通</a></li>
                                <li><a href="#" title="">特色</a></li>
                                <li><a href="#" title="">豪华</a></li>
                            </ul>
                        </div>
                        <!--lgTbaUl end-->
                    </div>
                    <!--lgTab end-->
                    <!--管理列表-->
                    <div class="liveScrollMain">
                        <div class="liveScrollBg"><span class="liveScrollBtn">滚动条</span></div>
                        <div class="liveScrollCon" id="liwu">
                            <!--热门 图片浮标文字为img图片的alt值-->

                            <!--热门 end-->
                            <!--普通 图片浮标文字为img图片的alt值-->
                            <!--普通 end-->
                            <!--特色 图片浮标文字为img图片的alt值-->
                            <!--豪华 end-->
                        </div>
                    </div>
                    <!--管理列表 end-->
                    <!--送礼物-->
                    <div class="livePresent">
                        <span>送给</span>

                        <div class="lpToDefault">
                            <select name="select" class="selectList" id="gift_to" onchange="gift_to_change(this)">
                                <option
                                    value="<?php echo $room_info['anchor_info']['uid'] ?>"><?php echo $room_info['anchor_info']['nickname'] ?></option>
                            </select>
                            <input type="hidden" readonly id="gift_to_uid"
                                   value="<?php echo $room_info['anchor_info']['uid'] ?>">
                        </div>
                        <div class="lpToDefault">
                            <input type="text" class="inputStyle" id="gift_count" value="1"/>
                        </div>
                        <span>个</span>

                        <div class="lpToDefault">
                            <input type="text" class="inputStyle1" id="gift_name" readonly="readonly"/>
                        </div>
                        <span class="lpSent"><a class="redBtn" title="" href="javascript:void(0)"
                                                onclick='javascript:SendGift()'><i>赠送</i></a></span>
                        <span class="lpCharge"><a class="whiteBtn recharge" title="" href="javascript:void(0)"
                                                  onclick="window.open('/pay/index')"><i>充值</i></a></span>
                        <span><a href="/shop/vip" target="_shop" title=""
                                 class="redSmall"><i>VIP</i></a></span>
                        <span><a href="/account/car" target="_account" class="redSmall"><i>我的座驾</i></a></span>
                    </div>
                    <!--送礼物 end-->
                </div>
                <!--礼物 end-->
            </div>
            <!--中间 end-->
            <!--右侧-->
            <div class="liveRelation">
                <!--榜单-->
                <div class="liveRank">
                    <!--今日榜单-->
                    <div class="liveRankNav liveRankToday">
                        <span class="lrTitle">今日榜</span>
                        <span class="lrIco"></span>

                        <div class="lrInfor" id="todayfirst">
                        </div>
                    </div>
                    <!--今日榜单 end-->
                    <!--总榜-->
                    <div class="liveRankNav liveRankAll">
                        <span class="lrTitle">总榜</span>
                        <span class="lrIco"></span>

                        <div class="lrInfor" id="allfirst">
                        </div>
                    </div>
                    <!--总榜 end-->
                </div>
                <!--榜单 end-->
                <!--今日榜单浮层-->
                <div class="lineRank posZ" id="con_fan_1">
                    <!--lineRankTop-->
                    <div class="lineRankTop">
                        <ol>
                            <li class="lrtFirst">
                                <span class="lrtPic">
                                    <img src="/images/avatar.jpg" alt=""/>
                                    <i class="zzMaster"></i>
                                    <em class="lrtTu"><i class="rankIco rankSecond"></i></em>
                                </span>
                                <strong>无人</strong>

                                <p><b>0</b><i class="ubIco"></i></p>
                            </li>
                            <li class="lrtSecond">
                                <span class="lrtPic">
                                    <img src="/images/avatar.jpg" alt=""/>
                                    <i class="zzMaster"></i>
                                    <em class="lrtTu"><i class="rankIco rankFirst"></i></em>
                                </span>
                                <strong>无人</strong>

                                <p><b>0</b><i class="ubIco"></i></p>
                            </li>
                            <li class="lrtThird">
                                <span class="lrtPic">
                                    <img src="/images/avatar.jpg" alt=""/>
                                    <i class="zzMaster"></i>
                                    <em class="lrtTu"><i class="rankIco rankThird"></i></em>
                                </span>
                                <strong>无人</strong>

                                <p><b>0</b><i class="ubIco"></i></p>
                            </li>
                        </ol>
                    </div>
                    <!--lineRankTop end-->
                    <!--列表-->
                    <div class="liveScrollMain">
                        <!--模拟滚条-->
                        <div class="liveScrollBg liveScrollBgWhite"><span style="top:20px"
                                                                          class="liveScrollBtn">滚动条</span></div>
                        <!--模拟滚条 end-->
                        <div class="liveScrollCon" id="jinribang">
                            <!--lineRankBot-->
                            <div class="lineRankBot">
                                <ol class="other">
                                </ol>
                            </div>
                            <!--lineRankBot end-->
                        </div>
                    </div>
                    <!--列表 end-->
                </div>
                <!--今日榜单浮层 end-->
                <!--总榜浮层-->
                <div class="lineRank posZ" id="con_fan_3">
                    <!--lineRankTop-->
                    <div class="lineRankTop">
                        <ol>
                            <li class="lrtFirst">
                                <span class="lrtPic">
                                    <img src="/images/avatar.jpg" alt=""/>
                                    <i class="zzMaster"></i>
                                    <em class="lrtTu"><i class="rankIco rankSecond"></i></em>
                                </span>
                                <strong>无人</strong>

                                <p><b>0</b><i class="ubIco"></i></p>
                            </li>
                            <li class="lrtSecond">
                                <span class="lrtPic">
                                    <img src="/images/avatar.jpg" alt=""/>
                                    <i class="zzMaster"></i>
                                    <em class="lrtTu"><i class="rankIco rankFirst"></i></em>
                                </span>
                                <strong>无人</strong>

                                <p><b>0</b><i class="ubIco"></i></p>
                            </li>
                            <li class="lrtThird">
                                <span class="lrtPic">
                                    <img src="/images/avatar.jpg" alt=""/>
                                    <i class="zzMaster"></i>
                                    <em class="lrtTu"><i class="rankIco rankThird"></i></em>
                                </span>
                                <strong>无人</strong>

                                <p><b>0</b><i class="ubIco"></i></p>
                            </li>
                        </ol>
                    </div>
                    <!--lineRankTop end-->
                    <!--列表-->
                    <div class="liveScrollMain">
                        <!--模拟滚条-->
                        <div class="liveScrollBg liveScrollBgWhite"><span style="top:20px"
                                                                          class="liveScrollBtn">滚动条</span></div>
                        <!--模拟滚条 end-->
                        <div class="liveScrollCon" id="zongbang">
                            <!--lineRankBot-->
                            <div class="lineRankBot">
                                <ol class="other">

                                </ol>
                            </div>
                            <!--lineRankBot end-->
                        </div>
                    </div>
                    <!--列表 end-->
                </div>
                <!--总榜浮层 end-->
                <!--聊天|礼物-->
                <div class="liveMsgGift" id="liveMsgGift">
                    <!--tab-->
                    <div class="lmgTab">
                        <ul>
                            <li class="current"><a href="#" title=""><i>聊天</i></a></li>
                            <li><a href="#" title=""><i>礼物</i></a></li>
                        </ul>
                    </div>
                    <!--tab end-->
                    <!--lmgMain-->
                    <div class="lmgMain">
                        <!--房间公告-->
                        <div class="liveRoomReport">
                            <span class="lrCloseDown">关闭按钮</span>
                            <!--liveRoomWord-->
                            <div class="liveRoomWord">
                                <span class="vrrTitle">[房间公告]：</span>

                                <div class="lrrWord" id="bullet"></div>
                            </div>
                            <!--liveRoomWord end-->
                        </div>
                        <!--房间公告 end-->
                        <!--礼物列表-->
                        <div class="liveScrollMain giftShow">
                            <div class="liveScrollBg"><span class="liveScrollBtn">滚动条</span></div>
                            <div class="liveScrollCon" id="lwListData">
                                <!--clGiftList-->
                                <div class="clGiftList">
                                    <ul id="clGiftList">
                                    </ul>
                                </div>
                                <!--clGiftList end-->
                            </div>
                        </div>
                        <!--礼物列表 end-->
                        <!--交流区-->
                        <div class="liveComment">
                            <!--聊天列表-->
                            <div class="liveScrollMain">
                                <!--清屏浮层-->
                                <div class="popfn">
                                    <span class="popClear"><a href="javascript:void(0)" onclick="uu89pub.userclear();"
                                                              title="">清屏</a></span>
                                    <span class="popScroll  popScrollNo" id="popScrollPubYes"><a
                                            href="javascript:void(0)"
                                            title=""
                                            onclick="beginScrollTimerpub()">滚屏</a></span>
                                    <span class="popScroll" id="popScrollPubNo"><a href="javascript:void(0)" title=""
                                                                                   onclick="clearScrollTimerpub()">滚屏</a></span>
                                </div>
                                <!--清屏浮层 end-->
                                <div class="liveScrollBg"><span class="liveScrollBtn">滚动条</span></div>
                                <div class="liveScrollCon" id="liuyan">
                                    <!--lcList-->
                                    <div class="lcList">
                                        <ol id="content_pub"></ol>
                                    </div>
                                    <!--lcList end-->
                                </div>
                            </div>
                            <!--聊天列表 end-->
                        </div>
                        <!--交流区 end-->
                        <!--拖动条-->
                        <div class="dragBar" id="dragBar"><span>拖动</span></div>
                        <!--拖动条 end-->
                        <!--系统消息-->
                        <div class="liveSystem">
                            <!--列表-->
                            <div class="liveScrollMain">
                                <!--清屏浮层-->
                                <div class="popfn">
                                    <span class="popClear"><a href="javascript:void(0)" onclick="uu89prv.userclear();"
                                                              title="">清屏</a></span>
                                    <span class="popScroll  popScrollNo" id="popScrollPrvYes"><a
                                            href="javascript:void(0)"
                                            onclick="beginScrollTimerprv();"
                                            title="">滚屏</a></span>
                                    <span class="popScroll" id="popScrollPrvNo"><a href="javascript:void(0)"
                                                                                   onclick="clearScrollTimerprv();"
                                                                                   title="">滚屏</a></span>
                                </div>
                                <!--清屏浮层 end-->
                                <div class="liveScrollBg"><span class="liveScrollBtn">滚动条</span></div>
                                <div class="liveScrollCon" id="xitong">
                                    <!--lcList-->
                                    <div class="lcList lcListNew">
                                        <ol id="content_prv">

                                        </ol>
                                    </div>
                                    <!--lcList end-->
                                </div>
                            </div>
                            <!--列表 end-->
                        </div>
                        <!--系统消息 end-->
                        <!--留言功能-->
                        <div class="livePresent liveWordFn">
                            <!--lwfTop-->
                            <div class="lwfTop lpToClear2">
                                <span>对</span>

                                <div class="lpToDefault">
                                    <select name="select" class="selectList" id="message_to">
                                        <option value="0">所有人</option>
                                    </select>
                                </div>
                                <span class="lwRadio">
                                    <input name="" type="checkbox" value="" id="secret_check" disabled/>悄悄
                                </span>
                                <span class="lwFace"><a href="#" title=""><img src="css/img/face/ico8.png"
                                                                               class="eleCss"/></a>
                                </span>
                            </div>
                            <!--lwfTop end-->
                            <!--lwfBot-->
                            <div class="lwfBot">
                                <span class="lwfInput"><input name="" type="text" id="message_input"/></span>
                                <span class="lwfBtn"><a href="javascript:void(0)" title="" class="redBtn"
                                                        id="message_btn"><i>发表</i></a></span>
                            </div>
                            <!--lwfBot end-->
                            <!--lwfFaceList-->
                            <div class="lwfFaceList none">
                            </div>
                            <!--lwfFaceList end-->
                        </div>
                        <!--留言功能 end-->
                    </div>
                    <!--lmgMain end-->
                </div>
                <!--聊天|礼物 end-->
            </div>
            <!--右侧 end-->
        </div>
        <!--内容区 end-->
        <!--发广播-->
        <div class="liveBroad">
            <div class="lbShow">
                <div class="noticeInfor" id="noticeInfor">
                    <ul id="spmsg">
                    </ul>
                </div>
            </div>
            <?php if (!$user_info['is_watcher']): ?>
                <div class="lbIcono">发广播</div>
            <?php else: ?>
                <div class="lbIco">发广播</div>
            <?php endif ?>

            <!--发表广播-->
            <div class="radioWord">
                <span class="radiaClose">关闭</span>

                <div class="rwTextArea">
                    <textarea name="" cols="" rows="" style="height:65px;" maxlength='45' id="sperkercont"></textarea>
                </div>
                <!--发广播表情-->
                <div class="gbFaceList">

                </div>
                <!--发广播表情 end-->
                <div class="rwSub">
                    <p>还能输入<i id="J_broad_txt_num">45</i>字</p>
                    <span class="rwSubRight">
                    	<img src="css/img/castWordIco.jpg" align="middle"/>
                    	<a href="javascript:void(0)" title="" class="pinkBtn" onclick="sendspeaker()"><i>发言</i></a>
                    </span>
                </div>
            </div>
            <!--发表广播 end-->
        </div>
        <!--发广播 end-->
        <!--liveFooterOut-->
        <div class="liveFooterOut">
            <div class="liveFooterIn wd">
                <p>Copyright © 2015 北京星烨互动娱乐科技有限公司 京ICP 备14057547号-1</p>
            </div>
        </div>
        <!--liveFooterOut end-->
    </div>
    <!--liveIn end-->
</div>
<!--直播间 end-->
<!--用户列表菜单-->
<div class="userMenu posZ" style="display:none;">
    <!--umInfor-->
    <div class="umInfor">
        <h2><strong>@小猪宝贝@!</strong><span>29872</span></h2>

        <p>
            <i class="chaoIco c2"></i>
            <i class="jwIco V2"></i>
            <i class="shanIco s2"></i>
            <i class="vipIco"></i>
        </p>
        <span class="umInforCorner"></span>
    </div>
    <!--umInfor end-->
    <!--umFn-->
    <div class="umFn">
        <ul class="J_menu">
            <li><a href="javascript:void(0)" id="m_chat" title="" class="J_chat_public">公聊</a></li>
            <li><a href="javascript:void(0)" id="m_chat_p" title="" class="J_chat_private">私聊</a></li>
            <li><a href="javascript:void(0)" id="m_gift" title="" class="none J_present">送礼物</a></li>
            <li><a href="javascript:void(0)" title="" class="none">送彩条</a></li>
            <li><a href="javascript:void(0)" id="m_setadmin" title="" class="none J_manage" data-txt="取消管理">加管理</a></li>
            <li><a href="javascript:void(0)" id="m_disable_chat" title="" class="none J_forbidden">禁言</a></li>
            <li><a href="javascript:void(0)" id="m_kick" title="" class="none J_kickout">踢出房间</a></li>
            <!--            <li><a href="#" title="" class="none J_kick_website">踢出全站</a></li>-->
            <li><a href="#" title="" class="none J_stop_broadcast">停止直播</a></li>
            <li><a href="#" title="" class="none J_shield_id">封ID</a></li>
            <li><a href="javascript:void(0)" title="" class="none">封IP</a></li>
        </ul>
    </div>
    <!--umFn end-->
</div>
<!--用户列表菜单 end-->
<!--礼物提示-->
<span class="liveTip" id="liveTip" style="display:none;"><i id="liveTipText">送她草莓</i></span>
<!--礼物提示end-->

<!-- 头部logo-begin-->
<div id="online_qq_layer">
    <div id="online_qq_tab">
        <a id="floatShow" style="display:block;" href="javascript:void(0);">收缩</a>
        <a id="floatHide" style="display:none;" href="javascript:void(0);">展开</a>
    </div>
    <div id="onlineService">
        <div class="onlineMenu">
            <h3 class="tQQ">QQ在线客服</h3>
            <ul>
                <li class="tli zixun">U美客服01</li>
                <li><a target="_blank" href="tencent://message/?uin=3152262151&Site=U美&Menu=yes"><img
                            src="/images/qq.gif"></a>
                </li>
                <li class="tli zixun">U美客服02</li>
                <li><a target="_blank" href="tencent://message/?uin=3057244998&Site=U美&Menu=yes"><img
                            src="/images/qq.gif"></a>
                </li>
                <li class="tli zixun">U美新手咨询群</li>
                <li class="last"><a target="_blank"
                                    href="http://shang.qq.com/wpa/qunwpa?idkey=15eda276ddedca79ed81ec513503c132b42ae22b814d76c21d7b4cade3ba9b5a"><img
                            border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="U美新手咨询群" title="U美新手咨询群"></a>
                </li>
                <li class="tli zixun">U美增值服务群</li>
                <li class="last"><a target="_blank"
                                    href="http://shang.qq.com/wpa/qunwpa?idkey=5cac8c7651853122ef3cfddfadbeab41db35928b29d804ef4d4953a860b45a3f"><img
                            border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="U美增值咨询群" title="U美增值咨询群"></a>
                </li>
            </ul>
        </div>

        <div class="btmbg"></div>
    </div>
</div>
<!-- 头部logo end-->
<div id="xchat"></div>
<div id="gift_display" class="gift_show"></div>

<script>
    window._bd_share_config = {
        "common": {
            "bdSnsKey": {}, "bdUrl": "http://www.uumie.com/<?php echo $room_info['anchor_info']['anchor_id'] ?>",
            "bdText": "",
            "bdMini": "2", "bdMiniList": false,
            "bdPic": "http://www.uumie.com/<?php echo $room_info['anchor_info']['avatar'] ?>",
            "bdStyle": "0", "bdSize": "16"
        }, "slide": {"type": "slide", "bdImg": "7", "bdPos": "right", "bdTop": "100"},
        "image": {"viewList": ["qzone", "tsina", "tqq", "renren", "weixin"], "viewText": "分享到：", "viewSize": "16"},
        "selectShare": {"bdContainerClass": null, "bdSelectMiniList": ["qzone", "tsina", "tqq", "renren", "weixin"]}
    };
    with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
    (function () {
        if (!
                /*@cc_on!@*/
                0) return;
        var e = "abbr, article, aside, audio, canvas, datalist, details, dialog, eventsource, figure, footer, header, hgroup, mark, menu, meter, nav, output, progress, section, time, video".split(', ');
        var i = e.length;
        while (i--) {
            document.createElement(e[i])
        }
    })()
    var regFilter = "<?php echo $common_info['word_banned'] ?>"
    var room_id = <?php echo $room_info['room_id'] ?>;
    var roompara = {
        "serverip": "<?php echo $room_info['cserver_ip'] ?>", "serverport":<?php echo $room_info['cserver_port'] ?>,
        "mserverip": "<?php echo $room_info['mserver_ip'] ?>", "mserverport":<?php echo $room_info['mserver_port'] ?>,
        "welcome": "welcome", "v1": 0, "v2": -1, "v3": -1, "m_bitrate":<?php echo $room_info['bitrate']?>,
        "uid": "<?php echo $room_info['uid']?>", "kickout":<?php echo $kickout ?>
    };
    var gift_message = <?php echo $last_broad ?>;
    <?php if($user_info):?>
    var userpara = {
        "uid":<?php echo $user_info['uid'] ?>, "gid":<?php echo $user_info['uid'] ?>,
        "nicegid":<?php echo $user_info['anchor_id'] ?>,
        "nickname_b64": "<?php echo base64_encode($user_info['nickname']) ?>", "icon": 0,
        "vip":<?php echo $user_info['user_level'] ?>, "vip2":<?php echo $user_info['vip'] ?>, "badge": 0,
        "title": 0, "role": 0, "agency": 0,
        "watchman":<?php echo $user_info['is_watcher'] ?>,
        "roomer":<?php if($user_info['uid'] == $room_info['uid']) echo 4; else echo 0; ?>, "starlevel": 0,
        "car_id":<?php echo $user_info['car'] ?>, "family_name": "0", 'level':<?php echo $level ?>
    };
    <?php else:?>
    var userpara = {
        "gid": 0, "nicegid": 0, "nickname_b64": "<?php echo base64_encode('游客') ?>", "icon": 0, "vip": 0, "vip2": 0,
        "badge": 0, "levelinroom": 1, "title": 0, "role": 0, "agency": 0, "watchman": 0, "roomer": 0, "starlevel": 0,
        "car_id": 0, "family_name": "0", "level": 1
    };
    <?php endif?>
    var _chat_pub_loaded = 0;
    var _chat_prv_loaded = 0;
    var room_welcome = "<?php echo htmlspecialchars($room_info['welcome']) ?>";
    var room_owner_uid = <?php echo $room_info['uid'] ?>;
    var nicknameIniVal = "<?php echo htmlspecialchars($user_info['nickname']) ?>";
    var fromgidIniVal = '<?php echo $user_info['uid'] ?>';
    function load_room_bullet() {
        var url = '/room/bulletin/id/<?php if($room_info['anchor_info']['anchor_id'])echo $room_info['anchor_info']['anchor_id'];else echo $room_info['uid'] ?>';
        $.get(url, function (result) {
                $('#bullet').html(result);
            }
        );
    }
    var fansConfig = '<?php echo $room_info['anchor_info']['anchor_id'] ?>'

</script>
<!-- beginmin: dist/js/room-app.js -->
<script src="/js/common/xid.js"></script>
<script src="/js/view/room/chat_v1.source.js"></script>
<script src="/js/libraries/swfobject.js"></script>

<script src="/js/libraries/base64.js"></script>

<script src="/js/view/room/xchat.js"></script>

<script src="/js/view/room/video_swf.js"></script>

<script src="/js/view/room/gift.js"></script>

<script src="/js/view/room/car.js"></script>
<script src="/js/libraries/jquery-1.11.1.js"></script>
<script src="/js/libraries/jquery.showLoading.js"></script>
<script src="/js/common/general.js"></script>
<script src="/js/view/room/controller.js"></script>
<script src="/js/view/room/drop.js"></script>
<script src="/js/view/room/effect.js"></script>
<script src="/js/common/utils.source.js"></script>
<script src="/js/libraries/jquery.marquee.js"></script>
<script src="/js/view/room/room_main.js"></script>
<script src="/js/view/room/send-gift.js"></script>
<!-- endmin -->
<?php $this->renderPartial('/layouts/all_div'); ?>
<!--hover event no effect if jquery.pause not referenced in ie8-->
<!--[if IE 8]>
<script src="/js/libraries/jquery.pause.js"></script>
<![endif]-->
</body>
</html>