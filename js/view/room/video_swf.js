/**
 * Description: handling communication between flash and server
 *
 * @moudle Service Objects
 * @class video_swf
 * @static
 */
var video_swf = {
    live: 0,
    swf_name: 'recv',
    Init: function (swf_param, div_id, type, callbackFn) {
        this.swf_param = swf_param;
        if (callbackFn == null) {
            callbackFn = this.Created_cb;
        }
        var swfVersionStr = "11.1.0";
        // To use express install, set to playerProductInstall.swf, otherwise the empty string.
        var xiSwfUrlStr = "playerProductInstall.swf";
        var flashvars = {
            url: "rtmp://" + swf_param.server + "/uu89",
            gid: swf_param.room_id,
            version: '1',
            permit: 1
        };
        var swf_name = 'recv';
        if (type == 1) {
            swf_name = 'send';
            flashvars.level = 900;
        }
        var params = {};
        params.quality = "high";
        params.bgcolor = "#57799c";
        params.allowscriptaccess = "always";
        params.allowfullscreen = "true";
        params.wmode = "transparent";
        var attributes = {};
        attributes.id = swf_name;
        attributes.name = swf_name;
        attributes.align = "middle";
        var dir = SiteCommon.SWF_DIR;
        swfobject.embedSWF(
            dir + swf_name + ".swf",
            div_id,
            480, 360,
            swfVersionStr, xiSwfUrlStr,
            flashvars, params, attributes, callbackFn);
        this.swf_name = swf_name;
    },
    Created_cb: function (cbobj) {
        if (cbobj.success) {
        }
        else {
            alert("flash初始化失败.");
        }
    },
    LiveState: function (state) {
        this.live = state;
        if (this.swf_name == "recv") {
            var obj = swfobject.getObjectById("recv");
            if (obj instanceof Object && obj.LiveState instanceof Function) {
                obj.LiveState(state);
            }
        }
    },
    webSetLive: function (state) {
        if (this.swf_name == "send") {
            var obj = swfobject.getObjectById("send");
            if (obj instanceof Object) {
                obj.webSetLive(state);
            }
        }
    },
    Logout: function () {
        if (this.swf_name != 'recv') {
            return;
        }
        var obj = swfobject.getObjectById("recv");
        if (obj instanceof Object) {
            swfobject.getObjectById("recv").Logout();
        }
    }
};
function xconf_livestate() {
    return video_swf.live;
}
function xconf_swf_debug(info) {
    //xLog.log("xconf_swf_debug: " + info );
}
function xconf_swf_error(ErrorCode) {
    //console.log("xconf_swf_error: " + ErrorCode );
    if (ErrorCode == "-1") {
        alert("无法连接视频服务器.");
    }
    if (ErrorCode == "-2") {
        alert("与视频服务器的通信发生错误.");
    }
}
function xconf_swf_notify(type, param) {
    if (type == "xconf_swf_ready") {
        //console.log("xconf_swf_ready");
    }
    if (type == "talk_stop_by_server") {
        //xMessager.cancelmic();
    }
    if (type == "CAST") {
        if (xMessager) {
            //xMessager.onChannelState(param);
        }
    }
}
function xconf_swf_publish(type) {
    xchat_swf.tokenop(type);
}
function ucast_h264_log(log) {
    alert('log:' + log);
    var url = "/room/ucast_h264.php";
    var data = {
        'TYPE': 'log',
        'UID': video_swf.swf_param.uid,
        'DATA': log
    };
    jQuery.post(url, JSON.stringify(data), function (result) {
        //console.log(result);
        /*
         var r = jQuery.parseJSON(result);
         console.log(r.RES);
         if (r.RES==0){
         }
         if (r.RES==1){
         }
         */
    })
        .fail(function () {
            //console.log('error');
        });
}