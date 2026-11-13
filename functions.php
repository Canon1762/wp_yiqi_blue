<?php
/**
 * wp_yiqi 函数和定义
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wp_yiqi
 */

if ( ! defined( '_S_VERSION' ) ) {
	// 在每个版本中替换主题的版本号。
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'wp_yiqi_setup' ) ) :
	/**
	 * 设置默认主题并注册对各种WordPress特性的支持。
	 *
	 * 注意，这个函数被连接到after_setup_theme钩子中，它
	 * 在init钩子之前运行。init钩子对于某些特性来说太晚了，比如
	 * 表示支持post缩略图。
	 */
	function wp_yiqi_setup() {
		/*
		 * 去除头部多余加载信息
		 * @link https://www.sucaihu.com/14471.html
		 */
		remove_action( 'wp_head', 'wp_generator' );//移除WordPress版本
		remove_action( 'wp_head', 'rsd_link' );//移除离线编辑器开放接口
		remove_action( 'wp_head', 'wlwmanifest_link' );//移除离线编辑器开放接口
		remove_action( 'wp_head', 'index_rel_link' );//去除本页唯一链接信息
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); //清除前后文信息
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );//清除前后文信息
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//清除前后文信息
		remove_action( 'wp_head', 'feed_links', 2 );//移除文章和评论feed
		remove_action( 'wp_head', 'feed_links_extra', 3 ); //移除分类等feed
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 ); //移除wp-json
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); //头部的JS代码
		// add_filter( 'show_admin_bar', '__return_false' );//移除wp-json链接
		remove_action( 'wp_head', 'rel_canonical' ); //rel=canonical
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); //rel=shortlink
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );//移除emoji载入js
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );//emoji载入js
		remove_action( 'wp_print_styles', 'print_emoji_styles' );//移除emoji载入css
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
		remove_action('wp_head','wp_resource_hints',2);//移除dns-prefetch
		// 禁用 REST API、移除 wp-json @link https://www.hack520.com/474.html
		add_filter('rest_enabled', '_return_false');
		add_filter('rest_jsonp_enabled', '_return_false');
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
		//移除头部多余.recentcomments 样式
		function Fanly_remove_recentcomments_style() {
		    global $wp_widget_factory;
		    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
		}
		add_action( 'widgets_init', 'Fanly_remove_recentcomments_style' );
		// 移除头部多余block-library/style.min.css
		add_action('wp_enqueue_scripts', function () {
			wp_dequeue_style('wp-block-library');
		});
		// 移除底部wp-embed.min.js文件
		function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
		}
		add_action( 'init', 'disable_emojis' );

		/** 
		* Filter function used to remove the tinymce emoji plugin. 
		*/
		function disable_emojis_tinymce( $plugins ) {
			if ( is_array( $plugins ) ) {
				return array_diff( $plugins, array( 'wpemoji' ) );
			} else {
				return array();
			}
		}
		function disable_embeds_init() {
			global $wp;
			$wp->public_query_vars = array_diff( $wp->public_query_vars, array( 'embed', ) );
			remove_action( 'rest_api_init', 'wp_oembed_register_route' );
			add_filter( 'embed_oembed_discover', '__return_false' );
			remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
			remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
			remove_action( 'wp_head', 'wp_oembed_add_host_js' );
			add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
			add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
		}
		add_action( 'init', 'disable_embeds_init', 9999 );
		function disable_embeds_tiny_mce_plugin( $plugins ) { return array_diff( $plugins, array( 'wpembed' ) ); }
		function disable_embeds_rewrites( $rules ) {
			foreach ( $rules as $rule => $rewrite ) { if ( false !== strpos( $rewrite, 'embed=true' ) ) { unset( $rules[ $rule ] ); } }
			return $rules;
		}
		function disable_embeds_remove_rewrite_rules() { add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' ); flush_rewrite_rules(); }
		register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );
		function disable_embeds_flush_rewrite_rules() { remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' ); flush_rewrite_rules(); }
		register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );

		/*
		 * 为翻译提供主题。
		 * 译文可以在/languages/目录中存档。
		 * 如果您正在基于wp_yiqi构建主题，请使用find and replace选项
		 * 将'wp_yiqi'更改为所有模板文件中的主题名称。
		 */
		load_theme_textdomain( 'wp_yiqi', get_template_directory() . '/languages' );

		// 添加默认的文章和评论的RSS提要链接到头部。
		add_theme_support( 'automatic-feed-links' );

		/*
		 * 让WordPress管理文档标题。
		 * 通过添加主题支持，我们声明这个主题不使用
		 * 在文档头中使用ard编码的<title>标签，预计WordPress也会这样做
		 * 为我们提供吧。
		 */
		/* add_theme_support( 'title-tag' );
		 * 这里通过注释代码，删除了<title>标签。
		 */

		/* 
		 * 自定义文章类型标题显示问题
		 * 使用setTitle();代替wp_title();
		 * 因为现在不打算搞自定义文章类型，所以注释掉。
		 */
		function setTitle(){
			$term = get_term_by('slug',get_query_var('term'),get_query_var('taxonomy'));
			echo $title = $term->name;
		}

		/*
		 * 启用对帖子和页面的帖子缩略图的支持。
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * 注册自定义尺寸的缩略图
		 */
		if (function_exists('add_image_size')){
			add_image_size( 'news_list_size', 180, 125, true );
			add_image_size( 'img_list_size', 280, 210, true );
		}

		/*
		 * 响应式主题必须去掉缩略图srcset属性，否则移动端尺寸不一致
		 * 去除WordPress文章中图片自动加的srcset属性
		 * @link http://www.krseo.com/web/162.html
		 */
		add_filter( 'max_srcset_image_width', create_function('', 'return 1;'));

		//设定摘要的长度
		function new_excerpt_length($length) {
		    return 80;
		}
		add_filter('excerpt_length', 'new_excerpt_length');

		// 把摘要默认的结尾[...]换成...
		function new_excerpt_more(){
		    global $post;
		    return '...';
		}
		add_filter('excerpt_more', 'new_excerpt_more');

		/*
		 * 注册导航菜单
		 * 这里分别注册了头部导航、底部导航、内页侧栏导航，可根据需要增删。
		 * 使用方法：在主题一个位置使用wp_nav_menu()
		 */
		register_nav_menus(
			array(
				'header-menu' => esc_html__( 'Primary', 'wp_yiqi' ),
				'footer-menu' => esc_html__( 'Footnav', 'wp_yiqi' ),
				'about-menu' => esc_html__( 'Aboutnav', 'wp_yiqi' ),
			)
		);

		/*
		 * 删除导航li的多余id和class
		 */
		// add_filter('nav_menu_css_class', 'rm_css_attributes_filter', 100, 1);
		add_filter('nav_menu_item_id', 'rm_css_attributes_filter', 100, 1);
		add_filter('page_css_class', 'rm_css_attributes_filter', 100, 1);
		function rm_css_attributes_filter($var) {
		    return is_array($var) ? array() : '';
		}

		/*
		 * WordPress实现不同分类显示不同的文章数量分页
		 * @link https://www.xuewangzhan.net/wpbbs/17057.html
		 */
		function filter_pre_get_posts( $query ){
			if ( $query->is_main_query() ){
			    $num = '';    
			    // if ( is_category(array('news')) ){ $num = 3; } // 为指定ID的栏目设置每页显示个数
			    // if ( is_taxonomy_hierarchical('product', 'img') ){ $num = 9; } // 为指定自定义分类法设置每页显示个数
			    //if ( is_category(array(10)) ){ $num = 14; }
			    //if ( is_category(array('questions')) ){ $num = 14; }
			    // if ( in_category(array('jhg','hjj','yjj','xxj','jlg')) ){ $num = 10; }
			    //if ( is_home() ){ $num = 10; }
			    // else if ( is_category() ){ $num = 10; }
			    // else if ( is_tag() ){ $num = 10; }
			    // else if ( is_date() ){ $num = 10; }
			    // else if ( is_author() ){ $num = 10; }
			    // else if ( is_search() ){ $num = 10; }
			    // else if ( is_archive() ){ $num = 10; }
			    if ( '' != $num ){ $query->set( 'posts_per_page', $num ); }
			}
			return $query;
		}
		add_action('pre_get_posts', 'filter_pre_get_posts');

		/*
		 * 获取文章所在的自定义分类法分类项目
		 * 本主题不使用自定义分类法，所以注释掉
		 */
		function custom_taxonomies_terms_links(){
			//根据当前文章ID获取文章信息
			$post = get_post( $post->ID );

			//获取当前文章的文章类型
			$post_type = $post->post_type;

			//获取文章所在的自定义分类法
			$taxonomies = get_object_taxonomies( $post_type, 'objects' );

			$out = array();
			foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){
				$term_list = wp_get_post_terms($post->ID, $taxonomy_slug, array("fields" => "all"));
				echo $term_list[0]->name; //显示文章所处的分类中的第一个
			}

			return implode('', $out );
		}

		/* 文章列表页分页
		 * 在文章列表循环结束后调用mo_paging()方法即可显示
		 * @link https://www.daimadog.com/3272.html
		 */
		function mo_paging() {
		    $p = 3;
		    if ( is_singular() ) return;
		    global $wp_query, $paged;
		    $max_page = $wp_query->max_num_pages;
		    if ( $max_page == 1 ) return; 
		    echo '<div class="pagination"><dl>';
		    if ( empty( $paged ) ) $paged = 1;
		    echo '<dd class="prev-page">'; previous_posts_link('上一页'); echo '</dd>';
		    if ( $paged > $p + 1 ) _paging_link( 1, '<dd>第一页</dd>' );
		    if ( $paged > $p + 2 ) echo "<dd><span>···</span></dd>";
		    for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { 
		        if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<dd class=\"active\"><span>{$i}</span></dd>" : _paging_link( $i );
		    }
		    if ( $paged < $max_page - $p - 1 ) echo "<dd><span> ... </span></dd>";
		    echo '<dd class="next-page">'; next_posts_link('下一页'); echo '</dd>';
		    echo '<dd><span>共 '.$max_page.' 页</span></dd>';
		    echo '</dl></div>';
		}

		function _paging_link( $i, $title = '' ) {
		    if ( $title == '' ) $title = "第 {$i} 页";
		    echo "<dd><a href='", esc_html( get_pagenum_link( $i ) ), "'>{$i}</a></dd>";
		}

		/*
		 * WordPress文章自动调用缩略图
		 * 
		 * 1.判断文章是否设置了特色图像，若有则显示特色图像；
		 * 2.若没有特色图像时，查找文章中是否包含图片，若有图片，则调用第一张图片；
		 */
		function autoset_featured() {
		    global $post;
		    $already_has_thumb = has_post_thumbnail($post->ID);
		    if (!$already_has_thumb)  {
		        $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
		        if ($attached_image) {
		            foreach ($attached_image as $attachment_id => $attachment) {
		                set_post_thumbnail($post->ID, $attachment_id);
		            }
		        }
		    }
		}
		add_action('the_post', 'autoset_featured');
		add_action('save_post', 'autoset_featured');
		add_action('draft_to_publish', 'autoset_featured');
		add_action('new_to_publish', 'autoset_featured');
		add_action('pending_to_publish', 'autoset_featured');
		add_action('future_to_publish', 'autoset_featured');
		
		/* 
		 * 为WordPress后台文章列表添加缩略图
		 * 
		 * @link https://zmingcx.com/back-to-list-of-articles-to-add-thumbnail-wordpress.html
		 */
		if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
			// for post and page
			add_theme_support('post-thumbnails', array( 'post', 'page' ) );
			function fb_AddThumbColumn($cols) {
				$cols['thumbnail'] = __('Thumbnail');
				return $cols;
			}
			function fb_AddThumbValue($column_name, $post_id) {
				$width = (int) 160;
				$height = (int) 120;
				if ( 'thumbnail' == $column_name ) {
					// thumbnail of WP 2.9
					$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
					// image from gallery
					$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
					if ($thumbnail_id)
						$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
					elseif ($attachments) {
						foreach ( $attachments as $attachment_id => $attachment ) {
							$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
						}
					}
					if ( isset($thumb) && $thumb ) {
						echo $thumb;
					} else {
						echo __('None');
					}
				}
			}
			// for posts
			add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
			add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
			// for pages
			add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
			add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
		}

		/* 如何获得WordPress文章浏览次数的统计
		 * 在需要显示该统计次数的地方使用下面的代码调用即可： 文章被阅读：<?php post_views(' ', ' 次'); ?>
		 */
		function record_visitors() {
		    if (is_singular())   
		    {   
		      global $post;   
		      $post_ID = $post->ID;   
		      if($post_ID)   
		      {   
		          $post_views = (int)get_post_meta($post_ID, 'views', true);   
		          if(!update_post_meta($post_ID, 'views', ($post_views+1)))   
		          {   
		            add_post_meta($post_ID, 'views', 1, true);   
		          }   
		      }   
		    }   
		}   
		add_action('wp_head', 'record_visitors');   
		/// 函数名称：post_views   
		/// 函数作用：取得文章的阅读次数   
		function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)   
		{   
		  global $post;   
		  $post_ID = $post->ID;   
		  $views = (int)get_post_meta($post_ID, 'views', true);   
		  if ($echo) echo $before, number_format($views), $after;   
		  else return $views;   
		}

		/*
		 * 在wordpress函数文件里告诉Contact Form 7忽略这个检测
		 * 因为本主题暂不使用Contact Form 7插件，所以先注释掉
		 */
		// add_filter( 'wpcf7_validate_configuration', '__return_false' );

		// for posts
		// add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
		// add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
		// for pages
		// add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
		// add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );

		/*
		 * 切换搜索表单、评论表单和评论的默认核心标记
		 * 输出有效的HTML5。
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// 设置WordPress核心自定义背景特性。
		add_theme_support(
			'custom-background',
			apply_filters(
				'wp_yiqi_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// 为小部件的选择性刷新添加主题支持。
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * 添加对核心自定义logo的支持。
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/**
		 * 启用媒体文件上传自动按年月日重命名
		 */
		function git_upload_filter($file) {
			$time = date("YmdHis");
			$file['name'] = $time . "" . mt_rand(1, 100) . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
			return $file;
		}
		add_filter('wp_handle_upload_prefilter', 'git_upload_filter');

		/*
		 * 在后台“外观”菜单中添加 【主题设置】 这个子菜单
		 * add_theme_page()：给“外观”导航创建子菜单；
		 * 参数解说：
		 * 参数1-----标题的内容
		 * 参数2-----显示在后台左边菜单的标题
		 * 参数3-----访问这个页面需要的权限
		 * 参数4-----别名，需要独一无二哦
		 * 参数5-----执行的函数（我们自定义的函数）
		 * 
		 * add_action()：这是一个添加勾子的函数，这里将“Themes_Set”函数添加到“admin_menu”后台菜单的勾子中。
		 * 
		 * @link http://wanlimm.com/77202006258703.html
		 */
		function Themes_Set(){
			add_theme_page( 'wp_yiqi主题设置', 'wp_yiqi主题设置', 'administrator', 'wp_yiqi_lanse_slug','ssmay_set');
		}
		add_action('admin_menu', 'Themes_Set');
		function ssmay_set(){ //主题设置函数
			include("theme_set.php");//这里是自己创建的一个php文件，用来设置选项内容
		}
	}
