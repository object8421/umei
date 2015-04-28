<script>
    function send(){
        if ($("#realname").val() == "") {
            $("#realname").parent().addClass('spanInputErro');
            $("#realname").parent().parent().next().html('真实姓名必须填写！');
            return false;
        }else{
            $("#realname").parent().removeClass('spanInputErro');
            $("#realname").parent().parent().next().html('');
        }
        if ($("#realname").val().length>16) {
            $("#realname").parent().addClass('spanInputErro');
            $("#realname").parent().parent().next().html('真实姓名长度不能超过16！');
            return false;
        }else{
            $("#realname").parent().removeClass('spanInputErro');
            $("#realname").parent().parent().next().html('');
        }
        if ($("#phone").val() == "") {
            $("#phone").parent().addClass('spanInputErro');
            $("#phone").parent().parent().next().html('请填写您的手机号码！');
            return false;
        }else{
            $("#phone").parent().removeClass('spanInputErro');
            $("#phone").parent().parent().next().html('');
        }
        if ($("#phone").val().length>16) {
            $("#phone").parent().addClass('spanInputErro');
            $("#phone").parent().parent().next().html('手机长度不能超过16！');
            return false;
        }else{
            $("#phone").parent().removeClass('spanInputErro');
            $("#phone").parent().parent().next().html('');
        }
        if ($("#qq").val() == "") {
            $("#qq").parent().addClass('spanInputErro');
            $("#qq").parent().parent().next().html('qq必须填写！');
            return false;
        }else{
            $("#qq").parent().removeClass('spanInputErro');
            $("#qq").parent().parent().next().html('');
        }
        if ($("#qq").val().length>16) {
            $("#qq").parent().addClass('spanInputErro');
            $("#qq").parent().parent().next().html('qq长度不能超过16！');
            return false;
        }else{
            $("#qq").parent().removeClass('spanInputErro');
            $("#qq").parent().parent().next().html('');
        }
        if ($("#area").val().length>32) {
            $("#area").parent().addClass('spanInputErro');
            $("#area").parent().parent().next().html('地区长度不能超过32！');
            return false;
        }else{
            $("#area").parent().removeClass('spanInputErro');
            $("#area").parent().parent().next().html('');
        }
        if ($("#content").val().length>64) {
            $("#content").parent().addClass('spanInputErro');
            $("#content").parent().parent().next().html('内容长度不能超过64！');
            return false;
        }else{
            $("#content").parent().removeClass('spanInputErro');
            $("#content").parent().parent().next().html('');
        }
        if ($("#likes").val().length>32) {
            $("#likes").parent().addClass('spanInputErro');
            $("#likes").parent().parent().next().html('爱好长度不能超过32！');
            return false;
        }else{
            $("#likes").parent().removeClass('spanInputErro');
            $("#likes").parent().parent().next().html('');
        }
        var str="";
        $("input[name='time']:checkbox").each(function(){
            if($(this).prop('checked')){
                str += $(this).val()+" ";
            }
        });
        jQuery(".applyData").showLoading();
        $.ajax({
            type: "post",
            data: {"realname":$("#realname").val()
                ,"phone":$("#phone").val()
                ,"qq":$("#qq").val()
                ,"area":$("#area").val()
                ,"content":$("#content").val()
                ,"likes":$("#likes").val()
                ,"time":str},
            url: "/service/apply",
            success: function (data,status) {
                jQuery('.applyData').hideLoading();
                var ms = JSON.parse(data);
                if(ms.error==0){
                    $("#returnmsg").html(ms.message);
                    $("#feedback").click();
                    $("#tips02Pop .pinkBtn").removeAttr("onclick");
                    $("#tips02Pop .pinkBtn").click(function(){
                        $("#tips02Pop .popPubClose")[0].click();
                    });
                    $("#tips02").click();
                    setTimeout(function(){
                        location='/';
                    },5000);
                    //location='/';
                }else{
                    $(".zbsq002").html(ms.message);
                }
            }
        });
    }
</script>

