/*
 * 首页页脚执行代码
 */

$(window).load(function() {

	/* 首页图片轮播 */
	$(".leftLoopa").slide( { mainCell:".bda ul",effect:"leftMarquee",vis:5,scroll:1,autoPlay:true} );

	/* 首页文章切换 */
	$(".slb").slide();

});