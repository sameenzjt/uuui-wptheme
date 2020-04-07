<?php

	include( 'functions/optimization_reception.php' );//网站前台优化Reception
	include( 'functions/optimization_backstage.php' );//网站后台优化Backstage

/* —— 保护后台登录 —— */
	/*add_action('login_enqueue_scripts','login_protection');  
	function login_protection(){
		if($_GET['page'] != 'login')header('Location:'.home_url());
	}*/
/* —— 保护后台登录 —— 结束 */


/* —— 后台禁用古腾堡编辑器 —— */
	add_filter('use_block_editor_for_post', '__return_false');
	remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );
/* —— 后台禁用古腾堡编辑器 —— 结束 */


/**
  *WordPress 自定义文章编辑器的样式
  *自定义 CSS 文件
  *http://www.endskin.com/editor-style/
*/
	function Bing_add_editor_style(){
		add_editor_style( 'https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css' );//引入外部的 CSS 文件
		add_editor_style( '/res/css/custom-editor-style.css' );//这样就会调用主题目录 CSS 文件夹的 custom-editor-style.css 文件
	}
	add_action( 'after_setup_theme', 'Bing_add_editor_style' );


	/* —— 语言本地化 —— */
	function myplugin_init() {
		load_plugin_textdomain( 'uuui', false , dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
	add_action('plugins_loaded', 'myplugin_init');
/* —— 语言本地化 —— 结束 */


/* —— 注册菜单 —— */
	register_nav_menus( array(
		'nav_menu' => '导航栏菜单',
		'footer_menu_1' => '页脚导航左',
		'footer_menu_2' => '页脚导航中',
		'footer_menu_3' => '页脚导航右',
		'support_menu' => '支持与服务',
	) );
	//菜单回调函数
	function nav_menus_fallback(){
		echo '<div class="menu-alert">'.__( '请在 “后台 - 外观 - 菜单” 设置导航菜单','uuui' ).'</div>';
	}
/* —— 注册菜单 —— 结束 */


/* —— 启用特色图片 —— 
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	set_post_thumbnail_size( 200, 200, true );
}
 —— 启用特色图片 —— 结束 */


/* —— 后台启用链接选项 —— */
	add_filter( 'pre_option_link_manager_enabled', '__return_true' );
/* —— 后台启用链接选项 —— 结束 */


/* —— ACF插件 —— */
	// Define path and URL to the ACF plugin.
	define( 'MY_ACF_PATH', get_stylesheet_directory() . '/includes/acf/' );
	define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/includes/acf/' );
	// Include the ACF plugin.
	include_once( MY_ACF_PATH . 'acf.php' );
	// Customize the url setting to fix incorrect asset URLs.
	add_filter('acf/settings/url', 'my_acf_settings_url');
	function my_acf_settings_url( $url ) {
		return MY_ACF_URL;
	}
	add_filter('acf/settings/show_admin', '__return_false');//隐藏 ACF 前端菜单
	include( 'functions/acf.php' );//本地字段组
/* —— ACF插件 —— 结束 */



/* —— 后台主题设置optionsframework —— */
	if (!function_exists('optionsframework_init')){
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri().'/inc/');
		require_once dirname(__FILE__).'/inc/options-framework.php';
	}
	$optionsfile = locate_template( 'options.php' );
	load_template( $optionsfile );

	add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

	function optionsframework_custom_scripts() { ?>

	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#example_showhidden').click(function() {
			jQuery('#section-example_text_hidden').fadeToggle(400);
		});

		if (jQuery('#example_showhidden:checked').val() !== undefined) {
			jQuery('#section-example_text_hidden').show();
		}
	});
	</script>
	<?php
	}

	//让optionsframework支持js语句
	add_action('admin_init','optionscheck_change_santiziation', 100);
	
	function optionscheck_change_santiziation() {
		remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
		add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
	}
	
	function custom_sanitize_textarea($input) {
		global $allowedposttags;
		$custom_allowedtags["embed"] = array(
		"src" => array(),
		"type" => array(),
		"allowfullscreen" => array(),
		"allowscriptaccess" => array(),
		"height" => array(),
			"width" => array()
		);
		$custom_allowedtags["script"] = array(
			"src" => array(),
			"type" => array(),
		);
	
		$custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
		$output = wp_kses( $input, $custom_allowedtags);
		return $output;
	}

/* —— 后台主题设置optionsframework —— 结束 */


