/**
 * Provides chat interaction
 *
 * @module Policy Objects
 * @method CalcRank
 * compare ranks of different users' order
 */
function calcRank(appdata) {
    var score = 0;
    var numVip = Number(appdata.vip);
    if (Number(appdata.watchman)) {
        score = 1048576 * 7;//0x40000,1<<18
    }
    if (numVip && numVip < 100) {
        score += numVip * 524288;//0x100000
    }
    if (Number(Number(numVip) && numVip >= 100)) {
        score += numVip / 100 * 131072;//0x100000
    }
    if (appdata.vip2 > 0) {
        score += 262144;//0x20000,1<<17
    }
    if (uu89pub.isNiceCode(appdata.nicegid)) {
        score += String(appdata.nicegid).length;
    }
    if (appdata.level == 3) {
        score += Number(appdata.level);
    }
    return score;
}
/**
 * Description:
 *
 * @module Policy Objects
 * @class userPopMenuMap
 */
var userPopupMenuMap = {
    anchor: [
        [true, true, true, true, true, true, true],
        [true, true, true, true, true, true, true],
        [true, true, true, true, true, true, false],
        [true, true, true, true, true, true, true],
        [false, false, true, false, false, true, false],
        [false, false, true, false, false, true, false],
        [false, false, true, false, false, true, false],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false]
    ],
    manager: [
        [true, true, true, true, true, true, true],
        [true, true, true, true, true, true, true],
        [true, true, true, true, true, true, false],
        [true, true, true, true, true, true, true],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, true, false],
        [false, false, false, false, false, true, false],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false]
    ],
    folkWatchman: [
        [true, true, true, true, true, true, true],
        [true, true, true, true, true, true, true],
        [true, true, true, true, true, true, false],
        [true, true, true, true, true, true, true],
        [false, false, false, false, false, false, false],
        [false, true, true, false, false, true, false],
        [false, true, true, false, false, true, false],
        [false, true, true, false, false, false, false],
        [false, true, true, false, false, true, false],
        [false, true, true, false, false, true, false]
    ],
    watchman: [
        [true, true, true, true, true, true, true],
        [true, true, true, true, true, true, true],
        [true, true, true, true, true, true, false],
        [true, true, true, true, true, true, true],
        [false, false, false, false, false, false, false],
        [false, true, true, true, false, true, false],
        [false, true, true, true, false, true, false],
        [false, true, false, false, false, false, false],
        [false, true, true, true, false, true, false],
        [false, true, true, true, false, true, false]
    ],
    smallConsumer: [
        [true, true, true, true, true, true, true],
        [true, true, true, true, true, true, true],
        [true, true, true, true, true, true, false],
        [true, true, true, true, true, true, true],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false]
    ],
    tourist: [
        [true, true, true, true, true, true, true],
        [true, true, true, true, true, true, true],
        [true, true, true, true, true, true, true],
        [true, true, true, true, true, true, true],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false],
        [false, false, false, false, false, false, false]
    ]
}
/**
 * Description: Rendering users list
 *
 * @class User
 * @static
 * @param {Number} uid {Number} level {Object} appdata
 * @example
 *  var user = new User(32035941,4,{...});
 *
 */
function User(uid, level, appdata) {
    this.uid = uid;
    this.level = level;
    this.init_level = level;
    this.appdata = appdata;
    this.rank = calcRank(appdata);
}
/**
 * Description:
 *
 * @module View Objects
 * @class User
 * @constructor
 */
