<div class="thumBox">
    <div class="thumTitle"><span class="thumTitleName">客服中心---------------------------------------------------------------------------------->> <?php echo $title[$type];?></span></div>
    <!--thumMid-->
    <div class="thumMid wd grayBg">
        <!--thumCon-->
        <div class="thumCon">
            <!--menuSide-->
            <?php $this->renderPartial('left', array('type'=>$type));?>
            <!--menuSide end-->
            <!--thumContent-->
            <div class="thumContent">
                <?php if ($type == 0):?>
                <!--联系客服-->

                <div class="serviceList1">
                    <!--tab导航-->
                    <div class="tabList">
                        <ul>
                            <li class="current" style="margin-right:10px;"><a>官方客服</a></li>
                        </ul>
                    </div>
                    <!--tab导航 end-->
                    <ul>
                        <li>
                            <strong>U美客服01：</strong>
                            <span><a target="_blank" href="tencent://message/?uin=3152262151&Site=U美&Menu=yes"><img src="/images/qq.gif"></a></span>
                            <strong>U美客服02：</strong>
                            <span><a target="_blank" href="tencent://message/?uin=3057244998&Site=U美&Menu=yes"><img src="/images/qq.gif"></a></span>
                            <strong>U美新手咨询群：</strong>
                            <span><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=15eda276ddedca79ed81ec513503c132b42ae22b814d76c21d7b4cade3ba9b5a"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="U美新手咨询群" title="U美新手咨询群"></a></span>
                            <strong>U美增值服务群：</strong>
                            <span><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=5cac8c7651853122ef3cfddfadbeab41db35928b29d804ef4d4953a860b45a3f"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="U美增值咨询群" title="U美增值咨询群"></a></span>
                        </li>
                    </ul><br>
                    <!--tab导航-->
                    <div class="tabList">
                        <ul>
                            <li><a href="/help/anchor/type/0" title="">什么是主播等级？</a></li>
                            <li><a href="/help/anchor/type/1" title="">如何申请成为签约主播？</a></li>
                            <li><a href="/help/anchor/type/2" title="">如何开始直播？</a></li>
                            <li><a href="/help/anchor/type/3" title="">如何查看直播数据和礼物？</a></li>
                            <li><a href="/help/anchor/type/4" title="">如何安装音视频优化工具？</a></li>
                            <li><a href="/help/user/type/0" title="">如何获得爵位？</a></li>
                            <li><a href="/help/user/type/1" title="">什么是社团？</a></li>
                            <li><a href="/help/user/type/2" title="">其他常见问题？</a></li>
                        </ul>
                    </div>
                    <!--tab导航 end-->
                </div>
                <!--联系客服 end-->
                <?php endif?>

                <?php if ($type == 1):?>
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
                            <input type="hidden" value="{$formhash}" id="formhash">
                            <input type="hidden" value="{$verify}" id="verify">
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
                            data: {"act":"do_reset_pwd","newpassword":jQuery("#newpassword").val(),"newconfirm_password":jQuery("#newconfirm_password").val(),"formhash":jQuery("#formhash").val(),"verify":jQuery("#verify").val()},
                            url: "/help.php",
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
                <?php endif?>
                <?php if ($type == 2):?>
                <!--服务协议-->
                <div class="serviceList1">
                    <h3>《U美网用户服务协议》</h3>
                    <p class="first">本《用户注册协议》是您（下称"用户"）与北京星烨互动科技有限公司（下称"星烨互动"）之间在使用星烨互动出品的互联网产品之前，注册星烨互动帐号（又名"U美账号"，以下统称"U美账号"）时签署的协议。</p>

                    <p><strong>1、重要须知：在签署本协议之前，星烨互动正式提醒用户：
                        </strong><br>
                        　&nbsp;&nbsp;1.1、您应认真阅读（未成年人应当在监护人陪同下阅读）、充分理解本《用户注册协议》中各条款，包括免除或者限制星烨互动责任的免责条款及对用户的权利限制条款。
                        <br>
                        　 &nbsp;1.2、除非您接受本协议，否则无权也无必要继续接受星烨互动的服务，可以退出本次注册。用户点击接受并继续使用星烨互动的服务，视为用户已完全的接受本协议。
                        <br>
                        　&nbsp;&nbsp;1.3、本协议一经签署，具有法律效力，请您慎重考虑是否接受本协议。
                        <br>
                        　&nbsp;&nbsp;1.4、在您签署本协议之后，本协议的内容可能因国家政策、产品以及履行本协议的环境发生变化而进行修改，修改后的协议发布在本网站上，若您对修改后的协议有异议的，请立即停止登录、使用星烨互动产品及服务，若您登录或继续使用星烨互动产品，视为对修改后的协议予以认可。</p>

                    <p><strong>2、关于"U美帐号"
                        </strong><br>
                        　 &nbsp;&nbsp;2.1、星烨互动在旗下业务平台U美直播社区（uumie.com）提供用户注册通道。
                        <br>
                        　&nbsp;&nbsp; 2.2、用户在接受本协议之后，有权选择未被其他用户使用过的字母符号组合作为用户的U美账号，并自行设置符合安全要求的密码。用户设置的账号、密码是用户用以登录星烨互动网站，接受星烨互动服务，换取U币等虚拟物品的专有的凭证。
                        <br>
                        　 &nbsp;&nbsp;2.3、用户在首次注册U美账号成功之后，星烨互动会按系统规则自动分配给用户一个U美号码，U美号码与U美账号一样是用户接受星烨互动服务的身份识别凭证。
                        <br>
                        　&nbsp;&nbsp; 2.4、U美账号以及U美号码的性质即是星烨互动向用户提供服务的凭证，同时U美账号和U美号码还是是星烨互动相应计算机软件作品的一部分，因此还是星烨互动将相关产品计算机软件著作权许可给注册用户使用的授权凭证。
                        <br>
                        　 &nbsp;&nbsp;2.5、U美账号还是用户持有、使用相关虚拟财产、道具的身份凭证。用户若需要接受星烨互动提供的增值服务，U美账号同时也是用户支付费用、接受增值服务的凭证。
                        <br>
                        　&nbsp;&nbsp;2.6、用户在注册了U美账号并不意味获得全部星烨互动产品的授权，仅仅是取得了接受星烨互动服务的身份，用户在登录相关网页、加载应用、下载安装软件时需要另行签署单个产品的授权协议。
                        <br>
                        　&nbsp;&nbsp;2.7、U美账号或U美号码仅限于在星烨互动网站上注册用户本人使用，禁止赠与、借用、租用、转让或售卖。如果星烨互动发现使用者并非账号初始注册人，有权在未经通知的情况下回收该账号而无需向该账号使用人承担法律责任，由此带来的包括并不限于用户通讯中断、用户资料和道具等清空等损失由用户自行承担。
                        <br>
                        　&nbsp;&nbsp;2.8、用户应当妥善保管自己的U美账号、密码，用户就其账号及密码项下之一切活动负全部责任，包括用户数据的修改，虚拟道具的损失以及其他所有的损失由用户自行承担。用户须重视U美账号密码保护。用户如发现他人未经许可使用其账号时立即通知星烨互动。
                        <br>
                        　&nbsp;&nbsp;2.9、用户U美账号在丢失或遗忘密码后，可遵照星烨互动的申报途径及时申报请求找回账号。用户应不断提供能增加账号安全性的个人密码保护资料。用户可以凭初始注册资料及个人密码保护资料填写申报单向星烨互动申请找回账号，星烨互动的密码找回机制仅负责识别申报单上所填资料与系统记录资料的正确性，而无法识别申诉人是否系该账号真实使用人。对用户帐号因被他人冒名使用而导致的任何损失，星烨互动不承担任何责任，用户知晓U美账号及密码保管责任在于用户，星烨互动并不承诺U美账号丢失或遗忘密码后用户一定能通过申报找回账号。
                        <br>
                        　&nbsp;&nbsp;2.10、用户保证注册U美账号时填写的身份信息是真实的，任何非法、不真实、不准确的用户信息所产生的责任由用户承担。用户应不断更新注册资料，符合及时、详尽、真实、准确的要求。所有原始键入的资料将引用用户的账号注册资料。如果因用户的注册信息不真实而引起的问题，以及对问题发生所带来的后果，星烨互动不负任何责任。
                        <br>
                        　&nbsp;&nbsp;2.11、U美账号或U美号码的所有权属于星烨互动。星烨互动有权根据运营需要，发布U美社区规则规范。用户在使用U美产品的过程中，需遵守U美直播社区发布的各项规定。
                        <br>
                        　&nbsp;&nbsp;2.12、如用户违反法律法规、星烨互动各服务协议或社区规则的等规定，星烨互动有权根据相关规则进行违规判定，并采取相应限制或处罚措施，包括但不限于：限制或冻结用户对U美号码的使用，限制或停止某项单独服务（如视频直播），扣除保证金，扣减收入分成并根据实际情况决定是否恢复使用。
                        <br>
                        　&nbsp;&nbsp;2.13、为了充分利用U美号码资源，若用户存在长期未登录使用U美号码的情形，星烨互动有权对该号码进行回收、替换等终止使用操作。
                        <br>
                        　&nbsp;&nbsp;2.14、星烨互动依照社区规则限制、冻结、回收、替换或终止用户U美号码的使用，可能会给用户造成一定的损失，该损失由用户自行承担，星烨互动不承担任何责任。</p>

                    <p><strong>3、用户不得从事以下行为：
                        </strong><br>
                        　&nbsp;&nbsp;3.1、利用星烨互动服务产品发表、传送、传播、储存危害国家安全、国家统一、社会稳定的内容，或侮辱诽谤、色情、暴力、引起他人不安及任何违反国家法律法规政策的内容或者设置含有上述内容的网名、角色名。
                        <br>
                        　&nbsp;&nbsp;3.2、利用星烨互动服务发表、传送、传播、储存侵害他人知识产权、商业秘密、肖像权、隐私权等合法权利的内容。
                        <br>
                        　&nbsp;&nbsp;3.3、进行任何危害计算机网络安全的行为，包括但不限于：使用未经许可的数据或进入未经许可的服务器/账户；未经允许进入公众计算机网络或者他人计算机系统并删除、修改、增加存储信息；未经许可，企图探查、扫描、测试本"软件"系统或网络的弱点或其它实施破坏网络安全的行为；企图干涉、破坏本"软件"系统或网站的正常运行，故意传播恶意程序或病毒以及其他破坏干扰正常网络信息服务的行为；伪造TCP/IP数据包名称或部分名称。
                        <br>
                        　&nbsp;&nbsp;3.4、进行任何破坏星烨互动服务公平性或者其他影响应用正常秩序的行为，如主动或被动刷分、合伙作弊、使用外挂或者其他的作弊软件、利用BUG（又叫"漏洞"或者"缺陷"）来获得不正当的非法利益，或者利用互联网或其他方式将外挂、作弊软件、BUG公之于众。
                        <br>
                        　&nbsp;&nbsp;3.5、进行任何诸如发布广告、销售商品的商业行为，或者进行任何非法的侵害星烨互动利益的行为，如贩卖U币。
                        <br>
                        　&nbsp;&nbsp;3.6、进行其他任何违法以及侵犯其他个人、公司、社会团体、组织的合法权益的行为。</p>

                    <p><strong>4、星烨互动声明
                        </strong><br>
                        　&nbsp;&nbsp;4.1、用户须明白，在使用星烨互动服务过程中可能存在来自任何他人的包括威胁性的、诽谤性的、令人反感的或非法的内容和行为，或可能存在对侵犯权利（包括知识产权）的内容和行为，可能存在匿名或冒名的信息，用户须承担以上风险。星烨互动对服务不作担保，不论是明确的或隐含的，包括所有有关信息真实性、适当性、适于某一特定用途、所有权和非侵权性的默示担保。，对任何因用户不正当或非法使用服务产生的直接、间接、偶然、特殊及后续的损害，不承担任何责任。
                        <br>
                        　&nbsp;&nbsp;4.2、使用星烨互动服务必须遵守国家有关法律和政策等，维护国家利益，保护国家安全，并遵守本条款，对于用户违法或违反本协议的使用(包括但不限于言论发表、传送等)而引起的一切责任，由用户负全部责任。
                        <br>
                        　&nbsp;&nbsp;4.3、星烨互动的服务同大多数因特网产品一样，易受到各种安全问题的困扰，包括但不限于：
                        <br>
                        　　 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1）透露详细个人资料，被不法分子利用，造成现实生活中的骚扰；
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2）哄骗、破译密码；
                        <br>
                        　　 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3）下载安装的其它软件中含有"特洛伊木马"等病毒，威胁到个人计算机上信息和数据的安全，继而威胁对本服务的使用。对于发生上述情况的，用户应当自行承担责任。
                        <br>
                        　&nbsp;&nbsp;4.4、用户须明白，星烨互动为了服务整体运营的需要，有权在公告通知后修改或中断、中止或终止服务而不需通单独知您，而无须向用户及第三方负责或承担任何赔偿责任。
                        <br>
                        　&nbsp;&nbsp;4.5、用户须理解，互联网技术的不稳定性，可能导致政府政策管制、病毒入侵、黑客攻击、服务器系统崩溃或者其他现今技术无法解决的风险发生可能导致星烨互动服务中断或账号道具损失，用户对此非人为因素引起的损失由用户承担责任。</p>

                    <p><strong>5、知识产权
                        </strong><br>
                        　&nbsp;&nbsp;5.1、星烨互动的服务包括星烨互动运营的网站、网页应用、软件以及内涵的文字、图片、视频、音频等元素，星烨互动服务标志、标识以及专利权，星烨互动享有上述内容的知识产权。
                        <br>
                        　&nbsp;&nbsp;5.2、用户不得对星烨互动服务涉及的相关网页、应用、软件等产品进行反向工程、反向汇编、反向编译等。
                        <br>
                        　&nbsp;&nbsp;5.3、用户只能在本《用户协议》以及相应的授权许可协议授权的范围使用星烨互动知识产权，未经授权超范围使用的构成对星烨互动的侵权。
                        <br>
                        　&nbsp;&nbsp;5.4、用户在使用星烨互动服务时发表上传的文字、图片、视频、软件以及表演等用户原创的信息，此部分信息的知识产权归用户，但用户的发表、上传行为可视为是对星烨互动服务平台的授权，许可星烨互动无偿使用上述权利，用户确认其发表、上传的信息非独占性、永久性的授权，该授权可转授权。星烨互动可将前述信息在星烨互动旗下的服务平台上使用，可再次编辑后使用，也可以由星烨互动授权给合作方使用。
                        <br>
                        　&nbsp;&nbsp;5.5、若星烨互动旗下业务平台内的信息以及其他用户上传、存储、传播的信息有侵犯用户或第三人的知识产权的，U美网站提供投诉通道。</p>

                    <p><strong>6、隐私保护
                        </strong><br>
                        　&nbsp;&nbsp;6.1、请用户注意勿在使用星烨互动服务中透露自己的各类财产帐户、银行卡、信用卡、第三方支付账户及对应密码等重要资料，否则由此带来的任何损失由用户自行承担。
                        <br>
                        　&nbsp;&nbsp;6.2、用户的U美账号、密码属于保密信息，星烨互动应当采取积极的措施保护用户账号、密码的安全。
                        <br>
                        　&nbsp;&nbsp;6.3、用户的注册信息作为星烨互动的商业秘密进行保护。但用户同时明白，互联网的开放性以及技术更新非常快，非星烨互动可控制的因素导致用户泄漏的，星烨互动不承担责任。
                        <br>
                        　&nbsp;&nbsp;6.4、用户在使用星烨互动服务时不可将自认为隐私的信息发表、上传至星烨互动，也不可将该等信息通过星烨互动的服务传播给其他人，若用户的行为引起的隐私泄漏，由用户承担责任。
                        <br>
                        　&nbsp;&nbsp;6.5、星烨互动在提供服务时可能会搜集用户信息，星烨互动会明确告知用户，通常信息仅限于用户姓名、性别、年龄、出生日期、身份证号、家庭住址、教育程度、公司情况、所属行业、兴趣爱好等。
                        <br>
                        　&nbsp;&nbsp;6.6、就下列相关事宜的发生，星烨互动不承担任何法律责任：
                        <br>
                        　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1）星烨互动根据法律规定或相关政府、司法机关的要求提供您的个人信息；
                        <br>
                        　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2）由于用户将用户密码告知他人或与他人共享注册账户，由此导致的任何个人信息的泄漏，或其他非因星烨互动原因导致的个人信息的泄漏；
                        <br>
                        　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3）任何由于黑客攻击、电脑病毒侵入造成的信息泄漏；
                        <br>
                        　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4）因不可抗力导致的信息泄漏；</p>

                    <p><strong>7、其他条款
                        </strong><br>
                        　&nbsp;&nbsp;7.1、本协议的签署地点为星烨互动服务所在地即北京，若用户与星烨互动发生争议的，双方同意将争议提交星烨互动所在地有管辖权的法院诉讼解决。
                        <br>
                        　&nbsp;&nbsp;7.2、本协议由星烨互动公布在网站上，对星烨互动具有法律约束力；用户一经点击接受或者直接登录的行为视为对本协议的接受，对用户具有法律约束力。
                        <br>
                        　&nbsp;&nbsp;7.3、星烨互动旗下具体的网站、网页应用、软件等的使用由用户和星烨互动的业务平台另行签署相关软件授权及服务协议。
                    <p>
                </div>

                <!--服务协议 end-->
                <?php endif?>

                <?php if ($type == 3):?>
                <!--用户反馈-->
                <div class="applyData">
                    <!--applyTable-->
                    <div class="applyTable">
                        <ul>
                            <li>
                                <span class="applyTitle1">反馈内容：</span>
                                <div class="applyMain1">
                                    <div class="textareaPub"><textarea rows="" cols="" name="" id="wtcont"></textarea></div><span>限200字以内</span
                                        ></div>
                            </li>
                            <li>
                                <span class="applyTitle1">联系方式：</span>
                                <div class="applyMain1">
                                    <span class="spanInput"><input type="text" placeholder="QQ或手机" autocomplete="off" size="20" maxlength="20" name="" id="wtfs"></span>
                                </div>
                            </li><li style="padding-left:100px;">请留下您的联系方式，以便我们尽快帮助您解决问题。</li>
                        </ul>
                    </div>
                    <!--applyTable end-->
                    <div class="tc"><a class="normalBtn" title="" href="javascript:;" onclick="sendanswer()"><i>发送</i></a></div>
                </div>
                <!--用户反馈 end-->
                <script type="text/javascript">
                    function sendanswer(){
                        if($("#wtcont").val()=="" || $("#wtfs").val()==""){
                            $("#returnmsg").html('内容和联系方式都必须填写！');
                            $("#tips02Pop .pinkBtn").removeAttr("onclick");
                            $("#tips02Pop .pinkBtn").click(function(){
                                $("#tips02Pop .popPubClose")[0].click();
                            });
                            $("#tips02").click();
                            return false;
                        }
                        if($("#wtcont").val().length>200){
                            $("#returnmsg").html('内容不能超过200');
                            $("#tips02Pop .pinkBtn").removeAttr("onclick");
                            $("#tips02Pop .pinkBtn").click(function(){
                                $("#tips02Pop .popPubClose")[0].click();
                            });
                            $("#tips02").click();
                            return false;
                        }
                        jQuery(".applyData").showLoading();

                        $.ajax({
                            type: "post",
                            data: {"data_type":"意见建议","cont":$("#wtcont").val(),"qq":$("#wtfs").val()},
                            url: "/service/index/type/3",
                            success: function (data,status) {
                                jQuery('.applyData').hideLoading();
                                var ms = JSON.parse(data);
                                if(ms.error==0){
                                    $("#wtcont").val("");
                                    $("#wtfs").val("");
                                    $("#returnmsg").html(ms.message);
                                    $("#tips02").click();
                                }else{
                                    $("#returnmsg").html(ms.message);
                                    $("#tips02Pop .pinkBtn").removeAttr("onclick");
                                    $("#tips02Pop .pinkBtn").click(function(){
                                        $("#tips02Pop .popPubClose")[0].click();
                                    });
                                    $("#tips02").click();
                                }
                            }
                        });
                    }
                </script>
                <?php endif?>
            </div>
            <!--thumContent end-->
        </div>
        <!--thumCon end-->
    </div>
    <!--thumMid end-->
</div>