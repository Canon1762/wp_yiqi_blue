<?php
/**
 * 用于显示所有单独页面的模板
 *
 * 默认情况下，这是显示所有页面的模板。
 * 请注意，这是WordPress的页面结构
 * 在你的WordPress网站上的其他“页面”可能使用不同的模板。
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_yiqi
 */

get_header();
get_sidebar();
?>

			<div class="xh_editor xh_module1">
			    <?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'page' );
				endwhile; // End of the loop.
				?>
				<div class="xh_clear"></div>
			</div>
		</div>
	</article>
	<div class="xh_clear"></div>
</section>

<?php
get_footer();
