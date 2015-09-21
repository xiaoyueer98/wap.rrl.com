<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
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
        <style>

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
    </head>
    <body>
        <div class="mask"></div>
        <div class="com-alt com-place">
            <ul>
                <?php foreach($arArea as $area): ?>
                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block"><?php echo $area['cascname']?></em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="<?php echo $area['id'] ?>"></b>
                    </span>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="com-alt com-salary">
            <ul>
                <?php foreach($arTreatment as $treatment):?>
                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block"><?php echo $treatment['dataname']?></em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="<?php echo $treatment['datavalue'] ?>"></b>
                    </span>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="com-alt com-bkgd">
            <ul>
                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block">一线公司 （BAT，即百度、阿里、腾讯）</em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="A"></b>
                    </span>
                </li>

                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block">二线公司 （BAT外的其它互联网上市公司）</em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="B"></b>
                    </span>
                </li>

                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block">三线公司 （C轮融资）</em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="C"></b>
                    </span>
                </li>

                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block">四线公司 （已融资）</em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="D"></b>
                    </span>
                </li>

                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block">其它公司 （包括自有资金）</em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="E"></b>
                    </span>
                </li>

            </ul>
        </div>
        <div class="com-alt com-education">
            <ul>
                <?php foreach($arEducation as $edu):?>
                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block"><?php echo $edu['dataname']?></em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="<?php echo $edu['datavalue']?>"></b>
                    </span>
                </li>
                <?php endforeach;?>

            </ul>
        </div>
        <div class="com-alt com-language">
            <ul>
                <?php foreach($langData as $lang):?>
                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block"><?php echo $lang['dataname']?></em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="<?php echo $lang['datavalue']?>"></b>
                    </span>
                </li>
                <?php endforeach;?>


            </ul>
        </div>
        <div class="com-alt com-experience">
            <ul>
                <?php foreach($arExperience as $exper):?>
                <li class="bd">
                    <span>
                        <em class="fl-lef dis-block"><?php echo $exper['dataname']?></em> 
                        <b class="fl-rig dis-block"><input type='hidden' value="<?php echo $exper['datavalue']?>"></b>
                    </span>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="com-alt2 com-industry">
            <ul class="ul-l">
                <ul>
                    <?php foreach($arStrycate as $k=>$cate):?>
                    <li <?php if($k == 0):?>class="m"<?php endif;?>><?php echo $cate['cascname'];?></li>
                    <?php endforeach;?>
                </ul>

            </ul>
            <ul class="ul-r">
                <div>
                    <?php foreach($arStrycate as $k=>$cate):?>
                    <li class="alt2-list2" <?php if($k==0):?> style="display:block"<?php endif;?>>
                        <ul>
                            <?php foreach($cate['casclist'] as $clist):?>
                            <li><span class=""><?php echo $clist['cascname'];?></span><input type='hidden' value="<?php echo $clist['id'];?>"></li>
                            <?php endforeach;?>
                        </ul>
                    </li>
                    <?php endforeach;?>

                </div>
            </ul>
        </div>
        <div class="com-alt2 com-category">
            <ul class="ul-l ul-l2">
                <ul>
                    <?php foreach($arJobcate as $k=>$cate):?>
                    <li <?php if($k == 0):?>class="m"<?php endif;?>><?php echo $cate['cascname']?></li>
                    <?php endforeach;?>
                </ul>

            </ul>
            <ul class="ul-r ul-r2">
                <div>
                    <?php foreach($arJobcate as $k=>$cate):?>
                    <li class="alt2-list2" <?php if($k==0):?> style="display:block" <?php endif;?>>
                        <ul>
                            <?php foreach($cate['casclist'] as $k1=>$list):?>
                            <li><span class=""><?php echo $list['cascname'];?></span><input type='hidden' value="<?php echo $list['id'];?>" ></li>
                            <?php endforeach;?>
                        </ul>
                    </li>
                    <?php endforeach;?>
                </div>
            </ul>
        </div>
        <div class="com-alt2 com-subdivide">
            <ul class="ul-l ul-l3">
                <ul>
                    <li class="m">细分行业</li>

                </ul>

            </ul>
            <ul class="ul-r ul-r3">
                <div>
                    <li class="alt2-list2" style="display:block">
                        <ul>
                            <?php foreach($xfhy as $k=>$v):?>
                            <li><span class=""><?php echo $v?></span><input type='hidden' value='<?php echo $k?>'></li>
                            <?php endforeach;?>
                        </ul>
                    </li>

                </div>
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
    <p class="error"></p>
    <div class="wrap">
        <ul id="nav" class="nav" style='background:white;display:none;'>
    <li><a href="/index.php?s=/Company/complete_info"><span <?php if($select == 'info'): ?>class="sp0 sp0_2" <?php else: ?> class="sp0"<?php endif; ?>></span><b <?php if($select == 'info'): ?>class='m'<?php endif; ?>>完善资料</b></a></li>
    <li><a href="/index.php?s=/Company/agreement_status"><span <?php if($select == 'agreement'): ?>class="sp1 sp1_2" <?php else: ?> class="sp1"<?php endif; ?>></span><b <?php if($select == 'agreement'): ?>class='m'<?php endif; ?>>签订合同</b></a></li>
    <li><a href="/index.php?s=/Company/send_job"><span  <?php if($select == 'send_job'): ?>class="sp2 sp2_2" <?php else: ?>class="sp2"<?php endif; ?>></span><b <?php if($select == 'send_job'): ?>class='m'<?php endif; ?>>发布职位</b></a></li>
    <li><a href="/index.php?s=/Company/candidate"><span <?php if($select == 'candidate'): ?>class="sp3 sp3_2" <?php else: ?> class="sp3"<?php endif; ?>></span><b <?php if($select == 'candidate'): ?>class='m'<?php endif; ?>>查看候选人</b></a></li>
    <li><a href="/index.php?s=/Company/process_track"><span  <?php if($select == 'record'): ?>class="sp4 sp4_2" <?php else: ?>class="sp4"<?php endif; ?>></span><b <?php if($select == 'record'): ?>class='m'<?php endif; ?>>入职管理</b></a></li>
