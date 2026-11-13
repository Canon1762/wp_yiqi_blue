<?php
/**
 * 用于显示产品详情页的模板
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wp_yiqi
 */

get_header();
get_sidebar();
?>

				<div id="showimg">
					<h1 class="xh_title">
						<?php the_title(); ?>
						<?php if(get_post_meta($post->ID, '规格', true)): ?>
						<span class="meta">规格：<?php echo get_post_meta($post->ID, '规格', true); ?></span>
						<?php endif; ?>
					</h1>
					<div class="product_content"><?php the_content(); ?></div>
					<div class="xh_clear"></div>
					<div class="xh_tools">
						<ul class="xh_page">
							<li class="xh_page_preinfo"><span>上一篇</span><?php previous_post_link(); ?></li>
							<li class="xh_page_next"><span>下一篇</span><?php next_post_link(); ?></li>
						</ul>
					</div>
					<h3 class="xh_related">您可能喜欢</h3>
					<ul class="xh_related_list">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', 'showproduct' );
						endwhile; // End of the loop.
						?>
					</ul>
					<div class="xh_clear"></div>
				</div>
			</div>
		</article>
		<div class="xh_clear"></div>
	</section>
</section>
<?php
get_footer();
