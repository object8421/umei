<link href="/css/live.css" rel="stylesheet" type="text/css" />
<!--充值中心-->
<div class="thumBox">
    <div class="thumTitle"><span class="thumTitleName">充值中心---------------------------------------------------------------------------------->> 账户充值</span></div>
    <!--thumMid-->
    <div class="thumMid wd grayBg">
        <!--thumCon-->
        <div class="thumCon">
            <!--menuSide-->
            <?php $this->renderPartial('left', array('pay_list'=>$pay_list, 'pay_type'=>$pay_type)) ?>
            <!--menuSide end-->
            <!--thumContent-->
            <div class="thumContent">
                <!--accoutInfor-->
                <div class="accoutInfor">
                    <ul>
                        <li>
                            <span class="accoutTitle">当前帐号：</span>
                            <div class="accoutMain">
                                <span class="fense"><?php echo $user_info['username'] ?> (<?php echo $user_info['uid'] ?>)</span>
                            </div>
                        </li>
                        <li>
                            <span class="accoutTitle">账户余额：</span>
                            <div class="accoutMain">
                                <i class="ubIco"></i><span class="fense"><?php if ($user_info['coin']): ?><?php echo $user_info['coin'] ?><?php else: ?>0<?php endif?></span>U币
                            </div>
                        </li>
                        <!--支付宝等方式支付按钮--><!--div class="tc1"><a href="#" title="" class="normalBtn"><i>支 付</i></a></div--><!--支付宝等方式支付按钮-->
                        <!--选择银行，如果是支付宝，财付通等没有选择银行的，屏蔽这一段-->
                        <li>

                            <?php if ($pay_type): ?>
                            <script type="text/javascript" src="/js/libraries/ajax.js"></script>

                            <!--充值信息确认-->
                            <div class="okPop chargePop posZ" style="top: 30%;left: 35%;z-index:999;display:none" id="mask">
                                <!--popPubTitle-->
                                <div class="popPubTitle" >
                                    <h2><span>U美直播社区提示</span><a href="javascript:hidden();" class="popPubClose">×</a></h2>
                                </div>
                                <!--popPubTitle end-->
                                <!--popPubMid-->
                                <div class="popPubMid" >
                                    <!--chargeMoney-->
                                    <div class="chargeMoney">
                                        <ul>
                                            <li>
                                                <strong>充值账号：</strong>
                                                <p ><label id="account">username</label>（<label id="uid">uid</label>）</p>
                                            </li>
                                            <li>
                                                <strong>充值金额：</strong>
                                                <p id="amount">amount</p>
                                            </li>
                                            <li>
                                                <strong>支付方式：</strong>
                                                <p id="payname">payname</p>
                                            </li>
                                            <li>
                                                <strong>订单编号：</strong>
                                                <p><span id="order_sn">order_sn</span></p>
                                            </li>
                                            <li id="paybtn">
                                                paybtn
                                            </li>
                                        </ul>
                                    </div>
                                    <!--chargeMoney end-->
                                    <div class="chargeMoneyBtn" style="display:none"><a href="javascript:;" title="" class="pinkBtn" onClick="javascript:pay_confirm()"><i>确认充值</i></a></div>
                                    <div class="red">提示：如果当前充值账号和您的账号不一致，请勿进行付款操作。</div>
                                </div>
                                <!--popPubMid end-->
                                <div class="popPubBot"><span></span></div>
                            </div>
                            <!--充值信息确认 end-->



                            <div class="okPop uArea posZ" style="top: 30%;left: 35%;z-index:999;display:none;" id="alert">
                                <!--popPubTitle-->
                                <div class="popPubTitle">
                                    <h2><span>U美直播社区提示</span><a href="javascript:;" onclick="{if $message.reload} if(window.top.frames['acc-frame']){window.top.frames['acc-frame'].document.location.reload();}<?php //endif?>location.href='{$url}'" class="popPubClose">×</a></h2>
                                </div>
                                <!--popPubTitle end-->
                                <!--popPubMid-->
                                <div class="popPubMid">
                                    <!--uAreaCont-->
                                    <div class="uAreaCont uAreaContNew" id="alertmsg">
                                    </div>
                                    <!--uAreaCont end-->
                                    <div class="chargeMoneyBtn confirmation"><a href="javascript:;" onClick="calert()" id="alertbtn" class="pinkBtn"><i>确定</i></a></div>
                                </div>
                                <!--popPubMid end-->
                                <div class="popPubBot"><span></span></div>
                            </div>

                            <div class="formbody" id="pay_info">
                                <ul class="forminfo">
                                    <form action="javascript:topay()" name="payment" method="post" id="myForm">

                                        <?php if ($paynomi = $pay->get_card()): ?>
                                            <li>
                                                <span class="accoutTitle">选择面额：</span>
                                                <br>
                                                <?php foreach($paynomi as $one):?>
                                                    <input type="radio" name="parVal" value="{$nomi}" onclick="selectVal(this)"><?php echo $one ?>元
                                                <?php endforeach?>
                                                <input type="hidden" name="amounts" id="amounts" class="txtinput amount" maxlength="5"/>
                                                <div class="tc1">
                                                    <a href="javascript:;" title="" class="normalBtn" onclick="document.getElementById('myForm').submit()"><i>支 付</i></a>
                                                </div>
                                            </li>
                                        <?php endif?>

                                        <?php if ($now['pay_name'] == '财付通'): ?>
                                            <li>
                                                <input type="hidden" name="pay_pass" value=""/>
                                                充值金额：<input type="text" name="amounts" id="amounts" class="txtinput amount" maxlength="5"/> 元 <span id="countUB">(1元 = <?php echo $coin_scale ?>Ｕ币)</span>
                                                <input type="submit" value="点击此处提交" class="btn"/>
                                            </li>
                                        <?php endif?>

                                        <?php if ($now['pay_name'] == '支付宝'): ?>
                                            <span class="accoutTitle">充值金额：</span>
                                            <div class="accoutMain">
                                                <div class="accoutSet">
                                                    <span class="spanInput"><input type="text" name="amounts" id="amounts" maxlength="5" ></span>
                                                    <span class="fl">元</span>
                                                    <span class="fl">可获得<b class="fense" id="ucoin"></b>U币</span>
                                                </div>
                                                <div class="accoutTip">提示：人民币和U币兑换比例为1:<?php echo $coin_scale ?></div>
                                            </div>
                                            <div class="tc1"><a href="javascript:;" title="" class="normalBtn" onclick="document.getElementById('myForm').submit()"><i>支 付</i></a></div>
                                        <?php endif?>

                                        <?php if ($now['pay_name'] == '网银在线'): ?>
                                            <span class="accoutTitle">充值金额：</span>
                                            <div class="accoutMain">
                                                <div class="accoutSet">
                                                    <span class="spanInput"><input type="text" name="amounts" id="amounts" maxlength="5" ></span>
                                                    <span class="fl">元</span>
                                                    <span class="fl">可获得<b class="fense" id="ucoin"></b>U币</span>
                                                </div>
                                                <div class="accoutTip">提示：人民币和U币兑换比例为1:<?php echo $coin_scale ?></div>
                                            </div>
                                            <div class="tc1"><a href="javascript:;" title="" class="normalBtn" onclick="document.getElementById('myForm').submit()"><i>支 付</i></a></div>
                                        <?php endif?>

                                        <?php if (isset($banks)): ?>
                                            <span class="accoutTitle">支付银行：</span>
                                            <div class="accoutMain">
                                                <div class="bankList">
                                                    <dl id="bank_pay">
                                                        {foreach from=$banks item=bank name=count}
                                                        <dt id="bank_{$bank.code}"><a href="#" title=""><i class="rightIco">√</i><em></em><img src="/css/img/{$bank.icon}" alt="{$bank.name}" onclick="get_bank('{$bank.name}','{$bank.code}')"/></a></dt>
                                                        {/foreach}
                                                    </dl>
                                                </div>
                                            </div>
                                            <input type="hidden" name="pay_pass" id="pay_pass" value=""/>
                                            <span class="accoutTitle">充值金额：</span>
                                            <div class="accoutMain">
                                                <div class="accoutSet">
                                                    <span class="spanInput"><input type="text" name="amounts" id="amounts" maxlength="5" ></span>
                                                    <span class="fl">元</span>
                                                    <span class="fl">可获得<b class="fense" id="ucoin"></b>U币</span>
                                                </div>
                                                <div class="accoutTip">提示：人民币和U币兑换比例为1:<?php echo $coin_scale ?></div>
                                            </div>
                                            <div class="tc1"><a href="javascript:;" title="" class="normalBtn" onclick="document.getElementById('myForm').submit()"><i>支 付</i></a></div>
                                        <?php endif?>

                                        <?php if (isset($games)): ?>
                                            <li>
                                                选择点卡：
                                                <select name="pay_pass" onchange="change_game()" onmousewheel="return false;" id="games">
                                                    <option value="" nomi="">— 点击此处选择</option>
                                                    {foreach from=$games item=game}
                                                    <option value="{$game.code}" nomi="{$game.nomi}" noti="{$game.noti}">— {$game.name}</option>
                                                    {/foreach}
                                                </select>
                                                <input type="submit" value="点击此处提交" class="btn"/>
                                            </li>
                                            <li id="nomi" style="display:none"></li>
                                        <?php endif?>
                                        <li id="notice" style="display:none"></li>
                                        <li>
                                            <input type="hidden" name="orid" id="orid" value="<?php echo $orid ?>" />
                                            <input type="hidden" name="virtual_sn" id="virtual_sn" value="<?php echo $virtual_sn ?>" />
                                        </li>
                                    </form>
                                </ul>
                            </div>
                            <script type="text/javascript">
                                var coin_scale = <?php echo $coin_scale ?>;
                                var pay_code = "<?php echo $now['pay_code'] ?>";
                            </script>
                </div>
                <?php endif?>
                </li>
                <!--选择银行end-->
                </ul>
            </div>
            <!--accoutInfor end-->
        </div>
        <!--thumContent end-->
    </div>
    <!--thumCon end-->
</div>
<!--thumMid end-->
</div>
<!--充值中心 end-->
<script type="text/javascript" src="/js/view/pay.js"></script>