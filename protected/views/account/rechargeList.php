<?php $this->renderPartial('/account/head') ?>
<!--个人信息-->
<div class="personCenter pd">
    <!--我关注的-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
        <tr>
            <th>订单号</th>
            <th>充值渠道</th>
            <th>充值金额</th>
            <th>获得U币</th>
            <th>结果</th>
            <th>时间</th>
        </tr>
        <?php if ($data): ?>
        <?php foreach($data as $one):?>
        <tr class="thumContentbg">
            <td><?php echo $one['order_sn'] ?></td>
            <td><?php echo $one['pay_name'] ?></td>
            <td><?php if ($one['amount']): ?>￥ <?php echo $one['amount'] ?><?php else: ?>￥0<?php endif?></td>
            <td><?php if ($one['addcoin']): ?> <?php echo $one['addcoin'] ?>个<?php else: ?><?php echo $one['magic_name'] ?> <?php echo $one['magic_sum'] ?>个<?php endif?></td>
            <td><?php if ($one['is_addcoin'] == 1): ?>充值成功<?php elseif($one['is_pay'] == 1 && $one['magic_id']):?>购买成功<?php else: ?><span style="color:#f00">充值失败</span><?php endif?></td>
            <td><?php echo date('Y-m-d H:i:s', $one['add_time']) ?></td>
        </tr>
            <?php endforeach?>
        <?php else: ?>
        <!--没有关注-->
        <tr>
            <td colspan="6"><span class="noNode">目前还没有充值记录</span></td>
        </tr>
        <!--没有关注end-->
        <?php endif?>
    </table>
    <?php $this->renderPartial('/site/pager', array('all'=>$pager['total'], 'all_page'=>$pager['pages'], 'page'=>$pager['page'], 'size'=>$size))?>
    <!--我关注的 end-->
</div>
<!--个人信息 end-->
<?php $this->renderPartial('/account/foot')?>
