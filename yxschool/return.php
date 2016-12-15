<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7,chrome=1" />

<title>蚁行动力</title>

<link href="css/main.css" rel="stylesheet" media="all" />
<link href="css/base.css" rel="stylesheet" media="all" />
<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="js/js.js" type="text/javascript"></script>
<script type='text/javascript' src='js/jquery-1.11.3.js'></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
</style>
</head>		
<body>
	<?php
        include 'head.php';
    ?>
	<div class="renMain">
		<div class="renHead">
			<img src="images/rental/page_02.jpg" />
		</div>
		<div class="renRental">
			<h1>开始租车</h1>
			<table>
				<tr>
					<td>
						<label>大学城选择</label>
						<select>
							<option>南京大学城</option>
							<option>江宁大学城</option>
							<option>仙林大学城</option>
						</select>
					</td>
					<td>
						<label>计费类型</label>
						<select>
							<option>区段计费</option>
							<option>天数计费</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label>租车时间</label>
						<input type="text" name="rentalTime"/>
					</td>
					<td>
						<label>还车时间</label>
						<input type="text" name="returnTime"/>
					</td>
				</tr>
				<tr>
					<td>
						<label>附近门店</label>
						<input type="text" name="shop"/>
					</td>
				</tr>
				<tr>
					<td>
						<label>租金预估</label>
						<input type="text" name="money"/>
					</td>
				</tr>
				<tr>
					<td>
						<input type="button" name="rentalStart" value="开始租车"/>
					</td>
				</tr>
			</table>
		</div>
		<div class="map">
			<ul>
				<li style="margin-top:30px;"><a href='javascript:void(0);'>门店查看</a></li>
				<li><a href='javascript:void(0);'>3.00/小时</a></li>
				<li><a href='javascript:void(0);'>门店车辆库存</a></li>
				<li><a href='javascript:void(0);'>周边门店推荐</a></li>
				<li style="margin-top:100px;"><a href='javascript:void(0);' style="background-image: url(./images/rental/check_01.jpg);color:white;">选择</a></li>
			</ul>
			<div class="dituContent" id="dituContent"></div>
		</div>	
		<?php include 'sixList.php' ?>
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
				var point = new BMap.Point(118.88198375701904,31.92714292900152);//定义一个中心点坐标
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
			var markerArr = [{title:"南京工程学院蚁行服务中心",content:"南京市江宁科学园弘景大道1号 <br/><br/>电话：86-25-52130065<br/>邮编:211167",point:"119.960993|31.684039",isOpen:0,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
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
	</div>	
	<?php
        include 'footer.php';
    ?>
</body>
</html>
