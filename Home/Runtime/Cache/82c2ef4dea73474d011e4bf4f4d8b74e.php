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
        <style>
            *{outline:none;}
            div{border: none;}
            #j_com_art_op ul{
                list-style: none;
            }
            #j_com_art_op .share_op{
                display: none;
                margin-left: 10px;
            }
            .platforms_small{
                border:none !important;
                padding:0;
                margin-left:10px;
                width: 60px;
            }
            .platforms_small ul li{
                display: inline-block;
                border: none;
                padding:0;
                padding-top:5px;
            }
            .platforms_small ul li span{
                width: 24px;
                height:24px;
                display: block;
                margin:0;
                padding: 0;
                margin-right:5px;
            }
            .platforms_small ul li span.aa{
                background: url(/Public/images/wx.png) no-repeat center !important;
                background-size: 100% 100%;
            }
            .platforms_small ul li span.bb{
                background: url(/Public/images/pyq.png) no-repeat center !important;
                background-size: 100% 100%;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.comp-text').slideDown();
                $('.myh3-2').addClass("m");
                $(".myh3").removeClass('m');
                $('.nav').hide();
                $(".gsjj-btn").click(function () {
                    $('.comp-text').slideDown();
                    $('.myh3-2').addClass("m");
                    $(".myh3").removeClass('m');
                    setTimeout(function () {
                        myScroll.refresh();
                    }, 500)
                })
                /*$('.myh3-2').click(function () {
                 $('.comp-text').slideUp();
                 $('.myh3-2').removeClass("m");
                 $(".myh3").addClass('m');
                 setTimeout(function () {
                 myScroll.refresh();
                 }, 500)
                 })*/
                myScroll = new IScroll('#m', {
                    click: true,
                    scrollbars: true,
                    mouseWheel: true,
                    interactiveScrollbars: true,
                    shrinkScrollbars: 'scale'
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
    <div class="wrap job-wrap" id="wamp">
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

  
            <?php
if(!empty($_GET['jobid'])){ $arJob = M("job")->where("id=".$_GET['jobid'])->find(); if(empty($arJob)){ header("location:/index.php?s=/Job/job_list"); die; } if(empty($arJob['title'])){ $arJob['title'] = getCascList($arJob['Jobcate'], "信息不明"); } $jobname = $arJob['title']; } if(!empty($_GET['jid'])){ $arResume = M("resume")->where("id=".$_GET['jid'])->find(); if(empty($arResume)){ header("location:/index.php?s=/Job/job_list"); die; } $resumename = $arResume['username']; } ?>

<ul class="rcmd-steps">
    <li class="fl-lef m1">
        <b class="m">第一步</b>
        <span class="m">选择要推荐的职位</span>
        <em style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width: 8em;padding-left:3px;"><?php if(!empty($jobname)){echo $jobname;}?></em>
    </li>
    <li class="fl-lef">
        <b>第二步</b>
        <span>选择推荐候选人</span>
        <em><?php if(!empty($resumename)){echo $resumename;}?></em>
    </li>
    <li class="fl-lef last">
        <b>第三步</b>
        <span>确认推荐</span>
    </li>
</ul>
<script>
   
    if(location.href.indexOf("job_list")!="-1" || location.href.indexOf("job_detail_new")!="-1"){
//        $(".rcmd-steps li")[0].className="fl-lef m";
//        $(".rcmd-steps li")[1].className="fl-lef";
//        $(".rcmd-steps li")[2].className="fl-lef last";
    }else if(location.href.indexOf("push_resume_new")!="-1" || location.href.indexOf("add_resume_new")!="-1"){
        $(".rcmd-steps li")[1].className="fl-lef m";
        $(".rcmd-steps li b")[1].className="m";
        $(".rcmd-steps li span")[1].className="m";
    }else{
        $(".rcmd-steps li")[1].className="fl-lef m";
        $(".rcmd-steps li b")[1].className="m";
        $(".rcmd-steps li span")[1].className="m";
        
        $(".rcmd-steps li")[2].className="fl-lef last m";
        $(".rcmd-steps li b")[2].className="m";
        $(".rcmd-steps li span")[2].className="m";
    }
</script>




            <div id="m" class="m detail flex">
                <div class="scroll">
                    <div class="bd">
                        <ul class="posit-name clearfix">
                            <li><b class="dis-block"><?php echo ($result["title"]); ?></b></li>
                            <li><span class="dis-block"><?php echo ($result["treatmentdata"]); ?></span></li>
                            <li><em class="dis-block">推荐成功入职,你即得奖励￥<?php echo ($result["Tariff"]); ?></em></li>
                            <?php if($tag==1){?>
                            <span class="clct m" id='collect'></span>
                            <?php }else{?>
                            <span class="clct" id='collect' ></span>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="bd">
                        <ul class="dt-cn">
                            <?php if($result["type"] == 1): ?><h3><?php echo ($result["cpname"]); ?></h3>
                                <?php else: ?>
                                <h3 class="m"></h3><?php endif; ?>

                            <li class="clearfix">
                                <div class="fl-lef"><span>融资阶段：</span><b><?php echo ($result["stagedata"]); ?> </b></div>
                                <div class="fl-rig"><span>性质：</span><b><?php echo ($result["naturedata"]); ?> </b></div>
                            </li>
                            <li class="clearfix">
                                <div class="fl-lef"><span>成立日期：</span><b><?php echo ($result["brightreg"]); ?></div>
                                <div class="fl-rig"><span> 规模：</span><b><?php echo ($result["scaledata"]); ?> </b></div>
                            </li>
                            <li class="clearfix">
                                <div class="fl-lef"><span>招聘人数：</span><b><?php echo ($result["employ"]); ?> </b></div>
                                <div class="fl-rig"><span>推荐人数：</span><b style="color:red;"><?php echo ($result["recommendednum"]); ?> </b></div>
                            </li>
                            <li class="clearfix">
                                <?php if(!empty($result['report'])):?>
                                <div class="fl-lef"><span>汇报对象：</span><b><?php echo ($result["report"]); ?> </b></div>
                                <?php endif;?>
                                <?php if(!empty($result['report_number'])):?>
                                <div class="fl-rig"><span>下属人数：</span><b style="color:red;"><?php echo ($result["report_number"]); ?> </b></div>
                                <?php endif;?>
                            </li>
                            <li class="clearfix">
                                <div class="fl-lef"><span>工作地点：</span><b><?php echo ($result["cascname"]); ?>  </b></div>
                                <div class="fl-rig"><span>学历要求：</span><b><?php echo ($result["educationdata"]); ?> </b></div>
                            </li>
                        </ul>
                    </div>

                    <ul class="posi-nav">
                        <li class="hover-hand m">职位信息</li>
                        <li class="hover-hand">公司简介</li>
                        <li class="hover-hand">累积评价</li>
                    </ul>
                    <div class="m-c">
                        <div class="detail-f1">
                            <div class="bd">
                                <ul>
                                    <h3>岗位职责</h3>
                                    <!--									<li>1、负责整个网站改版网页制作、实现网站用户;</li>
                                                                                                            <li>1、负责整个网站改版网页制作、实现网站用户;</li>
                                                                                                            <li>1、负责整个网站改版网页制作、实现网站用户;</li>
                                                                                                            <li>1、负责整个网站改版网页制作、实现网站用户;</li>-->
                                    <p><?php echo ($result["workdesc"]); ?></p>
                                </ul>
                            </div>
                            <div class="bd">
                                <ul>
                                    <h3>任职要求</h3>
                                    <!--									<li>1、负责整个网站改版网页制作、实现网站用户;</li>
                                                                                                            <li>1、负责整个网站改版网页制作、实现网站用户;</li>
                                                                                                            <li>1、负责整个网站改版网页制作、实现网站用户;</li>
                                                                                                            <li>1、负责整个网站改版网页制作、实现网站用户;</li>-->
                                    <p><?php echo ($result["content"]); ?></p>
                                </ul>
                            </div>
                            <div class="bd" <?php if($result["softlytip"] == ""): ?>style='display:none;'<?php endif; ?>>
                                <ul>
                                    <h3>职位温馨提示</h3>
                                    <!--									<li>1、负责整个网站改版网页制作、实现网站用户;</li>
                                                                                                            <li>1、负责整个网站改版网页制作、实现网站用户;</li>
                                                                                                            <li>1、负责整个网站改版网页制作、实现网站用户;</li>
                                                                                                            <li>1、负责整个网站改版网页制作、实现网站用户;</li>-->
                                    <div class="softlytip" style='border:1px green dashed;padding:10px 20px;'><?php echo ($result["softlytip"]); ?></div>
                                </ul>
                            </div>
                            <div class="bd"  <?php if($result["remark"] == ""): ?>style='display:none;'<?php endif; ?>>
                                <ul>
                                    <h3>补充说明</h3>
                                    <!--									<li>1、负责整个网站改版网页制作、实现网站用户;</li>
                                                                                                            <li>1、负责整个网站改版网页制作、实现网站用户;</li>
                                                                                                            <li>1、负责整个网站改版网页制作、实现网站用户;</li>
                                                                                                            <li>1、负责整个网站改版网页制作、实现网站用户;</li>-->
                                    <p><?php echo ($result["remark"]); ?></p>
                                </ul>
                            </div>
                        </div>
                        <div class="detail-f1" style="display:none;">
                            <div class="myh3 m">
                                <h3 class="hover-hand gsjj-btn">公司简介</h3>
                            </div>
                            <div class="comp-text">
                                <ul>

                                    <p class="comp-pf">
                                        <b>公司介绍</b>
                                        <!--51Talk无忧英语，成立于2011年，我们的创始团队来自清华大学外语系，总部位于中国北京，现有近1000人，并且我们的团队还在不断地扩大中，在上海、菲律宾均设有分公司，是专门从事互联网在线英语培训的教育机构。经过两年多的发展，我们现在已经成为一家拥有2500多名外教，在线学员达数十万之多的业界领军品牌！我们自成立之初凭借着卓越的表现获得了【2013在线1对1口语培训机构最受网友喜爱奖】、【最佳网络影响力奖】、【创业邦100-中国年度创新成长企业100强】、新浪网【最具口碑影响力外语教育机构】、腾讯网【十年知名在线教育机构】等一系列荣誉，受到业界瞩目，欢迎你加入我们！-->
                                    <p><?php echo ($result["intro"]); ?></p>
                                    </p>
                                </ul>
                                <ul>
                                    <p class="comp-pf">
                                        <b>公司亮点</b>
                                        <!--办公环境优美别墅区还有饮料和，各种小吃吗西瓜，每天还有免费的晚餐负责整个网站改版网页制作、实现网站用户;-->
                                    <p><?php echo ($result["bright"]); ?></p>
                                    </p>
                                </ul>
                            </div>
                            <div>
                                <?php if(is_array($result_job)): $i = 0; $__LIST__ = $result_job;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/index.php?s=/Job/job_detail_new/jobid/<?php echo ($vo["id"]); ?>">
                                        <ul class="latest-position">
                                            <li class="clearfix lis1">
                                                <div class="fl-lef dis-inlin">
                                                    <em class="fl-lef dis-inlin dis-block"><?php echo ($vo["title"]); ?></em>
                                                </div>
                                                <div class="fl-rig dis-inlin">
                                                    <em class="fl-lef dis-inlin dis-block"><?php echo ($vo["treatmentdata"]); ?></em>
                                                </div>
                                            </li>
                                            <li class="clearfix lis2">
                                                <div class="fl-lef dis-inlin">

                                                    <span class="fl-lef dis-inlin dis-block">招聘人数:<i><?php echo ($vo["employ"]); ?></i></span>
                                                    <span class="fl-lef dis-inlin dis-block">已推荐人数:<b style="color:red;"><?php echo ($vo["recommendednum"]); ?></b></span>

                                                </div>
                                                <div class="fl-rig dis-inlin r">
                                                    <span class="fl-lef dis-inlin dis-block">[<?php echo ($vo["cascname"]); ?>]</span>
                                                </div>
                                            </li>
                                            <li class="clearfix lis3">
                                                <em class="fl-lef dis-inlin">候选人入职，你即得奖励￥<?php echo ($vo["Tariff"]); ?></em>
                                                <span class="fl-rig dis-inlin"><?php echo ($vo["starttime"]); ?></span>
                                            </li>
                                        </ul>
                                    </a><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>

                        </div>
                        <div class="detail-f1" style="display:none;">
                            <?php if(is_array($arComment)): $i = 0; $__LIST__ = $arComment;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div>
                                    <div>
                                        <p><?php echo ($vo["content"]); ?></p>
                                    </div>
                                    <div class="clearfix">
                                        <span class="fl-lef"><?php echo ($vo["username"]); ?></span>
                                        <span class="fl-rig">[$vo.time]</span>
                                    </div>
                                </div><?php endforeach; endif; else: echo "$empty" ;endif; ?>

                        </div>
                    </div>
                    <ul class="clearfix" style="margin-bottom:50px;">
                        <!-- JiaThis Button BEGIN -->
                        <div id="j_com_art_op" style="float:left;" onclick=""></div>
                        <div class="jiathis_style_24x24" id="shareAction" style="padding: 20px 0;margin-left:5%;border:none;">

                            <a class="jiathis_button_qzone"></a>
                            <!-- <a class="jiathis_button_weixin"></a> -->
                            <a class="jiathis_button_tsina"></a>
                            <!-- <a class="jiathis_button_tqq"></a> -->
                            <a class="jiathis_button_renren"></a>
                            <a class="jiathis_button_cqq"></a>
                            <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" style="" target="_blank"></a>
                            <!-- <a class="jiathis_counter_style" style="margin-right: 5px;"></a> -->

                        </div>

                        <!-- JiaThis Button END -->
                    </ul>
                </div>
            </div>


        </div>
    </div>
    <?php if(!empty($_SESSION['cuserinfo'])):?>
    <a href="javascript:like_alert('您是企业账号，请登录推荐人账号再试！')" class="delivery"  data-form="0" style="font-size:30px;" >
        <span class="myrcmd-btn">
            我要推荐
        </span>
    </a>
    <?php else:?>
    <a href="/index.php?s=/Job/push_resume_new/jobid/<?php echo ($result["id"]); ?>/type/1" class="delivery"  data-form="0" style="font-size:30px;" >
        <span class="myrcmd-btn">
            我要推荐
        </span>
    </a>
    <?php endif;?>

    <div style='display:none;'>
        <input type='hidden' value='<?php echo ($result["content"]); ?>' name='content'>
        <input type='hidden' value='<?php echo ($result["workdesc"]); ?>' name='workdesc'>
    </div>

    <style>
.mask{
	position: fixed;
	z-index: 3;
	display: block;
	width: 100%;
	height: 100%;
	background: #000;
	opacity: .7;
	filter: alpha(opacity=70);
}    
.tanchu{
	width: 300px;
	height: 120px;
	padding:10px 0;
	background: #ffffff;
	box-shadow: 1px 1px 10px #2c2b2b;
	position: fixed;
	left: 50%;
	top: 50%;
	margin-left:-150px;
	margin-top: -90px;
	z-index: 4;
	border-radius: 15px;
}
.tanchu dl{
	margin:0 auto;
	width: 260px;
	margin-top: 10px;
}

.tanchu dl dd{
	text-align: center;
	color: #2380b8;
	line-height: 30px;
	font-size: 16px;
	font-weight: bold;
}
.tanchu dl dd button{
	width: 110px;
	height: 30px;
	background: #2380b8;
	border-radius: 5px;
	border:none;
	color: #ffffff;
	margin-top:10px;
}    
</style>
<div style="display:none;" id="like_alert_kuang">
<div class="mask"></div>
<div class="tanchu">
    <dl>
        <dd id="alert_title"></dd>
        <dd id="alert_ok"><button>确定</button></dd>
    </dl>
</div>
</div>

<script type="text/javascript">
    
    //调用这个方法的前提是，引入了jquery
    function  like_alert(title){
        
        $("#alert_title").html(title);
        $("#like_alert_kuang").css("display","block");
        $("#alert_ok").click(function(){
            $("#like_alert_kuang").css("display","none");
        })
    }
    
    function  re_like_alert(title){
        
        $("#alert_title").html(title);
        $("#like_alert_kuang").css("display","block");
        $("#alert_ok").click(function(){
            $("#like_alert_kuang").css("display","none");
            location.reload();
        })
       
    }
    
    function  lo_like_alert(title,url){
        
        $("#alert_title").html(title);
        $("#like_alert_kuang").css("display","block");
        $("#alert_ok").click(function(){
            $("#like_alert_kuang").css("display","none");
            location.href=url;
        })
       
    }
    
    
</script>    
    <script>
        $("#collect").click(function () {

            if (this.className == "clct") {
                $(this)[0].disabled = true;

                var cpid = "<?php echo ($result["cpid"]); ?>";
                var j_id = "<?php echo ($result["id"]); ?>";
                var title = "<?php echo ($result["title"]); ?>";
                var treatmentdata = "<?php echo ($result["treatmentdata"]); ?>";
                var endtime = "<?php echo ($result["endtime"]); ?>";
                var Tariff = "<?php echo ($result["Tariff"]); ?>";
                var employ = "<?php echo ($result["employ"]); ?>";
                var experiencedata = "<?php echo ($result["experiencedata"]); ?>";
                var educationdata = "<?php echo ($result["educationdata"]); ?>";
                var jobplacedata = "<?php echo ($result["jobplacedata"]); ?>";
                var strycatedata = "<?php echo ($result["strycatedata"]); ?>";
                var Jobcatedata = "<?php echo ($result["Jobcatedata"]); ?>";
                var email = "<?php echo ($result["email"]); ?>";
                var mobile = "<?php echo ($result["mobile"]); ?>";
                var joblangdata = "<?php echo ($result["joblangdata"]); ?>";
                var orderid = "<?php echo ($result["orderid"]); ?>";
                var cascname = "<?php echo ($result["cascname"]); ?>";
                var content = $("[name='content']").val();
                var workdesc = $("[name='workdesc']").val();
                var posttime = "<?php echo ($result["posttime"]); ?>";
                var starttime = "<?php echo ($result["starttime"]); ?>";
                $.post("/index.php?s=/Job/collect_job", {
                    'cpid': cpid,
                    'j_id': j_id,
                    'title': title,
                    'treatmentdata': treatmentdata,
                    'endtime': endtime,
                    'Tariff': Tariff,
                    'employ': employ,
                    'experiencedata': experiencedata,
                    'educationdata': educationdata,
                    'jobplacedata': jobplacedata,
                    'strycatedata': strycatedata,
                    'Jobcatedata': Jobcatedata,
                    'email': email,
                    'mobile': mobile,
                    'joblangdata': joblangdata,
                    'orderid': orderid,
                    'cascname': cascname,
                    'content': content,
                    'workdesc': workdesc,
                    'posttime': posttime,
                    'starttime': starttime
                }, function (data) {
                    if (data.code == "400") {
                        location.href = "/index.php?s=/Login/login";
                        return;
                    } else {
                        re_like_alert(data.msg);
                        return;
                    }
                }, "json");
            } else {
                $(this)[0].disabled = true;
                var j_id = "<?php echo ($result["id"]); ?>";
                $.post("/index.php?s=/Job/cancel_collect_job", {
                    'j_id': j_id
                }, function (data) {

                    if (data.code == "400") {
                        location.href = "/index.php?s=/Login/login";
                        return;
                    } else if (data.code != "200") {
                        like_alert(data.msg);
                        $("#collect")[0].disabled = false;
                        return;
                    } else {
                        re_like_alert(data.msg);
                        return;
                    }
                }, "json");
            }

        })
        var url = "<?php echo ($share['url']); ?>";
        var title = "<?php echo ($share['title']); ?>";
        var desc = "<?php echo ($share['description']); ?>";
        //当点击分享按钮时触发的事件
        $("#shareAction").click(function () {


            $.post("__URL__/saveShareUrl", {
                'url': url
            }, function (data) {
            }, "json")
        });

        //设置分享的内容
        var jiathis_config = {
            imageWidth: 26,
            marginTop: 150,
            url: url,
            title: title,
            summary: desc,
            pic: "http://www.renrenlie.com/Public/img/web_logo.png"
        }

    </script>
    <script type="text/javascript" src="http://v3.jiathis.com/code/plugin.client.js" charset="utf-8"></script>
    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Public/js/test.js"></script>
</body>
</html>