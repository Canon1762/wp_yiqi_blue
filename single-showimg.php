<?php
/**
 * 用于显示图片详情页的模板
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wp_yiqi
 */

get_header();
get_sidebar();
?>

				<div id="showimg">
					<?php get_template_part( 'template-parts/content', 'showimg' ); ?>
	    		</div>
			</div>
		</article>
		<div class="xh_clear"></div>
	</section>
</section>
<?php
get_footer();
