<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎-上传简历坐等收钱</title>
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-company.css">
        <link rel="stylesheet" type="text/css" href="/Public/new-css/reset.css">
        <?php if(!empty($_SESSION['userinfo'])):?>
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-recommende.css"/>   
        <?php endif;?>
        <script type="text/javascript" src="/Public/new-js/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/zepto.min.js"></script>
        <script type="text/javascript" src="/Public/new-js/jquery-1.11.0.min.js"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="format-detection" content="telephone=no,email=no"/>
        <meta name="full-screen" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <style>
            .com-list input{
                background: #dff1ff;
            }
        </style>
    </head>
    <body>
        <div class="mask" style="display:none"></div>

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
    <p class="error"></p>
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

  

        <section class="content m-content1" style="padding-bottom:20px;display:block;margin-top:1px;">
            <div class="srdz-banner"><img src="/Public/new-images/srdz-banner2.png" alt=""></div>
            <div class="srdz-text">
                <div class="clearfix">
                    <div class="clearfix">
                        <p class="clearfix" style="width:auto;padding:0 10px;">
                            <label class="fl-lef"><b>HR：</b></label><em class="fl-lef" style="width:74%">如果你是HR，你所在的公司若招聘1人，往往会面试4-5人，面试过后但未录用的人，其实可以<b>大额变现</b>。</em>
                        </p>
                        <p class="clearfix" style="width:auto;padding:0 10px;">
                            <label class="fl-lef"><b>猎头：</b></label><em class="fl-lef" style="width:70%">如果你是猎头，每月会详细了解50名候选人，但是一般只有1-2名候选人拿到offer，你可以将剩余的50人<b>大额变现</b>。</em>
                        </p>
                    </div>
                    <span class="dis-block bt"><b>1</b>上传简历</span>
                    <div class="clearfix"><em class="fl-lef">你只需每天下班后，将候选人简历上传至人人猎，要求上传的候选人简历满足：<br>1 . 年薪<b>10万</b>以上的互联网中高端人才；<br>2 . 候选人<b>正在看</b>工作机会。</em></div>
                    <span class="dis-block bt"><b>2</b>系统匹配</span>
                    <div class="clearfix"><em class="fl-lef">人人猎会将你上传的候选人简历<b>匹配</b>到与其最合适的工作机会，并协调面试预约。</em></div>
                    <span class="dis-block bt"><b>3</b>随心掌控</span>
                    <div class="clearfix"><em class="fl-lef">当你上传候选人进入人人猎推荐流程后，可随时在用户中心查看候选人<b>面试状态</b>。</em></div>
                    <span class="dis-block bt"><b>4</b>入职拿钱</span>
                    <div class="clearfix"><em class="fl-lef">候选人入职后，就可得到相应的推荐<b>奖金</b>。</em></div>
                    <span class="ms">还等什么，<b>快去电脑上传简历</b>吧</span>

                </div>
                <ul class="clearfix" style="margin-bottom:10px;margin-left:20px;">
                    <!-- JiaThis Button BEGIN -->
                    <div id="j_com_art_op" style="float:left;" onclick=""></div>
                    <div class="jiathis_style_24x24" id="shareAction" style="padding: 20px 0;margin:0 auto;border:none;">

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
            <!-- <div style="background:#dff1ff;padding:10px 0">
                    <div>
                            <span class="h3 dis-block">工作机会私人定制卡</span>
                    </div>
                    <div class="com-list">
                            <div class="bd3">
                                    <div class="list"><em class="m">姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名：</em><input type="text" placeholder="请输入姓名，系统会对个人信息保密"></div>
                            </div>
                            <div class="bd3">
                                    <div class="list" id="com-size"><em class="m" style="width:60px;">手&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp机：</em><input style="width:70px!important" type="text" placeholder="请输入手机号码"><span class="hqyzm hqyzm2">免费获取验证码</span></div>
                            </div>
                            <div class="bd3">
                                    <div class="list"><em class="m">验&nbsp&nbsp证&nbsp&nbsp码：</em><input type="text" placeholder="请输入验证码"></div>
                            </div>
                            <div class="bd3">
                                    <div class="list"><em class="m">上传简历：</em><span style="color:#2281b9;"><b>请在PC端上传附件简历</b></span></div>
                            </div>
                            <div class="bd3">
                                    <div class="list"><em class="m wh100">方便联系的时间：</em><input class="wh-55" type="text" placeholder="请输入方便与您联系的时间"></div>
                            </div>
                            <div class="bd3">
                                    <div class="list"><em class="m">其他说明：</em><input type="text" placeholder="请输入其他更多的要求"></div>
                            </div>
                    </div>
            </div> -->
            <div>
                <span class="btn" id="btn">马上参与</span>
            </div>

        </section>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("input").click(function () {
                if (document.activeElement.tagName == 'INPUT') {
                    $(".fixed").css({'position': 'absolute', 'top': '0'});
                } else if (document.activeElement.tagName !== 'INPUT') {
                    $(".fixed").css('position', 'fixed');
                }
            })
            $("#btn").click(function () {
                $.post(
                        "/index.php?s=/Upresume/is_login",
                        "",
                        function (re) {
                            if ($.trim(re) == 1) {
                                location.href = "/index.php?s=/Job/add_resume.html";
                                return;
                            } else if ($.trim(re) == 2) {
                                show_error("您目前是企业用户，请切换为推荐人用户后，参与活动", 3);
                                return;
                            } else {
                                location.href = "/index.php?s=/Job/add_resume.html";
                                return;
                            }
                        }, "json");
            })

        })
        function set_time(tip, wait) {
            if (wait == 0) {
                $(".error").html("");
                $(".error").fadeOut();
                $("#baocun")[0].disabled = false;
            } else {
                wait--;
                window.setTimeout("set_time('" + tip + "','" + wait + "')", 1000);
            }
        }
        function  show_error(tip, wait) {
            $(".error").html(tip);
            $(".error").fadeIn();
            set_time(tip, wait);
        }
        var url = "<?php echo $share['wapurl']?>";
        //设置分享的内容
        var jiathis_config = {
            imageWidth: 26,
            marginTop: 150,
            url: url,
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