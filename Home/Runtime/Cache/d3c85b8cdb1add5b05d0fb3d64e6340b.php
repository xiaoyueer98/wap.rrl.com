<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎-私人订制工作机会</title>
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-company.css">
        <link rel="stylesheet" type="text/css" href="/Public/new-css/reset.css">
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-recommende.css"/>   
        <script type="text/javascript" src="/Public/new-js/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/zepto.min.js"></script>
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="format-detection" content="telephone=no,email=no"/>
        <meta name="full-screen" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      
        <style>
             .com-list input{
                background: #dff1ff;
            }
            
            
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
        <div class="mask" style="display:none"></div>
        <div class="com-alt srdz-alt" style="display:none">
            <a href="javascript:void(0);" class="clos" id="close"></a>
            <div class="srdz-head">
                温馨提示
            </div>
            <div class="srdz-con">
                <p>您成功完成了工作机会——私人订制，请您在设定的联系时间内，保持手机畅通，一旦有合适的工作机会，您的私人求职顾问将会与您联络。</p>
            </div>
            <span class="btn" style="margin-top:10px;" id="ok_btn">确定</span>
        </div>
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
            <div class="srdz-banner"><img src="/Public/new-images/srdz-banner.png" alt=""></div>
            <div class="srdz-text">
                
                <p class="tx1">若你是年薪10万元以上的中高端人才，若你想收入更高、发展前程更好。若你希望你足不出户就有“高大上”的工作机会找上门。你最可靠的私人求职顾问--人人猎，帮你<b>“私人订制”</b>。人人猎,让与你匹配的工作机会轻松找到你。</p>            
                <p>1.你只需将你正在看更好工作机会的计划，通过在线填写“订制卡片”告诉人人猎的资深顾问。</p>
                <p>2.人人猎免费帮你寻找与你最匹配的工作机会，并安排靠谱的面试机会。</p>
                <p>3.你无需接听骚扰电话、无需一次次向各企业重述你的个人信息，你只需参加2-3个靠谱的面试，从中选择最 适合你的优质工作机会。</p>
                <p>4.你入职以后，除可以领取<b>几千、几万</b>的自荐奖金外，你还会额外得到面试车补<b>1000元</b>。想想都很美吧！人人猎实现你的高薪工作梦+大额奖金+高额面试车补。</p>
                <p>马上参与， 请填写<b>工作机会私人订制卡片</b>，靠谱的工作机会就会自动找上门！</p>
            </div>
            <ul class="clearfix" style="margin-bottom:50px;margin-left:20px;">
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
            <div class="clearfix wxts">
                <span>温馨提示：</span>
                <i></i>
                <em>人人猎会对您的个人信息进行严格保密，绝不会非法透露给第三方</em>
            </div>
            <div style="background:#dff1ff;padding:10px 0">
                <div>
                    <span class="h3 dis-block">工作机会私人订制卡</span>
                </div>
                <div class="com-list">
                    <div class="bd3">
                        <div class="list"><em class="m">姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名：</em><input type="text" id="name" placeholder="输入真实姓名,系统会对个人信息保密"></div>
                    </div>
                    <div class="bd3">
                        <div class="list" id="com-size"><em class="m" style="width:60px;">手&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp机：</em><input style="width:70px!important" type="text" id="mobile" placeholder="请输入手机号码"><span class="hqyzm hqyzm2" id="getcode">免费获取验证码</span></div>
                    </div>
                    <div class="bd3">
                        <div class="list"><em class="m">验&nbsp&nbsp证&nbsp&nbsp码：</em><input type="text" id="verify"></div>
                    </div>
                    <div class="bd3">
                        <div class="list"><em class="m wh100">方便联系的时间：</em><input class="wh-55" type="text" id="able_time" placeholder="如：随时、周六日、其他指定时间"></div>
                    </div>
                    <div class="bd3">
                        <div class="list"><em class="m">求职意愿：</em><input type="text" id="want" placeholder="输入职位名称" ></div>
                    </div>
                </div>
            </div>
            <div>
                <span class="btn" id="btn">完成订制</span>
            </div>

        </section>
    </div>
    <script type="text/javascript">
        var wait = 60;
        function time(o) {
            if (wait == 0) {
                o.innerHTML = "获取验证码";
                o.removeAttribute("disabled", false);
//              $('#getcode').css("background", "#206daf");
                wait = 60;
            } else {
                o.setAttribute("disabled", true);
                o.innerHTML = "(" + wait + ")重新发送";
                wait--;
                setTimeout(function () {
                    time(o)
                },
                        1000)
            }
        }
        $(document).ready(function () {
            $("input").click(function () {
                if (document.activeElement.tagName == 'INPUT') {
                    $(".fixed").css({'position': 'absolute', 'top': '0'});
                } else if (document.activeElement.tagName !== 'INPUT') {
                    $(".fixed").css('position', 'fixed');
                }
            })
            $("#nav").hide();

            $('#getcode').click(function () {
                
                this.disabled = true;

                var o = this;
                var mobile = $("#mobile").val();
                if ($.trim(mobile) == "" || $.trim(mobile).length!=11) {
//                    $("#mobile").focus();
                    show_error("请填写正确的手机号码",3);
                    this.disabled = false;
                    return;
                }
//                $('#getcode').css("background", "#b4b4b4");
                var hash = "<?php $_SESSION['cookie']=time();echo md5('rrl_'.$_SESSION['cookie']);?>";
                $.post("/index.php?s=/Customized/send_msg", {
                    mobile: mobile,
                    hash:hash
                }, function (data) {
                    if (data.code != "200") {
                        $('#getcode')[0].disabled = false;
//                        $('#getcode').css("background", "#206daf");
                        show_error(data.msg,3);
                        return;
                    } else {
                        time(o);
                    }
                }, "json");
            })

            //点击完成定制按钮
            $('#btn').click(function () {

                this.disabled = true;
                var name = $.trim($("#name").val());
                var mobile = $.trim($("#mobile").val());
                var able_time = $("#able_time").val();
                var want = $("#want").val();
                var verify = $.trim($("#verify").val());
                if (name == "") {
                    show_error("请填写姓名",3);
                    this.disabled = false;
                    return;
                }
                if (mobile == "") {
                    show_error("请填写手机号码",3);
                    this.disabled = false;
                    return;
                }
                if (verify == "") {
                    show_error("请填写验证码",3);
                    this.disabled = false;
                    return;
                }
                if (able_time == "") {

                    show_error("请填写方便联系时间",3);
                    this.disabled = false;
                    return;
                }
                if (want == "") {

                    show_error("请填写求职意愿",3);
                    this.disabled = false;
                    return;
                }
                $.post("/index.php?s=/Customized/info_save", {
                    name: name,
                    mobile: mobile,
                    verify: verify,
                    able_time: able_time,
                    want: want

                }, function (data) {
                    if (data.code != "200") {
                        $('#btn')[0].disabled = false;
                        show_error(data.msg,3);
                        return;
                    } else {
                        $(".mask").show();
                        $(".srdz-alt").show();

                    }
                }, "json");


            })
            //点击取消
            $('#close,#ok_btn').click(function () {

                $(".mask").hide();
                $(".srdz-alt").hide();
                location.href="/";
            })

        })
        function set_time(tip, wait) {
            if (wait == 0) {

                $(".error").html("");
                $(".error").fadeOut();

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
        //document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
        
        var url = "<?php echo $domain.$share['wapurl']?>";
        //设置分享的内容
        var jiathis_config = {
            imageWidth: 26,
            marginTop: 150,
            url: url,
            title:"<?php echo $share['title']?>",
            summary: "<?php echo $share['desc']?>",
            pic: "<?php echo $share['img']?>"
        }

    </script>
    <script type="text/javascript" src="http://v3.jiathis.com/code/plugin.client.js" charset="utf-8"></script>
    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Public/js/test.js"></script>
</body>
</html>