<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>  
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎-职位详情</title>
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-company.css">
        <link rel="stylesheet" type="text/css" href="/Public/new-css/reset.css">
        <script type="text/javascript" src="/Public/new-js/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/zepto.min.js"></script>
        <script type="text/javascript" src="/Public/new-js/jquery-1.11.0.min.js"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="format-detection" content="telephone=no,email=no"/>
        <meta name="full-screen" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
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
        <div class="wrap">
            <ul id="nav" class="nav" style='background:white;display:none;'>
    <li><a href="/index.php?s=/Company/complete_info"><span <?php if($select == 'info'): ?>class="sp0 sp0_2" <?php else: ?> class="sp0"<?php endif; ?>></span><b <?php if($select == 'info'): ?>class='m'<?php endif; ?>>完善资料</b></a></li>
    <li><a href="/index.php?s=/Company/agreement_status"><span <?php if($select == 'agreement'): ?>class="sp1 sp1_2" <?php else: ?> class="sp1"<?php endif; ?>></span><b <?php if($select == 'agreement'): ?>class='m'<?php endif; ?>>签订合同</b></a></li>
    <li><a href="/index.php?s=/Company/send_job"><span  <?php if($select == 'send_job'): ?>class="sp2 sp2_2" <?php else: ?>class="sp2"<?php endif; ?>></span><b <?php if($select == 'send_job'): ?>class='m'<?php endif; ?>>发布职位</b></a></li>
    <li><a href="/index.php?s=/Company/candidate"><span <?php if($select == 'candidate'): ?>class="sp3 sp3_2" <?php else: ?> class="sp3"<?php endif; ?>></span><b <?php if($select == 'candidate'): ?>class='m'<?php endif; ?>>查看候选人</b></a></li>
    <li><a href="/index.php?s=/Company/process_track"><span  <?php if($select == 'record'): ?>class="sp4 sp4_2" <?php else: ?>class="sp4"<?php endif; ?>></span><b <?php if($select == 'record'): ?>class='m'<?php endif; ?>>入职管理</b></a></li>
</ul>



            <section class="is-rct resume detail" style="padding-bottom:20px;display:block">
                <div class="bd details-con">
                    <div class="details">
                        <div class="wh-center95 clearfix">
                            <h4><?php echo $arJob['title']?></h4>
                        </div>
                    </div>
                    <div class="details">
                        <div class="wh-center95 clearfix">
                            <span><?php echo $arJob['treatmentdata']?></span>
                        </div>
                    </div>
                    <div class="details">
                        <div class="wh-center95 clearfix">
                            <em>推荐成功入职,你即得奖励￥<?php echo $arJob['Tariff_old']?></em>
                        </div>
                    </div>
                </div>

                <div class="pd-tb resume-list resume-list2 payment-list2">
                    <div class="rcmt-list back-none">
                        <div class="div-list odiv1 clearfix">
                            <h3><?php echo $arJob['cpname']?></h3>
                        </div>
                        <div class="div-list odiv1 clearfix">
                            <span class="fl-lef">融资阶段：</span>
                            <span class="fl-lef fot-bold"><?php echo $arJob['stagedata']?></span>
                            <div class="fl-rig">
                                <span class="fl-lef">性质：</span>
                                <span class="fl-lef fot-bold"><?php echo $arJob['naturedata']?></span>
                            </div>
                        </div>
                        <div class="div-list odiv2 clearfix">
                            <span class="fl-lef">成立日期：</span>
                            <span class="fl-lef fot-bold"><?php echo $arJob['brightreg']?></span>
                            <div class="fl-rig dis-block">
                                <span class="fl-fl">规模：</span>
                                <span class="fl-fl fot-bold"><?php echo $arJob['naturedata']?>人</span>
                            </div>
                        </div>
                        <div class="div-list odiv3 clearfix">
                            <span class="fl-lef">招聘人数：</span>
                            <span class="fl-lef fot-bold"><?php echo $arJob['employ']?></span>
                            <div class="fl-rig dis-block">
                                <span class="fl-fl">推荐人数：</span>
                                <span class="fl-fl fot-bold red"><?php echo $arJob['recommendednum']?></span>
                            </div>
                        </div>
                        <div class="div-list odiv4 clearfix">
                            <span class="fl-lef">工作地点：</span>
                            <span class="fl-lef fot-bold"><?php echo $arJob['jobplace']?></span>
                            <div class="fl-rig">
                                <span class="fl-lef">学历要求：</span>
                                <span class="fl-lef fot-bold"><?php echo $arJob['educationdata']?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btnlist">
                    <span class="m">职位信息</span>
                    <span>公司简介</span>
                </div>
                <div class="mycon">
                    <div class="ms1">
                        <div style="margin:10px 0;">
                            <span class="h3 dis-block">岗位职责</span>
                        </div>
                        <div class="bd">
