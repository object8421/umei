/* 聊天对象 */
function chat(o, type, $scroll) {
    this.chat_type = type;
    this.infosum = 0;        // 信息计数器
    this.lastmsg = [];       // 保存最后几条聊天信息
    this.autoscroll = true;     // 默认自动滚屏
    this.isautoclear = 1;    // 默认自动清屏
    this.bgifs = 1;          // 礼物滚屏计数器
    this.gtime = 0;          // 物滚屏计时器
    this.rspeed = 1;        // 礼物滚屏速度
    this.colors = new Array("FF0000", "800080", "000080", "800000", "008080", "FF8C00");// 礼物颜色库
    this.icolor = '#ff0000';// 礼物默认颜色
    // 军衔
    this.titles = {
        1: '',
        2: '',
        3: '',
        4: '',
        5: '',
        6: '',
        7: '',
        8: '',
        9: '',
        10: '',
        11: '',
        12: '',
        13: '',
        14: '',
        15: '',
        16: '',
        17: '',
        18: '',
        19: '',
        20: '',
        21: '',
        22: ''
    };
    // 爵位
    this.vips = {1: '贵宾', 2: '绅士', 3: '骑士', 4: '领主', 5: '勋爵', 28: '元勋', 29: '元帅', 30: '元首'};
    this.$ = document.getElementById(o);
    this.$scrollEle = $scroll
    this.kw_filter = null;
    this.maxGiftNum = 10;
    //初始化聊天框
    this.init();
}
var ImageBase = '';

