<?php



//wp_register_script：样式表唯一名称,样式表的URL,依赖关系:脚本将在该数组所包含的其他脚本之后处理,指定版本号,移动到页脚
//wp_register_style：样式表唯一名称,样式表的URL,依赖关系:脚本将在该数组所包含的其他脚本之后处理,指定版本号,CSS的媒体类型
//加载文件到前台
	function myScripts() {
		wp_register_style( 'bootstrap_css', 'https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css', '', null, 'all' );
		wp_register_style( 'style_css', get_template_directory_uri() . '/style.css', '', wp_get_theme()->get('Version'), 'all' );
		wp_register_style( 'animate_css', 'https://cdn.staticfile.org/animate.css/3.7.2/animate.min.css', '', null, 'screen' );
		wp_register_style( 'screen_css', get_template_directory_uri() . '/res/css/style_screen.css', 'style_css', wp_get_theme()->get('Version'), 'screen' );

		wp_register_script( 'jquery_js', 'https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js', '', null, true );
		wp_register_script( 'jquery_qrcode', 'https://cdn.staticfile.org/jquery.qrcode/1.0/jquery.qrcode.min.js', 'jquery_js', null, true );
		wp_register_script( 'jquery_popper', 'https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js', 'jquery_js', null, true );
		wp_register_script( 'bootstrap_js', 'https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js', 'jquery_js', null, true );
		wp_register_script( 'uuui_js', get_template_directory_uri() . '/res/js/uuui.js', 'jquery_js', wp_get_theme()->get('Version'), true );
		if ( !is_admin() ) { /** Load Scripts and Style on Website Only */
			wp_deregister_script( 'jquery' );
			wp_enqueue_style( 'bootstrap_css' );
			wp_enqueue_style( 'style_css' );
			wp_enqueue_style( 'animate_css' );
			wp_enqueue_style( 'screen_css' );

			wp_enqueue_script( 'jquery_js' );
			wp_enqueue_script( 'jquery_qrcode' );
			wp_enqueue_script( 'jquery_popper' );
			wp_enqueue_script( 'bootstrap_js' );
			wp_enqueue_script( 'uuui_js' );
		}
	}
	add_action( 'init', 'myScripts' );
//加载文件到自定义页面
	function spScripts() {
		if ( is_single() ) {
			wp_register_style( 'fontawesome', 'https://cdn.staticfile.org/font-awesome/5.12.0-1/css/all.min.css', '', null, 'all' );
			wp_register_style( 'single_css', get_template_directory_uri() . '/res/css/style_single.css', 'style_css', wp_get_theme()->get('Version'), 'screen' );
			
			wp_register_script( 'single_js', get_template_directory_uri() . '/res/js/single.js', 'jquery_js', wp_get_theme()->get('Version'), true );
			wp_register_script( 'code_prettify', 'https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js?skin=sunburst', '', null, true );

			wp_enqueue_style( 'fontawesome' );
			wp_enqueue_style( 'single_css' );
			wp_enqueue_script( 'single_js' );
			wp_enqueue_script( 'code_prettify' );
		}
		if ( is_page() ) {
			wp_register_style( 'page_css', get_template_directory_uri() . '/res/css/style_page.css', 'style_css', wp_get_theme()->get('Version'), 'screen' );
			
			wp_enqueue_style( 'page_css' );
		}

	}
	add_action( 'wp_enqueue_scripts', 'spScripts' );




//网站前/后台优化Reception
	include( 'functions/functions_optimization.php' );




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




/* —— 语言本地化 —— */
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('uuui', get_template_directory() . '/languages');
}
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


