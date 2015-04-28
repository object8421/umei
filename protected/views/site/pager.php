<?php
// all all_page page size
list($prev, $next, $more_start, $more_end) = Logic::pageInfo($page, $all_page);
if (isset($param)) {
    foreach($param as $key => $value){
        $a[] = $key.'='.$value;
    }
    $pstr = '?'.implode('&', $a);
}else{
    $pstr = '';
}
?>
<form name="selectPageForm" action="" method="get">
    <!--翻页-->
    <div class="nodeDestory" id="pager">
        <div class="ndLeft fl">共<b><?php echo $all ?></b>条记录，共<b><?php echo $all_page ?></b>页，当前显示第<b><?php echo $page ?></b>页</div>
        <div class="pageList fr">
            <a href="<?php echo '/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id.'/page/'.$prev.'/size/'.$size.$pstr ?>">上一页</a>
            <?php for($i=$more_start; $i<=$more_end; $i++):?>
            <a href="<?php echo '/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id.'/page/'.$i.'/size/'.$size.$pstr ?>" <?php if ($i == $page): ?> class="current"<?php endif?>><?php echo $i?></a>
            <?php endfor?>
            <a href="<?php echo '/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id.'/page/'.$next.'/size/'.$size.$pstr ?>">下一页</a>
        </div>
    </div>
</form>
<!--翻页 end-->

<script type="Text/Javascript" language="JavaScript">
    <!--
    function selectPage(sel)
    {
        sel.form.submit();
    }
    //-->
</script>

