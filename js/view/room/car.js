function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 9; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}
function generate_car(swf, x, y, z, w, h, life) {
    var div_id = 'gift_display' + makeid();
    var css_style = 'z-index: ' + (70 + z) + '; overflow:hidden;position: absolute;';
    css_style += "width: " + w + "px; height: " + h + "px; left: " + x + "px; top: " + y + "px;";
    swfobject.createCSS("#" + div_id, css_style);
    var $div = $('<div />').appendTo('body');
    $div.attr('id', div_id);
    //console.log($("#"+div_id).width());
    var flashvars = {};
    var params = {};
    params.quality = "high";
    params.wmode = "transparent";
    var attributes = {};
    var w = $("#" + div_id).width();
    var h = $("#" + div_id).height();
    swfobject.embedSWF("/upload/car_img/" + swf, div_id, w, h, "7", null, flashvars, params, attributes);
    setTimeout(function () {
        swfobject.removeSWF(div_id);
        car_center.showed -= 1;
    }, life * 1000);
}
function carctrl() {
    car_center.walk();
}
var car_center = {
    queue: [],
    showed: 0,
    random_pos: function () {
        var s_w = get_w_w();
        var left = 0;
        var top = 300;
        if (s_w > 1180) {
            left = Math.floor((s_w - 1180) / 2);
        }
        var x = left + Math.floor((Math.random() * 70) + 1) * 10;
        var y = top + Math.floor((Math.random() * 30) + 1) * 10;
        var r = {};
        r.x = x;
        r.y = y;
        return r;
    },
    random_pos_4_big: function (swfWidth, swfHeight) {
        swfHeight = swfHeight || top + Math.floor(5 + 1) * 20;
        swfWidth = swfWidth || left + Math.floor(10 + 1) * 20;
        var s_w = get_w_w();
        var left = 0;
        var top = 0;
        var w = 200;
        var h = 200;
        if (s_w > 1180) {
            w += (s_w - 1180);
        }
        var x = swfWidth;
        var y = swfHeight;
        var r = {};
        r.x = x;
        r.y = y;
        return r;
    },
    show_car: function (swf, count, life) {
        var bigCarWidth, bigCarHeight;
        bigCarWidth = 800;
        bigCarHeight = 360;
        var x = Math.floor((get_w_w() - bigCarWidth) / 2);
        var y = 0;//Math.floor((get_w_h() - bigCarHeight)/2);
        if (x < 0) x = 0;
        if (y < 0) y = 0;
        for (var i = 0; i < count; i++) {
            car_center.showed += 1;
            var pos = car_center.random_pos_4_big(get_w_w() / 2-bigCarWidth/2, 300)
            generate_car(swf, pos.x, pos.y, i, bigCarWidth, bigCarHeight, life);
        }
    },
    walk: function () {
        if (car_center.showed == 0 && car_center.queue.length > 0) {
            var i = car_center.queue.shift();
            if (i.type == 'B') {
                car_center.big_car(i.swf, i.count, i.life);
            }
        }
    }
};
window.setInterval(carctrl, 2000);
