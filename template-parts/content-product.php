<?php
/**
 * 在taxonmy-product.php中显示产品列表页的模板部分
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_yiqi
 */

?>

						<li>
							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail('img_list_size'); ?>
								<h2><?php the_title(); ?><br><span><?php echo get_post_meta($post->ID, '规格', true); ?></span></h2>
							</a>
						</li>