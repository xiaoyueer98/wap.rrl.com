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
<div class="set_wrapper" id="re_wrapper" >
	<div id="scroller">
		<div id="pullDown" style="display:none">
			<span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新...</span>
		</div>
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

  
		<div class="con_modify thelist" id="thelist">
			<ul style="padding-top:10px">
				<h3>基本信息</h3>
                                <?php $username = $_SESSION['userinfo']['username']; if(substr($username,0,3) == "qq_"){ $username = $_COOKIE[$username]; $username = "qq_".str_replace("qq_","",$username); } ?>
				<li><span>用户名：</span><em style="width:62px;overflow:hidden;text-overflow: ellipsis;"><?php echo ($username); ?></em><span>真实姓名：</span><em><?php echo ($mArr["cnname"]); ?></em></li>
				<li><span class="sp">性&nbsp&nbsp&nbsp别：</span><span class="sp"><?php echo ($mArr["sex_r"]); ?></span></li>

				<li><span class="sp">年&nbsp&nbsp&nbsp龄：</span><span class="sp"><?php echo ($mArr["age"]); ?></span></li>
				<li><span class="sp">邮&nbsp&nbsp&nbsp箱：</span><span class="sp"><?php echo ($mArr["email"]); ?></span></li>
				<li><span class="sp">手&nbsp&nbsp&nbsp机：</span><span class="sp"><?php echo ($mArr["mobile"]); ?></span></li>
                                <li><span class="sp">q&nbsp&nbsp&nbspq：</span><span class="sp"><?php echo ($mArr["qqnum"]); ?></span></li>
				<li><span class="sp">微&nbsp&nbsp&nbsp信：</span><span class="sp"><?php echo ($mArr["weixin"]); ?></span></li>
			</ul>

			<ul>
				<li style="padding:0;padding-bottom:10px;"><button class="modify">修改</button></li>
			</ul>
		</div>

		<div class="end thelist">
			<ul style="padding-top:10px" class="jbxx">
				<h3>基本信息</h3>
				<li><span>用户名：</span><em style="width:62px;overflow:hidden;text-overflow: ellipsis;"><?php echo ($username); ?></em><span>真实姓名：</span><input type="text" class="name" value="<?php echo ($mArr["cnname"]); ?>" id="cnname"></li>
                                <li><span class="sp">性&nbsp&nbsp&nbsp别：</span>
                                    <span class="sp">男</span><?php if($mArr["sex"] == 0): ?><label  class="nan"  id="nan" ></label><?php else: ?><label  class="nan m"  id="nan" ></label><?php endif; ?>
                                    <span class="sp">女</span><?php if($mArr["sex"] == 1): ?><label  class="nan"  id="nv" ></label><?php else: ?><label  class="nan m"  id="nv" ></label><?php endif; ?>
                                </li>
                                <input type="hidden" value="0" id="sex">
				<li><span class="sp">年&nbsp&nbsp&nbsp龄：</span><input type="text" class="name" value="<?php echo ($mArr["age"]); ?>" id="age"></li>
				<li><span class="sp">邮&nbsp&nbsp&nbsp箱：</span><span><?php echo ($mArr["email"]); ?><span></li>
				<li><span class="sp">手&nbsp&nbsp&nbsp机：</span><span><?php echo ($mArr["mobile"]); ?><span></li>
                                <li><span class="sp">q&nbsp&nbsp&nbspq：</span><input type="text" value="<?php echo ($mArr["qqnum"]); ?>" id="qqnum"></li>
				<li><span class="sp">微&nbsp&nbsp&nbsp信：</span><input type="text" value="<?php echo ($mArr["weixin"]); ?>" id="wx"></li>
			</ul>
			<ul>
				<li style="padding:0;padding-bottom:10px;"><button class="modify end_btn" id="savebtn">完成</button></li>
			</ul>
		</div>
		<div id="pullUp" style="display:none;">
			<span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多...</span>
		</div>
		
	</div>
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
<!-- <footer>
    <h3><a href='/index.php' style='color:#fff;margin-right:10px;'>人人猎</a><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></h3>
    <p><span>TEL:010-57188076</span>&nbsp&nbsp&nbsp <span>京ICP备14040265号</span></p>
</footer> -->
<script>
document.addEventListener("touchmove", function (e) {
            e.preventDefault();
        }, false);
        $(document).ready(function () {

            $('.modify').click(function () {
                $('.con_modify').hide()
                $('.end').show()
            })
            $('.end_btn').click(function () {
                $('.con_modify').show()
                $('.end').hide()
            })
            var myScroll = new IScroll('#re_wrapper', {
                mouseWheel: true,
                disableMouse: true,
                disablePointer: true,
                click:true
});
        })
        
$("#nan").click(function(){
    
    if(this.className == "nan m"){
        
        $("#sex").val("0");
        $("#nv")[0].className ="nan m";
        this.className = "nan";
    }
})
$("#nv").click(function(){
    
    if(this.className == "nan m"){
        
        $("#sex").val("1");
        $("#nan")[0].className ="nan m";
        this.className = "nan";
       
    }
})
$("#savebtn").click(function(){
      $("#savebtn")[0].disabled = true;
      var cnname = $.trim($("#cnname").val());
      var sex = $.trim($("#sex").val());
      var age = $.trim($("#age").val());
      var wx = $.trim($("#wx").val());
      var qqnum = $.trim($("#qqnum").val());
    
      if(cnname == "" || age=="" ){
          like_alert("请完善修改信息");
          $("#savebtn")[0].disabled = false;
          return;
      }
      if(cnname == "<?php echo ($mArr["cnname"]); ?>" && sex=="<?php echo ($mArr["sex"]); ?>" && age=="<?php echo ($mArr["age"]); ?>" && wx =="<?php echo ($mArr["weixin"]); ?>" && qqnum =="<?php echo ($mArr["qqnum"]); ?>"){
          re_like_alert("保存成功");
          return;
      }
      $.post("/index.php?s=/Usercenter/myinfo_save", {
                'cnname': cnname,
                'sex': sex,
                'age': age,
                'wx': wx,
                'qqnum': qqnum
            }, function (data) {

                if (data.code != "200") {
                    
                    like_alert(data.msg);
                    $("#savebtn")[0].disabled = false;
                    return;
                    
                } else {
                    re_like_alert(data.msg);
                }
            }, "json");
})    
</script>
</body>
</html>