User.prototype = {
    hint: function () {
        //return this.appdata.nickname;
        var s;
        s = '<li';
        if (uu89pub.isNiceCode(this.appdata.nicegid)) {
            s += ' class="lianghao"';
        }
        s += '><div class="lvlName"><span>' + this.appdata.nickname + '</span><i>(' + this.appdata.nicegid + ')';
        if (uu89pub.isNiceCode(this.appdata.nicegid)) {
            s += uu89pub.getNiceCodeIcon();
        }
        s += '</i></div>';
        s += '<div class="lmlInfor">';
        return uu89pub.getIconStr.call(uu89pub, this.appdata, s, '</div></li>');
    },
    IsAdmin: function () {
        var obj = {
            level: this.level
        }
        return UserIdentity.isManager(obj) || UserIdentity.isWatchman(obj) || UserIdentity.isAnchor(obj)
    },
    Selected: function () {
        if ($("#message_to option[value='" + this.uid + "']").length === 0) {
            $("#message_to").append(new Option(this.appdata.nickname, this.uid))
        }
        $("#message_to").val(this.uid);
        g_UserList.UserSelected(this.uid);
    },
    isRoomManager: function (level) {
        return this.IsAdmin() || UserIdentity.isAnchor({level: level});
    },
    AddToMemberListUI: function (before_user, level) {
        var CB_Para = this;
        var element = $("<li>").attr({
            'class': 'J_user ', id: this.uid
        }).data('level', level).append(this.hint()).click(function (e) {
            var cb_para = CB_Para;
            cb_para.DisplayMenu(cb_para, e.pageX, e.pageY);
        });
        if (before_user != null) {
            $("#" + before_user.uid).before(element);
        } else {
            var room_member_list = '#con_th_1';
            $(room_member_list).append(element);
        }
    },
    getUserIdentity: function (data) {
        if (!Object.keys) {
            Object.keys = function (obj) {
                var keys = [];
                for (var i in obj) {
                    if (obj.hasOwnProperty(i)) {
                        keys.push(i);
                    }
                }
                return keys;
            };
        }
        var arr = Object.keys(UserIdentity)
        var identity = '', index = 0, isMe = false
        $.each(arr, function (i, n) {
            if (UserIdentity[n](data)) {
                if (i == 0) {
                    isMe = true
                } else {
                    identity = n
                    index = i
                    return false
                }
            }
        })
        return {
            identity: identity,
            index: index,
            isMe: isMe
        }
    },
    showAuthorityMenu: function (data) {
        var $JMenu = $('.J_menu');
        var $JMenuA = $JMenu.find('a');
        $JMenuA.hide()
        //userpara.level=5
        var pagerOwnerIdentity = this.getUserIdentity(userpara);
        var clickedUserIdentity = this.getUserIdentity(data)
        var arr = Object.keys(userPopupMenuMap)
        var curGroup = arr[pagerOwnerIdentity.index - 1]
        var curLogic = userPopupMenuMap[curGroup]
        var columnIndex = clickedUserIdentity.isMe ? 0 : clickedUserIdentity.index;
        $.each(curLogic, function (i, n) {
            if (i == 3) {// not display folk watchman
                return
            }
            if (n[columnIndex]) {
                var menuItem = $JMenuA.eq(i);
                if (i == 4) {//manger text display
                    if (clickedUserIdentity.index == 2) {
                        menuItem.text('取消管理')
                    } else {
                        menuItem.text('加管理')
                    }
                }
                menuItem.css('display', 'inline-block')
            }
        })
    },
    DisplayMenu: function (para, x, y) {
        g_UserList.menu_selected_uid = para.uid;
        this.ControlMenuItem(para);
        var userMenu = $(".userMenu");
        var info = '<h2><stro' +
            'ng>' + para.appdata.nickname + '</strong><span>' +
            uu89pub.getCodeStr(para.appdata) +
            '</span></h2>';
        info += uu89pub.getIconStr.call(uu89pub, para.appdata, '<p>', '</p>');
        info += '</p><span class="umInforCorner"></span>';
        $(".umInfor").html(info);
        viewHeight = $(window).height();
        $(userMenu).css({"display": "block", "left": x + 10, "top": y + 10});
        this.showAuthorityMenu(para.appdata);
        if (y + 10 < viewHeight) {
            $(userMenu).css({"left": x + 10, "top": y + 10});
        } else {
            $(userMenu).css({"left": x + 10, "top": 315});
        }
    },
    ControlMenuItem: function (para) {
        var ADMIN_LEVEL = 900;
        if (xMessager.level == 2000) {
            if (xMessager.uid != para.uid) {
                if (para.level == ADMIN_LEVEL) {
                    $('.m_setadmin').text('把Ta的管理取消');
                }
                else {
                    $('.m_setadmin').text('把Ta设置为管理');
                }
                this.menu_id = '#MemberMenu_Roomer';
            }
            else {
                this.menu_id = '#MemberMenu';
            }
            return;
        }
        if (xMessager.level < ADMIN_LEVEL) {
            this.menu_id = '#MemberMenu';
            return;
        }
        if (xMessager.level >= ADMIN_LEVEL && xMessager.level > para.level) {
            this.menu_id = '#MemberMenu_Admin';
        }
        else {
            this.menu_id = '#MemberMenu';
        }
    },
    RemoveFromListUI: function () {
        var uid = this.uid;
        $("#" + uid).remove();
        $("#a_" + uid).remove();
        $.each($('#message_to option'), function (i, n) {
            if ($(n).val() == uid) {
                $(n).remove()
                return false
            }
        })
    }
};
function chat_zone_display_user_memu(type, x, y, uid) {
    //alert(type+','+x+','+y+','+uid);
    var u = g_UserList.GetUser(uid);
    //$(this).click(function(event){
    if (u) {
        u.DisplayMenu(u, x, y);
    }
}
/**
 * @description handling user popup panel
 * @class chat_panel
 * */
