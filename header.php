<?php
/**
 * 我们主题的页眉
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_yiqi
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php
	if( is_tax() ){
		setTitle(); ?>-<?php bloginfo( 'name' );
	}else{
		wp_title('', true);
	} ?></title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	<header id="header" class="site-header">

		<div class="head">
			<div class="inner">
				<?php
				if( is_front_page() || is_home() ){
					$h = 'h1';
				}else{
					$h = 'h2';
				}
				?>
				<<?php echo( $h ); ?> class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
						<img src="<?php echo get_option("logo_img"); ?>" alt="<?php bloginfo( 'name' ); ?>" style="margin-top:<?php echo get_option("logo_bottom"); ?>px;" />
					</a>
				</<?php echo( $h ); ?>>
				<div class="tel">
					<em><?php echo get_option("tel_title"); ?><p><?php echo get_option("tel_phone"); ?></p></em>
				</div>
			</div>
		</div><!-- Logo和电话 -->

		<nav>
			<?php
			wp_nav_menu(
				array(
					'theme_location'    => 'header-menu',
					'container'         => false,
					'menu_id'           => 'navul',
					'menu_class'        => 'navul',
				)
			);
			?>
		</nav><!-- 导航 -->

		<?php if( is_front_page() || is_home() ): ?>
		<div class="banner" style="height:<?php echo get_option("banner_y"); ?>px;">
			<ul class="slides list-none" style="height:<?php echo get_option("banner_y"); ?>px;">
				<li style="background:url(<?php echo get_option("banner1_img"); ?>) no-repeat center center; height:<?php echo get_option("banner_y"); ?>px;"></li>
				<li style="background:url(<?php echo get_option("banner2_img"); ?>) no-repeat center center; height:<?php echo get_option("banner_y"); ?>px;"></li>
				<li style="background:url(<?php echo get_option("banner3_img"); ?>) no-repeat center center; height:<?php echo get_option("banner_y"); ?>px;"></li>
			</ul>
		</div><!-- banner -->
		<?php else: ?>
		<div class="banner-ny"><img src="<?php echo get_option("bannern_img"); ?>" height="<?php echo get_option("bannern_y"); ?>px"></div><!-- banner -->
		<?php endif; ?>
		

	</header><!-- 头部 -->