endif;
add_action( 'after_setup_theme', 'wp_yiqi_setup' );

/**
 * 根据主题的设计和样式表设置内容宽度(以像素为单位)。
 *
 * 优先级为0，使其可用于低优先级的回调。
 *
 * @global int $content_width
 */
function wp_yiqi_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_yiqi_content_width', 640 );
}
add_action( 'after_setup_theme', 'wp_yiqi_content_width', 0 );

/**
 * 开启wordpress友情链接管理
 *
 * 使用方法：
 * <ul class="dhnblog_link"><center>
 * 		<li>友情链接: <?php wp_list_bookmarks('title_li=&categorize=0&orderby=rand&limit=24'); ?></li>
 * </ul>
 *
 * @link https://blog.csdn.net/qq_39086902/article/details/105523963
 */
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

/**
 * 注册小部件。
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_yiqi_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wp_yiqi' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( '添加小部件。', 'wp_yiqi' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wp_yiqi_widgets_init' );

/**
 * 排队引入css样式和js脚本。
 * 模板中通过使用wp_head()和wp_footer()分别来引入页头页脚的css和js文件
 * 在WordPress管理后台正确加载js和css脚本
 * @link https://www.wpdaxue.com/wordpress-admin-enqueue-scripts.html
 * 
 * 使用 wp_enqueue_style() 函数引入css文件教程：
 * wp_enqueue_style( $handle, $src, $deps, $ver, $media );
 * --------------------------------------------------------
 * $handle（字符串，必需）是你的样式表唯一名称。其他函数将使用这个“handle”来排队并打印样式表。
 * $src（字符串，必需）指的是样式表的URL。您可以使用函数，如 get_template_directory_uri() 来获取主题目录中的样式文件。永远不要去想硬编码了！
 * $deps （数组，可选）处理相关样式的名称。如果丢失某些其他样式文件将导致你的样式表将无法正常工作，你可以使用该参数设置“依赖关系”。
 * $ver （字符串或布尔型，可选）版本号。你可以使用你的主题的版本号或任何一个你想要的。如果您不希望使用一个版本号，将其设置为null。默认为false，这使得WordPress的添加自己的版本号。
 * $media （字符串，可选）是指CSS的媒体类型，比如“screen”或“handheld”或“print”。如果你不知道是否需要使用这个，那就不使用它。默认为“all”。
 * @link https://www.wpdaxue.com/loading-css-into-wordpress.html
 * 
 * 使用 wp_enqueue_script() 引入js文件
 * wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
 * --------------------------------------------------------
 * $handle（字符串，必需）是你的样式表唯一名称。其他函数将使用这个“handle”来排队并打印样式表。
 * $src（字符串，必需）指的是样式表的URL。您可以使用函数，如 get_template_directory_uri() 来获取主题目录中的样式文件。永远不要去想硬编码了！
 * $deps （数组，可选）处理相关样式的名称。如果丢失某些其他样式文件将导致你的样式表将无法正常工作，你可以使用该参数设置“依赖关系”。
 * $ver （字符串或布尔型，可选）版本号。你可以使用你的主题的版本号或任何一个你想要的。如果您不希望使用一个版本号，将其设置为null。默认为false，这使得WordPress的添加自己的版本号。
 * $in_footer 是否在</body>之前而不是<head>中加载脚本。默认为'false'。
 * @link https://www.wpdaxue.com/how-to-add-css-and-javascript-to-wordpress-theme.html
 * 
 */
