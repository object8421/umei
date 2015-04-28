<?php
$c = array('scanFirst', 'scanSecond', 'scanThird');
?>
<?php foreach($data as $i => $one):?>
    <li class="<?php echo $c[$i] ?>">
        <div class="hotHostPic">
            <?php if ($one['start_time']): ?>
                <div class="onlineIco">直播</div>
            <?php endif?>
            <div class="whiteMaster"></div>
            <b class="numberIco"><?php echo $one['active_user'] ?></b>
            <a href="/<?php if($one['anchor_info']['anchor_id'])echo $one['anchor_info']['anchor_id'];else echo $one['uid'] ?>" title="" target="_blank">
                <?php if($one['room_icon']): ?>
                    <img src="<?php echo $one['room_icon_url'].$one['room_icon']; ?>" alt="" />
                <?php else: ?>
                    <img src="/images/room_icon.gif"/>
                <?php endif ?>
                <div class="playIco">播放按钮</div>
                <span class="hotHostTitle"><i class="chaoIco c1"></i><?php echo $one['anchor_info']['nickname'] ?></span>
            </a>
            <?php if ($i == 2): ?>
                <p><?php if($one['anchor_info']['anchor_id'])echo $one['anchor_info']['anchor_id'];else echo $one['uid'] ?></p>
                <p>
                    <?php if ($one['start_time']): ?>
                        <?php echo $one['start_time'] ?>开播
                    <?php else:?>
                        暂未开播
                    <?php endif?>
                </p>
            <?php endif?>
        </div>
    </li>
<?php endforeach?>