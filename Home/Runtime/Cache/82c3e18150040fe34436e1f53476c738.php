<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>com-index</title>
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
		.com-list input{
			background: #dff1ff;
		}
    </style>
</head>
<body>
	<div class="mask" style="display:block"></div>
	<div class="com-alt srdz-alt" style="display:block">
		<a href="javascript:void(0);" class="clos"></a>
		<div class="srdz-head">
			温馨提示
		</div>
		<div class="srdz-con">
			<p>您成功创建了简历，请在pc端上传附件简历，在设定的联系时间内，保持手机畅通，人人猎会根据您的简历匹配合适的工作，并与您联络。</p>
		</div>
		<span class="btn" style="margin-top:10px;">确定</span>
	</div>
	<header class="com-head fixed">
		<div class="con">
			<span class="l dis-block"></span>
			<span class="c dis-block">完善资料</span>
			<span class="r dis-block"></span>
		</div>
	</header>
	<p class="error">对不起您填写的信息有误，请重新填写</p>
	<div class="wrap">
		<ul id="nav" class="nav">
		    <li><a href="#"><span class="sp0 sp0_2"></span><b class='m'>完善资料</b></a></li>
		    <li><a href="#"><span class="sp1"></span><b>签订合同</b></a></li>
		    <li><a href="#"><span class="sp2"></span><b>发布职位</b></a></li>
		    <li><a href="#"><span class="sp3"></span><b>查看候选人</b></a></li>
		    <li><a href="#"><span class="sp4"></span><b>入职管理</b></a></li>
		</ul>

		<section class="content m-content1" style="padding-bottom:20px;display:block;margin-top:1px;">
		<div class="srdz-banner"><img src="/Public/new-images/srdz-banner2.png" alt=""></div>
		<div class="srdz-text">
			<div class="clearfix">
				<span class="dis-block bt"><b>1</b>上传简历</span>
				<div class="clearfix"><span class="fl-lef ss"></span><em class="fl-lef">即日起， 凡在人人猎上传个人简历便可以参与“上传简历， 坐等收钱”活动；</em></div>
				<span class="dis-block bt"><b>2</b>简历要求</span>
				<div class="clearfix"><span class="fl-lef ss"></span><em class="fl-lef">在人人猎上传的个人简历要求同时满足 , 年薪10万以上的中高端互联网人才、正在看工作机会；</em></div>
				<span class="dis-block bt"><b>3</b>系统匹配</span>
				<div class="clearfix"><span class="fl-lef ss"></span><em class="fl-lef">人人猎系统自动检索与候选人匹配的工作机会 , 人人猎求职顾问与您沟通时先进行人工匹配合适职位 ;当有新发布的职位时，系统将为您自动匹配优质职位；</em></div>
				<span class="dis-block bt"><b>4</b>面试入职</span>
				<div class="clearfix"><span class="fl-lef ss"></span><em class="fl-lef">最多参加人人猎帮你安排的2-3次面试，即可offer,而且还可以拿到<b>几千、几万元</b>的推荐奖励。</em></div>
				<span class="ms">还等什么，快快上传简历吧</span>
			</div>
		</div>
		<div style="background:#dff1ff;padding:10px 0">
			<div>
				<span class="h3 dis-block">工作机会私人定制卡</span>
			</div>
			<div class="com-list">
				<div class="bd3">
					<div class="list"><em class="m">姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名：</em><input type="text" placeholder="请输入姓名，系统会对个人信息保密"></div>
				</div>
				<div class="bd3">
					<div class="list" id="com-size"><em class="m" style="width:60px;">手&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp机：</em><input class="wh100" type="text" placeholder="请输入手机号码"><span class="hqyzm hqyzm2">免费获取验证码</span></div>
				</div>
				<div class="bd3">
					<div class="list"><em class="m">验&nbsp&nbsp证&nbsp&nbsp码：</em><input type="text" placeholder="请输入验证码"></div>
				</div>
				<div class="bd3">
					<div class="list"><em class="m">上传简历：</em><span style="color:#2281b9;"><b>请在PC端上传附件简历</b></span></div>
				</div>
				<div class="bd3">
					<div class="list"><em class="m wh100">方便联系的时间：</em><input class="wh-55" type="text" placeholder="请输入方便与您联系的时间"></div>
				</div>
				<div class="bd3">
					<div class="list"><em class="m">其他说明：</em><input type="text" placeholder="请输入其他更多的要求"></div>
				</div>
			</div>
		</div>
		<div>
			<span class="btn">完成定制</span>
		</div>
			
		</section>
	</div>
	<script type="text/javascript">
    $(document).ready(function(){
			$("input").click(function(){
				if(document.activeElement.tagName == 'INPUT'){
					$(".fixed").css({'position': 'absolute','top':'0'}); 
				} else if(document.activeElement.tagName !== 'INPUT'){  
					$(".fixed").css('position', 'fixed');
				}
			})
			
    })
	
    //document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
    </script>
</body>
</html>