<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn" style="background:#7fc6e3">
<head>
    <title>人人猎热血传奇时代，等你来！</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="full-screen" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="/Public/js/iscroll.js"></script>
    <link rel="stylesheet"  href="/Public/css/jin_2.css">
</head>
<body>

<div id="wrapper" style="background:#7fc6e3">
    <div id="scroller">
        <div id="thelist" style="background:#7fc6e3">
            <div id="thelist2" style="background:#7fc6e3">
                <div class="jrwm_t clearfix"><img src="/Public/images/jrwm1_t.png" alt=""></div>
                <div class="cn" style="padding-bottom:50px;">
                    <ul>
                        <a href="/index.php?s=/Job/new_job3"><li>
                            <p><span>线上新媒体推广</span></p>
                            <p><em>薪资待遇：</em><em>7K-12K</em><em>北京</em></p>
                        </li></a>
                        <a href="/index.php?s=/Job/new_job4"><li>
                            <p><span>线下活动策划执行</span></p>
                            <p><em>薪资待遇：</em><em>7K-12K</em><em>北京</em></p>
                        </li></a>
                        <a href="/index.php?s=/Job/new_job5"><li>
                            <p><span>高级UI设计师</span></p>
                            <p><em>薪资待遇：</em><em>10K-15K</em><em>北京</em></p>
                        </li></a>
                        <li class="clearfix"><a style="float:right;color:#1B5D95" href="http://www.renrenlie.com">返回首页</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="pullUp" style="display:none">
            <span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多...</span>
        </div>
    </div>
</div>
<div class="jrwm_b clearfix"><img src="/Public/images/jrwm1_b.png" alt=""></div>
<include file="Public:statistics">
<script type="text/javascript">
    document.addEventListener("touchmove", function (e) {e.preventDefault();}, false);
    setTimeout(function(){
        var myScroll = new IScroll('#wrapper', {mouseWheel: true, click: true});
    },200)
         
</script>
</body>
</html>