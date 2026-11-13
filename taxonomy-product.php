<?php
/**
 * 用于显示产品列表页的模板
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_yiqi
 */

get_header();
get_sidebar();
?>

			<div class="xh_module3_list" id="product-list">
				<ul class="list">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'product' );
					endwhile; // End of the loop.
					?>
				</ul>
				<div class="xh_clear"></div>
				<?php mo_paging(); ?>
			</div>
		</div>
	</article>
	<div class="xh_clear"></div>
</section>

<?php
get_footer();
