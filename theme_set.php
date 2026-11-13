<?php
/**
 * wp_yiqi 主题设置
 *
 * @link http://wanlimm.com/77202006258703.html
 *
 * @package wp_yiqi
 */

/*
 * 给表单添加PHP处理代码
 * wp_get_attachment_url()：获取附件的路径地址，参数是附件的ID。
 * media_handle_upload()：上传文件的函数，返回上传附件的ID。
 * 参数1：< input name="logo">的name值；
 * 参数2：文章ID，如果是0，表示不是文章。
 * update_option()：更新wp_options数据表中的选项。
 * 参数1：数据表中的字段名；参数2：字段的值。
 * 
 * 在模板中的调用方法：
 * <?php echo get_option("logo_img"); ?>
 * <?php echo get_option("tel_title"); ?>
 */
if($_POST['theme_set']){
	/* 全站头部 */
	$attachment_id = media_handle_upload( 'logo', 0 ); //上传图片，返回的是 附件的ID
	$logo_url = wp_get_attachment_url($attachment_id); //获取图片的地址
	if($logo_url){
		update_option("logo_img",$logo_url); //如果图片地址在在，就将图片的地址写入到数据库
	}
	update_option("logo_bottom",$_POST["logo_bottom"]);
	update_option("tel_title",$_POST["tel_title"]); //更新数据表中的电话标题字段的值
	update_option("tel_phone",stripslashes($_POST["tel_phone"]));

	/* 首页banner */
	update_option("banner_y",$_POST["banner_y"]); //首页banner图片高度

	$attachment_id = media_handle_upload( 'banner1', 0 ); //上传图片，返回的是 附件的ID
	$banner1_url = wp_get_attachment_url($attachment_id); //获取图片的地址
	if($banner1_url){
		update_option("banner1_img",$banner1_url); //如果图片地址在在，就将图片的地址写入到数据库
	}
	$attachment_id = media_handle_upload( 'banner2', 0 ); //上传图片，返回的是 附件的ID
	$banner2_url = wp_get_attachment_url($attachment_id); //获取图片的地址
	if($banner2_url){
		update_option("banner2_img",$banner2_url); //如果图片地址在在，就将图片的地址写入到数据库
	}
	$attachment_id = media_handle_upload( 'banner3', 0 ); //上传图片，返回的是 附件的ID
	$banner3_url = wp_get_attachment_url($attachment_id); //获取图片的地址
	if($banner3_url){
		update_option("banner3_img",$banner3_url); //如果图片地址在在，就将图片的地址写入到数据库
	}
	/*内页banner*/
	update_option("bannern_y",$_POST["bannern_y"]);
	$attachment_id = media_handle_upload( 'bannern', 0 ); //上传图片，返回的是 附件的ID
	$bannern_url = wp_get_attachment_url($attachment_id); //获取图片的地址
	if($bannern_url){
		update_option("bannern_img",$bannern_url); //如果图片地址在在，就将图片的地址写入到数据库
	}
	
	/* 首页中部 */
	update_option("about",stripslashes($_POST["about"]));
	update_option("m_about",stripslashes($_POST["m_about"]));  //手机端首页公司简介，不可删除！

	/* 全站底部 */
	update_option("info",stripslashes($_POST["info"]));
	update_option("kefu_qq",stripslashes($_POST["kefu_qq"]));
	$attachment_id = media_handle_upload( 'kefu_erweima', 0 );
	$erweima_url = wp_get_attachment_url($attachment_id);
	if($erweima_url){
		update_option("kefu_erweima",$erweima_url);
	}
	update_option("kefu_tel",stripslashes($_POST["kefu_tel"]));
}
?>

<style>
.theme_set{ width:98%; }
.theme_set h2{ font-size:20px; }
.theme_set dl{ margin-top:20px; }
.theme_set dd{ margin:5px 0; }
.theme_set dd input[type=text]{ width:50%; }
.theme_set dd textarea{ width:50%; }
.theme_set dd img{ margin-bottom:-30px; }
</style>

