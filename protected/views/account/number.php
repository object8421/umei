<?php $this->renderPartial('/account/head') ?>
<!--我的靓号-->
<div class="personCenter pd">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
        <tr>
            <th>靓号</th>
            <th>类型</th>
            <th>获得时间</th>
            <!-- <th>获得方式</th> -->
            <th>状态</th>
            <th>操作</th>
        </tr>
        <?php if ($data): ?>
            <?php foreach($data as $one):?>
                <tr class="thumContentbg">
                    <td><?php echo $one['gid'] ?></td>
                    <td><?php echo Logic::chineseNumber(strlen($one['gid'])) ?>位靓号</td>
                    <td><?php echo date('Y-m-d H:i:s', $one['sale_time']) ?></td>
                    <td><?php if ($one['is_useing']): ?>使用中<?php else:?>空闲中<?php endif?></td>
                    <td>
                        <?php if (!$one['is_useing']): ?>
                            <a href="javascript:;" onclick="use_gid('<?php echo $one['gid'] ?>')" style="color:#00F">使用</a>
                            | <a href="javascript:;" style="color:#00F" onclick="give_gid(<?php echo $one['gid'] ?>)">赠送</a>
                        <?php else:?>
                            <span style="color:#ccc">使用 | 赠送</span>
                        <?php endif?>
                    </td>
                </tr>
            <?php endforeach?>
        <?php else: ?>
            <!--没有靓号-->
            <tr>
                <td colspan="5"><span class="noNode">您还没有靓号</span></td>
            </tr>
        <?php endif?>
        <!--没有靓号end-->
    </table>
    <?php $this->renderPartial('/site/pager', array('all'=>$pager['total'], 'all_page'=>$pager['pages'], 'page'=>$pager['page'], 'size'=>$size))?>
</div>
<!--我的靓号 end-->
<script>
    function give_gid(gid){
        $("#nicegid").val(gid);
        $("#tips09").click();
    }
    function do_give_gid(gid){
        jQuery.ajax({
            type: "get",
            url: "/account/giftNumber/num/"+$("#nicegid").val()+"/to/"+$("#togid").val(),
            success: function (data,status) {
                var ms = JSON.parse(data);
                if(ms.error==0){
                    $("#returnmsg").html("赠送成功");
                    $("#tips02").click();
                    window.parent.location.reload();
                }else{
                    $("#returnmsg").html(ms.message);
                    $("#tips02").click();
                }
            }
        })
    }
    function use_gid(gid){
        jQuery.ajax({
            type: "get",
            url: "/account/setNumber/"+gid,
            success: function (data,status) {
                var ms = JSON.parse(data);
                if(ms.error==0){
                    jQuery("#usemsg"+gid).html("使用成功");
                    setTimeout(function(){
                        window.location.reload();
                    },500);

                    //window.parent.location.reload();
                }else{
                    jQuery("#usemsg").html(ms.message);
                }
            }
        })
    }
</script>
<?php $this->renderPartial('/account/foot') ?>
