<div class="menuSide">
    <ul class="bankStyle">
        <?php foreach($pay_list as $one):?>
            <li <?php if($one['pay_code'] == $pay_type): ?>class="current"<?php endif?>>
                <a href="/pay/index?paytype=<?php echo $one['pay_code'] ?>&orid=0" title="">
                    <?php if ($one['pay_name'] == '支付宝'): ?>
                        <img src="/css/img/zfbLogo.png" alt="支付宝" />
                    <?php endif?>
                    <?php if ($one['pay_name'] == '易宝支付'): ?>
                        <img src="/css/img/ybzfLogo.png" alt="易宝支付" />
                    <?php endif?>
                    <?php if ($one['pay_name'] == '网银在线'): ?>
                        <img src="/css/img/wyzxLogo.png" alt="网银在线" />
                    <?php endif?>
                    <?php if ($one['pay_name'] == '财付通'): ?>
                        <img src="/css/img/cftLogo.png" alt="财付通" />
                    <?php endif?>
                </a></li>
        <?php endforeach?>
    </ul>
</div>
