<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <link rel="stylesheet"  href="/Public/new-css/reset.css">
        <link rel="stylesheet"  href="/Public/new-css/new-recommende.css">
        <script type="text/javascript" src="/Public/new-js/iscroll-refresh.js"></script>
        <script type="text/javascript" src="/Public/new-js/jquery-1.11.0.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black" name="apple-mobile-web-app-status-bar-style" />
        <meta content="telephone=no" name="format-detection" />
        <script type="text/javascript">
            var num = 2;
            var myScroll,
                    pullDownEl, pullDownOffset,
                    pullUpEl, pullUpOffset,
                    generatedCount = 0;
            function ajx(page, number) {
                $.ajax({
                    type: 'POST',
                    url: '/index.php?s=/Recommend/get_recommended_list',
                    data: 'page=' + page + '&number=' + number,
                    dataType: 'json',
                    success: function (data) {

                        if (data.count == 0) {
                            if ($.trim($("#thelist2").html()) == "") {
                                $('#thelist2').append('<div class="resultjobs clearfix" style="font-size:14px;text-align:center;line-height:50px;color:#b4b4b4;">还未有历史推荐的职位!</div>');
                            }
                            $('#pullUp').hide();
                            return;
                        }
                        if (data.count <= (num - 2) * 10) {
                            $("#over").html('<div class="resultjobs clearfix" style="font-size:14px;text-align:center;line-height:50px;color:#b4b4b4;">加载已完成!</div>');
                            $('#pullUp').hide();
                            return;
                        }
                        var data = eval(data['result']);

                        for (var i = 0; i < data.length; i++) {

                            var str = "";
                            str = '<div class="bd2">'
                                    + '<div class="lists" onclick="show($(this))">'
                                    + '<ul class="latest-position">'
                                    + '<li class="clearfix lis1">'
                                    + '<div class="fl-lef dis-inlin">'
                                    + '<span class="fl-lef dis-inlin dis-block mysp1">' + data[i]['username'] + '</span>'
                                    + '<em class="fl-lef dis-inlin dis-block">' + data[i]['title'] + '</em>'
                                    + '</div>'
                                    + '<div class="fl-rig dis-inlin">'
                                    + '<span class="fl-lef dis-inlin dis-block">推荐费：</span>'
                                    + '<b>' + data[i]['Tariff'] + '</b>'
                                    + '</div>'
                                    + '</li>'
                                    + '<li class="clearfix lis1">'
                                    + '<div class="fl-lef dis-inlin r">' + data[i]['cpname'] + '</div>'

                                    + '<div class="fl-rig dis-inlin r"><span class="fl-lef dis-inlin dis-block">招聘人数:<b>' + data[i]['recommendnum'] + '</b></span></div>'
                                    + '</li>'
                                    + '<li class="clearfix lis2">'
                                    + '<div class="fl-lef dis-inlin">'

                                    + '<span class="fl-lef dis-inlin dis-block mysp1">' + data[i]['treatmentdata'] + '</span>'
                                    + '<span class="fl-lef dis-inlin dis-block">进度:<b>' + data[i]['audstartdata'] + '</b></span>'

                                    + '</div>';
                            if (data[i]['audstart'] > 3 && data[i]['audstart'] < 8 && data[i]['is_evaluate'] == 1) {
                                var str1 = data[i]['recordid']+","+data[i]['j_id']+",'"+data[i]['cpname']+"'";
                                str +=
                                        '<div class="fl-rig dis-inlin">'
                                        + '<span id="pingjia" class="pinj-btn" onclick="recomment('+str1+');">评价</span>'
                                        + '</div>';
                            }

                            str += '</li>'
                                    + '</ul>'
                                    + '<span class="down"></span>'
                                    + '</div>'
                                    + '<div class="list-process">'
                                    + '<ul>';
                            
                            if (data[i]['notice_log'].length > 0) {
                                for (var j = 0; j < data[i]['notice_log'].length; j++) {
                                    str +=
                                            '<li class="clearfix">'
                                            + '<span class="sp1 l">'
                                            + ' <em> ' + data[i]['notice_log'][j]['posttime'] + '</em>'
                                            + '<b></b>'
                                            + '</span>'
                                            + '<span class="sp3">'
                                            + '<em>' + data[i]['notice_log'][j]['content'] + '</em>';
                                    if (j == 0) {
                                        str += '<b class="m"></b>';
                                    } else {
                                        str += '<b class=""></b>';
                                    }


                                    str += '</span></li>';
                                }
                            }
                            str += '</ul></div></div>';
                            $('#thelist2').append(str);
                        }
                    }
                });
                ++num;
            }
            function pullUpAction() {
                ajx(num, 10);
                setTimeout(function () {
                    var el, li, i;
                    el = document.getElementById('thelist');
                    myScroll.refresh();
                }, 1000);
            }
            function pullUpAction2() {
                setTimeout(function () {
                    ajx(1, 10)
                    myScroll.refresh();
                }, 1000);
            }



            /**
             * 初始化iScroll控件
             */
            function loaded() {
                pullDownEl = document.getElementById('pullDown');
                pullDownOffset = pullDownEl.offsetHeight;
                pullUpEl = document.getElementById('pullUp');
                pullUpOffset = pullUpEl.offsetHeight;
                myScroll = new iScroll('thelist', {
                    scrollbarClass: 'myScrollbar', /* 重要样式 */
                    useTransition: false, /* 此属性不知用意，本人从true改为false */
                    topOffset: pullDownOffset,
                    onRefresh: function () {
                        if (pullDownEl.className.match('loading')) {
                            pullDownEl.className = '';
                            pullDownEl.querySelector('.pullDownLabel').innerHTML = '下拉刷新...';
                        } else if (pullUpEl.className.match('loading')) {
                            pullUpEl.className = '';
                            pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
                        }
                    },
                    onScrollMove: function () {
                        if (this.y > 5 && !pullDownEl.className.match('flip')) {
                            pullDownEl.className = 'flip';
                            pullDownEl.querySelector('.pullDownLabel').innerHTML = '松手开始更新...';
                            this.minScrollY = 0;
                        } else if (this.y < 5 && pullDownEl.className.match('flip')) {
                            pullDownEl.className = '';
                            pullDownEl.querySelector('.pullDownLabel').innerHTML = '下拉刷新...';
                            this.minScrollY = -pullDownOffset;
                        } else if (this.y < (this.maxScrollY - 5) && !pullUpEl.className.match('flip')) {
                            pullUpEl.className = 'flip';
                            pullUpEl.querySelector('.pullUpLabel').innerHTML = '松手开始更新...';
                            this.maxScrollY = this.maxScrollY;
                        } else if (this.y > (this.maxScrollY + 5) && pullUpEl.className.match('flip')) {
                            pullUpEl.className = '';
                            pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
                            this.maxScrollY = pullUpOffset;
                        }
                    },
                    onScrollEnd: function () {
                        if (pullDownEl.className.match('flip')) {
                        } else if (pullUpEl.className.match('flip')) {
                            pullUpEl.className = 'loading';
                            pullUpEl.querySelector('.pullUpLabel').innerHTML = '<img src="/Public/images/loading.gif" style="width:25px;height:25px;padding-top:7px;margin:0 auto;display:block">';
                            pullUpAction(); // Execute custom function (ajax call?)
                        }
                    }
                });
            }
            //初始化绑定iScroll控件 
            document.addEventListener('touchmove', function (e) {
                e.preventDefault();
            }, false);
            document.addEventListener('DOMContentLoaded', loaded, false);</script>
    </head>
    <body>
    <style>
    header #rnew{
        width: 102px;
        height: 22px;
        display: block;
        position: absolute;
        right: 10px;
        top: 0px;
        text-align: right;
        line-height: 43px;
        font-size: 12px;
    } 
    header #rnew a{color:white;}
    header #rnew span{color:white;}
    
