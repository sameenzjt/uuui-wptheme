<?php 
/**
 * 网站前台优化
 */


//去除加载的css和js后面的版本号
function _remove_script_version( $src ){
    $parts = explode( '?', $src );
    return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'pre_option_link_manager_enabled', '__return_true' );


//删除 wp_head 中无关紧要的代码
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');


// 禁用 Emoji 功能 
remove_action('admin_print_scripts',    'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
#remove_action('wp_head',       'print_emoji_detection_script', 7);
remove_action('wp_print_styles',    'print_emoji_styles');
remove_action('embed_head',     'print_emoji_detection_script');
remove_filter('the_content_feed',   'wp_staticize_emoji');
remove_filter('comment_text_rss',   'wp_staticize_emoji');
remove_filter('wp_mail',        'wp_staticize_emoji_for_email');


//移除头部 wp-json 标签和 HTTP header 中的 link 
remove_action('wp_head', 'rest_output_link_wp_head', 10 );
remove_action('template_redirect', 'rest_output_link_header', 11 );


// 关闭 XML-RPC 功能 
add_filter('xmlrpc_enabled', '__return_false');



//移除jQuery Migrate脚本
//https://blog.naibabiji.com/wang-zhan-zi-xun/jin-yong-jquery-migrate-min-js.html
function dequeue_jquery_migrate( $scripts ) {
    if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
        $scripts->registered['jquery']->deps = array_diff(
            $scripts->registered['jquery']->deps,
            [ 'jquery-migrate' ]
        );
    }
}
add_action( 'wp_default_scripts', 'dequeue_jquery_migrate' );


/* —— 禁用工具栏 —— */
add_action("user_register", "set_user_admin_bar_false_by_default", 10, 1);
function set_user_admin_bar_false_by_default($user_id) {
    update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
    update_user_meta( $user_id, 'show_admin_bar_admin', 'false' );
}
/* —— 禁用工具栏 —— 结束 */



?>