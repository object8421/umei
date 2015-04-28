/**
 * Description: controlling login and register functionality
 *
 * @module Form Objects
 *
 */
$(function () {
    if (!/register/.test(location.href)) {
        if (typeof islogined!=='undefined') {
            autologin(islogined);
        }
    }
});
function autologin(isLogined) {
    if (isLogined == 0) {
        var delay = 120000;
        setInterval(function () {
            if ($(".masterEle").css("display") == "none") {
                $("#loginBox").click();
            }
        }, delay);
    }
}
function login() {
    if (jQuery("#username").val() == "" || jQuery("#password").val() == "") {
        jQuery(".erroTipInfor").html("用户名，密码必须都填写");
        return false;
    }
    jQuery.ajax({
        type: "post",
        data: {
            "act": "user", "username": jQuery("#username").val(), "password": jQuery("#password").val(),
            "captcha": jQuery("#captcha").val(), "autoLogin": jQuery("#autoLogin").val()
        },
        url: "/user/login",
        success: function (data, status) {
            var ms = JSON.parse(data);
            if (ms.error == 0) {
                jQuery(".erroTipInfor").html(ms.message);
                setTimeout(function () {
                    window.location.reload();
                }, 500);
            } else {
                jQuery(".erroTipInfor").html(ms.message);
                change_regcaptcha();
                if (parseInt(ms.content) > 2) {
                    jQuery("#yzm").show();
                }
            }
        }
    });
}
function reg() {
    if (jQuery("#regusername").val() == "" || jQuery("#regpassword").val() == "" || jQuery("#regconfirm_password").val() == "" || jQuery("#regcaptcha").val() == "") {
        jQuery(".erroTipInfor").html("用户名，密码，验证码等必须都填写");
        return false;
    }
    if (!$('#agreeCont').prop('checked')) {
        jQuery(".erroTipInfor").html("请同意协议");
        return false;
    }
    jQuery.ajax({
        type: "post",
        data: {
            "act": "general",
            "username": jQuery("#regusername").val(),
            "password": jQuery("#regpassword").val(),
            "confirm_password": jQuery("#regconfirm_password").val(),
            //"nickname":jQuery("#nickname").val(),
            //"sex":jQuery("#sex").val(),
            "captcha": jQuery("#regcaptcha").val()
        },
        url: "/user/register",
        success: function (data, status) {
            var ms = JSON.parse(data);
            if (ms.error == 0) {
                var mss = JSON.parse(ms.content);
                jQuery("#okusername").html(mss.username);
                jQuery("#okuid").html(mss.uid);
                jQuery("#registerokBox").click();
            } else {
                change_regcaptcha();
                jQuery(".erroTipInfor").html(ms.message);
            }
        }
    });
}
function toreg() {
    change_regcaptcha();
    $("#registerBox").click();
}
function toforgetpwd() {
    window.open('login.php?act=returnpwd', '找回密码');
}
function tologin() {
    change_regcaptcha();
    $("#loginBox").click();
}
function change_regcaptcha() {
    jQuery("#regcaptchaimg,#captchaimg").attr("src", "/captcha" + "?" + new Date().getTime());
    return;
}
function checklogin() {
    if (userpara.level == 1) {
        if (jQuery(".masterEle").css("display") == "none") {
            jQuery("#loginBox").click();
            return false;
        }
    }
    return true;
}
/**
 * Description: login in with the third party info, the html commented out
 *
 * @class LoginWithOthers
 * @deprecated
 */
//var childWindow;
//function toQzoneLogin() {
//    childWindow = window.open("/qlogin/example/oauth/index.php", "TencentLogin", "width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
//}
//function closeChildWindow() {
//    childWindow.close();
//}
//function toQzoneLogin() {
//    childWindow = window.open("/qlogin/example/oauth/index.php", "TencentLogin", "width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
//}