/* —— 显示时间为几天前(存在Bug，最新发表的文章会显示“8小时前”) —— */
/*	function Bing_filter_time() {
		global $post ;
		$to = time();
		$from = get_the_time('U') ;
		$diff = (int) abs($to - $from);
		if ($diff <= 3600) {
			$mins = round($diff / 60);
			if ($mins <= 1) {
				$mins = 1;
			}
			$time = sprintf(_n('%s', '%s', $mins), $mins) . __('分钟前' , 'uuui');
		} else if (($diff <= 86400) && ($diff > 3600)) {
			$hours = round($diff / 3600);
			if ($hours <= 1) {
				$hours = 1;
			}
			$time = sprintf(_n('%s', '%s', $hours), $hours) . __('小时前' , 'uuui');
		} elseif ($diff >= 86400) {
			$days = round($diff / 86400);
			if ($days <= 1) {
				$days = 1;
				$time = sprintf(_n('%s', '%s', $days), $days) . __('天前' , 'uuui');
			} elseif ($days > 29) {
				$time = get_the_time(get_option('date_format'));
			} else {
				$time = sprintf(_n('%s', '%s', $days), $days) . __('天前' , 'uuui');
			}
		}
		return $time;
	}
	add_filter('the_time','Bing_filter_time');
	*/
/* —— 显示时间为几天前 —— 结束 */


/* —— WordPress文章/页面的站外链接自动添加nofollow属性和新窗口打开 —— */
	add_filter( 'the_content', 'cn_nf_url_parse');
	function cn_nf_url_parse( $content ) {
		$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
		if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
			if( !empty($matches) ) {
				$srcUrl = get_option('siteurl');
				for ($i=0; $i < count($matches); $i++)
				{
					$tag = $matches[$i][0];
					$tag2 = $matches[$i][0];
					$url = $matches[$i][0];
					$noFollow = '';
					$pattern = '/target\s*=\s*"\s*_blank\s*"/';
					preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
					if( count($match) < 1 )
						$noFollow .= ' target="_blank" ';
						$pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
					preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
					if( count($match) < 1 )
						$noFollow .= ' rel="nofollow" ';
						$pos = strpos($url,$srcUrl);
					if ($pos === false) {
						$tag = rtrim ($tag,'>');
						$tag .= $noFollow.'>';
						$content = str_replace($tag2,$tag,$content);
					}
				}
			}
		}
		$content = str_replace(']]>', ']]>', $content);
		return $content;
	}
/* —— WordPress文章/页面的站外链接自动添加nofollow属性和新窗口打开 —— 结束 */


//分类目录添加图像
include( 'functions/categories-images.php' );

//向 WordPress 可视化编辑器添加自定义样式
include( 'functions/custom-editor.php' );

//自定义文章类型
//include( 'functions/post-type-link.php' );

//面包屑导航调用：if(function_exists('cmp_breadcrumbs')) cmp_breadcrumbs();
include( 'functions/breadcrumb.php' );

//快速添加友情链接（设置——阅读）按照 链接 |标题 的方式输入 调用：if (function_exists(wpjam_blogroll)) wpjam_blogroll();
include( 'functions/WPJAM-Blogroll.php' );

//自定义登录页面
include( 'functions/custom_login.php' );


/* —— 字数统计 —— 使用echo count_words_read_time();调用
//字数和预计阅读时间统计
function count_words_read_time () {
	global $post;
		$output = '';
	   	$text_num = mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8');
	   	$read_time = ceil($text_num/400);
	   	$output .= '本文共' . $text_num . '个字，预计阅读时间' . $read_time  . '分钟。';
	   	return $output;
	}
 —— 字数统计 —— 结束 */


/* —— 支持中文用户名 —— */
	function ludou_sanitize_user ($username, $raw_username, $strict) {
		$username = wp_strip_all_tags( $raw_username );
		$username = remove_accents( $username );
		// Kill octets
		$username = preg_replace( '|%([a-fA-F0-9][a-fA-F0-9])|', '', $username );
		$username = preg_replace( '/&.+?;/', '', $username ); // Kill entities
		// 网上很多教程都是直接将$strict赋值false，
		// 这样会绕过字符串检查，留下隐患
		if ($strict) {
		$username = preg_replace ('|[^a-z\p{Han}0-9 _.\-@]|iu', '', $username);
		}
		$username = trim( $username );
		// Consolidate contiguous whitespace
		$username = preg_replace( '|\s+|', ' ', $username );
		return $username;
	}
	add_filter ('sanitize_user', 'ludou_sanitize_user', 10, 3);