chat.prototype = {
    // 初始化聊天框高度
    init: function () {
    },
    // 时间
    time: function (time) {
        time = time || new Date().getTime();
        var date = new Date(time);
        var now = (date.getHours() < 10 ? ('0' + date.getHours()) : date.getHours()) + ':'
            + (date.getMinutes() < 10 ? ('0' + date.getMinutes()) : date.getMinutes());
        return now;
    },
    getTimeSpan: function (time) {
        return '<span class="lcTime">' + time + '</span>';
    },
    generateGiftTime: function () {
        return this.getTimeSpan(this.time());
    },
    // 在聊天框中插入内容
    insert: function (info) {
        this.storelastmsg(info);
        this.autoclear();
        this.$.innerHTML += '<li>' + this.generateGiftTime() + info + '</li>';
        this.infosum++;
        this.rolling();
        //window.setTimeout(function () {
        //    self.rolling();
        //}, 1000);
    },
    // 保存最后5条聊天记录
    storelastmsg: function (info) {
        if (this.lastmsg.length >= 0 && this.lastmsg.length < 5) {
            this.lastmsg.push(info);
        } else if (this.lastmsg.length >= 5) {
            this.lastmsg.shift();
            this.lastmsg.push(info);
        }
    },
    // 还原最后5条聊天记录
    restorelastmsg: function () {
        if (this.lastmsg.length > 0) {
            for (var i = 0; i < this.lastmsg.length; i++) {
                this.$.innerHTML += '<li><div class="message_block">' + this.getTimeSpan(this.time()) + '&nbsp;&nbsp;' + this.lastmsg.shift() + '</div></li>';
            }
        }
        this.rolling();
    },
    // 用户清屏
    userclear: function () {
        this.$.innerHTML = '';
        this.infosum = 0;
    },
    // 自动清屏
    autoclear: function () {
        if ((this.infosum > 50 || this.$.scrollHeight > document.body.clientHeight * 5) && this.isautoclear == 1) {
            this.userclear();
            this.restorelastmsg();
        }
    },
    // 滚屏
    rolling: function () {
        if (this.autoscroll) {
            this.$scrollEle[0].scrollTop = this.$scrollEle[0].scrollHeight - 5;
        }
    },
    // 小礼物
    sgift: function (text, img, sum, unit) {
        var sgimg = '';
        var showsum = sum > 50 ? 50 : sum;
        for (var i = showsum; i > 0; i--) {
            sgimg += img;
        }
        if (showsum > 18) {
            this.insert(text + '&nbsp;' + sgimg + '&nbsp;共' + sum + unit);
        } else {
            this.insert(text + '&nbsp;' + sgimg);
        }
        sgimg = showsum = null;
        this.rolling();
    },
    // 大礼物
    bgift: function (text, img, sum, unit) {
        var self = this;
        this.icolor = this.colors[Math.floor(Math.random() * this.colors.length)];
        if (this.bgifs > sum) {
            window.clearTimeout(this.gtime);
            this.bgifs = 1;
            return;
        }
        this.insert('<span style="color:' + this.icolor + '">' + text + '&nbsp;' + img + '第' + this.bgifs + unit + '</span>');
        this.bgifs++;
        this.gtime = window.setTimeout(function () {
            self.bgift(text, img, sum, unit);
        }, self.rspeed);
    },
    getGiftEle: function (gift) {
        var showImg = '';
        var count = gift.sum > this.maxGiftNum ? this.maxGiftNum : gift.sum;
        if (gift.type == 'S') {
            for (var i = 0; i < count; i++) {
                showImg += '<span class="gift"><img src="' + gift.img + '" height="20"/></span>';
            }
        }
        else if (gift.type == 'B') {
            for (var i = 0; i < count; i++) {
                showImg += '<span class="gift"><img src="' + gift.img + '" height="40"/></span>';
            }
        }
        var text = '<div class="lcWord">';
        if (gift.tou||gift.to_user) {
            var receiverData = gift.to_user;
            var toGid = this.getCodeStr(receiverData)
        }
        var senderInfo = gift.fromu || gift.from_user;
        var senderIcons = this.getIconStr.call(this, senderInfo);
        var isFromMe = false;
        if (gift.from_user.uid == userpara.uid) {
            isFromMe = true;
        }
        var senderEle = this.getUserNameEle(senderInfo, isFromMe);
        var receiverIcons = this.getIconStr.call(this, receiverData);
        text += senderIcons +
        senderEle +
        ' 送给 ' + receiverIcons + '<span class="yellow"><a href="javascript:void(0)" onClick=' +
        this.handleUserNameClick(gift.to_user.uid) +
        '>' + this.getName(gift.to_user.uid == userpara.uid, gift.to_user.nickname) + toGid + '</a></span>：<span class="pink">' + gift.sum + gift.unit + gift.gift_name + '</span>';
        var info = text + '&nbsp;' + showImg + '</div>';
        return info;
    },
    // 显示礼物
    disgift: function (gift) {
        this.giftInfo = this.getGiftEle(gift);
        this.insert(this.giftInfo);
    },
    isNiceCode: function (nicegid) {
        return Number(nicegid) != 0 && String(nicegid).length < 8;
    },
    getNiceCodeIcon: function () {
        return '<em class="lhIco"></em>';
    },
    getName: function (isMe, name) {
        return isMe ? '我' : name;
    },
    getUserNameEle: function (info, isMe) {
        var niceGidEle = this.getCodeStr(info);
        var color = this.isNiceCode(info.nicegid) ? 'purple' : 'green'
        var strTxt = '<span class="' +
            color +
            '">' +
            '<a class="user_name" href="javascript:void(0)" onClick=' +
            this.handleUserNameClick(info.uid) +
            '>' + this.getName(isMe, info.nickname) + niceGidEle + '</a></span>';
        return strTxt;
    },
    // 人员进出房间
    disinout: function (info) {
        if (info.type != 1) { //只显示进入房间信息
            return;
        }
        var strEnd = (info.type == 1) ? '进入房间</div>' : '离开房间</div>';
        var strStart = (info.type == 1) ? '<div class="lcWord">欢迎 ' : '<div class="lcWord">欢送 ';
        var strCar = '';
        if (parseInt(info.car_id) > 0) {
            strCar = info.carmsg;
            strEnd = '</div>';
        }
        var strTxt = this.getUserNameEle(info);
        this.insert(this.getIconStr.call(this, info, strStart, strTxt + strCar + strEnd))
    },
    /**
     * Description: get user's icon info ele
     *
     * @method getIconStr
     */
    getIconStr: function (info, start, end) {
        end = end || '';
        start = start || '';
        function isAnchorRule() {
            return (UserIdentity.isAnchor(info) && (info.vip.length > 1 || info.vip == 0));
        }

        var consumeGrade = isAnchorRule() ? '' : '<i class="jwIco V' + info.vip + '"></i>';
        var strVip = Number(info.vip2) ? '<i class="vipIco"></i>' : '';
        var strAdmin = UserIdentity.isManager(info) ? '<i class="manageIco"></i>' : '';
        var strWatchman = UserIdentity.isWatchman(info) ? '<i class="xunIco"></i>' : '';
        var isAnchor = UserIdentity.isAnchor(info);
        var strAnchor = isAnchor ? '<i class="zhuboIco zb' + info.starlevel + '"></i>' : '';
        var strFamily = info.family_sign != "" ? '<i class="clubIcoText"><em>' + info.family_sign + '</em></i>' : '';
        var infoEnd = end;
        var strFull = start
        if (info.level == 1) {//游客
            strFull += ''
        } else if (UserIdentity.isWatchman(info)) {//watchman
            strFull += strWatchman
        } else if (UserIdentity.isAnchor(info)) {//anchor
            strFull += strAnchor + consumeGrade + strVip + strFamily
        } else {
            strFull += consumeGrade + strVip + strAdmin + strFamily
        }
        return strFull + infoEnd
    },
    getSenderSpan: function (my_css, chatdata, senderGid) {
        return '<span class="' + my_css + '"><a href="javascript:void(0)" onClick=' +
            this.handleUserNameClick(chatdata.from_user.uid) +
            '>' + chatdata.from_user.nickname + senderGid + '</a></span> ';
    },
    getCodeStr: function (info) {
        return uu89pub.isNiceCode(info.nicegid) ? '(<u class="yellow">' + info.nicegid + '</u>)<i class="lhIco"></i>' : '(' + info.uid + ')';
    },
    handleUserNameClick: function (touid) {
        return '"select_it(event,' + this.chat_type + ',' + touid + ')"';
    },
    display_chatmessage: function (chatdata) {
        if (this.kw_filter) {
            chatdata.message = chatdata.message.replace(this.kw_filter, '***');
        }
        chatdata.message=SiteCommon.decodeSign(chatdata);
        var start = '<div class="lcWord">';
        var infoSender = chatdata.fromu.appdata;
        var isToAll = chatdata.to_all;
        if (!isToAll) {
            var infoReceiver = chatdata.tou.appdata;
            var receiverCodeStr = this.getCodeStr(infoReceiver);
        }
        var my_css = "cyan";
        var to_css = "cyan";
        var msg_css = "white";
        var senderGid = this.getCodeStr(infoSender);
        if (chatdata.is_my) {
            my_css = "yellow";
        } else {
            if (UserIdentity.isAnchor(chatdata.fromu.appdata)) {
                my_css = "pink";
                if (chatdata.is_my_to && chatdata.secret) {
                    msg_css = "orange";
                }
            }
        }
        if (chatdata.is_my_to) {
            to_css = "yellow";
        } else {
            if (!isToAll && UserIdentity.isAnchor(chatdata.tou.appdata)) {
                to_css = "pink";
            }
        }
        if (!chatdata.is_my && !chatdata.is_my_to) {
            to_css = "yellow";
        }
        var strChat = ''
        var strSender = ''
        if (isToAll) {
            strChat +=
                this.getSenderSpan("greenLight", chatdata, senderGid) +
                ' 说:<span class="' + msg_css + '">' + chatdata.message + '</span>';
        }
        else {
            var receiverIcons = this.getIconStr.call(this, infoReceiver);
            strSender = this.getSenderSpan(my_css, chatdata, senderGid);
            var strReceiver = '<span class="' + to_css + '"><a href="javascript:void(0)" onClick=' +
                this.handleUserNameClick(chatdata.to_user.uid) +
                '>' + chatdata.tou.appdata.nickname + receiverCodeStr + '</a></span>';
            var strChatContent = '说:<span class="' + msg_css + '">' + chatdata.message + '</span>';
            var strPrivate = ''
            if (chatdata.secret) {
                strPrivate = '[悄悄的]';
            }
            strChat += strSender
            + '对' +
            receiverIcons +
            strReceiver +
            strPrivate +
            strChatContent;
            strChat += '</div>';
        }
        this.insert(this.getIconStr.call(this, infoSender, start, strChat))
    }
};
function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 15; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}
function select_it(event, type, param) {
    var e = event || window.event;
    var scrollX = document.documentElement.scrollLeft || document.body.scrollLeft;
    var scrollY = document.documentElement.scrollTop || document.body.scrollTop;
    var x = e.pageX || e.clientX + scrollX;
    var y = e.pageY || e.clientY + scrollY;
    if (!isNaN(param)) {
        chat_zone_display_user_memu(type, x, y, param);
    }
}