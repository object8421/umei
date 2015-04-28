<?php
if (User::info()) {
    $login = 1;
}else{
    $login = 0;
}
?>
<?php $this->renderPartial('/shop/head') ?>
<script type="text/javascript">
    function buy_num(gid){
        var logined = '<?php echo $login ?>';
        if(!logined){
            if(jQuery(".masterEle").css("display")=="none"){
                jQuery("#loginBox").click();
                return;
            }
        }
        jQuery.ajax({
            type: "get",
            url: "/shop/buyNumber/"+gid,
            success: function (data,status) {
                var ms = JSON.parse(data);
                if(ms.error==0){
                    $("#returnmsg").html("购买成功");
                    $("#tips02").click();
                    setTimeout(function(){
                        window.parent.location.reload();
                    },2000);

                    //window.parent.location.reload();
                }else{
                    $("#returnmsg").html(ms.message);
                    $("#tips02").click();
                }
            }
        })
    }
</script>
<div class="lianghaoShop">
    <ul>
        <?php if ($data): ?>
            <?php foreach($data['list'] as $one):?>
                <li>
                    <strong><?php echo $one['gid'] ?></strong>
                    <p>
                        u币购买<br />
                        价格：<span><?php echo $one['sale_point'] ?></span>U币<br />
                        （有效期30天）
                    </p>
                    <p><a href="javascript:buy_num('<?php echo $one['gid'] ?>')" title="" class="buyIco">我要购买</a></p>
                </li>
            <?php endforeach?>
        <?php else:?>
            <li>暂时没有找到您想要的号码</li>
        <?php endif?>
    </ul>
    <?php if ($data): ?>
        <?php $this->renderPartial('/site/pager', array('all'=>$data['all'], 'all_page'=>$data['all_page'], 'page'=>$data['page'], 'size'=>$size))?>
    <?php endif?>
</div>
<?php $this->renderPartial('/shop/foot') ?>
