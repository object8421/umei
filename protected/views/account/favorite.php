<?php $this->renderPartial('/account/head') ?>
<!--个人信息-->
<div class="personCenter pd">
    <!--我关注的-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
        <tr>
            <th>房间图标</th>
            <th>房间名</th>
            <th>主播等级</th>
            <th>操作</th>
        </tr>
        <?php if ($fav): ?>
            <?php foreach ($fav as $one): ?>
                <tr class="thumContentbg">
                    <td>
                <span class="focusimg">
                    <?php if ($one['room_icon']): ?>
                        <img src="<?php echo $one['room_icon_url'] ?><?php echo $one['room_icon'] ?>"/>
                    <?php else: ?>
                        <img src="images/room_icon.gif"/>
                    <?php endif ?>
                </span>
                    </td>
                    <td><a href="/<?php echo $one['anchor_info']['anchor_id'] ?>"
                           target="_blank"><?php echo $one['room_name'] ?></a></td>
                    <td><i class="zhuboIco zb<?php echo $one['anchor_info']['anchor_level'] ?>"></i></td>
                    <td><a class="J_cancel_attention" href="javascript:void(0);"
                           data-url="/room/delFav?room_id=<?php echo $one['room_id'] ?>" title="">取消关注</a></td>
                </tr>
            <?php endforeach ?>
        <?php else: ?>
            <!--没有关注-->
            <tr>
                <td colspan="4"><span class="noNode">您还没有关注房间</span></td>
            </tr>
            <!--没有关注end-->
        <?php endif ?>
    </table>
    <?php $this->renderPartial('/site/pager', array('all' => $pager['total'], 'all_page' => $pager['pages'], 'page' => $pager['page'], 'size' => $size)) ?>
    <!--我关注的 end-->

    <script src="/js/libraries/jquery-1.11.1.js"></script>
    <script>
        $('.J_cancel_attention').click(function (data) {
            var that = this
            $.post($(this).data('url'), function (data) {
                var obj = $.parseJSON(data);
                $('#pager b:not(:last)').text(function (i, n) {
                    return n - 1
                })
                if ($('#pager b:first').text() == 0) {
                    $('.tableData').append('<tr><td colspan="4"><span class="noNode">您还没有关注房间</span></td></tr>')
                }
                if (obj.error == 0) {
                    $(that).closest('tr').remove()
                }
            })
        })
    </script>
</div>
<!--个人信息 end-->
<?php $this->renderPartial('/account/foot') ?>
