<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <link rel="stylesheet"  href="/Public/css/reset.css">
        <link rel="stylesheet"  href="/Public/css/wep3.css">
        <link rel="stylesheet" href="/Public/css/swiper.min.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/style.css" media="screen"/>
        <script type="text/javascript" src="/Public/new-js/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/zepto.min.js"></script>
        <script src="/Public/js/Mbase.js" type="text/javascript" ></script>
        <script type="text/javascript" src="/Public/js/left_nav3.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black" name="apple-mobile-web-app-status-bar-style" />
        <meta content="telephone=no" name="format-detection" />
    </head>
    <body style="overflow:hidden">
        <div class="mask" style="display:none"></div>
        <div class="alr-paihang">
            <div id="marquee5">
                <ul>
                    <?php foreach($arInventedData as $v){?>
                    <li><?php echo $v['title']?></li>
                    <?php }?>
                </ul>
            </div>
        </div>
        <div class="left_nav">
            <div class="head">
                <a class="logo" href="/"><img src="/Public/images/logo_index.png" alt=""></a>
            </div>
            <div id="c" class="c">
                <div class="clearfix" style="padding-bottom:40px;">
                    <?php if(!empty($_SESSION['cuserinfo'])):?>
                    <div class="user">
                        <span class="t dis-block dis-inlin" style="display:block">用户中心</span>
                        <div class="user-data">
                            <dl class="user-con clearfix">
                                <dt class="dis-block dis-inlin fl-lef">
                                <?php if($cuserinfo['thumlogo']):?>
                                <img src="<?php echo 'http://www.renrenlie.com'.$cuserinfo['thumlogo']?>" alt="">
                                <?php else:?>
                                <img src="/Public/images/q_logo_default.png" alt="">
                                <?php endif;?>
                                </dt>
                                <dd class="dis-block dis-inlin fl-lef">
                                    <span class="dis-block dis-inlin"><?php echo $cuserinfo['username']?></span>
                                    <span class="dis-block dis-inlin"><?php echo $cuserinfo['mobile']?></span>
                                    <span class="dis-block dis-inlin"><?php echo $cuserinfo['cpname']?></span>
                                    <span class="dis-block dis-inlin"><?php echo $cuserinfo['email']?></span>
                                </dd>
                                <span class="date">
                                    <?php echo $regTime;?>
                                </span>
                            </dl>
                        </div>
                        <div class="div-list div-list1">
                            <div class="lt clearfix"><span class="sp1"></span><em>任务</em></div>
                            <?php if($leftNavCompleted['userinfo_completed'] && $leftNavCompleted['contract_completed'] && $leftNavCompleted['job_completed'] && $leftNavCompleted['record_completed']):?>
                            <p class="clearfix">暂无任务</p>
                            <?php else:?>
                            <?php if(!$leftNavCompleted['userinfo_completed']):?>
                            <p class="clearfix"><a href='/index.php?s=/Company/complete_info'><span style='color:#343434'>企业基本资料需要完善</span></a></p>
                            <?php endif;?>
                            <?php if(!$leftNavCompleted['contract_completed']):?>
                            <p class="clearfix"><a href='/index.php?s=/Company/agreement_status'><span style='color:#343434'>需要签订合同</span></a></p>
                            <?php endif;?>
                            <?php if(!$leftNavCompleted['job_completed']):?>
                            <p class="clearfix"><a href='/index.php?s=/Company/send_job'><span style='color:#343434'>还没发布职位</span></a></p>
                            <?php endif;?>
                            <?php if($leftNavCompleted['record_completed']):?>
                            <p class="clearfix"><a href='/index.php?s=/Company/candidate'><span style='color:#343434'>查看候选人简历</span></a></p>
                            <?php endif;?>
                            <?php endif;?>
                        </div>

                        <div class="div-list div-list1">
                            <div class="lt clearfix"><span class="sp2"></span><em>人才</em></div>
                            <p class="clearfix"><span class="back-none">1.候选人简历：<a href="/index.php?s=/Company/candidate.html"><b><?php echo $resumeCount?></b></a>份；</span></p>
                            <p class="clearfix"><span class="back-none">2.发布职位：<a href="/index.php?s=/Companyabout/recording.html"><b><?php echo $jobCount?></b></a>个；</span></p>
                            <p class="clearfix"><span class="back-none">3.累积支付费用：<a href="/index.php?s=/Companyabout/pay/act/paid.html"><b><?php echo $sumFee;?></b></a>元；</span></p>
                            <p class="clearfix"><span class="back-none">4.累积入职人数：<a href="/index.php?s=/Company/process_track.html"><b><?php echo $isSucCount;?></b></a>人；</span></p>
                        </div>

                        <div class="div-list div-list1">
                            <div class="lt clearfix"><span class="sp3"></span><em>进程</em></div>
                            <p class="clearfix"><span class="back-none">1.新收到的候选人简历：<a href="/index.php?s=/Company/candidate.html"><b><?php echo $newRecordCount; ?></b></a>份；</span></p>
                            <p class="clearfix"><span class="back-none">2.进入待付款状态的候选人：<a href="/index.php?s=/Companyabout/pay/act/paying.html"><b><?php echo $isSinkCount; ?></b></a>个；</span></p>
                        </div>
                    </div>
                    <div class="l-c-n">
                        <a href="/index.php?s=/Company/complete_info">
                            <em class="dis-block dis-inlin fl-lef">
                                <i><img src="/Public/images/l-c-nv1.png" alt=""></i>
                                <b>完善资料</b>
                            </em>
                        </a>    
                        <a href="/index.php?s=/Company/agreement_status">
                            <em class="dis-block dis-inlin fl-lef">
                                <i><img src="/Public/images/l-c-nv2.png" alt=""></i>
                                <b>签订合同</b>
                            </em>
                        </a>     
                        <a href="/index.php?s=/Company/send_job">
                            <em class="dis-block dis-inlin fl-lef">
                                <i><img src="/Public/images/l-c-nv3.png" alt=""></i>
                                <b>发布职位</b>
                            </em>
                        </a>     
                        <a href="/index.php?s=/Company/candidate">    
                            <em class="dis-block dis-inlin fl-lef">
                                <i><img src="/Public/images/l-c-nv4.png" alt=""></i>
                                <b>候选人</b>
                            </em>
                        </a>     
                        <a href="/index.php?s=/Company/process_track">
                            <em class="dis-block dis-inlin fl-lef">
                                <i><img src="/Public/images/l-c-nv5.png" alt=""></i>
                                <b>入职管理</b>
                            </em>
                        </a>     
                    </div>
                    <?php elseif(!empty($_SESSION['userinfo'])):?>
                    <span style="background:#11598e;height:30px;display:block;line-height:30px;color:#fff;display:none">以下是推荐人部分</span>
                    <div class="user" style="display:block">
                        <span class="t dis-block dis-inlin">用户中心</span>
                        <div class="user-data">
                            <dl class="user-con clearfix">
                                <dt class="dis-block dis-inlin fl-lef">
                                <?php if($arUserinfo['avatar']):?>
                                <img src="<?php echo 'http://www.renrenlie.com/'.$arUserinfo['avatar'];?>" alt="">
                                <?php else:?>
                                <img src="/Public/images/t_logo_default.png" alt="">
                                <?php endif;?>
                                </dt>
                                <dd class="dis-block dis-inlin fl-lef">
                                    <span class="dis-block dis-inlin" style='margin-top:10px;'>
                                        <?php  if(strpos($arUserinfo['username'],"qq_")===0){ echo "qq用户"; }elseif(strpos($arUserinfo['username'],"wx_")===0){ echo "微信用户"; }elseif(strpos($arUserinfo['username'],"renren_")===0){ echo "人人用户"; }elseif(strpos($arUserinfo['username'],"sina_")===0){ echo "新浪用户"; }else{ echo $arUserinfo['username']; } ?>
                                    </span>
                                    <span class="dis-block dis-inlin"><?php echo $arUserinfo['mobile'];?></span>
                                    <span class="dis-block dis-inlin"><?php echo $arUserinfo['email'];?></span>
                                </dd>
                                <span class="date">
                                    <?php echo $regTime;?>
                                </span>
                            </dl>
                        </div>
                        <div class="div-list div-list1">
                            <div class="lt clearfix"><span class="sp1"></span><em>任务</em></div>
                            <?php if($Info['userinfo_completed'] && $Info['is_mobile'] && $Info['is_resume'] && $Info['is_record']):?>
                            <p class="clearfix">暂无任务</p>
                            <?php else:?>
                            <?php if(!$Info['userinfo_completed']):?>
                            <p class="clearfix"><a href='/index.php?s=/Usercenter/myinfo'><span style='color:#343434'>个人基本资料需要完善</span></a></p>
                            <?php endif;?>
                            <?php if(!$Info['is_mobile']):?>
                            <p class="clearfix"><a href='/index.php?s=/Usercenter/myinfo'><span style='color:#343434'>还没验证手机号</span></a></p>
                            <?php endif;?>
                            <?php if(!$Info['is_resume']):?>
                            <p class="clearfix"><a href='/index.php?s=/Job/add_resume'><span style='color:#343434'>简历库（候选人）还没有</span></a></p>
                            <?php endif;?>
                            <?php if(!$Info['is_record']):?>
                            <p class="clearfix"><a href='/index.php?s=/Job/job_list'><span style='color:#343434'>快去为候选人推荐合适的职位吧</span></a></p>
                            <?php endif;?>
                            <?php endif;?>
                        </div>

                        <div class="div-list div-list1">
                            <div class="lt clearfix"><span class="sp4"></span><em>财富</em></div>
                            <p class="clearfix"><span class="back-none">1.简历库：  <a href="index.php?s=/Usercenter/recommend_info"><b><?php echo $resumeCount;?></b></a>份；</span></p>
                            <p class="clearfix"><span class="back-none">2.推荐次数：<a href="/index.php?s=/Recommend/recommending"><b><?php echo $recordCount;?></b></a>次；</span></p>
                            <p class="clearfix"><span class="back-none">3.累积收益：<a href="/index.php?s=/Recommend/recommending"><b><?php echo $feeCount;?></b></a>元；</span></p>
                        </div>

                        <div class="div-list div-list1">
                            <div class="lt clearfix"><span class="sp3"></span><em>进程</em></div>
                            <p class="clearfix"><span class="back-none">1.正在面试进程中的候选人：<a href="/index.php?s=/Recommend/recommending"><b><?php echo $isAudstartCount;?></b></a>个；</span></p>
                            <p class="clearfix"><span class="back-none">2.进入待付款状态的候选人：<a href="/index.php?s=/Recommend/recommending"><b><?php echo $isSinkCount;?></b></a>个；</span></p>
                        </div>
                    </div>
                    <div class="l-c-n">
                        <a href="/index.php?s=/Usercenter/myinfo">
                            <em class="dis-block dis-inlin fl-lef">
                                <i><img src="/Public/images/l-c-nv1.1.png" alt=""></i>
                                <b>完善资料</b>
                            </em>
                        </a>
                        <a href="/index.php?s=/Job/add_resume">
                            <em class="dis-block dis-inlin fl-lef">
                                <i><img src="/Public/images/l-c-nv2.1.png" alt=""></i>
                                <b>简历库</b>
                            </em>
                        </a>
                        <a href="/index.php?s=/Job/job_list">
                            <em class="dis-block dis-inlin fl-lef">
                                <i><img src="/Public/images/l-c-nv3.1.png" alt=""></i>
                                <b>推荐职位</b>
                            </em>
                            <a>
                                <a href="/index.php?s=/Recommend/recommending">
                                    <em class="dis-block dis-inlin fl-lef">
                                        <i><img src="/Public/images/l-c-nv4.1.png" alt=""></i>
                                        <b>跟踪状态</b>
                                    </em>
                                </a>
                                <a href="/index.php?s=/Job/my_account">
                                    <em class="dis-block dis-inlin fl-lef">
                                        <i><img src="/Public/images/l-c-nv5.1.png" alt=""></i>
                                        <b>查看收益</b>
                                    </em>
                                </a>    
                                </div>
                                <?php endif;?>
                                <ul>
                                    <li class="dis_box cur" style="border-top:1px #cfcfcf solid"><span class="flex">首&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp页</span><em><img src="/Public/images/right_jt.png" alt=""></em></li>
                                    <li class="dis_box cur"><span class="flex">成功案例</span><em><img src="/Public/images/right_jt.png" alt=""></em></li>
                                    <li onclick="location.href = '/index.php?s=/Index/qa'" class="dis_box cur"><span class="flex">Q&nbsp;&nbsp;& &nbsp;&nbsp;A</span><em><img src="/Public/images/right_jt.png" alt=""></em></li>
                                    <li class="dis_box cur"><span class="flex">关于我们</span><em><img src="/Public/images/right_jt.png" alt=""></em></li>
                                    <li class="dis_box cur"><span class="flex">注册协议</span><em><img src="/Public/images/right_jt.png" alt=""></em></li>
                                    <li class="dis_box cur"><span class="flex">用户隐私</span><em><img src="/Public/images/right_jt.png" alt=""></em></li>
                                    <li class="dis_box cur"><span class="flex">联系我们</span><em><img src="/Public/images/right_jt.png" alt=""></em></li>
                                    <li onclick="location.href = '/index.php?s=/Job/new_job2'" class="dis_box cur"><span class="flex">加入我们</span><em><img src="/Public/images/right_jt.png" alt=""></em></li>
                                    <li onclick="location.href = '/index.php?s=/Index/feedback'" class="dis_box cur"><span class="flex">意见反馈</span><em><img src="/Public/images/right_jt.png" alt=""></em></li>
                                    <li onclick="location.href = '/index.php?s=/Login/logout'" class="dis_box cur"><span class="flex">退出登陆</span><em><img src="/Public/images/right_jt.png" alt=""></em></li>
                                </ul> 
                                </div>
                                </div>
                                </div>
                                <div class="index_con">
                                    <header class="headder">
    <a class="nav_btn cur"><img src="/Public/images/nav_btn.png" alt=""></a>
    <?php if(!empty($_SESSION['userinfo']) || !empty($_SESSION['cuserinfo']) ){ ?>
    <ul>
        <span class="r" style='font-size:16px;'></span>
    </ul>
    <?php }else{ ?>
    <ul>
        <a href="/index.php?s=/Login/login">登录</a>
        <span>|</span>
        <a href="/index.php?s=/Reg/reg">注册</a>
    </ul>
    <?php } ?>
    <span style="display:none;"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></span>
