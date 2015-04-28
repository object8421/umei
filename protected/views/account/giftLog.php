<?php $this->renderPartial('/account/head') ?>
<!--我收到的礼物-->
<div class="personCenter pd">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
        <tr>
            <th>礼物名称</th>
            <th><?php if ($type == 'recv'): ?>赠送人<?php else:?>接收人<?php endif?></th>
            <th>数量</th>
            <th><?php if ($type == 'recv'): ?>获得Ｕ豆<?php else:?>礼物价值<?php endif?></th>
            <th>房间</th>
            <th>时间</th>
        </tr>
        <?php if ($data): ?>
        <?php foreach($data as $one):?>
        <tr class="thumContentbg">
            <td>
                <div class="wsddlw01">
                    <div class="wsddlw03">
                        <img src="/upload/gift_img/<?php echo $one['gift_thumb_img'] ?>" />
                    </div>
                    <div class="wsddlw02">
                        <?php echo $one['gift_name'] ?>
                    </div>
                </div>
                </td>
            <td><?php if ($type == 'recv'): ?><?php echo $one['from_nickname'] ?>（<?php echo $one['from_uid'] ?>）<?php else:?><?php echo $one['to_nickname'] ?>（<?php echo $one['to_uid'] ?>）<?php endif?></td>
            <td><?php echo $one['gift_sum'] ?></td>
            <td><?php if ($type == 'recv'): ?><?php echo $one['total_bean'] ?><?php else:?><i class="ubIco"></i><?php echo $one['total_price'] ?><?php endif?></td>
            <td><?php echo $one['room_name'] ?></td>
            <td><?php echo date('Y-m-d H:i:s', $one['add_time']) ?></td></tr>
            <?php endforeach?>
        <?php else:?>
        <!--没有礼物-->
        <tr>
            <td colspan="6"><span class="noNode">目前还没有<?php if ($type == 'recv'): ?>收到<?php else:?>送出<?php endif?>过礼物</span></td>
        </tr>
        <?php endif?>
        <!--没有礼物 end-->
    </table>
    <?php $this->renderPartial('/site/pager', array('all'=>$pager['total'], 'all_page'=>$pager['pages'], 'page'=>$pager['page'], 'size'=>$size))?>
</div>
<!--我收到的礼物 end-->
<?php $this->renderPartial('/account/foot') ?>
