<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-company.css">
        <link rel="stylesheet" type="text/css" href="/Public/new-css/reset.css">
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
    <form action="/index.php?s=/Company/updateAudstartStatus" method="post" id="form">
        <div style="padding-top:50px;">

            <textarea placeholder="请输入<?php echo ($data["desc"]); ?>的原因" name="reason" id="reason" class="textarea"></textarea>
            <input type="hidden" value='<?php echo ($data["recordid"]); ?>' name='recordid' />
            <input type="hidden" value="<?php echo $data['audstartid']?>" name="audstartid" />
            <input type="hidden" value="<?php echo $data['id']?>" name="id" />
            <input type="hidden" value="2" name="type" />
        </div>
    </form>
    <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
    <script>
        $("#savebtn").click(function () {
            $("#savebtn").hide();
            var value = $(".textarea").val();
            if (value == "") {
                show_error("请正确输入<?php echo $header_title ?>的原因", 3);
                return;
            } else {
                $("form")[0].submit();
                return;

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