</style>
<header class="rec_hd">	
    <?php if(strpos($_SERVER['HTTP_REFERER'],"Login/login")===false): ?>
    <span class="l" onclick="history.go(-1);"></span>
    <?php endif;?>
    <ul class="hd_li">
        <li><?php echo ($header_title); ?></li>
    </ul>
    <?php if(!empty($_SESSION['userinfo']) || !empty($_SESSION['cuserinfo']) ){ ?>
    <label class="r"></label>
    <?php }else{ ?>
    <label id ='rnew'>
        <a href="/index.php?s=/Login/login">登录</a>
        <span>|</span>
        <a href="/index.php?s=/Reg/reg">注册</a>
    </label>
    <?php } ?>
</header>

<span style="display:none;"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></span>
<script>
    $(document).ready(function () {
        $('.hd_li>li').click(function () {
            $(".head-nav").toggle(100);
        });
        $('.hd_ul li').click(function () {
            $(this).addClass('m').siblings().removeClass('m');
        });
        $('.rec_hd label').click(function () {
            if ($(this).hasClass("current")) {
                $('.nav').hide();
                $(".head-nav").hide();
                $(this).css('-webkit-transform', 'rotate(0deg)');
                $(this).removeClass("current");
            } else {
                $('.nav').show();
                $(".head-nav").hide();
                $(this).css('-webkit-transform', 'rotate(45deg)');
                $(this).addClass("current");
            }

        })
    })
