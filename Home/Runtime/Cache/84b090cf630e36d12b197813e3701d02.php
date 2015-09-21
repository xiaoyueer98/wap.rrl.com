<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎-完善资料</title>
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-company.css">
        <link rel="stylesheet" type="text/css" href="/Public/new-css/reset.css">
        <script type="text/javascript" src="/Public/new-js/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/zepto.min.js"></script>
        <script type="text/javascript" src="/Public/new-js/jquery-1.11.0.min.js"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="format-detection" content="telephone=no,email=no"/>
        <meta name="full-screen" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    </head>
    <body>

        <div class="mask" style="display:none;"></div>
        <div class="com-alt com-size">
            <ul>
                <?php foreach($arScaleList as $v):?>
                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block"><?php echo $v['dataname'] ?></em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="<?php echo $v['datavalue']?>"></b>
                    </span>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="com-alt com-nature">
            <ul>
                <?php foreach($arNatureList as $v):?>
                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block"><?php echo $v['dataname'] ?></em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="<?php echo $v['datavalue']?>"></b>
                    </span>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="com-alt com-stage">
            <ul>
                <?php foreach($arStageList as $v):?>
                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block"><?php echo $v['dataname'] ?></em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="<?php echo $v['datavalue']?>"></b>
                    </span>
                </li>
                <?php endforeach;?>


            </ul>
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
   
    <label class="r"></label>
    
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
                $(this).removeClass('m')
                $(this).removeClass("current");
            } else {
                
                $('.nav').show();
                $(".head-nav").hide();
                $(this).addClass('m')
                $(this).addClass("current");
            }

        })
    })
</script>
    <ul class="head-nav" style='display:none;'>
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
                
                this.className = "";
            }
        })
    })
</script>
    <p class="error">对不起您填写的信息有误，请重新填写</p>
    <div class="wrap">
        <ul id="nav" class="nav" style='background:white;display:none;'>
    <li><a href="/index.php?s=/Company/complete_info"><span <?php if($select == 'info'): ?>class="sp0 sp0_2" <?php else: ?> class="sp0"<?php endif; ?>></span><b <?php if($select == 'info'): ?>class='m'<?php endif; ?>>完善资料</b></a></li>
    <li><a href="/index.php?s=/Company/agreement_status"><span <?php if($select == 'agreement'): ?>class="sp1 sp1_2" <?php else: ?> class="sp1"<?php endif; ?>></span><b <?php if($select == 'agreement'): ?>class='m'<?php endif; ?>>签订合同</b></a></li>
    <li><a href="/index.php?s=/Company/send_job"><span  <?php if($select == 'send_job'): ?>class="sp2 sp2_2" <?php else: ?>class="sp2"<?php endif; ?>></span><b <?php if($select == 'send_job'): ?>class='m'<?php endif; ?>>发布职位</b></a></li>
    <li><a href="/index.php?s=/Company/candidate"><span <?php if($select == 'candidate'): ?>class="sp3 sp3_2" <?php else: ?> class="sp3"<?php endif; ?>></span><b <?php if($select == 'candidate'): ?>class='m'<?php endif; ?>>查看候选人</b></a></li>
    <li><a href="/index.php?s=/Company/process_track"><span  <?php if($select == 'record'): ?>class="sp4 sp4_2" <?php else: ?>class="sp4"<?php endif; ?>></span><b <?php if($select == 'record'): ?>class='m'<?php endif; ?>>入职管理</b></a></li>
