/**
 * Description: events binding in room page
 *
 * @module Controller
 */
/*全部|管理*/
function setBroadTextarea() {
    var txtVal = $(this).val();
    var matteredInputLen = txtVal.replace(/<a.+?>(.*?)<\/a>/g, '$1').length;
    var aTagLen = txtVal.length - matteredInputLen
    var $textArea = $('#J_broad_txt_num');
    var remainingLen = SiteCommon.maxBroadLen - matteredInputLen;
    var actualLen = 45 + aTagLen;
    if (remainingLen < 0) {
        $('#sperkercont').val(function (i,n) {
            return n.slice(0,actualLen)
        })
        remainingLen=0
    }
    $textArea.text(remainingLen).attr('maxlength', actualLen)
}
$(function () {
    var $searchInput = $('.lmaInputStyle');
    $(".lmaTab a").click(function (event) {
        event.preventDefault();
        var $tabLi = $(this).parent();
        if ($tabLi.hasClass('current')) {
            return;
        }
        $searchInput.val('')
        $tabLi.addClass("current").end().parent().siblings().removeClass();
        var $li = $('#con_th_1>li');
        $li.show();
        if ($tabLi.index()) {
            displayRoomManager()
        }
        function displayRoomManager() {
            $.each($li, function (i, n) {
                if ($(n).data('level') < 3) {
                    $(n).hide()
                }
            })
        }
    });
    $searchInput.keyup(function (data) {
        var text = $(this).val()
        var $content = $('#con_th_1');
        var isRoomManageTab = $('#th2.current').length;
        var $allUsersLi = $content.children('li');
        var $li = isRoomManageTab ? $allUsersLi.filter(function (index) {
            return $(this).data('level') >= 3
        }) : $allUsersLi;
        if ($.trim(text) == '') {
            $li.show()
        } else {
            $li.hide()
            $.each($content.find('.lvlName').children(), function (i, n) {
                var $liParent = $(n).parents('li.J_user');
                if (isRoomManageTab > 0 && $liParent.data('level') < 3) {
                    return
                }
                if ($(n).text().indexOf(text) !== -1) {
                    $liParent.show()
                }
            })
        }
    })
    $('#sperkercont').on({
        keypress: function (e) {
            if (e.keyCode == 13) {
                return false;
            }
        },
        keyup: function () {
            setBroadTextarea.call(this);
        }
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
    $(".radiaClose,.lbIco").click(function () {
        SiteCommon.radioFn();
    });
});
/*表情*/
$(function () {
    var lwfFaceList = $(".lwfFaceList");
    $(".lwFace a").click(function (event) {
        event.preventDefault();
        $(lwfFaceList).toggleClass("none");
    });
    $(lwfFaceList).mouseleave(function () {
        $(lwfFaceList).addClass("none");
    });
    $("img.eleCss").click({ini: true}, function (event) {
        var $faceContainer = $(lwfFaceList);
        $faceContainer.toggleClass('none')
        if ($faceContainer.is(':visible') && event.data.ini) {
            $('body').one('click', function () {
                $(lwfFaceList).addClass('none')
                event.data.ini = true
            })
            event.data.ini = false
        }
        return false
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
    var lvH = $(".liveVideo").outerHeight(true) || 360; //视频框
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
        $("#liwu").css({"height": resetMiddleHeigth + 20});
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
/**
 * Description: controlling chat scrolling bar
 *
 * @class ChatScrolling
 */
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