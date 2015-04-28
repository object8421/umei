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
    <ul>
        <li>
            <span class="center">她当前的U豆数为：<?php if ($anchor_bean): ?><?php echo $anchor_bean ?><?php else:?>0<?php endif?>，可兑换RMB:<?php echo $changeRMB ?>元。 </span>
        </li>
        <li>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
                <tr>
                    <th>兑换Ｕ豆</th>
                    <th>所获金额</th>
                    <th>兑换时间</th>
                </tr>
                <?php if ($logs): ?>
                    <?php foreach ($logs as $item):?>
                        <tr class="thumContentbg">
                            <td><?php echo $item['bean'] ?></td>
                            <td><?php echo $item['money'] ?></td>
                            <td><?php echo $item['add_time'] ?></td>
                        </tr>
                    <?php endforeach?>
                <?php else:?>
                    <!--没有兑换-->
                    <tr>
                        <td colspan="3"><span class="noNode">目前还没有兑换过</span></td>
                    </tr>
                <?php endif?>
                <!--没有兑换end-->
            </table>
        </li>
    </ul>
    <!--翻页-->
    <?php $this->renderPartial('/site/pager', array('all'=>$pager['total'], 'all_page'=>$pager['pages'], 'page'=>$pager['page'], 'size'=>$size, 'param'=>array('uid'=>$uid)))?>
    <!--翻页 end--></div>
<!--社团操作end-->
<?php $this->renderPartial('/account/foot') ?>
