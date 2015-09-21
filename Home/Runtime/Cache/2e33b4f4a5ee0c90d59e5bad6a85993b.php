<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-company.css">
        <link rel="stylesheet" type="text/css" href="/Public/new-css/reset.css">
        <script type="text/javascript" src="/Public/new-js/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/zepto.min.js"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="format-detection" content="telephone=no,email=no"/>
        <meta name="full-screen" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    </head>
    <body>
    <header class="rec_hd">	
    <span class="l" onclick="history.go(-1);"></span>
    <ul class="hd_li" style='background: url() no-repeat right 20px;'>
        <li><?php echo ($header_title); ?></li>
    </ul>
     <label class="r2" id="savebtn">保存</label> 
</header>
<span style="display:none;"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></span>
<script>
    $(document).ready(function(){
        $('.hd_li>li').click(function(){
            $('.hd_ul').toggle(100);
            $('.b').toggle(100);
            $('.b').css('display','block');
        });
        $('.hd_ul li').click(function(){
            $(this).addClass('m').siblings().removeClass('m');
        });
        $('.rec_hd label').click(function(){
            if($(this).hasClass("current")){
                $('.nav').slideUp();
                $(this).removeClass('m')
                $(this).removeClass("current");
            }else{
                $('.nav').slideDown();
                $(this).addClass('m')
                $(this).addClass("current");
            }
           
        })
    })
</script>
    <p class="error"></p>
    <div class="wrap">
        <form action="/index.php?s=/Company/complete_info" method="post">
            <section class="content m-content1" style="padding-bottom:20px;display:block">
                <div class="com-list">
                    <div class="">
                        <div class="list"><em class="" style="width:100%;">小提示:更换后，下次可使用新手机号码登录</em></div>
                    </div>
                    <div class="">
                        <div class="list" id="com-nature"><em class="wh90">当前手机号码 :</em><span class="wh100 cl2"><?php echo $data['mobile']?></span></div>
                    </div>
                    <div class="bd">
                        <div class="list" id="com-size"><em class="wh90">新手机号码：</em><input class="wh100" type="text" autofocus="autofocus" id="mobile" name="mobile" value="<?php echo $_SESSION['com_change_mobile']?>"></div>
                    </div>

                    <div class="bd">
                        <div class="list" id="com-size"><em style="width:50px;">验证码：</em><input class="wh100" type="text" id="verify"><span class="hqyzm" id="getcode">免费获取验证码</span></div>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $data['cpname']?>" name="cpname" />
                <input type="hidden" value="<?php echo $data['nature']?>" name="nature" />
                <input type="hidden" value="<?php echo $data['scale']?>" name="scale" />
                <input type="hidden" value="<?php echo $data['stage']?>" name="stage" />
                <input type="hidden" value="<?php echo $data['brightregdata']?>" name="brightregdata" />
                <input type="hidden" value="<?php echo $data['webname']?>" name="webname" />
                <input type="hidden" value="<?php echo $data['intro']?>" name="intro" />
                <input type="hidden" value="<?php echo $data['bright']?>" name="bright" />
                <input type="hidden" value="<?php echo $data['address']?>" name="address" />
                <input type="hidden" value="<?php echo $data['cnname']?>" name="cnname" />
                <input type="hidden" value="<?php echo $data['telephone']?>" name="telephone" />
                <input type="hidden" value="<?php echo $data['email']?>" name="email" />
                <input type="hidden" value="<?php echo $data['id']?>" name="id" />

        </form>
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

    })

    //获取验证码
    var wait = 60;
    $("#getcode").disabled = false;
    function time(o) {

        if (wait == 0) {
            o.innerHTML = "免费获取验证码";
            o.removeAttribute("disabled", false);
            $('#getcode').css("background", "#206daf");
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
    $('#getcode').click(function () {

        $('#getcode')[0].disabled = true;
        $('#getcode').css("background", "#b4b4b4");

        var o = this;

        if (!/^[0-9]{11}$/.test($('#mobile').val()) || $('#mobile').val() == '') {
            $('#getcode')[0].disabled = false;
            $('#getcode').css("background", "#206daf");
            show_error("手机号不符合规则", 3);
            return;
        } else {
            var hash = "<?php $_SESSION['cookie']=time();echo md5('rrl_'.$_SESSION['cookie']);?>";
            var mobile = $("#mobile").val();
            $.post("/index.php?s=/Companycenter/check_mobile", {
                'mobile': mobile,
                'type': '1',
                'hash': hash
            }, function (data) {
                if (data.code != "200") {
                    $('#getcode')[0].disabled = false;
                    $('#getcode').css("background", "#206daf");
                    show_error(data.msg, 3);
                    return;
                } else {
                    time(o);
                }
            }, "json");
        }

    })
    $("#savebtn").click(function () {
        $("#savebtn").hide();
        var mobile = $("#mobile").val();
        var verify = $("#verify").val();
        if (mobile == "" || mobile.length != 11 || isNaN(mobile)) {
            show_error("请正确输入手机号", 3);
            return;
        } else if (!verify) {
            show_error("请输入验证码!", 3);
            return;
        } else {
            $.post("/index.php?s=/Companycenter/checkVerify", {
                'verify': verify,
                'mobile': mobile,
                'type': '1'
            }, function (data) {

                if (data.code != "200") {
                    show_error(data.msg,3);
                    return;
                } else {

                    $("form")[0].submit();
                    return;

                }
            }, "json");


        }
    })

    function set_time(tip, wait) {
        if (wait == 0) {
            $(".error").html("");
            $(".error").fadeOut();
            $("#savebtn").show();
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
</script>
</body>
</html>