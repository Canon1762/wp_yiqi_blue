<?php
/**
 * 用于显示存档页面的模板
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_yiqi
 */

get_header();
get_sidebar();
?>

				<div class="xh_module2_list">
					<ul id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'news' );
					endwhile; // End of the loop.
					?>
					</ul>
					<?php mo_paging(); ?>
				</div>
			</div>
		</article>
		<div class="xh_clear"></div>
	</section>
</section>

<?php
get_footer();