function wp_yiqi_scripts() {
	// 加载css
	wp_enqueue_style( 'wp_yiqi-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'wp_yiqi-main', get_template_directory_uri() . '/assets/css/main.css', array(), _S_VERSION );
	wp_enqueue_style( 'wp_yiqi-flexslider-css', '//cdn.bootcss.com/flexslider/2.6.3/flexslider.min.css', array(), _S_VERSION );

	// 加载页眉js
	wp_enqueue_script('wp_yiqi-jquery', '//cdn.bootcdn.net/ajax/libs/jquery/1.12.4/jquery.min.js', array(), _S_VERSION, false );
	wp_enqueue_script('wp_yiqi-flexslider-js', '//cdn.bootcss.com/flexslider/2.6.3/jquery.flexslider-min.js', array(), _S_VERSION, false );
	if ( is_home() || is_front_page() ) { //判断首页与内页
		wp_enqueue_script('wp_yiqi-superslide-js', get_template_directory_uri() . '/assets/js/jquery.SuperSlide.2.1.3.js', array(), _S_VERSION, false );
		wp_enqueue_script( 'wp_yiqi-jquery-superslide', get_template_directory_uri() . '/assets/js/jquery.superslide.js', array(), _S_VERSION, false );
	}
	wp_enqueue_script( 'wp_yiqi-header', get_template_directory_uri() . '/assets/js/header.js', array(), _S_VERSION, false );
	
	// 加载页脚js
	if ( is_home() || is_front_page() ) { //判断首页与内页
		wp_enqueue_script( 'wp_yiqi-footer-index', get_template_directory_uri() . '/assets/js/footer-index.js', array(), _S_VERSION, true );
	} else {
		wp_enqueue_script( 'wp_yiqi-footer-sidebar', get_template_directory_uri() . '/assets/js/footer-sidebar.js', array(), _S_VERSION, true );
	}
	wp_enqueue_script( 'wp_yiqi-footer', get_template_directory_uri() . '/assets/js/footer.js', array(), _S_VERSION, true );
	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_yiqi_scripts' );

/**
 * 实现自定义头特性。
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * 此主题的自定义模板标记。
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * 通过连接到WordPress来增强主题的功能。
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * 编辑器添加。
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * 加载Jetpack兼容文件。
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
