<?php $this->renderPartial('/account/head') ?>
<!--修改密码-->
<form action="" method="post" enctype="application/x-www-form-urlencoded">
    <div class="pubform managePassword">
        <ul>
            <li>
                <em class="pfTitle">旧密码：</em>
                <em><span class="spanInput"><input maxlength="20" name="old_password" type="password" /></span></em>
            </li>
            <li>
                <em class="pfTitle">新密码：</em>
                <em><span class="spanInput"><input maxlength="20" name="password" type="password" /></span></em>
            </li>
            <li>
                <em class="pfTitle">确认新密码：</em>
                <em><span class="spanInput"><input maxlength="20" name="confirm_password" type="password" /></span></em>
            </li>
        </ul>
        <div class="subIco">
            <a href="javascript:;" title="" class="whiteBtn" onclick="submitform();"><i>修改密码</i></a>
            <?php echo $msg ?>
        </div>
    </div>
    <!--修改密码 end-->
</form>
<?php $this->renderPartial('/account/foot')?>
<script type="text/javascript">
    function submitform(){
        $("form:first").submit();
    }
</script>