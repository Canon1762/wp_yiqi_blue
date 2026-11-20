<?php
/**
 * 显示页脚的模板
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_yiqi
 */
?>

	<footer id="footer" class="site-footer">
		<div class="inner">
			<div class="footer-l">
				<div class="link">
					<div class="title">友情链接</div>
					<div class="content">
						<ul class="list-none">
							<li><?php wp_list_bookmarks('title_li=&categorize=0&orderby=name&limit=24'); ?></li>
						</ul>
					</div>
				</div>
				<div class="foot-nav">
					<?php wp_nav_menu(
						array(
							'theme_location' => 'footer-menu',
							'container'      => false,
							'before'            => '<span>|</span>',
						)
					); ?>
				</div>
				<div class="foot-text">
					<p><?php echo get_option("info"); ?></p>
					<div class="site-info">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'wp_yiqi' ) ); ?>">
							<?php
							/* translators: %s: CMS name, i.e. WordPress. */
							printf( esc_html__( '自豪的采用 %s', 'wp_yiqi' ), 'WordPress' );
							?>
						</a>
						<span class="sep"> | </span>
						<?php
						/* translators: 1: Theme name, 2: Theme author. */
						printf( esc_html__( '网站建设: %1$s %2$s' ), '', '<a href="#">****</a>' );
						?>
					</div><!-- .site-info -->
				</div>
			</div>
			<div class="footer-r"></div>
		</div>
		<div id="kefu">
			<div id="kefu-menu" class="kefu-menu">
				<a href="tencent://Message/?Uin=<?php echo get_option("kefu_qq"); ?>&amp;Menu=yes" class="bton btn-qq"></a>
				<div class="bton btn-wx">
					<img class="pic" src="<?php echo get_option("kefu_erweima"); ?>">
				</div>
				<div class="bton btn-phone">
					<div class="phone"><?php echo get_option("kefu_tel"); ?></div>
				</div>
				<div class="bton btn-top"></div>
			</div>
		</div><!-- 客服挂件 -->

	</footer>

<?php wp_footer(); ?>

</body>
</html>
