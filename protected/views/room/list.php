<div class="hotHost">
    <h3><span>人气主播推荐</span></h3>
    <div class="hotHostList">
        <ol>
            <?php foreach($rooms as $one):?>
                <li>
                    <div class="hotHostPic">
                        <?php if ($one['start_time'] != ''): ?>
                            <div class="onlineIco">直播</div>
                        <?php endif?>
                        <b class="numberIco"><?php echo $one['active_user'] ?></b>
                        <a href="/<?php echo $one['anchor_info']['anchor_id']?$one['anchor_info']['anchor_id']:$one['uid']?>" title="" target="_blank">
                            <?php if ($one['room_icon']): ?>
                                <img src="<?php echo $one['room_icon_url'] ?><?php echo $one['room_icon'] ?>" alt="" />
                            <?php else:?>
                                <img src="/images/room_icon.gif"/>
                            <?php endif?>
                            <div class="playIco">播放按钮</div>
                            <span class="hotHostTitle"><i class="zhuboIco zb<?php echo $one['anchor_info']['anchor_level'] ?>"></i><?php echo $one['room_name'] ?></span>
                        </a>
                    </div>
                    <div class="hotHostInfor">
                        <p>关注：<b><?php echo $one['fans'] ?></b></p>
                        <p>
                        <span class="hotHostStop">
                            <?php if ($one['start_time'] == ''): ?>
                                暂未直播
                            <?php else:?>
                                <?php echo $one['start_time'] ?>开播
                            <?php endif?>
                        </span>
                        </p>
                    </div>
                </li>
            <?php endforeach?>
        </ol>
    </div>
</div>
