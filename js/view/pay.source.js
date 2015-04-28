function $(id){return document.getElementById(id);}

// 金额鼠标动作
if($('amounts')){
	$('amounts').onafterpaste = check_amount;
	$('amounts').onkeyup = function(){
		$('amounts').value = $('amounts').value.replace(/[^\d]/g,'');
		jQuery('#ucoin').html($('amounts').value*100);
	}
	$('amounts').ondragenter = function(){return false};
}

// 表单提交标记
var is_post = 0;

// 支付方式Ajax请求
function topay()
{
    var amount     = Math.floor($('amounts').value);
    var virtual_sn = $('virtual_sn').value;
    var orid       = $('orid').value;
    var pay_pass   = null;
    
    /* 充值是否提交过至第三方支付 */
    if(is_post){
    	virtual_sn = 0;
    }
    
    /* 是否需要选择充值通道 */
    if($('pay_pass')){
    	pay_pass  = $('pay_pass').value;
		if(!pay_pass){
			ialert('请选择网上银行');return;
		}
    }
    /* 是否需要选择充值面额 */
	if ($('parVal') && get_radio('parVal') == null){
		ialert('请选择要充值的卡面额');return;
	}
	if (amount < 0 || amount == '' || amount == null){
		ialert('请填写要充值的金额'); return;
	}
	var args = 'amount=' + amount + '&pay_code=' + pay_code + '&virtual_sn=' + virtual_sn + '&orid=' + orid;	
	if(pay_pass){
		args += '&pay_pass=' + pay_pass;
	}	
	Ajax.call('/pay/deal', args, function(result){
		if (result.error > 0){
			ialert(result.message);
		}else{
			payinfo(result);
		}
	}, 'POST', 'JSON', true, true);
}

//显示支付信息，和支付按钮
function payinfo(result)
{
	// 展示信息
	//$('pay').style.display  = '';
	$('mask').style.display = '';
	//$('mask').style.height  = document.body.offsetHeight + "px";
	//$('mask').style.width   = document.body.offsetWidth + "px";
	//$('pay').style.top      = (document.body.scrollHeight - $('pay').clientHeight - 50)/2 + "px";
	//$('pay').style.left     = (document.body.scrollWidth - $('pay').clientWidth)/2 + "px";		
	$('account').innerHTML  = result.username;
	$('uid').innerHTML      = result.uid;
	$('amount').innerHTML   = result.amount + '元';
	$('payname').innerHTML  = result.payname;
	$('order_sn').innerHTML = result.order_sn;
	$('paybtn').innerHTML   = result.paybtn;
	jQuery('#mask').show();
	console.log(result.paybtn);
	
	// 新表单未提交
	is_post = 0;
    return;
}

// 检查金额
function check_amount()
{
	$('amounts').value = $('amounts').value.replace(/[^\d]/g,'');
	if($('amounts').value > 0){
		if($('countUB')){
			$('countUB').innerHTML = "(" + $('amounts').value + "元 = " + $('amounts').value * coin_scale +"Ｕ币)";
		}
	}else{
		$('amounts').value = '';
	}
}

// 获取银行
function get_bank(bank_name,bank_id)
{
	$("pay_pass").value = bank_id;
	//$('notice').innerHTML = '您选择了：' + bank_name + '。';
	$('notice').style.display = '';
	jQuery("#bank_pay dt").each(function() {
		jQuery(this).removeClass("current");  //移除已选中的样式
	});
	jQuery("#bank_"+bank_id).addClass("current");
}

// 获取游戏卡
function change_game()
{
	var sel = $('games');
	var raidoStr = "选择面额：<br />";
	for (var i=0;i<sel.length;i++){
		if(sel.options[i].selected == true && sel.options[i].value){
			var raidoArr = sel.options[i].getAttribute('nomi').split(",");			
			for (var j=0;j<raidoArr.length;j++){
				raidoStr += '<input type="radio" name="parVal" value="'+raidoArr[j]+'" onclick="selectVal(this)">'+raidoArr[j]+'元 ';
				if((j+1)%8 == 0){
					raidoStr +=	'<br/>';
				}
			}
			$('nomi').style.display = '';
			$("nomi").innerHTML = raidoStr;
			if (sel.options[i].noti) {
				$("remark").innerHTML += '<br/>◆ ' + sel.options[i].noti;
			}
			break;
		}else{
			$("remark").innerHTML = '◇ 游戏点卡和U币兑换比例为1：80<br/>◇ 请务必使用与您选择的面额相同的游戏卡进行支付，否则引起的交易失败交易金额不予退还。';
			$('nomi').style.display = 'none';
			$('notice').style.display = 'none';
		}
	}
}