var chat_panel = {
    menu_flag: 0,
    init: function () {
        $("#message_btn").click(function (event) {
            sendChatToSwf($("#message_input"));
        });
        $("#message_to").change(function () {
            g_UserList.UserSelected(parseInt($(this).val()));
        });
        function sendChatToSwf($ele) {
            xMessager.message($ele.val(), Number($("#secret_check").is(':checked')));
            $ele.val("");
        }

        SiteCommon.setChatDialog($("#message_input"), function ($ele) {
            sendChatToSwf($ele);
        });
        $("#m_gift").click(function (event) {
            chat_panel.set_gift_target();
            chat_panel.HideMenu();
        });
        $("#m_chat").click(function (event) {
            chat_panel.selected(false);
            chat_panel.HideMenu();
        });
        $("#m_chat_p").click(function (event) {
            chat_panel.selected(true);
            chat_panel.HideMenu();
        });
        $("#m_freeflower").unbind('click').click(function (event) {
            xMessager.freeflower();
            chat_panel.HideMenu();
        });
        /**
         * Description: bind disabling chat item click event
         *
         * @event
         */
        $("#m_disable_chat").unbind('click').click(function () {
            xMessager.disablechat();
            chat_panel.HideMenu();
        });
        $("#m_kick").unbind('click').click(function (event) {
            xMessager.kickout();
            chat_panel.HideMenu();
        });
        $("#m_setadmin").unbind('click').click(function (event) {
            xMessager.setAdmin();
            chat_panel.HideMenu();
        });
        $(".m_close").click(function (event) {
            chat_panel.HideMenu();
        });
    },
    HideMenu: function () {
        $(".userMenu").hide();
        //$("#MemberMenu_Admin").hide();
        //$("#MemberMenu_Roomer").hide();
    },
    set_menu_flag: function (flag) {
        var d = new Date();
        this.menu_flag = flag;
    },
    get_menu_flag: function () {
        return this.menu_flag;
    },
    selected: function (secret) {
        var uid = g_UserList.menu_selected_uid;
        var u = g_UserList.GetUser(uid);
        if (!u) {
            return;
        }
        if ($("#message_to option[value='" + uid + "']").length == 0) {
            //$("#message_to").append(new Option(u.appdata.nickname,uid));
            var objOption = document.createElement("OPTION");
            objOption.text = u.appdata.nickname;
            objOption.value = uid;
            document.getElementById("message_to").options.add(objOption);
        }
        $("#message_to").val(uid);
        if (secret) {
            $("#secret_check").prop("checked", true);
        }
        else {
            $("#secret_check").prop("checked", false);
        }
        g_UserList.UserSelected(uid);
    },
    set_gift_target: function () {
        var uid = g_UserList.menu_selected_uid;
        var u = g_UserList.GetUser(uid)
        if (u) {
            SetGiftRX(uid, u.appdata.nickname);
        }
    }
};
Array.prototype.insert = function (index, item) {
    this.splice(index, 0, item);
};
Array.prototype.remove = function (from, to) {
    var rest = this.slice((to || from) + 1 || this.length);
    this.length = from < 0 ? this.length + from : from;
    return this.push.apply(this, rest);
};
/**
 * Description: Controlling business logic of users
 *
 * @class g_UserList
 * @static
 */
