/**
 * Description:
 *
 * @module
 */
function buy_car(id) {
    var logined = '<?php echo $login ?>';
    if (!logined) {
        if (jQuery(".masterEle").css("display") == "none") {
            jQuery("#loginBox").click();
            return;
        }
    }
    jQuery.ajax({
        type: "get",
        url: "/shop/buyCar/" + id,
        success: function (data) {
            SiteCommon.renderPromptBox(data);
        }
    })
}