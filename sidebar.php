<?php
/**
 * 包含主要小部件区域的侧栏
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_yiqi
 */
?>
<section class="xh_section">
	<aside>
		<section class="xh_aside">
			<?php if( is_page() || is_tax('img') || is_singular('showimg') ): ?>
				<h2>关于我们</h2>
				<div class="xh_aside_list">
					<?php wp_nav_menu(
					  array(
					    'theme_location' => 'about-menu',
					    'container'      => false,
					  )
					); ?>
					<div class="xh_clear"></div>
				</div>
			<?php elseif( is_category('news') || is_singular('post') ): ?>
				<h2>新闻资讯</h2>
				<div class="xh_aside_list">
					<ul>
					<?php
					$args=array(
						'child_of'=> '1',
						'hide_empty'=>'0',
						'orderby' => 'name',
						'order' => 'ASC',
					);
					$categories=get_categories($args);
					foreach($categories as $category) {
						echo '<li><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "%s" ), $category->name ) . '" ' . '>' . $category->name.'</a></li>';
					}
					?>
					</ul>
					<div class="xh_clear"></div>
				</div>
			<?php elseif( is_tax('product') || is_singular('showproduct') ): ?>
				<h2>产品中心</h2>
				<div class="xh_aside_list">
					<ul>
					<?php
					$args=array(
						'child_of'=> '19',
						'parent'=> '19',
						'hide_empty'=>'0',
						'orderby' => 'name',
						'order' => 'ASC',
						'taxonomy' => 'product'
					);
					$categories=get_categories($args);
					foreach($categories as $category) {
						echo '<li><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "%s" ), $category->name ) . '" ' . '>' . $category->name.'</a></li>';
					}
					?>
					</ul>
					<div class="xh_clear"></div>
				</div>
				<!-- 侧栏多级产品分类列表（非多级可删除）
				<div class="xh_aside_prolist">
					<?php
					/*
					$args = array(
					    'taxonomy' => 'product',
					    'hide_empty' => 0,
					    'orderby' => 'name',
					    'show_count' => 0,
					    'pad_counts' => 0,
					    'hierarchical' => 1,
					    'title_li' => '<h2>' . __( '产品中心', 'textdomain' ) . '</h2>',
					);
					*/
					?>
					<ul>
					<?php // wp_list_categories( $args ); ?>
					</ul>
				</div>
				-->
			<?php endif; ?>
			<img style="max-width: 100%;" src="<?php bloginfo('template_url'); ?>/assets/img/lx_bg2.jpg" alt="联系我们">
		</section>
    </aside>

    <article>
		<div class="xh_article">
		<section class="xh_article_head">
			<h1><?php if( is_category() || is_singular('post') ){
				$category = get_the_category();
				echo $category[0]->cat_name;
			}elseif( is_page() ){
				single_post_title();
			}elseif( is_tax() ){
				single_term_title();
			}elseif( is_singular('showproduct') || is_singular('showimg') ){
				custom_taxonomies_terms_links();
			} ?></h1>
			<div class="xh_position">
				<?php
				if(function_exists('bcn_display')){
					bcn_display();
				}
				?>
			</div>
		</section>
		<div class="xh_clear"></div>