/* —— 自定义WordPress表情 —— */
#function filter_smilies_src($img_src, $img, $siteurl) {
#    return get_bloginfo('stylesheet_directory') . '/images/smilies/' . $img;
#}
#add_filter('smilies_src', 'filter_smilies_src', 1, 10);
/* —— 自定义WordPress表情 —— 结束 */





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
		echo '<img src="https://img.shields.io/badge/'. __('当前版本', 'uuui') .'-'. wp_get_theme()->get( 'Version' ) .'-green.svg" alt="当前版本">&nbsp;&nbsp;';
		echo '<img src="https://img.shields.io/github/v/release/sameenzjt/UUUI-wordpresstheme?include_prereleases&label='. __('最新版本', 'uuui') .'" alt="最新版本">&nbsp;&nbsp;';
		printf('<a href="%1$s"><img src="https://img.shields.io/badge/'. __('反馈', 'uuui') .'-issues-red.svg" alt="反馈"></a>', 'https://github.com/sameenzjt/UUUI-wordpresstheme/issues');
		printf(__('<p>E-mail：%1$s / QQ：%2$d</p>', 'uuui'),'sameen.zjt@gmail.com','2459012173');
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
		echo '<ul class="pagination">';
		if ( empty( $paged ) ) $paged = 1;
		echo '<li class="page-item"><span class="page-link">'; previous_posts_link('上一页'); echo '</span></li>';
		if ( $paged > $p + 1 ) _paging_link( 1, '<li class="page-item"><span class="page-link">第一页</span></li>' );
		if ( $paged > $p + 2 ) echo "<li class='page-item disabled'><span class='page-link'>···</span></li>";
		for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { 
			if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<li class=\"page-item active\"><span class='page-link'> {$i} </span></li>" : _paging_link( $i );
		}
		if ( $paged < $max_page - $p - 1 ) echo "<li class='page-item disabled'><span class='page-link'> ... </span></li>";
		echo '<li class="page-item"><span class="page-link">'; next_posts_link('下一页'); echo '</span></li>';
		echo '<li class="page-item disabled"><span class="page-link">共 '.$max_page.' 页</span></li>';
		echo '</ul>';
	}

	function _paging_link( $i, $title = '' ) {
		if ( $title == '' ) $title = "第 {$i} 页";
		echo "<li><span class='page-link'><a href='", esc_html( get_pagenum_link( $i ) ), "'>{$i}</a></span></li>";
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

/** ***************************************短代码********************************************* */

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
/** ***************************************短代码 结束********************************************* */

/** ***************************************小工具********************************************* */

/** 小工具区域代码 */
add_filter('widget_text', 'do_shortcode');//让文本小工具支持简码
function register_widget_areas() {

	register_sidebar( array(
		'name'          => '首页侧边栏',	//小工具区域的名称，在WP后台中显示
		'id'            => 'index_sidebar_widget',	//小工具区域的唯一ID。必须全部为小写且不能有空格
		'description'   => '首页右侧侧边栏，页面宽度小于991px时会隐藏',	//将在管理后台显示的小工具区域的描述
		'before_widget' => '<div class="border-radius-4 index-sidebar-box">',	//放置在小工具前面的一些html。通常，使用像div或section标签之类的开头的容器标签
		'after_widget'  => '</div>',	//放置在小工具后面的一些html。通常，关闭容器标签（例如div或section标签）
		'before_title'  => '<h5 class="index-sidebar-title">',	//放置在小工具标题前面的一些html。通常是H标题标签
		'after_title'   => '</h5><div class="dropdown-divider"></div>',	//放置在小工具标题后面的一些html。通常是一个关闭的H标题标签
	));
  
}
add_action( 'widgets_init', 'register_widget_areas' );
/** 小工具区域代码 —— 结束 */

/** 修改WordPress自带标签云小工具的显示参数 */
add_filter( 'widget_tag_cloud_args', 'theme_tag_cloud_args' );
function theme_tag_cloud_args( $args ){
	$newargs = array(
		'smallest'    => 10,  //最小字号
		'largest'     => 18, //最大字号
		'unit'        => 'px',   //字号单位，可以是pt、px、em或%
		'number'      => 45,     //显示个数
		'format'      => 'flat',//列表格式，可以是flat、list或array
		'separator'   => "\n",   //分隔每一项的分隔符
		'orderby'     => 'name',//排序字段，可以是name或count
		'order'       => 'ASC', //升序或降序，ASC或DESC
		'exclude'     => null,   //结果中排除某些标签
		'include'     => null,  //结果中只包含这些标签
		'link'        => 'view', //taxonomy链接，view或edit
		'taxonomy'    => 'post_tag', //调用哪些分类法作为标签云
	);
	$return = array_merge( $args, $newargs);
	return $return;
}
/** 修改WordPress自带标签云小工具的显示参数 —— 结束 */

/** 自定义get_search_form函数样式 get_search_form( $echo ); */
function my_search_form( $form ) {
 
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<div class="input-group mb-3">
	<input type="text" class="form-control" placeholder="' . __('Search', 'uuui') . '" value="' . get_search_query() . '" name="s" id="s">
	<div class="input-group-append">
	<button class="btn btn-success"  id="searchsubmit" type="submit" value="'. esc_attr__('Search') .'">' . __('Search') . '</button>  
	</div>
	</div>
	</form>
	';
 
    return $form;
}
 
add_filter( 'get_search_form', 'my_search_form' );
/** 修改WordPress自带标签云小工具的显示参数 —— 结束 */

/** 为“分类目录”和“文章归档”小工具的文章数目添加span标签 —— */
//为“分类目录”的文章数目添加span
function wpkj_cat_count_span( $links ) {
    $links = str_replace( '</a> (', '</a><span class="post-count">(', $links );
    $links = str_replace( ')', ')</span>', $links );
    return $links;
}
add_filter( 'wp_list_categories', 'wpkj_cat_count_span' );

//为“文章归档”的文章数目添加span
function wpkj_archive_count_span( $links ) {
    $links = str_replace( '</a>&nbsp;(', '</a><span class="post-count">(', $links );
    $links = str_replace( ')', ')</span>', $links );
    return $links;
}
add_filter( 'get_archives_link', 'wpkj_archive_count_span' );
/** 修改WordPress自带标签云小工具的显示参数 —— 结束 */

/** ***************************************小工具 结束********************************************* */


/** ***************************************评论********************************************* */

//ajax无刷新评论
require('ajax-comment/main.php');

/*
 * 评论列表的显示样式 */

if ( ! function_exists( 'bootstrapwp_comment' ) ) :
	function bootstrapwp_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		  // 用不同于其它评论的方式显示 trackbacks 。
		?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php _e( 'Pingback:', 'uuui' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'uuui' ), '<span class="edit-link">', '</span>' ); ?>
				</p>
			</li>
		<?php break; default :  global $post;// 开始正常的评论 ?>
			<li <?php comment_class('media border p-3'); ?> id="comment-<?php comment_ID(); ?>">
				
				<?php $comment_author = get_comment_author_link() ;
				$comment_avatar = array(
					'class' => 'mr-3 mt-3 align-self-start',
				); ?>
				<?php echo get_avatar( $comment, $size = '64', '', $comment_author, $comment_avatar )?>
					
				<?php if ( '0' == $comment->comment_approved ) : // 未审核的评论显示一行提示文字 ?>
					<p class="comment-awaiting-moderation">
					<?php _e( 'Your comment is awaiting moderation.', 'uuui' ); ?>
					</p>
				<?php endif; ?>
				<div class="media-body">
					<strong> <?php printf( '%1$s %2$s',// 显示评论作者名称 
							get_comment_author_link(),
							// 如果当前文章的作者也是这个评论的作者，那么会出现一个标签提示。
							( $comment->user_id === $post->post_author ) ? '<span class="badge badge-pill badge-primary"> ' . __( 'Post author', 'uuui' ) . '</span>' : ''
						); ?>
					</strong>
					<p class="font-size-small">
						<?php printf( '<time datetime="%1$s">%2$s</time>', get_comment_time( 'c' ), sprintf( __( '%1$s %2$s', 'uuui' ), get_comment_date(), get_comment_time() ));?>
						<?php  edit_comment_link( __( 'Edit', 'uuui' ), '<span class="edit-link">', '</span>' ); ?>
					</p>

					<?php  comment_text(); ?>
					
					<?php // 显示评论的回复链接 
						comment_reply_link( array_merge( $args, array( 
						'reply_text' =>  __( 'Reply'), 
						'depth'      =>  $depth, 
						'max_depth'  =>  $args['max_depth'] ) ) ); 
					?>

				</div>
			</li>
		<?php break; endswitch; // end comment_type check
			}
			endif;


