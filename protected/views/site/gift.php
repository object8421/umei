<?php foreach($list as $cat_id => $l): ?>
<div class="liveGiftsBox"<?php if ($cat_id == 1): ?>  style="display: block;"<?php endif ?>>
    <ul>
        <?php foreach ($l as $one):?>
        <li onclick=SelectGift('{"GIFTID":<?php echo $one['gift_id'] ?>,"NAME":"<?php echo $one['gift_name'] ?>","PRICE":<?php echo $one['gift_price'] ?>,"LEVEL":0}',this)><i></i><img src="/upload/gift_img/<?php echo $one['gift_img'] ?>" alt="<?php echo $one['gift_name'] ?>：<?php echo $one['gift_price'] ?>U币" width="46px" height="46px"/></li>
        <?php endforeach?>
    </ul>
</div>
<?php endforeach?>