var g_UserList = {
    members: {},
    member_ui_array: [],
    selected_uid: 0,
    menu_selected_uid: 0,
    admin_count: 0,
    GetUser: function (userInfo, field) {
        if (typeof userInfo === 'string' || typeof userInfo === 'number') {
            if (userInfo in this.members) {
                return this.members[userInfo];
            }
            return null;
        } else {
            var info = userInfo[field];
            return {
                appdata: info
            }
        }
    },
    GetSelectedUser: function () {
        if (this.selected_uid == 0) {
            return null;
        }
        return this.members[this.selected_uid];
    },
    UserSelected: function (uid) {
        this.selected_uid = uid;
        if ($('#message_to').val() == 0) {
            $('#secret_check').attr('disabled', 'disabled').removeAttr('checked')
        } else {
            $('#secret_check').removeAttr('disabled')
        }
    },
    isDominated: function (curUserData, newUserData) {
        //todo to modify or del when CalcRank method not effect
        var toBeInsert = false
        // anchor first
        if (UserIdentity.isAnchor(curUserData.appdata)) {
            toBeInsert = false
        } else if (UserIdentity.isAnchor(newUserData) ||
            newUserData.watchman > 0 ||//    is watchman
            newUserData.vip > curUserData.vip ||//peerage
            newUserData.rank > curUserData.rank
            || (newUserData.rank == curUserData.rank && newUserData.nicegid < curUserData.appdata.nicegid)// nice code comparation
        ) {
            toBeInsert = true
        }
        return toBeInsert;
    },
    UserIn: function (user) {
        this.members[user.uid] = user;
        var before_u = null;
        var arrayLength = this.member_ui_array.length;
        for (var i = 0; i < arrayLength; i++) {
            var curUserData = this.member_ui_array[i];
            var newUserData = user.appdata;
            newUserData.rank = user.rank
            var toBeInsert = this.isDominated(curUserData, newUserData);
            if (toBeInsert) {
                before_u = curUserData;
                this.member_ui_array.insert(i, user);
                break;
            }
        }
        user.AddToMemberListUI(before_u, user.level);
        if (before_u == null) {
            this.member_ui_array.push(user);
        }
        $('#user_count').html('(' + this.member_ui_array.length + ')');
        if (user.IsAdmin()) {
            this.admin_count += 1;
            $('#admin_count').html('(' + this.admin_count + ')');
        }
    },
    UserOut: function (uid) {
        if (this.members[uid] == null) {
            return;
        }
        this.members[uid].RemoveFromListUI();
        var arrayLength = this.member_ui_array.length;
        for (var i = 0; i < arrayLength; i++) {
            var u = this.member_ui_array[i];
            if (uid == u.uid) {
                this.member_ui_array.remove(i);
                break;
            }
        }
        if (this.members[uid].IsAdmin()) {
            this.admin_count -= 1;
            $('#admin_count').html('(' + this.admin_count + ')');
        }
        delete this.members[uid];
        $('#user_count').html('(' + this.member_ui_array.length + ')');
    },
    ChangeLevel: function (uid, level) {
        if (this.members[uid] == null) {
            return;
        }
        this.members[uid].level = level;
        //this.members[uid].RefeshUI();
    },
    Clear: function () {
        for (var uid in this.members) {
            this.UserOut(uid);
        }
        this.members = {};
        this.member_ui_array = [];
    }
};
/**
 * Description: communication with server when chatting
 *
 * @class persist
 * @deprecated Use xchat_swf.disablechat
 * instead
 */
var persist = {
    url: '',
    alertOperationState: function (result) {
        var r = result;
        if (r.result == 1) {
            alert('操作失败');
        } else if (r.result == 0) {
            alert('操作成功！');
        }
    },
    doit: function (type, room_id, touid) {
        var data = {
            'type': type,
            'uid': touid,
            'room_id': room_id
        };
        $.post(this.url, data, function (result) {
            this.alertOperationState(result);
        })
            .fail(function () {
                alert('操作发生错误！');
            });
    },
    fav: function (room_id) {
        this.doit(10, room_id, 0);
    },
    disablechat: function (room_id, touid) {
        this.url = '/room/disableChat';
        this.doit(5, room_id, touid);
    },
    kickout: function (room_id, touid) {
        this.url = '/room/kickOut';
        this.doit(3, room_id, touid);
    },
    setadmin: function (room_id, touid, be_admin) {
        this.url = '/room/setAdmin';
        if (be_admin) {
            this.doit(1, room_id, touid);
        }
        else {
            this.doit(0, room_id, touid);
        }
    }
};
/**
 * handle chat messages
 * @class xMessager
 * */
