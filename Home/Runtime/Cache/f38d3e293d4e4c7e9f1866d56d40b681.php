<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-company.css">
        <link rel="stylesheet" type="text/css" href="/Public/new-css/reset.css">
        <script type="text/javascript" src="/Public/new-js/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/zepto.min.js"></script>
<!--        <script type="text/javascript" src="/Public/new-js/jquery-1.11.0.min.js"></script>-->
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="format-detection" content="telephone=no,email=no"/>
        <meta name="full-screen" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    </head>
    <body>
        <div class="mask" style="display:none"></div>
        <div class="com-alt rcmd-fee" style="display:none">
            <a href="javascript:void(0);" class="cold" id='close1'></a>
            <div class="text">
                <em>推荐费：</em>
                <span  style="display:inline-block;height:15px;"><input type="text" id='fee'><b>00</b></span>
                <i>元</i>
            </div>
            <p>温馨提示：增加推荐费，可以刺激推荐人的兴趣及动力，缩短招聘周期。推荐费只可以上调，不可以下调。</p>
            <input type="hidden" id="tariff_old" value="">
            <span class="btn2" style="" id='btn_sure1'>确定</span>
        </div>
        <div class="com-alt modify-fee" style="display:none">
            <a href="javascript:void(0);" class="cold" id='close2'></a>
            <div class="alt-head">增加招聘资费</div>
            <p>您确定修改此招聘的费用为<span id='is_fee'></span>元吗？</p>
            <input type='hidden' id='jobid' value=''>
            <button class="btn2" style="" id='btn_sure2'>确定</button>
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
    <p class="error" style="display:none"></p>
    <div class="wrap">
        <ul id="nav" class="nav" style='background:white;display:none;'>
    <li><a href="/index.php?s=/Company/complete_info"><span <?php if($select == 'info'): ?>class="sp0 sp0_2" <?php else: ?> class="sp0"<?php endif; ?>></span><b <?php if($select == 'info'): ?>class='m'<?php endif; ?>>完善资料</b></a></li>
    <li><a href="/index.php?s=/Company/agreement_status"><span <?php if($select == 'agreement'): ?>class="sp1 sp1_2" <?php else: ?> class="sp1"<?php endif; ?>></span><b <?php if($select == 'agreement'): ?>class='m'<?php endif; ?>>签订合同</b></a></li>
    <li><a href="/index.php?s=/Company/send_job"><span  <?php if($select == 'send_job'): ?>class="sp2 sp2_2" <?php else: ?>class="sp2"<?php endif; ?>></span><b <?php if($select == 'send_job'): ?>class='m'<?php endif; ?>>发布职位</b></a></li>
    <li><a href="/index.php?s=/Company/candidate"><span <?php if($select == 'candidate'): ?>class="sp3 sp3_2" <?php else: ?> class="sp3"<?php endif; ?>></span><b <?php if($select == 'candidate'): ?>class='m'<?php endif; ?>>查看候选人</b></a></li>
    <li><a href="/index.php?s=/Company/process_track"><span  <?php if($select == 'record'): ?>class="sp4 sp4_2" <?php else: ?>class="sp4"<?php endif; ?>></span><b <?php if($select == 'record'): ?>class='m'<?php endif; ?>>入职管理</b></a></li>
