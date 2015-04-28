<?php $this->renderPartial('/account/head') ?>
<!--我的VIP-->
<div class="personCenter pd">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
        <tr>
            <th>名称</th>
            <th>获得方式</th>
            <th>获得时间</th>
            <th>到期时间</th>
        </tr>
        <?php if ($data): ?>
        <?php foreach($data as $one):?>
        <tr class="thumContentbg">
            <td><i class="vipIco"></i><?php echo $one['name'] ?></td>
            <td><?php if ($one['type'] == 0): ?>购买<?php else:?>赠送<?php endif?></td>
            <td><?php echo $one['start_time'] ?></td>
            <td><?php echo $one['expire_time'] ?></td></tr>
            <?php endforeach?>
        <?php else:?>
        <!--没有VIP-->
        <tr>
            <td colspan="4"><span class="noNode">您还不是VIP会员</span></td>
        </tr>
        <!--没有VIPend-->
        <?php endif?>
    </table>
</div>
<!--我的VIP end-->
<?php $this->renderPartial('/account/foot') ?>
