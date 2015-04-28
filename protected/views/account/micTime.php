<?php $this->renderPartial('/account/head') ?>
<!--兑换记录-->
<script language="javascript" type="text/javascript" src="/js/libraries/DatePicker/WdatePicker.js"></script>
<script>
    function search_log() {
        var start = document.getElementById("startTime").value;
        var end = document.getElementById("endTime").value;
        location = "/account/micTime?startTime=" + start + "&endTime=" + end;
    }
</script>
<div class="pubform changeInfor1">
    <ul>
        <li>
            <em class="pfTitle">开始时间：</em><input type="text" id="datetimepicker8"/>
            <em>
                <span class="spanInput ">
                    <input type="text" size="20" maxlength="20" name="startTime" id="startTime"
                           value="<?php if ($start_time) echo date("Y-m-d H:i:s", $start_time) ?>"
                           onfocus="WdatePicker({firstDayOfWeek:1,dateFmt:'yyyy-M-d H:mm:ss',onpicked:function(data){
                               $(this).removeAttr('disabled');
                           }})" readonly/>
                </span>
            </em>
            <em class="pfTitle">结束时间：</em>
            <em><span class="spanInput ">
                    <input type="text" size="20" maxlength="20" id="endTime"
                           value="<?php if ($end_time) echo date("Y-m-d H:i:s", $end_time) ?>"
                           onfocus="WdatePicker({firstDayOfWeek:1,dateFmt:'yyyy-M-d H:mm:ss',onpicked:function(data){
                               $(this).removeAttr('disabled');
                           }})" readonly/>
                </span>
            </em>
            <em>
                <a href="javascript:;" title="" class="pubLink" onclick="search_log()"><i>搜索</i></a>
            </em>
        </li>
        <li>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
                <tr>
                    <th>上麦时间</th>
                    <th>下麦时间</th>
                    <th>时长</th>
                    <th>上麦房间</th>
                </tr>
                <?php if ($data): ?>
                    <?php foreach ($data as $one): ?>
                        <tr class="thumContentbg">
                            <td><?php echo date('Y-m-d H:i:s', $one['start_time']) ?></td>
                            <td><?php echo date('Y-m-d H:i:s', $one['ender_time']) ?></td>
                            <td><?php echo Logic::formatTime($one['seconds']) ?></td>
                            <td><?php echo $one['room_name'] ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <!--没有麦时-->
                    <tr>
                        <td colspan="4"><span class="noNode">本月还没上过麦</span></td>
                    </tr>
                <?php endif ?>
                <!--没有麦时end-->
            </table>
            <!--翻页-->
            <?php $this->renderPartial('/site/pager', array('all' => $pager['total'], 'all_page' => $pager['pages'],
                'page' => $pager['page'], 'size' => $size,
                'param'=>array('startTime'=>date('Y-m-d', $start_time), 'endTime'=>date('Y-m-d', $end_time)))) ?>
            <!--翻页 end-->
        </li>
    </ul>
</div>
<!--兑换记录end-->
<?php $this->renderPartial('/account/foot') ?>
