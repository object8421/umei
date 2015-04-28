<marquee id="affiche" align="left" behavior="scroll" direction="left" width="1200" loop="-1" scrollamount="3" scrolldelay="10">
    <li>
        <?php if ($messages): ?>
            <?php foreach($messages as $one):?>
                <a href="/<?php if($one['gid'] > 0)echo $one['gid'];else echo $one['uid']; ?>" title="" target="_blank">
                    <span class="liveTime"><?php echo $one['t'] ?></span>
                    <span class="white">[<?php echo $one['room_name'] ?>]房间</span>
            <span class="blue">
                <?php if ($one['from_title']): ?><i class="jwIco V<?php echo $one['from_title'] ?>"></i><?php endif?>
                <i class="vipIco"></i><?php echo $one['from_nickname'] ?>(<?php if($one['from_gid'] > 0)echo $one['from_gid'];else echo $one['from_uid'] ?>)
            </span>
                    <span class="white">送给</span>
                    <span class="yellow"><i class="chaoIco c1"></i><?php echo $one['to_nickname'] ?>(<?php if($one['to_gid']>0)echo $one['to_gid'];else echo $one['to_uid'] ?>)</span>
                    <span class="cyan"><?php echo $one['gift_sum'] ?><?php echo $one['gift_unit'] ?><?php echo $one['gift_name'] ?></span>
                    <span><img src="/upload/gift_img/<?php echo $one['gift_img'] ?>" width="35" height="35" /></span>
                </a>
            <?php endforeach?>
        <?php endif?>
    </li>
</marquee>