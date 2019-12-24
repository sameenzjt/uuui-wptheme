<?php

/* —— 后台禁用谷歌字体 —— */
function coolwp_remove_open_sans_from_wp_core() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'coolwp_remove_open_sans_from_wp_core' );


/* —— 后台禁用古腾堡编辑器 —— */
add_filter('use_block_editor_for_post', '__return_false');


/**
  *WordPress 自定义文章编辑器的样式
  *自定义 CSS 文件
  *http://www.endskin.com/editor-style/
*/
function Bing_add_editor_style(){
	add_editor_style( 'https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css' );//引入外部的 CSS 文件
	add_editor_style( 'res/css/custom-editor-style.css' );//这样就会调用主题目录 CSS 文件夹的 custom-editor-style.css 文件
  }
  add_action( 'after_setup_theme', 'Bing_add_editor_style' );


/* —— 禁用工具栏 —— */
add_action("user_register", "set_user_admin_bar_false_by_default", 10, 1);
function set_user_admin_bar_false_by_default($user_id) {
    update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
    update_user_meta( $user_id, 'show_admin_bar_admin', 'false' );
}
/* —— 禁用工具栏 —— 结束 */


/* —— 语言本地化 —— */
function myplugin_init() {
	load_plugin_textdomain( 'uuui', false , dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
  }
  add_action('plugins_loaded', 'myplugin_init');
/* —— 语言本地化 —— 结束 */


/* —— 注册菜单 —— */
register_nav_menus( array(
	'nav_menu' => '导航栏菜单',
	'footer_menu_1' => '页脚导航1',
	'footer_menu_2' => '页脚导航2',
	'footer_menu_3' => '页脚导航3',
) );
/* —— 注册菜单 —— 结束 */


/* —— 启用特色图片 —— */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	set_post_thumbnail_size( 200, 200, true );
}
/* —— 启用特色图片 —— 结束 */


/* —— 后台启用链接选项 —— */
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
/* —— 后台启用链接选项 —— 结束 */


/**
 * ACF插件
 */
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
/**
 * ACF插件————结束
 */



/* —— 自定义登出之后的重定向链接 ——   
add_action('wp_logout','auto_redirect_after_logout');   
function auto_redirect_after_logout(){   
  wp_redirect( home_url() );   
  exit();   
}
 —— 自定义登出之后的重定向链接 —— 结束 */ 


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
/* —— 后台主题设置optionsframework —— 结束 */


/* —— 显示时间为几天前 —— */
function Bing_filter_time() {
    global $post ;
    $to = time();
    $from = get_the_time('U') ;
    $diff = (int) abs($to - $from);
    if ($diff <= 3600) {
        $mins = round($diff / 60);
        if ($mins <= 1) {
            $mins = 1;
        }
        $time = sprintf(_n('%s分钟', '%s分钟', $mins), $mins) . __('前' , 'uuui');
    } else if (($diff <= 86400) && ($diff > 3600)) {
        $hours = round($diff / 3600);
        if ($hours <= 1) {
            $hours = 1;
        }
        $time = sprintf(_n('%s小时', '%s小时', $hours), $hours) . __('前' , 'uuui');
    } elseif ($diff >= 86400) {
        $days = round($diff / 86400);
        if ($days <= 1) {
            $days = 1;
            $time = sprintf(_n('%s天', '%s天', $days), $days) . __('前' , 'uuui');
        } elseif ($days > 29) {
            $time = get_the_time(get_option('date_format'));
        } else {
            $time = sprintf(_n('%s天', '%s天', $days), $days) . __('前' , 'uuui');
        }
    }
    return $time;
}
add_filter('the_time','Bing_filter_time');
/* —— 显示时间为几天前 —— 结束 */


/* —— 自动添加nofollow属性和新窗口打开WordPress文章/页面的站外链接 —— */
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
/* —— 自动添加nofollow属性和新窗口打开WordPress文章/页面的站外链接 —— 结束 */


include( 'functions/categories-images.php' );//分类目录添加图像


include( 'functions/custom-editor.php' );//向 WordPress 可视化编辑器添加自定义样式


//include( 'functions/post-type-link.php' );//自定义文章类型




/* —— 更改作者存档前缀 —— 
add_action('init', 'change_author_base');
function change_author_base() {
global $wp_rewrite;
$author_slug = 'profile'; // change slug name
$wp_rewrite->author_base = $author_slug;
}
 —— 更改作者存档前缀 —— 结束 */


/* —— 字数统计 —— */
//字数和预计阅读时间统计
function count_words_read_time () {
	global $post;
		$output = '';
	   	$text_num = mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8');
	   	$read_time = ceil($text_num/400);
	   	$output .= '本文共' . $text_num . '个字，预计阅读时间' . $read_time  . '分钟。';
	   	return $output;
	}
/* —— 字数统计 —— 结束 */


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



/* —— 添加帮助面板 ——https://www.ludou.org/wordpress-customizing-the-dashboard-widgets.html */
function ludou_dashboard_help() {
	echo '这里填使用说明的内容，可填写HTML代码';
	// 如以下一行代码是露兜博客开放投稿功能所使用的投稿说明
	// echo "<p><ol><li>投稿，请依次点击 文章 - 添加新文章，点击 "送交审查" 即可提交</li><li>修改个人资料，请依次点击 资料 - 我的资料</li><li>请认真填写“个人说明”，该信息将会显示在文章末尾</li><li>有事请与我联系，Email: zhouzb889@gmail.com   QQ: 825533758</li></ol></p>";     
 }
 function ludou_add_dashboard_widgets() {
	wp_add_dashboard_widget('ludou_help_widget', '这里替换成面板标题', 'ludou_dashboard_help');
 }
 add_action('wp_dashboard_setup', 'ludou_add_dashboard_widgets' );
/* —— 添加帮助面板 —— 结束 */

/* 替换 Ultimate Member 加载的google字体文件*/
function cmp_replace_google_webfont() {
	if ( class_exists( 'reduxCoreEnqueue' ) ) {
	  wp_enqueue_script('jquery');
	  wp_deregister_script('webfontloader');
	  wp_register_script('webfontloader', 'http://ajax.useso.com/ajax/libs/webfont/1.5.0/webfont.js',array('jquery'),'1.5.0',true);
	  wp_enqueue_script('webfontloader');
	}
  }
  add_action('admin_enqueue_scripts', 'cmp_replace_google_webfont',9);



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
/* —— 添加帮助面板 —— 结束 */








?>