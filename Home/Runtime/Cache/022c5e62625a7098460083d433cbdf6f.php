<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎线下活动注册</title>
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <!--<script type="text/javascript" src="/Public/js/iscroll.js"></script>-->
        <link rel="stylesheet"  href="/Public/css/reset.css">
        <link rel="stylesheet"  href="/Public/css/wechat.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <script type="text/javascript">
//            document.addEventListener("touchmove", function (e) {
//                e.preventDefault();
//            }, false);
//            $(document).ready(function (e) {
//                var myScroll = new IScroll('#wamp', {mouseWheel: true, click: false});
//            })
        </script>
        <style>
            section{padding-top: 0;margin-top: 0;}
        </style>
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
        <header style="color:green;background:white;height:30px;"><b>→上传简历，坐等分钱</b></header>
        <!--<div style="margin-top: 20px;text-align: center;font-size:16px;color:green;"><b><span style="font-size:20px;">→</span>上传简历，坐等分钱</b></div>-->
        <section id="wamp">
            <div class="scroll">
                <div class="center">
                    <ul>
                        <li><span>手机号</span></li>
                        <li><input class="txt" type="text" id="mobile"></li>
                        <li style="position:relative;height:35px;"><button class="btn_yz" id="getcode" style="width:135px;">获取验证码</button></li>
                        <li><span>输入验证码</span></li>
                        <li><input class="txt" type="text" id="verify"></li>
                        <li style="margin-top:10px;"><span>姓名</span></li>
                        <li><input class="txt" type="text" id="name"></li>
                        <li style="margin-top:10px;"><span>密码</span></li>
                        <li><input class="txt" type="password" id="password"></li>
                        <li style="margin-top:10px;"><span>岗位类别</span></li>
                        <li style="margin-bottom: 50px;"><span>
                                <select id="industry" style="width:100%;height:40px;">
                                    <option value="">岗位类别</option>
                                    <option value="1">HR</option>
                                    <option value="2">技术</option>
                                    <option value="3">其他</option>
                                </select>
                                <!--                                <input name="industry" type="radio" value="1" />HR
                                                                <input name="industry" type="radio" value="2" style="margin-left:30px;"/>技术
                                                                <input name="industry" type="radio" value="3" style="margin-left:30px;"/>其他-->
                            </span></li>

                        <li><button class="btn_zh" id="reg_btn">完成注册</button></li>
                    </ul>
                </div>
            </div>
        </section>

    </div>
    
    <include file="Public:statistics">
        <script type="text/javascript">
            
            $("#reg_btn").attr("disabled",  false);
            var wait = 60;
            $("#getcode").disabled = false;
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

                if (!/^[0-9]{11}$/.test($('#mobile').val()) || $('#mobile').val() == '') {
                    $('#getcode')[0].disabled = false;
                    $('#getcode').css("background", "#206daf");
                    like_alert("手机号不符合规则");
                    return;
                } else {
                    var hash = "<?php $_SESSION['cookie']=time();echo md5('rrl_'.$_SESSION['cookie']);?>";
                    
                    var mobile = $("#mobile").val();
                    $.post("/index.php?s=/Reg/check_mobile", {
                        'mobile': mobile,
                        'type': '3',
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
                }

            })

            $("#reg_btn").click(function () {
             
                $("#reg_btn").attr("disabled",  "disabled");
               // $("#reg_btn")[0].disabled = true;

                var mobile = $("#mobile").val();
                var verify = $("#verify").val();
                var name = $("#name").val();
                var password = $("#password").val();
//                var industry = $("input[name='industry']:checked").val();
                var industry = $("#industry").val();

                if (!/^[0-9]{11}$/.test($('#mobile').val()) || $('#mobile').val() == '') {
                    like_alert("手机号不符合规则");
                    $("#reg_btn").attr("disabled",  false);
                    return;
                } else if (!verify) {
                    like_alert("请输入验证码!");
                    $("#reg_btn").attr("disabled",  false);
                    return;
                } else if ($.trim(name) == "") {
                    like_alert("姓名不能为空");
                    $("#reg_btn").attr("disabled",  false);
                    return;
                }else if (!password || !/^[\@A-Za-z0-9\_]{6,15}$/.test(password)) {
                    like_alert("请输入6-15位字母,数字,下划线!");
                    $("#reg_btn").attr("disabled",  false);
                    return;
                }
                else if ($.trim(industry) == "") {
                    like_alert("请选择所属行业");
                    $("#reg_btn").attr("disabled",  false);
                    return;
                }

                else {

                    $.post("/index.php?s=/Reg/checkVerify", {
                        'verify': verify,
                        'mobile': mobile,
                        'type': '2'
                    }, function (data) {

                        if (data.code != "200") {
                            like_alert(data.msg);
                            $("#reg_btn").attr("disabled",  false);
                            return;
                        } else {
                            $.post("/index.php?s=/Reg/reg_active_save", {
                                'mobile': mobile,
                                'name': name,
                                'password': password,
                                'industry': industry,
                            }, function (data) {

                                if (data.code == "200") {
                                    //location.href = "/index.php";
                                    lo_like_alert("注册成功，账号信息已发送至您的手机。", "/index.php");
                                    return;
                                } else if (data.code == "300") {
                                    $("#reg_btn").attr("disabled",  false);
                                    lo_like_alert(data.msg, "/index.php");
                                    return;
                                } else {
                                    like_alert(data.msg);
                                    $("#reg_btn").attr("disabled",  false);
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