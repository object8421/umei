<!--视觉区-->
<script>
    var first_cat_id = 0;
    var first_cat_name = '';
    function setTab(name,cursel,n){
        for(i=1;i<=n;i++){
            var menu=document.getElementById(name+i);
            var con=document.getElementById("con_"+name+"_"+i);
            menu.className=(i==cursel?"current":"");
            con.style.display=(i==cursel?"block":"none");
        }
    }
</script>
<div class="visionOut">
    <!--visionIn-->
    <div class="visionIn">
        <!--manageMyInfor-->
        <div class="manageMyInfor">
            <!--我管理的-->
            <div class="managePub administration">
                <h2><a href="/account/managed" title=""><span>more</span>我管理的......>></a></h2>
                <!--manageMid-->
                <div class="manageMid">
                    <?php if(!$user_info): ?>
                    <!--我管理的登录前-->
                    <div class="loginState" ><p>你还没有登录</a></p></div>
                    <!--我管理的登录前 end-->
                    <?php else: ?>
                    <!--我管理的登录后-->
                    <div class="manageShow">
                        <ol>
                        <?php if($m = User::managedAnchor(1, 3)): ?>
                            <?php foreach ($m['list'] as $i => $one): ?>
                                <li>
                                <span class="authorName"><a href="/<?php echo $one['anchor_info']['anchor_id']?$one['anchor_info']['anchor_id']:$one['uid']?>" title="" target="_blank"><?php echo $one['room_name']?></a></span>
                                <span class="msliveState"><?php if($one['start_time']!=''): ?><?php echo $one['start_time'];?>开播<?php else: ?>暂未直播<?php endif ?></span>
                            </li>
                            <?php endforeach ?>
                        <?php else: ?>
                            <!--我管理的-还没管理-->
                            <div class="loginState"><p>您还不是管理</a></p></div>
                            <!--我管理的-还没管理 end-->
                            <?php endif ?>
                        </ol>
                    </div>
                    <!--我管理的登录后 end-->
                    <?php endif ?>
                </div>
                <!--manageMid end-->
            </div>
            <!--我管理的 end-->
            <!--我关注的-->
            <div class="managePub attention">
                <h2><a href="/account/favorite" title=""><span>more</span>我关注的......>></a></h2>
                <!--manageMid-->
                <div class="manageMid">
                    <?php if(!$user_info): ?>
                    <!--我关注的登录前-->
                    <div class="loginState"><p>你还没有登录</a></p></div>
                    <!--我关注的登录前 end-->
                    <?php else: ?>

                    <!--我关注的登录后-->
                    <div class="manageShow">
                        <ol>
                            <?php if($m = User::favoriteAnchor(1, 3)): ?>
                                <?php foreach ($m['list'] as $i => $one): ?>
                            <li>
                                <span class="authorName"><a href="/<?php echo $one['anchor_info']['anchor_id']?$one['anchor_info']['anchor_id']:$one['uid']?>" title="" target="_blank"><?php echo $one['room_name']?></a></span>
                                <span class="msliveState"><?php if($one['start_time']!=''): ?><?php echo $one['start_time'];?>开播<?php else: ?>暂未直播<?php endif ?></span>
                            </li>
                                <?php endforeach ?>
                            <?php else: ?>
                            <!--我关注的-还没关注-->
                            <div class="loginState"><p>您还没有关注的房间</a></p></div>
                            <!--我关注-还没关注 end-->
                            <?php endif ?>
                        </ol>
                    </div>
                    <!--我关注的登录后 end-->
                    <?php endif ?>
                </div>
                <!--manageMid end-->
            </div>
            <!--我关注的 end-->
            <!--和我有缘的-->
            <div class="fateBox">
                <a href="/<?php echo Api::getData('anchor', 'getDestiny')?>" title="" target="_blank">和我有缘的</a>
                <a href="javascript:;" title="">和我有缘的</a>
            </div>
            <!--和我有缘的 end-->
        </div>
        <!--manageMyInfor end-->
        <!--focusBox-->
        <div class="focusBox">
            <!--focusMain-->
            <div class="focusMain">
                <ul>
                    <?php if ($recommend): ?>
                        <?php foreach($recommend as $i => $one): ?>
                    <li>
                        <!--focusShow-->
                        <div class="focusShow">
                            <span class="focusBigPic"><a href="/<?php echo $one['anchor_info']['anchor_id']?$one['anchor_info']['anchor_id']:$one['uid']?>" title="" target="_blank">
                                    <?php if($one['room_icon']): ?>
                                        <img src="<?php echo $one['room_icon_url'].$one['room_icon']; ?>" alt="" />
                                    <?php else: ?>
                                        <img src="/images/room_icon.gif"/>
                                    <?php endif ?>
                                   </a></span>
                            <div class="focusInfor">
                                <span class="whiteMaster">遮罩</span>
                                <div class="focusInforList">
                                    <span class="focusLevel"><i class="zhuboIco zb<?php echo $one['anchor_info']['anchor_level'] ?>"></i></span>
                                    <span class="focusName"><a href="/<?php echo $one['anchor_info']['anchor_id']?$one['anchor_info']['anchor_id']:$one['uid']?>" title="" target="_blank"><?php echo $one['room_name']?></a></span>
                                    <span class="focusState"><?php if($one['start_time']!=''): ?><?php echo $one['start_time'];?>开播<?php else: ?>暂未直播<?php endif ?></span>
                                    <span class="focusOn">关注：<b><?php echo $one['fans'] ?></b></span>
                                </div>
                            </div>
                        </div>
                        <!--focusShow end-->
                    </li>
                    <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>
            <!--focusMain end-->
            <!--focusNum-->
            <div class="focusNum">
                <ul>
                    <?php if ($recommend): ?>
                    <?php foreach($recommend as $i => $one): ?>
                    <li class="current">
                        <a href="/<?php echo $one['anchor_info']['anchor_id']?$one['anchor_info']['anchor_id']:$one['uid']?>" title="" target="_blank">
                            <?php if($one['room_icon']): ?>
                                <img src="<?php echo $one['room_icon_url'].$one['room_icon']; ?>" alt="" />
                            <?php else: ?>
                                <img src="/images/room_icon.gif"/>
                            <?php endif ?>
                            <?php if($one['start_time']!=''): ?>
                                <div class="onlineIco">直播</div>
                            <?php endif ?>
                            <div class="playIco">播放按钮</div>
                            <span class="whiteMaster">遮罩</span>
                            <span class="focusNumTitle"><?php echo $one['room_name'] ?></span>
                        </a>
                    </li>
                    <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>
            <!--focusNum end-->
        </div>
        <!--focusBox end-->
        <!--jionClassy-->
        <div class="jionClassy">
            <div class="jionLink">
                <?php if($user_info && $user_info['is_anchor']): ?>
                    <a href="/<?php echo $user_info['anchor_id']?$user_info['anchor_id']:$user_info['uid']?>" title="" target="_blank" class="jionLive">
                <?php else:?>
                    <a href="/service/apply" class="jionLive" target="_blank">
                <?php endif?>我要直播</a>
                    <a href="/service/apply" title="" target="_blank" class="jionApplay">申请艺人</a>
            </div>
            <div class="bannerAd">
                <div class="bannerEle">
                    <ul>
                        <li><a href="/service/apply" target="_blank" title=""><img src="/images/banner.jpg" alt="" /></a></li>
                        <!--<li><a href="/pk.html" target="_blank" title=""><img src="/images/banner1.jpg" alt="" /></a></li>-->
                        <!--li><a href="#" target="_blank" title=""><img src="/images/banner.jpg" alt="" /></a></li>-->
                    </ul>
                </div>
                <div class="bannerMenu"></div>
            </div>
        </div>
        <!--jionClassy end-->
    </div>
    <!--visionIn end-->
