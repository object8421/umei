<?php $this->renderPartial('/account/head') ?>
<script language="javascript" type="text/javascript" src="/js/libraries/DatePicker/WdatePicker.js"></script>
<!--修改资料-->
<form action="" method="post" enctype="application/x-www-form-urlencoded" name="profile">
    <div class="pubform changeInfor">
        <ul>
            <li>
                <em class="pfTitle">账号：</em>
                <em><span><?php echo $info['username'] ?></span></em>

            </li>
            <li>
                <em class="pfTitle">性别：</em>
                <em><?php echo CHtml::radioButtonList('sex', $info['sex'], array(2 => '女', 1 => '男'), array('separator' => '&nbsp;')) ?></em>
            </li>
            <li>
                <em class="pfTitle">生日：</em>
                <em class="spanInput">
                    <input type="text" name="birth"
                           value="<?php if ($info['birth'] > 0) echo date('Y-m-d', $info['birth']) ?>" size="20"
                           onfocus="WdatePicker({firstDayOfWeek:1,dateFmt:'yyyy-MM-dd',onpicked:function(data){
                               $(this).removeAttr('disabled');
                           }})" maxlength="20" onclick="$(this).attr('disabled','disabled');" />
                </em>
            </li>
            <li>
                <em class="pfTitle">签名：</em>
                <em>
                    <textarea maxlength="20" name="sign" cols="10" rows="40"
                              class="textArea"><?php echo $info['sign'] ?></textarea>
                </em>
            </li>
        </ul>
        <div class="subIco">
            <a href="javascript:;" title="" class="whiteBtn" onclick="submitform();"><i>保存修改</i></a>
            <?php echo $msg ?>
        </div>
    </div>
</form>
<!--修改资料 end-->
<?php $this->renderPartial('/account/foot') ?>
<script type="text/javascript">
    $('body').click(function (data) {
        $('[name="birth"]').removeAttr('disabled')
    })
    function submitform() {
        $("form:first").submit();
    }
</script>