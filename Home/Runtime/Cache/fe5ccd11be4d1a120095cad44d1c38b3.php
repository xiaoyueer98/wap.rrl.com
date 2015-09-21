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
        <div class="com-alt srdz-alt" style="display:none">
            <a href="javascript:void(0);" class="clos" id="close"></a>
            <div class="srdz-head">
                温馨提示
            </div>
            <div class="srdz-con">
                <p>您成功创建了简历，请在pc端上传附件简历，在设定的联系时间内，保持手机畅通，人人猎会根据您的简历匹配合适的工作，并与您联络。</p>
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
                <div class="srdz-banner"><img src="/Public/new-images/srdz-banner2.png" alt=""></div>
                <div class="srdz-text">
                    <div class="clearfix">
                        <span class="dis-block bt"><b>1</b>上传简历</span>
                        <div class="clearfix"><span class="fl-lef ss"></span><em class="fl-lef">即日起， 凡在人人猎上传个人简历便可以参与“上传简历， 坐等收钱”活动；</em></div>
                        <span class="dis-block bt"><b>2</b>简历要求</span>
                        <div class="clearfix"><span class="fl-lef ss"></span><em class="fl-lef">在人人猎上传的个人简历要求同时满足 , 年薪10万以上的中高端互联网人才、正在看工作机会；</em></div>
                        <span class="dis-block bt"><b>3</b>系统匹配</span>
                        <div class="clearfix"><span class="fl-lef ss"></span><em class="fl-lef">人人猎系统自动检索与候选人匹配的工作机会 , 人人猎求职顾问与您沟通时先进行人工匹配合适职位 ;当有新发布的职位时，系统将为您自动匹配优质职位；</em></div>
                        <span class="dis-block bt"><b>4</b>面试入职</span>
                        <div class="clearfix"><span class="fl-lef ss"></span><em class="fl-lef">最多参加人人猎帮你安排的2-3次面试，即可offer,而且还可以拿到<b>几千、几万元</b>的推荐奖励。</em></div>
                        <span class="ms">还等什么，快快上传简历吧</span>
                    </div>
                </div>
                <div style="background:#dff1ff;padding:10px 0">
                    <div>
                        <span class="h3 dis-block">工作机会私人定制卡</span>
                    </div>
                    <div class="com-list">
                        <div class="bd3">
                            <div class="list"><em class="m">姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名：</em><input type="text" placeholder="请输入姓名，系统会对个人信息保密" id="name"></div>
                        </div>
                        <div class="bd3">
                            <div class="list" id="com-size">
                                <em class="m" style="width:60px;">手&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp机：</em>
                                <input style="width:70px!important" type="text" placeholder="请输入手机号码" id="mobile">
                                <span class="hqyzm hqyzm2" id="getcode">免费获取验证码</span>
                                <span class="hqyzm hqyzm2" style="display:none">免费获取验证码</span>
                            </div>
                        </div>
                        <div class="bd3">
                            <div class="list"><em class="m">验&nbsp&nbsp证&nbsp&nbsp码：</em><input type="text" placeholder="请输入验证码" id="verify"></div>
                        </div>
                        <div class="bd3">
                            <div class="list"><em class="m">上传简历：</em><span style="color:#2281b9;"><b>请在PC端上传附件简历</b></span></div>
                        </div>
                        <div class="bd3">
                            <div class="list"><em class="m">求职意向：</em><input class="wh-55" type="text" placeholder="请输入求职意向" id="want"></div>
                        </div>
                        <div class="bd3">
                            <div class="list"><em class="m wh100">方便联系的时间：</em><input class="wh-55" type="text" placeholder="请输入方便与您联系的时间" id="able_time"></div>
                        </div>
                        <div class="bd3">
                            <div class="list"><em class="m">其他说明：</em><input type="text" placeholder="请输入其他更多的要求" id="other"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <span class="btn" id="btn">确定</span>
                    <span class="btn" style="display:none">确定</span>
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
                $("#nav").hide();
            })
            $(document).ready(function () {

            var wait = 60;
            function time(o) {

                if (wait == 0) {
                    $("#getcode").show();
                    $("#getcode").next().hide();
                    wait = 60;
                } else {
                    o.innerHTML = "(" + wait + ")重新发送";
                    wait--;
                    setTimeout(function () {
                        time(o)
                    },
                            1000)
                }
            }
            $('#getcode').click(function () {

                //避免重复点击
                $(this).hide();
                $(this).next().show();

                var o = $(this).next()[0];
                var mobile = $("#mobile").val();
                if ($.trim(mobile) == "") {
                    $("#mobile").focus();
                    show_error("请填写手机号码",3);
                    $(this).show();
                    $(this).next().hide();
                    return;
                }
                if ($.trim(mobile).length != "11") {
                    $("#mobile").focus();
                    show_error("请填写正确的手机号码",3);
                    $(this).show();
                    $(this).next().hide();
                    return;
                }
                $.post("/index.php?s=/Upresume/send_msg", {
                    mobile: mobile
                }, function (data) {
                    if (data.code != "200") {
                        $('#getcode').show();
                        $('#getcode').next().hide();
                        show_error(data.msg,3);
                        return;
                    } else {
                        time(o);
                    }
                }, "json");

            })

            //点击完成定制按钮
            $('#btn').click(function () {

                //防止重复点击
                $(this).hide();
                $(this).next().show();

                var name = $.trim($("#name").val());
                var mobile = $.trim($("#mobile").val());
                var able_time = $("#able_time").val();
                var want = $("#want").val();
                var verify = $.trim($("#verify").val());
                var other = $.trim($("#other").val());

                if (name == "") {
                    show_error("请填写姓名",3);
                    $(this).show();
                    $(this).next().hide();
                    return;
                }
                if (mobile == "") {
                    
                    show_error("请填写手机号码",3);
                    $(this).show();
                    $(this).next().hide();
                    return;
                }
                if (verify == "") {
                   
                    show_error("请填写验证码",3);
                    $(this).show();
                    $(this).next().hide();
                    return;
                }
                if (want == "") {
                    
                    show_error("请填写求职意愿",3);
                    $(this).show();
                    $(this).next().hide();
                    return;
                }
                
                if (able_time == "") {
                    
                    show_error("请填写方便联系时间",3);
                    $(this).show();
                    $(this).next().hide();
                    return;
                }

                $.post("/index.php?s=/Upresume/info_save", {
                    name: name,
                    mobile: mobile,
                    verify: verify,
                    able_time: able_time,
                    other: other,
                    want: want

                }, function (data) {
                    if (data.code != "200") {
                        $('#btn').show();
                        $('#btn').next().hide();
                        show_error(data.msg,3);
                        return;
                    } else {
                        $(".mask").show();
                        $(".srdz-alt").show();

                    }
                }, "json");


            })
            //点击取消
            $('#close,#ok_btn,#close_x').click(function () {

                $(".mask").hide();
                $(".srdz-alt").hide();
                location.href = "/";
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
        </script>
    </body>
</html>