var xMessager = {
    logined: false,
    room_id: 0,
    uid: 0,
    level: 0,
    param: {},
    nickname: '',
    chatdisable: 0,
    init: function (param) {
        this.uid = param.uid;
        this.room_id = param.room_id;
        this.level = param.level;
        this.nickname = param.nickname;
        this.chatdisable = param.chatdisable;
        this.param = param;
        if (this.chatdisable > 0) {
            window.setTimeout(function () {
                message_display.prv('<font class="warning">你的禁止发言已经解除!</font>');
                xMessager.chatdisable = 0;
            }, this.chatdisable * 60 * 1000);
        }
    },
    SocketError: function () {
        if (!xMessager.logined) {
            //message_display.prv('<font class="warning">连接服务器失败！</font>');
        }
        else {
            //message_display.prv('<font class="warning">与服务器的连接断开了，请重新登入房间！</font>');
        }
        message_display.prv('<font class="warning">玩命加载中，请稍后。。。</font>');
        g_UserList.Clear();
        //xchat_start();
    },
    OnChat: function (chatdata) {
        var is_my_message = false;
        if (chatdata.from_user.uid == this.uid) {
            is_my_message = true;
            chatdata.from_user.nickname = "我";
            chatdata.is_my = true;
        }
        if (chatdata.to_user.uid == this.uid) {
            is_my_message = true;
            chatdata.to_user.nickname = "我";
            chatdata.is_my_to = true;
        }
        chatdata.fromu = g_UserList.GetUser(chatdata, 'from_user');
        if (!$.isEmptyObject(chatdata.to_user)) {
            chatdata.tou = g_UserList.GetUser(chatdata, 'to_user');
        }
        message_display.chat(chatdata, is_my_message);
    },
    OnFreeFlower: function (data) {
        var is_my_message = false;
        if (data.fromwho.uid == this.uid || data.sendwho.uid == this.uid) {
            is_my_message = true;
        }
        message_display.freeflower(data, is_my_message);
    },
    OnGift: function (data) {
        message_display.gift(data);
        gift_center.show_gift(data.type, data.gift_swf, data.sum, data.gift_swf_life, data);
        if (data.from_user.uid == room_owner_uid || data.to_user.uid == room_owner_uid) {
            load_room_data(data.to_user.uid);
        }
    },
    OnSpeaker: function (data) {
        //console.log('OnSpeaker');
        load_speak_data();
    },
    OnAnchorFans: function (data) {
        //console.log('OnAnchorFans');
        load_anchor_fans();
    },
    OnBanner: function (data) {
        SiteCommon.marqueeGift.feedMessage(data);
    },
    OnSetAdmin: function (param) {
        if (this.level == 2000) {
            return;
        }
        if (param == 1) {
            message_display.prv('<font class="warning">你被房主设置为房间管理员了，将重新进入房间改变身份！</font>');
        }
        else {
            message_display.prv('<font class="warning">你的房间管理员身份被房主取消了，将重新进入房间改变身份！</font>');
        }
        setTimeout(function () {
            location.reload(true);
        }, 5000);
    },
    OnData: function (data) {
        switch (data.type) {
            case 'C':
                this.OnChat(data.data);
                break;
            case 'F':
                this.OnFreeFlower(data.data);
                break;
            case 'G':
                data.data.fromu = data.data.from_user
                data.data.tou = data.data.to_user;
                if (data.data.room_info.room_id == room_id) {
                    this.OnGift(data.data);
                }
                if (data.data.source) {
                    this.OnBanner(data.data);
                }
                break;
            case 'LS':
                this.OnSpeaker(data.data);
                break;
            case 'AFANS':
                this.OnAnchorFans(data.data);
                break;
            case 'ROOM_SET_ADMIN':
                this.OnSetAdmin(data.data);
                break;
        }
    },
    message: function (msg, secret) {
        if (!this.logined) {
            return;
        }
        if (msg == "") {
            return;
        }
        if (UserIdentity.isTourist(this)) {
            checklogin();
            return;
        }
        if (this.chatdisable > 0) {
            alert('你目前处于禁止发言状态，不能发言！');
            return;
        }
        var chatdata = {
            to_uid: g_UserList.selected_uid,
            secret: secret,
            message: SiteCommon.encodeSpecialSign(msg)
        };
        var selected_user = g_UserList.GetSelectedUser();
        var data = {
            type: 'C',
            data: chatdata
        };
        var to_uid = g_UserList.selected_uid;
        if (!secret) {
            to_uid = 0;
        }
        xchat_swf.send(to_uid, Base64.encode(JSON.stringify(data)));
    },
    freeflower: function () {
        if (this.level < 100) {
            //alert('游客不能免费献花！');
            checklogin();
            return;
        }
        var my_u = g_UserList.GetUser(this.uid);
        var to_u = g_UserList.GetUser(g_UserList.menu_selected_uid);
        if (my_u && to_u) {
            var data = {
                type: 'F',
                data: {
                    fromwho: {gid: my_u.appdata.gid, nickname: my_u.appdata.nickname},
                    sendwho: {gid: to_u.appdata.gid, nickname: to_u.appdata.nickname}
                }
            }
            xchat_swf.send(0, Base64.encode(JSON.stringify(data)));
        }
    },
    disablechat: function () {
        var mins = 5;
        var from_u = g_UserList.GetUser(this.uid);
        var to_u = g_UserList.GetUser(g_UserList.menu_selected_uid);
        if (Number(to_u.appdata.watchman)) {
            $("#returnmsg").html('小样，对巡管操作，想造反么。。。');
            $("#tips02Pop .pinkBtn").removeAttr("onclick");
            $("#tips02Pop .pinkBtn").click(function () {
                $("#tips02Pop .popPubClose")[0].click();
            });
            $("#tips02").click();
            return;
        }
        if (to_u.appdata.vip2 && (!UserIdentity.isAnchor(from_u.appdata) && !from_u.appdata.watchman)) {
            $("#returnmsg").html('用户享有<img src="/images/room/vip/vip.gif" style="width:27px;height:15px">，无法操作');
            $("#tips02Pop .pinkBtn").removeAttr("onclick");
            $("#tips02Pop .pinkBtn").click(function () {
                $("#tips02Pop .popPubClose")[0].click();
            });
            $("#tips02").click();
            return;
        }
        if (to_u) {
            //todo to del because xchat_swf.disablechat is responsible to communicate with server
            persist.disablechat(this.room_id, to_u.uid);
            xchat_swf.disablechat(to_u.uid, mins);
        }
    },
    kickout: function () {
        var from_u = g_UserList.GetUser(this.uid);
        var to_u = g_UserList.GetUser(g_UserList.menu_selected_uid);
        if (Number(to_u.appdata.watchman)) {
            $("#returnmsg").html('小样，对巡管操作，想造反么。。。');
            $("#tips02Pop .pinkBtn").removeAttr("onclick");
            $("#tips02Pop .pinkBtn").click(function () {
                $("#tips02Pop .popPubClose")[0].click();
            });
            $("#tips02").click();
            return;
        }
        if (to_u.appdata.vip2 && (!from_u.appdata.roomer && !from_u.appdata.watchman)) {
            $("#returnmsg").html('用户享有<img src="/images/room/vip/vip.gif" style="width:27px;height:15px">，无法操作');
            $("#tips02Pop .pinkBtn").removeAttr("onclick");
            $("#tips02Pop .pinkBtn").click(function () {
                $("#tips02Pop .popPubClose")[0].click();
            });
            $("#tips02").click();
            return;
        }
        if (to_u) {
            persist.kickout(this.room_id, to_u.uid);
            xchat_swf.kickout(to_u.uid);
        }
    },
    setAdmin: function () {
        var to_u = g_UserList.GetUser(g_UserList.menu_selected_uid);
        if (to_u) {
            var be_admin = (to_u.level != 3 ? 1 : 0);
            //persist.setadmin(this.room_id, to_u.uid, be_admin);
            var data = {
                type: 'ROOM_SET_ADMIN',
                data: be_admin,
                to_uid: to_u.uid
            }
            xchat_swf.send(to_u.uid, Base64.encode(JSON.stringify(data)));
        }
    },
    giftmessage: function (type, param, banner) {
        var data = {
            type: 'G',
            data: param
        }
        xchat_swf.send(0, Base64.encode(JSON.stringify(data)));
        if (banner == 'B') {
            var data = {
                type: 'BANNER'
            }
            xchat_swf.send(-1, Base64.encode(JSON.stringify(data)));
        }
    },
    speakermessage: function (data) {
        //var data = {
        //    type: 'LS',
        //    data: param
        //}
        xchat_swf.broadcast(Base64.encode(JSON.stringify(data)));
    },
    anchorfans: function () {
        var data = {
            type: 'AFANS'
        }
        xchat_swf.send(0, Base64.encode(JSON.stringify(data)));
    },
    ReEnter: function () {
        message_display.prv('<font class="warning">你已被同一账号挤出本房间！</font>');
    },
    LoginACK: function (param) {
        if (param.loginack == 0) {
            switch (param.reason) {
                case 2:
                    message_display.prv('<font class="warning">服务器人数满了！</font>');
                    break;
                case 3:
                    message_display.prv('<font class="warning">房间人数满了！</font>');
                    break;
            }
        }
    }
};
/**
 * Description: display messages on screen
 *
 * @class message_display
 * @static
 */
