<?php $this->renderPartial('/account/head') ?>
<!--房间信息-->
<div class="pubform changeInfor1">
    <!--tab导航-->
    <div class="tabList">
        <ul>
            <li style="margin-right:10px;"><a href="/account/roomInfo/<?php echo $data['room_id'] ?>" title="">房间信息</a></li>
            <li class="current"><a href="/account/setRoom/<?php echo $data['room_id'] ?>" title="">设置管理</a></li>
        </ul>
    </div>
    <!--tab导航 end-->
    <ul>
        <li>
            <em class="pfTitle">房间名称：</em>
            <em><span><?php echo $data['room_name'] ?></span></em>
        </li>
        <li>
            <form action="/account/addRoomAdmin" method="get" id="addmanform">
                <em class="pfTitle">用户UID：</em>
                <em><span class="spanInput spanInputErro"><input type="text" size="20" maxlength="20" name="uid" id="gid" onkeyup="value=value.replace(/[^\d]/g,'')"/></span></em>
                <input type="hidden" value="<?php echo $data['room_id'] ?>" name="room_id">
                <input type="submit" value="添加" class="btn" style="display: none;"/>
                <a href="javascript:;" title="" class="whiteBtn" onclick="addmanage()"><i>添加</i></a>
            </form>
            <script>
                function addmanage(){
                    $("#addmanform").submit();
                }
            </script>
        </li>
        <li>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
                <tr>
                    <th>昵称</th>
                    <th>号码</th>
                    <th>操作</th>
                </tr>
                <?php if ($manager): ?>
                <?php foreach($manager as $one):?>
                <tr class="thumContentbg">
                    <td><?php if($one['nickname'])echo $one['nickname'];else echo $one['username'] ?></td>
                    <td><?php if($one['gid'])echo $one['gid'];else echo $one['uid'] ?></td>
                    <td><a href="/account/delFromRoom/user/<?php echo $one['uid'] ?>/room/<?php echo $data['room_id'] ?>" title="">删除</a></td>
                </tr>
                    <?php endforeach?>
                <?php else: ?>
                <!--没有管理-->
                <tr>
                    <td colspan="3"><span class="noNode">目前还没有管理</span></td>
                </tr>
                <!--没有管理end-->
                <?php endif?>
            </table>
        </li>
    </ul>
</div>
<!--房间信息 end-->
<?php $this->renderPartial('/account/foot') ?>
