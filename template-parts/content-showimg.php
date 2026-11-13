<?php
/**
 * 在single-showimg.php中显示图片详情页的模板部分
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_yiqi
 */

?>

					<h1 class="xh_title"><?php the_title(); ?></h1>
					<p class="show-img"><img src="<?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');echo $full_image_url[0]; ?>" alt="<?php the_title(); ?>"></p>
					<div class="xh_clear"></div>
					<div class="xh_tools">
						<ul class="xh_page">
							<li class="xh_page_preinfo"><span>上一篇</span><?php previous_post_link(); ?></li>
							<li class="xh_page_next"><span>下一篇</span><?php next_post_link(); ?></li>
						</ul>
					</div>
