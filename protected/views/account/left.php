<?php
$action = Yii::app()->controller->action->id;
$is_family_head = 0;
if ($token = Logic::getToken()){
    $r = Api::getData('user', 'isFamilyHead', array('token'=>$token));
    if ($r) {
        $is_family_head = $r['head'];
    }
}
?>
<div class="menuSide">
    <!-- 个人中心菜单begin -->
    <dl <?php if(in_array($action, array('info', 'changePwd', 'changeName', 'changeInfo', 'setMail', 'favorite', 'managed'))):?>class="current"<?php endif?>>
        <dt><a href="#" title="">个人信息>></a></dt>
        <dd <?php if ($action == 'info'): ?>class="current"<?php endif?>><a href="/account/info" title=""> >>个人资料</a></dd>
        <dd <?php if ($action == 'changeName'): ?>class="current"<?php endif?>><a href="/account/changeName" title=""> >>修改昵称</a></dd>
        <dd <?php if ($action == 'changePwd'): ?>class="current"<?php endif?>><a href="/account/changePwd" title=""> >>修改密码</a></dd>
        <dd <?php if ($action == 'changeInfo'): ?>class="current"<?php endif?>><a href="/account/changeInfo" title=""> >>其他资料修改</a></dd>
        <dd <?php if ($action == 'setMail'): ?>class="current"<?php endif?>><a href="/account/setMail" title=""> >>设置密保邮箱</a></dd>
        <dd <?php if ($action == 'favorite'): ?>class="current"<?php endif?>><a href="/account/favorite" title=""> >>我的关注</a></dd>
        <dd <?php if ($action == 'managed'): ?>class="current"<?php endif?>><a href="/account/managed" title=""> >>我的管理</a></dd>
    </dl>
    <dl <?php if ($action == 'rechargeList'): ?>class="current"<?php endif?>>
        <dt><a href="#" title="">充值记录>></a></dt>
        <dd <?php if ($action == 'rechargeList'): ?>class="current"<?php endif?>><a href="/account/rechargeList" title=""> >>充值记录</a></dd>
    </dl>
    <dl <?php if ($action == 'bean'): ?>class="current"<?php endif?>>
        <dt><a href="#" title="">U豆兑换>></a></dt>
        <dd <?php if ($action == 'bean'): ?>class="current"<?php endif?>><a href="/account/bean" title=""> >>U豆兑换</a></dd>
        <!--<dd><a href="#" title=""> >>U豆兑换记录</a></dd> -->
    </dl>
    <dl <?php if (in_array($action, array('car', 'number', 'vip'))): ?>class="current"<?php endif?>>
        <dt><a href="#" title="">我的道具>></a></dt>
        <dd <?php if ($action == 'car'): ?>class="current"<?php endif?>><a href="/account/car" title=""> >>我的座驾</a></dd>
        <dd <?php if ($action == 'number'): ?>class="current"<?php endif?>><a href="/account/number" title=""> >>我的靓号</a></dd>
        <dd <?php if ($action == 'vip'): ?>class="current"<?php endif?>><a href="/account/vip" title=""> >>我的VIP</a></dd>
    </dl>
    <dl <?php if ($action == 'carLog'): ?>class="current"<?php endif?>>
        <dt><a href="#" title="">购买记录>></a></dt>
        <dd <?php if ($action == 'carLog'): ?>class="current"<?php endif?>><a href="/account/carLog" title="">>>座驾记录</a></dd>
        <!--<dd><a href="#" title="">靓号记录>></a></dd>
        <dd><a href="#" title="">VIP记录>></a></dt>-->
    </dl>
    <dl <?php if (in_array($action, array('sendGiftLog', 'recvGiftLog'))): ?>class="current"<?php endif?>>
        <dt><a href="#" title="">礼物记录>></a></dt>
        <dd <?php if ($action == 'recvGiftLog'): ?>class="current"<?php endif?>><a href="/account/recvGiftLog" title="">>>我收到的礼物</a></dd>
        <dd <?php if ($action == 'sendGiftLog'): ?>class="current"<?php endif?>><a href="/account/sendGiftLog" title="">>>我送出的礼物</a></dd>
    </dl>
    <?php if($this->user_info['is_anchor'] || $this->user_info['is_vice_anchor']):?>
        <dl
            <?php if (in_array($action, array('myRoom', 'roomInfo', 'setRoom', 'exchangeList', 'micTime', 'fans', 'micDay'))): ?> class="current"<?php endif?>>
            <dt><a href="#" title="">主播操作>></a></dt>
            <dd <?php if (in_array($action, array('myRoom', 'roomInfo', 'setRoom'))): ?>class="current"<?php endif?>><a href="/account/myRoom" title="">>>我的房间</a></dd>
            <dd <?php if ($action == 'exchangeList'): ?>class="current"<?php endif?>><a href="/account/exchangeList" title="">>>兑换记录</a></dd>
            <dd <?php if ($action == 'micTime'): ?>class="current"<?php endif?>><a href="/account/micTime" title="">>>在麦时长</a></dd>
            <dd <?php if ($action == 'micDay'): ?>class="current"<?php endif?>><a href="/account/micDay" title="">>>有效天数</a></dd>
            <dd <?php if ($action == 'fans'): ?>class="current"<?php endif?>><a href="/account/fans" title="">>>我的粉丝</a></dd>
        </dl>
    <?php endif?>
    <?php if($is_family_head):?>
        <dl
            <?php if (in_array($action, array('family', 'familyView', 'familyApply'))): ?>class="current"
            <?php endif?>>
            <dt><a href="#" title="">社团操作>></a></dt>
            <dd
                <?php if ($action == 'family'): ?>class="current"<?php endif?>><a href="/account/family" title="">>>管理社团</a></dd>
        </dl>
    <?php endif?>
</div>