var message_display = {
    /**
     * Description: insert
     *
     * @
     * @
     */
    prv: function (msg) {
        uu89prv.insert(msg);
    },
    pub: function (msg) {
        uu89pub.insert(msg);
    },
    chat: function (chatdata, is_my_message) {
        if (is_my_message) {
            uu89prv.display_chatmessage(chatdata);
            if (chatdata.secret == 0) {
                uu89pub.display_chatmessage(chatdata);
            }
        }
        else {
            uu89pub.display_chatmessage(chatdata);
        }
    },
    freeflower: function (data, is_my_message) {
        if (is_my_message) {
            document.getElementById('chat_prv').contentWindow.FreeFlower(data);
        }
        else {
            document.getElementById('chat_pub').contentWindow.FreeFlower(data);
        }
    },
    gift: function (data) {
        var is_my_message = false;
        if (data.from_user.uid == userpara.uid || data.to_user.uid == userpara.uid) {
            is_my_message = true;
        }
        uu89pub.disgift(data);
        if (is_my_message) {
            uu89prv.disgift(data);
        }
    }
}
/**
 * Interacting between Js and Flash
 * @class xchat_swf

 * */
var xchat_swf = {
    videoSwf: null,
    /**
     * Init interaction event
     *
     * @method Init
     * @return {Undefined}
     * @example
     *    xchat_swf.Init(xconf_swf_param,'xchat',null);
     * */
    Init: function (swf_param, div_id, callbackFn) {
        if (callbackFn == null) {
            callbackFn = this.Created_cb;
        }
        var swfVersionStr = "11.0.0";
        // To use express install, set to playerProductInstall.swf, otherwise the empty string.
        var xiSwfUrlStr = "playerProductInstall.swf";
        var flashvars = {};
        flashvars = {
            ip: swf_param.ip,
            port: swf_param.port,
            gid: swf_param.room_id,
            uid: swf_param.uid,
            source:0,
            userToken: readcookie("umei_token")
        };
        var params = {};
        params.quality = "high";
        params.bgcolor = "#57799c";
        params.allowscriptaccess = "always";
        params.allowfullscreen = "true";
        params.wmode = "transparent";
        var attributes = {};
        attributes.id = "xchat";
        attributes.name = "xchat";
        attributes.align = "middle";
        attributes.wmode = 'transparent'
        /**
         * Description: embed swf in doc, ref: https://code.google.com/p/swfobject/wiki/documentation
         *
         * @method swfobject.embedSWF
         */
        var dir = SiteCommon.SWF_DIR;
        var swfmame = dir +
            "new_xchat.swf";
        swfobject.embedSWF(
            swfmame, div_id,
            $("#" + div_id).width(), $("#" + div_id).height(),
            swfVersionStr, xiSwfUrlStr,
            flashvars, params, attributes, callbackFn);
        // JavaScript enabled so display the flashContent div in case it is not replaced with a swf object.
        //swfobject.createCSS("#flashContent", "display:block;text-align:center;");
    },
    alertNoSwf: function () {
        alert("flash初始化失败.");
    },
    Created_cb: function (cbobj) {
        if (cbobj.success) {
        }
        else {
            xchat_swf.alertNoSwf();
        }
    },
    swf: function () {
        var swf = this.videoSwf;
        return swf ? swf : (this.videoSwf = swfobject.getObjectById("xchat"))
    },
    send: function (to_uid, data) {
        try {
            this.swf().Chat(to_uid, data);
        } catch (e) {
            alert('房间出现故障')
        }
    },
    disablechat: function (touid, mins) {
        this.swf().DisableChat(touid, mins);
    },
    broadcast: function (dataStr) {
        this.swf().broadcast(dataStr);
    },
    kickout: function (touid) {
        this.swf().Kickout(touid);
    },
    setRoomInfo: function (type, data) {
        this.swf().setRoomInfo(type, data);
    },
    /**
     * Description: prompting when broadcast ends
     *
     * @deprecated Use xchat_swf_message
     * instead
     */
    tokenop: function (type) {
        if (type == '0') {
            this.swf().TokenOp(0);
            $('#live_time').html('开播时间：直播未开始');
        }
        if (type == '1') {
            this.swf().TokenOp(1);
            var currentdate = new Date();
            var datetime = currentdate.getHours() + ":" + currentdate.getMinutes();
            $('#live_time').html('开播时间：' + datetime);
        }
    }
};
function xchat_swf_debug(info) {
}
function xchat_swf_error(Error) {
    xMessager.SocketError();
}
function member_in_out_hint(appdata, type) {
    appdata.type = type;
    uu89pub.disinout(appdata);
}
function handleKickoutState() {
    var kickoutTotalTime = 15;
    var kickoutDuration = Math.ceil(roompara.kickout / 60);
    message_display.prv('<font class="warning">你被管理员踢出了！' +
    kickoutTotalTime +
    '分钟内不允许进入本房间！</font>');
    $(".liveVideo, .noliveVideo").remove();
    $(".J_kickoutVideo").show();
    $('.J_countdown').text(kickoutDuration == 0 ? kickoutTotalTime : kickoutDuration)
    SiteCommon.recursiveUnbind($('body'));
    function changeMinute() {
        $('.J_countdown').text(function (i, n) {
            var num = parseInt(n)
            if (num == 0) {
                clearInterval(countdown)
                location.reload()
            } else {
                return --num
            }
        })
    }

    var countdown = setInterval(function () {
        changeMinute();
    }, 1000 * 60)
}
function displayForbiddenState(param) {
    if (param.uid == xMessager.uid) {
        handleKickoutState();
    }
    else {
        var u = g_UserList.GetUser(param.uid);
        if (u) {
            var s = '<font class="warning">【' + u.appdata.nickname + '(' + u.appdata.uid + ")】被管理员踢出房间了。15分钟内不允许进入本房间。</font>";
            message_display.pub(s);
        }
    }
}
/**
 * Description: called by Flash
 *
 * @method xchat_swf_message_new
 * @param pid {Number}
 * @param param {Object}
 * @example
 *  xchat_swf_message_new(0,{"data":{"nickname":"qcgm1978","touid":0,"to_nickname":"所有人","secret":false,"message":"a","uid":32087767},"type":"C"})
 */
