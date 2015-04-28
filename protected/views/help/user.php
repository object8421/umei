<!--帮助中心-->
<div class="thumBox">
    <div class="thumTitle"><span class="thumTitleName">帮助中心---------------------------------------------------------------------------->> <?php echo $this->title;?></span></div>
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
                    <span>用户常见问题</span>
                </div>
                <!--面包屑 end-->
                <!--tab导航-->
                <div class="tabList">
                    <ul>
                        <?php foreach($titles as $key => $text):?>
                            <li <?php if ($type==$key):?>class="current"<?php endif?>><a href="/help/user/type/<?php echo $key?>" title=""><?php echo $text?></a></li>
                        <?php endforeach?>
                    </ul>
                </div>
                <!--tab导航 end-->
                <!--helpMain-->
                <div class="helpMain">
                    <?php if ($type == 0):?>
                    <!--如何获得爵位-->
                    <div class="juewei pd">
                        <h3>贵族体系等级为7级，从低到高为：勋爵、男爵、子爵、伯爵、侯爵、公爵、国王</h3>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
                            <tr>
                                <th>爵位</th>
                                <th>勋爵</th>
                                <th>男爵</th>
                                <th>子爵</th>
                                <th>伯爵</th>
                                <th>侯爵</th>
                                <th>公爵</th>
                                <th>国王</th>
                            </tr>
                            <tr>
                                <td><b class="tdTitle">标识</b></td>
                                <td><i class="jwIco V1"></i></td>
                                <td><i class="jwIco V2"></i></td>
                                <td><i class="jwIco V3"></i></td>
                                <td><i class="jwIco V4"></i></td>
                                <td><i class="jwIco V5"></i></td>
                                <td><i class="jwIco V6"></i></td>
                                <td><i class="jwIco V7"></i></td>
                            </tr>
                        </table>
                        <h3>贵族身份获得规则：</h3>
                        <p>1：无爵位情况下，一次性充值达到下表中的充值额度，即可获得对应的爵位身份。</p>
                        <p>2：无爵位情况下，30天内累计充值1000RMB，也可获得勋爵爵位。
                        </p>
                        <p>3：已有爵位情况下，晋级保级只和消费行为有关联。
                        </p>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
                            <tr>
                                <th>爵位</th>
                                <th>勋爵</th>
                                <th>男爵</th>
                                <th>子爵</th>
                                <th>伯爵</th>
                                <th>侯爵</th>
                                <th>公爵</th>
                                <th>国王</th>
                            </tr>
                            <tr>
                                <td><b class="tdTitle">充值金额</b></td>
                                <td>1000</td>
                                <td>2000</td>
                                <td>4000</td>
                                <td>10000</td>
                                <td>25000</td>
                                <td>60000</td>
                                <td>150000</td>
                            </tr>
                            <tr>
                                <td><b class="tdTitle">对应U币</b></td>
                                <td>100000</td>
                                <td>200000</td>
                                <td>400000</td>
                                <td>1000000</td>
                                <td>2500000</td>
                                <td>6000000</td>
                                <td>15000000</td>
                            </tr>
                        </table>
                        <p>晋级/保级明细(人民币：元)</p>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
                            <tr>
                                <th>爵位名称</th>
                                <th>（无爵位）<br>获得爵位充值标准</th>
                                <th>（有爵位）<br>当月保级累计消费标准</th>
                                <th>（有爵位）<br>当月晋级累计消费标准</th>
                            </tr>
                            <tr>
                                <td><b class="tdTitle">国王</b></td>
                                <td>150000（一次性充值）</td>
                                <td>30000</td>
                                <td>---</td>
                            </tr>
                            <tr>
                                <td><b class="tdTitle">公爵</b></td>
                                <td>60000（一次性充值）</td>
                                <td>15000</td>
                                <td>90000</td>
                            </tr>
                            <tr>
                                <td><b class="tdTitle">侯爵</b></td>
                                <td>25000（一次性充值）</td>
                                <td>5000</td>
                                <td>35000</td>
                            </tr>
                            <tr>
                                <td><b class="tdTitle">伯爵</b></td>
                                <td>10000（一次性充值）</td>
                                <td>2500</td>
                                <td>15000</td>
                            </tr>
                            <tr>
                                <td><b class="tdTitle">子爵</b></td>
                                <td>4000（一次性充值）</td>
                                <td>1000</td>
                                <td>6000</td>
                            </tr>
                            <tr>
                                <td><b class="tdTitle">男爵</b></td>
                                <td>2000（一次性充值）</td>
                                <td>500</td>
                                <td>2000</td>
                            </tr>
                            <tr>
                                <td><b class="tdTitle">勋爵</b></td>
                                <td>1000（一次性充值/一个月累计））</td>
                                <td>300</td>
                                <td>1000</td>
                            </tr>
                        </table>
                        <h3>爵位获得、保级、晋级规则说明：</h3>
                        <p>1.	无爵位用户在30天内累计充值够1000元RMB，自动获得勋爵爵位。</p>
                        <p>2.	无爵位用户一次性充值额度达到某个爵位的标准，自动获得某个爵位。</p>
                        <p>3.	爵位不可以直接购买，无论是人民币还是U币，都不能直接购买爵位。</p>
                        <p>4.	充值获得与消费晋级获得的爵位有效期为60天，消费保级成功和掉级之后的爵位有效期为30天算。</p>
                        <p>5.	在爵位有效期内累积计算用户消费额度，达到晋级标准时及时晋级为新的爵位。</p>
                        <p>6.	在爵位有效期的最后一天，累积计算有效期内用户的消费总额，达到保级标准的保级成功，未达到保级标准的，爵位将会往下掉一个级别。</p>
                        <p>7.	升级可以跳级，掉级是1次掉1级。</p>
                    </div>
                    <!--如何获得爵位 end-->
                    <?php endif?>

                    <?php if ($type == 1):?>
                    <!--什么是社团-->
                    <div class="teamBox pd">
                        <p>社团是U美直播社区提供给用户的一种组织形式。给具备管理才能的用户展现能力的机会。任何用户达到要求后，均可以拥有自己的一个社团。</p>
                        <h3>社团等级</h3>                                <p>社团有等级，有社团专属的活动，社团长可以带领社团成员参与官方的活动，从而得到更多的平台回馈。
                            如何修改用户名和昵称？
                        </p><h3>创建权限</h3>
                        <p>VIP会员即可创建社团，一个ID只能创建一个社团</p>
                    </div>
                    <!--什么是社团 end-->
                    <?php endif?>

                    <?php if ($type == 2):?>
                    <!--其他问题-->
                    <div class="teamBox pd">
                        <h3>如何修改用户名和昵称？</h3>
                        <p>可以到"个人中心"—"个人信息"修改用户和昵称。</p>
                        <h3>如何赠送礼物？</h3>
                        <p>礼物在直播间里才可以赠送，选中赠送对象的昵称，点击—弹出操作框，选择"赠送礼物给TA"，到礼物栏选择要赠送的礼物，然后点击"赠送"按钮，礼物便送出去了！
                        </p>
                        <h3>如何获得U币？</h3>
                        <p>
                            1）充值获得U币<br />
                            2）将获得的U豆，兑换成U币
                        </p>
                        <h3>如何充值？</h3>
                        <p>可以到"充值"频道，选择充值方式进行U币充值</p>
                        <h3>如何购买/切换座驾？</h3>
                        <p>用户到商城去购买座驾，在"个人中心—我的道具—我的座驾"切换座驾。</p>
                        <h3>普通用户等级？</h3>
                        <p>普通用户在线时长越多，等级越高。具体普通用户等级可在"个人中心"里查看.</p>
                        <h3>VIP购买？</h3>
                        <p>购买VIP到"商城"中，选择要购买VIP的有效期，VIP通过U币购买。VIP标识为网站管理标识？</p>
                    </div>
                    <!--其他问题 end-->
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