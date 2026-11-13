<?php
/**
 * 显示文章详情页的模板
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wp_yiqi
 */

get_header();
get_sidebar();
?>

				<section class="xh_module2">
		            <?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'shownews' );
					endwhile; // End of the loop.
					?>
					<div class="xh_clear"></div>
				</section>
			</div>
		</article>
		<div class="xh_clear"></div>
	</section>
</section>

<?php
get_footer();
