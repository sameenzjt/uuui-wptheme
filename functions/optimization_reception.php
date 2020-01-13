<?php 
/**
 * 网站前台优化
 */


//去除加载的css和js后面的版本号
/*function _remove_script_version( $src ){
*    $parts = explode( '?', $src );
*    return $parts[0];
*}
*add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
*add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
*add_filter( 'pre_option_link_manager_enabled', '__return_true' );
*/

//删除 wp_head 中无关紧要的代码
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');


// 禁用 Emoji 功能 
remove_action('admin_print_scripts','print_emoji_detection_script');
remove_action('admin_print_styles','print_emoji_styles');
remove_action('wp_head','print_emoji_detection_script', 7);//表情js，如果需要表情请添加#屏蔽
remove_action('wp_print_styles','print_emoji_styles');
remove_action('embed_head','print_emoji_detection_script');
remove_filter('the_content_feed','wp_staticize_emoji');
remove_filter('comment_text_rss','wp_staticize_emoji');
remove_filter('wp_mail','wp_staticize_emoji_for_email');
add_filter( 'emoji_svg_url','__return_false' );


//移除头部 wp-json 标签和 HTTP header 中的 link 
remove_action('wp_head', 'rest_output_link_wp_head', 10 );
remove_action('template_redirect', 'rest_output_link_header', 11 );


// 关闭 XML-RPC 功能 (wordpress APP需要)
//add_filter('xmlrpc_enabled', '__return_false');


//禁止WordPress头部加载s.w.org
function remove_dns_prefetch( $hints, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
    return array_diff( wp_dependencies_unique_hosts(), $hints );
    }
    return $hints;
    }
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );


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


/*禁用Embeds功能*/
if ( !function_exists( 'disable_embeds_init' ) ) :
function disable_embeds_init() {
    /* @var WP $wp */
    global $wp;
    // Remove the embed query var.
    $wp->public_query_vars = array_diff( $wp->public_query_vars, array(
        'embed',
    ) );
    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
    // Turn off
    add_filter( 'embed_oembed_discover', '__return_false' );
    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
    // Remove all embeds rewrite rules.
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    }
    add_action( 'init', 'disable_embeds_init', 9999 );
    /**
    * Removes the 'wpembed' TinyMCE plugin.
    *
    * @since 1.0.0
    *
    * @param array $plugins List of TinyMCE plugins.
    * @return array The modified list.
    */
    function disable_embeds_tiny_mce_plugin( $plugins ) {
        return array_diff( $plugins, array( 'wpembed' ) );
    }
    /**
    * Remove all rewrite rules related to embeds.
    *
    * @since 1.2.0
    *
    * @param array $rules WordPress rewrite rules.
    * @return array Rewrite rules without embeds rules.
    */
    function disable_embeds_rewrites( $rules ) {
    foreach ( $rules as $rule => $rewrite ) {
        if ( false !== strpos( $rewrite, 'embed=true' ) ) {
        unset( $rules[ $rule ] );
        }
    }
    return $rules;
    }
    /**
    * Remove embeds rewrite rules on plugin activation.
    *
    * @since 1.2.0
    */
    function disable_embeds_remove_rewrite_rules() {
        add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
        flush_rewrite_rules();
    }
     
    register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );
     
    /**
    * Flush rewrite rules on plugin deactivation.
    *
    * @since 1.2.0
    */
    function disable_embeds_flush_rewrite_rules() {
        remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
        flush_rewrite_rules();
    }
     
    register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );
endif;
?>