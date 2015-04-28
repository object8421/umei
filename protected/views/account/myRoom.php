<?php $this->renderPartial('/account/head') ?>
<!--我的房间-->
<div class="personCenter pd">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
        <tr>
            <th>房间</th>
            <th>级别</th>
            <th>操作</th>
        </tr>
        <?php if ($data): ?>
            <?php foreach($data as $one):?>
                <tr class="thumContentbg">
                    <td><?php echo $one['room_name'] ?></td>
                    <td><?php if ($one['type'] == 1): ?>房主<?php else: ?>副房主<?php endif?></td>
                    <td><a href="/account/roomInfo/<?php echo $one['room_id'] ?>" title="">管理</a></td>
                </tr>
            <?php endforeach?>
        <?php else: ?>
            <tr><td colspan="3" align="center" bgcolor="#ffffff">目前还没有房间</td></tr>
        <?php endif?>
    </table>
</div>
<!--我的房间 end-->
<?php $this->renderPartial('/account/foot') ?>
