<?php
/**
 * 用于显示首页的模板
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_yiqi
 */
get_header();
?>

	<main id="primary" class="site-main">

		<div class="product inner">
			<div class="productl">
				<div class="productl_t">
					<h2>
					<?php
					$args=array(
						'taxonomy' => 'product',
						'hide_empty'=>'0',
						'hierarchical'=>1,
						'parent'=>'0',
					);
					$categories=get_categories($args);
					foreach($categories as $category){
						echo $category->name;
					}
					?>
					</h2>
					<p>PRODUCT</p>
				</div>
				<div class="productl_c">
					<ul class="list-none">
					<?php
					$args=array(
						'child_of'   => '19',
						'parent'     => '19',
						'hide_empty' => '0',
						'orderby'    => 'name',
						'order'      => 'ASC',
						'taxonomy'   => 'product'
					);
					$categories=get_categories($args);
					foreach($categories as $category) {
						echo '<li><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "%s" ), $category->name ) . '" ' . '>' . $category->name.'</a></li>';
					}
					?>
						<li><a href="<?php echo get_category_link('19'); ?>">查看更多+</a></li>
					</ul>
				</div>
				<div class="productl_u"><img src="<?php bloginfo('template_url'); ?>/assets/img/lx_bg.jpg" alt="查看更多+" /></div>
			</div>
			<div class="productr">
				<div class="productr_t"><span>易企传媒</span> 一家专为中小型企业电子商务网络营销全案服务商。</div>
				<ul class="list-none">
				<?php 
					$product_query = new WP_Query(
						array(
							'post_type' => 'showproduct',
							'posts_per_page' => 9,
							'tax_query' => array(
					            array(
					                'taxonomy' => 'product',//自定义分类法名称
					                'terms' => 19 //id为64的分类。也可是多个分类array(12,64)
					            ),
							)
						)
					);
					if ( $product_query->have_posts() ):
						while ( $product_query->have_posts() ) : $product_query->the_post();
				?>
					<li>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<div class="pic"><img src="<?php $post_ID=$post->ID;$post_thumbnail_id = get_post_thumbnail_id( $post_ID );$post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id,'medium');echo $post_thumbnail_src[0]; ?>" alt="<?php the_title(); ?>"></div>
							<p><?php the_title(); ?></p>
							<div class="guige"><?php echo get_post_meta($post->ID, '规格', true); ?></div>
						</a>
					</li>
				<?php
						endwhile;
					endif;
					wp_reset_postdata();
				?>
				</ul>
			</div>
		</div><!-- 产品展示 -->

		<div id="about">
			<div class="about">
				<div class="about_u">
					<div class="about_u_l">
						<div class="about_u_l_tit">樟树市易企传媒有限公司</div>
						<div class="about_u_l_txt">
							<p><?php echo get_option('about'); ?></p>
							<div class="about_link"><a href="<?php bloginfo('url'); ?>/about" title="公司简介">公司简介</a></div>
							<div class="about_link"><a href="<?php bloginfo('url') ?>/contact" title="联系我们">联系我们</a></div>
						</div>
					</div>
					<div class="about_u_r"><img src="<?php bloginfo('template_url') ?>/assets/img/about.png" alt="{$lang_about_title}" /></div>
				</div>
			</div>
		</div><!-- 关于我们 -->

		<div id="img-show">
			<div class="img-show">
				<div class="img-show_t">
					<h2>企业风采<span>/SHOW</span></h2>
				</div>
				<div class="img-show_u">
					<div class="leftLoopa" id="leftMarquee">
						<div class="bda">
							<ul class="list-none">
							<?php 
								$img_query = new WP_Query(
									array(
										'post_type' => 'showimg',
										'posts_per_page' => 9,
										'tax_query' => array(
								            array(
								                'taxonomy' => 'img',//自定义分类法名称
								                'terms' => 30 //id为64的分类。也可是多个分类array(12,64)
								            ),
										)
									)
								);
								if ( $img_query->have_posts() ):
									while ( $img_query->have_posts() ) : $img_query->the_post();
							?>
								<li>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<img src="<?php $post_ID=$post->ID;$post_thumbnail_id = get_post_thumbnail_id( $post_ID );$post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id,'thumbnail');echo $post_thumbnail_src[0]; ?>" alt="<?php the_title(); ?>">
										<p><?php the_title(); ?></p>
									</a>
								</li>
							<?php
									endwhile;
								endif;
								wp_reset_postdata();
							?>
							</ul>
						</div>
					</div>
					<div class="img_more"><a href="<?php echo get_category_link('30');?>"><img src="<?php bloginfo('template_url'); ?>/assets/img/more.png" /></a></div>
				</div>
			</div>
		</div><!-- 图片轮播 -->

		<div class="news sz_warp inner">
			<div class="news_l">
				<div class="slb">
					<div class="hd">
						<ul class="list-none">
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
					</div>
					<div class="bd">
						<div class="bdlist">
							<div class="bdlstr">
								<div class="sz_newsrt">
									<ul class="list-none">
									<?php
									$news1_query = new WP_Query( array( 'cat' => 7, 'posts_per_page' => 4 ) );        
									if ( $news1_query->have_posts() ):
										while ( $news1_query->have_posts() ) : $news1_query->the_post(); ?>
												<li>
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
														<div class="sz_al">
															<h3><?php the_time('d'); ?></h3>
															<h4><?php the_time('Y-n'); ?></h4>
														</div>
														<div class="sz_newsrt_txt">
															<h4><?php the_title(); ?></h4>
															<p><?php the_excerpt(); ?></p>
														</div>
													</a>
												</li>
										<?php endwhile;
									endif;
									wp_reset_postdata(); ?>
									</ul>
								</div>
							</div>
						</div>
						<div class="bdlist">
							<div class="bdlstr">
								<div class="sz_newsrt">
									<ul class="list-none">
									<?php
									$news2_query = new WP_Query( array( 'cat' => 8, 'posts_per_page' => 4 ) );        
									if ( $news2_query->have_posts() ):
										while ( $news2_query->have_posts() ) : $news2_query->the_post(); ?>
												<li>
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
														<div class="sz_al">
															<h3><?php the_time('d'); ?></h3>
															<h4><?php the_time('Y-n'); ?></h4>
														</div>
														<div class="sz_newsrt_txt">
															<h4><?php the_title(); ?></h4>
															<p><?php the_excerpt(); ?></p>
														</div>
													</a>
												</li>
										<?php endwhile;
									endif;
									wp_reset_postdata(); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="newsr">
				<div class="newsr_t">
					<a href="<?php bloginfo('url'); ?>/contact" title="联系我们">
						<h2>联系我们<span>/CONTACT</span></h2>
					</a>
				</div>
				<div class="newsr_u">
					<ul class="list-none">
						<li class="li00">公司地址：江西省樟树市电商基地</li>
						<li class="li01">电话：0795-7779152</li>
						<li class="li02">联系人：徐经理</li>
					</ul>
					<iframe frameborder="0" height="269" marginheight="0" marginwidth="0" scrolling="no" src="<?php bloginfo('template_url'); ?>/assets/index-map.html" width="264"></iframe>
				</div>
			</div>
		</div><!-- 新闻资讯+联系我们 -->
		
	</main><!-- #main -->

<?php
get_footer();
