<!DOCTYPE HTML>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php 
            if ( is_home() ) {
                bloginfo('name');
                echo " - ";
                bloginfo('description');

            } elseif ( is_category() ) {
                single_cat_title();
                echo " - ";
                bloginfo('name');

            } elseif (is_single() || is_page() ) {
                single_post_title();
                echo " - ";
                bloginfo('name');

            } elseif (is_search() ) {
                echo "搜索结果：".get_search_query();
                echo " - "; 
                bloginfo('name');

            } elseif (is_404() ) {
                $title_404 = get_option('404_title', '');
                echo $title_404;

            } else {
                wp_title('',true);
            } ?></title>
    <?php if ( of_get_option('site-seo','') == "1" ){
        include('functions/site-seo.php');
    } else{
        echo '';
    }
    
    ?>
   

    <?php $google_sc = of_get_option('google-search-console', ''); 
        if (!empty($google_sc)){
            echo $google_sc;
        }else{
            echo "";
        }
    ?>
    <?php $bing_wc = of_get_option('bing-webmaster-center', ''); 
        if (!empty($bing_wc)){
            echo $bing_wc;
        }else{
            echo "";
        }
    ?>

    <?php //Web 应用的名称（仅当网站被用作为一个应用时才使用）//Chrome、Firefox OS 和 Opera 的主题颜色
        $application_name = of_get_option('application-name', ''); 
        if (!empty($application_name)){
            echo '<meta name="application-name"  content="' . $application_name. '">';
            echo '<meta name="theme-color" content="#ff5722">';
        }else{
            echo "";
        }
    ?>

    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo get_bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />

    <link rel="stylesheet" type="text/css" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
    <!-- font-awesome -->
    <link rel="stylesheet" type="text/css" href="https://cdn.staticfile.org/font-awesome/5.12.0-1/css/all.min.css" />
    <!-- https://github.com/daneden/animate.css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.staticfile.org/animate.css/3.7.2/animate.min.css" />
    <!-- iconfont -->
    <link rel="stylesheet" type="text/css" href="https://at.alicdn.com/t/font_1581944_61d2rh3x1sa.css" />
    <!-- style.css -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>?ver=<?php $my_theme = wp_get_theme(); echo $my_theme->get('Version'); ?>" type="text/css" media="screen" />
    <!-- 移动端样式 -->
    <?php if(wp_is_mobile()){ ?>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/res/css/style_screen_768.css"/>
    <?php } ?>
    <!-- 独立样式 -->
    <?php if( is_single() ) { ?>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/res/css/style_single.css" type="text/css"/>
    <?php } elseif( is_page() ){ ?>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/res/css/style_single.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/res/css/style-login-registered.css" type="text/css"/>
    <?php } ?>

    <!-- 自定义style样式 -->
    <?php $header_style = of_get_option('header_style');
        if(!empty($header_style)){
            echo "<style>\n";
            echo $header_style;
            echo "\n</style>";
        } else{
            echo "";
    } ?>


    <?php wp_head(); ?>
</head>
<?php flush(); ?>
<body>
    <nav>
        <a href="<?php echo get_option('home'); ?>/">
            <?php 
                $site_logo = of_get_option('site_logo', '');
                $blog_title = get_bloginfo('name');
                $blog_title2 = get_bloginfo('description');

                if(empty($site_logo)){
                    echo "<h1 style='margin-top: 4px;' class='float-left' title='" . $blog_title2 . "'>" . $blog_title . "</h1>";
                }else{
                    echo "<img src='" . $site_logo . "' class='logo_img float-left'>";
            }?>
            
        </a>
        <div class="nav-link hide-768px float-left">
            <?php 
            if(function_exists('wp_nav_menu')) {
                wp_nav_menu(array( 'theme_location' => 'nav_menu','container_id'=>'menu_left') ); 
            }
            ?>
        </div>

        <div class="float-right nav-login">
            <?php $url_this = 'https://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; //登录/登出（注销）后返回之前访问的页面 ?>
            <?php if ( !is_user_logged_in() ) {?>
                <a href="<?php the_permalink( of_get_option('page_login', '') ); ?>">
                    <img src="<?php bloginfo('template_url'); ?>/images/avatar/giraffe.png" width="32px" height="32px">
                </a>
            <?php } else { ?>
                <?php
                    global $current_user; //当前用户信息数组
                    wp_get_current_user();

                    echo get_avatar( $current_user->user_email, 32);
                    echo "$current_user->display_name";
                    ?>
                    <a href="<?php echo wp_logout_url($url_this); ?>" class="font-size-small">登出</a>
                
            <?php } ?>

        </div>
        <div class="float-right header-search">
            <form style="width:200px" class="input-group input-group-sm mb-3" method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
                <input class="form-control" type="text" placeholder="输入关键字" name="s" id="s"/>
                <div class="input-group-append">
                    <input class="btn btn-success" type="submit" value="搜 索" onClick="if(document.forms['search'].searchinput.value=='- Search -')document.forms['search'].searchinput.value='';" alt="Search" />
                </div>
            </form>
        </div>
        
    </nav>
    <div style="clear:both;"></div>
    <main style="margin-top: 80px;">