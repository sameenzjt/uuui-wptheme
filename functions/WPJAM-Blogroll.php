<?php
/*
Plugin Name: WPJAM Blogroll
Plugin URI: http://blog.wpjam.com/m/wpjam-blogroll/
Description: 快速添加友情链接
Version: 0.1
Author: Denis
Author URI: http://blog.wpjam.com/
*/
add_action('admin_init', 'wpjam_blogroll_settings_api_init');
function wpjam_blogroll_settings_api_init() {
    add_settings_field('wpjam_blogroll_setting', '友情链接', 'wpjam_blogroll_setting_callback_function', 'reading');
    register_setting('reading','wpjam_blogroll_setting');
}
 
function wpjam_blogroll_setting_callback_function() {
    echo '<textarea name="wpjam_blogroll_setting" rows="10" cols="50" id="wpjam_blogroll_setting" class="large-text code">' . get_option('wpjam_blogroll_setting') . '</textarea>';
}
 
function wpjam_blogroll(){
    $wpjam_blogroll_setting =  get_option('wpjam_blogroll_setting');
    if($wpjam_blogroll_setting){
        $wpjam_blogrolls = explode("\n", $wpjam_blogroll_setting);
        foreach ($wpjam_blogrolls as $wpjam_blogroll) {
            $wpjam_blogroll = explode("|", $wpjam_blogroll );
            echo '<a target="_blank" href="'.trim($wpjam_blogroll[0]).'" title="'.esc_attr(trim($wpjam_blogroll[1])).'">'.trim($wpjam_blogroll[1]).'</a>';
            }
    }
}
 
?>