/**
 * 修改评论回复按钮链接
 */
global $wp_version;
if (version_compare($wp_version, '5.1.1', '>=')) {
    add_filter('comment_reply_link', 'theme_replace_comment_reply_link', 10, 4);
    function theme_replace_comment_reply_link($link, $args, $comment, $post)
    {
        if (get_option('comment_registration') && !is_user_logged_in()) {
            $link = sprintf(
                '<a rel="nofollow" class="comment-reply-login" href="%s">%s</a>',
                esc_url(wp_login_url(get_permalink())),
                $args['login_text']
            );
        } else {
            $onclick = sprintf(
                'return addComment.moveForm( "%1$s-%2$s", "%2$s", "%3$s", "%4$s" )',
                $args['add_below'],
                $comment->comment_ID,
                $args['respond_id'],
                $post->ID
            );
            $link = sprintf(
                "<a rel='nofollow' class='comment-reply-link' href='%s' onclick='%s' aria-label='%s'>%s</a>",
                esc_url(add_query_arg('replytocom', $comment->comment_ID, get_permalink($post->ID))) . "#" . $args['respond_id'],
                $onclick,
                esc_attr(sprintf($args['reply_to_text'], $comment->comment_author)),
                $args['reply_text']
            );
        }
        return $link;
    }
}

// 评论添加@，by Ludou
function ludou_comment_add_at( $comment_text, $comment = '') {
	if( $comment->comment_parent > 0) {
	  $comment_text = '@<a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
	}
  
	return $comment_text;
  }
  add_filter( 'comment_text' , 'ludou_comment_add_at', 20, 2);
/** ***************************************评论 结束********************************************* */













?>