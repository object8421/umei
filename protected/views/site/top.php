<!--排行榜01-->
<div class="thumBox">
    <div class="thumTitle">
        <span class="thumTitleName">排行榜</span>
    </div>
    <!--thumMid-->
    <div class="thumMid wd grayBg pdb">
        <div class="rankWrap">
            <!--rwShow-->
            <div class="rwShow">
                <!--01-->
                <div class="rwBox">
                    <h3><span class="rankTop20"></span><strong>明星排行榜（天）</strong></h3>
                    <div class="rankWrapList">
                        <ol id="con_one_1">
                        </ol>
                    </div>
                </div>
                <!--01 end-->
                <!--02-->
                <div class="rwBox">
                    <h3><span class="rankTop20"></span><strong>明星排行榜（周）</strong></h3>
                    <div class="rankWrapList">
                        <ol id="con_one_2">
                        </ol>
                    </div>
                </div>
                <!--02 end-->
                <!--03-->
                <div class="rwBox">
                    <h3><span class="rankTop20"></span><strong>明星排行榜（月）</strong></h3>
                    <div class="rankWrapList">
                        <ol id="con_one_3">
                        </ol>
                    </div>
                </div>
                <!--03 end-->
                <!--04-->
                <div class="rwBox">
                    <h3><span class="rankTop20"></span><strong>明星排行超级榜</strong></h3>
                    <div class="rankWrapList">
                        <ol id="con_one_4">
                        </ol>
                    </div>
                </div>
                <!--04 end-->
            </div>
            <!--rwShow end-->
        </div>
        <!--排行榜01 end-->
        <!--排行榜02-->
        <div class="rankWrap">
            <!--rwShow-->
            <div class="rwShow rwShowYellow">
                <!--01-->
                <div class="rwBox">
                    <h3><span class="rankTop20"></span><strong>富豪排行榜（天）</strong></h3>
                    <div class="rankWrapList">
                        <ol id="con_two_1"></ol>
                    </div>
                </div>
                <!--01 end-->
                <!--02-->
                <div class="rwBox">
                    <h3><span class="rankTop20"></span><strong>富豪排行榜（周）</strong></h3>
                    <div class="rankWrapList">
                        <ol id="con_two_2"></ol>
                    </div>
                </div>
                <!--02 end-->
                <!--03-->
                <div class="rwBox">
                    <h3><span class="rankTop20"></span><strong>富豪排行榜（月）</strong></h3>
                    <div class="rankWrapList">
                        <ol id="con_two_3"></ol>
                    </div>
                </div>
                <!--03 end-->
                <!--04-->
                <div class="rwBox">
                    <h3><span class="rankTop20"></span><strong>富豪排行超级榜</strong></h3>
                    <div class="rankWrapList">
                        <ol id="con_two_4"></ol>
                    </div>
                </div>
                <!--04 end-->
            </div>
            <!--rwShow end-->
        </div>
        <!--排行榜02 end-->
    </div>
    <!--thumMid end-->
</div>
<script>
    var top_rank = <?php echo $rank ?>;
    var rich = top_rank.rich;
    var glam = top_rank.glam;

    insert_rank(glam.day, 1,'con_one_1');
    insert_rank(glam.week, 1,'con_one_2');
    insert_rank(glam.month, 1,'con_one_3');
    insert_rank(glam.supe, 1,'con_one_4');
    insert_rank(rich.day, 2,'con_two_1');
    insert_rank(rich.week, 2,'con_two_2');
    insert_rank(rich.month, 2,'con_two_3');
    insert_rank(rich.supe, 2,'con_two_4');

    function insert_rank(arr,type,id)
    {
        //console.log('insert_rank');
        //console.log(arr);
        var tmp ='';
        var len = 20;
        if(arr){
            len = len-arr.length;
            for(var i=0; i<arr.length; i++){
                var temp = '';
                if( i == 0 ){
                    temp = '<li class="rankOne"><span class="rankNum">'+(i+1)+'</span>';
                }else if( i == 1 ){
                    temp = '<li class="rankTwo"><span class="rankNum">'+(i+1)+'</span>';
                }else if( i == 2 ){
                    temp = '<li class="ranThree"><span class="rankNum">'+(i+1)+'</span>';
                }else{
                    temp = '<li class="rankTB"><span class="rankNum">'+(i+1)+'</span>';
                }
                temp += '<span class="rankPic"><img src="'+arr[i].avatar+'" alt="" /></span><span class="rankLink">';

                if (type == 1){
                    temp += '<a href="/'+ arr[i].gid + '" title="" target="_blank">'+arr[i].nick+'</a>';
                }
                else{
                    temp += arr[i].nick;
                }
                temp += '</span><span class="rankTB">';
                if (type == 1){
                    temp += '<i class="zhuboIco zb'+arr[i].star+'"></i>';
                }
                else{
                    if(arr[i].vip){
                        temp += '<i class="jwIco V'+arr[i].vip+'"></i>';
                    }else if(arr[i].vip2){
                        temp += '<i class="vipIco"></i>';
                    }else{
                        temp += '<i class="lmIco"></i>';
                    }

                }
                temp += '</span></li>';
                tmp += temp;
            }
        }
        for(var i=20-len;i<20;i++){
            if( i == 0 ){
                tmp += '<li class="rankOne"><span class="rankNum">'+(i+1)+'</span>';
            }else if( i == 1 ){
                tmp += '<li class="rankTwo"><span class="rankNum">'+(i+1)+'</span>';
            }else if( i == 2 ){
                tmp += '<li class="ranThree"><span class="rankNum">'+(i+1)+'</span>';
            }else{
                tmp += '<li class="rankTB"><span class="rankNum">'+(i+1)+'</span>';
            }
            tmp +='</li>';
        }
        //console.log(tmp);
        $('#'+id).html(tmp);
    }
</script>