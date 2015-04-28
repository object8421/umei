function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 9; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}
function generate_gift(swf, x, y, z, w, h, life) {
    var div_id = 'gift_display' + makeid();
    var css_style = 'overflow:hidden;position: absolute;z-index:10000;';
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
    swfobject.embedSWF("/upload/gift_img/" + swf, div_id, w, h, "7", null, flashvars, params, attributes);
    gift_center.showed -= 1;
    setTimeout(function () {
        swfobject.removeSWF(div_id);
    }, life * 1000);
}
function generate_gift_1(swf, x, y, z, w, h, life) {
    var div_id = 'gift_display' + makeid();
    $('<div>', {
        id: div_id
    }).appendTo('body');
    var css_style = 'z-index: ' +
        (70 + z) +
        '; overflow:hidden;position: absolute;' +
        "width: " +
        w +
        "px; height: " +
        h +
        "px; left: " +
        x +
        "px; top: " +
        y +
        "px;";
    swfobject.createCSS("#" + div_id, css_style);
    var flashvars = {};
    var params = {};
    params.quality = "high";
    params.wmode = "transparent";
    var attributes = {};
    swfobject.embedSWF("/upload/gift_img/" + swf, div_id, w, h, "7", null, flashvars, params, attributes);
    setTimeout(function () {
        swfobject.removeSWF(div_id);
        //gift_center.showed -=1 ;
    }, life * 1000);
}
var gift_center = {
    queue: [],
    showed: 0,
    minNumShowGiftTxt: 10,
    minShowedGiftSwf: 15,
    random_pos: function () {
        var s_w = get_w_w();
        var left = 200;
        var top = 150;
        if (s_w > 1180) {
            left = Math.floor((s_w - 1180) / 2 + 200);
        }
        var x = left + Math.floor((Math.random() * 80) + 1) * 10;
        var y = top + Math.floor((Math.random() * 30) + 1) * 10;
        var r = {};
        r.x = x;
        r.y = y;
        return r;
    },
    random_pos_4_big: function () {
        var s_w = get_w_w();
        var left = 0;
        var top = 0;
        var w = 200;
        var h = 80;
        if (s_w > 1180) {
            w += (s_w - 1180);
        }
        var x = left + Math.floor((Math.random() * 10) + 1) * 20;
        var y = top + Math.floor((Math.random() * 10) + 1) * 20;
        var r = {};
        r.x = x;
        r.y = y;
        return r;
    },
    display_screen_hint: function (gift, life) {
        var text;
        text = '[礼物]' + gift.from_user.nickname + ' 向 ' + gift.to_user.nickname + ' 送：' + gift.sum + gift.unit + gift.gift_name;
        balloon_message(text, life);
    },
    small_gift: function (swf, count, life, data) {
        if (count >= this.minNumShowGiftTxt) {
            gift_center.display_screen_hint(data, life);
        }
        var minShowedGiftSwf = count <= this.minShowedGiftSwf ? count : this.minShowedGiftSwf;
        var row = Math.floor(minShowedGiftSwf / 9) + 1;
        var z_w, z_h;
        if (minShowedGiftSwf < 9)
            z_w = minShowedGiftSwf * 120;
        else
            z_w = 9 * 120;
        z_h = row * 120;
        var x = Math.floor((get_w_w() - z_w) / 2);
        var y = Math.floor((get_w_h() - z_h) / 2);
        if (x < 0) x = 0;
        if (y < 0) y = 0;
        for (var i = 0; i < minShowedGiftSwf; i++) {
            var r = Math.floor(i / 9);
            var c = i % 9;
            var pos = gift_center.random_pos();
            generate_gift_1(swf, pos.x, pos.y, i, 120, 120, life);
        }
    },
    big_gift: function (swf, count, life) {
        var z_w, z_h;
        z_w = 980;
        z_h = 500;
        var x = Math.floor((get_w_w() - z_w) / 2);
        var y = 0;
        if (x < 0) x = 0;
        if (y < 0) y = 0;
        for (var i = 0; i < count; i++) {
            gift_center.showed += 1;
            var pos = gift_center.random_pos_4_big();
            generate_gift(swf, pos.x, pos.y, i, z_w, z_h, life);
        }
        return 0;
    },
    show_gift: function (type, swf, count, life, data) {
        if (type == 'S') {
            var d = {};
            d.type = type;
            d.swf = swf;
            d.count = count;
            d.life = life;
            d.data = data;
            //small gifts display immediately,
            gift_center.small_gift(swf, count, life, data);
            //gift_center.queue.push(d);
        }
        if (type == 'B') {
            var count = data.sum;
            var d = {};
            d.type = type;
            d.swf = swf;
            if (count > this.minNumShowGiftTxt) {
                d.count = this.minNumShowGiftTxt;
                d.life = 5;
                gift_center.queue.push(d);
            }
            else {
                d.count = count;
                d.life = life;
                gift_center.queue.push(d);
            }
            gift_center.walk();
        }
    },
    walk: function () {
        if (gift_center.showed == 0 && gift_center.queue.length > 0) {
            var i = gift_center.queue.shift();
            if (i.type == 'B') {
                i.count = gift_center.big_gift(i.swf, i.count, i.life);
            }
            if (i.type == 'S') {
                gift_center.small_gift(i.swf, i.count, i.life, i.data);
            }
        }
    }
};
//window.setInterval(giftctrl, 2000);