/* —— 支持中文用户名 —— 结束 */

/** —— 自定义 WordPress 的默认 Gravatar 头像 ——https://www.wpdaxue.com/change-wordpress-default-gravatar.html */
add_filter( 'avatar_defaults', 'newgravatar' );
function newgravatar ($avatar_defaults) {
    $myavatar = get_bloginfo('template_directory') . '/images/default_avatar_1.jpg';  
    $avatar_defaults[$myavatar] = "默认头像1（主题）";
    return $avatar_defaults;  
}
/** —— 自定义 WordPress 的默认 Gravatar 头像 —— 结束 */



/* —— 添加帮助面板 ——https://www.ludou.org/wordpress-customizing-the-dashboard-widgets.html */
	function ludou_dashboard_help() {
		$file_get_contents = file_get_contents( "https://sameenzjt.github.io/version.txt" );
		$my_theme = wp_get_theme();
		echo "当前主题版本：" . $my_theme->get( 'Name' ) . "&nbsp;" . $my_theme->get( 'Version' ) . "<br />";
		echo "最新版本：" . $file_get_contents;
		echo '<p>有事请与我联系，Email: sameen.zjt@gmail.com   QQ: 2459012173</p>';
		// 如以下一行代码是露兜博客开放投稿功能所使用的投稿说明
		// echo "<p><ol><li>投稿，请依次点击 文章 - 添加新文章，点击 "送交审查" 即可提交</li><li>修改个人资料，请依次点击 资料 - 我的资料</li><li>请认真填写“个人说明”，该信息将会显示在文章末尾</li><li>有事请与我联系，Email: zhouzb889@gmail.com   QQ: 825533758</li></ol></p>";     
	}
	function ludou_add_dashboard_widgets() {
		wp_add_dashboard_widget('ludou_help_widget', 'UUUI主题帮助', 'ludou_dashboard_help');
	}
	add_action('wp_dashboard_setup', 'ludou_add_dashboard_widgets' );
/* —— 添加帮助面板 —— 结束 */


/* —— 阅读数postviews 使用get_post_views($post -> ID);调用 —— 结束 */
  //postviews   
	function get_post_views ($post_id) {
		$count_key = 'views';   
		$count = get_post_meta($post_id, $count_key, true); 
		if ($count == '') {   
			delete_post_meta($post_id, $count_key);   
			add_post_meta($post_id, $count_key, '0');   
			$count = '0';   
		}
		echo number_format_i18n($count);
	}
	function set_post_views () {
		global $post;
		$post_id = $post -> ID;   
		$count_key = 'views';   
		$count = get_post_meta($post_id, $count_key, true);
		if (is_single() || is_page()) {
			if ($count == '') {   
				delete_post_meta($post_id, $count_key);   
				add_post_meta($post_id, $count_key, '0');   
			} else {   
				update_post_meta($post_id, $count_key, $count + 1);   
			}
		}
	}   
	add_action('get_header', 'set_post_views');  
/* —— 阅读数postviews —— 结束 */


/* —— 分页 —— */
	function mo_paging() {
		$p = 3;
		if ( is_singular() ) return;
		global $wp_query, $paged;
		$max_page = $wp_query->max_num_pages;
		if ( $max_page == 1 ) return; 
		echo '<div class="pagination"><ul class="pagination">';
		if ( empty( $paged ) ) $paged = 1;
		echo '<li class="page-item"><span class="page-link">'; previous_posts_link('上一页'); echo '</span></li>';
		if ( $paged > $p + 1 ) _paging_link( 1, '<li class="page-item">第一页</li>' );
		if ( $paged > $p + 2 ) echo "<li class='page-item disabled'><span class='page-link'>···</span></li>";
		for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { 
			if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<li class=\"page-item active\"><span class='page-link'>{$i}</span></li>" : _paging_link( $i );
		}
		if ( $paged < $max_page - $p - 1 ) echo "<li class='page-item disabled'><span class='page-link'> ... </span></li>";
		echo '<li class="page-item"><span class="page-link">'; next_posts_link('下一页'); echo '</span></li>';
		echo '<li class="page-item disabled"><span class="page-link">共 '.$max_page.' 页</span></li>';
		echo '</ul></div>';
	}

	function _paging_link( $i, $title = '' ) {
		if ( $title == '' ) $title = "第 {$i} 页";
		echo "<li><a class='page-link' href='", esc_html( get_pagenum_link( $i ) ), "'>{$i}</a></li>";
	}
