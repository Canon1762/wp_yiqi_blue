<?php
/**
 * 主模板文件
 *
 * 这是WordPress主题中最通用的模板文件
 * 以及主题所需的两个文件之一(另一个是style.css)。
 * 它用于在没有更特定的匹配查询时显示页面。
 * 例如，当home.php或front-page.php文件不存在时，首页默认采用此模板。
 * 警告！本模板使用了front-page.php作为首页模板文件，所以此模板不是首页模板文件。
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_yiqi
 */

get_header();
?>
	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* 开始循环 */
			while ( have_posts() ) :
				the_post();

				/*
				 * 为内容包含特定于post类型的模板。
				 * 如果要在子主题中重写此内容，则需要包含一个文件
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
