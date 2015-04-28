<?php $this->renderPartial('/account/head') ?>
<script language="javascript" type="text/javascript" src="/js/libraries/DatePicker/WdatePicker.js"></script>
<!--社团操作-->
<div class="pubform changeInfor1"><!--tab导航-->
    <div class="tabList">
        <ul>
            <li <?php if (Yii::app()->controller->action->id == 'family'): ?>class="current"<?php endif?> style="margin-right: 10px;"><a href="/account/family" title="">主播信息</a></li>
            <li <?php if (Yii::app()->controller->action->id == 'familyApply'): ?>class="current"<?php endif?>><a href="/account/familyApply" title="">审批申请</a></li>
        </ul>
    </div>

    <!--tab导航 end-->
    <script language="javascript" type="text/javascript" src="/js/DatePicker/WdatePicker.js"></script>
    <script>
        function search_log(){
            var start = document.getElementById('startTime').value;
            var end = document.getElementById('endTime').value;
            location = "/account/family?startTime="+start+"&endTime="+end;
        }
    </script>
    <ul>
        <li>
            <em class="pfTitle">开始时间：</em>
            <em><span class="spanInput ">
                    <input type="text" name="startTime" id="startTime" value="<?php if($start_time)echo date("Y-m-d H:i:s", $start_time) ?>" size="20" onfocus="WdatePicker({firstDayOfWeek:1,dateFmt:'yyyy-M-d H:mm:ss'})" maxlength="20" />
                </span>
            </em>
            <em class="pfTitle">结束时间：</em>
            <em>
                <span class="spanInput ">
                    <input type="text" name="endTime" id="endTime" value="<?php if($end_time) echo date("Y-m-d H:i:s", $end_time) ?>" size="20" onfocus="WdatePicker({firstDayOfWeek:1,dateFmt:'yyyy-M-d H:mm:ss'})" maxlength="20" />
                </span>
            </em>
            <em>
                <a href="javascript:;" title="" class="whiteBtn" onclick="search_log()"><i>搜索</i></a>
            </em>
        </li>
        <li>
            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                   class="tableData">
                <tr>
                    <th>主播号码</th>
                    <th>主播昵称</th>
                    <th>当月累积收入</th>
                    <th>在麦时长</th>
                    <th>有效天数</th>
                    <th>兑换记录</th>
                </tr>
                <?php if ($data): ?>
                    <?php foreach($data as $one):?>
                        <tr class="thumContentbg">
                            <td><?php echo $one['gid'] ?></td>
                            <td><?php echo $one['uname'] ?></td>
                            <td><?php echo $one['income'] ?>U币</td>
                            <td><?php echo $one['live_count'] ?>小时</td>
                            <td><?php echo $one['mic_day'] ?>天</td>
                            <td><a href="/account/familyView/uid/<?php echo $one['uid'] ?>">查看</a></td>
                        </tr>
                    <?php endforeach?>
                <?php else: ?>
                    <!--没有麦时-->
                    <tr class="thumContentbg">
                        <td colspan="10"><span class="noNode">您的社团还没有主播</span></td>
                    </tr>
                <?php endif?>
                <!--没有麦时end-->
            </table>
        </li>
    </ul>
    <!--翻页-->
    <?php $this->renderPartial('/site/pager', array('all'=>$pager['total'], 'all_page'=>$pager['pages'], 'page'=>$pager['page'], 'size'=>$size, 'param'=>array('startTime'=>date('Y-m-d', $start_time), 'endTime'=>date('Y-m-d', $end_time))))?>
    <!--翻页 end--></div>
<!--社团操作end-->
<?php $this->renderPartial('/account/foot') ?>
