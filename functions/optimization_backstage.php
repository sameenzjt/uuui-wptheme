<?php 
/**
 * 网站后台优化
 */


/* —— 后台禁用谷歌字体 —— */
function coolwp_remove_open_sans_from_wp_core() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'coolwp_remove_open_sans_from_wp_core' );
/* —— 后台禁用谷歌字体 —— 结束 */


function disable_dashboard_widgets() {
    //remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');//近期评论 
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal');//近期草稿
    remove_meta_box('dashboard_primary', 'dashboard', 'core');//wordpress博客  
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');//wordpress其它新闻  
    remove_meta_box('dashboard_right_now', 'dashboard', 'core');//wordpress概况  
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');//wordresss链入链接  
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');//wordpress链入插件  
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');//wordpress快速发布   
}  
add_action('admin_menu', 'disable_dashboard_widgets');

//屏蔽后台页脚信息
function change_footer_admin () {return '';}
add_filter('admin_footer_text', 'change_footer_admin', 9999);
#function change_footer_version() {return '';}
#add_filter( 'update_footer', 'change_footer_version', 9999);

//屏蔽左上logo
function annointed_admin_bar_remove() {
    global $wp_admin_bar;
    /* Remove their stuff */
    $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

?>