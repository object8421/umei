<?php $this->renderPartial('/account/head') ?>
<!--修改资料-->
<form action="" method="post" enctype="application/x-www-form-urlencoded" name="profile">
    <div class="pubform changeInfor">
        <ul>
            <li>
                <em class="pfTitle">账号：</em>
                <em><span><?php echo $info['username'] ?></span></em>
            </li>
            <li>
                <em class="pfTitle">当前昵称：</em>
                <em><span><?php echo $info['nickname'] ?></span></em>
            </li>
            <li>
                <em class="pfTitle">昵称：</em>
                <em><span class="spanInput"><input maxlength="20" name="nickname" type="text" value=""/></span>&nbsp;&nbsp;<span><?php echo $msg ?></span></em>
            </li>
        </ul>
        <div class="subIco1">
            <a href="javascript:;" title="" class="whiteBtn" onclick="submitform();"><i>保存修改</i></a>
        </div>
    </div>
</form>
<!--修改资料 end-->
<?php $this->renderPartial('/account/foot') ?>
<script type="text/javascript">
    var $nickName = $('[name="nickname"]');
    function submitform() {
        var val = $.trim($nickName.val());
        if (val == '' || SiteCommon.isLessMinInput(val)) {
            alert('昵称不符合要求')
            return
        }
        $("form:first").submit();
    }
    generalCallback = function (data) {
        SiteCommon.setMaxInput($nickName);
    }
    generalCallback()
</script>