<div class="thumBox">
    <div class="thumTitle"><span class="thumTitleName">客服中心---------------------------------------------------------------------------------->> 主播申请</span></div>
    <!--thumMid-->
    <div class="thumMid wd grayBg">
        <!--thumCon-->
        <div class="thumCon">
            <!--menuSide-->
            <?php $this->renderPartial('left')?>
            <!--menuSide end-->
            <!--thumContent-->
            <div class="thumContent">
                <!--主播申请-->
                <div class="applyData">
                    <h2>请认真填写以下所有信息</h2>
                    <!--applyTable-->
                    <div class="applyTable">
                        <ul>
                            <li>
                                <span class="applyTitle">真实姓名：</span>
                                <div class="applyMain">
                                    <span class="spanInput"><input type="text" name="realname" type="text" id="realname"></span>
                                </div>
                                <span class="errorText"></span>
                            </li>
                            <li>
                                <span class="applyTitle">手机：</span>
                                <div class="applyMain">
                                    <span class="spanInput"><input type="text" name="phone" type="text" id="phone"></span>
                                </div>
                                <span class="errorText"></span>
                            </li>
                            <li>
                                <span class="applyTitle">其他联系方式：</span>
                                <div class="applyMain">
                                    <div class="textareaPub"><textarea rows="" cols="" name="qq" type="text" id="qq"></textarea></div>
                                </div>
                                <span class="errorText"></span>
                            </li>
                            <li>
                                <span class="applyTitle">所在地区：</span>
                                <div class="applyMain">
                                    <span class="spanInput"><input type="text" name="area" type="text" id="area"></span>
                                </div>
                                <span class="errorText"></span>
                            </li>
                            <li>
                                <span class="applyTitle">自我介绍：</span>
                                <div class="applyMain">
                                    <div class="textareaPub"><textarea rows="" cols="" name="content" id="content"></textarea></div>
                                </div>
                                <span class="errorText"></span>
                            </li>
                            <li>
                                <span class="applyTitle">才艺特长：</span>
                                <div class="applyMain">
                                    <span class="spanInput"><input type="text" name="likes" type="text" id="likes"></span>
                                </div>
                                <span class="errorText"></span>
                            </li>
                            <li>
                                <span class="applyTitle">每日可上网时间：</span>
                                <div class="applyMain">
                                    <p>要求确保每天在麦时间2小时 </p>
                                    <div class="clockList">
                                        <label><input name="time" id="checkbox2" type="checkbox" value="10:00~12:00" />10:00~12:00</label>&emsp;
                                        <label><input name="time" id="checkbox" type="checkbox" value="13:00~18:00" />13:00~18:00 </label>&emsp;
                                        <label><input name="time" id="checkbox3" type="checkbox" value="19:00~24:00" />19:00~24:00</label>&emsp;
                                    </div>
                                </div>
                                <span class="errorText"></span>
                            </li>
                            <!--  li>
                            	<span class="applyTitle">照片1 ：</span>
                                <div class="applyMain applyMainInp">
                                	<span class="spanInput"><input type="text" name=""></span>
                                    <span class="fl"><a href="#" title="" class="pinkBtn"><i>上传</i></a></span>
                                </div>
                                <span class="errorText">请上传第一张照片</span>
                            </li>
                            <li>
                            	<span class="applyTitle">照片2：</span>
                                <div class="applyMain applyMainInp">
                                	<span class="spanInput"><input type="text" name=""></span>
                                    <span class="fl"><a href="#" title="" class="pinkBtn"><i>上传</i></a></span>
                                </div>
                                <span class="errorText">请上传第二张照片</span>
                            </li>
                            <li>
                                <div class="applyMain">
                                	<p>注：照片尺寸不小于640X 480像素，提供两张照片，提供腰部以上正面照。请不要提供艺术照，也不要提供普通的生活照。</p>
                                </div>
                            </li>-->
                        </ul>
                    </div>
                    <!--applyTable end-->
                    <div class="tc"><a class="normalBtn" title="" href="javascript:;" onclick="send()"><i>提交申请</i></a></div>
                </div>
                <!--主播申请 end-->
            </div>
            <!--thumContent end-->
        </div>
        <!--thumCon end-->
    </div>
    <!--thumMid end-->
</div>


