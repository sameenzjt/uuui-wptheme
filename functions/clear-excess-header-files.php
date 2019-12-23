<?php
remove_action( 'wp_head', 'wp_generator' );//移除WordPress版本
remove_action( 'wp_head', 'rsd_link' ); //移除离线编辑器开放接口,wlwmanifest是针对微软Live Writer编辑器的
remove_action( 'wp_head', 'wlwmanifest_link' );//移除离线编辑器开放接口,wlwmanifest是针对微软Live Writer编辑器的
remove_action( 'wp_head', 'index_rel_link' ); //移除前后文、第一篇文章、主页meta信息
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); //移除前后文、第一篇文章、主页meta信息
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); //移除前后文、第一篇文章、主页meta信息
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); //移除前后文、第一篇文章、主页meta信息
remove_action( 'wp_head', 'feed_links', 2 );//文章和评论feed 
remove_action( 'wp_head', 'feed_links_extra', 3 ); //分类等feed






//去除JS，css版本号
function qcbb( $src ){
	$parts = explode( '?', $src );
	return $parts[0];
   }
   add_filter( 'script_loader_src', 'qcbb', 15, 1 );
   add_filter( 'style_loader_src', 'qcbb', 15, 1 );
   function wpbeginner_remove_version() {
   return '';}
   add_filter('the_generator', 'wpbeginner_remove_version');



//Dashicons和thickbox的清理方法
   add_action( 'wp_print_styles',     'my_deregister_styles', 100 );
   function my_deregister_styles()    {
   if(!is_user_logged_in()){
   wp_deregister_style( 'amethyst-dashicons-style' );
   wp_deregister_style( 'dashicons' );
   wp_deregister_script('thickbox');}
   }
//清理emoji表情的脚本加载
   remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
   remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
   remove_action( 'wp_print_styles', 'print_emoji_styles' );
   remove_action( 'admin_print_styles', 'print_emoji_styles' );
   if ( !function_exists( 'disable_embeds_init' ) ) :
   function disable_embeds_init(){
   global $wp;
   $wp->public_query_vars = array_diff($wp->public_query_vars, array('embed'));
   remove_action('rest_api_init', 'wp_oembed_register_route');
   add_filter('embed_oembed_discover', '__return_false');
   remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
   remove_action('wp_head', 'wp_oembed_add_discovery_links');
   remove_action('wp_head', 'wp_oembed_add_host_js');
   add_filter('tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin');
   add_filter('rewrite_rules_array', 'disable_embeds_rewrites');
   }
   add_action('init', 'disable_embeds_init', 9999);
   endif;




   ?>