</ul>


        <form action="/index.php?s=/Company/text" method="post" id="form">
            <section class="content m-content1" style="padding-bottom:20px;display:block">
                <div>
                    <span class="h3 dis-block">公司信息</span>
                </div>
                <div class="com-list">
                    <div class="bd">
                        <div class="list"><em class="m">公司名称：</em><input type="text" name="cpname" value="<?php echo $result['cpname']?>"></div>
                    </div>
                    <div class="bd">
                        <div class="list m" id="com-nature"><em class="m">公司性质 :</em><span><?php echo $result['naturedata']?></span><input type='hidden' name='nature' value="<?php echo $result['nature']?>"></div>
                    </div>
                    <div class="bd">
                        <div class="list m" id="com-size"><em class="m">公司规模：</em><span><?php echo $result['scaledata']?></span><input type='hidden' name='scale' value="<?php echo $result['scale']?>"></div>
                    </div>
                    <div class="bd">
                        <div class="list m" id="com-stage"><em class="m">公司阶段：</em><span><?php echo $result['stagedata']?></span><input type='hidden' name='stage' value="<?php echo $result['stage']?>"></div>
                    </div>

                    <div class="bd">
                        <div class="list"><em class="m">成立日期：</em><input type="text" name="brightregdata" value="<?php echo $result['brightregdata']?>" placeholder="格式：2015-03-11"></div>
                    </div>

                    <div class="bd">
                        <div class="list"><em class="m">公司网址：</em><input type="text" name="webname" value="<?php echo $result['webname']?>"></div>
                    </div>
                </div>
                <div class="mr-tp20"  >
                    <span class="h3 dis-block">公司简介：</span>
                </div>
                <div class="com-list"id="intro" >
                    <div class="bd">
                        <div class="list m"><!--<em class="m wh30">请填写公司简介</em>--><span class="wh"><?php echo $result['intro']?><input type='hidden' name='intro' value="<?php echo $result['intro']?>"></span></div>
                    </div>
                </div>


                <div class="mr-tp20" >
                    <span class="h3 dis-block">公司亮点：</span>
                </div>

                <div class="com-list" id="bright">
                    <div class="bd">
                        <div class="list m"><!--<em class="m wh30">请填写公司亮点</em>--><span class="wh"><?php echo $result['bright']?><input type='hidden' name='bright' value="<?php echo $result['bright']?>"></span></div>
                    </div>
                </div>
                <div class="mr-tp20">
                    <span class="h3 dis-block">联系我们：</span>
                </div>
                <div class="com-list">
                    <div class="bd">
                        <div class="list"><em class="m">办公地址：</em><input type="text" name="address" value="<?php echo $result['address']?>"></div>
                    </div>
                    <div class="bd">
                        <div class="list"><em class="m">联&nbsp&nbsp系&nbsp&nbsp人 :</em><input name="cnname" type="text" value="<?php echo $result['cnname']?>"></div>
                    </div>
                    <div class="bd" onclick="check_mobile();">
                        <div class="list m"><em class="m">手&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp机：</em><span id='chan_mobile'><?php echo $_SESSION['com_change_mobile']?$_SESSION['com_change_mobile']:$result_old['mobile']?></span><input name="mobile" type="hidden" value="<?php echo $result_old['mobile']?>"></div>
                    </div>
                    <div class="bd">
                        <div class="list"><em class="">座&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp机：</em><input name="telephone" type="text" value="<?php echo $result['telephone']?>"></div>
                    </div>

                    <div class="bd">
                        <div class="list"><em class="m">邮&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp箱：</em><input name="email" type="text" value="<?php echo $result['email']?>"></div>
                    </div>
                    <input type="hidden" value="" name="desc">
                    <input type="hidden" value="" name="type">
                    <input type="hidden" value="<?php echo $result_old['id']?>" name="id">
                    <div><span class="btn hover-hand" id="baocun">保存</span></div>
                </div>
            </section>
        </form>
