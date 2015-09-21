<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <link rel="stylesheet"  href="/Public/new-css/reset.css">
        <link rel="stylesheet"  href="/Public/new-css/new-company.css">
        <script type="text/javascript" src="/Public/new-js/iscroll-refresh.js"></script>
        <script type="text/javascript" src="/Public/new-js/jquery-1.11.0.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black" name="apple-mobile-web-app-status-bar-style" />
        <meta content="telephone=no" name="format-detection" />
        <script type="text/javascript">

            var myScroll,
                    pullDownEl, pullDownOffset,
                    pullUpEl, pullUpOffset,
                    generatedCount = 0;

            var num = 2;
            function ajx(page, number) {
                $.ajax({
                    type: 'POST',
                    url: '?s=/Company/get_process_list_ajax',
                    data: 'page=' + page + '&number=' + number,
                    dataType: 'json',
                    success: function (data) {

                        if (data.count == 0) {
                            if ($.trim($("#thelist2").html()) == "") {
                                $('#thelist2').append('<div class="resultjobs clearfix" style="font-size:14px;text-align:center;line-height:50px;color:#b4b4b4;">还未有发布过职位，先去发布职位!</div>');
                            }
                            $('#pullUp').hide();
                            return;
                        }
                        if (data.count <= (num - 2) * 10) {
                            $('#pullUp').hide();
                            $("#over").html('<div class="resultjobs clearfix" style="font-size:14px;text-align:center;line-height:50px;color:#b4b4b4;">加载已完成!</div>');

                            return;
                        }
                        var data = eval(data['result']);

                        for (var i = 0; i < data.length; i++) {


                            var str = "";
                            str = '<div class="bd">'
                                    + '<div class="lists" onclick="show($(this))">'
                                    + '<ul class="latest-position">'
                                    + '<li class="clearfix lis1">'
                                    + '<div class="fl-lef dis-inlin">'
                                    + '<span class="fl-lef dis-inlin dis-block">' + data[i]['title'] + '</span>'
                                    + '</div>'
                                    + '<div class="fl-rig dis-inlin">'
                                    + '<span class="fl-lef dis-inlin dis-block">招聘费：</span>'
                                    + '<b class="red">' + data[i]['Tariff'] + '</b>'
                                    + '</div>'
                                    + '</li>'
                                    + '<li class="clearfix lis1">'
                                    + '<div class="fl-lef dis-inlin r date">推荐进度</div>'

                                    + '<div class="fl-rig dis-inlin r"><span class="fl-lef dis-inlin dis-block">招聘人数：<i class="red">' + data[i]['employ'] + '</i></span></div>'
                                    + '</li>'
                                    + '</ul>'
                                    + '<span class="down"></span>'
                                    + '</div>'
                                    + '<div class="list-process">'
                                    + '<ul>';

                            if (data[i]['logList'].length > 0) {
                                for (var j = 0; j < data[i]['logList'].length; j++) {
                                    str += '<li class="clearfix">'
                                            + '<span class="sp1 l">'
                                            + '<em>' + data[i]['logList'][j]['created_at'] + '</em>'
                                            + '<b></b>'
                                            + '</span>'
                                            + '<span class="sp3">'
                                            + '<em>' + data[i]['logList'][j]['content'] + '</em>'
                                    if (j == 0) {
                                        str += '<b class="m"></b>'
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
                setTimeout(function () {
                    ajx(num, 10);
                    var el, li, i;
                    el = document.getElementById('thelist');
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
                            pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载中...';
                            pullUpAction(); // Execute custom function (ajax call?)
                        }
                    }
                });
            }
            //初始化绑定iScroll控件 
            document.addEventListener('touchmove', function (e) {
                e.preventDefault();
            }, false);
            document.addEventListener('DOMContentLoaded', loaded, false);
        </script>
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
   
    <label class="r"></label>
    
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
                $(this).removeClass('m')
                $(this).removeClass("current");
            } else {
                
                $('.nav').show();
                $(".head-nav").hide();
                $(this).addClass('m')
                $(this).addClass("current");
            }

        })
    })
</script>
    <ul class="head-nav" style='display:none;'>
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
                
                this.className = "";
            }
        })
    })
