<?php $this->renderPartial('/account/head') ?>
<!--修改资料-->
<div class="pubform changeInfor">
    <ul>
        <li>
            <em class="pfTitle">账号：</em>
            <em><span><?php echo $info['username'] ?></span></em>

        </li>
        <li>
            <em class="pfTitle">当前密码：</em>
            <em>
                <span class="spanInput1">
                    <input maxlength="20" id="epassword" type="password" placeholder="请输入当前账号的登录密码" autocomplete="off" />
                </span>
            </em>
            <em class="red"></em>
        </li>
        <li>
            <em class="pfTitle">邮箱地址：</em>
            <em>
                <span class="spanInput1">
                    <input maxlength="50" id="email" type="text" placeholder="请输入您要验证的邮箱地址" autocomplete="off" value="<?php echo $info['email'] ?>"/>
                </span>
            </em>
            <?php if ($info['email']): ?>
                <?php if ($info['email_status']): ?>
                    已验证
                <?php else: ?>
                未验证
                <?php endif?>
            <?php endif?>
            <em class="red"></em>
        </li>
    </ul>
    <input type="hidden" value="{$formhash}" id="formhash">
    <div class="subIco1">
        <a class="whiteBtn" title="" href="javascript:;" onclick="sendemail()"><i>发送验证链接</i></a><span><?php echo $msg ?></span>
    </div>
</div>
<!--修改资料 end-->
<?php $this->renderPartial('/account/foot')?>
<script type="text/javascript">
    function sendemail(){
        if ($("#epassword").val() == "") {
            $("#epassword").parent().addClass('spanInputErro');
            $("#epassword").parent().parent().next().html('当前密码必须填写！');
            return;
        }else{
            $("#epassword").parent().removeClass('spanInputErro');
            $("#epassword").parent().parent().next().html('');
        }
        if ($("#email").val() == "") {
            $("#email").parent().addClass('spanInputErro');
            $("#email").parent().parent().next().html('email必须填写！');
            return;
        }else{
            $("#email").parent().removeClass('spanInputErro');
            $("#email").parent().parent().next().html('');
        }
        var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
        if (!pattern.test($("#email").val())) {
            $("#email").parent().addClass('spanInputErro');
            $("#email").parent().parent().next().html('email格式不正确！');
            return;
        }else{
            $("#email").parent().removeClass('spanInputErro');
            $("#email").parent().parent().next().html('');
        }
        $(".thumContent").showLoading();
        jQuery.ajax({
            type: "post",
            data: {"password":jQuery("#epassword").val(),"email":jQuery("#email").val()},
            url: "/account/verifyEmail",
            success: function (data,status) {
                jQuery('.thumContent').hideLoading();
                var ms = JSON.parse(data);
                if(ms.error==0){
                    setTimeout(function(){
                        location='/account/setMail';
                    },300);
                }else{
                    $("#epassword").parent().parent().next().html(ms.message);
                }
            }
        });
    }
    function submitform(){
        $("form:first").submit();
    }
</script>