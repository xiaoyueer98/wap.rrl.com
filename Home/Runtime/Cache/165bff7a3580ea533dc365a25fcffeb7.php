<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <link rel="stylesheet" type="text/css" href="/Public/new-css/reset.css"/>
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-recommende.css"/>    
        <script type="text/javascript" src="/Public/new-js/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black" name="apple-mobile-web-app-status-bar-style" />
        <meta content="telephone=no" name="format-detection" />
        <script type="text/javascript">
            $(document).ready(function () {
                $('.nav').hide();
                $(".gsjj-btn").click(function () {
                    $('.comp-text').slideDown();
                    $('.myh3-2').addClass("m");
                    $(".myh3").removeClass('m');
                    setTimeout(function () {
                        myScroll.refresh();
                    }, 500)
                })
                $('.myh3-2').click(function () {
                    $('.comp-text').slideUp();
                    $('.myh3-comp-text2').removeClass("m");
                    $(".myh3").addClass('m');
                    setTimeout(function () {
                        myScroll.refresh();
                    }, 500)
                })
                myScroll = new IScroll('#m', {
                    click: true,
                    scrollbars: true,
                    mouseWheel: true,
                    interactiveScrollbars: true,
                    shrinkScrollbars: 'scale',
                    fadeScrollbars: true
                });




                var list2 = $(".posi-nav li");
                var divs2 = $(".m-c>div");
                list2.on("click", function () {
                    that = $(this);
                    index = that.index();
                    that.addClass("m").siblings().removeClass("m");
                    $(this).find("a").addClass("m").parent("li").siblings().find("a").removeClass("m");
                    divs2.eq(index).show().siblings("div").hide();
                    setTimeout(function () {
                        myScroll.refresh();
                    }, 500)
                });

            })
            document.addEventListener('touchmove', function (e) {
                e.preventDefault();
            }, false);
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
        <div class="wrap job-wrap" id="wamp" >
            <div class="content">
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

  
                <div id="m" class="flex wap">
                    <div class="scroll md-pawd salon-index salon-child back-top">
                        <span class="position"><img src="/Public/new-images/icon5.png" alt=""></span>
                        <div class="salon-head">
                            <span class="dis-block"><img src="/Public/new-images/pic1.png" alt=""></span>
                            <i></i>
                            <?php if($isActive):?>
                            <a href='/index.php?s=/Salon/sign_up'><span class="btn">立即报名</span></a>
                            <?php endif;?>
                            <span class="head-position"><img src="/Public/new-images/icon6.png" alt=""></span>
                        </div>
                        <div>
                            <span class="title"><?php echo ($arActive["activename"]); ?>套图</span>
                        </div>
                        <div class="myimg">
                            <span class="clearfix"><img src="/Public/new-images/pic2.png" alt=""></span>
                        </div>
                        <div class="new-content" style='margin-left:5%;font-size:16px;margin-top:30px;margin-bottom:20px;'>
                            <?php echo ($arActive["content"]); ?>
                        </div>
                        <ul>
                            <?php if($arActivePre == 0): else: ?>
                                <li class="clearfix">
                                    <span class="dis-block fl-lef dis-inlin ms">上一期：</span>
                                    <em class="dis-block fl-lef dis-inlin  ms"><a href='/index.php?s=/Salon/salon_detail/id/<?php echo ($arActivePre["id"]); ?>' style="color:#545454;">如何在创业全里混上去。</a></em>
                                </li><?php endif; ?>
                            <?php if($arActiveNex == 0): else: ?>
                                <li class="clearfix">
                                    <span class="dis-block fl-lef dis-inlin ms">下一期：</span>
                                    <em class="dis-block fl-lef dis-inlin  ms"><a href='/index.php?s=/Salon/salon_detail/id/<?php echo ($arActiveNex["id"]); ?>' style="color:#545454;">论推荐人的心态，hr如何处理建立问题。</a></em>
                                </li><?php endif; ?>
                            <li class="clearfix mli" style="margin-top:20px;">
                                <a href="/">返回首页</a> | <a href="#top" class="scrol-top">回到顶部</a>
                            </li>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
        <script>
            $(function () {
                $(".scrol-top").click(function () {
                    $(".back-top").animate({
                        '-webkit-transform': 'translate(0,0)'
                    }, 400);
                    setTimeout(function () {
                        var myScroll1 = new IScroll('.wap', {mouseWheel: true, click: true});
                    }, 200)
                })
            })
        </script>
    </body>
</html>