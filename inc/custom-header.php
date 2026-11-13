<?php
/**
 * 自定义头特性的示例实现
 *
 * 你可以像这样在header.php中添加一个可选的自定义头图像。
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package wp_yiqi
 */

/**
 * 设置WordPress核心自定义标题特性。
 *
 * @uses wp_yiqi_header_style()
 */
function wp_yiqi_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'wp_yiqi_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 1920,
				'height'             => 970,
				'flex-height'        => true,
				'wp-head-callback'   => 'wp_yiqi_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'wp_yiqi_custom_header_setup' );

if ( ! function_exists( 'wp_yiqi_header_style' ) ) :
	/**
	 * 样式的标题图像和文本显示在博客上。
	 *
	 * @see wp_yiqi_custom_header_setup().
	 */
	function wp_yiqi_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * 如果没有设置文本的自定义选项，我们就退出。
		 * get_header_textcolor()选项:任何十六进制值，'blank'隐藏文本。默认值:add_theme_support('custom-header')。
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// 如果我们走到这一步，我们就有了自定义样式。让我们这样做。
		?>
		<style type="text/css">
		<?php
		// 文本被隐藏了吗?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// 如果用户已经为文本设置了自定义颜色，请使用它。
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
