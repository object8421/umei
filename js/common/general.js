/**
 * Description: common modules
 *
 * @module SiteCommon
 * @class SiteCommon
 * @static
 */
window.SiteCommon = {
    renderPromptBox: function (data) {
        var ms = JSON.parse(data);
        jQuery("#returnmsg").html(ms.message);
        if (ms.error == 0) {
            jQuery("#tips02").click();
        } else {
            jQuery("#tips02").click();
        }
    },
    setChatDialog: function (jQueryele, func) {
        jQueryele.keypress(function (event) {
            if (event.which == 13) {
                func.call(this, jQueryele);
            }
        });
    },
    /**
     *  @method isMaxUserName
      * @param begin 截取开始的索引
      * @param num 截取的长度
      */
    regTraditional: /[^\x00-\xFF]/,
    substrTrad: function (txt, begin, num) {
        var ascRegexp = this.regTraditional, i = 0;
        while (i < begin) (i++ && this.charAt(i).match(ascRegexp) && begin--);
        i = begin;
        var end = begin + num;
        while (i < end) (i++ && txt.charAt(i).match(ascRegexp) && end--);
        return txt.substring(begin, end);
    },
    isLessMinInput: function (txt, minNum) {
        minNum = minNum || 2;
        var minLen = minNum;
        var actualLen = len = txt.length;
        if (len < minLen) {
            for (var i = 0; i < len; i++) {
                var val = txt.charAt(i);
                if (this.regTraditional.test(val)) {
                    actualLen++;
                }
            }
        }
        return actualLen < minLen
    },
    setMaxInput: function (jQueryinput) {
        jQueryinput.keyup(function (event) {
            var txt = jQuery(this).val();
            if (/^\d+jQuery/.test(txt)) {
                jQuery('.erroTipInfor').text('用户名不能全部为数字')
            } else {
                jQuery('.erroTipInfor').text('')
            }
            var maxLen = 16
            if (txt.length > maxLen / 2) {
                jQuery(this).val(SiteCommon.substrTrad(txt, 0, maxLen - 1))
            }
        })
    }
}
/*二级页面左侧导航*/
jQuery(function () {
    var menuSide = jQuery(".menuSide");
    if (menuSide) {
        jQuery(".menuSide dl").each(function (index) {
            var dds = jQuery(this).find("dd").length;
            var dlDefaultHeight = 35;
            var dtDefaultHeight = 35;
            jQuery(this).css({"height": dlDefaultHeight});
            var className = jQuery(this).hasClass("current");
            if (className) {
                jQuery(this).animate({"height": dds * dlDefaultHeight + dtDefaultHeight});
            }
            ;
            jQuery(this).click(function (event) {
                var ddLength = jQuery(this).find("dd").length;
                jQuery(this).animate({"height": ddLength * 35 + dtDefaultHeight}).siblings().animate({"height": dtDefaultHeight});
            });
        });
    }
});
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
    wh.width = jQuery(window).width();
    wh.height = jQuery(window).height();
    return wh;
};
//scrollLT
function scrollLT() {
    var lt = {'left': '', 'top': ''};
    lt.left = document.body.scrollLeft || document.documentElement.scrollLeft;
    lt.top = document.body.scrollTop || document.documentElement.scrollTop;
    return lt;
};
/* 登陆注册层 */

jQuery(function () {
    SiteCommon.setChatDialog(jQuery('.controlGroup input'), function (data) {
        jQuery('.pubLinks:visible').click()
    })
});
function viewWH() {
    var wh = {'width': '', 'height': ''};
    wh.width = jQuery(window).width();
    wh.height = jQuery(window).height();
    return wh;
};
var srcPx = jQuery(document).scrollTop();
//弹框插件
jQuery(function () {
    //对象+命名空间
    jQuery.fn.windowOpen = function (options) {
        //默认值
        var defaults = {
            "clickEle": "loginReward",
            "popEle": "loginRewardPop",
            callback:jQuery.noop
        }
        //合并默认值与参数
        var options = jQuery.extend(defaults, options);
        //操作代码
        this.each(function () {
            //生命动画变量
            var This = jQuery(this);
            var clickEle = "#" + options.clickEle;
            var popEle = "#" + options.popEle;
            var popClose = jQuery(popEle).find("h2 a,.pinkBtn");
            var popEleH = jQuery(popEle).innerHeight();
            var popEleW = jQuery(popEle).innerWidth();
            jQuery(clickEle).click(function () {
                var posTop = (viewWH().height - popEleH) / 2 + srcPx;
                var posLeft = -(popEleW / 2)
                jQuery(".windowOpen").css({"display": "none"});
                jQuery(".masterEle").height(document.body.scrollHeight);
                jQuery('.erroTipInfor').text('')
                jQuery(".masterEle").show();
                jQuery(popEle).css({"display": "block", "top": posTop, "marginLeft": posLeft});
            });
            jQuery(popClose).click(function () {
                jQuery(popEle).css({"display": "none"});
                jQuery(".masterEle").hide();
                options.callback()
            });
            jQuery(window).scroll(function () {
                resizeEle();
            });
            jQuery(window).resize(function () {
                resizeEle();
            });
            function resizeEle() {
                srcPx = jQuery(document).scrollTop();
                jQuery(popEle).css({"top": srcPx + (viewWH().height - popEleH) / 2});
            }
        });
    }
});
jQuery(function () {
    //提示01
    jQuery("#tips01").windowOpen({
        "clickEle": "tips01",
        "popEle": "tips01Pop"
    });
    //提示02
    jQuery("#tips02").windowOpen({
        "clickEle": "tips02",
        "popEle": "tips02Pop"
    });
    //提示03
    jQuery("#tips03").windowOpen({
        "clickEle": "tips03",
        "popEle": "tips03Pop"
    });
    //提示02
    jQuery("#tips04").windowOpen({
        "clickEle": "tips04",
        "popEle": "tips04Pop"
    });
    //提示02
    jQuery("#tips05").windowOpen({
        "clickEle": "tips05",
        "popEle": "tips05Pop"
    });
    //提示02
    jQuery("#tips06").windowOpen({
        "clickEle": "tips06",
        "popEle": "tips06Pop"
    });
    //提示02
    jQuery("#tips07").windowOpen({
        "clickEle": "tips07",
        "popEle": "tips07Pop"
    });
    //提示02
    jQuery("#tips08").windowOpen({
        "clickEle": "tips08",
        "popEle": "tips08Pop"
    });
    //提示02
    jQuery("#tips09").windowOpen({
        "clickEle": "tips09",
        "popEle": "tips09Pop"
    });
    //注册
    jQuery("#registerBox").windowOpen({
        "clickEle": "registerBox",
        "popEle": "registerPop"
    });
    //注册成功
    jQuery("#registerokBox").windowOpen({
        "clickEle": "registerokBox",
        "popEle": "registerokPop",
        callback: function func() {
            location.reload()
        }
    });
    //登录
    jQuery("#loginBox").windowOpen({
        "clickEle": "loginBox",
        "popEle": "loginPop"
    });
    //girl
    jQuery("#girlBox").windowOpen({
        "clickEle": "girlBox",
        "popEle": "girlPop"
    });
    //remark
    jQuery("#tdBox").windowOpen({
        "clickEle": "tdBox",
        "popEle": "tdPop"
    });
})
SiteCommon.setMaxInput(jQuery('#regusername'));