<!--        <section class="content m-content2" style="padding-bottom:30px;display: none">
            <div>
                <span class="h3 dis-block">公司信息</span>
            </div>
            <div class="com-list">
                <div class="bd">
                    <div class="list"><em class="m">公司名称：</em><span><?php echo $result_old['cpname']?></span></div>
                </div>
                <div class="bd">
                    <div class="list m"><em class="m">公司性质 :</em><span><?php echo $result_old['naturedata']?$result_old['naturedata']:"暂未填写" ?></span></div>
                </div>
                <div class="bd">
                    <div class="list m"><em class="m">公司规模：</em><span><?php echo $result_old['scaledata']?$result_old['scaledata']:"暂未填写" ?></span></div>
                </div>
                <div class="bd">
                    <div class="list m"><em class="m">公司阶段：</em><span><?php echo $result_old['stagedata']?$result_old['stagedata']:"暂未填写" ?></span></div>
                </div>

                <div class="bd">
                    <div class="list"><em class="m">成立日期：</em><span><?php echo $result_old['brightregdata']?$result_old['brightregdata']:"暂未填写" ?></span></div>
                </div>

                <div class="bd">
                    <div class="list"><em class="m">公司网址：</em><span><?php echo $result_old['webname']?$result_old['webname']:"暂未填写" ?></span></div>
                </div>
            </div>

            <div class="mr-tp20">
                <span class="h3 dis-block">公司简介：</span>
            </div>
            <div class="com-list">
                <div class="bd">
                    <div class="list m"><em class="m wh30">请填写公司简介</em><span class="wh"><?php echo $result_old['intro']?$result_old['intro']:"暂未填写" ?></span></div>
                </div>
            </div>

            <div class="mr-tp20">
                <span class="h3 dis-block">公司亮点：</span>
            </div>
            <div class="com-list">
                <div class="bd">
                    <div class="list m"><em class="m wh30">请填写公司亮点</em><span class="wh"><?php echo $result_old['bright']?$result_old['bright']:"暂未填写" ?></span></div>
                </div>
            </div>
            <div class="mr-tp20">
                <span class="h3 dis-block">联系我们：</span>
            </div>
            <div class="com-list">
                <div class="bd">
                    <div class="list"><em class="m">办公地址：</em><span><?php echo $result_old['address']?$result_old['address']:"暂未填写" ?></span></div>
                </div>
                <div class="bd">
                    <div class="list"><em class="m">联&nbsp&nbsp系&nbsp&nbsp人 :</em><span><?php echo $result_old['cnname']?$result_old['cnname']:"暂未填写" ?></span></div>
                </div>
                <div class="bd">
                    <div class="list m"><em class="m">手&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp机：</em><span><?php echo $result_old['mobile']?$result_old['mobile']:"暂未填写" ?></span></div>
                </div>
                <div class="bd">
                    <div class="list"><em class="">座&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp机：</em><span><?php echo $result_old['telephone']?$result_old['telephone']:"暂未填写" ?></span></div>
                </div>

                <div class="bd">
                    <div class="list"><em class="m">邮&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp箱：</em><span><?php echo $result_old['email']?$result_old['email']:"暂未填写" ?></span></div>
                </div>
                <div><span class="btn hover-hand" id="xiugai">修改</span></div>
            </div>
        </section>-->
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var myScroll = new IScroll('.com-size', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });
            var myScroll2 = new IScroll('.com-nature', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });
            var myScroll3 = new IScroll('.com-stage', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });

            $(".com-index .odiv").click(function () {
                $(this).addClass("m").siblings().removeClass("m");
            });

            $("#com-size").click(function () {
                $(".mask").show();
                $(".com-size").show();
                myScroll.refresh();
                $(".com-size li").click(function () {
                    $(this).find("em").addClass("m").next().addClass("m");
                    $(this).siblings().find("em").removeClass("m").next().removeClass("m");
                    var text = $(this).find("em").text();
                    var value = $(this).find("b input").val();
                    $("#com-size").find("span").text(text);
                    $("#com-size").find("input").val(value);
                    setTimeout(function () {
                        $(".com-size").hide();
                        $(".mask").hide();
                    }, 200)

                })
            });

            $("#com-nature").click(function () {
                $(".mask").show();
                $(".com-nature").show();
                myScroll2.refresh();
                $(".com-nature li").click(function () {
                    $(this).find("em").addClass("m").next().addClass("m");
                    $(this).siblings().find("em").removeClass("m").next().removeClass("m");
                    var text = $(this).find("em").text();
                    var value = $(this).find("b input").val();
                    $("#com-nature").find("span").text(text);
                    $("#com-nature").find("input").val(value);
                    setTimeout(function () {
                        $(".com-nature").hide();
                        $(".mask").hide();
                    }, 200)

                })
            });

            $("#com-stage").click(function () {
                $(".mask").show();
                $(".com-stage").show();
                myScroll3.refresh();
                $(".com-stage li").click(function () {
                    $(this).find("em").addClass("m").next().addClass("m");
                    $(this).siblings().find("em").removeClass("m").next().removeClass("m");
                    var text = $(this).find("em").text();
                    var value = $(this).find("b input").val();
                    $("#com-stage").find("span").text(text);
                    $("#com-stage").find("input").val(value);
                    setTimeout(function () {
                        $(".com-stage").hide();
                        $(".mask").hide();
                    }, 200)

                })
            });

            $("#baocun").click(function () {
                //保存修改信息
                $("#baocun")[0].disabled = true;
                var mobile = $("#chan_mobile").text();
                var cpname = $('[name="cpname"]').val();
                var nature = $('[name="nature"]').val();
                var scale = $('[name="scale"]').val();
                var stage = $('[name="stage"]').val();
                var brightregdata = $('[name="brightregdata"]').val();
                var webname = $('[name="webname"]').val();
                var intro = $('[name="intro"]').val();
                var bright = $('[name="bright"]').val();
                var address = $('[name="address"]').val();
                var cnname = $('[name="cnname"]').val();
                var telephone = $('[name="telephone"]').val();
                var email = $('[name="email"]').val();
                var id = $('[name="id"]').val();
                if (mobile == "" || cpname == "" || nature == "" || scale == "" || stage == "" || brightregdata == "" || webname == "" || intro == "" || bright == "" || address == "" || cnname == "" || telephone == "" || email == "") {
                    show_error("请完善简历信息",3);
                    $("#baocun")[0].disabled = false;
                    return;
                }
                 var reg = /^1[0-9]{10}$/;
                if (!reg.test(mobile)) {
                    show_error("请输入正确的手机号码",3);
                    $("#baocun")[0].disabled = false;
                    return;
                }
                var reg1 = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/;
                if (!reg1.test(email)) {
                    show_error("请输入正确的邮箱",3);
                    $("#baocun")[0].disabled = false;
                    return;
                }
                
                $.post("/index.php?s=/Company/complete_info_save", {
                    'mobile': mobile,
                    'cpname': cpname,
                    'nature': nature,
                    'scale': scale,
                    'stage': stage,
                    'brightregdata': brightregdata,
                    'webname': webname,
                    'intro': intro,
                    'bright': bright,
                    'address': address,
                    'cnname': cnname,
                    'telephone': telephone,
                    'email': email,
                    'id': id
                }, function (data) {

                    if (data.code != "200") {

                        show_error(data.msg,3);
                        $("#savebtn")[0].disabled = false;
                        return;

                    } else {
                        $('[name="mobile"]').val("");
                        $('[name="cpname"]').val("");
                        $('[name="nature"]').val("");
                        $('[name="scale"]').val("");
                        $('[name="stage"]').val("");
                        $('[name="brightregdata"]').val("");
                        $('[name="webname"]').val("");
                        $('[name="intro"]').val("");
                        $('[name="bright"]').val("");
                        $('[name="address"]').val("");
                        $('[name="cnname"]').val("");
                        $('[name="telephone"]').val("");
                        $('[name="email"]').val("");
                        $('[name="id"]').val("");
                        show_error("完善信息成功",3);
                        
                        $(".m-content1").hide();
                         $(".m-content2").show();
                        return;
                    }
                }, "json");

                
                
            });

            $("#xiugai").click(function () {
                $(".m-content1").show();
                $(".m-content2").hide();
            });



            $("input").click(function () {
                if (document.activeElement.tagName == 'INPUT') {
                    $(".fixed").css({'position': 'absolute', 'top': '0'});
                } else if (document.activeElement.tagName !== 'INPUT') {
                    $(".fixed").css('position', 'fixed');
                }
            })

        })

        $("#intro").click(function () {

            to_text("intro", "公司简介");
        })
        $("#bright").click(function () {

            to_text("bright", "公司亮点");
        })


        function  to_text(type, desc) {

            $("[name='type']").val(type);
            $("[name='desc']").val(desc);
            $("#form")[0].submit();

        }

        //填写手机号的验证
        function check_mobile() {
            var url = '/index.php?s=/Company/check_mobile';
            $("#form").attr("action", url);
            $("#form")[0].submit();

        }

        function set_time(tip, wait) {
            if (wait == 0) {
                if(tip == "完善信息成功"){
                    location.reload();
                }
                $(".error").html("");
                $(".error").fadeOut();
                $("#baocun")[0].disabled = false;
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