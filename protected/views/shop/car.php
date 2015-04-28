<?php
if(User::info()){
    $login = 1;
}else{
    $login = 0;
}
?>
<?php $this->renderPartial('/shop/head') ?>

<div class="carShop">
    <ul>
        <?php if ($car_list): ?>
        <?php foreach($car_list as $car):?>
        <?php if ($car['is_hidden'] == 0): ?>
        <li>
            <span class="carShopPic"><i></i><img src="/upload/car_img/<?php echo $car['img'] ?>" alt="" /></span>
            <div class="carShopDetail">
                <strong><?php echo $car['name'] ?></strong>
                <p>
                    u币购买<br />
                    价格：<span><?php echo $car['price'] ?></span>U币<br />
                    （有效期<?php echo ceil($car['expire_time']/86400) ?>天）
                </p>
                <p><a href="javascript:buy_car('<?php echo $car['id'] ?>')" title="" class="buyIco">我要购买</a></p>
            </div>
        </li>
        <?php endif?>
        <?php endforeach?>
        <?php else:?>
        <li>目前还没有道具出售</li>
        <?php endif?>
    </ul>
</div>
<?php $this->renderPartial('/shop/foot') ?>
<script src="/js/view/shop.car.js"></script>