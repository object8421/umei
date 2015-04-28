<?php $this->renderPartial('/account/head') ?>
<!--我的座驾-->
<div class="carShop mycar">
    <ul>
        <?php if ($data): ?>
        <?php foreach($data as $one):?>
        <li class="have">
            <span class="carShopPic"><i></i><img src="/upload/car_img/<?php echo $one['img'] ?>" alt="" /></span>
            <div class="carShopDetail">
                <strong><?php echo $one['name'] ?></strong>
                <p>Ｕ币道具<br />状态：正常<br />(有效期：<?php echo $one['expire_time'] ?>)</p>
                <p>
                    <?php if (!$one['used']): ?>
                    <a href="/account/setCar/<?php echo $one['id'] ?>" title="" class="buyIco">启用</a>
                    <?php else:?>
                    <a class="buyIco" href="javascript:;">使用中</a>
                    <?php endif?>
                </p>
            </div>
        </li>
        <?php endforeach?>
        <?php else:?>
        <li class="nohave">
        <b>你目前还没有座驾</b>
        <a href="/shop/car">请前往商城购买</a>
        </li>
        <?php endif?>
    </ul>
</div>
<!--我的座驾 end-->
<?php $this->renderPartial('/account/foot') ?>