// 循环获取radio表单值
function get_radio(r)
{
    var obj = document.getElementsByName(r);
    if(obj != null){
      for(var i=0; i < obj.length; i++){
		     if(obj[i].checked){
		         return obj[i].value;
		     }
      }
    }
    return null;
}

function selectVal(obj){
	if($('amounts')) $('amounts').value = obj.value;	
	if($('notice')){
		$('notice').style.display = '';
		$('notice').innerHTML = obj.value +' 元 = '+ obj.value * coin_scale +' Ｕ币，请注意下方“红色”提示文字。';
	}
}

function hidden()
{
	if($('mask')) $('mask').style.display = 'none';
	//if($('pay')) $('pay').style.display = 'none';
	return;
}

function calert()
{
	if($('mask')) $('mask').style.display = 'none';
	if($('alert')) $('alert').style.display = 'none';
	jQuery("#pay_info").show();
	return;
}

// 普通方式提交
function pay_confirm()
{
	// 判断是否充值成功
	var sn = $('virtual_sn').value;
	Ajax.call('?act=pquery', 'sn='+sn, function (res){
		if(res.tag == 1){// 如果该订单已经支付成功，则提示用户
			payalert(res.msg);
			return false;
		}else{
			$('payform').action = $('gateway').value;
			//$('payform').target = '_blank';
			$('payform').submit();
			// 提交以后还原
			$('payform').action = 'javascript:pay_confirm()';
			$('payform').target = '_self';
			// 记录提交
			is_post = 1;
			$('pay_button').style.display = 'none';
			$('checkbtn').style.display = 'block';
			
			return false;
		}
	}, 'GET', 'JSON', true, true);
	return;
}

var qTimer = null;
var qCount = 0;
// ajax方式提交数据，适用于yeepay充值卡
function pay_ajax()
{
	var form = document.getElementById("payform");
	var args = "";
	var url  = $('gateway').value;
	if($('cardNO') && !$('cardNO').value){
		ialert("请填写充值卡卡号");return;
	}
	if($('cardPwd') && !$('cardPwd').value){
		ialert("请填写充值卡密码");return;
	}
	for (var i=0;i<form.length;i++){
		if(form.elements[i].name){
			args += "&"+form.elements[i].name + "=" + form.elements[i].value;
		}
	}
	Ajax.call(url, args, function(result)
	{
		if (result.error > 0){
			ialert(result.message);
		}else{
			if(result.tag == "1"){
				//$('pay').style.display = 'none';
				window.setTimeout(function(){pquery(result.odsn)}, 100);
			}else{
				ialert(result.msg);
			}
		}
	}, 'POST', 'JSON', true, true);
	// 记录提交
	is_post = 1;
	return;
}

/* 查询充值是否成功 */
function pquery(odsn)
{
	var sn = odsn;
	qCount++;
	Ajax.call('?act=pquery', 'sn='+sn, function (res){
		if(res.tag == 1 || res.tag == 2){
			window.clearTimeout(qTimer);
			payalert(res.msg);
			return;
		}else{
			if(qCount >= 100){
				window.clearTimeout(qTimer);
				ialert("充值还未成功，请联系客服核对。");
				qCount=0;
				return;
			}else{
				ialert("正在充值，请不要离开本页面。"+ qCount +"%");
			}
		}
	}, 'GET', 'JSON', true, true);
	qTimer = window.setTimeout(function(){pquery(sn);}, 3000);
}

/* 充值已充值提示 */
function payalert(s)
{
	ialert(s);
	$('alertbtn').onclick = function(){
		calert();
		document.location.reload();
	}
}

/* 提示 */
function ialert(s)
{
	$('alertmsg').innerHTML  = s;
	$('alert').style.display = '';
	//$('mask').style.display  = '';
	//$('mask').style.height   = document.body.offsetHeight + "px";
	//$('mask').style.width    = document.body.offsetWidth + "px";
	//$('alert').style.top     = (document.body.clientHeight - $('alert').clientHeight - 100)/2 + "px";
	//$('alert').style.left    = (document.body.clientWidth - $('alert').clientWidth)/2 + "px";	
	jQuery("#pay_info").hide();
	return;
}

/* 窗口大小变化后控件的位置 */
document.body.onresize = function()
{
	//if($('pay')){
	//	$('pay').style.top    = (document.body.clientHeight - $('pay').clientHeight - 50)/2 + "px";
	//	$('pay').style.left   = (document.body.clientWidth - $('pay').clientWidth)/2 + "px";
	//}
	//if($('mask')){
	//	$('mask').style.height = document.body.clientHeight + "px";
	//	$('mask').style.width  = document.body.clientWidth + "px";
	//}
};