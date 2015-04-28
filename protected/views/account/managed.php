<?php $this->renderPartial('/account/head') ?>
<!--个人信息-->
<div class="personCenter pd">
    <!--我关注的-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
        <tr>
            <th>房间图标</th>
            <th>房间名</th>
            <th>主播等级</th>
        </tr>
        <?php if ($data): ?>
        <?php foreach($data as $one):?>
        <tr class="thumContentbg">
            <td>
                <span class="focusimg">
                    <?php if($one['room_icon']): ?>
                        <img src="<?php echo $one['room_icon_url'] ?><?php echo $one['room_icon'] ?>" />
                    <?php else: ?>
                        <img src="images/room_icon.gif"/>
                    <?php endif?>
                </span>
            </td>
            <td><a href="/<?php echo $one['anchor_info']['anchor_id'] ?>" target="_blank"><?php echo $one['room_name'] ?></a></td>
            <td><i class="zhuboIco zb<?php echo $one['anchor_info']['anchor_level'] ?>"></i></td>
        </tr>
    <?php endforeach?>
    <?php else: ?>
        <!--没有关注-->
        <tr>
            <td colspan="3"><span class="noNode">您还不是房间管理</span></td>
        </tr>
        <!--没有关注end-->
    <?php endif?>
    </table>
    <?php $this->renderPartial('/site/pager', array('all'=>$pager['total'], 'all_page'=>$pager['pages'], 'page'=>$pager['page'], 'size'=>$size))?>
    <!--我关注的 end-->
</div>
<!--个人信息 end-->
<?php $this->renderPartial('/account/foot')?>
