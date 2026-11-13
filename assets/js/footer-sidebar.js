/*
 * 内页侧栏执行代码
 */

/*侧栏多级产品分类列表（非多级可删除）*/
$(".xh_aside_prolist .product>ul>li>ul>li").click(function(){
	$(this).find("ul.children").toggle();
});

