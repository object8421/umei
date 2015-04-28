/**

 @module Service Objects
 @class SendGift

 **/
var gift_id = 0;
var gift_to_uid = 0;
function SetGiftRX(uid, nickname) {
    gift_to_uid = uid;
    if ($("#gift_to option[value='" + uid + "']").length == 0) {
        //$("#gift_to").append(new Option(nickname,uid));
        var objOption = document.createElement("OPTION");
        objOption.text = nickname;
        objOption.value = uid;
        document.getElementById("gift_to").options.add(objOption);
    }
    $("#gift_to option[value!='" + uid + "']").attr("selected", false);
    $("#gift_to option[value='" + uid + "']").attr("selected", true);
    //$('#gift_to').val(nickname);
}
function gift_to_change(obj) {
    $('#gift_name').val(obj.key);
    gift_to_uid = obj.value;
}
function SelectGift(gift, obj) {
    $(".liveGiftsBox li").removeClass("current");
    $(obj).addClass("current");
    var g = jQuery.parseJSON(gift);
    //console.log(g.GIFTID);
    $('#gift_name').val(g.NAME);
    gift_id = g.GIFTID;
}
function SendGift() {
    if (!checklogin()) {
        return false;
    }
    if (gift_to_uid == 0) {
        gift_to_uid = $("#gift_to_uid").val()
    }
    if (gift_id == 0) {
        $("#returnmsg").html('要选择礼物才可以赠送哟！');
        $("#tips02Pop .pinkBtn").removeAttr("onclick");
        $("#tips02Pop .pinkBtn").click(function () {
            $("#tips02Pop .popPubClose")[0].click();
        });
        $("#tips02").click();
        return;
    }
    var count = $('#gift_count').val();
    if (Utils.isEmpty(count) || !Utils.isNumber(count) || count <= 0) {
        $("#returnmsg").html('赠送的礼物数量不正确！请重新输入！');
        $("#tips02Pop .pinkBtn").removeAttr("onclick");
        $("#tips02Pop .pinkBtn").click(function () {
            $("#tips02Pop .popPubClose")[0].click();
        });
        $("#tips02").click();
        return;
    }
    var url = "/shop/buyGift";
    var receiver = g_UserList.GetUser(gift_to_uid);
    var data = {
        'from_uid': userpara.gid,
        'to_uid': gift_to_uid,
        'gift_id': gift_id,
        'sum': $('#gift_count').val(),
        'room_id': room_id
    };
    if (receiver == null && roompara.uid != gift_to_uid) {
        alert('该用户已不在房间')
        return
    }
    $.post(url, data, function (result) {
        var r = jQuery.parseJSON(result);
        SendGiftCB(r);
    })
        .fail(function () {
            //console.log('error');
            $("#returnmsg").html('赠送礼物操作发生错误！');
            $("#tips02Pop .pinkBtn").removeAttr("onclick");
            $("#tips02Pop .pinkBtn").click(function () {
                $("#tips02Pop .popPubClose")[0].click();
            });
            $("#tips02").click();
        });
}
$(function () {
    SiteCommon.setChatDialog($('#gift_count'), function (data) {
        SendGift()
    })
});