/* —— 分页 —— 结束 */


/**显示页面查询次数、加载时间和内存占用
 * 默认在页脚显示 From wpdaxue.com
 * 调用：if(function_exists('performance')) performance(false) ;
*/
	function performance( $visible = false ) {
		$stat = sprintf(  '%d queries in %.3f seconds, using %.2fMB memory',
			get_num_queries(),
			timer_stop( 0, 3 ),
			memory_get_peak_usage() / 1024 / 1024
		);
		echo $visible ? $stat : "<!-- {$stat} -->" ;
	};
	add_action( 'wp_footer', 'performance', 20 );

/**显示页面查询次数、加载时间和内存占用 —— 结束*/


/** —— 文章编辑页将作者模块移到发布模块内 ——*/
	add_action( 'admin_menu', 'remove_author_metabox' );
	add_action( 'post_submitbox_misc_actions', 'move_author_to_publish_metabox' );
	function remove_author_metabox() {
		remove_meta_box( 'authordiv', 'post', 'normal' );
	}
	function move_author_to_publish_metabox() {
		global $post_ID;
		$post = get_post( $post_ID );
		echo '<div id="author" class="misc-pub-section" style="border-top-style:solid; border-top-width:1px; border-top-color:#EEEEEE; border-bottom-width:0px;">作者： ';
		post_author_meta_box( $post );
		echo '</div>';
	}
/** —— 文章编辑页将作者模块移到发布模块内 —— 结束*/



/**
 * 自定义用户个人资料信息
 * https://www.wpdaxue.com/add-remove-display-wordpress-user-profile-fields.html
 */
	add_filter( 'user_contactmethods', 'wpdaxue_add_contact_fields' );
	function wpdaxue_add_contact_fields( $contactmethods ) {
		$contactmethods['qq'] = 'QQ';
		$contactmethods['qq_email'] = 'QQ邮箱';
		$contactmethods['weibo'] = '微博';
		$contactmethods['wechat'] = '微信';
		//unset( $contactmethods['yim'] );
		//unset( $contactmethods['aim'] );
		//unset( $contactmethods['jabber'] );
		return $contactmethods;
	}
/** 自定义用户个人资料信息 —— 结束 */




/** —— 搜索相关代码 —— */
	//提高搜索结果相关性
	if(is_search()){
		add_filter('posts_orderby_request', 'search_orderby_filter');
		}
		function search_orderby_filter($orderby = ''){
			global $wpdb;
			$keyword = $wpdb->prepare($_REQUEST['s']);
			return "((CASE WHEN {$wpdb->posts}.post_title LIKE '%{$keyword}%' THEN 2 ELSE 0 END) + (CASE WHEN {$wpdb->posts}.post_content LIKE '%{$keyword}%' THEN 1 ELSE 0 END)) DESC,
		{$wpdb->posts}.post_modified DESC, {$wpdb->posts}.ID ASC";
		}
	//搜索结果排除所有页面
	function search_filter_page($query) {
		if ($query->is_search) {
			$query->set('post_type', 'post');
		}
		return $query;
	}
	add_filter('pre_get_posts','search_filter_page');
/** —— 搜索相关代码 —— 结束*/


/** —— 更改搜索结果URL ——*/
function change_search_url_rewrite() {
	if ( is_search() && ! empty( $_GET['s'] ) ) {
		wp_redirect( home_url( '/search/' ) . urlencode( get_query_var( 's' ) ) . '/');
		exit();
	}
}
add_action( 'template_redirect', 'change_search_url_rewrite' );
/** —— 更改搜索结果URL —— 结束*/


/** —— WordPress支持WebP格式的图片 —— */
	//上传WebP格式的图片
	function dyn_filter_mime_types( $array ) {
		$array['webp'] = 'image/webp';
		return $array; 
	}
	add_filter( 'mime_types', 'dyn_filter_mime_types', 10, 1 );
	//显示WebP格式的图片
	function dyn_file_is_displayable_image($result, $path) {
		$info = @getimagesize( $path );
		if($info['mime'] == 'image/webp') {
			$result = true;
		}
		return $result;
	}
	add_filter( 'file_is_displayable_image', 'dyn_file_is_displayable_image', 10, 2 );
