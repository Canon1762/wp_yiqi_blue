<?php
/**
 * 显示无法找到帖子的消息的模板部分
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_yiqi
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( '什么都没找到', 'wp_yiqi' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( '准备好发表你的第一篇文章了吗? <a href="%1$s">从这里开始吧</a>.', 'wp_yiqi' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( '抱歉，没有匹配你的搜索条件。请用一些不同的关键字再试一次。', 'wp_yiqi' ); ?></p>
			<?php
			get_search_form();

		else :
			?>

			<p><?php esc_html_e( '看来我们找不到你要找的东西了。也许搜索能有所帮助。', 'wp_yiqi' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
