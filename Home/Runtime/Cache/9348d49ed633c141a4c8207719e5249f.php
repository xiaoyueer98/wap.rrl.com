<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-company.css">
        <link rel="stylesheet" type="text/css" href="/Public/new-css/reset.css">
        <script type="text/javascript" src="/Public/new-js/iscroll.js"></script>
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



            <section class="content myresume" style="padding-bottom:20px;display:block">
                <div style="margin-bottom:5px;">
                    <span class="h3 dis-block">基本信息</span>
                </div>
                <div class="bd clearfix resume-divlist">
                    <div class="wh-center">
                        <em class="fl-lef dis-inlin dis-block l">姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名：</em><span class="r fl-lef dis-block dis-inlin wk"><?php echo $result['username']?></span>
                    </div>
                </div>

                <div class="bd clearfix resume-divlist">
                    <div class="wh-center">
                        <em class="fl-lef dis-inlin dis-block l">性&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp别：</em><span class="r fl-lef dis-block dis-inlin wk"><?php echo $result['sexdata']?></span>
                    </div>
                </div>

                <div class="bd clearfix resume-divlist">
                    <div class="wh-center">
                        <em class="fl-lef dis-inlin dis-block l">年&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp龄：</em><span class="r fl-lef dis-block dis-inlin wk"><?php echo $result['agedata']?></span>
                    </div>
                </div>

                <div class="bd clearfix resume-divlist">
                    <div class="wh-center">
                        <em class="fl-lef dis-inlin dis-block l">邮&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp箱：</em><span class="r fl-lef dis-block dis-inlin wk"><?php echo $result['email']?></span>
                    </div>
                </div>

                <div class="bd clearfix resume-divlist">
                    <div class="wh-center">
                        <em class="fl-lef dis-inlin dis-block l">Q&nbspQ号码：</em><span class="r fl-lef dis-block dis-inlin wk"><?php echo $result['qqnum']?></span>
                    </div>
                </div>

                <div class="bd clearfix resume-divlist">
                    <div class="wh-center">
                        <em class="fl-lef dis-inlin dis-block l">在职状态：</em><span class="r fl-lef dis-block dis-inlin wk"><?php echo $result['statedata']?></span>
                    </div>
                </div>

                <div class="bd clearfix resume-divlist">
                    <div class="wh-center">
                        <em class="fl-lef dis-inlin dis-block l">联系电话：</em><span class="r fl-lef dis-block dis-inlin wk"><?php echo $result['mobile']?></span>
                    </div>
                </div>

                <div class="bd clearfix resume-divlist">
                    <div class="wh-center">
                        <em class="fl-lef dis-inlin dis-block l">自我评价：</em><span class="r fl-lef dis-block dis-inlin wk"><?php echo $result['personal']?></span>
                    </div>
                </div>

                <div class="bd clearfix resume-divlist">
                    <div class="wh-center">
                        <em class="fl-lef dis-inlin dis-block l">教育经历：</em><span class="r fl-lef dis-block dis-inlin wk"><?php echo $result['educationdata']?></span>
                    </div>
                </div>

                <div class="bd clearfix resume-divlist">
                    <div class="wh-center">
                        <em class="fl-lef dis-inlin dis-block l">工作经历：</em><span class="r fl-lef dis-block dis-inlin wk"><?php echo $result['experiencedata']?></span>
                    </div>
                </div>

                <div class="bd clearfix resume-divlist">
                    <div class="wh-center">
                        <em class="fl-lef dis-inlin dis-block l">资格证书：</em><span class="r fl-lef dis-block dis-inlin wk"><?php echo $result['zige']?></span>
                    </div>
                </div>

                <div class="bd clearfix resume-divlist">
                    <div class="wh-center">
                        <em class="fl-lef dis-inlin dis-block l">推荐理由：</em><span class="r fl-lef dis-block dis-inlin wk"><?php echo $result['because']?></span>
                    </div>
                </div>

                <div class="bd clearfix resume-divlist">
                    <a class="btn" href='javascript:history.go(-1);'>返回</a>
                </div>
            </section>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
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

            })

            //document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
        </script>
    </body>
</html>