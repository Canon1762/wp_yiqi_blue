<?php
/**
 * 在single-showproduct.php中显示产品详情页的模板部分
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_yiqi
 */

?>

	<?php
    $args = array(
        'post_type' => 'showproduct', //自定义文章类型名称
        // 'category_name' => 'product', //输出指定分类目录的内容
        'showposts' => 9, //输出的文章数量，这个可以是缺省值，不用设置
        'orderby' => 'rand', //随机调用
        'tax_query' => array(
            array(
                'taxonomy' => 'product',//自定义分类法名称
                'terms' => 19 //id为64的分类。也可是多个分类array(12,64)
            ),
        )
    );
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
        while ($my_query->have_posts()) : $my_query->the_post();?>
        <li>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<img src="<?php $post_ID=$post->ID;$post_thumbnail_id = get_post_thumbnail_id( $post_ID );$post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id,'thumbnail');echo $post_thumbnail_src[0]; ?>">
				<h2><?php the_title(); ?></h2>
			</a>
		</li>
        <?php endwhile; wp_reset_query(); //重置query查询
       }
    ?>