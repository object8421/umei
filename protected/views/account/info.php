<?php $this->renderPartial('/account/head') ?>
                <!--个人信息-->
                <div class="personCenter pd">
                    <!--个人资料-->
                    <div class="pubform myInfor">
                        <div class="myInforTou">
                            <h3>当前头像</h3>
                                    <span class="myTouxiang">
                                     <?php if($info['avatar']!='' && $info['avatar']!='/upload/avatar/'):?>
									   <img class="ava0" src="<?php echo $info['avatar']?>" >
									 <?php else: ?>
									   <img class="ava0" src="/images/avatar.jpg">
									 <?php endif?>
                                    </span>
                            <div class="f-dn" id="upload_ava_img">
                                <form action="/account/setAvatar" method="post" enctype="multipart/form-data">
                                    <input type="file" class="" name="file" id="file">
                                    <input type="submit" value="上传"/>
                                </form>
                            </div>
                            <p><a href="javascript:show_avatar_upload();">上传图片</a>&nbsp;&nbsp;<?php if(isset($msg))echo $msg ?></p>
                        </div>
                        <div class="myInforList">
                            <ul>
                                <li>
                                    <em class="pfTitle">账号：</em>
                                    <em><span><?php echo $info['username']?></span></em>
                                </li>
                                <li>
                                    <em class="pfTitle">号码：</em>
                                    <em><span><?php echo $info['uid'] ?></span></em>
                                </li>
                                <li>
                                    <em class="pfTitle">靓号：</em>
                                    <em><span><?php if($info['anchor_id'])echo $info['anchor_id'] ?></span>
                                        <?php if(strlen($info['anchor_id']) < 8 && strlen($info['anchor_id']) > 1): ?>
                                            <i class="lhIco"></i>
                                        <?php endif ?>
                                    </em>
                                </li>
                                <li>
                                    <em class="pfTitle">昵称：</em>
                                    <em><span><?php echo $info['nickname'] ?></span></em>
                                </li>
                                <li>
                                    <em class="pfTitle">性别：</em>
                                    <em><span><?php if ($info['sex'] == 1): ?>男<?php else: ?>女<?php endif?></span></em>
                                </li>
                                <li>
                                    <em class="pfTitle">生日：</em>
                                    <em><span><?php if($info['birth'])echo date('Y-m-d', $info['birth']) ?></span></em>
                                </li>
                                <li>
                                    <em class="pfTitle">U币：</em>
                                    <em><i class="ubIco"></i><span><?php echo $info['coin'] ?></span></em>
                                </li>
                                <li>
                                    <em class="pfTitle">U豆：</em>
                                    <em><i class="udIco"></i><span><?php echo $info['bean'] ?></span></em>
                                </li>
                                <li>
                                    <em class="pfTitle">爵位：</em>
                                    <?php if ($info['user_level']>0): ?>
                                    <em><span class="jwIco V<?php echo $info['user_level'] ?>"></span></em>
                                    <?php else: ?>
                                    <em><span>无</span></em>
                                    <?php endif?>
                                </li>
                                <li>
                                    <em class="pfTitle">VIP：</em>
                                    <?php if ($info['vip']): ?>
                                    <em><span class="vipIco"></span></em>
                                    <?php else: ?>
                                    <em><span>无</span></em>
                                    <?php endif?>
                                </li>
                                <?php if ($info['is_anchor']): ?>
                                <li>
                                    <em class="pfTitle">魅力：</em>
                                    <em><span class="zhuboIco zb<?php echo $info['anchor_level'] ?>"></span></em>
                                </li>
                                <li>
                                    <em class="pfTitle">升级到：</em>
                                    <em><span class="zhuboIco zb<?php echo $info['anchor_next_level'] ?>"></span><span>还差<?php echo $info['anchor_next_need'] ?>U豆</span></em>
                                </li>
                                <?php endif?>
                            </ul>
                            <div class="pfTitle01">
                                <div class="pfTitle02">签名：</div>
                                <div class="pfTitle03"><?php echo $info['sign'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--个人资料 end-->
                </div>
                <!--个人信息 end-->
<?php $this->renderPartial('/account/foot')?>
<!--个人中心 end-->
<script type="text/javascript">
    var upload_ava_show = 0;
    function show_avatar_upload(){
        if (upload_ava_show){
            $("#upload_ava_img").hide();
            upload_ava_show = 0;
        }
        else{
            $("#upload_ava_img").show();
            upload_ava_show = 1;
        }
    }
</script>