/** —— WordPress支持WebP格式的图片 —— 结束*/


  

/**
 * WordPress 更改文章密码保护后显示的提示内容
 * https://www.wpdaxue.com/change-password-protected-text.html
 */
function password_protected_change( $content ) {
	global $post;
    if ( ! empty( $post->post_password ) ) {
		$output = '
			<div class="alert alert-info">
				<strong>信息!</strong> '.__( "这是一篇受密码保护的文章，您需要提供访问密码","uuui").'
			</div>
			<form action="' . get_option( 'siteurl' ) . '/wp-login.php?action=postpass" method="post" class="form-group">
				<label for="post_password">密码：</label>
				<input type="password" name="post_password" class="form-control" size="20" />
				<input type="submit" name="Submit" class="btn btn-primary" value="' . __( "提交","uuui" ) . '" />
			</form>
        ';
        return $output;
    } else {
        return $content;
    }
}
add_filter( 'the_password_form','password_protected_change' );
/** WordPress 更改文章密码保护后显示的提示内容 —— 结束 */


/** 短代码--文章内链 */
function fa_insert_posts( $atts, $content = null ){
    extract( shortcode_atts( array(
        'ids' => ''
    ),
        $atts ) );
    global $post;
    $content = '';
	$postids =  explode(',', $ids);
    $inset_posts = get_posts(array('post__in'=>$postids));
    foreach ($inset_posts as $key => $post) {
        setup_postdata( $post );
		$article_image = get_field('article-cover-images',$post);
		$content .=  '
		<a target="_blank" class="label--thTitle" href="' . get_permalink() . '">
			<div class="insert-post-div row" style="width: 100%; padding:20px;margin:15px 0px;">
				<div class="col-lg-2 col-sm-3 col-md-2" id="insert-post-img" style="background-image:url(' . $article_image . ');"></div>
				<div class="col-lg-8 col-sm-6 col-md-8">
					<h2 class="insert-post-title">' . get_the_title() . '</h2>
					<p class="insert-post-description font-size-small-14">' . mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 90,"......") . '</p>
				</div>
				<div class="col-lg-2 col-sm-3 col-md-2">
					<div style="margin:0px auto;padding-top:20px;">》</div>
				</div>
				
			</div>
		</a>';
    }
    wp_reset_postdata();
    return $content;
}
add_shortcode('fa_insert_post', 'fa_insert_posts');
/** 短代码--文章内链 —— 结束 */


/** 短代码--插入B站视频 */
function video_bilibili($atts, $content = null) {   
	extract(shortcode_atts(array("width"=>'100%',"height"=>''),$atts));
	return'<iframe class="video-bilibili" height="'.$height.'" width="'.$width.'" src="'.$content.'" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe>';
	}  
	add_shortcode('video_bilibili','video_bilibili');
/** 短代码--插入B站视频 —— 结束 */


/** 小工具区域代码 */

add_filter('widget_text', 'do_shortcode');//让文本小工具支持简码

function register_widget_areas() {

	register_sidebar( array(
		'name'          => 'Footer area one',	//小工具区域的名称，在WP后台中显示
		'id'            => 'footer_area_one',	//小工具区域的唯一ID。必须全部为小写且不能有空格
		'description'   => 'This widget area discription',	//将在管理后台显示的小工具区域的描述
		'before_widget' => '',	//放置在小工具前面的一些html。通常，使用像div或section标签之类的开头的容器标签
		'after_widget'  => '',	//放置在小工具后面的一些html。通常，关闭容器标签（例如div或section标签）
		'before_title'  => '<h5 class="index-sidebar-title">',	//放置在小工具标题前面的一些html。通常是H标题标签
		'after_title'   => '</h5><div class="dropdown-divider"></div>',	//放置在小工具标题后面的一些html。通常是一个关闭的H标题标签
	));
  
  }
  
add_action( 'widgets_init', 'register_widget_areas' );


/** 小工具区域代码 —— 结束 */



/** 评论 */

// 评论添加@，by Ludou
function ludou_comment_add_at( $comment_text, $comment = '') {
	if( $comment->comment_parent > 0) {
	  $comment_text = '@<a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
	}
  
	return $comment_text;
  }
  add_filter( 'comment_text' , 'ludou_comment_add_at', 20, 2);

/** 评论 —— 结束 */




?>