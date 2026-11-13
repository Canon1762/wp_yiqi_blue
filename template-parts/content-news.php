<?php
/**
 * 在category-news.php中显示文章列表页的模板部分
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_yiqi
 */

?>

	<?php if( has_post_thumbnail() ){ ?>
	<li style="padding-left: 195px;min-height:156px;">
		<?php the_post_thumbnail('news_list_size');
		the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
		the_excerpt();
		?>
		<span class="time"><?php echo get_the_date(); ?></span>
	</li>
	<?php }else{ ?>
		<li>
		<?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
		the_excerpt();
		?>
		<span class="time"><?php echo get_the_date(); ?></span>
	</li>
	<?php } ?>
