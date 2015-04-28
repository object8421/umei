/**
 * Description: common modules
 *
 * @module SiteCommon
 * @class SiteCommon
 * @static
 */
window.SiteCommon = {
    setChatDialog: function ($ele, func) {
        $ele.keypress(function (event) {
            if (event.which == 13) {
                func.call(this, $ele);
            }
        });
    }
}
//滚动插件
$(function () {
    //对象+命名空间
    $.fn.scrollElement = function (options) {
        //默认值
        var defaults = {
            "fatherEle": "liveScrollEle",
            "marginDefault": 20,
            "time": 2500
        }
        //合并默认值与参数
        var options = $.extend(defaults, options);
        //操作代码
        this.each(function () {
            var This = $(this);
            var liveScrollEle = $("." + options.fatherEle);
            var fatherWidth = $(liveScrollEle).width();
            var ulElement = $(liveScrollEle).find("ul")[0];
            var liEle = $(liveScrollEle).find('li');
            var liLength = $(liveScrollEle).find('li').length;
            var paraWidth = 0;
            var marginWidth = 0;
            var marginDefault = 20;
            var paraCurrent = -1;
            var timeAnimate = null;
            var timeSpace = options.timeSpace;
            //判断元素宽度和
            var wMath = 0;
            for (var i = 0; i < liLength; i++) {
                wMath += $(liEle).eq(i).width();
            }
            ;
            //ulElement.innerHTML += ulElement.innerHTML;
            if (wMath >= fatherWidth) {
                ulElement.innerHTML += ulElement.innerHTML;
                this.timeAnimate = setInterval(scrollEle, timeSpace);
            }
            ;
            function scrollEle() {
                if (paraCurrent < liLength - 1) {
                    paraCurrent++;
                    paraWidth += $(ulElement).find('li').eq(paraCurrent).width();
                    marginWidth += marginDefault * paraCurrent
                    $(ulElement).animate({"left": -paraWidth - marginWidth});
                } else {
                    paraCurrent = -1;
                    paraWidth = 0;
                    $(ulElement).css({"left": 0});
                }
                ;
            };
        });
    }
});
//直播间顶部滚动
/*$(function(){
 $(".liveScrollEle").scrollElement({
 "fatherEle":"liveScrollEle",//父容器
 "marginDefault":20,//元素间隙
 "timeSpace":2500//滚动时间
 });
 });*/
//直播间底部滚动
/*$(function(){
 $(".noticeInfor").scrollElement({
 "fatherEle":"noticeInfor",//父容器
 "marginDefault":20,//元素间隙
 "timeSpace":2500//滚动时间
 });
 });*/