</ul>



        <section class="is-rct" style="padding-bottom:20px;display:block">
            <?php foreach($result as $v):?>
            <div class="con-rcmt bd clearfix">
                <div class="l rcmt-list">
                    <div class="div-list odiv1 clearfix">
                        <span class="fl-lef b"><a href='/index.php?s=/Companyabout/job_detail/id/<?php echo $v[id]?>'><?php echo $v['title']?></a></span>
                        <div class="fl-rig">
                            <span class="fl-lef">招聘资费：</span>
                            <span class="fl-lef">￥<?php echo $v['Tariff']?> <b onclick='addTariff("<?php echo $v[id] ?>","<?php echo $v[Tariff]?>");' ></b></span>
                        </div>
                    </div>
                    <div class="div-list odiv2 clearfix">
                        <span class="fl-lef">状态：<i><?php echo $v['status']?></i></span>
                    </div>
                    <div class="div-list odiv3 clearfix">
                        <span class="fl-lef">截止日期：</span>
                        <span class="fl-lef"><?php echo $v['endtime']?></span>
                        <div class="fl-rig dis-block">
                            <span class="fl-fl">推荐人数：</span>
                            <span class="fl-fl b"><?php echo $v['total']?></span>
                        </div>

                    </div>
                </div>
                <div class="r-delete" onclick='del_record("<?php echo $v[id] ?>")'>删除</div>
            </div>
            <?php endforeach;?>
         
        </section>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            /*$(".mask").click( function(){
             $(".com-alt").hide();
             $(".com-alt2").hide();
             $(".mask").hide();
             })
             */

            $(".is-rct .con-rcmt").swipeLeft(function () {
                $(this).find(".l").animate({
                    translate: '-77px,0'
                }, 200, 'ease-out', function () {
                    $(this).css({
                        '-webkit-transform': 'translate(-77px,0)'
                    });
                });
                $(this).find(".r-delete").animate({
                    translate: '0px,0'
                }, 200, 'ease-out', function () {
                    $(this).css({
                        '-webkit-transform': 'translate(0px,0)'
                    });
                });
                $(this).find(".r-delete").click(function () {
                    $(this).parent().remove();
                })
            });

            $(".is-rct .con-rcmt").swipeRight(function () {
                $(this).find(".l").animate({
                    translate: '0px,0'
                }, 200, 'ease-out', function () {
                    $(this).css({
                        '-webkit-transform': 'translate(0,0)'
                    });
                });
                $(this).find(".r-delete").animate({
                    translate: '77px,0'
                }, 200, 'ease-out', function () {
                    $(this).css({
                        '-webkit-transform': 'translate(77px,0)'
                    });
                });

            });
            $("#m-tre").click(function () {
                if ($("#m-tre").hasClass("current")) {
                    $(".m-phone").hide();
                    $(this).removeClass("current").removeClass("m");
                } else {
                    $(".m-phone").show();
                    $(this).addClass("current").addClass("m");
                }
            })

            $("input").click(function () {
                if (document.activeElement.tagName == 'INPUT') {
                    $(".fixed").css({'position': 'absolute', 'top': '0'});
                } else if (document.activeElement.tagName !== 'INPUT') {
                    $(".fixed").css('position', 'fixed');
                }
            })

        })
        function set_time(tip, wait) {
            if (wait == 0) {
                if(tip=="添加招聘资费成功"){
                    location.reload();
                }
                $(".error").html("");
                $(".error").fadeOut();
                
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
        /*
         * 删除招聘记录
         */
        function del_record(id) {
            
             $.post("/index.php?s=/Companyabout/del_record", {
                'id': id,
                
            }, function (data) {

                if (data.code != "200") {
                    show_error(data.msg, 3);
                    return;

                } else {
                    show_error("删除成功", 3);
                    return;
                }
            }, "json");
        }
        function addTariff(id,tariff_old) {
            $("#tariff_old").val(tariff_old);
            $(".mask").show();
            $(".rcmd-fee").show();
            $("#jobid").val(id);
            $("#fee").focus();
        }
        $("#close1").click(function () {
            $(".mask").hide();
            $(".rcmd-fee").hide();
            $("#fee").val("");
        })
        $("#close2").click(function () {
            $(".mask").hide();
            $(".modify-fee").hide();
            $("#fee").val("");
        })
        $("#btn_sure1").click(function () {
            this.disabled = true;
            var id = $("#jobid").val();
            var fee = $("#fee").val();
            if ($.trim(fee) == "") {
                this.disabled = false;
                show_error("招聘资费不能为空", 3);
                return;
            }
            var tariff_old = $("#tariff_old").val();
            if(fee*100<=tariff_old){
                this.disabled = false;
                show_error("招聘资费不能减少只能增加哦", 3);
                return;
            }
            this.disabled = false;
            $(".rcmd-fee").hide();
            $("#is_fee").text(fee*100);
            $(".modify-fee").show();
            
            
        })
        $("#btn_sure2").click(function(){
            this.disabled = true;
            var id = $("#jobid").val();
            var fee = $("#is_fee").text();
            $.post("/index.php?s=/Companyabout/add_tariff", {
                'id': id,
                'fee': fee,
                
            }, function (data) {

                if (data.code != "200") {
                    $("#btn_sure2")['0'].disabled = false;
                    show_error(data.msg, 3);
                    return;

                } else {
                    show_error("添加招聘资费成功", 3);
                    $(".mask").hide();
                    $(".modify-fee").hide();
                    return;
                }
            }, "json");
        })

    </script>
</body>
</html>