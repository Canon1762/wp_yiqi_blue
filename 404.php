<?php
/**
 * 显示404页面的模板(未找到)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wp_yiqi
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found" style="padding: 70px 0;text-align: center;">
			<header class="page-header">
				<h1 class="page-title" style="font-size: 42px;"><?php esc_html_e( '404 找不到那一页！', 'wp_yiqi' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p style="font-size: 20px;"><?php esc_html_e( '看起来在这个地方什么都没发现。试试搜索关键词或点击上面的导航链接?', 'wp_yiqi' ); ?></p>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