/*全部|管理*/
$(function () {
    try {
        autologin(islogined);
    } catch (e) {
        console.log('it\'s in login page')
    }
    if ($("#out").length) {
        $("#out").attr("href", "/user/logout");
    }
    $(".lmaTab a").each(function (index) {
        $(this).click(function (event) {
            event.preventDefault();
            $(this).parent().addClass("current").end().parent().siblings().removeClass();
            $(".lmaMain .liveScrollMain").eq(index).css({"display": "block"}).siblings().css({"display": "none"});
        });
    });
    //浮层
    var viewHeight = $(window).height();
    var viewWidth = $(window).width();
    var userMenu = $(".userMenu");
    var useMeHeight = $(".userMenu").height();
    var useMeWidth = $(".userMenu").width();
    /*
     var lTop = $("#liuyan").offset().top;
     var lLeft = $("#liuyan").offset().left;
     */
    var hasWord = document.getElementById("liuyan");
    if (hasWord) {
        var lTop = $(hasWord).offset().top;
        var lLeft = $(hasWord).offset().left;
    }
    ;
    $(".liveManageList li").each(function (index) {
        $(this).click(function (event) {
            viewHeight = $(window).height();
            //$(this).addClass("current").siblings().removeClass("current");
            $(userMenu).css({"display": "block", "left": event.pageX + 10, "top": event.pageY + 10});
            //alert(viewHeight);
            if (event.pageX + 10 + event.pageX + 10 > viewHeight) {
                $(userMenu).css({"left": event.pageX + 10, "top": event.pageY + 10});
            } else {
                $(userMenu).css({"left": event.pageX + 10, "top": 315});
            }
        });
    });
    //留言板用户名
    $(".lcList a").each(function (index) {
        $(this).click(function (event) {
            event.preventDefault();
            viewHeight = $(window).height();
            viewWidth = $(window).width();
            var newH = event.clientY + useMeHeight;
            var newW = event.clientX + useMeWidth;
            if ((newH + 10) < viewHeight) {
                $(userMenu).css({"display": "block", "top": (event.pageY + 10)});
                if ((newW + 10) < viewWidth) {
                    $(userMenu).css({"left": (event.pageX + 10)});
                } else {
                    $(userMenu).css({"left": (event.pageX - useMeWidth - 10)});
                }
            } else {
                $(userMenu).css({"display": "block", "top": event.pageY - (newH - viewHeight + 10)});
                if ((newW + 10) < viewWidth) {
                    $(userMenu).css({"left": (event.pageX + 10)});
                } else {
                    $(userMenu).css({"left": (event.pageX - useMeWidth - 10)});
                }
            }
        });
    });
    //清除
    $(".lmaMain").mouseleave(function () {
        hideEle();
    });
    $(userMenu).mouseenter(function () {
        showEle();
    });
    $(userMenu).mouseleave(function () {
        hideEle();
    });
    //隐藏/显示函数
    function hideEle() {
        $(userMenu).css({"display": "none"});
    }

    function showEle() {
        $(userMenu).css({"display": "block"});
    }
});
/*榜单*/
$(function () {
    var liveRank = $(".liveRank .lrTitle");
    $(liveRank).each(function (index) {
        $(this).click(function () {
            if ($(this).hasClass('current')) {
                $(this).removeClass("current");
                $(".lineRank").css({"display": "none"});
                $(".lineRank").eq(index).css({"display": "none"});
            } else {
                $(this).addClass("current");
                $(".lineRank").css({"display": "none"});
                $(".lineRank").eq(index).css({"display": "block"});
            }
            ;
        });
    });
});
/*房间公告*/
$(function () {
    var lrCloseDown = $(".lrCloseDown");
    var liveRoomWord = $(".liveRoomWord");
    $(lrCloseDown).click(function () {
        if ($(this).hasClass('lrCloseUp')) {
            $(this).removeClass("lrCloseUp");
            $(liveRoomWord).animate({"height": 45});
        } else {
            $(this).addClass("lrCloseUp");
            $(liveRoomWord).animate({"height": 30});
        }
    });
});
/*聊天|礼物*/
$(function () {
    var giftShow = $(".giftShow")
    $(".lmgTab li a").each(function (index) {
        $(this).click(function (event) {
            event.preventDefault();
            $(this).parent().addClass("current").end().parent().siblings().removeClass("current");
            if (index == 0) {
                $(giftShow).removeClass("highlight");
            } else {
                $(giftShow).addClass("highlight");
            }
        });
    });
})
/*清屏滚屏*/
$(function () {
    var liveComment = $(".liveComment");
    var liveSystem = $(".liveSystem");
    $(liveComment).hover(function () {
        $(".liveComment .popfn").css({"top": 25});
    }, function () {
        $(".liveComment .popfn").css({"top": -300});
    });
    $(liveSystem).hover(function () {
        $(".liveSystem .popfn").css({"top": 25});
    }, function () {
        $(".liveSystem .popfn").css({"top": -300});
    });
});
/*发广播*/
$(function () {
    var lbIco = $(".lbIco");
    var radioWord = $(".radioWord");
    var radiaClose = $(".radiaClose");
    var ifState = true;
    $(lbIco).click(function () {
        radioFn()
    });
    $(radiaClose).click(function () {
        radioFn();
    });
    function radioFn() {
        if (ifState) {
            ifState = false;
            $(radioWord).addClass("show");
        } else {
            ifState = true;
            $(radioWord).removeClass("show");
        }
    }
});
/*表情*/
$(function () {
    var lwfFaceList = $(".lwfFaceList");
    var trueFalse = 1;
    $(".lwFace a").click(function (event) {
        event.preventDefault();
        if (trueFalse) {
            trueFalse = 1;
            $(lwfFaceList).css({"display": "block"});
        } else {
            trueFalse = 0;
            $(lwfFaceList).css({"display": "none"});
        }
    });
    $(lwfFaceList).mouseleave(function () {
        $(lwfFaceList).css({"display": "none"});
    });
    $("body").click(function (event) {
        var ele = event.target;
        var eleClass = $(ele).attr("class");
        if (ele.tagName == "IMG" && eleClass == "eleCss") {
            $(lwfFaceList).animate({"display": "block"});
        } else {
            $(lwfFaceList).css({"display": "none"});
        }
    });
})
/*礼物*/
function makeGitfTip() {
    var liveTip = $("#liveTip");
    var nowScrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    $(".liveGiftsBox li").each(function (index) {
        $(this).mousemove(function (event) {
            $("#liveTipText").html($(this).find('img').attr('alt'));
            nowScrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            $(liveTip).css({"left": event.clientX + 10, "top": event.clientY + nowScrollTop + 10});
        });
        $(this).mouseenter(function () {
            $(liveTip).css({"display": "block"});
        });
        $(this).mouseleave(function () {
            $(liveTip).css({"display": "none"});
        });
    });
}
/*二级页面左侧导航*/
$(function () {
    var menuSide = $(".menuSide");
    $(".menuSide dl").each(function (index) {
        var dds = $(this).find("dd").length;
        var dlDefaultHeight = 35;
        var dtDefaultHeight = 35;
        $(this).css({"height": dlDefaultHeight});
        var className = $(this).hasClass("current");
        if (className) {
            $(this).animate({"height": dds * dlDefaultHeight + dtDefaultHeight});
        }
        ;
        $(this).click(function (event) {
            var ddLength = $(this).find("dd").length;
            $(this).animate({"height": ddLength * 35 + dtDefaultHeight}).siblings().animate({"height": dtDefaultHeight});
        });
    });
});
/*滚条置底*/
var scrollTimerpub;
$(function () {
    $("#popScrollPubYes").hide();
});
$(function () {
    $("#popScrollPrvYes").hide();
});
function clearScrollTimerpub() {
    $("#popScrollPubNo").hide();
    $("#popScrollPubYes").show();
    uu89pub.autoscroll = false;
}
function beginScrollTimerpub() {
    $("#popScrollPubNo").show();
    $("#popScrollPubYes").hide();
    uu89pub.autoscroll = true;
    uu89pub.rolling();
}
function clearScrollTimerprv() {
    $("#popScrollPrvYes").show();
    $("#popScrollPrvNo").hide();
    uu89prv.autoscroll = false;
}
function beginScrollTimerprv() {
    $("#popScrollPrvNo").show();
    $("#popScrollPrvYes").hide();
    uu89prv.autoscroll = true;
    uu89prv.rolling();
}
//pos(obj)
function pos(obj) {
    var lt = {"left": 0, "top": 0};
    while (obj) {
        lt.left += obj.offsetLeft;
        lt.top += obj.offsetTop;
        obj = obj.offsetParent;
    }
    ;
    return lt;
}
//viewWH()
function viewWH() {
    var wh = {'width': '', 'height': ''};
    wh.width = $(window).width();
    wh.height = $(window).height();
    return wh;
};
//scrollLT
function scrollLT() {
    var lt = {'left': '', 'top': ''};
    lt.left = document.body.scrollLeft || document.documentElement.scrollLeft;
    lt.top = document.body.scrollTop || document.documentElement.scrollTop;
    return lt;
};
//拖拽
$(function () {
    var liuyan = document.getElementById('liuyan');//留言列表
    var dragBar = document.getElementById('dragBar');//拖条
    var xitong = document.getElementById('xitong');//系统列表
    var liveMsgGift = document.getElementById('liveMsgGift');
    var liveMsgGiftTop = pos(liveMsgGift).top;//聊天.礼物父容器至文档顶部top距离
    if (dragBar) {
        dragBar.onmousedown = function (ev) {
            var ev = ev || event;
            var liveMsgGiftHeight = $(".liveMsgGift").height();//聊天.礼物liveMsgGift父容器高度
            var lmgTabHeight = $(".lmgTab").height();//聊天.礼物导航高度
            var liveRoomReportHeight = $(".liveRoomReport").height();//公告高度
            var liveWordFnHeight = $(".liveWordFn").outerHeight(true);//留言区域高度
            var dragBarHeight = $(".dragBar").height();//拖动条高度
            var lmgMainHeight = $(".lmgMain").height() - lmgTabHeight - liveRoomReportHeight - liveWordFnHeight;
            $(document).mousemove(function (event) {
                var mouseY = event.pageY;//鼠标至文档顶部Y坐标
                var topValue = mouseY - liveMsgGiftTop - lmgTabHeight - liveRoomReportHeight;//动态改变留言容器高度
                var singleLineChatHeight = 27;
                var offset = singleLineChatHeight * 3;
                if (topValue <= offset) {
                    topValue = offset;
                }
                var marginBottom = lmgMainHeight + 25 - offset;
                if (topValue >= marginBottom) {
                    topValue = marginBottom;
                }
                var reduceValue = liveMsgGiftHeight - topValue - liveWordFnHeight - lmgTabHeight - liveRoomReportHeight - dragBarHeight;//动态修改系统信息容器告诉
                //document.title = "top" +  topValue + "+" + "bottom" +reduceValue;
                $(liuyan).css({"height": topValue});
                $(xitong).css({"height": reduceValue});
                return false;//修复ie下拖动后文字闪动
            });
            $(document).mouseup(function () {
                $(document).unbind("mousemove");
                $(document).unbind("mouseup");
            });
            return false;
        }
    }
})
/*可视区调整*/
function viewReset() {
    var viewWidthHeight = viewWH();
    var vh = viewWidthHeight.height;//可视窗口高度
    var lhoHeight = $(".liveHeaderOut").outerHeight(true); //顶部导航
    var lgtHeight = $(".liveGiftTip").outerHeight(true); //跑马灯
    var lpHeight = $(".livePlayer").outerHeight(true); //主播信息
    var mnHeight = $(".manageNav").outerHeight(true); //全部 管理
    var isHeight = $(".lmaSearch").outerHeight(true); //搜索框
    var lvH = $(".liveVideo").outerHeight(true); //视频框
    var ltH = $(".lgTab").outerHeight(true); //礼物导航
    var lpH = $(".livePresent").outerHeight(true); //赠送
    var pb10 = 10;
    var vrH = $(".liveRank").outerHeight(true); //榜单
    var lrrH = $(".liveRoomReport").outerHeight(true); //公告
    var lsH = $(".liveSystem").outerHeight(true); //系统信息
    var lwfH = $(".liveWordFn").outerHeight(true); //留言区
    var lbHeight = $(".liveBroad").outerHeight(true); //广播
    var lfoHeight = $(".liveFooterOut").outerHeight(true); //版权
    var pb30 = 30;
    var lrkHeight = $(".lineRankTop").outerHeight(true); //今日榜单前三
    if (vh > 700) {
        //左侧
        var resetLeftHeigth = vh - lhoHeight - lgtHeight - lpHeight - mnHeight - isHeight - lbHeight - lfoHeight;
        $("#reportBox").css({"height": resetLeftHeigth});
        $("#guanli").css({"height": resetLeftHeigth});
        //中间
        var resetMiddleHeigth = vh - lhoHeight - lvH - ltH - lpH - lbHeight - lfoHeight - 53;
        $("#liwu").css({"height": resetMiddleHeigth});
        //右侧
        var resetRightHeigth = vh - lhoHeight - lgtHeight - vrH - lrrH - lsH - lwfH - lbHeight - lfoHeight - 33;
        $("#liuyan").css({"height": resetRightHeigth});
        //礼物弹窗
        var resetGiftHeigth = vh - lhoHeight - lgtHeight - vrH - lbHeight - lfoHeight - 30;
        $("#lwListData").css({"height": resetGiftHeigth});
        //今日榜单
        var resetRwardHeigth = vh - lhoHeight - lgtHeight - lbHeight - lfoHeight - lrkHeight - 50;
        $("#jinribang").css({"height": resetRwardHeigth});
        $("#zongbang").css({"height": resetRwardHeigth});
        //
    } else {
        //左侧
        $("#reportBox").css({"height": ''});
        $("#guanli").css({"height": ''});
        //中间
        $("#liwu").css({"height": ''});
        //右侧
        $("#liuyan").css({"height": ''});
        //礼物弹窗
        $("#lwListData").css({"height": ''});
        //今日榜单
        $("#jinribang").css({"height": ''});
        $("#zongbang").css({"height": ''});
    }
}
$(window).resize(function () {
    viewReset();
});
$(window).load(function () {
    viewReset();
});
/*发广播表情*/
$(function () {
    var rwSubRightImg = $(".rwSubRight img");
    var gbFaceList = $(".gbFaceList");
    var ifTrue = 1;
    $(rwSubRightImg).click(function () {
        if (ifTrue) {
            ifTrue = 0;
            $(".gbFaceList").css({"display": "block"});
        } else {
            ifTrue = 1;
            $(".gbFaceList").css({"display": "none"});
        }
    });
    gbFaceList.mouseleave(function () {
        ifTrue = 1;
        $(this).css({"display": "none"});
    });
    $("body").click(function (event) {
        var ele = event.target;
        //var eleClass = $(ele).attr("class");
        if (ele.tagName == "IMG") {
            gbFaceList.css({"display": "block"});
        } else {
            gbFaceList.css({"display": "none"});
        }
    });
})
/*礼物分类*/
$(function () {
    $(".lgTbaUl li a").each(function (index) {
        $(this).click(function (event) {
            event.preventDefault();
            $(this).parent().addClass("current").end().parent().siblings().removeClass("current");
            $(".liveGiftsBox").css({"display": "none"});
            $(".liveGiftsBox").eq(index).css({"display": "block"});
        });
    });
});
/* 登陆注册层 */
$(function () {
    SiteCommon.setChatDialog($('.controlGroup input'), function (data) {
        $('.pubLinks:visible').click()
    })
});
function viewWH() {
    var wh = {'width': '', 'height': ''};
    wh.width = $(window).width();
    wh.height = $(window).height();
    return wh;
};
var srcPx = $(document).scrollTop();
//弹框插件
$(function () {
    //对象+命名空间
    $.fn.windowOpen = function (options) {
        //默认值
        var defaults = {
            "clickEle": "loginReward",
            "popEle": "loginRewardPop"
        }
        //合并默认值与参数
        var options = $.extend(defaults, options);
        //操作代码
        this.each(function () {
            //生命动画变量
            var This = $(this);
            var clickEle = "#" + options.clickEle;
            var popEle = "#" + options.popEle;
            var popClose = $(popEle).find("h2").find('a');
            var popEleH = $(popEle).innerHeight();
            var popEleW = $(popEle).innerWidth();
            $(clickEle).click(function () {
                var posTop = (viewWH().height - popEleH) / 2 + srcPx;
                var posLeft = -(popEleW / 2)
                $(".windowOpen").css({"display": "none"});
                $(".masterEle").height(document.body.scrollHeight);
                $(".masterEle").show();
                $(popEle).css({"display": "block", "top": posTop, "marginLeft": posLeft});
            });
            $(popClose).click(function () {
                $(popEle).css({"display": "none"});
                $(".masterEle").hide();
            });
            $(window).scroll(function () {
                resizeEle();
            });
            $(window).resize(function () {
                resizeEle();
            });
            function resizeEle() {
                srcPx = $(document).scrollTop();
                $(popEle).css({"top": srcPx + (viewWH().height - popEleH) / 2});
            }
        });
    }
});
$(function () {
    //提示01
    $("#tips01").windowOpen({
        "clickEle": "tips01",
        "popEle": "tips01Pop"
    });
    //提示02
    $("#tips02").windowOpen({
        "clickEle": "tips02",
        "popEle": "tips02Pop"
    });
    //提示03
    $("#tips03").windowOpen({
        "clickEle": "tips03",
        "popEle": "tips03Pop"
    });
    //提示02
    $("#tips04").windowOpen({
        "clickEle": "tips04",
        "popEle": "tips04Pop"
    });
    //提示02
    $("#tips05").windowOpen({
        "clickEle": "tips05",
        "popEle": "tips05Pop"
    });
    //提示02
    $("#tips06").windowOpen({
        "clickEle": "tips06",
        "popEle": "tips06Pop"
    });
    //提示02
    $("#tips07").windowOpen({
        "clickEle": "tips07",
        "popEle": "tips07Pop"
    });
    //提示02
    $("#tips08").windowOpen({
        "clickEle": "tips08",
        "popEle": "tips08Pop"
    });
    //提示02
    $("#tips09").windowOpen({
        "clickEle": "tips09",
        "popEle": "tips09Pop"
    });
    //注册
    $("#registerBox").windowOpen({
        "clickEle": "registerBox",
        "popEle": "registerPop"
    });
    //注册成功
    $("#registerokBox").windowOpen({
        "clickEle": "registerokBox",
        "popEle": "registerokPop"
    });
    //登录
    $("#loginBox").windowOpen({
        "clickEle": "loginBox",
        "popEle": "loginPop"
    });
    //girl
    $("#girlBox").windowOpen({
        "clickEle": "girlBox",
        "popEle": "girlPop"
    });
    //remark
    $("#tdBox").windowOpen({
        "clickEle": "tdBox",
        "popEle": "tdPop"
    });
})