</header>
<script>
     //$('.nav').css({'height':'0px!important'})
     $('.headder .r').click(function(){
            if($(this).hasClass("current")){
                $('.nav').animate({height:'0px'},200);
                setTimeout(function(){
                    $('.nav').hide()
                },200) ;
                setTimeout(function(){
                    $(window).resize();
                },250);
                // $(".back-top").css({'padding-bottom':'40px;'});
                $(this).removeClass('m')
                $(this).removeClass("current");
                // alert(23)
            }else{
                $('.nav').height(0)
                $('.nav').show();
                $('.nav').animate({height:'48px'},200);
                $(window).resize();
                $(this).addClass('m')
                $(this).addClass("current");
                //$(".back-top").css({'padding-bottom':'0px;'});
            }
            //alert($('.nav').height())
        })

</script>
                                    <div class="wapper wap date_wap">
                                        <section id="scrol_index" class="back-top" style="padding-bottom:45px;">
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

  
                                            <div class="silder-banner">
                                                <div class="swiper-container">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide"><img src="/Public/images/1.png" alt=""></div>
                                                        <div class="swiper-slide"><img src="/Public/images/2.png" alt=""></div>
                                                        <div class="swiper-slide"><img src="/Public/images/3.png" alt=""></div>
                                                    </div>
                                                    <div class="swiper-pagination"></div>
                                                </div>
                                            </div>
                                            <div class="sbanner dis_box">
                                                <span class="flex"><img  onclick="location.href = '/index.php?s=/Salon/salon_list'" src="/Public/new-images/salonin.png" alt=""></span>
                                                <span class="flex" style="margin:0 10px"><img onclick="location.href = '/index.php?s=/Customized/index'" src="/Public/images/hd2.png" alt=""></span>
                                                <span class="flex paihang"><img onclick="location.href = '/index.php?s=/Upresume/index'" src="/Public/images/hd3.png" alt=""></span>
                                            </div>
                                            <div class="search">
                                                <div class=" clearfix">
                                                    <input type="text" placeholder="请输入职位名称" id="search_input">
                                                    <span class="btn" id="search">搜索</span>
                                                </div>
                                            </div>
                                            <div class="wp1-title">
                                                <h3><span>最新职位</span></h3> 
                                            </div>
                                            <div>
                                                <div class="myajs">


                                                    <?php if(is_array($result)): $k = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><a href="/index.php?s=/Job/job_detail_new/jobid/<?php echo ($vo["id"]); ?>">
                                                            <ul class="latest-position">
                                                                <li class="clearfix lis1">
                                                                    <div class="fl-lef dis-inlin">
                                                                        <em class="fl-lef dis-inlin dis-block"><?php echo ($vo["title"]); ?></em>
                                                                    </div>
                                                                    <div class="fl-rig dis-inlin">
                                                                        <em class="fl-lef dis-inlin dis-block"><?php echo ($vo["treatmentdata"]); ?></em>
                                                                    </div>
                                                                </li>
                                                                <li class="clearfix lis1">
                                                                    <div class="fl-lef dis-inlin r"><?php echo ($vo["cpname"]); ?></div>
                                                                    <div class="fl-rig dis-inlin r"><span class="fl-lef dis-inlin dis-block">[<?php echo ($vo["cascname"]); ?>]</span></div>
                                                                </li>
                                                                <li class="clearfix lis2">
                                                                    <div class="fl-lef dis-inlin">

                                                                        <span class="fl-lef dis-inlin dis-block"><?php echo ($vo["experiencedata"]); ?></span>
                                                                        <span class="fl-lef dis-inlin dis-block"><?php echo ($vo["educationdata"]); ?></span>
                                                                        <span class="fl-lef dis-inlin dis-block"><?php echo ($vo["scaledata"]); ?></span>

                                                                    </div>
                                                                    <div class="fl-rig dis-inlin">

                                                                    </div>
                                                                </li>
                                                                <li class="clearfix lis3">
                                                                    <em class="fl-lef dis-inlin">候选人入职，你即得奖励￥<?php echo ($vo["Tariff"]); ?></em>
                                                                    <span class="fl-rig dis-inlin"><?php echo ($vo["starttime"]); ?></span>
                                                                </li>
                                                            </ul>
                                                        </a><?php endforeach; endif; else: echo "" ;endif; ?> 
                                                </div>
                                                <span class="load-more">点击加载更多</span>
                                                <span class="load-more-end">加载已完成</span>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="wap3 date_wap">
                                        <div id="m" class="m flex">
                                            <div class="m_scro dis_box orient aligncenter">
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

  
                                                <div class="baner" style="padding-top:10px;width:100%;"><img src="/Public/images/chal_baner.png" alt=""></div>
                                                <div class="wp3-title"><h3>案例展示</h3></div>
                                                <div class="dis_box">
                                                    <div class=" dis_box orient aligncenter" style="margin-right:1%;">
                                                        <dl class="dis_box orient aligncenter">
                                                            <dt><img src="/Public/images/ml.png" alt=""></dt>
                                                            <dd><h5>美丽来</h5></dd>
                                                            <dd>
                                                                <p>专注于中高端女性上门服务的美容o2o，在人人猎成功招到高级Android、php等人才人才.</p>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                    <div class=" dis_box orient aligncenter">
                                                        <dl class="dis_box orient aligncenter">
                                                            <dt><img src="/Public/images/ysy.png" alt=""></dt>
                                                            <dd><h5>云视野</h5></dd>
                                                            <dd>
                                                                <p>知名投资人投资的中国独家掌握云验光技术，为顾客上门专业验光配镜的眼镜O2O。在人人猎成功招到 php等人才。.</p>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="dis_box">
                                                    <div class=" dis_box orient aligncenter" style="margin-right:1%;">
                                                        <dl class="dis_box orient aligncenter">
                                                            <dt><img src="/Public/images/yj.png" alt=""></dt>
                                                            <dd><h5>易结网</h5></dd>
                                                            <dd><p>IDG投资的婚嫁O2O平台领航者，为结婚新人打造最佳婚礼服务平台。通过人人猎成功招到移动开发工程师等人才。</p>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                    <div class=" dis_box orient aligncenter">
                                                        <dl class="dis_box orient aligncenter">
                                                            <dt><img src="/Public/images/kmf.png" alt=""></dt>
                                                            <dd><h5>盈禾优仕</h5></dd>
                                                            <dd><p>专注于出国考试相关的网络备考工具与服务，通过人人猎成功招到高级 Android、php等人才。</p>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="dis_box">
                                                    <div class=" dis_box orient aligncenter">
                                                        <dl class="dis_box orient aligncenter">
                                                            <dt><img src="/Public/images/exc.png" alt=""></dt>
                                                            <dd><h5>E洗车</h5></dd>
                                                            <dd><p>致力于为广大车主提供24小时预约上门洗车，搭建移动互联网“e洗车”全国平台。在人人猎成功招到前端开发、Android等人才。等人才</p>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                    <div class=" dis_box orient aligncenter" style="margin-right:1%;">
                                                        <dl class="dis_box orient aligncenter">
                                                            <dt><img src="/Public/images/hqw.png" alt=""></dt>
                                                            <dd><h5>好巧网</h5></dd>
                                                            <dd><p>好巧网是国内最好用的国际酒店搜索网站之一，专注服务于自助出境的游客。在人人猎成功招到php工程师等人才。</p>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="dis_box">
                                                    <div class=" dis_box orient aligncenter">
                                                        <dl class="dis_box orient aligncenter">
                                                            <dt><img src="/Public/images/jsjy.png" alt=""></dt>
                                                            <dd><h5>金色家园</h5></dd>
                                                            <dd><p>由江苏省同科投资集团投资总注册资金1亿元人民币。通过人人猎成功招到O2O总经理等人才。</p>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                    <div class=" dis_box orient aligncenter" style="margin-right:1%;">
                                                        <dl class="dis_box orient aligncenter">
                                                            <dt><img src="/Public/images/hyd.png" alt=""></dt>
                                                            <dd><h5>好运道</h5></dd>
                                                            <dd><p>好运到是一家专注于大数据移动医疗的初创公司。在人人猎成功招到合伙人、Android等人才。</p>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="dis_box">
                                                    <div class=" dis_box orient aligncenter">
                                                        <dl class="dis_box orient aligncenter">
                                                            <dt><img src="/Public/images/xy-logo.png" alt=""></dt>
                                                            <dd><h5>新游</h5></dd>
                                                            <dd><p>新游是一家至力于全球游戏分发领域的创新公司。产品：游戏下载平台。创始人：丁春妹 ，前 百度高管。通过人人猎平台成功招到了java 、Android、ui、php等人才。</p>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                    <div class="dis_box orient aligncenter" style="margin-right:1%;">
                                                        <dl class="dis_box orient aligncenter">
                                                            <dt><img src="/Public/images/md-logo.png" alt=""></dt>
                                                            <dd><h5>摩德</h5></dd>
                                                            <dd><p>我们不仅仅是一支IT服务团队，同时也是数字化营销团队。我们汇集了经验丰富的电商服务精英、满怀激情的软件精英、设计精英，与客户共同应对艰巨的市场挑战。通过人人猎平台成功招到了php、Android等人才。</p>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="dis_box">
                                                    <div class=" dis_box orient aligncenter">
                                                        <dl class="dis_box orient aligncenter">
                                                            <dt><img src="/Public/images/sdj-logo.png" alt=""></dt>
                                                            <dd><h5>少东家</h5></dd>
                                                            <dd><p>少东家是专注于电子商务平台的一家初创公司，创始团队的核心成员来自BAT，公司发展迅猛，马上进入A轮融资。通过人人猎平台成功招到了PHP等职位。</p>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                    <div class=" dis_box orient aligncenter" style="margin-right:1%;">
                                                        <dl class="dis_box orient aligncenter">
                                                            <dt><img src="/Public/images/xhh-logo.png" alt=""></dt>
                                                            <dd><h5>先花花</h5></dd>
                                                            <dd><p>“先花一亿元”是先花信息技术（北京）有限公司继先花花App后，推出的一款面向年轻人的社交金融服务平台，是一款代表互联网金融未来发展趋势的创新产品。通过人人猎平台成功招到了ios等职位。</p>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wap2 date_wap"></div>
                                    <div class="wap2 date_wap">
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

  
                                        <nav>
                                            <ul class="dis_box">
                                                <li class="flex m cur">人人猎介绍</li>
                                                <li class="flex cur">招聘方介绍</li>
                                                <li class="flex cur">推荐人介绍</li>
                                            </ul>
                                        </nav>
                                        <div id="cn1" class="cn1 dis_none flex">
                                            <div class="posit">
                                                <div class="div-img">
                                                    <img src="/Public/images/about-head.png" alt="">
                                                </div>
                                                <div class="div-img">
                                                    <img src="/Public/images/about-banner.png" alt="">
                                                </div>
                                                <p class="rrl-js"><em>人人猎</em><span>是中国最有效的优质互联网创业企业人才极速直招平台。她让企业在<i>7</i>天内搞定招聘需求、<b>招到</b>靠谱的人；既让猎头、HR、知名公司的面试官等推荐人暂不使用的简历得以轻松变现，又让中高端候选人快速找到<b>匹配</b>的工作。</span></p>

                                                <p class="rrl-js"><em>人人猎</em><span>核心团队由来自百度、搜狐等知名互联网公司的互联网资深人士，及有10多年猎头从业经验的人才招聘行业专家组成。</span></p>

                                                <p class="rrl-js"><em>人人猎</em><span>成立之初，相继获得知名投资人的种子资金和天使轮投资。人人猎以“简单、诚实、可靠”为企业理念，以“避免互联网创业企业长久招不到靠谱的人而受损失，帮助候选人加入最匹配的团队，<b>让猎头和HR等推荐人的每个面试都有现金回报</b>”为宗旨，以追求“极佳效果和服务”为始终如一的目标。</span></p>
                                                <div class="div-img">
                                                    <img src="/Public/images/about-foot.png" alt="">
                                                </div>
                                            </div>
                                        </div>

                                        <div id="cn2" class="cn2 dis_none flex">
                                            <div class="posit">
                                                <h3>招聘方介绍</h3>
                                                <h4>招聘方拥有广泛的推广渠道 -- 极速</h4>
                                                <p>你的每个招聘需求都有1000+ 个潜在的推荐人可能推荐匹配的候选人<br>
                                                    ①别家公司的HR推荐已离职的前同事<br>
                                                    ②猎头推荐为某一岗位寻访的其他候选人<br>
                                                    ③社会人士推荐Ta的朋友和家人
                                                </p>
                                                <h4>招聘方的招聘总成本较低 --适价</h4>
                                                <h4>1.你可以用500元快速找到一名普通职员，成本比“普通招聘网站”还低</h4>
                                                <p>经统计，6-8份简历中会有一人参加面试，5名面试人中选择一人入职，3个月后该员工仍在岗的概率为90% [网站简历购买15元/份] <br>招聘网站每名普通职员招聘成本 = 6 ×5 × 15 ÷ 90% = 500元<br>比较： 人人猎的推荐人熟悉被推荐人，匹配度和留职率远高于下载简历式的招聘。
                                                </p>
                                                <h4>2.你仅需员工年薪的3-5%便可招到合适管理人员及核心员工</h4>
                                                <p>经统计，猎头招聘管理人员或核心员工招聘周期往往会超过1个月，收取年薪20-30%的招聘费。<br>比较： 费率大幅节省，且招聘速度更快。</p>
                                                <h4>3.批量招聘优势明显</h4>
                                                <p>经咨询，猎头公司和招聘公司短期内批量招聘（如销售代表等职位）较难招齐<br>
                                                    经询价，普通岗位批量招聘单人成本为： 猎头3000元+ 招聘公司 1500元+<br>
                                                    比较： 批量招聘成本更低、推荐源更广、速度更快</p>
                                            </div>
                                        </div>

                                        <div id="cn3" class="cn3 dis_none flex">
                                            <div class="posit">
                                                <h3>人人猎为推荐人提供“熟人资源”的变现通道</h3>
                                                <h4>公司HR? -- 低工资外的补贴</h4>
                                                <p>每月将你公司离职同事择机销售，既让各公司间人才良性流动、还让HR的资源变现</p>

                                                <h4>1.猎头？ -- 搜寻的候选人“物尽其用”</h4>
                                                <p>为某猎头职位寻访数十人，除至多一人成功入职外的其他人还可以便宜“甩卖”</p>
                                                <h4>其他？ - 卖老公、卖朋友攒钱买Iphone</h4>
                                                <p>我朋友很牛X，Ta正在看新的工作机会，我“卖Ta”赚一笔，人缘也是钱<br>人人猎为推荐人设计了周全的保密措施</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wap4 date_wap">
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

  
                                        <nav>
                                            <ul class="dis_box">
                                                <li class="flex m cur">推荐人协议</li>
                                                <li class="flex cur">招聘方协议</li>
                                            </ul>
                                        </nav>
                                        <div class="yhxy">
                                            <div class="xy_scrol1 aa flex">
                                                <div class="xy1">
                                                    <h3>人人猎平台“推荐人”用户协议</h3>
                                                    <p>1. “人人猎”：指人人猎网站（www.renrenlie.com)，及微信版、WAP 版、及iOS版和Android版（合称“本平台”）。<br>
                                                        2. “推荐人”：指注册成为人人猎平台的用户，并将身边正寻找工作机会的合适人才推荐给人人猎平台的招聘方的个人。
                                                    </p>
                                                    <h3>二、 注册</h3>
                                                    <p>1. 注册条件：无须你有华丽的过往工作经历和教育背景，只要你有合适的候选人可供推荐给招聘方，你便可注册成为速本平台的推荐人用户并开始为招聘方推荐合适候选人。<br>
                                                        <b>推荐对象：你面试过的候选人、你的前同事、你的家人、你的同学、你的朋友</b><br>
                                                        2. 注册信息：为了进一步提升你推荐信息的可信度、及更好的使用本平台，请尽可能完整的填写你的个人信息<b>（除法律法规要求外，本平台承诺在任何情况下不透露给任何招聘方、第三方机构或第三方个人）。</b><br>3. 身份信息：<b>注册时请填写你的真实中文姓名，该姓名作为你推荐成功后领取推荐金的唯一收款人信息；</b>注册时请填写你的真实联系方式，包括但不限于手机、微信和邮箱，以便本平台及招聘方可及时与你沟通候选人的推荐事宜。<br>
                                                        4. 用户昵称：<b>本平台为了尽可能的对推荐人真实身份保密，不主动对招聘方透露推荐人的真实姓名，招聘方只能看到推荐人的昵称。若推荐人不希望自己真实姓名被招聘方知晓，注册时请使用你的昵称。</b>
                                                        5. 信息变更: 为了尽可能保障推荐人顺畅使用本平台（包括但不限于招聘方需与推荐人沟通推荐事宜等），当推荐人自身信息或被推荐人信息发生重大变化、及信息错误时，请推荐人用户及时在本平台更新和修正。<br>
                                                        6. 身份保密：本平台将尽最大可能对推荐人身份保密，招聘方无法主动搜索推荐人信息，也无法主动搜索候选人的信息。<br>
                                                        7. 注册承诺：推荐人一旦成功注册成为本平台推荐人用户，即可合理、合法享受本平台的相关服务，但同时需遵守本平台的相关制定和规定、遵守国家相关法律和法规。<br>
                                                        推荐人用户恶意破坏本平台相关制度和规定的，本平台有权中止及终止推荐人用户使用人人猎平台相关服务；若推荐人用户行为触犯国家法律和法规的，及给本平台造成重大损失的，本平台有权追究其法律责任。
                                                    </p>
                                                    <h3>三、 推荐候选人</h3>
                                                    <p>1. 推荐流程<br>
                                                        <img src="/Public/images/liuchen2.png" alt=""><br>
                                                        2. 推荐信息 ：推荐人搜索招聘岗位后，发现有合适的候选人向招聘方推荐时，请准确、真实、尽可能完整的填写候选人的信息；<b>且在将候选人信息提交给招聘方前，请确保候选人的求职意愿及求职状态与该招聘岗位的岗位要求一致。</b>
                                                        3. 严禁恶意推荐：推荐人用户必须对所推荐的候选人求职状况非常了解，不得出现以下恶意推荐情况。<br>
                                                        1）候选人根本无求职需求；<br>
                                                        2）完全不了解候选人，所填写的候选人信息严重失实；<br>
                                                        3）未取得候选人的被推荐许可。<br>
                                                        若推荐人用户出现以上恶意推荐情况，本平台有权中止、及终止推荐人用户使用本平台任何服务的权利；若推荐人用户的恶意行为触犯国家相关法律法规的，推荐人用户将承担相关法律责任。<br>
                                                        4. 推荐进程： 推荐人用户应及时查看已推荐候选人的进度，并在推荐进度终了或终止前保持联系方式通畅；若招聘企业及本平台需适当了解<b>与本次推荐相关的候选人相关信息时</b>，推荐人需提供必要的支持（推荐人可拒绝配合提供与本次推荐无关的任何信息）。
                                                    </p>
                                                    <h3>四、推荐报酬</h3>
                                                    <p>1. 推荐报酬：当候选人成功入职后，<b>推荐人需通知人人猎客服向招聘方a收款</b>，招聘方应按约付款到本平台，本平台向招聘方开具发票或收据，本平台收到招聘方的招聘费后<b>2个工作日</b>内将推荐金转付给推荐人用户；若推荐人用户在招聘方付款后<b>3个工作日</b>未收到推荐金的，请及时与本平台客服人员联系。<br>
                                                        <b>若候选人入职后招聘方迟迟未付招聘费，推荐人用户应配合本平台提供候选人入职的相关证明、以便本平台配合推荐人用户向招聘方催收招聘费。</b><br>
                                                        2. 个税处理：推荐人用户推荐的候选人成功入职后，本平台代推荐人用户向招聘方收取推荐金后将网站约定的推荐金转付给推荐人用户，本平台无法获取推荐人用户除姓名外的更多个人隐私信息，也无法代扣个人所得税及进行纳税申报；若推荐人用户需申报或缴纳与推荐金相关的个税，请推荐人用户自行申报缴纳。<br>
                                                        3. 收款信息：本平台将代收的推荐费支付给推荐人用户资料中的真实姓名所对应的银行账户，若推荐人用户银行账户发生变更、推荐人用户需及时在本平台修改银行账户信息。<br>
                                                        <b>为尽可能保证推荐人用户的收款安全，一经注册且填写真实姓名的推荐人用户后续更改真实姓名后可能导致无法收款，请推荐人用户在推荐前用改名后的真实姓名重新注册新账号并进行推荐；若在推荐过程中出现更名，且推荐最终成功需收推荐金的，推荐人用户应提供相关证身份明方可通过本平台手工提取推荐金。</b>
                                                    </p>
                                                    <h3>五、隐私及保密条款</h3>
                                                    <p>1. 不收集个人终端信息：本平台承诺不收集推荐人用户在人人猎平台操作记录以外的信息。<b>本平台承诺不收集推荐人用户使用计算机的IP地址、网络服务提供者的IP地址、登录终端的ID及Cookies。</b><br>
                                                        2. 用户账号保密：推荐人用户对自己的用户名和账号保密，不授权给其他任何可能导致账号出现的风险的第三方使用自己的账号。<br>
                                                        3. 暂停风险账号：本平台合理怀疑用户必要信息为错误、不实或不完整时，有权暂停或终止用户的账号；若推荐人用户利用本平台非法牟利的，本平台有权追索用户的不当得利并追究相关的法律责任。
                                                    </p>
                                                    <h3>六、说明</h3>
                                                    <p>1. 协议更新：本协议发生更新的，自新版协议在本平台发布时起生效，新版协议与本协议不一致的以最新发布协议中相关条款为准；若推荐人用户不同意新版协议的，可自行放弃使用本平台。<br>
                                                        2. 协议生效：推荐人用户成功注册成为本平台用户时，本协议自动生效，视为用户已完全接受本协议及本平台相关管理制度和规定。<br>
                                                        3. 解释权：本协议解释权归本平台所有。
                                                    </p>
                                                </div> 
                                            </div>
                                            <div class="xy_scrol2 aa flex">
                                                <div class="xy1">
                                                    <h3>甲方： 北京众聘科技有限公司</h3>
                                                    <p>地址： 北京市海淀区上地信息路28号上地信息大厦A座7层<br>
                                                        联系人：Jason（潘）<br>
                                                        联系电话：010 - 62669180 <br>
                                                        联系邮箱：Jason@renrenlie.com
                                                    </p>
                                                    <h3>乙方：</h3>
                                                    <p>地址：<br>
                                                        联系人：<br>
                                                        联系电话：<br>
                                                        联系邮箱：<br>
                                                        &nbsp&nbsp&nbsp&nbsp甲方拥有和运营人人猎平台，本协议中人人猎平台和甲公司是同一主体；乙方指本协议的招聘方用户，本协议中招聘方用户（或招聘方）和乙方是同一主体。<br>
                                                        甲、乙双方经友好协商，达成本协议以下条款。</p>
                                                    <h3>一、 定义</h3>
                                                    <p>1. “人人猎”：指人人猎网站（www.renrenlie.com)，及微信版、WAP 版、iOS版和Android版（合称“人人猎平台”， 后称“本平台”）。<br>
                                                        2. “招聘方”：指注册成为人人猎平台的用户，并经所在公司或机构授权在人人猎平台发布招聘需求的公司用户、机构用 户或公司和机构授权以招聘方身份注册的个人。</p>
                                                    <h3>二、 注册</h3>
                                                    <p>1. 注册条件：a)<br> 
                                                        乙方公司或乙方授权注册成为人人猎平台的招聘方用户；<br>
                                                        b) <b>注册时无需提供公司证明文件，但首次发布招聘需求信息时需上传完整的公司证明文件（加盖公章的营业执照复印件和本协议，合称“公司证明文件”）后，招聘需求信息才能在人人猎平台成功发布。</b><br>
                                                        本平台对招聘方用户提供的资料保密。<br>
                                                        2. 注册信息：<br>
                                                        a)成功注册成为本平台的招聘方用户后，请及时登录并完善公司基本信息，并确保公司信息真实完整；<br>
                                                        b) 招聘方用户的公司信息（包括但不限于公司基本信息、联系方式等）发生变化后请及时在本平台更新相关信息。<br>
                                                        3. 身份信息：<br>
                                                        a) 招聘方公司名字必须正确真实填写，公司名字一经填写确认后不可自行修改；<br>
                                                        b) 为避免广大推荐人不当联系招聘用户，公司联系方式仅作为本平台与招聘方沟通协调时使用及其他必要情况使用，此外、本平台承诺对招聘方用户的联系电话保密、暂不对广大推荐人公开。<br>
                                                        3. 注册承诺：招聘方用户一旦成功注册成为本平台用户，即可合理、合法享受本平台的相关服务，但同时需遵守本平台的相关制定和规定、遵守国家相关法律和法规。<br>
                                                        若招聘方用户恶意破坏本平台相关制度和规定的，本平台有权中止、及终止用户使用本平台相关服务；若用户行为触犯国家法律和法规的，及给本平台造成重大损失的，本平台有权追究相关法律责任。</p>
                                                    <h3>三、 流程</h3>
                                                    <p>1. 招聘流程：<br>
                                                        <img src="/Public/images/liuchen2.png" alt=""><br>
                                                        2. 发布职位 ：招聘方发布招聘信息时，需完整和清晰的填写工作地点、工作职责、任职资格、薪酬待遇等方便推荐人匹配被推荐人的必要岗位信息；并同时填写推荐费，推荐费一经设定、不得修改。<br>
                                                        3. 推荐费：推荐费为招聘方为招到合适候选人后付费给本平台的费用。<br>
                                                        4. 管理候选人：<br>
                                                        1）简历筛选：招聘方决定不予面试或面试不通过的候选人，请对其状态确认为“不面试”或“面试不通过”，不面试或面试不通过情况下、企业需真实标注候选人不合适的原因；<br>
                                                        2）面试进程：当被推荐人进入面试流程后，招聘方需及时在本平台更新候选人的进度和状态，即“面试邀请”、“面试不通过”、“通过面试”和“已入职”，<b>招聘方用户需在被推荐人状态发生变化后2个工作日内对被推荐人状态在本平台做更改处理；若招聘方未及时对“面试通过”和“已入职”的候选人的状态进行及时标注、导致候选人又被推荐给其他企业从而错失候选人的，本平台不予承担任何责任。</b> <br>
                                                        3） 招聘方需进一步了解候选人相关信息时，招聘方可联系本平台或推荐人，推荐人和本平台有义务尽力配合招聘方合理的信息需求。
                                                        <br><b>5. 付招聘费</b><br><b>1）招聘方需在候选人成功入职后7个工作日内将本职位的推荐费（发布招聘时确认的推荐金，参见本协议“第三条的第3条"）足额支付给本平台。</b><br>
                                                        <b>本平台收款信息为：</b><br><b>收款人： 北京众聘科技有限公司</b><br>
                                                        <b>收款行： 中国建设银行北京上地支行</b><br>
                                                        <b>银行帐号：1100 1045 3000 5302 8404</b><br>
                                                        <b>付款时请在“付款摘要”中写清招聘方公司名、本次付款对应的职位</b>
                                                        2）本平台收到招聘费后2个工作日内会将该职位的推荐金支付给推荐人；<br>
                                                        3） 若招聘方实际招到人数多于该岗位的计划招聘人数，招聘方需根据实际入 职人数、以本岗位发布的招聘费为基础进行付费（即总招聘费 = 实际招到人 数 × 该岗位发布的招聘费）；<br>
                                                        4） 若被推荐人在某招聘周期内未通过面试，但招聘方在面试之日起6个月内 重新录用该候选人的，视为推荐人成功推荐，招聘方应在候选人成功入职之 日起7 个工作日内支付招聘费。<br>
                                                        5）招聘方不得拖延支付、无故拒付推荐费，<b>本平台有合理证据证明招聘方故 意拖延支付、无故拒付推荐费的，本平台有权依本协议之约定采用法律手段向 招聘方追偿，且可将故意拒付应付推荐费的事宜在本平台显著位置公示、并立 即终止该招聘方用户使用本平台一切服务的权利。</b><br>
                                                        6. 发票开具<br>
                                                        1）金额：本平台向招聘方全额开具“服务费”发票；<br>
                                                        2）增值税专用发票： 若招聘方需开具增值税专用发票，招聘方应向本平台提 供开具增值税专用发票的必要资料。
                                                    </p>
                                                    <h3>四、发布招聘信息</h3>
                                                    <p>1. 完整性。招聘方<b>产生真实招聘</b>需求后，可随时在本平台发布真实的。招聘信息至少包括该岗位的行业类别、职位名称、薪资待遇、工作地点、招聘截止日期、招聘人数、工作职责、岗位要求和招聘费等便于推荐人做出合理推荐决策的必要信息。<br>
                                                        2. 真实性。<b>招聘方必须保证发布的信息真实无误</b>，成功入职后的候选人的相关工作事宜需严格遵守招聘信息之约定（包括但不限于不得提供比招聘信息中列明的薪酬待遇更低的实际薪资待遇等）。<br>
                                                        3. 招聘信息管理。<b>招聘方发布招聘信息后对可结合招聘进展对相关信息进行修改，但不得修改工作地点，薪资待遇、招聘资费只能调高不能调低。若招聘过程候中调高薪资待遇和招聘费的，选人成功入职后按调高后的最终薪资待遇和招聘资费执行。</b></p>
                                                    <h3>五、招聘方权利义务</h3>
                                                    <p>1. 招聘方注册成为本平台的用户后，有权在遵守国家相关法律、遵守本平台相 相关规定前提下正常使用本平台并享受本平台的相关服务。<br>
                                                        2. 招聘方应遵循诚实、信用原则，及时支付招聘费。<br>
                                                        3. 招聘方应给予成功入职的候选人与发布的职位信息相一致的薪酬待遇。<br>
                                                        4. 招聘方应对通过本平台获取的被推荐人和推荐人的相关信息保密，不得透露给其他任何第三人；因招聘方严重不当使用被推荐人和推荐人的相关信息的，推荐人、被推荐人和本平台均有权要求招聘方赔偿相关直接经济损失。</p>
                                                    <h3>六、隐私及保密条款</h3>
                                                    <p>1. 不收集个人终端信息：本平台不收集招聘方用户在人人猎平台操作记录以外的信息。 本平台承诺不收集用户使用计算机的IP地址、网络服务提供者的IP地址、登录终端的ID及Cookies。<br>
                                                        2. 用户账号保密：招聘方用户对自己的用户名和账号保密，不授权给其他任何可能导致账号出现的风险的第三方使用自己的账号。<br>
                                                        3. 风险账号暂停：本平台合理怀疑招聘方用户必要信息为错误、不实或不完整的，有权暂停或终止招聘方用户的账号；若招聘方用户利用本平台非法牟利的，本平台有权追索用户的不当得利并追究相关的法律责任。</p>
                                                    <h3>七、说明</h3>
                                                    <p>1. 协议更新：本协议发生更新的，自新版协议在本平台发布时起、新版协议与本协议不一致的以最新发布协议中相关条款为准；若用户不同意新版协议的，可自行放弃使用本平台。<br>
                                                        2. 协议生效：招聘方用户成功注册成为本平台用户时，本协议自动生效，视为招聘方用户已完全接受本协议及本平台相关管理制度和规定。<br>3. 解释权：本协议解释权归本平台所有。</p>
                                                </div>  
                                            </div>

                                        </div>
                                    </div>
                                    <div class="wap5 date_wap">
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

  
                                        <div class="ys">
                                            <div class="scrol">
                                                <h3>人人猎用户隐私协议</h3>
                                                <p>人人猎网郑重提醒您：在您使用人人猎网的各项服务前，请您仔细阅读并对本声明全部内容认可。<br>
                                                    任何单位或个人认为人人猎网网页内容可能涉嫌侵犯其合法权益的，请您应该及时向人人猎网提出书面通知（邮件或快 递），并提供身份证明、权属证明、具体链接（URL）及详细侵权情况证明。我们收到上述法律文件后，将会尽快依法处 理。<br>
                                                    本《法律声明》为《推荐人用户协议》和《招聘方用户协议》的组成部分。</p>
                                                <h3>隐私声明</h3>
                                                <p>人人猎网尊重并保护所有使用人人猎网服务用户的个人隐私权。 您一旦注册成功，就成为本站的合法用户，将得到一个用户名和密码。您需保管好自己的账户和密码。除非事先得到您的许可外，人人猎网不向任何无关第三方提供、出售、出租、分享或交易您的个人信息。同时，由于人人猎网无法对非法或未经用户授权使用用户账号及密码之行为进行甄别，您需对专属之账号和密码项下所有行为和事件负责，人人猎网不承担任何责任。若您发现您的账户存在安全漏洞或被未授权使用时，请立即通告人人猎网，我们将尽最大努力协助您阻止损害结果发生。<br>
                                                    <b>一、隐私保护范围：</b><br>
                                                    1.  您注册人人猎网账户时，您根据人人猎网要求提供的个人注册信息；<br>
                                                    2.  您了解并同意，以下信息不适用本隐私权政策：<br>
                                                    a.  您在使用人人猎网提供的搜索服务时输入的关键字信息；<br>
                                                    b.  人人猎网收集到的您在人人猎网进行活动的有关数据；<br>
                                                    c.  违反法律规定或违反人人猎网服务协议的行为，包括单不限于行政、司法等机构依法调取及在人人猎网从事违法活动被人人猎网处理的行为。<br>
                                                    <b>二、隐私披露范围：</b><br>
                                                    在以下情况下，人人猎网将依据您的个人意愿或法律的规定全部或部分的披露您的个人信息：<br>
                                                    1.  您事前同意后，向第三方披露；<br>
                                                    2.  为享受第三方提供的产品和服务，需和第三方分享您的必要的个人信息；<br>
                                                    3.  行政、司法机构依法要求要求，需向第三方或者行政、司法机构披露；<br>
                                                    4.  如您出现违反法律规定或者人人猎网服务协议，需要向第三方披露。<br>
                                                    <b>三、个人信息妥管</b><br>
                                                    您使用人人猎网时，您可能需要向本平台的其他相关方提供相关信息，如联络方式或地址等，在您提供相关个人信息时请审慎的向他人提供。若您发现自己的个人信息泄密，尤其是人人猎网账户及密码发生泄露，请您立即联络人人猎网客服，人人猎网将协助您尽可能阻止损失的进一步扩大。</p>
                                                <h3>知识产权声明</h3>
                                                <p><b>一、人人猎网版权</b><br>
                                                    人人猎网拥有本网站内所有内容的版权。未经人人猎网书面许可，不得转载或用于其它商业用途。<br>
                                                    <b>二、用户知识产权</b><br>
                                                    为更好的服务全体用户，用户在人人猎网上发表的任何形式的信息的著作财产权无偿独家转让给人人猎网，著作财产权包括但不限于：复制权、发行权、出租权、展览权、表演权、放映权、广播权、信息网络传播权、摄制权、改编权、翻译权、汇编权以及应当由著作权人享有的其他可转让权利。任何第三方使用人人猎网内容需事前征得人人猎网书面同意。 用户确认并明确了解，用户的在人人猎网的发表的各类信息一旦违反法律规定和人人猎网相关规定时，人人猎网保留不通知用户而删除相关违规信息的权利。<br>
                                                    <b>三、使用许可</b><br>
                                                    未经人人猎网的明确书面许可，任何单位或个人不得以任何方式，全部和局部复制、转载、引用和链接人人猎网信息，否则人人猎网将保留追究其法律责任的权利。</p>
                                                <h3>不当得利</h3>
                                                <p>人人猎网合理怀疑用户资料信息为错误、不实、失效或不完整，本网站有权暂停或终止用户的账号，若用户用不真实信息人人猎网合理怀疑用户借助人人猎网非法牟利，本网站将保留追究其法律责任的权利。</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wap6 date_wap">
                                        <div class="ys2">
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

  
                                            <div class="scrol">
                                                <h3>联系我们：</h3>
                                                <p style="margin-bottom:10px;">客服热线：<br>
                                                    400 - 668 - 5596 <br>
                                                    服务时间：8：00-18：00</p>
                                                <p style="margin-bottom:10px;">客服邮箱：<br>
                                                    service@renrenlie.com</p>
                                                <p style="margin-bottom:10px;">业务合作：<br>
                                                    friend@renrenlie.com</p>
                                                <p style="margin-bottom:10px;">用户建议：<br>
                                                    suggestion@renrenlie.com</p>
                                                <p style="margin-bottom:10px;">联系QQ <br>
                                                    人人猎官方群：  391438289 <br>
                                                    人人猎客服群：  415742764 <br>
                                                    Android群：  227231209 <br>
                                                    php群：  434127977 <br>
                                                    iOS群：  422877348 <br>
                                                    pm群：  188499425 <br>
                                                    前端群：  432563432 <br>
                                                    Java：  422804023
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(function () {
                                        if ("<?php echo $isshow?>" == "1") {
                                            $(".index_con").animate({
                                                '-webkit-transform': 'translate(85%,0)'
                                            }, 400);
                                            setTimeout(function () {
                                                var myScroll1 = new IScroll('.wap', {mouseWheel: true, click: true});
                                            }, 200)
                                            $(".left_nav").show();
                                        }
                                        var page = 2;
                                        var number = 10;

                                        function myajax(page, number, condition) {
                                            if(typeof condition == "undefined"){
                                                condition = "";
                                            }
                                            $.ajax({
                                                type: 'POST',
                                                url: '/index.php?s=/Index/get_job_list',
                                                data: 'page=' + page + '&number=' + number + "&condition=" + condition,
                                                dataType: 'json',
                                                success: function (data) {

                                                    if (data.count == 0) {

                                                        $(".load-more").css("display", "none");
                                                        $(".load-more-end").css("display", "none");
                                                        $('.myajs').append("<div style='width: 90%;height: 30px;line-height: 30px;text-align:center;font-size: 14px;margin:10px auto;'>暂无数据</div>");
                                                        return;
                                                    }
                                                    if (data.count <= (page - 2) * 10) {

                                                        $(".load-more").css("display", "none");
                                                        $(".load-more-end").css("display", "block");
                                                        return;
                                                    }
                                                    var data = eval(data['result']);
                                                    $.each(data, function (i, val) {
                                                        var str = '';
                                                        str = '<a href="/index.php?s=/Job/job_detail_new/jobid/' + val.id + '">'
                                                                + '<ul class="latest-position">'
                                                                + '<li class="clearfix lis1">'
                                                                + '<div class="fl-lef dis-inlin">'
                                                                + '<em class="fl-lef dis-inlin dis-block">' + val.title + '</em>'
                                                                + '</div>'
                                                                + '<div class="fl-rig dis-inlin">'
                                                                + '<em class="fl-lef dis-inlin dis-block">' + val.treatmentdata + '</em>'
                                                                + '</div></li><li class="clearfix lis1">'
                                                                + '<div class="fl-lef dis-inlin r">' + val.cpname + '</div>'
                                                                + '<div class="fl-rig dis-inlin r">'
                                                                + '<span class="fl-lef dis-inlin dis-block">' + val.cascname + '</span>'
                                                                + '</div>'
                                                                + '</li>'
                                                                + '<li class="clearfix lis2">'
                                                                + '<div class="fl-lef dis-inlin">'
                                                                + '<span class="fl-lef dis-inlin dis-block">' + val.experiencedata + '</span>'
                                                                + '<span class="fl-lef dis-inlin dis-block">' + val.educationdata + '</span>'
                                                                + '<span class="fl-lef dis-inlin dis-block">' + val.scaledata + '</span>'
                                                                + '</div>'
                                                                + '<div class="fl-rig dis-inlin"></div>'
                                                                + '</li>'
                                                                + '<li class="clearfix lis3">'
                                                                + '<em class="fl-lef dis-inlin">候选人入职，你即得奖励￥' + val.Tariff + '</em>'
                                                                + '<span class="fl-rig dis-inlin">' + val.starttime + '</span>'
                                                                + '</li>'
                                                                + '</ul> '
                                                                + '</a>';
                                                        $('.myajs').append(str);
                                                    })
                                                }
                                            });
                                        }

                                        $(".load-more").click(function () {
                                            setTimeout(function () {
                                                $(".load-more").text("点击加载更多");

                                                setTimeout(function () {
                                                    $(window).resize();
                                                }, 2500);
                                                page++;
                                            }, 1000);
                                            myajax(page, number);
                                            $(this).text("正在加载中.....");
                                        });
                                        $(".scrol-top").click(function () {
                                            $(".back-top").animate({
                                                '-webkit-transform': 'translate(0,0)'
                                            }, 400);
                                            setTimeout(function () {
                                                var myScroll1 = new IScroll('.wap', {mouseWheel: true, click: true});
                                            }, 200)
                                        })
                                        //搜索处理
                                        $("#search").click(function () {
                                            var search_input = $.trim($("#search_input").val());
                                            if (search_input == "") {
                                                location.reload();
                                                return;
                                            }
                                            $('.myajs').html("");
                                            setTimeout(function () {
                                                $(window).resize();
                                            }, 1000)
                                            $(".load-more").css("display", "block");
                                            $(".load-more-end").css("display", "none");
                                            page = 1;
                                            myajax(page, number, search_input);
                                            page++;

                                        })
                                    });
                                </script>
                                <script src="/Public/js/swiper.min.js"></script>
                                <!-- Initialize Swiper -->
                                <script>
                                    var swiper = new Swiper('.swiper-container', {
                                        pagination: '.swiper-pagination',
                                        nextButton: '.swiper-button-next',
                                        prevButton: '.swiper-button-prev',
                                        slidesPerView: 1,
                                        paginationClickable: true,
                                        spaceBetween: 30,
                                        loop: true,
                                        autoplay: 3000,
                                        autoplayDisableOnInteraction: false
                                    });
                                </script>
                                </body>
                                </html>