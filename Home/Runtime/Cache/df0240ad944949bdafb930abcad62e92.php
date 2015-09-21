<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <link rel="stylesheet"  href="/Public/css/reset.css">
        <link rel="stylesheet"  href="/Public/css/wep.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/iscroll.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black" name="apple-mobile-web-app-status-bar-style" />
        <meta content="telephone=no" name="format-detection" />
    </head>
    <body>
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
    <div class="set_wrapper" id="re_wrapper" style="background:#ffffff;" >
        <div id="scroller">
            <div id="pullDown" style="display:none">
                <span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新...</span>
            </div>
            <form action="/index.php?s=/Job/add_resume_new/jobid/<?php echo $_GET['jobid']?>" method="post" id="form">
                <?php if($data["type"] == 'username'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["username"]); ?></textarea>
                <?php else: ?>
                    <input type="hidden" value='<?php echo ($data["username"]); ?>' name='username' /><?php endif; ?>
                <?php if($data["type"] == 'sex'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["sex"]); ?></textarea>
                <?php else: ?>
                    <input type="hidden" value='<?php echo ($data["sex"]); ?>' name='sex' /><?php endif; ?>
                <?php if($data["type"] == 'age'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["age"]); ?></textarea>
                <?php else: ?>
                    <input type="hidden" value='<?php echo ($data["age"]); ?>' name='age' /><?php endif; ?>
                <?php if($data["type"] == 'email'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["email"]); ?></textarea>
                <?php else: ?>
                    <input type="hidden" value='<?php echo ($data["email"]); ?>' name='email' /><?php endif; ?>
                <?php if($data["type"] == 'qqnum'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["qqnum"]); ?></textarea>
                <?php else: ?>
                    <input type="hidden" value='<?php echo ($data["qqnum"]); ?>' name='qqnum' /><?php endif; ?>
                <?php if($data["type"] == 'state'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["state"]); ?></textarea>
                <?php else: ?>
                    <input type="hidden" value='<?php echo ($data["state"]); ?>' name='state' /><?php endif; ?>
                <?php if($data["type"] == 'edu'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["edu"]); ?></textarea>
                <?php else: ?>
                    <input type="hidden" value='<?php echo ($data["edu"]); ?>' name='edu' /><?php endif; ?>
                <?php if($data["type"] == 'exper'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["exper"]); ?></textarea>
                <?php else: ?>
                    <input type="hidden" value='<?php echo ($data["exper"]); ?>' name='exper' /><?php endif; ?>
                <?php if($data["type"] == 'zige'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["zige"]); ?></textarea>
                <?php else: ?>
                    <input type="hidden" value='<?php echo ($data["zige"]); ?>' name='zige' /><?php endif; ?>
                <?php if($data["type"] == 'because'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["because"]); ?></textarea>
                <?php else: ?>
                    <input type="hidden" value='<?php echo ($data["because"]); ?>' name='because' /><?php endif; ?>
                <?php if($data["type"] == 'mobile'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["mobile"]); ?></textarea>
                <?php else: ?>
                    <input type="hidden" value='<?php echo ($data["mobile"]); ?>' name='mobile' /><?php endif; ?>
                <?php if($data["type"] == 'keyword'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["keyword"]); ?></textarea>
                <?php else: ?>
                    <input type="hidden" value='<?php echo ($data["keyword"]); ?>' name='keyword' /><?php endif; ?>
                <?php if($data["type"] == 'personal'): ?><textarea placeholder="请输入<?php echo ($data["desc"]); ?>" name="<?php echo ($data["type"]); ?>" id="audstartdate"><?php echo ($data["personal"]); ?></textarea>
                <?php else: ?>
                    <input type="hidden" value='<?php echo ($data["personal"]); ?>' name='personal' /><?php endif; ?>

            </form>
            <div id="pullUp" style="display:none;">
                <span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多...</span>
            </div>

        </div>
    </div>
    <!-- <footer>
    <h3><a href='/index.php' style='color:#fff;margin-right:10px;'>人人猎</a><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></h3>
    <p><span>TEL:010-57188076</span>&nbsp&nbsp&nbsp <span>京ICP备14040265号</span></p>
</footer> -->
    <script>
        document.addEventListener("touchmove", function (e) {
            e.preventDefault();
        }, false);
        $(document).ready(function () {

            /*		$('.modify').click(function(){
             $('.con_modify').hide()
             $('.end').show()
             })
             $('.end_btn').click(function(){
             $('.con_modify').show()
             $('.end').hide()
             })
             */

            var myScroll = new IScroll('#re_wrapper', {mouseWheel: true, click: false});
        })


        $("#savebtn").click(function () {
            
            $("#form")[0].submit();
        })
        $('.jl ul li em').on('click', function () {
            $(this).hide();
            $(this).nextAll().show();
        })
    </script>
</body>
</html>