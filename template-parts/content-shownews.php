<?php
/**
 * 在single-post.php中显示文章详情页的模板部分
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_yiqi
 */

?>

					<h1 class="xh_title"><?php the_title(); ?></h1>
					<div class="xh_infos">
						<span class="xh_time"><?php the_time('Y-n-j h:m:s'); ?></span>
						<span class="xh_source"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></span>
						<span class="xh_hits">阅读<span class="xh_Clicks"><?php post_views(' ', ''); ?></span></span>
					</div>
					<div class="xh_editor"><?php the_content(); ?><div class="xh_clear"></div></div>
					<div class="xh_tools">
						<ul class="xh_page">
							<li class="xh_page_preinfo"><span>上一篇</span><?php previous_post_link(); ?></li>
							<li class="xh_page_next"><span>下一篇</span><?php next_post_link(); ?></li>
						</ul>
					</div>
