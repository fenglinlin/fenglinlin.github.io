<!DOCTYPE>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<title>蚁行租车 - 帮助中心</title>
		<link href="css/base.css" rel="stylesheet" media="all" />
		<link href="css/main.css" rel="stylesheet" media="all" />
		<script type='text/javascript' src='js/scripts/jquery-1.11.3.js'></script>
		<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
	</head>
	<body>
		<?php
        include 'head.php';
    ?>
		<div class="hc_contains">
			<div class="shopMap">
				<div class="shop_dituContent" id="dituContent"></div>
			</div>
			<div class="hc_content">
				<p class="title">租赁流程</p>
	    		<ul>
	    			<li>
						<div class="hc_content_img"><img src="images/help/login.png" /></div>
	    				<div class="hc_content_text">
	    					<a href="">登陆平台</a>
	    					<p>移动端或PC端打卡微信公众号可浏览租赁信息 租赁需注册哦</p>
	    				</div>
	    			</li>
	    			<li>
	    				<div class="hc_content_img"><img src="images/help/writeInfo.png" /></div>
	    				<div class="hc_content_text">
	    					<a href="">填写信息</a>
	    					<p>打开网站首页，点击注册，填写相应的注册信息</p>
	    				</div>
	    			</li>
	    			<li>
	    				<div class="hc_content_img"><img src="images/help/startRental.png" /></div>
	    				<div class="hc_content_text">
	    					<a href="">开始租车</a>
	    					<p>完成注册，即可通过微信公众账号或官网进行租车</p>
	    				</div>
	    			</li>
	    		</ul>
				<img src="images/help/qrcode.png" class="qrcode"/>
    	</div>
		<div class="hc_ankle">
			<h1>蚁行服务 便捷出行</h1>
			<p class="ankleTitle">常见疑问解答</p>
			<ul>
				<li>
					<a href="">为何有些租赁点的租赁价不一样？</a>
					<p>因为不同租赁点的人流拥堵时间不同，所以相对应的价格也会不一样。</p>
				</li>
				<li>
					<a href="">为何有些租赁点的租赁价不一样？</a>
					<p>因为不同租赁点的人流拥堵时间不同，所以相对应的价格也会不一样。</p>
				</li>
				<li>
					<a href="">为何有些租赁点的租赁价不一样？</a>
					<p>因为不同租赁点的人流拥堵时间不同，所以相对应的价格也会不一样。</p>
				</li>
			</ul>
		</div>
		</div>	
		<?php include_once 'footer.php' ?>
		
		<script type="text/javascript">
			//创建和初始化地图函数：
			function initMap(){
				createMap();//创建地图
				setMapEvent();//设置地图事件
				addMapControl();//向地图添加控件
				addMarker();//向地图中添加marker
			}
			
			//创建地图函数：
			function createMap(){
				var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
				var point = new BMap.Point(119.961752,31.683809);//定义一个中心点坐标
				map.centerAndZoom(point,18);//设定地图的中心点和坐标并将地图显示在地图容器中
				window.map = map;//将map变量存储在全局
			}
			
			//地图事件设置函数：
			function setMapEvent(){
				map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
				map.enableScrollWheelZoom();//启用地图滚轮放大缩小
				map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
				map.enableKeyboard();//启用键盘上下左右键移动地图
			}
			
			//地图控件添加函数：
			function addMapControl(){
				//向地图中添加缩放控件
			var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
			map.addControl(ctrl_nav);
				//向地图中添加缩略图控件
			var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
			map.addControl(ctrl_ove);
				//向地图中添加比例尺控件
			var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
			map.addControl(ctrl_sca);
			}
			
			//标注点数组
			var markerArr = [{title:"常州信息学院蚁行服务中心",content:"常州市武进区鸣新中路108号<br/><br/>电话：000-181818<br/>邮编：250515",point:"119.960993|31.684039",isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
			];

			//创建marker
			function addMarker(){
				for(var i=0;i<markerArr.length;i++){
					var json = markerArr[i];
					var p0 = json.point.split("|")[0];
					var p1 = json.point.split("|")[1];
					var point = new BMap.Point(p0,p1);
					var iconImg = createIcon(json.icon);
					var marker = new BMap.Marker(point,{icon:iconImg});
					var iw = createInfoWindow(i);
					var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
					marker.setLabel(label);
					map.addOverlay(marker);
					label.setStyle({
								borderColor:"#808080",
								color:"#333",
								cursor:"pointer"
					});
					
					(function(){
						var index = i;
						var _iw = createInfoWindow(i);
						var _marker = marker;
						_marker.addEventListener("click",function(){
							this.openInfoWindow(_iw);
						});
						_iw.addEventListener("open",function(){
							_marker.getLabel().hide();
						})
						_iw.addEventListener("close",function(){
							_marker.getLabel().show();
						})
						label.addEventListener("click",function(){
							_marker.openInfoWindow(_iw);
						})
						if(!!json.isOpen){
							label.hide();
							_marker.openInfoWindow(_iw);
						}
					})()
				}
			}
			//创建InfoWindow
			function createInfoWindow(i){
				var json = markerArr[i];
				var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
				return iw;
			}
			//创建一个Icon
			function createIcon(json){
				var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
				return icon;
			}
			
			initMap();//创建和初始化地图
		</script>		
	</body>
</html>
