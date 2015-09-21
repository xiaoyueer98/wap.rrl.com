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
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
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
    <form action="/index.php?s=/Company/send_job" method="post" id="form">
        <div style="padding-top:50px;">

            <?php if($data["type"] == 'workdesc'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="workdesc" class="textarea"><?php echo ($data["workdesc"]); ?></textarea>
                <?php else: ?>
                <input type="hidden" value='<?php echo ($data["workdesc"]); ?>' name='workdesc' /><?php endif; ?>
            <?php if($data["type"] == 'content'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="content" class="textarea"><?php echo ($data["content"]); ?></textarea>
                <?php else: ?>
                <input type="hidden" value='<?php echo ($data["content"]); ?>' name='content' /><?php endif; ?>
            <input type="hidden" value="<?php echo $data['industry']?>" name="industry" /><input type="hidden" value="<?php echo $data['industrydata']?>" name="industrydata" />
            <input type="hidden" value="<?php echo $data['category']?>" name="category" /><input type="hidden" value="<?php echo $data['categorydata']?>" name="categorydata" />
            <input type="hidden" value="<?php echo $data['place']?>" name="place" />
            <input type="hidden" value="<?php echo $data['employ']?>" name="employ" />
            <input type="hidden" value="<?php echo $data['title']?>" name="title" />
            
            <input type="hidden" value="<?php echo $data['treatment']?>" name="treatment" /><input type="hidden" value="<?php echo $data['treatmentdata']?>" name="treatmentdata" />
            <input type="hidden" value="<?php echo $data['match_industry']?>" name="match_industry" /><input type="hidden" value="<?php echo $data['match_industrydata']?>" name="match_industrydata" />
            <input type="hidden" value="<?php echo $data['match_company']?>" name="match_company" /><input type="hidden" value="<?php echo $data['match_companydata']?>" name="match_companydata" />
            
            <input type="hidden" value="<?php echo $data['report_obj']?>" name="report_obj" />
            <input type="hidden" value="<?php echo $data['report_number']?>" name="report_number" />
            <input type="hidden" value="<?php echo $data['jobendtime']?>" name="jobendtime" />
            
            <input type="hidden" value="<?php echo $data['education']?>" name="education" /><input type="hidden" value="<?php echo $data['educationdata']?>" name="educationdata" />
            <input type="hidden" value="<?php echo $data['joblang']?>" name="joblang" /><input type="hidden" value="<?php echo $data['joblangdata']?>" name="joblangdata" />
            <input type="hidden" value="<?php echo $data['experience']?>" name="experience" /><input type="hidden" value="<?php echo $data['experiencedata']?>" name="experiencedata" />
            
            <input type="hidden" value="<?php echo $data['jobTariffed']?>" name="jobTariffed" />
            <input type="hidden" value="<?php echo $data['meth']?>" name="meth" />
            <input type="hidden" value="<?php echo $data['jobperson']?>" name="jobperson" />
            <input type="hidden" value="<?php echo $data['jobmobile']?>" name="jobmobile" />
        </div>
    </form>
    
    <script>
        $("#savebtn").click(function () {
            $("#savebtn").hide();
            var value = $(".textarea").val();
            if (value == "") {
                show_error("请正确输入<?php echo $header_title ?>", 3);
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