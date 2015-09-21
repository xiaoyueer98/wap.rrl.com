<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>人人猎</title>
	<link rel="stylesheet" type="text/css" href="/Public/new-css/reset.css"/>
	<link rel="stylesheet" type="text/css" href="/Public/new-css/new-recommende.css"/>    
    <script type="text/javascript" src="/Public/new-js/iscroll.js"></script>
    <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <script type="text/javascript">
    $(document).ready(function(){
                $('.nav').hide();
    		$(".gsjj-btn").click( function(){
	            $('.comp-text').slideDown();
	            $('.myh3-2').addClass("m");
	            $(".myh3").removeClass('m');
	            setTimeout(function(){
	            	 myScroll.refresh();
	            },500)
			} )
			$('.myh3-2').click( function(){
	            $('.comp-text').slideUp();
	            $('.myh3-2').removeClass("m");
	            $(".myh3").addClass('m');
	            setTimeout(function(){
	            	 myScroll.refresh();
	            },500)
			} )
			myScroll = new IScroll('#m', {
				click:true,
				scrollbars: true,
				mouseWheel: true,
				interactiveScrollbars: true,
				shrinkScrollbars: 'scale',
				fadeScrollbars: true
			});




			var list2 = $(".posi-nav li");
			var divs2 = $(".m-c>div");
			list2.on("click",function(){
				that = $(this);
				index = that.index();
				that.addClass("m").siblings().removeClass("m");
				$(this).find("a").addClass("m").parent("li").siblings().find("a").removeClass("m");
				divs2.eq(index).show().siblings("div").hide();
				setTimeout(function(){
	            	 myScroll.refresh();
	            },500)
			});
		
    })
    document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
    
    </script>
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
	<div class="wrap job-wrap" id="wamp">
		<div class="content">
			
			<div id="m" class="flex">
				<div class="scroll md-pawd salon-index" style="padding-bottom:60px;">
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

  
					<div style='margin-top:15px;'>
						<h3>最新预告</h3>
					</div>
					<ul>
						<li class="clearfix">
							<span class="dis-block fl-lef dis-inlin">时&nbsp&nbsp&nbsp间：</span>
							<em class="dis-block fl-lef dis-inlin"><?php echo ($arSalonActive["activetime"]); ?>。</em>
						</li>
						<li class="clearfix">
							<span class="dis-block fl-lef dis-inlin">标&nbsp&nbsp&nbsp题：</span>
							<em class="dis-block fl-lef dis-inlin"><?php echo ($arSalonActive["activename"]); ?>。</em>
						</li>
						<li class="clearfix">
							<span class="dis-block fl-lef dis-inlin">主&nbsp&nbsp&nbsp题：</span>
							<em class="dis-block fl-lef dis-inlin"><?php echo ($arSalonActive["theme"]); ?>。</em>
						</li>
						<li class="clearfix">
							<span class="dis-block fl-lef dis-inlin">电&nbsp&nbsp&nbsp话：</span>
							<em class="dis-block fl-lef dis-inlin">010-57188076</em>
						</li>
						<li class="clearfix">
							<span class="dis-block fl-lef dis-inlin">地&nbsp&nbsp&nbsp址：</span>
							<em class="dis-block fl-lef dis-inlin">海淀区西二旗辉煌国际二号楼2206<a href="/index.php?s=/Salon/salon_leader">(近距指引)</a></em>
						</li>
						
					</ul>
					<div style="background:#efefef;height:10px;border-bottom:1px #cdcdcd solid;margin-top:10px;"></div>
					<div style="margin:10px 0">
						<h3>报名表<em>(*必填项)</em></h3>
					</div>

					<ul>
						<div class="bd">
							<li class="clearfix">
								<span class="dis-block fl-lef dis-inlin m">姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名：</span>
								<input type="text"  id="name"> 
							</li>
						</div>
						
						<div class="bd">
							<li class="clearfix">
								<span class="dis-block fl-lef dis-inlin">用户名：</span>
								<input type="text" id="username"> 
							</li>
						</div>
                                                <div class="bd">
							<li class="clearfix">
								<span class="dis-block fl-lef dis-inlin">公&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp司：</span>
								<input type="text" id="company"> 
							</li>
						</div>

						<div class="bd">
							<li class="clearfix">
								<span class="dis-block fl-lef dis-inlin" >职&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp位：</span>
								<input type="text" id="jobposition"> 
							</li>
						</div>
						
						<div class="bd">
							<li class="clearfix">
								<span class="dis-block fl-lef dis-inlin m">手机号码：</span>
								<input type="text"  id="mobile"> 
							</li>
						</div>

						<div class="bd">
							<li class="clearfix">
								<span class="dis-block fl-lef dis-inlin">Q&nbspQ号码：</span>
								<input type="text"  id="qq"> 
							</li>
						</div>

						<div class="bd">
							<li class="clearfix">
								<span class="dis-block fl-lef dis-inlin">微信号码：</span>
								<input type="text"  id="weixin"> 
							</li>
						</div>
						<div class="bd">
							<p>感兴趣的话题</p>
							<textarea placeholder="请输入感兴趣的话题" name="personal" id="topic"></textarea>
						</div>

						<div class="">
							<p>建议（对人人猎）</p>
							<textarea placeholder="请输入对人人猎的建议" name="personal" id="advice"></textarea>
						</div>
					</ul>
                                         <div style="height:20px;"></div>
					<span class="btn" id="salonBtn">确认</span>
                                        <span class="btn" id="salonBtn_no" style="display:none">确认</span>
				</div>
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
        <script>
        $(document).ready(function () {
            
            
            $("#salonBtn").click(function () {
                alert(11);
                $("#salonBtn").hide();
                $("#salonBtn_no").show();
                
                var name = $("#name").val();
                var username = $("#username").val();
                var mobile = $("#mobile").val();
                var jobposition = $("#jobposition").val();
                var company = $("#company").val();
                var qq = $("#qq").val();
                var weixin = $("#weixin").val();
                var topic = $("#topic").val();
                var advice = $("#advice").val();
               
                if ($.trim(name) == "") {
                    $("#salonBtn").show();
                    $("#salonBtn_no").hide();
                    like_alert("请填写姓名");
                    return;
                }
                if ($.trim(mobile) == "") {
                    $("#salonBtn").show();
                    $("#salonBtn_no").hide();
                    like_alert("请填写手机号码");
                    return;

                } else {
                    $.post("/index.php?s=/Salon/signup_repeat_judged", {
                        'mobile': mobile,
                    }, function (data) {

                        if (data.code != "200") {
                            $("#salonBtn").show();
                            $("#salonBtn_no").hide();
                            like_alert(data.msg);
                            return;
                        } else {
                            var hash = "<?php $_SESSION['cookie']=time();echo md5('rrl_'.$_SESSION['cookie']);?>";
                            $.post("/index.php?s=/Salon/sign_up_save", {
                                'name': name,
                                'username': username,
                                'mobile': mobile,
                                'jobposition': jobposition,
                                'company': company,
                                'qq': qq,
                                'weixin': weixin,
                                'topic': topic,
                                'advice': advice,
                                'hash': hash,
                            }, function (data) {

                                if (data.code != "200") {
                                    $("#salonBtn").show();
                                    $("#salonBtn_no").hide();
                                    like_alert(data.msg);
                                    return;
                                } else {
                                    lo_like_alert(data.msg,"/index.php?s=/Salon/salon_list");
                                    return;
                                }
                            }, "json");
                        }
                    }, "json");

                }
            })

        })
        </script>
</body>
</html>