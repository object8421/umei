<?php
if (User::info()) {
    $login = 1;
}else{
    $login = 0;
}
?>
<?php $this->renderPartial('/shop/head') ?>
<script type="text/javascript">
    function buy(id){
        var logined = '<?php echo $login ?>';
        if(!logined){
            if(jQuery(".masterEle").css("display")=="none"){
                jQuery("#loginBox").click();
                return;
            }
        }
        jQuery.ajax({
            type: "get",
            url: "/shop/buyVip/"+id,
            success: function (data,status) {
                var ms = JSON.parse(data);
                if(ms.error==0){
                    $("#returnmsg").html(ms.message);
                    $("#tips02").click();
                    //window.parent.location.reload();
                }else{
                    $("#returnmsg").html(ms.message);
                    $("#tips02").click();
                }
            }
        })
    }
</script>
<div class="carShop VIPShop">
    <ul>
        <?php if ($data): ?>
            <?php foreach($data as $one):?>
                <li>
                    <span class="carShopPic"><i></i><img src="/images/VipShop.png" alt="" /></span>
                    <div class="carShopDetail">
                        <strong><?php echo $one['name'] ?></strong>
                        <p>
                            u币购买<br />
                            价格：<span><?php echo $one['price'] ?></span>U币<br />
                            （有效期<?php echo ceil($one['expire_time']/86400) ?>天）
                        </p>
                        <p><a href="javascript:buy('<?php echo $one['id'] ?>')" title="" class="buyIco">我要购买</a></p>
                    </div>
                </li>
            <?php endforeach?>
        <?php else:?>
            <li>目前还没有道具出售</li>
        <?php endif?>
    </ul>
</div>
<?php $this->renderPartial('/shop/foot') ?>
