<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <link rel="stylesheet" type="text/css" href="/Public/new-css/reset.css">
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-company.css">
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-recommende.css">
        <script type="text/javascript" src="/Public/new-js/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/zepto.min.js"></script>
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="format-detection" content="telephone=no,email=no"/>
        <meta name="full-screen" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
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
    <div class="wrap">
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

  
        <div class="clearfix" style="margin-top:1px;border-bottom:1px solid #ccc;">
            <span class="qa-btn rcmd-btn dis-block m">我是推荐人</span>
            <span class="qa-btn hr-btn dis-block">我是企业HR</span>
        </div>
        <section class="content m-content1 qa-content rcmd" style="padding-bottom:20px;display:block">

            <?php foreach($arQAlist1 as $qaInfo):?>
            <div class="bd">
                <div class="div-list">
                    <div class="qa q clearfix">
                        <span class="fl-lef dis-block"></span>
                        <em class="fl-lef dis-block"><?php echo $qaInfo['question'];?></em>
                    </div>
                    <div class="qa a clearfix">
                        <span class="fl-lef dis-block"></span>
                        <em class="fl-lef dis-block"><?php echo $qaInfo['answer'];?></em>
                    </div>
                    <!--                    <div class="qa qa-img">
                                            <img src="/Public/new-images/new-company/qa-404.jpg" alt="">
                                        </div>-->
                </div>
            </div>
            <?php endforeach;?>
        </section>
        <section class="content m-content1 qa-content comp" style="padding:20px 0;display:none">
            <?php foreach($arQAlist2 as $qaInfo):?>
            <div class="bd">
                <div class="div-list">
                    <div class="qa q clearfix">
                        <span class="fl-lef dis-block"></span>
                        <em class="fl-lef dis-block"><?php echo $qaInfo['question'];?></em>
                    </div>
                    <div class="qa a clearfix">
                        <span class="fl-lef dis-block"></span>
                        <em class="fl-lef dis-block"><?php echo $qaInfo['answer'];?></em>
                    </div>
                    <!--                    <div class="qa qa-img">
                                            <img src="/Public/new-images/new-company/qa-404.jpg" alt="">
                                        </div>-->
                </div>
            </div>
            <?php endforeach;?>


        </section>
        <ul class="clearfix" style="padding-bottom:50px;margin-bottom:30px;margin-left:20px;">
            <!-- JiaThis Button BEGIN -->
            <!--  <b><img src="__ROOT__/Public/img/jt_up.png" alt=""></b> -->
            <div id="j_com_art_op" style="float:left;" onclick=""></div>
            <div class="jiathis_style_24x24" id="shareAction" style="padding: 20px 0;margin:0 auto;border:none;">

                <a class="jiathis_button_qzone"></a>
                <!-- <a class="jiathis_button_weixin"></a> -->
                <a class="jiathis_button_tsina"></a>
                <!-- <a class="jiathis_button_tqq"></a> -->
                <a class="jiathis_button_renren"></a>
                <a class="jiathis_button_cqq"></a>
<!--                <a  id="test" href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" style="" target="_blank"></a>-->
                <a class="jiathis_counter_style" style="margin-right: 5px;">0</a> 

            </div>


            <!-- JiaThis Button END -->
        </ul>
       
    </div>


    <script type="text/javascript">
        $(function () {
            $('.nav').hide();
        })

        $(document).ready(function () {
            $("input").click(function () {
                if (document.activeElement.tagName == 'INPUT') {
                    $(".fixed").css({'position': 'absolute', 'top': '0'});
                } else if (document.activeElement.tagName !== 'INPUT') {
                    $(".fixed").css('position', 'fixed');
                }
            })



        })

        $(".rcmd-btn").click(function () {
            $(".rcmd").show();
            $(".comp").hide();
            $(this).addClass("m").siblings().removeClass("m");
            //alert(23)
        })

        $(".hr-btn").click(function () {
            $(".rcmd").hide();
            $(".comp").show();
            $(this).addClass("m").siblings().removeClass("m");
        })


        //设置分享的内容
        var jiathis_config = {
            imageWidth: 26,
            marginTop: 150,
            url: "<?php echo $share['wapurl']?>",
            title: "<?php echo $share['title']?>",
            summary: "<?php echo $share['desc']?>",
            pic: "<?php echo $share['img']?>"
        }
    </script>
    <script type="text/javascript" src="http://v3.jiathis.com/code/plugin.client.js" charset="utf-8"></script>
    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Public/js/test.js"></script>
</body>
</html>