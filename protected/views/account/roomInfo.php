<?php $this->renderPartial('/account/head') ?>
<!--房间信息-->
<div class="pubform changeInfor1">
    <!--tab导航-->
    <div class="tabList">
        <ul>
            <li class="current" style="margin-right:10px;"><a href="/account/roomInfo/<?php echo $data['room_id'] ?>" title="">房间信息</a></li>
            <li><a href="/account/setRoom/<?php echo $data['room_id'] ?>" title="">设置管理</a></li>
        </ul>
    </div>
    <!--tab导航 end-->
    <ul><li style="padding-left:10px;">
            <h3>当前直播间图片</h3>
                 <span>
                     <?php if ($data['room_icon']): ?>
                         <img src="<?php echo $data['room_icon_url'] ?><?php echo $data['room_icon'] ?>" style="
    width: 400px;
    height: 300px;
">
                     <?php else:?>
                         <img src="/images/room_icon.gif">
                     <?php endif?>
                 </span>
            <p><a href="javascript:show_upload();" title="">上传图片</a></p>
            <div id="upload_room_img" class="f-dn">
                <form id="up_pic" action="/account/roomInfo/<?php echo $data['room_id'] ?>" method="post" enctype="multipart/form-data">
                    <input type="file" class="" name="file" id="file">
                    <input type="submit" value="上传"/>
                </form>
            </div>
        </li>
        <form action="/account/roomInfo/<?php echo $data['room_id'] ?>" method="post" id="up_info">
            <li>
                <em class="pfTitle">房间名称：</em>
                <em><span><?php echo $data['room_name'] ?></span></em>

            </li>
            <li>
                <em class="pfTitle">欢迎蜜语：</em>
                <em><span class="spanInput"><input name="welcome" type="text" size="20" maxlength="20" value="<?php echo $data['welcome'] ?>"/></span></em>
            </li>
            <li>
                <em class="pfTitle">房间公告：</em>
                <em>
                    <textarea maxlength="20" name="notice" cols="" rows="" class="textArea"><?php echo $data['notice'] ?></textarea>
                </em>
            </li>
            <input type="hidden" value="<?php echo $data['room_id'] ?>" name="room_id">
        </form>
    </ul>
    <div class="subIco1">
        <a href="javascript:;" title="" class="whiteBtn" onclick="$('#up_info').submit()"><i>保存修改</i></a>
    </div>
</div>
<!--房间信息 end-->
<script type="text/javascript">
    var upload_show = 0;
    function show_upload(){
        if (upload_show){
            $("#upload_room_img").hide();
            upload_show = 0;
        }
        else{
            $("#upload_room_img").show();
            upload_show = 1;
        }
    }
    function submitform(){
        $("form:last").submit();
    }
</script>
<?php $this->renderPartial('/account/foot') ?>
