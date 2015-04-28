<?php $this->renderPartial('/account/head') ?>
<!--兑换记录-->
<div class="pubform changeInfor1">
    <ul>
        <li>
            <span class="center">您当前的U豆数为：<?php echo $all_beans ?>，可兑换RMB:<?php echo $all_beans / Yii::app()->params['coin_scale'] ?>元。 </span>
        </li>
        <li>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
                <tr>
                    <th>兑换Ｕ豆</th>
                    <th>所获金额</th>
                    <th>兑换时间</th>
                </tr>
                <?php if ($data): ?>
                <?php foreach($data as $one):?>
                <tr class="thumContentbg">
                    <td><?php echo $one['bean'] ?></td>
                    <td><?php echo $one['money'] ?></td>
                    <td><?php echo date('Y-m-d H:i:s', $one['add_time']) ?></td>
                </tr>
                    <?php endforeach?>
                <?php else: ?>
                <!--没有兑换-->
                <tr>
                    <td colspan="3"><span class="noNode">目前还没有兑换过</span></td>
                </tr>
                <?php endif?>
                <!--没有兑换end-->
            </table>
        </li>
    </ul>  <!--翻页-->
    <?php $this->renderPartial('/site/pager', array('all'=>$pager['total'], 'all_page'=>$pager['pages'], 'page'=>$pager['page'], 'size'=>$size))?>
    <!--翻页 end-->
</div>
<!--兑换记录end-->
<?php $this->renderPartial('/account/foot') ?>
