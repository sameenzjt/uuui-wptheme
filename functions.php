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
	'footer_menu' => 'My Custom Footer Menu'
) );
/* —— 注册菜单 —— 结束 */


/* —— 启用特色图片 —— */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	set_post_thumbnail_size( 200, 200, true );
}
/* —— 启用特色图片 —— 结束 */


/* —— 自定义登陆之后的重定向链接 —— 如果是管理员就重定向到管理员面板，如果是普通用户则跳转到首页。*/  
function soi_login_redirect($redirect_to, $request, $user)   
{   
    return (is_array($user->roles) && in_array('administrator', $user->roles)) ? admin_url() : site_url();   
}    
add_filter('login_redirect', 'soi_login_redirect', 10, 3); 
/* —— 自定义登陆之后的重定向链接 —— 结束 */ 



/* —— 自定义登出之后的重定向链接 —— */  
add_action('wp_logout','auto_redirect_after_logout');   
function auto_redirect_after_logout(){   
  wp_redirect( home_url() );   
  exit();   
}
/* —— 自定义登出之后的重定向链接 —— 结束 */ 


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


include( 'includes/categories-images.php' );//分类目录添加图像


/* —— 更改作者存档前缀 —— */
add_action('init', 'change_author_base');
function change_author_base() {
global $wp_rewrite;
$author_slug = 'profile'; // change slug name
$wp_rewrite->author_base = $author_slug;
}
/* —— 更改作者存档前缀 —— 结束 */


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


?>
