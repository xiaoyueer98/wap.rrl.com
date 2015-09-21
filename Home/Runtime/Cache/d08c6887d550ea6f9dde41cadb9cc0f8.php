<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎-推荐记录</title>
        <link rel="stylesheet" type="text/css" href="/Public/new-css/new-company.css">
        <link rel="stylesheet" type="text/css" href="/Public/new-css/reset.css">
        <script type="text/javascript" src="/Public/new-js/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/zepto.min.js"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="format-detection" content="telephone=no,email=no"/>
        <meta name="full-screen" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

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
                width: 100px;
                height: 30px;
                background: #2380b8;
                border-radius: 5px;
                border:none;
                color: #ffffff;
                margin-top:10px;
                margin-right:10px;
            }  
        </style>
    </head>
    <body>
        <div class="mask" style="display:none"></div>
        <div style="display:none;" id="like_alert_kuang">
            <div class="mask"></div>
            <div class="tanchu">
                <dl>
                    <dd id="alert_title">确定修改面试状态为<span id="desc"></span></dd>
                    <input type="hidden" id="recordid" value="">
                    <input type="hidden" id="audstartid" value="">
                    <dd><button id="alert_ok">确定</button><button id="alert_cancel">取消</button></dd>
                </dl>
            </div>
        </div>
        
        <!--企业填写确切面试时间-->
        <div style="display:none;" id="time_kuang">
            <div class="mask"></div>
            <div class="tanchu"  style="height:150px;">
                <dl>
                    <dd id="alert_title">请填写预约面试时间</dd>
                    <textarea style='height:50px;width:100%;' id="candidate_time"></textarea>
                    <input type="hidden" id="time_recid" value="">
                    <dd><button id="time_ok">确定</button><button id="time_cancel">取消</button></dd>
                </dl>
            </div>
        </div>
        <div class="com-alt com-dqzt" style="display:none">
            <ul class="r-jt">
                <?php foreach($arInfo['arAudreasonList'] as $k=>$v):?>
                <?php if ($v['datavalue'] == 2 || $v['datavalue'] == 4 || $v['datavalue'] == 7 || $v['datavalue'] == 8):?>
                <li class="bd m list">
                        <span>
                            <em class="fl-lef dis-block"><?php echo $v['dataname']?></em> 
                            <input type='hidden' value="<?php echo $v['datavalue']?>">
                        </span>
                </li>
                <?php else:?>
                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block"><?php echo $v['dataname']?></em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="<?php echo $v['datavalue']?>"></b>
                    </span>
                </li>
                <?php endif;?>
                <?php endforeach;?>

            </ul>
        </div>

        <div class="short-message">
            <div class="sm-head">
                <span class="l">发送短信</span>
                <span class="r"></span>
            </div>
            <div class="sm-con clearfix">
                <p><span>亲爱的</span><input class="input1" type="text" value="" id="x_name"><span>同学，我们诚挚邀请你于<input class="input2" type="text" value="XXXX" id="x_time">，<?php echo ($arInfo[company]['cpname']); ?>;</span></p>
                <p><span>公司地点：</span><input class="input3" type="text" value="<?php echo ($arInfo[company]['address']); ?>" id="x_place"></p>
                <p><span>乘车路线：</span><input class="input3" type="text" value="XXXX" id="x_luxian"></p>
                <p><span>联系人：</span><input class="input1" type="text" value="<?php echo ($arInfo[company]['cnname']); ?>" id="x_person"></p>
                <p><span>联系电话：</span><input class="input4" type="text" value="<?php echo ($arInfo[company]['telephone']); ?>" id="x_mobile"><span>请勿迟到</span></p>
                <input type="hidden" id="mobile">
            </div>
            <div class="sm-footer">
                <span class="l"></span>
                <span class="r" id="send">发送</span>
            </div>
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


        
        <section class="is-rct resume" style="padding-bottom:20px;display:block;">
            <?php if($arInfo[checked] == "true"):?>
            <?php if(empty($arInfo[arRecordList])):?>
            <div style="text-align:center;background: #f0f0f0;padding-top:20px;padding-bottom:20px;">暂无推荐记录</div>
            <?php else:?>
            <div style="background:#f0f0f0;margin-bottom:10px;">
                <div class="wh-center95 top-nav" >
                    <div class="l">
                        <span class="dis-block dis-lef fl-lef">招聘职位：</span>
                        <em class="dis-block dis-lef fl-lef">全部职位</em>
                        <div class="cm">
                            <ul>
                                <?php foreach($arInfo[arJobList] as $k=>$v):?>
                                <li><a href='/index.php?s=/Company/candidate/id/<?php echo $v[id]?>'><?php echo $v['title'] ?></a></li>
                                <?php endforeach;?>

                            </ul>
                        </div>
                    </div>
                    <span class="r fl-rig">招聘资费：<?php  if(!empty($arInfo[jobInfoTmp])){echo $arInfo[jobInfoTmp]['Tariff'];}else{echo "--";} ?></span>
                </div>
            </div>
            <?php foreach($arInfo[arRecordList] as $k=>$v):?>
            <div class="pd-tb bd resume-list">
                <div class="rcmt-list">
                    <div class="div-list odiv1 clearfix">
                        <span class="fl-lef">候选人：</span>
                        <span class="fl-lef b"><a href="index.php?s=/Companyabout/view_resume/id/<?php echo $v[id] ?>/jid/<?php echo $v[j_id] ?>/btid/<?php echo $v[bt_id] ?>"><?php echo $v[bt_username]?></a></span>
                        <div class="fl-rig">
                            <span class="fl-lef">在职状态：</span>
                            <span class="fl-lef"><?php echo $v[state]?></span>
                        </div>
                    </div>
                    <div class="div-list odiv2 clearfix">
                        <span class="fl-lef">面试职位：</span>
                        <span class="fl-lef"><?php echo $v[j_title]?></span>
                        <div class="fl-rig">
                            <span class="fl-lef date">可面试时间</span>
                        </div>
                    </div>
                    <div class="div-list odiv3 clearfix">
                        <span class="fl-lef">推荐人：</span>
                        <span class="fl-lef"><?php echo $v[t_username]?></span>
                        <div class="fl-rig dis-block">
                            <span class="fl-fl">推荐时间：</span>
                            <span class="fl-fl"><?php echo date("Y-m-d",$v['posttime'])?></span>
                        </div>
                    </div>
                    <div class="div-list odiv4 clearfix">
                        <span class="fl-lef">电话：</span>
                        <span class="fl-lef"><?php echo $v[mobile]?></span>
                        <div class="fl-rig">
                            <span class="fl-lef">付款信息：</span>
                            <span class="fl-lef" style="padding-right:30px;"><?php echo $v[sink]?></span>
                        </div>
                    </div>
                    <span class="fl-lef mm"><img src="/Public/new-images/new-company/icon2.png" alt=""></span>
                    <div class="eject" style="display:block;">
                        <a href="javascript:void(0);" class="com-dqzt2" onclick="audstart(<?php echo $v[audstart_status] ?>,<?php echo $v[id] ?>);"><span class=""></span><em>当前状态</em></a>
                        <a href="index.php?s=/Companyabout/view_resume/id/<?php echo $v[id] ?>/jid/<?php echo $v[j_id] ?>/btid/<?php echo $v[bt_id] ?>"><span></span><em>查看简历</em></a>
                        <a href="javascript:void(0);" class="fsdx-btn"  btname="<?php echo $v['bt_username']?>" mobile="<?php echo $v['mobile']?>" real_audstart_time="<?php echo $v['real_audstart_time']?>"><span></span><em>面试短信</em></a>
                    </div>

                    <div class="data-zhezhao">
                        <a href="javascript:void(0)" class="fh"></a>
                        <div class="data-head">
                            <span>可面试时间</span>
                        </div>
                        <p><?php echo $v[audstartdate]?></p>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif;?>
            <?php else:?>
            <div style="text-align:center;background: #f0f0f0;padding-top:20px;padding-bottom:20px;">您的企业未通过人人猎系统审核，请您与我们的客服联系：010-57188076</div>
            <?php endif;?>
        </section>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var odiv4 = $(".rcmt-list .odiv4").width();
            var mmWidth = $(".rcmt-list .mm").width();
            $(".rcmt-list .mm").click(function () {
                if ($(this).hasClass("aa")) {
                    $(this).parent().find(".eject").animate({
                        translate: '110%,0'
                    }, 200, 'ease-out', function () {
                        $(this).css({
                            '-webkit-transform': 'translate(110%,0)'
                        });
                    });
                    $(this).removeClass("aa");
                } else {
                    $(this).parent().find(".eject").animate({
                        translate: '0%,0'
                    }, 200, 'ease-out', function () {
                        $(this).css({
                            '-webkit-transform': 'translate(0%,0)'
                        });
                    });
                    $(this).parents(".resume-list").siblings().find(".eject").animate({
                        translate: '110%,0'
                    }, 200, 'ease-out', function () {
                        $(this).css({
                            '-webkit-transform': 'translate(110%,0)'
                        });
                    });
                    $(this).parents(".resume-list").siblings().find(".mm").removeClass("aa");
                    $(this).addClass("aa");
                }
            });
            $(".rcmt-list .date").click(function () {
                $(this).parents(".resume-list").find(".data-zhezhao").animate({
                    translate: '0%,0'
                }, 200, 'ease-out', function () {
                    $(this).parents(".resume-list").find(".data-zhezhao").css({
                        '-webkit-transform': 'translate(0%,0)'
                    })
                });
                $(this).parents(".resume-list").siblings().find(".data-zhezhao").animate({
                    translate: '100%,0'
                }, 200, 'ease-out', function () {
                    $(this).css({
                        '-webkit-transform': 'translate(100%,0)'
                    })
                });
                $(this).parents(".resume-list").find(".fh").click(function () {
                    $(this).parent().animate({
                        translate: '100%,0'
                    }, 200, 'ease-out', function () {
                        $(this).parents(".resume-list").siblings().find(".data-zhezhao").css({
                            '-webkit-transform': 'translate(100%,0)'
                        })
                    });
                })
            });
            /*-------发送短信----*/
            $(".fsdx-btn").click(function () {
               
                $("#x_name").val($(this).attr("btname"));
                $("#mobile").val($(this).attr("mobile"));
                
                if($(this).attr("real_audstart_time")){
                    $("#x_time").val($(this).attr("real_audstart_time"));
                }
                
                $(".mask").fadeIn();
                $(".short-message").fadeIn();
            });
            $(".sm-head").click(function () {
                $(".mask").hide();
                $(".short-message").fadeOut();
            })

            var myScroll1 = new IScroll('.cm', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });
            $(".top-nav em").click(function () {
                if ($(this).hasClass("cc")) {
                    $(".top-nav .cm").hide();
                    $(this).removeClass("cc");
                    $(this).removeClass("m");
                    myScroll1.refresh();
                } else {
                    $(".top-nav .cm").show();
                    $(this).addClass("cc");
                    myScroll1.refresh();
                    $(this).addClass("m");
                }
            });
        

            $(".rcmt-list .eject").width(odiv4 - (mmWidth + 5))
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
            //修改面试状态确定按钮
            $("#alert_ok").click(function(){
               
                var audstartid = $("#audstartid").val();
                var recordids = $("#recordid").val();
                    
                $.post("/index.php?s=/Company/updateAudstartStatus.html", {
                    'audstartid': audstartid,
                    'recordid': recordids,
                    'type':'1',
                    'id':"<?php echo $arInfo['id']?>",
                }, function(data) {
                    location.reload();
                }, "json")
            })
            
            //修改面试状态取消按钮
            $("#alert_cancel").click(function(){
                     $("#desc").text("");
                     $("#recordid").val("");
                     $("#audstartid").val("");
                     $(".com-dqzt").fadeOut();
                     $("#like_alert_kuang").hide();
                     location.reload();
            })
            
            //填写面试时间取消按钮
            $("#time_cancel").click(function(){
                     $("#candidate_time").val("");
                     $("#time_recid").val("");
                     $(".mask").hide();
                     $(".com-dqzt").fadeOut();
                     $("#time_kuang").hide();
                     location.reload();
            })
            //填写面试时间确定按钮
            $("#time_ok").click(function(){
                     $(".mask").hide();
                     $("#time_kuang").hide();
                     var candidate_time = $("#candidate_time").val();
                     var time_recid = $("#time_recid").val();
                     $("#candidate_time").val("");
                     $("#time_recid").val("");
                    
                     $.post("/index.php?s=/Company/updateAudstartStatus.html", {
                        'audstartid': 3,
                        'recordid': time_recid,
                        'candidate_time': candidate_time,
                        'type':'1',
                        'id':"<?php echo $arInfo['id']?>",
                    }, function(data) {
                        location.reload();
                    }, "json")
            })
            
          
            //点击发送短信按钮
             $("#send").click(function() {
                var bt_name = $("#x_name").val();
                var mobile = $("#mobile").val();
                var msdate = $("#x_time").val();
                var gs = $("#gs").val();
                var address = $("#x_place").val();
                var lx = $("#x_luxian").val();
                var lxr = $("#x_person").val();
                var hm = $("#x_mobile").val();
                
                if (!mobile) {
                    show_error("面试人没有留手机号码,您可以查看是否有邮箱填写或者联系我们的工作人员！",3);
                    return false;
                }
                if (!bt_name || bt_name == "XXXX") {
                    show_error("面试人不能为空",3);
                    return false;
                }

                if (!msdate || msdate == "XXXX") {
                    show_error("面试时间不能为空",3);
                    return false;
                }
                if (!address) {
                    show_error("公司地点不能为空",3);
                    return false;
                }
                var msgContent = "亲爱的" + bt_name + "同学，我们诚挚邀请你" + msdate + "和我们面试，公司地点" + address;
                if (lx != "XXXX" && lx) {
                    msgContent += "乘车路线" + lx;
                }
            
                if (lxr != "XXXX" && lxr) {
                    msgContent += "，联系人" + lxr;
                }

                if (hm != "XXXX" || hm) {
                    msgContent += "，联系号码" + hm;
                }
                msgContent += "。请勿迟到。";
                
                var hash = "<?php $_SESSION['cookie']=time();echo md5('rrl_'.$_SESSION['cookie']);?>";
                $.post("/index.php?s=/Company/sendMessage.html", {
                    'msgcontent': msgContent,
                    'mobile': mobile,
                    'hash':hash
                    
                }, function(data) {
                    if (data.code == "200") {
                        show_error("发送成功!",3);
                        location.reload();
                    } else {
                        show_error(data.msg,3);
                    }
                }, "json")
            });

        })
        function audstart(statusid,recid) {
            $(".com-dqzt li").each(function (k) {
                if ($(this).find("input").val() == statusid) {
                    $(this).find("em").addClass("m").next().addClass("m");
                }
            })
            $(".mask").fadeIn();
            $(".com-dqzt").fadeIn();
            myScroll9.refresh();
            $(".com-dqzt li").click(function () {
                
                if ($(this).find("input").val() == statusid) {

                    setTimeout(function () {
                        $(".com-dqzt").fadeOut();
                        $(".mask").hide();
                    }, 200)
                }else if($(this).find("input").val() < statusid){
                    setTimeout(function () {
                        $(".com-dqzt").fadeOut();
                        $(".mask").hide();
                    }, 200);
                    show_error("不能向前更新面试状态",3);
                    return;
                } else {
                    $(this).find("em").addClass("m").next().addClass("m");
                    $(this).siblings().find("em").removeClass("m").next().removeClass("m");
                    
                    if ($(this).find("input").val() == 2) {
                       var url = "/index.php?s=/Company/audstart_text/recordid/"+recid+"/audstartid/2/id/<?php echo $arInfo['id']?>";
                       location.href = url;
                       return;
                    } else if ($(this).find("input").val() == 4) {
                        location.href = "/index.php?s=/Company/audstart_text/recordid/"+recid+"/audstartid/4/id/<?php echo $arInfo['id']?>";
                    } else if ($(this).find("input").val() == 7) {
                        location.href = "/index.php?s=/Company/audstart_text/recordid/"+recid+"/audstartid/7/id/<?php echo $arInfo['id']?>";
                    } else if ($(this).find("input").val() == 8) {
                        location.href = "/index.php?s=/Company/audstart_text/recordid/"+recid+"/audstartid/8/id/<?php echo $arInfo['id']?>";
                    } else if($(this).find("input").val() == 3){
                        $(".mask").show();
                        $(".com-dqzt").fadeOut();
                        $("#time_recid").val(recid);
                        $("#time_kuang").css("display","block");
                    }else {
                        $("#desc").text($(this).find("em").text());
                        $("#recordid").val(recid);
                        $("#audstartid").val($(this).find("input").val());
                        $(".com-dqzt").fadeOut();
                        $("#like_alert_kuang").css("display","block");
                        
                    }
                }

            })
        }
        var myScroll9 = new IScroll('.com-dqzt', {
            click: true,
            mouseWheel: true,
            interactiveScrollbars: true,
            shrinkScrollbars: 'scale',
            fadeScrollbars: true
        });
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