<!--帮助中心-->
<div class="thumBox">
    <div class="thumTitle"><span class="thumTitleName">帮助中心----------------------------------------------------------------------->> <?php echo $this->title;?></span></div>
    <!--thumMid-->
    <div class="thumMid wd grayBg">
        <!--thumCon-->
        <div class="thumCon">
            <!--menuSide-->
            <?php $this->renderPartial('left');?>
            <!--menuSide end-->
            <!--thumContent-->
            <div class="thumContent">
                <!--面包屑-->
                <div class="pageCrumb">
                    <span><a href="#" title="">位置</a></span>
                    <span> >> </span>
                    <span>主播常见问题</span>
                </div>
                <!--面包屑 end-->
                <!--tab导航-->
                <div class="tabList">
                    <ul>
                        <?php foreach($titles as $key => $text):?>
                        <li <?php if ($type==$key):?>class="current"<?php endif?>><a href="/help/anchor/type/<?php echo $key?>" title=""><?php echo $text?></a></li>
                        <?php endforeach?>
                    </ul>
                </div>
                <!--tab导航 end-->
                <!--helpMain-->
                <div class="helpMain">

                    <?php if ($type == 0):?>
                    <!--什么是主播等级-->
                    <div class="zbLevel pd">
                        <h3>U美主播分为5档：新新主播、知名主播、闪亮主播、超级主播、大牌主播每档主播分10级，具体等级如下：</h3>
                        <div class="tableShow">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
                                <colgroup>
                                    <col class="tableLeft"/>
                                    <col class="tableMid"/>
                                    <col class="tableBox"/>
                                    <col class="tableRight"/>
                                </colgroup>
                                <tr>
                                    <th>主播称号</th>
                                    <th>标志</th>
                                    <th>级别</th>
                                    <th>累积获得的U豆</th>
                                </tr>
                                <?php $i = 0;?>
                                <?php foreach($levels as $k => $point):?>
                                    <tr>
                                    <?php if ($k % 10 == 0):?>
                                        <?php if ($i == 0):?>
                                        <td rowspan="10">新新主播</td>
                                        <?php elseif ($i == 1):?>
                                        <td rowspan="10">闪亮主播</td>
                                            <?php elseif ($i == 2):?>
                                        <td rowspan="10">知名主播</td>
                                            <?php elseif ($i == 3):?>
                                        <td rowspan="10">超级主播</td>
                                            <?php elseif ($i == 4):?>
                                        <td rowspan="10">大牌主播</td>
                                        <?php endif?>
                                        <?php $i++;?>
                                    <?php endif?>
                                    <td><i class="zhuboIco zb<?php echo $k+1?>"></i></td>
                                    <td><?php echo $k+1?></td>
                                    <td><?php echo $point?></td>
                                </tr>
                                <?php endforeach?>
                            </table>
                        </div>
                    </div>
                    <!--什么是主播等级 end-->
                    <?php endif?>

                    <?php if ($type == 1):?>
                    <!--如何申请成为签约主播-->
                    <div class="applyHow pd">
                        <p>
                            如果您想成为U美直播社区的主播，在首页登陆后，点击"申请主播"按钮，或在客服中心的“主播申请”页面里填写相关资料提交即可。</p>
                        <p>地址：（<a href="http://www.uumie.com/anchor.php">链接地址</a>） </p>
                        <p>
                            填写申请主播资料通过审核后，官方管理会主动联系申请人，进行在线面试，面试通过后，会安排到网站上的社团，满足签约要求后，与该社团进行签约。
                        </p>
                        <h3>签约具体要求如下：</h3>
                        <p>签约主播要求：需主动申请，接受签约主播协议，批准后分配签约主播标识；</p>
                        <h3>签约主播考核以下四个条件：</h3>
                        <p>
                            遵守网站管理规定、无违规记录；<br />
                            每月播出时长50小时以上；<br />
                            有效播出天数>20天（每天播出1小时以上为"有效播出天数"）；<br />
                            每月礼物收入2万U豆以上；
                        </p>
                    </div>
                    <!--如何申请成为签约主播 end-->
                    <?php endif?>

                    <?php if ($type == 2):?>
                    <!--如何开播-->
                    <div class="howSignon pd">
                        <p>（签约主播才有直播的权限）</p>
                        <h3>1、将摄像头正确连上电脑并测试成功</h3>
                        <h3>2、注册U美网账号，进入U美网主页点击右上角"我要直播"按钮进入你的直播间，选择视频设备</h3>
                        <p>选择好视频和音频设备后，进入直播海报的拍摄上传成功后便可开始直播。 把直播地址发给好友，让大家一起观赏您的精彩直播。</p>
                        <h3>第一步：设置音视频</h3>
                        <h3>第二步：开始直播。</h3>
                        <p>点击红色开关，直播状态变为"本机直播中"，即开始直播了。</p>
                        <h3>第三步：结束直播。</h3>
                        <p>点击蓝色开关，直播状态变为"本机未直播"，即关闭直播了。</p>
                        <p><img src="/images/help/zbPic.jpg" alt="" /></p>
                    </div>
                    <!--如何开播 end-->
                    <?php endif?>

                    <?php if ($type == 3):?>
                    <!--如何查看主播数据和礼物-->
                    <div class="giftData pd">
                        <p>进入到个人中心，进行查看直播的时长，以及获得的礼物数量</p>
                    </div>
                    <!--如何查看主播数据和礼物 end-->
                    <?php endif?>

                    <?php if ($type == 4):?>
                    <!--如何安装音视频优化工具-->
                    <div class="advTool">
                        <h3>第一步：直播插件下载，在主播"个人中心""主播操作"里，点击"直播插件下载"</h3>
                        <p><img src="/images/help/advToolPic01.jpg" /></p>
                        <h3>第二步：安装直播插件</h3>
                        <p><img src="/images/help/advToolPic02.jpg" /></p>
                        <h3>第三步：启动直播插件</h3>
                        <p>
                            直播插件默认自动启动，开机自动运行的，如果360等软件把它关掉了，就要启用一下 1、 直播时点"启动"按钮将服务启动，界面显示"高清直播后台服务器程序，运行中…"
                        </p>
                        <h3>2、 停播时点"停用"按钮将服务启动，界面显示"高清直播后台服务器程序，停止"</h3>
                        <p><img src="/images/help/advToolPic03.jpg" /></p>
                        <p><img src="/images/help/advToolPic04.jpg" /></p>
                    </div>
                    <!--如何安装音视频优化工具 end-->
                    <?php endif?>
                </div>
                <!--helpMain end-->
            </div>
            <!--thumContent end-->
        </div>
        <!--thumCon end-->
    </div>
    <!--thumMid end-->
</div>
<!--帮助中心 end-->