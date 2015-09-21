<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>人人猎</title>
	<link rel="stylesheet"  href="/Public/css/reset.css">
	<link rel="stylesheet"  href="/Public/css/wep.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/style.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="/Public/css/slider-pro.min.css" media="screen"/>
	<script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="/Public/js/jquery.sliderPro.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<meta content="black" name="apple-mobile-web-app-status-bar-style" />
	<meta content="telephone=no" name="format-detection" />
	<script type="text/javascript">
	$( document ).ready(function($) {
		$( '#example1' ).sliderPro({
			width: 640,
			arrows: true,
			buttons: true,
			waitForLayers: true,
			thumbnailWidth: 200,
			thumbnailHeight: 100,
			thumbnailPointer: true,
			autoplay: false,
			autoScaleLayers: false,
			breakpoints: {
				500:{
					thumbnailWidth: 120,
					thumbnailHeight: 50
				}
			}
		});
	});
</script>
</head>
<body>
<a name="top" id="top"></a>
<header class="headder">
		<a class="logo" href="http://m.renrenlie.com"><img src="/Public/images/wep_logo.png" alt=""></a>
		<ul>
			<a href="">登录</a>
			<span>|</span>
			<a href="">注册</a>
		</ul>
</header>
<div class="wapper">
	<section>
		<div class="slider clearfix">
			<div id="example1" class="slider-pro clearfix">
				<div class="sp-slides clearfix">
					<div class="sp-slide">
						<img class="sp-image" src="/Public/images/1.png" data-src="/Public/images/1.png" data-retina="/Public/images/1.png"/>
					</div>
					
					<div class="sp-slide">
						<img class="sp-image" src="/Public/images/2.png" data-src="/Public/images/2.png" data-retina="/Public/images/2.png"/>
					</div>
					
					<div class="sp-slide">
						<img class="sp-image" src="/Public/images/3.png" data-src="/Public/images/3.png" data-retina="/Public/images/3.png"/>
					</div>
				</div>
			</div>
		</div>
		<div class="sbanner">
			<span><img src="/Public/images/hd1.png" alt=""></span>
			<span><img src="/Public/images/hd2.png" alt=""></span>
			<span><img src="/Public/images/hd3.png" alt=""></span>
		</div>
		<h3><span>最新职位</span></h3>
		<div>
                        <?php if(is_array($result)): $k = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><dl>
				<dt class="top">
					<span class="l"><?php echo ($vo["title"]); ?></span>
					<span class="c"><?php echo ($vo["cpname"]); ?></span>
					<span class="r"><?php echo ($vo["treatmentdata"]); ?></span>
				</dt>
				<dd class="btom">
                                        <span><?php echo ($vo["posttimedata"]); ?></span>
					<span><?php echo ($vo["cascname"]); ?></span>
					<span><?php echo ($vo["experiencedata"]); ?></span>
					<span class="s">已推荐：<?php echo ($vo["recommendednum"]); ?></span>
					<span class="r"><?php echo ($vo["Tariff"]); ?></span>
				</dd>
			</dl><?php endforeach; endif; else: echo "" ;endif; ?>
                        
                        <div class="scrolltop" id="tp"><a href="#top">回到顶部</a></div>
			
		</div>
		
	</section>
</div>
	<footer>
		<h3>人人猎头</h3>
		<p><span>TEL:4006-685-596</span>&nbsp&nbsp&nbsp <span>京ICP备14040265号</span></p>
	</footer>
<script type="text/javascript" src="/Public/js/slider.js"></script>
</body>
</html>