function xchat_swf_message_new(pid, param) {
    switch (pid) {
        case 121:
            if (param.result == 0) {
                message_display.prv('连接服务器成功.');
                message_display.prv('<font color="#FF4444">主播欢迎你:</font>' + room_welcome + '');
                xMessager.logined = true;
                xMessager.uid = param.uid;
            } else if (param.result == 4) {
                handleKickoutState();
            }
            break;
        case 122:
            var user;
            param.gid = param.room_id;
            if (param.in_out_hint) {
                user = new User(param.uid, param.level, param);
                g_UserList.UserIn(user);
                if (parseInt(param.car_id) > 0) {
                    showcar(param);
                } else {
                    member_in_out_hint(param, 1);
                }
            } else {
                user = g_UserList.GetUser(param.uid)
                if (user) {
                    member_in_out_hint(param, 0);
                }
                g_UserList.UserOut(param.uid);
            }
            break;
        case 123:
            if (isTestEnvironment()) {
                generateEmulationUserData(param)
            } else {
                var user = new User(param.uid, param.level, param);
                g_UserList.UserIn(user);
            }
            break;
        case 132:
            xMessager.OnData({"type": "C", "data": param});
            break;
        case 142:
            xMessager.OnData({"type": "G", "data": param});
            break;
        case 151:
            persist.alertOperationState(param)
            break;
        case 152:
            xMessager.OnData({"type": "ROOM_SET_ADMIN", "data": param});
            break;
        case 161:
            break;
        case 162:
            if (param.to_user.uid == xMessager.uid) {
                if (param.chatenable) {
                    message_display.prv('<font class="warning">你的禁止发言已经解除!</font>');
                    xMessager.chatdisable = 0;
                }
                else {
                    message_display.prv('<font class="warning">你被管理员禁止发言5分钟!</font>');
                    xMessager.chatdisable = 1;
                }
            }
            else {
                var u = g_UserList.GetUser(param.to_user.uid);
                if (u) {
                    if (!param.chatenable) {
                        var s = '<font class="warning">【' + uu89pub.getUserNameEle(u.appdata) + "】被管理员禁止发言5分钟!</font>";
                        message_display.pub(s);
                    }
                }
            }
            break;
        case 171:
            break;
        case 172:
            displayForbiddenState(param);
            break;
        case 182 :
            if (param.tokenid == 1) {
                if (param.tokenstatus == 1) {
                    if ($('#live_time').html() == '开播时间：直播未开始') {
                        var currentdate = new Date();
                        var datetime = currentdate.getHours() + ":" + currentdate.getMinutes();
                        $('#live_time').html('开播时间：' + datetime);
                    }
                    $(".noliveVideo").show();
                    $(".liveVideo").hide();
                    setTimeout(function () {
                        video_swf.LiveState(1);
                    }, 1000)
                }
                else {
                    $('#live_time').html('开播时间：直播未开始');
                    video_swf.LiveState(0);
                    if (!UserIdentity.isAnchor(userpara)) {
                        load_room_recommended();
                        $(".noliveVideo").hide();
                        $(".liveVideo").show();
                    }
                }
            }
            break;
        case 192 :
            video_swf.webSetLive(param.state)
            break;
        case 221:
            setFollowBtn(param)
            break;
        case 222:
            setFansVal(param);
            break;
        //broadcast response
        case 231:
            break;
        //broadcast distributed
        case 232:
            if (param.type == 1) {
                var strVar = SiteCommon.generateBroadItem({
                    name: param.from_user.nickname,
                    uid: param.gid,
                    message: param.message
                });
                SiteCommon.marqueeBroad.feedMessage(strVar)
                if ($(".radioWord").is(':visible')) {
                    SiteCommon.radioFn();
                }
            }
            break;
    }
}