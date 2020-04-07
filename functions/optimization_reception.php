<?php 
/**
 * 网站前台优化
 */


//移除 WordPress 加载的JS和CSS链接中的版本号,只移除添加WP的版本号,其他版本号不移除。
function wpdaxue_remove_cssjs_ver( $src ) {
	if( strpos( $src, 'ver='. get_bloginfo( 'version' ) ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'wpdaxue_remove_cssjs_ver', 999 );
add_filter( 'script_loader_src', 'wpdaxue_remove_cssjs_ver', 999 );


//禁止WordPress头部加载s.w.org
function remove_dns_prefetch( $hints, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        return array_diff( wp_dependencies_unique_hosts(), $hints );
    }
        return $hints;
    }
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );


// 禁止加载表情代码
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
add_filter( 'emoji_svg_url', '__return_false' );


//移除jQuery Migrate脚本
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


remove_action('wp_head', 'wp_generator' ); //去除版本信息
remove_action('wp_head', 'rsd_link' );//清除离线编辑器接口
remove_action('wp_head', 'wlwmanifest_link' );
remove_action('wp_head', 'feed_links',2 );//清除feed信息
remove_action('wp_head', 'feed_links_extra',3 );//清除feed信息
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//清除前后文信息
remove_action('wp_head', 'wp_shortlink_wp_head',10,0 );//清除短链

add_filter('json_enabled', '__return_false');//禁用 WordPress 的 JSON REST API
add_filter('json_jsonp_enabled', '__return_false');//禁用 WordPress 的 JSON REST API
remove_action('wp_head', 'rest_output_link_wp_head', 10 );// 移除头部 wp-json 标签
remove_action('wp_head','wp_oembed_add_discovery_links', 10 );//移除HTTP header 中的 link 



//wordpress 官方禁用 embeds
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

?>