</script>
    <div id="wrap" class="job-wrap" style="padding-top:45px;">
        <div class="content">
            <div id="pullDown" style="display:none">
                <span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新...</span>
            </div>
            <div id="thelist" class="job-list-content process" style="position:absolute;top:45px;bottom:0;">
                <div class="list-candidates" style="padding-bottom:45px;">
                    <div id="thelist2">
                        <ul id="nav" class="nav" style='background:white;display:none;'>
    <li><a href="/index.php?s=/Company/complete_info"><span <?php if($select == 'info'): ?>class="sp0 sp0_2" <?php else: ?> class="sp0"<?php endif; ?>></span><b <?php if($select == 'info'): ?>class='m'<?php endif; ?>>完善资料</b></a></li>
    <li><a href="/index.php?s=/Company/agreement_status"><span <?php if($select == 'agreement'): ?>class="sp1 sp1_2" <?php else: ?> class="sp1"<?php endif; ?>></span><b <?php if($select == 'agreement'): ?>class='m'<?php endif; ?>>签订合同</b></a></li>
    <li><a href="/index.php?s=/Company/send_job"><span  <?php if($select == 'send_job'): ?>class="sp2 sp2_2" <?php else: ?>class="sp2"<?php endif; ?>></span><b <?php if($select == 'send_job'): ?>class='m'<?php endif; ?>>发布职位</b></a></li>
    <li><a href="/index.php?s=/Company/candidate"><span <?php if($select == 'candidate'): ?>class="sp3 sp3_2" <?php else: ?> class="sp3"<?php endif; ?>></span><b <?php if($select == 'candidate'): ?>class='m'<?php endif; ?>>查看候选人</b></a></li>
    <li><a href="/index.php?s=/Company/process_track"><span  <?php if($select == 'record'): ?>class="sp4 sp4_2" <?php else: ?>class="sp4"<?php endif; ?>></span><b <?php if($select == 'record'): ?>class='m'<?php endif; ?>>入职管理</b></a></li>
</ul>


                        <?php if($jobList):?>
                        <?php foreach($jobList as $k=>$v):?>
                        <div class="bd">
                            <div class="lists">
                                <ul class="latest-position">
                                    <li class="clearfix lis1">
                                        <div class="fl-lef dis-inlin">
                                            <span class="fl-lef dis-inlin dis-block"><?php echo $v[title]?></span>
                                        </div>
                                        <div class="fl-rig dis-inlin">
                                            <span class="fl-lef dis-inlin dis-block">招聘费：</span>
                                            <b class="red">￥<?php echo $v[Tariff]?></b>
                                        </div>
                                    </li>
                                    <li class="clearfix lis1">
                                        <div class="fl-lef dis-inlin r date">推荐进度</div>

                                        <div class="fl-rig dis-inlin r"><span class="fl-lef dis-inlin dis-block">招聘人数：<i class="red"><?php echo $v[employ]?></i></span></div>
                                    </li>
                                </ul>
                                <span class="down"></span>
                            </div>
                            <div class="list-process">

                                <ul>
                                    <?php foreach($v[logList] as $k=>$logv):?>
                                    <li class="clearfix">
                                        <span class="sp1 l">
                                            <em><?php echo date("Y-m-d H:i",$logv['created_at'])?></em>
                                            <b></b>
                                        </span>
                                        <span class="sp3">
                                            <em><?php echo $logv[content]?></em>   
                                            <b <?php if($k==0):?>class='m'<?php endif;?>></b>
                                        </span>
                                    </li>
                                    <?php endforeach;?>



                                </ul>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php endif;?>

                    </div>
                    <div id="pullUp" style="font-family: '微软雅黑';background: #fff;height: 40px;line-height: 40px;padding: 5px 10px;border-bottom: 1px solid #ccc;font-weight: bold;font-size: 14px;color: #888;">
                        <span class="pullUpIcon"></span><div style="margin:0 auto;display:block;width:96px;" class="pullUpLabel">上拉加载更多...</div>
                    </div><div id="over"></div>
                </div> 
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".lists").click(function () {
                if ($(this).hasClass("current")) {
                    $(this).next().hide();
                    $(this).removeClass('m').find(".down").removeClass('m');
                    $(this).parent().addClass("bd2");
                    $(this).parent().prev().addClass("bd2");
                    $(this).parent().siblings().find(".lists").removeClass("current");
                    $(this).removeClass("current");
                    myScroll.refresh();
                } else {
                    $(this).next().show();
                    $(this).parent().siblings().find(".list-process").hide();
                    $(this).parent().siblings().find(".down").show();
                    $(this).parent().siblings().find(".lists").removeClass('m');
                    $(this).parent().prev().find(".down").hide();
                    $(this).parent().siblings().addClass("bd2");
                    $(this).parent().prev().removeClass("bd2");
                    $(this).parent().siblings().find(".lists").removeClass("current");
                    $(this).parent().siblings().find(".down").removeClass('m');
                    $(this).addClass('m').find(".down").addClass('m');
                    $(this).addClass("current");
                    myScroll.refresh();
                }
            })

        });
        function show(ob) {
            if (ob.hasClass("current")) {
                ob.next().hide();
                ob.removeClass('m').find(".down").removeClass('m');
                ob.parent().addClass("bd2");
                ob.parent().prev().addClass("bd2");
                ob.parent().siblings().find(".lists").removeClass("current");
                ob.removeClass("current");
                myScroll.refresh();
            } else {
                ob.next().show();
                ob.parent().siblings().find(".list-process").hide();
                ob.parent().siblings().find(".down").show();
                ob.parent().siblings().find(".lists").removeClass('m');
                ob.parent().prev().find(".down").hide();
                ob.parent().siblings().addClass("bd2");
                ob.parent().prev().removeClass("bd2");
                ob.parent().siblings().find(".lists").removeClass("current");
                ob.parent().siblings().find(".down").removeClass('m');
                ob.addClass('m').find(".down").addClass('m');
                ob.addClass("current");
                myScroll.refresh();
            }
        }
    </script>
</body>
</html>