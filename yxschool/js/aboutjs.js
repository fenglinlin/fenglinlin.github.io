(function($){
	var defaults = {
		'container' : '#container',//容器
		'sections' : '.section',//子容器
		'easing' : 'ease',//特效方式，ease-in,ease-out,linear
		'duration' : 1000,//每次动画执行的时间
		'pagination' : true,//是否显示分页
		'loop' : false,//是否循环
		'keyboard' : true,//是否支持键盘
		'direction' : 'vertical',//滑动的方向 horizontal,vertical,
		'onpageSwitch' : function(pagenum){}
	};

	var win = $(window),
		container,sections;

	var opts = {},
		canScroll = true;

	var iIndex = 0;

	var arrElement = [];

	var SP = $.fn.switchPage = function(options){
		opts = $.extend({}, defaults , options||{});

		container = $(opts.container),
		sections = container.find(opts.sections);

		sections.each(function(){
			arrElement.push($(this));
		});

		return this.each(function(){
			if(opts.direction == "horizontal"){
			initLayout();
			}

			if(opts.pagination){
				initPagination();
			}

			if(opts.keyboard){
				keyDown();
			}
		});
	}

	//滚轮向上滑动事件
	SP.moveSectionUp = function(){
		if(iIndex){
			iIndex--;
		}else if(opts.loop){
			iIndex = arrElement.length-1;
		}
		scrollPage(arrElement[iIndex]);
	};

	//滚轮向下滑动事件
	SP.moveSectionDown = function(){
		// if(iIndex<(arrElement.length-1)){
		if(iIndex<(arrElement.length)){
			iIndex++;
		}else if(opts.loop){
			iIndex = 0;
		}
		scrollPage(arrElement[iIndex]);
	};

	//私有方法
	//页面滚动事件
	function scrollPage(element){
		var dest = element.position();
		if(typeof dest === 'undefined'){ return; }
		initEffects(dest,element);
	}

	//重写鼠标滑动事件
	$(document).on("mousewheel DOMMouseScroll", MouseWheelHandler);
	function MouseWheelHandler(e) {
		e.preventDefault();
		var value = e.originalEvent.wheelDelta || -e.originalEvent.detail;
		var delta = Math.max(-1, Math.min(1, value));
		if(canScroll){
			if (delta < 0) {
				SP.moveSectionDown();
			}else {
				SP.moveSectionUp();
			}
		}
		return false;
	}

	//横向布局初始化
	function initLayout(){
		var length = sections.length,
			width = (length*100)+"%",
			cellWidth = (100/length).toFixed(length)+"%";
		container.width(width).addClass("left");
		sections.width(cellWidth).addClass("left");
	}
	
	//初始化分页
	function initPagination(){
		var length = sections.length;
		if(length){

		}
		var pageHtml = '<ul id="pages"><a href="javascript:void(0)"><li class="active"><img src="../images/img/ico_1.png" /></a></li>';
		
		for(var i=1;i<length;i++){
			pageHtml += '<li><a href="javascript:void(0)"><img src="../images/img/ico_0'+(i+1)+'.png" /></a></li>';
		}
		pageHtml += '</ul>';
		$("body").append(pageHtml);
	}


	//鼠标滚动分页事件
	function paginationHandler(){
		$("#pages").remove(); 
		var length = sections.length;
		if(length){
		}
		var pageHtml = '<ul id="pages">';
		for(var i = 0; i < iIndex; i++){
			pageHtml += '<li><a href="javascript:void(0)"><img src="../images/img/ico_0'+(i+1)+'.png" /></a></li>';
		}
		pageHtml += '<li class="active"><a href="javascript:void(0)"><img src="../images/img/ico_'+(iIndex+1)+'.png" /></a></li>';
		for(var i=iIndex+1;i< length;i++){
			pageHtml += '<li><a href="javascript:void(0)"><img src="../images/img/ico_0'+(i+1)+'.png" /></a></li>';
		}
		pageHtml += '</ul>';
		$("body").append(pageHtml);
		
	}

	// //页面自动切换
	// var iIndex2 = iIndex+1;
	// function paginationHandler2(){
	// 	$("#pages").remove(); 
	// 	var length = sections.length;
	// 	if(length){
	// 	}
	// 	iIndex2 = (iIndex2+1)%length;
	// 	var pageHtml = '<ul id="pages">';
	// 	for(var i = 0; i < iIndex2; i++){
	// 		pageHtml += '<li><a href="javascript:void(0)"><img src="../images/img/ico_0'+(i+1)+'.png" /></a></li>';
	// 	}
	// 	pageHtml += '<li class="active"><a href="javascript:void(0)"><img src="../images/img/ico_'+(iIndex2+1)+'.png" /></a></li>';
	// 	for(var i=iIndex2+1;i< length;i++){
	// 		pageHtml += '<li><a href="javascript:void(0)"><img src="../images/img/ico_0'+(i+1)+'.png" /></a></li>';
	// 	}
	// 	pageHtml += '</ul>';
	// 	$("body").append(pageHtml);
		
	// 	//计时器
	// 	var timer = setInterval("paginationHandler2()",500);
	// 	//鼠标移入图片上，停止切换
	// 	$("#pages").onmouseover = function(){
	// 		clearInterval(timer);
	// 	}
	// 	//鼠标离开，继续切换
	// 	$("#pages").onmouseout = function(){
	// 		timer = setInterval("paginationHandler2()", 1000);
	// 	}
	// }

	//是否支持css的某个属性
	function isSuportCss(property){
		var body = $("body")[0];
		for(var i=0; i<property.length;i++){
			if(property[i] in body.style){
				return true;
			}
		}
		return false;
	}

	//渲染效果
	function initEffects(dest,element){
		var transform = ["-webkit-transform","-ms-transform","-moz-transform","transform"],
			transition = ["-webkit-transition","-ms-transition","-moz-transition","transition"];

		canScroll = false;
		if(isSuportCss(transform) && isSuportCss(transition)){
			var traslate = "";
			if(opts.direction == "horizontal"){
				traslate = "-"+dest.left+"px, 0px, 0px";
			}else{
				traslate = "0px, -"+dest.top+"px, 0px";
			}
			container.css({
				"transition":"all "+opts.duration+"ms "+opts.easing,
				"transform":"translate3d("+traslate+")"
			});
			container.on("webkitTransitionEnd msTransitionend mozTransitionend transitionend",function(){
				canScroll = true;
			});
		}else{
			var cssObj = (opts.direction == "horizontal")?{left: -dest.left}:{top: -dest.top};
			container.animate(cssObj, opts.duration, function(){
				canScroll = true;
			});
		}
		element.addClass("active").siblings().removeClass("active");
		if(opts.pagination){
			paginationHandler();
		}
	}

	//窗口Resize
	

	//绑定键盘事件
	function keyDown(){
		var keydownId;
		win.keydown(function(e){
			clearTimeout(keydownId);
			keydownId = setTimeout(function(){
				var keyCode = e.keyCode;
				if(keyCode == 37||keyCode == 38){
					SP.moveSectionUp();
				}else if(keyCode == 39||keyCode == 40){
					SP.moveSectionDown();
				}
			},150);
		});
	}

/*******************************************鼠标事件相应********************************************************/


        //  var aPicLi=document.getElementById('container').getElementsByTagName('li');
        //  var aIcoLi=document.getElementById('pages').getElementsByTagName('li');
        //  var oIcoUl=document.getElementById('pages').getElementsByTagName('ul')[0];
        //  var oDiv=document.getElementById('container');
        //  var i=0;
        //  var iNowUlLeft=0;
        //  var iNow=0;

        //  for(i=0;i<aIcoLi.length;i++){
        //      aIcoLi[i].index=i;
        //      aIcoLi[i].onclick=function(){
        //          if(iNow==this.index){
        //              return false;
        //          }
        //          iNow=this.index;
        //         paginationHandler();
        //      }
        //  }

        //  function oUlleft(){
        //      oIcoUl.style.left=-aIcoLi[0].offsetWidth*iNowUlLeft+'px';
        //  }
         
        //  function autoplay(){
        //      iNow++;
        //      if(iNow>=aIcoLi.length){
        //          iNow=0;
        //      }
        //      if(iNow<iNowUlLeft){
        //          iNowUlLeft=iNow;
        //      }else if (iNow>=iNowUlLeft+7){
        //          iNowUlLeft=iNow-6;
        //      }

        //      oUlleft();
        //      paginationHandler();
        //  }
         
        //  var time=setInterval(autoplay,3000);
        //  oDiv.onmouseover=function(){
        //      clearInterval(time);
        //  }
        //  oDiv.onmouseout=function(){
        //      time=setInterval(autoplay,3000);
        //  }


})(jQuery);
	 