</ul>



        <form action='/index.php?s=/Company/send_job_text' method='post'>
            <section class="content m-content1" style="padding-bottom:20px;display:block">
                <div>
                    <span class="h3 dis-block">公司信息</span>
                </div>
                <div class="com-list">
                    <div class="bd">
                        <div class="list"><em class="m">职位名称：</em><input type="text" name='title' value="<?php echo $result['title']?>"></div>
                    </div>
                    <div class="bd">
                        <div class="list m" id="com-industry"><em class="m">行业类别 :</em><span><?php echo $result['industrydata']?></span><input type='hidden' value="<?php echo $result['industry']?>" name='industry'><input type='hidden' value="<?php echo $result['industrydata']?>" name='industrydata'></div>
                    </div>
                    <div class="bd">
                        <div class="list m" id="com-category"><em class="m">职位类别：</em><span><?php echo $result['categorydata']?></span><input type='hidden' value="<?php echo $result['category']?>" name='category'><input type='hidden' value="<?php echo $result['categorydata']?>" name='categorydata'></div>
                    </div>
                    <div class="bd">
                        <div class="list m" id="com-place"><em class="m">工作地点：</em><span><?php echo $result['place']?></span><input type='hidden' value="<?php echo $result['place']?>" name='place'></div>
                    </div>

                    <div class="bd">
                        <div class="list"><em class="m">招聘人数：</em><input type="text" name='employ' value="<?php echo $result['employ']?>"></div>
                    </div>
                </div>


                <div class="com-list" style="margin-top:30px;">
                    <div class="bd">
                        <div class="list m" id="com-salary"><em class="m">月薪待遇:</em><span><?php echo $result['treatmentdata']?></span><input type='hidden' name='treatment' value="<?php echo $result['treatment']?>"><input type='hidden' name='treatmentdata' value="<?php echo $result['treatmentdata']?>"></div>
                    </div>
                    <div class="bd">
                        <div class="list m" id="com-subdivide"><em class="m">细分行业：</em><span><?php echo $result['match_industrydata']?></span><input type='hidden' name='match_industry' value="<?php echo $result['match_industry']?>"><input type='hidden' name='match_industrydata' value="<?php echo $result['match_industrydata']?>"></div>
                    </div>
                    <div class="bd">
                        <div class="list m" id="com-bkgd"><em class="m">公司背景：</em><span><?php  echo $match_companydata = !empty($result['match_companydata']) ? $result['match_companydata'] : "<span style='color:#ccc'>期望候选人互联网从业背景</span>" ?></span><input type='hidden' name='match_company' value="<?php echo $result['match_company']?>"><input type='hidden' name='match_companydata' value="<?php echo $result['match_companydata']?>"></div>
                    </div>


                </div>

                <div class="com-list" style="margin-top:30px;">
                    <div class="bd">
                        <div class="list"><em class="m">汇报对象</em><input type="text" name='report_obj' value="<?php echo $result['report_obj']?>"></div>
                    </div>
                    <div class="bd">
                        <div class="list"><em class="">下属人数</em><input type="text" name="report_number"  value="<?php echo $result['report_number']?>"></div>
                    </div>

                    <div class="bd">
                        <div class="list"><em class="m">截止时间</em><input type="text" name="jobendtime"  value="<?php echo $result['jobendtime']?>" id="J-xl" readonly ></div>
                    </div>
                </div>

                <div style="margin-top:30px;">
                    <span class="h3 dis-block">职位要求</span>
                </div>
                <div class="com-list">
                    <div class="bd">
                        <div class="list m" id="com-education"><em class="m">学历要求：</em><span><?php echo $result['educationdata']?></span><input type='hidden' name='education' value="<?php echo $result['education']?>"><input type='hidden' name='educationdata' value="<?php echo $result['educationdata']?>"></div>
                    </div>
                    <div class="bd">
                        <div class="list m" id="com-language"><em class="m">语言能力：</em><span><?php echo $result['joblangdata']?></span><input type='hidden' name='joblang' value="<?php echo $result['joblang']?>"><input type='hidden' name='joblangdata' value="<?php echo $result['joblangdata']?>"></div>
                    </div>
                    <div class="bd">
                        <div class="list m" id="com-experience"><em class="m">工作经验：</em><span><?php echo $result['experiencedata']?></span><input type='hidden' name='experience' value="<?php echo $result['experience']?>"><input type='hidden' name='experiencedata' value="<?php echo $result['experiencedata']?>"></div>
                    </div>
                </div>



                <div style="margin-top:30px;">
                    <span class="h3 dis-block">工作职责</span>
                </div>
                <div class="com-list" id='workdesc'>
                    <div class="bd">
                        <div class="list m"><em class="m wh30"></em><span class="wh"><?php echo $result['workdesc']?></span><input type='hidden' name='workdesc' value="<?php echo $result['workdesc']?>"></div>
                    </div>
                </div>

                <div style="margin-top:30px;">
                    <span class="h3 dis-block">岗位要求</span>
                </div>
                <div class="com-list" id='content'>
                    <div class="bd">
                        <div class="list m"><em class="m wh30"></em><span class="wh"><?php echo $result['content']?></span><input type='hidden' name='content' value="<?php echo $result['content']?>"></div>
                    </div>
                </div>


                <div style="margin-top:30px;">
                    <span class="h3 dis-block">其他</span>
                </div>
                <div class="com-list">
                    <div class="bd">
                        <div class="list" id="com-nature"><em class="m" style="width:120px;">您的默认联系方式为 :</em><span class="wh100 cl2"><?php echo $default_mobile;?></span></div>
                    </div>
                    <div class="">
                        <div class="list" id="com-nature"><em style="width:130px;">是否使用其他联系方式 :</em><label id="m-tre" for="" ></label><input type='hidden' value="<?php if($result['meth']){ echo $result['meth']; }else{echo '1';}?>" name='meth'></div>
                    </div>
                    <div class="m-phone">
                        <div class="bd">
                            <div class="list"><em class="m">联系人</em><input type="text" name='jobperson' value="<?php echo $result['jobperson']?>"></div>
                        </div>

                        <div class="bd">
                            <div class="list"><em class="m">手机</em><input type="text" name='jobmobile' value="<?php echo $result['jobmobile']?>"></div>
                        </div>

                    </div>
                    <div class="bd">
                        <div class="list"><em class="m">招聘资费</em><label class="dis-block fl-lef lb-input"><input style="" type="text" name='jobTariffed' value="<?php echo $result['jobTariffed']?>"><i>00</i></label><span class="yuan">元</span></div>
                    </div>
                    <input type="hidden" value="" name="desc">
                    <input type="hidden" value="" name="type">
                    <div><span class="btn hover-hand" id="baocun">保存</span></div>
                </div>
            </section>
        </form>
    </div>
    <!--上传成功提示有几个职位与之匹配提示框-->
    <div style="display:none;z-index: 20;" id="tip_kuang">
        <div class="tanchu" style='z-index: 20;'>
            <dl>
                <dd id="success_title">发布职位成功，现有<b style="color:red;" id="fitcount"></b>个候选人与之匹配。</dd>
                <dd>
                    <a href="/index.php?s=/Companyabout/recording"><button id="go" style="font-size: 14px;width: 100px;">确定</button></a>
                </dd>
            </dl>
        </div>
    </div>
    <script type="text/javascript" src="/Public/js/laydate.dev.js"></script>
    <script type="text/javascript">
        var myDate = new Date();
        var y = myDate.getFullYear();
        var m = myDate.getMonth() + 1;
        var m1 = m + 1;
        var d = myDate.getDate();
        var d1 = d + 3;
        if(m<10){
            m = "0"+m;
        }
        if(m1<10){
            m1 = "0"+m1;
        }
        if(d<10){
            d = "0"+d;
        }
        if(d1<10){
            d1 = "0"+d1;
        }
        var taday = y + "-" + m + "-" + d;
        var minDate = y + "-" + m + "-" + d1;
        var maxDate = y + "-" + m1 + "-" + d;
        laydate({istime: true,format: 'YYYY-MM-DD', min: minDate, max: maxDate, elem: '#J-xl'})

        $(document).ready(function () {

            var myScroll = new IScroll('.com-salary', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });
            var myScroll3 = new IScroll('.com-bkgd', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });
            var myScroll4 = new IScroll('.com-education', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });
            var myScroll5 = new IScroll('.com-language', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });
            var myScroll6 = new IScroll('.com-experience', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });
            var myScroll7 = new IScroll('.ul-r', {
                click: true,
                scrollY: true,
                mouseWheel: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });
            var myScroll8 = new IScroll('.ul-l', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });
            var myScroll11 = new IScroll('.ul-l2', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });
            var myScroll10 = new IScroll('.ul-r2', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });

            var myScroll9 = new IScroll('.com-place', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });


            var myScroll12 = new IScroll('.ul-l3', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });
            var myScroll13 = new IScroll('.ul-r3', {
                click: true,
                mouseWheel: true,
                interactiveScrollbars: true,
                shrinkScrollbars: 'scale',
                fadeScrollbars: true
            });

            //如果传入text时，是否使用默认联系人为选中状态，则传回来也是选中状态
            if ("<?php echo $result['meth']?>" == "2") {
                $("#m-tre")[0].className = "current m";
                $(".m-phone").show();
            }

            $(".com-index .odiv").click(function () {
                $(this).addClass("m").siblings().removeClass("m");
            });
            $("#com-place").click(function () {
                $(".mask").fadeIn();
                $(".com-place").fadeIn();
                myScroll9.refresh();
                $(".com-place li").click(function () {
                    $(this).find("em").addClass("m").next().addClass("m");
                    $(this).siblings().find("em").removeClass("m").next().removeClass("m");
                    var text = $(this).find("em").text();
                    var val = $(this).find("input").val();
                    $("#com-place").find("span").text(text);
                    $("#com-place").find("input").val(val);
                    setTimeout(function () {
                        $(".com-place").fadeOut();
                        $(".mask").hide();
                    }, 200)

                })
            });
            $("#com-salary").click(function () {
                $(".mask").fadeIn();
                $(".com-salary").fadeIn();
                myScroll.refresh();
                $(".com-salary li").click(function () {
                    $(this).find("em").addClass("m").next().addClass("m");
                    $(this).siblings().find("em").removeClass("m").next().removeClass("m");
                    var text = $(this).find("em").text();
                    var value = $(this).find("b input").val();
                    $("#com-salary").find("span").text(text);
                    $("#com-salary").find("input").eq(0).val(value);
                    $("#com-salary").find("input").eq(1).val(text);
                    setTimeout(function () {
                        $(".com-salary").fadeOut();
                        $(".mask").hide();
                    }, 200)

                })
            });



            $("#com-bkgd").click(function () {
                $(".mask").fadeIn();
                $(".com-bkgd").fadeIn();
                myScroll3.refresh();
                $(".com-bkgd li").click(function () {
                    $(this).find("em").addClass("m").next().addClass("m");
                    $(this).siblings().find("em").removeClass("m").next().removeClass("m");
                    var text = $(this).find("em").text();
                    var value = $(this).find("b input").val();
                    $("#com-bkgd").find("span").text(text);
                    $("#com-bkgd").find("input").eq(0).val(value);
                    $("#com-bkgd").find("input").eq(1).val(text);
                    setTimeout(function () {
                        $(".com-bkgd").fadeOut();
                        $(".mask").hide();
                    }, 200)

                })
            });

            $("#com-education").click(function () {
                $(".mask").fadeIn();
                $(".com-education").fadeIn();
                myScroll4.refresh();
                $(".com-education li").click(function () {
                    $(this).find("em").addClass("m").next().addClass("m");
                    $(this).siblings().find("em").removeClass("m").next().removeClass("m");
                    var text = $(this).find("em").text();
                    var value = $(this).find("b input").val();
                    $("#com-education").find("span").text(text);
                    $("#com-education").find("input").eq(0).val(value);
                    $("#com-education").find("input").eq(1).val(text);
                    setTimeout(function () {
                        $(".com-education").fadeOut();
                        $(".mask").hide();
                    }, 200)

                })
            });

            $("#com-language").click(function () {
                $(".mask").fadeIn();
                $(".com-language").fadeIn();
                myScroll5.refresh();
                $(".com-language li").click(function () {
                    $(this).find("em").addClass("m").next().addClass("m");
                    $(this).siblings().find("em").removeClass("m").next().removeClass("m");
                    var text = $(this).find("em").text();
                    var value = $(this).find("b input").val();
                    $("#com-language").find("span").text(text);
                    $("#com-language").find("input").eq(0).val(value);
                    $("#com-language").find("input").eq(1).val(text);
                    setTimeout(function () {
                        $(".com-language").fadeOut();
                        $(".mask").hide();
                    }, 200)

                })
            });

            $("#com-experience").click(function () {
                $(".mask").fadeIn();
                $(".com-experience").fadeIn();
                myScroll6.refresh();
                $(".com-experience li").click(function () {
                    $(this).find("em").addClass("m").next().addClass("m");
                    $(this).siblings().find("em").removeClass("m").next().removeClass("m");
                    var text = $(this).find("em").text();
                    var value = $(this).find("b input").val();
                    $("#com-experience").find("span").text(text);
                    $("#com-experience").find("input").eq(0).val(value);
                    $("#com-experience").find("input").eq(1).val(text);

                    setTimeout(function () {
                        $(".com-experience").fadeOut();
                        $(".mask").hide();
                    }, 200)

                })
            });

            $("#com-industry").click(function () {
                $(".mask").fadeIn();
                $(".com-industry").fadeIn();
                myScroll7.refresh();
                myScroll8.refresh();
                var index;
                var list = $(".com-industry .ul-l li");
                var divs = $(".com-industry .ul-r div>li");
                list.on("click", function () {
                    that = $(this);
                    index = that.index();
                    that.addClass("m").siblings().removeClass("m");
                    $(this).addClass("m").siblings().removeClass("m");
                    divs.eq(index).show().siblings("li").hide();
                    myScroll7.refresh();
                    myScroll8.refresh();
                    divs.eq(index).find("li").click(function () {
                        $(this).find("span").addClass("m").parent().siblings().find("span").removeClass("m");
                        var $text = $(this).find("span").text();
                        $("#com-industry span").text($text);
                        setTimeout(function () {
                            $(".com-industry").fadeOut();
                            $(".mask").hide();
                        }, 200)
                    })
                });
                var index2 = $(".com-industry .ul-r div>li li").size();
                //alert(index2)
                for (i = 0; i < index2; i++) {
                    divs.find("li").eq(i).click(function () {
                        $(this).find("span").addClass("m").parent().siblings().find("span").removeClass("m");
                        var $text = $(this).find("span").text();
                        var value = $(this).find("input").val();
                        $("#com-industry span").text($text);
                        $("#com-industry").find("input").eq(0).val(value);
                        $("#com-industry").find("input").eq(1).val($text);

                        setTimeout(function () {
                            $(".com-industry").fadeOut();
                            $(".mask").hide();
                        }, 200)
                    })
                }
            });

            $("#com-category").click(function () {
                $(".mask").fadeIn();
                $(".com-category").fadeIn();
                myScroll11.refresh();
                myScroll10.refresh();
                var index;
                var list = $(".com-category .ul-l li");
                var divs = $(".com-category .ul-r div>li");
                list.on("click", function () {
                    that = $(this);
                    index = that.index();
                    that.addClass("m").siblings().removeClass("m");
                    $(this).addClass("m").siblings().removeClass("m");
                    divs.eq(index).show().siblings("li").hide();
                    myScroll11.refresh();
                    myScroll10.refresh();
                    divs.eq(index).find("li").click(function () {
                        $(this).find("span").addClass("m").parent().siblings().find("span").removeClass("m");
                        var $text = $(this).find("span").text();
                        $("#com-category span").text($text);

                        setTimeout(function () {
                            $(".com-category").fadeOut();
                            $(".mask").hide();
                        }, 200)
                    });
                });
                var index2 = $(".com-category .ul-r div>li li").size();
                //alert(index2)
                for (i = 0; i < index2; i++) {
                    divs.find("li").eq(i).click(function () {
                        $(this).find("span").addClass("m").parent().siblings().find("span").removeClass("m");
                        var $text = $(this).find("span").text();
                        var value = $(this).find("input").val();
                        $("#com-category span").text($text);
                        $("#com-category input").eq(0).val(value);
                        $("#com-category input").eq(1).val($text);
                        setTimeout(function () {
                            $(".com-category").fadeOut();
                            $(".mask").hide();
                        }, 200)
                    })
                }

            });


            $("#com-subdivide").click(function () {
                $(".mask").fadeIn();
                $(".com-subdivide").fadeIn();
                myScroll11.refresh();
                myScroll10.refresh();
                var index;
                var list = $(".com-subdivide .ul-l li");
                var divs = $(".com-subdivide .ul-r div>li");
                list.on("click", function () {
                    that = $(this);
                    index = that.index();
                    that.addClass("m").siblings().removeClass("m");
                    $(this).addClass("m").siblings().removeClass("m");
                    divs.eq(index).show().siblings("li").hide();
                    myScroll11.refresh();
                    myScroll10.refresh();
                    divs.eq(index).find("li").click(function () {
                        $(this).find("span").addClass("m").parent().siblings().find("span").removeClass("m");
                        var $text = $(this).find("span").text();
                        $("#com-subdivide span").text($text);

                        setTimeout(function () {
                            $(".com-subdivide").fadeOut();
                            $(".mask").hide();
                        }, 200)
                    });
                });
                var index2 = $(".com-subdivide .ul-r div>li li").size();
                //alert(index2)
                for (i = 0; i < index2; i++) {
                    divs.find("li").eq(i).click(function () {
                        $(this).find("span").addClass("m").parent().siblings().find("span").removeClass("m");
                        var $text = $(this).find("span").text();
                        var value = $(this).find("input").val();
                        $("#com-subdivide span").text($text);
                        $("#com-subdivide input").eq(0).val(value);
                        $("#com-subdivide input").eq(1).val($text);
                        setTimeout(function () {
                            $(".com-subdivide").fadeOut();
                            $(".mask").hide();
                        }, 200)
                    })
                }

            });



            $("#m-tre").click(function () {
                if ($("#m-tre").hasClass("current")) {
                    $(".m-phone").hide();
                    $(this).removeClass("current").removeClass("m");
                    $("#m-tre").next().val("1");
                } else {
                    $(".m-phone").show();
                    $(this).addClass("current").addClass("m");
                    $("#m-tre").next().val("2");
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
        $("#baocun").click(function () {
            //保存修改信息
            $("#baocun")[0].disabled = true;
            var title = $('[name="title"]').val();
            var industry = $('[name="industry"]').val();
            var category = $('[name="category"]').val();
            var place = $('[name="place"]').val();
            var employ = $('[name="employ"]').val();

            var treatment = $('[name="treatment"]').val();
            var match_industry = $('[name="match_industry"]').val();
            var match_company = $('[name="match_company"]').val();

            var report_obj = $('[name="report_obj"]').val();
            var report_number = $('[name="report_number"]').val();
            var jobendtime = $('[name="jobendtime"]').val();
          
            var education = $('[name="education"]').val();
            var joblang = $('[name="joblang"]').val();
            var experience = $('[name="experience"]').val();

            var workdesc = $('[name="workdesc"]').val();
            var content = $('[name="content"]').val();

            var meth = $('[name="meth"]').val();
            var jobperson = $('[name="jobperson"]').val();
            var jobmobile = $('[name="jobmobile"]').val();
            var jobTariffed = $('[name="jobTariffed"]').val();

            if (title == "") {
                show_error("请填写职位名称", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (industry == "") {
                show_error("请填写行业类别", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (category == "") {
                show_error("请填写职位类别", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (place == "") {
                show_error("亲填写工作地点", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (employ == "") {
                show_error("请填写招聘人数", 3);
                $("#baocun")[0].disabled = false;
                return;

            }

            if (treatment == "") {
                show_error("请填写月薪待遇", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (match_industry == "") {
                show_error("请填写细分行业", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (match_company == "") {
                show_error("请填写公司背景", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (report_obj == "") {
                show_error("请填写汇报对象", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (report_number == "") {
                show_error("请填写下属人数", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (jobendtime == "") {
                show_error("请填写截止日期", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (education == "") {
                show_error("请填写学历要求", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (joblang == "") {
                show_error("请填写语言能力", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (experience == "") {
                show_error("请填写工作经验", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (workdesc == "") {
                show_error("请填写工作职责", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
            if (content == "") {
                show_error("请填写岗位要求", 3);
                $("#baocun")[0].disabled = false;
                return;

            }


            if (meth == 2) {
                if (jobperson == "") {
                    show_error("请填写联系人", 3);
                    $("#baocun")[0].disabled = false;
                    return;

                }
                var reg = /^1[0-9]{10}$/;
                if (!reg.test(jobmobile) && jobmobile != "") {
                    show_error("请输入正确的手机号码", 3);
                    $("#baocun")[0].disabled = false;
                    return;
                }
            }

            if (jobTariffed == "") {
                show_error("请填写招聘资费", 3);
                $("#baocun")[0].disabled = false;
                return;

            }
           
            $.post("/index.php?s=/Company/send_job_save", {
                'title': title,
                'industry': industry,
                'category': category,
                'place': place,
                'employ': employ,
                'treatment': treatment,
                'match_industry': match_industry,
                'match_company': match_company,
                'report_obj': report_obj,
                'report_number': report_number,
                'endtime': jobendtime,
                'education': education,
                'joblang': joblang,
                'experience': experience,
                'workdesc': workdesc,
                'content': content,
                'meth': meth,
                'jobperson': jobperson,
                'jobmobile': jobmobile,
                'Tariff': jobTariffed,
            }, function (data) {

                if (data.code != "200") {

                    show_error(data.msg, 3);
                    $("#savebtn")[0].disabled = false;
                    return;

                } else {
                    $("[name='title']").val("");
                    $('[name="industry"]').val("");
                    $("#com-industry span").html("");
                    $('[name="category"]').val("");
                    $("#com-category span").html("");
                    $('[name="place"]').val("");
                    $("#com-place span").html("");
                    $('[name="employ"]').val("");

                    $('[name="treatment"]').val("");
                    $("#com-salary span").html("");
                    $('[name="match_industry"]').val("");
                    $("#com-subdivide span").html("");
                    $('[name="match_company"]').val("");
                    $("#com-bkgd span").html("");

                    $('[name="report_obj"]').val("");
                    $('[name="report_number"]').val("");
                    $('[name="jobendtime"]').val("");

                    $('[name="workdesc"]').val("");
                    $("#workdesc span").html("");
                    $('[name="content"]').val("");
                    $("#content span").html("");

                    $('[name="education"]').val("");
                    $("#com-education span").html("");
                    $('[name="joblang"]').val("");
                    $("#com-language span").html("");
                    $('[name="experience"]').val("");
                    $("#com-experience").html("");

                    $('[name="meth"]').val("");
                    $('[name="jobperson"]').val("");
                    $('[name="jobmobile"]').val("");
                    $('[name="jobTariffed"]').val("");
//                    show_error("完善职位成功", 3);


                    var fitcount = data.msg;
                    $("#fitcount").text(fitcount);
                    $(".mask").show();
                    $("#tip_kuang").show();
                    return;
                }
            }, "json");



        });

        $("#workdesc").click(function () {

            to_text("workdesc", "工作职责");
        })
        $("#content").click(function () {

            to_text("content", "岗位要求");
        })


        function  to_text(type, desc) {

            $("[name='type']").val(type);
            $("[name='desc']").val(desc);
            $("form")[0].submit();

        }
        function set_time(tip, wait) {
            if (wait == 0) {
                if (tip == "完善信息成功") {
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