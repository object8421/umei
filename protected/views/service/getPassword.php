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

                <!--找回密码-->
                <div class="pubform changeInfor1">
                    <!--tab导航-->
                    <div class="tabList">
                        <ul>
                            <li class="current"  style="padding-left:30px;"><a href="#" title="">密保邮箱方式找回密码</a></li>
                        </ul>
                    </div>
                    <!--tab导航 end-->
                    <ul>
                        <!--填写资料-->
                        <li>
                            <em class="pfTitle">账号名：</em>
                            <em><span class="spanInput1"><input id="return_username" type="text" size="25" maxlength="20" placeholder="请输入您要找回密码的账号" autocomplete="off" /></span></em><span class="zhmm004">密码重置链接将发送到您的安全邮箱</span>
                        </li>
                        <li>
                            <em class="pfTitle">验证码：</em>
                            <em><span class="spanInput2"><input id="return_captcha"  type="text" size="25" maxlength="20" /></span></em><em><span class="zhmm002"><img src="/captcha" alt="验证码" id="captcha_img"/></span></em><em><span><a href="javascript:;" id="change_captcha" title="">换一张</a></span></em></li>
                        <li>
                            <input type="hidden" value="{$formhash}" id="formhash">
                            <em class="zhmm001"><a class="whiteBtn" title="" href="javascript:;" onclick="ex_return_pwd()"><i>提交</i></a></em>
                        </li><!--填写资料end-->
                        <!--完成提示-->
                        <li><em><span class="zhmm003"></span></em>
                        </li><!--填写资料end-->
                    </ul>
                </div>
                <script type="text/javascript">
                    jQuery("#change_captcha").click(function(){
                        jQuery("#captcha_img").attr("src","/captcha");
                        return;
                    })
                    function ex_return_pwd(){
                        if(jQuery("#return_username").val()==""){
                            jQuery(".zhmm003").html("账号必须填写");
                            return;
                        }
                        if(jQuery("#return_captcha").val()==""){
                            jQuery(".zhmm003").html("验证码必须填写");
                            return;
                        }
                        $(".thumContent").showLoading();
                        jQuery.ajax({
                            type: "post",
                            data: {"username":jQuery("#return_username").val(),"captcha":jQuery("#return_captcha").val()},
                            url: "/service/sendPasswordMail",
                            success: function (data,status) {
                                jQuery('.thumContent').hideLoading();
                                var ms = JSON.parse(data);
                                if(ms.error==0){
                                    jQuery(".zhmm003").html("密码重置链接已发送到您的安全邮箱，请尽快登录邮箱并重置密码。");
                                    jQuery("#change_captcha").click();
                                }else{
                                    jQuery(".zhmm003").html(ms.message);
                                    jQuery("#change_captcha").click();
                                }
                            }
                        });
                    }
                </script>
                <!--找回密码 end-->

            </div>
            <!--thumContent end-->
        </div>
        <!--thumCon end-->
    </div>
    <!--thumMid end-->
</div>