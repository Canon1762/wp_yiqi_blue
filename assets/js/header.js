/*
 * 页眉全站通用执行代码
 */


$(document).ready(function(){

	/* 首页Banner轮播 */
	$('.banner').css("visibility","visible");
	$('.banner').flexslider({
		animation: 'slide', //图片变换方式：淡入淡出或者滑动
		slideDirection: "horizontal", //图片设置为滑动式时的滑动方向：左右或者上下
		slideshow: true, //载入页面时，是否自动播放
		slideshowSpeed: 3000, //自动播放速度毫秒
		animationDuration: 800, //内容切换时间
		touch: true, //是否支持触摸滑动
		directionNav: false, //是否显示左右控制按钮
		controlNav: true, //是否显示控制菜单
	});

	//头部导航
	$("#navul>li").mouseover(function(){
		$(this).addClass("hover")
		$("#navul>li").mouseout(function(){
			$(this).removeClass("hover")  
		}); 
	});

});