</div>
<!--视觉区 end-->
<!--内容区-->
<div class="mainOut">
    <!--mainIn-->
    <div class="mainIn mainInNew">
        <!--mainSidebar-->
        <div class="mainSide">
            <!--直播大厅-->
            <div class="pubArea">
                <!--liveArea-->
                <div class="liveArea">
                    <h2 class="pubTitle onlineAreaTitle">直播大厅</h2>
                    <div class="liveAreaList">
                        <dl>
                            <dt>当前在线：<b><?php echo $active_all; ?></b></dt>
                            <!--主播分类-->
                            <?php foreach($active_category as $cat_id => $cat_data):?>
                            <dd><a href="javascript:cat_it(<?php echo $cat_id ?>,'<?php echo $cat_data[0] ?>');" title=""><?php echo $cat_data[0] ?><b><?php echo $cat_data[1] ?>人</b></a></dd>
                            <?php endforeach?>
                            <!--主播分类 end-->
                        </dl>
                    </div>
                </div>
                <!--liveArea end-->
            </div>
            <!--直播大厅 end-->
            <!--联系我们-->
            <div class="pubArea">
                <!--contactBox-->
                <div class="contactBox">
                    <h2 class="pubTitle pubTitleNew">联系我们</h2>
                    <div class="serviceBox">
                        <h3>官方客服<i></i></h3>
                        <div class="serviceList">
                            <ul>
                                <li>
                                    <strong>U美客服01：</strong>
                                    <span><a target="_blank" href="tencent://message/?uin=3152262151&Site=U美&Menu=yes"><img src="/images/qq.gif"></a></span>
                                </li>
                                <li>
                                    <strong>U美客服02：</strong>
                                    <span><a target="_blank" href="tencent://message/?uin=3057244998&Site=U美&Menu=yes"><img src="/images/qq.gif"></a></span>
                                </li>
                                <li>
                                    <strong>U美新手咨询群：</strong>
                                    <span><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=15eda276ddedca79ed81ec513503c132b42ae22b814d76c21d7b4cade3ba9b5a"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="U美新手咨询群" title="U美新手咨询群"></a></span>
                                </li>
                                <li>
                                    <strong>U美增值服务群：</strong>
                                    <span><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=5cac8c7651853122ef3cfddfadbeab41db35928b29d804ef4d4953a860b45a3f"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="U美增值咨询群" title="U美增值咨询群"></a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--liveArea end-->
            </div>
            <!--联系我们 end-->
        </div>

        <!--mainSidebar end-->
        <!--mainContent-->
        <div class="mainContent">
            <!--人气主播推荐-->
            <div class="hotHost">
                <h3><span>人气主播推荐</span></h3>
                <div class="hotHostList">
                    <ol>
                        <?php if ($rooms): ?>
                        <?php foreach($rooms as $i => $one): ?>
                        <li>
                            <div class="hotHostPic">
                                <?php if($one['start_time']!=''): ?>
                                <div class="onlineIco">直播</div>
                                <?php endif ?>
                                <b class="numberIco"><?php echo $one['active_user'] ?></b>
                                <a href="/<?php echo $one['anchor_info']['anchor_id']?$one['anchor_info']['anchor_id']:$one['uid']?>" title="" target="_blank">
                                    <?php if ($one['room_icon']): ?>
                                    <img src="<?php echo $one['room_icon_url'].$one['room_icon'] ?>" alt="" />
                                    <?php else: ?>
                                    <img src="/images/room_icon.gif"/>
                                    <?php endif ?>
                                    <div class="playIco">播放按钮</div>
                                    <span class="hotHostTitle"><i class="zhuboIco zb<?php echo $one['anchor_info']['anchor_level'] ?>"></i><?php echo $one['room_name'] ?></span>
                                </a>
                            </div>
                            <div class="hotHostInfor">
                                <p>关注：<b><?php echo $one['fans'] ?></b></p>
                                <p>
                                    <span class="hotHostStop"><?php if (!$one['start_time']): ?>暂未直播<?php else: ?><?php echo $one['start_time'] ?>开播<?php endif ?></span>
                                </p>
                            </div>
                        </li>
                        <?php endforeach ?>
                        <?php endif?>
                    </ol>
                </div>
            </div>
            <!--人气主播推荐 end-->
            <!--点击查看更多直播-->
            <div class="loadMore">
                <a href="javascript:cat_it(first_cat_id,first_cat_name)" title="">点击查看更多直播<i class="cursorStyle"></i></a>
            </div>
            <!--点击查看更多直播 end-->
        </div>
        <!--mainContent end-->
        <!--mainRelate-->
        <div class="mainRelate">
            <!--排行榜-->
            <div class="rankBox">
                <?php
                /*
                ?>
                <!--金牌社团-->
                <div class="goldTeam">
                    <h2 class="pubTitle goldTeamTitle">金牌社团</h2>
                    <!--gtList-->
                    <div class="gtList" id="family_com">
                        <ol>

                        </ol>
                    </div>
                    <!--gtList end-->
                </div>
                <!--金牌社团 end-->
                */?>
                <!--主播榜-->
                <div class="hostRank hostlist">
                    <div class="rankTitle hostlist">
                        <span class="rankHostTitle fhTop">主播榜</span>
                                <span class="rankHostDate">
                                	<a href="javascript:;" onclick="setTab('one',1,4)" id="one1" title="" class="current">日</a>|
                                    <a href="javascript:;" onclick="setTab('one',2,4)" id="one2" title="">周</a>|
                                    <a href="javascript:;" onclick="setTab('one',3,4)" id="one3" title="">月</a>|
                                    <a href="javascript:;" onclick="setTab('one',4,4)" id="one4" title="">总</a>
                                </span>
                    </div>
                    <div class="rankList">
                        <ol id="con_one_1"></ol>
                        <ol id="con_one_2" class="f-dn"></ol>
                        <ol id="con_one_3" class="f-dn"></ol>
                        <ol id="con_one_4" class="f-dn"></ol>
                    </div>
                </div>
                <!--主播榜 end-->
                <!--富豪榜-->
                <div class="hostRank richlist">
                    <div class="rankTitle richlist">
                        <span class="rankHostTitle fhTop">富豪榜</span>
                                <span class="rankHostDate">
                                	<a href="javascript:;" id="two1" onclick="setTab('two',1,4)" title="" class="current">日</a>|
                                    <a href="javascript:;" id="two2" onclick="setTab('two',2,4)" title="">周</a>|
                                    <a href="javascript:;" id="two3" onclick="setTab('two',3,4)" title="">月</a>|
                                    <a href="javascript:;" id="two4" onclick="setTab('two',4,4)" title="">总</a>
                                </span>
                    </div>
                    <div class="rankList">
                        <ol id="con_two_1"></ol>
                        <ol id="con_two_2" class="f-dn"></ol>
                        <ol id="con_two_3" class="f-dn"></ol>
                        <ol id="con_two_4" class="f-dn"></ol>
                    </div>
                </div>
                <!--富豪榜 end-->
            </div>
            <!--排行榜 end-->
        </div>
        <!--mainRelate end-->
    </div>
    <!--mainIn end-->
</div>
<!--内容区 end-->
<div class="masterEle" style="display:none;">遮罩</div>
<script src="/js/view/index.js"></script>
