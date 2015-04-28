<?php $this->renderPartial('/account/head') ?>
<!--我的粉丝-->
<div class="pubform changeInfor1">
    <ul>
        <li>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
                <tr>
                    <th>昵称</th>
                    <th>靓号</th>
                    <th>身份</th>
                </tr>
                <?php if ($data): ?>
                <?php foreach($data as $one):?>
                <tr class="thumContentbg">
                    <td><?php echo $one['nickname'] ?></td>
                    <td><?php if($one['gid']>0)echo $one['gid'];else echo $one['uid'] ?></td>
                    <td><?php ?>'<i class="jwIco V<?php echo $one['level'] ?>"></i><?php ?></td>
                </tr>
                    <?php endforeach?>
                <?php else: ?>
                <!--没有粉丝-->
                <tr>
                    <td colspan="3"><span class="noNode">目前还没有粉丝</span></td>
                </tr>
                <?php endif?>
                <!--没有粉丝end-->
            </table>  <!--翻页-->
            <?php $this->renderPartial('/site/pager', array('all'=>$pager['total'], 'all_page'=>$pager['pages'], 'page'=>$pager['page'], 'size'=>$size))?>
            <!--翻页 end-->
        </li>
    </ul>
</div>
<!--我的粉丝end-->
<?php $this->renderPartial('/account/foot') ?>
