<?php
//添加自定义CSS
function custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/res/css/style_login.css" />';
}
add_action('login_head', 'custom_login');

//自定义登录页面的LOGO图片

function my_custom_login_logo() {
    
    echo '<style type="text/css">
        .login h1 a {
            background-image:url("';
    if(!empty(of_get_option('site_logo', ''))){
        $login_logo = of_get_option('site_logo', '');
        echo  $login_logo;
    }else{
        $login_logo = get_stylesheet_directory_uri();
        echo  $login_logo;
        echo '/images/default_logo.png';
    }
    echo '") !important;
        height: 64px;
        width: 64px;
        -webkit-background-size: 64px;
        background-size: 64px;
        }
    </style>';
}
add_action('login_head', 'my_custom_login_logo');


//自定义登录页面的LOGO链接为首页链接
add_filter('login_headerurl', create_function(false,"return get_bloginfo('url');"));


/*
//自定义登录界面LOGO链接为任意链接
function custom_loginlogo_url($url) {
	return 'https://www.wpdaxue.com'; //修改URL地址
}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );
*/


//自定义登录页面的LOGO提示为网站名称
add_filter('login_headertitle', create_function(false,"return get_bloginfo('name');"));


/*
//自定义登录页面LOGO提示为任意文本
function custom_loginlogo_desc($url) {
    return 'WordPress大学'; //修改文本信息
}
add_filter( 'login_headertitle', 'custom_loginlogo_desc' );
*/


//在登录框添加额外的信息
function custom_login_message() {
    printf('<p>请勿在公共设备上保存密码%1$s</p><br />','gh');
}
add_action('login_form', 'custom_login_message');




//自定义底部信息
function custom_html() {
    echo '<p style="text-align:center; margin-top:15px;">Copyright © 2019 ' . get_bloginfo('name') .'</p>';
}
add_action('login_footer', 'custom_html');







?>