</script>
    <ul class="head-nav abslt" style='display:none;'>
    <?php if(is_array($lArr)): $k = 0; $__LIST__ = $lArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="">
            <a href="<?php echo ($vo["url"]); ?>">
                <span class="dis-block sp-img">
                    <img src="<?php echo ($vo["img"]); ?>" alt="">
                </span>
                <span class="dis-block sp-text"><?php echo ($vo["name"]); ?></span>
            </a>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>

</ul>
<script>
    $(function () {
        $(".head-nav li").each(function () {
            if (location.href.indexOf($(this).find("a").attr("href")) != "-1" && $(this).find("a").attr("href") != "/") {
                this.className = "m";
            } else {
                if (location.href.indexOf("/Job/job_detail_new") != "-1" || location.href.indexOf("/Job/push_resume_new") != "-1" || location.href.indexOf("/Job/resume_time_new") != "-1" || location.href.indexOf("/Job/add_resume_new") != "-1") {
                    $(".head-nav li")[1].className = "m";
                }else if(location.href.indexOf("/Salon/sign_up") != "-1" || location.href.indexOf("/Salon/salon_detail") != "-1"){
                    $(".head-nav li")[1].className = "m";
                } else {
                    this.className = "";
                }
            }
        })
    })
</script>
    <div id="wrap" class="job-wrap">
        <div class="content">
            <div id="pullDown" style="display:none">
                <span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新...</span>
            </div>
            <?php if(!empty($_SESSION['userinfo'])){?>
<ul id="nav" class="nav" style="background:white;">
    <li><a href="/index.php?s=/Usercenter/myinfo"><?php if($select == 'info'): ?><span class="sp0 sp0_2"></span><b class='m'>我的资料</b><?php else: ?><span class="sp0"></span><b>完善资料</b><?php endif; ?></a></li>
    <li><a href="/index.php?s=/Job/add_resume"><?php if($select == 'resume'): ?><span class="sp4 sp4_2"></span><b class='m'>简历库</b><?php else: ?><span class="sp4"></span><b>简历库</b><?php endif; ?></a></li>
    <li><a href="/index.php?s=/Job/job_list"><?php if($select == 'collect'): ?><span class="sp2 sp2_2"></span><b class='m'>推荐职位</b><?php else: ?><span class="sp2"></span><b>推荐职位</b><?php endif; ?></a></li>
    <li><a href="/index.php?s=/Recommend/recommending"><?php if($select == 'recommend'): ?><span class="sp1 sp1_2"></span><b class='m'>跟踪状态</b><?php else: ?><span class="sp1"></span><b>跟踪状态</b><?php endif; ?></a></li>
    <li><a href="/index.php?s=/Job/my_account"><?php if($select == 'account'): ?><span class="sp3 sp3_2"></span><b class='m'>查看收益</b><?php else: ?><span class="sp3"></span><b>查看收益</b><?php endif; ?></a></li>
</ul>
<?php }else if(!empty($_SESSION['cuserinfo'])){?>
<ul id="nav" class="nav" style='background:white;display:none;'>
    <li><a href="/index.php?s=/Company/complete_info"><span <?php if($select == 'info'): ?>class="sp0 sp0_2" <?php else: ?> class="sp0"<?php endif; ?>></span><b <?php if($select == 'info'): ?>class='m'<?php endif; ?>>完善资料</b></a></li>
    <li><a href="/index.php?s=/Company/agreement_status"><span <?php if($select == 'agreement'): ?>class="sp1 sp1_2" <?php else: ?> class="sp1"<?php endif; ?>></span><b <?php if($select == 'agreement'): ?>class='m'<?php endif; ?>>签订合同</b></a></li>
    <li><a href="/index.php?s=/Company/send_job"><span  <?php if($select == 'send_job'): ?>class="sp2 sp2_2" <?php else: ?>class="sp2"<?php endif; ?>></span><b <?php if($select == 'send_job'): ?>class='m'<?php endif; ?>>发布职位</b></a></li>
    <li><a href="/index.php?s=/Company/candidate"><span <?php if($select == 'candidate'): ?>class="sp3 sp3_2" <?php else: ?> class="sp3"<?php endif; ?>></span><b <?php if($select == 'candidate'): ?>class='m'<?php endif; ?>>查看候选人</b></a></li>
    <li><a href="/index.php?s=/Company/process_track"><span  <?php if($select == 'record'): ?>class="sp4 sp4_2" <?php else: ?>class="sp4"<?php endif; ?>></span><b <?php if($select == 'record'): ?>class='m'<?php endif; ?>>入职管理</b></a></li>
</ul>
<?php } ?>

  
            <div id="thelist" class="job-list-content process">

                <div class="list-candidates" style="padding-bottom:45px;">
                    <div id="thelist2">
                        <?php  foreach($result as $k=>$v) {?>
                        <div class="bd2">
                            <div class="lists">
                                <ul class="latest-position">
                                    <li class="clearfix lis1">
                                        <div class="fl-lef dis-inlin">
                                            <span class="fl-lef dis-inlin dis-block mysp1"><?php echo $v['username']?></span>
                                            <em class="fl-lef dis-inlin dis-block"><?php echo $v['title']?></em>
                                        </div>
                                        <div class="fl-rig dis-inlin">
                                            <span class="fl-lef dis-inlin dis-block">推荐费：</span>
                                            <b><?php echo $v['Tariff']?></b>
                                        </div>
                                    </li>
                                    <li class="clearfix lis1">
                                        <div class="fl-lef dis-inlin r"><?php echo $v['cpname']?></div>

                                        <div class="fl-rig dis-inlin r"><span class="fl-lef dis-inlin dis-block">招聘人数:<b><?php echo $v['recommendnum']?></b></span></div>
                                    </li>
                                    <li class="clearfix lis2">
                                        <div class="fl-lef dis-inlin">

                                            <span class="fl-lef dis-inlin dis-block mysp1"><?php echo $v['treatmentdata']?></span>
                                            <span class="fl-lef dis-inlin dis-block">进度:<b><?php echo $v['audstartdata']?></b></span>

                                        </div>
                                        <?php if($v['audstart']>3 && $v['audstart']<8 && $v['is_evaluate']==1){?>
                                        <div class="fl-rig dis-inlin">
                                            <input type='hidden' value="{$v[recordid]}">
                                            <span id="pingjia" class="pinj-btn" onclick='recomment("<?php echo ($v[recordid]); ?>", "<?php echo ($v[j_id]); ?>", "<?php echo ($v[cpname]); ?>")'>评价</span>
                                        </div>
                                        <?php }?>
                                    </li>
                                </ul>
                                <span class="down"></span>
                            </div>
                            <div class="list-process">
                                <ul>
                                    <?php foreach ($v['notice_log'] as $ko=>$vo){ ?>
                                    <li class="clearfix">
                                        <span class="sp1 l">
                                            <em><?php echo $vo['posttime']?></em>
                                            <b></b>
                                        </span>
                                        <span class="sp3">
                                            <em><?php echo $vo['content']?></em>   
                                            <b class="<?php if($ko=='0') echo 'm';?>"></b>
                                        </span>
                                    </li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                        <?php }?>

                    </div>
                    <div id='over' style='border-bottom: 1px solid #ccc;'></div>
                    <div id="pullUp" style="font-family: '微软雅黑';background: #fff;height: 40px;line-height: 40px;padding: 5px 10px;border-bottom: 1px solid #ccc;font-weight: bold;font-size: 14px;color: #888;">
                        <span class="pullUpIcon"></span><div style="margin:0 auto;display:block;width:96px;" class="pullUpLabel">上拉加载更多...</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".lists").click(function () {
                if( $(this).hasClass("current")){
                    $(this).next().hide();
                    $(this).removeClass('m').find(".down").removeClass('m');
                    //$(this).parent().prev().find(".down").hide();
                    $(this).parent().addClass("bd2");
                    //$(this).addClass("bd2");
                    $(this).parent().prev().addClass("bd2");
                    $(this).removeClass("current");
                    myScroll.refresh(); 
                }else{
                    $(this).next().show();
                    $(this).parent().siblings().find(".list-process").hide();
                    $(this).parent().siblings().find(".lists").removeClass('m');
                    $(this).parent().siblings().addClass("bd2");
                    $(this).parent().prev().removeClass("bd2");
                    //$(this).parent().css({'border-bottom': '1px #afafaf solid'});
                    $(this).addClass('m').find(".down").addClass('m');
                    $(this).parent().siblings().find(".down").removeClass('m');
                    $(this).addClass('m').find(".down").addClass('m');
                    $(this).addClass("current");
                    myScroll.refresh(); 
                }
                
            })
        });
        function show(ob) {
            ob.next().show();
            ob.parent().siblings().find(".list-process").hide();
            ob.parent().siblings().find(".lists").removeClass('m');
            ob.parent().siblings().css({'border-bottom': '1px #afafaf solid'});
            ob.parent().prev().css({'border-bottom': 'none'});
            ob.parent().css({'border-bottom': '1px #afafaf solid'});
            ob.addClass('m').find(".down").addClass('m');
            ob.parent().siblings().find(".down").removeClass('m');
            ob.addClass('m').find(".down").addClass('m');
            myScroll.refresh();
        }
        function  recomment(recordid, j_id, pname) {
            location.href = "/index.php?s=/Recommend/text_evaluate/recordid/" + recordid + "/j_id/" + j_id + "/pname/" + pname+"/type/1";
        }
    </script>
</body>
</html>