<div class="theme_set">
	<form action="" method="post" enctype="multipart/form-data">
		<h1>wp_yiqi主题设置</h1>
		<hr>
		<h2>全站头部设置</h2>
		<dl>
			<dt>网站Logo：</dt>
			<dd>
				<input type="file" name="logo"><img src="<?php echo get_option("logo_img"); ?>" height="50">
			</dd>
		</dl>
		<dl>
			<dt>Logo下移：</dt>
			<dd>
				<input type="text" name="logo_bottom" value="<?php echo get_option("logo_bottom"); ?>"><span>像素</span>
			</dd>
		</dl>
		<dl>
			<dt>Logo右侧电话标题：</dt>
			<dd>
				<input type="text" name="tel_title" value="<?php echo get_option("tel_title"); ?>">
			</dd>
		</dl>
		<dl>
			<dt>Logo右侧电话号码：</dt>
			<dd>
				<input type="text" name="tel_phone" value="<?php echo get_option("tel_phone"); ?>">
			</dd>
		</dl>
		<br>
		<h2>banner设置</h2>
		<dl>
			<dt>Banner图片高度：</dt>
			<dd>
				<input type="text" name="banner_y" value="<?php echo get_option("banner_y"); ?>"><span>像素</span>
			</dd>
		</dl>
		<dl>
			<dt>Banner1上传：</dt>
			<dd>
				<input type="file" name="banner1"><img src="<?php echo get_option("banner1_img"); ?>" height="50">
			</dd>
		</dl>
		<dl>
			<dt>Banner2上传：</dt>
			<dd>
				<input type="file" name="banner2"><img src="<?php echo get_option("banner2_img"); ?>" height="50">
			</dd>
		</dl>
		<dl>
			<dt>Banner3上传：</dt>
			<dd>
				<input type="file" name="banner3"><img src="<?php echo get_option("banner3_img"); ?>" height="50">
			</dd>
		</dl>
		<dl>
			<dt>内页Banner图片高度：</dt>
			<dd>
				<input type="text" name="bannern_y" value="<?php echo get_option("bannern_y"); ?>"><span>像素</span>
			</dd>
		</dl>
		<dl>
			<dt>内页Banner上传：</dt>
			<dd>
				<input type="file" name="bannern"><img src="<?php echo get_option("bannern_img"); ?>" height="50">
			</dd>
		</dl>
		<br>
		<h2>首页中部设置</h2>
		<dl>
			<dt>电脑端公司简介：</dt>
			<dd>
				<textarea name="about" style="height: 106px;"><?php echo get_option("about"); ?></textarea>
			</dd>
		</dl>
		<dl>
			<dt>手机端公司简介：（注意：不可删除！）</dt>
			<dd>
				<textarea name="m_about" style="height: 106px;"><?php echo get_option("m_about"); ?></textarea>
			</dd>
		</dl>
		<br>
		<h2>全站底部设置</h2>
		<dl>
			<dt>版权信息：</dt>
			<dd>
				<textarea type="text" name="info"><?php echo get_option("info"); ?></textarea>
			</dd>
		</dl>
		<dl>
			<dt>客服QQ：</dt>
			<dd>
				<input type="text" name="kefu_qq" value="<?php echo get_option("kefu_qq"); ?>">
			</dd>
		</dl>
		<dl>
			<dt>二维码上传：</dt>
			<dd>
				<input type="file" name="kefu_erweima"><img src="<?php echo get_option("kefu_erweima"); ?>" height="100">
			</dd>
		</dl>
		<dl>
			<dt>客服电话：</dt>
			<dd>
				<input type="text" name="kefu_tel" value="<?php echo get_option("kefu_tel"); ?>">
			</dd>
		</dl>
		<dl>
			<dt></dt>
			<dd>
				<input type="submit" name="theme_set" value="提交"></dd>
		</dl>
	</form>
</div>