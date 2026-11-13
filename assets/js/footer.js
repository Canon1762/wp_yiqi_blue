/*
 * 页脚全站通用执行代码
 */

// 客服挂件
$(function(){
	$("#kefu-menu").each(function(){
		$(this).find(".btn-wx").mouseenter(function(){
			$(this).find(".pic").fadeIn("fast");
		});
		$(this).find(".btn-wx").mouseleave(function(){
			$(this).find(".pic").fadeOut("fast");
		});
		$(this).find(".btn-phone").mouseenter(function(){
			$(this).find(".phone").fadeIn("fast");
		});
		$(this).find(".btn-phone").mouseleave(function(){
			$(this).find(".phone").fadeOut("fast");
		});
		$(this).find(".btn-top").click(function(){
			$("html, body").animate({
				"scroll-top":0
			},"fast");
		});
	});
	var lastRmenuStatus=false;
	$(window).scroll(function(){//bug
		var _top=$(window).scrollTop();
		if(_top>200){
			$("#kefu-menu").data("expanded",true);
		}else{
			$("#kefu-menu").data("expanded",false);
		}
		if($("#kefu-menu").data("expanded")!=lastRmenuStatus){
			lastRmenuStatus=$("#kefu-menu").data("expanded");
			if(lastRmenuStatus){
				$("#kefu-menu .btn-top").slideDown();
			}else{
				$("#kefu-menu .btn-top").slideUp();
			}
		}
	});
});
