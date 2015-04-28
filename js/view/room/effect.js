function viewWH(){
	var wh = {'width':'','height':''};
	wh.width = $(window).width();
	wh.height =$(window).height();
	return wh;
};
var srcPx = $(document).scrollTop();
//弹框插件
$(function(){
	//对象+命名空间
	$.fn.windowOpen = function(options){
		//默认值
		var defaults = {
			"clickEle":"loginReward",
			"popEle":"loginRewardPop"
		}
		//合并默认值与参数
		var options = $.extend(defaults,options);
		//操作代码
		this.each(function(){
			//生命动画变量
			var This = $(this);
			var clickEle = "#" + options.clickEle;
			var popEle = "#" + options.popEle;
			var popClose = $(popEle).find("h2 a");
			var popEleH = $(popEle).innerHeight();	
			var popEleW = $(popEle).innerWidth();		
			$(clickEle).click(function(){				
				var posTop = (viewWH().height - popEleH)/2 + srcPx;
				var posLeft = -(popEleW/2)
				$(".windowOpen").css({"display":"none"});
				$(".masterEle").show();
				$(".erroTip").html("");
				$(popEle).css({"display":"block","top":posTop,"marginLeft":posLeft});	
			});
			$(popClose).click(function(){
				$(popEle).css({"display":"none"});	
				$(".masterEle").hide();
			});
			$(window).scroll(function () {
				resizeEle();
			});
			$(window).resize(function () {
				resizeEle();
			});
			function resizeEle(){
				srcPx = $(document).scrollTop();
				$(popEle).css({"top":srcPx + (viewWH().height - popEleH)/2});	
			}
		});
	}
});
$(function(){
	//每日登录奖励
	$("#loginReward").windowOpen({
		"clickEle":"loginReward",
		"popEle":"loginRewardPop"
	});
	//反馈帮助
	$("#feedback").windowOpen({
		"clickEle":"feedback",
		"popEle":"feedbackPop"
	});	
	//反馈帮助
	$("#feedback1").windowOpen({
		"clickEle":"feedback1",
		"popEle":"feedbackPop1"
	});	
	//礼物
	$("#gifts").windowOpen({
		"clickEle":"gifts",
		"popEle":"giftsPop"
	});	
	//注册
	$("#registerBox").windowOpen({
		"clickEle":"registerBox",
		"popEle":"registerPop"
	});	
	//注册成功
	$("#registerokBox").windowOpen({
		"clickEle":"registerokBox",
		"popEle":"registerokPop"
	});	
	//登录
	$("#loginBox").windowOpen({
		"clickEle":"loginBox",
		"popEle":"loginPop"
	});		
})

