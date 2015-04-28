<div class="menuSide">
    <dl class="current">
        <dt>商城</dt>
        <dd <?php if (Yii::app()->controller->action->id == 'car'): ?>class="current"<?php endif?>><a href="/shop/car" title=""> >>座驾商城</a></dd>
        <dd <?php if (Yii::app()->controller->action->id == 'number'): ?>class="current"<?php endif?>><a href="/shop/number" title=""> >>靓号商城</a></dd>
        <dd <?php if (Yii::app()->controller->action->id == 'vip'): ?>class="current"<?php endif?>><a href="/shop/vip" title=""> >>VIP商城</a></dd>
    </dl>
</div>