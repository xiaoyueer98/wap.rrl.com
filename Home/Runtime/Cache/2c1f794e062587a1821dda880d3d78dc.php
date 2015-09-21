<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎注册</title>
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/iscroll.js"></script>
        <link rel="stylesheet"  href="/Public/css/reset.css">
        <link rel="stylesheet"  href="/Public/css/wechat.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <script type="text/javascript">
            document.addEventListener("touchmove", function (e) {
                e.preventDefault();
            }, false);
            $(document).ready(function (e) {
                    var myScroll = new IScroll('#wamp', {mouseWheel: true, click: true});
            })
        </script>
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
    <div id="container">
        <header>
    <div class="leftarw" onclick="history.go(-1);"></div>
    人人猎注册
    <span class="r_index" onclick="location.href = '/index.php'"></span>
</header>
<span style="display:none;"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></span>
        <section id="wamp">
            <div class="scroll">
                <div class="center" style="height:330px;">
                    <ul>
                        <li><span>输入验证码</span></li>
                        <li><input class="txt" type="text" id='verify'></li>
                        <li style="position:relative;height:35px;"><button class="btn_yz" id='getcode'>获取验证码</button></li>
                        <li><span>用户名<label style='font-size:14px;color:#626262;'>(数字、字母、下划线3-16位)<label></span></li>
                        <li><input class="txt" type="text" id='username'></li>
                        <li><span>密&nbsp&nbsp&nbsp码</span></li>
                        <li><input class="txt" type="password" id='password' onclick = "this.focus();" ></li>
                        <li><button class="btn_zh" id='reg_btn'>完成注册</button></li>
                    </ul>
                </div>
            </div>
        </section>
       <!-- <footer>
    <h3><a href='/index.php' style='color:#fff;margin-right:10px;'>人人猎</a><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></h3>
    <p><span>TEL:010-57188076</span>&nbsp&nbsp&nbsp <span>京ICP备14040265号</span></p>
</footer> -->
    </div>
    <script type="text/javascript">
        
        var wait = 60;
        $(function(){
            $('#getcode')[0].disabled = true;
            $('#getcode').css("background", "#b4b4b4");
            time($('#getcode')[0]);

        })
        function time(o) {

            if (wait == 0) {
                o.innerHTML = "获取验证码";
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
            
            var hash = "<?php $_SESSION['cookie']=time();echo md5('rrl_'.$_SESSION['cookie']);?>";
            
            $.post("/index.php?s=/Reg/check_mobile", {
                'type': '2',
                'hash':hash
            }, function (data) {
                if (data.code != "200") {
                    $('#getcode')[0].disabled = false;
                    $('#getcode').css("background", "#206daf");
                    like_alert(data.msg);
                    return;
                } else {
                    time(o);
                }
            }, "json");


        })

        $("#reg_btn").click(function () {

            $("#reg_btn")[0].disabled = true;

            var password = $("#password").val();
            var username = $("#username").val();
            var verify = $("#verify").val();

            if (!verify) {
                $("#reg_btn")[0].disabled = false;
                like_alert("请输入验证码!");
                return;
            } else if (!username || !/^[\@A-Za-z0-9\_]{3,16}$/.test(username) || username.indexOf("qq_") === 0 || username.indexOf("sina_") === 0 || username.indexOf("wx_") === 0 || username.indexOf("renren_") === 0) {
                $("#reg_btn")[0].disabled = false;
                like_alert("用户名由3-16位字母、下划线、数字组成!");
                return;
            } else if (!password || !/^[\@A-Za-z0-9\_]{6,15}$/.test(password)) {
                $("#reg_btn")[0].disabled = false;
                like_alert("请输入6-15位字母,数字,下划线!");
                return;
            } else {
                $.post("/index.php?s=/Reg/checkVerify", {
                    'verify': verify,
                    'type': '2'
                }, function (data) {

                    if (data.code != "200") {
                        $("#reg_btn")[0].disabled = false;
                        like_alert(data.msg);
                        return;
                    } else {
                        $.post("/index.php?s=/Reg/reg_save", {
                            'username': username,
                            'password': password
                        }, function (data) {

                            if (data.code == "200") {
                                location.href = "/index.php";
                            } else if(data.code == "300"){
                                //lo_like_alert("注册成功","?s=/Home/Webchat/new_job");
                                location.href = "/index.php";
                            }else{
                                $("#reg_btn")[0].disabled = false;
                                like_alert(data.msg);
                                return;
                            }
                        }, "json");
                    }
                }, "json");



            }
        })
    </script>        
</body>
</html>