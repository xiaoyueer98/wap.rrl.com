<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎登录</title>
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
    人人猎登录
    <span class="r_index" onclick="location.href = '/index.php'"></span>
</header>
<span style="display:none;"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></span>
        <section id="wamp">
            <div style="width:100%;height:500px;">
                <div class="center" >
                    <ul style="padding-bottom:0">
                        <li><span>用户名/手机号</span></li>
                        <li><input class="txt" type="text" name='username'></li>
                        <li><span>密&nbsp&nbsp&nbsp码</span></li>
                        <input type='hidden' value='<?php echo ($gourl); ?>' name='gourl' />
                        <li><input class="txt" type="password" name='password'></li>
                        <li><button class="btn_zh" id='loginbtn'>登&nbsp&nbsp&nbsp录</button></li>
                        <li style="height:25px;">
                            <p>
                                <a class="l" href="/index.php?s=/Reg/reg">免费注册</a>
                                <a class="r" href="/index.php?s=/Reg/forget_password">找回密码</a>
                            </p>
                        </li>
                        <li class="icon_land">
                            <p style="font-size:12px;">使用联合账号登录</p>
                        </li>
                        <li class="icon_land">
                            <p class="clearfix">
                                <a style="" href="/index.php?s=/Thirdlogin/login&type=qq"><img src="/Public/images/qq.png" alt=""></a>
                                <a href="/index.php?s=/Thirdlogin/login&type=sina"><img src="/Public/images/weibo.png" alt=""></a>
                                <a style="" href="/index.php?s=/Thirdlogin/login&type=renren"><img src="/Public/images/renren.png" alt=""></a>
                            </p>
                        </li>
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

        $("#span1").click(function () {
            location.href = '/index.php?s=/Reg/reg';
        })
        $("#span2").click(function () {
            location.href = '/index.php?s=/Reg/forget_password';
        })
        var error = "";
        function  checkIsEmpty(name, tip) {

            var val = $("[name='" + name + "']").val();
            if (val == "") {
                error += tip + "不能为空\n";
                return false;
            } else {
                return true;
            }
        }
        function  checkIsLawful(name, tip) {
            var val = $("[name='" + name + "']").val();
            if (val == "") {
                error += tip + "不能为空\n";
                return false;
            } else {
                return true;
            }

        }
        $("#loginbtn").click(function () {

            $("#loginbtn")[0].disabled = true;
            var re1 = checkIsEmpty('username', "用户名");
            var re2 = checkIsEmpty('password', "密码");
            var username = $("[name='username']").val();

            var type = 1;  //定义一个登陆类型1用户名2手机号
            if (/^((13[0-9])|147|(15[0-35-9])|180|182|(18[5-9]))[0-9]{8}$/.test(username)) {
                type = 2;
            }
           
            var password = $("[name='password']").val();
            if (re1 && re2) {
                var url = $("[name='gourl']").val();
                $.ajax({
                    type: "post",
                    data: {"username": username, "password": password,"type":type},
                    url: "/index.php?s=/Login/judge_login",
                    dataType: "json",
                    success: function (data)
                    {       //alert(data.code);
                        if (data.code == "200")
                        {
                            location.href = url;
                        }
                        else if (data.code == "500")
                        {
                            $("#loginbtn")[0].disabled = false;
                            like_alert(data.msg);
                            error = "";
                            return;
                        } else {
                            $("#loginbtn")[0].disabled = false;
                            like_alert("登陆异常");
                            error = "";
                            return;
                        }
                    }

                })
            } else {

                $("#loginbtn")[0].disabled = false;
                like_alert(error);
                error = "";
                return;
            }
        })
    </script>

</body>
</html>