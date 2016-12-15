<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<title>蚁行租车</title>
		<script type='text/javascript' src='js/scripts/jquery-1.11.3.js'></script>
		<script type="text/javascript" src="js/aboutjs.js"></script>
		<link href="css/base.css" rel="stylesheet" media="all" />
		<link type='text/css' href='css/aboutSixListcss.css' rel='stylesheet' />
		<link type='text/css' href='css/aboutcss.css' rel='stylesheet' />
		<script type="text/javascript">
		$(function(){
			$("#container").switchPage({
				'loop' : true,
				'keyboard' : true,
				'direction' : 'horizontal'
			});
		});
		</script>
	</head>
	<body>
		<?php
        include 'head.php';
    ?>
		<div id="container">
			<ul id="pic_list">
				<li class="section active" id="section0">
					<div class="intro">
						<img src="../images/img/img_1.png"/>
						<h1 class="title">一键式下单</h1>
						<h1 class="title2">简单便捷</h1>
						<p>我们只为大学生提供服务，无门槛，免押金、免担保。</p>
					</div>
				</li>
				<li class="section" id="section1">
					<div class="intro">
						<img src="../images/img/img_2.png"/>
						<h1 class="title">告别零钱</h1>
						<h1 class="title2">健康出行与雾霾说Bye</h1>
						<p>相信智能的分时计费，会为您带来不同的出行乐趣，支持支付宝、微信支付，免去现金找零困扰。</p>
					</div>
				</li>
				<li class="section" id="section2">
					<div class="intro">
						<img src="../images/img/img_3.png"/>
						<h1 class="title">精准定位门店</h1>
						<h1 class="title2">掌握行程</h1>
						<p>我们竭尽全力给您带来优质的服务体验：筛选出距您最近的服务点还车，时间宝贵、免去多余行程。</p>
					</div>
				</li>
				<li class="section" id="section3">
					<div class="intro">
						<img src="../images/img/img_4.png"/>
						<h1 class="title">安全省心</h1>
						<h1 class="title2">风光出行 </h1>
						<p>电动车内配备GPS定位模块，实时更新车辆位置，不用担心车辆丢失的危险。</p>
					</div>
				</li>
				<li class="section" id="section4">
					<div class="intro">
						<img src="../images/img/img_5.png"/>
						<h1 class="title">智能供电</h1>
						<h1 class="title2">尽心骑行 安全放心 </h1>
						<p>电动车辆配备优质电池、极速闪充，80KM长续航，让您不用担心长途出游没电的苦恼。</p>
					</div>
				</li>
				<li class="section" id="section5">
					<div class="intro">
						<img src="../images/img/img_6.png"/>
						<h1 class="title">回顾行程</h1>
						<h1 class="title2">明确路线</h1>
						<p>您可以通过个人中心，查看自己曾骑行过的路线图，为您带来别样的出行体验。</p>
					</div>
				</li>
			</ul>
		</div>
	</body>
</html>