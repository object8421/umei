<div class="thumBox">
    <div class="thumTitle"><span class="thumTitleName">客服中心---------------------------------------------------------------------------------->> <?php echo $title;?></span></div>
    <!--thumMid-->
    <div class="thumMid wd grayBg">
        <!--thumCon-->
        <div class="thumCon">
            <!--menuSide-->
            <?php $this->renderPartial('left');?>
            <!--menuSide end-->
            <!--thumContent-->
            <div class="thumContent">

                <!--重新设置-->
                <div class="pubform changeInfor1">
                    <!--tab导航-->
                    <div class="tabList">
                        <ul>
                            <li class="current"  style="padding-left:30px;"><a href="#" title="">重新设置密码</a></li>
                        </ul>
                    </div>
                    <!--tab导航 end-->
                    <ul>
                        <!--填写资料-->
                        <li>
                            <em class="pfTitle">新密码：</em>
                            <em><span class="spanInput"><input maxlength="20" id="newpassword" type="password" /></span></em>
                        </li>
                        <li>
                            <em class="pfTitle">确认新密码：</em>
                            <em><span class="spanInput"><input maxlength="20" id="newconfirm_password" type="password" /></span></em>
                        </li>
                        <li>
                            <input type="hidden" value="<?php echo $verify ?>" id="verify">
                            <em class="zhmm001"><a class="whiteBtn" title="" href="javascript:;" onclick="do_reset_pwd()"><i>提交</i></a></em>
                        </li><!--填写资料end-->
                        <!--完成提示-->
                        <li><em><span class="zhmm003"></span></em>
                        </li><!--填写资料end-->
                    </ul>
                </div>
                <!--重新设置 end-->
                <script type="text/javascript">

                    function do_reset_pwd(){
                        if(jQuery("#newpassword").val() =="" || jQuery("#newconfirm_password").val()=="" || jQuery("#newconfirm_password").val()!=jQuery("#newpassword").val()){
                            jQuery(".zhmm003").html("新密码与确认新密码输入有误！请重新输入");
                            return;
                        }
                        jQuery(".zhmm003").html("");
                        $(".thumContent").showLoading();
                        jQuery.ajax({
                            type: "post",
                            data: {"newpassword":jQuery("#newpassword").val(),"newconfirm_password":jQuery("#newconfirm_password").val(),"verify":jQuery("#verify").val()},
                            url: "/service/setPassword",
                            success: function (data,status) {
                                jQuery('.thumContent').hideLoading();
                                var ms = JSON.parse(data);
                                if(ms.error==0){
                                    jQuery(".zhmm003").html(ms.message);
                                    setTimeout(function(){
                                        location='/';
                                    },300);
                                }else{
                                    jQuery(".zhmm003").html(ms.message);
                                }
                            }
                        });
                    }
                </script>

            </div>
            <!--thumContent end-->
        </div>
        <!--thumCon end-->
    </div>
    <!--thumMid end-->
</div>