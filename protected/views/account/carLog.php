<?php $this->renderPartial('/account/head') ?>
<!--座驾记录-->
<div class="personCenter pd">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
        <tr>
            <th>道具名称</th>
            <th>获得方式</th>
            <th>道具数量</th>
            <th>购买时间</th>
            <th>到期时间</th>
        </tr>
        <?php if ($data): ?>
        <?php foreach($data as $one):?>
        <tr class="thumContentbg">
            <td><?php echo $one['name'] ?></td>
            <td><?php if ($one['log_type'] == 0): ?>U币购买<?php else:?>赠送<?php endif?></td>
            <td><?php echo $one['car_sum'] ?></td>
            <td><?php echo $one['add_time'] ?></td>
            <td><?php echo $one['expire_time'] ?></td>
        </tr>
            <?php endforeach?>
        <?php else:?>
        <tr>
            <td colspan="5"><span class="noNode">您未购买过座驾</span></td>
        </tr>
        <?php endif?>
    </table>
</div>
<!--座驾记录 end-->
<?php $this->renderPartial('/account/foot') ?>
