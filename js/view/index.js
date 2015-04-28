/**
 * Description:
 *
 * @module
 */
/*首页轮播*/
$(function () {
    var focusBox = $(".focusBox");
    var liElement = $(".focusNum a");
    var urElement = $(".focusMain ul");
    var w = $(".focusMain").width();
    var h = $(".focusMain").height();
    var animated = null;
    var time = 2000;//轮播时间
    var currentPath = 0;//当前索引
    var trueFale = true;//默认true为自动轮播，false为禁止自动轮播
    $(liElement).each(function (index) {
        $(this).mouseenter(function (event) {
            event.preventDefault();
            $(this).addClass("current").siblings().removeClass("current");
            var selector = 'li:has([src="' +
                $(this).find('img').attr('src') +
                '"])';
            $('.focusMain').find(selector).prependTo('.focusMain ul')
            currentPath = index;
        });
    });
    //判断是否自动轮播
    if (trueFale) {
        animated = setInterval(autoPaly, time);
        //清除+还原
        $(focusBox).hover(function () {
            clearInterval(animated);
        }, function () {
            animated = setInterval(autoPaly, time);
        });
    }
    //自动轮播函数
    function autoPaly() {
        $(urElement).animate({"top": -309}, function () {
            $(urElement).css('top', 0).find('li:first').appendTo(urElement)
        });
        var $li = $(liElement);
        var $current = $li.eq(currentPath);
        $current.addClass("current").siblings().removeClass("current");
    };
});
/*首页->广告*/
$(function () {
    var bannerAd = $(".bannerAd");
    var bannerLi = $(".bannerEle li");
    var bannerLiLength = $(".bannerEle li").length;
    var bannerMenu = $(".bannerMenu");
    var bannerEleUl = $(".bannerEle ul");
    var w = $(".bannerEle").width();
    var h = $(".bannerEle").height();
    var animatedBanner = null;
    var timeBanner = 2000;//轮播时间
    var currentPathBanner = 0;//当前索引
    var trueFale = true;//默认true为自动轮播，false为禁止自动轮播
    //创建广告导航
    for (var i = 0; i < bannerLiLength; i++) {
        $(bannerMenu).append('<a href="#">' + +'</a>')
    }
    ;
    $(bannerMenu).find("a").eq(0).addClass("current");
    $(".bannerMenu a").each(function (index) {
        $(this).click(function (event) {
            event.preventDefault();
            $(this).addClass("current").siblings().removeClass("current");
            $(bannerEleUl).animate({"left": -index * w});
            currentPath = index;
        });
    });
    //判断是否自动轮播
    if (trueFale) {
        animatedBanner = setInterval(autoShow, timeBanner);
        //清除+还原
        $(bannerAd).hover(function () {
            clearInterval(animatedBanner);
        }, function () {
            animatedBanner = setInterval(autoShow, timeBanner);
        });
    }
    //自动轮播函数
    function autoShow() {
        if (currentPathBanner < bannerLiLength - 1) {
            currentPathBanner++;
        } else {
            currentPathBanner = 0;
        }
        $(bannerEleUl).animate({"left": -currentPathBanner * w});
        $(".bannerMenu a").eq(currentPathBanner).addClass("current").siblings().removeClass("current");
    };
});
function get_rank() {
    //console.log('get_rank');
    var url = '/site/rank';
    $.post(url, function (result) {
            //console.log('update_rank. ' + result);
            var res = jQuery.parseJSON(result);
            //console.log(res);
            var rich = res.rich;
            var glam = res.glam;
            insert_rank(glam.day, 1, 'con_one_1');
            insert_rank(glam.week, 1, 'con_one_2');
            insert_rank(glam.month, 1, 'con_one_3');
            insert_rank(glam.supe, 1, 'con_one_4');
            insert_rank(rich.day, 2, 'con_two_1');
            insert_rank(rich.week, 2, 'con_two_2');
            insert_rank(rich.month, 2, 'con_two_3');
            insert_rank(rich.supe, 2, 'con_two_4');
        }
    );
}
function insert_rank(arr, type, id) {
    //console.log('insert_rank');
    //console.log(arr);
    var tmp = '';
    var strNoData = '';
    if (arr) {
        for (var i = 0; i < arr.length; i++) {
            var temp = '';
            if (i == 0) {
                var firstClass = (id=="con_one_1")?'rankTop  rankTop-anchor':'rankTop rankTop1';
                temp = '<li class="rankChamp"><span class="' +
                firstClass +
                '"><i class="crownIco"></i></span><div class="rankPicture"><a class="rankPic"><img src="' + arr[i].avatar + '" alt="" /><i>遮罩</i></a><p><a href="';
                //temp = '<li class="mranking-lm lm1 f-cb"><div class="state-biao bc-pink">' + arr[i].rank + '</div><img class="mranking-img" src="' + arr[i].avatar+ '" width="60" height="60" title=""><b class="mranking-tt"><a class="c-pink" href="';
            }
            else {
                temp = '<li><span class="rankTop rankTop' + arr[i].rank + '"></span><span class="rankLinks"> <a href="';
                //temp = '<li class="mranking-lm lm2 m21 f-cb"><div class="state-biao">' + arr[i].rank + '</div><b class="mranking-tt"><a class="c6" href="';
            }
            if (type == 1) {
                temp += '/' + arr[i].gid + '" target="_blank">';
            }
            else {
                temp += 'javascript:;">';
            }
            temp += '' + arr[i].nick + '</a></span><span class="rankIco">';
            if (type == 1) {
                temp += '<img src="images/star/s' + arr[i].star + '.png">';
            }
            else {
                //temp += 'images/title/t'+arr[i].title+'.gif"';
                temp += '<img src="images/vip/v' + arr[i].vip + '.gif">';
            }
            temp += '</span></li>';
            tmp += temp;
        }
        if (arr.length == 0) {
            tmp = '<span class="rankLinks">' +
            strNoData +
            '</span>';
        }
    } else {
        tmp = '<span class="rankLinks">' +
        strNoData +
        '</span>';
    }
    //console.log(tmp);
    $('#' + id).html(tmp);
}
get_rank();
function cat_it(cat_id, cat_name) {
    var url = '/room/list';
    if(cat_id != 0){
        url += '/catid/'+cat_id;
    }
    $.post(url, function (result) {
            //console.log('cat_it. ' + result);
            $('.mainContent').html(result);
            //$('#hall_index').html('<h2 class="tt">返回大厅</h2>');
        }
    );
}
function load_family_recommend() {
    var url = '/site/familyRecommend';
    $.post(url, function (result) {
            //console.log('cat_it. ' + result);
            $('#family_com').html(result);
            //$('#hall_index').html('<h2 class="tt">返回大厅</h2>');
        }
    );
}
load_family_recommend();