<!--                            <div class="wh-center">1、负责整个网站改版网页制作、实现网站用户1、负责整个网站改版网页制作、实现网站用户1、负责整个网站改版网页制作、实现网站用户;</div>
                            <div class="wh-center">1、负责整个网站改版网页制作、实现网站用户;</div>
                            <div class="wh-center">1、负责整个网站改版网页制作、实现网站用户;</div>
                            <div class="wh-center">1、负责整个网站改版网页制作、实现网站用户;</div>-->
                            <div class="wh-center"><?php echo $arJob['workdesc']?></div>
                        </div>
                        <div style="margin:10px 0;">
                            <span class="h3 dis-block">任职要求</span>
                        </div>
                        <div class="">
<!--                            <div class="wh-center">1、负责整个网站改版网页制作、实现网站用户1、负责整个网站改版网页制作、实现网站用户1、负责整个网站改版网页制作、实现网站用户;</div>
                            <div class="wh-center">1、负责整个网站改版网页制作、实现网站用户;</div>
                            <div class="wh-center">1、负责整个网站改版网页制作、实现网站用户;</div>
                            <div class="wh-center">1、负责整个网站改版网页制作、实现网站用户;</div>-->
                            <div class="wh-center"><?php echo $arJob['content']?></div>
                        </div>
                    </div>
                    <div class="ms2 undis">
                        <div style="margin:10px 0;">
                            <span class="h3 dis-block">公司介绍</span>
                        </div>
                        <div class="bd">
                            <div class="wh-center" style="padding-bottom:10px;"><?php echo $arJob[intro]?></div>
                        </div>
                        <div style="margin:10px 0;">
                            <span class="h3 dis-block">公司亮点</span>
                        </div>
                        <div class="">
                            <div class="wh-center"><?php echo $arJob[bright]?></div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                var odiv4 = $(".rcmt-list .odiv4").width();
                var mmWidth = $(".rcmt-list .mm").width();
                $(".rcmt-list .eject").width(odiv4 - (mmWidth + 5))
                $("#m-tre").click(function () {
                    if ($("#m-tre").hasClass("current")) {
                        $(".m-phone").hide();
                        $(this).removeClass("current").removeClass("m");
                    } else {
                        $(".m-phone").show();
                        $(this).addClass("current").addClass("m");
                    }
                })

                $("input").click(function () {
                    if (document.activeElement.tagName == 'INPUT') {
                        $(".fixed").css({'position': 'absolute', 'top': '0'});
                    } else if (document.activeElement.tagName !== 'INPUT') {
                        $(".fixed").css('position', 'fixed');
                    }
                })

                var index;
                var list = $(".btnlist span");
                var divs = $(".mycon>div");
                list.on("click", function () {
                    that = $(this);
                    index = that.index();
                    //that.addClass("m").siblings().removeClass("m");
                    $(this).addClass("m").siblings().removeClass("m");
                    divs.eq(index).show().siblings("div").hide();
                });

            })

            //document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
        </script>
    </body>
</html>