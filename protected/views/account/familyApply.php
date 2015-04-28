<?php $this->renderPartial('/account/head') ?>
<script language="javascript" type="text/javascript" src="/js/libraries/DatePicker/WdatePicker.js"></script>
<!--社团操作-->
<div class="pubform changeInfor1"><!--tab导航-->
    <div class="tabList">
        <ul>
            <li <?php if (Yii::app()->controller->action->id == 'family'): ?>class="current"<?php endif?> style="margin-right: 10px;"><a href="/account/family" title="">主播信息</a></li>
            <li <?php if (Yii::app()->controller->action->id == 'familyApply'): ?>class="current"<?php endif?>><a href="/account/familyApply" title="">审批申请</a></li>
        </ul>
    </div>
    <ul>
        <li>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableData">
                <tr>
                    <th>号码</th>
                    <th>用户名</th>
                    <th>是否是主播</th>
                    <th>操作</th>
                </tr>
                <?php if ($family_user_list): ?>
                <?php foreach ($family_user_list as $item):?>
                <tr class="thumContentbg">
                    <td><?php echo $item['gid'] ?></td>
                    <td><?php echo $item['uname'] ?></td>
                    <td><?php if ($item['isAnchor'] == 2): ?>是<?php endif?><?php if ($item['isAnchor'] == 1): ?>否<?php endif?></td>
                    <td><a href="/account/familyApply/uid/<?php echo $item['uid'] ?>/pass/yes">通过</a> | <a href="/account/familyApply/uid/<?php echo $item['uid'] ?>/pass/no">拒绝</a></td>
                </tr>
                <!--没有申请-->
                    <?php endforeach?>
                <?php else:?>
                <tr>
                    <td colspan="4"><span class="noNode">目前还没有申请的人</span></td>
                </tr>
                <!--没有申请end-->
                <?php endif?>
            </table>
        </li>
    </ul>
    <!--翻页-->
    <?php $this->renderPartial('/site/pager', array('all'=>$pager['total'], 'all_page'=>$pager['pages'], 'page'=>$pager['page'], 'size'=>$size))?>
    <!--翻页 end--></div>
<!--社团操作end-->
<?php $this->renderPartial('/account/foot') ?>
