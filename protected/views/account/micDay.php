<?php $this->renderPartial('/account/head') ?>
<!--兑换记录-->
<script language="javascript" type="text/javascript" src="/js/libraries/DatePicker/WdatePicker.js"></script>
<script>
    function search_log() {
        var start = document.getElementById("startTime").value;
        var end = document.getElementById("endTime").value;
        location = "/account/micTime?startTime=" + start + "&endTime=" + end;
    }
    $('body').click(function (data) {
        $('#startTime,#endTime').removeAttr('disabled')
    })
</script>
<!--兑换记录-->
<div class="pubform changeInfor1">
    <ul>
        <li>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
                <?php if ($data): ?>
                <tr>
                    <th>时间</th>
                    <th>有效天数</th>
                    <th>上麦房间</th>
                </tr>
                <?php foreach($data as $day => $set):?>
                <tr class="thumContentbg">
                    <td><?php echo $day ?></td>
                    <td><?php echo $set[0] ?>天</td>
                    <td><?php echo $set[1] ?></td>
                </tr>
                <?php endforeach?>
                <!--合计-->
                <tr class="thumContentbg">
                    <td colspan="3"><span class="noNode">总计：<?php echo $all ?>天</span></td>
                </tr>
                <!--合计 end-->
                <?php else:?>
                <!--没有麦时-->
                <tr>
                    <td colspan="3"><span class="noNode">本月无有效天数</span></td>
                </tr>
                <!--没有麦时end-->
                <?php endif?>
            </table>
        </li>
    </ul>
</div>
<!--兑换记录end-->
<?php $this->renderPartial('/account/foot') ?>
