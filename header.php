<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php if ( is_home() ) {
            bloginfo('name'); echo " | "; bloginfo('description');
            } elseif ( is_category() ) {
                single_cat_title(); echo " | "; bloginfo('name');
            } elseif (is_single() || is_page() ) {
                single_post_title();
            } elseif (is_search() ) {
                echo "搜索结果：".get_search_query(); echo " | "; bloginfo('name');
            } elseif (is_404() ) {
                echo '页面未找到!';
            } else {
                wp_title('',true);
            } ?>
    </title>
    <?php $description = ''; $keywords = '';

        if (is_home()) {
            $description = of_get_option('website_description', '');// 将引号中的内容改成你的主页description
            $keywords = of_get_option('website-keywords', '');// 将引号中的内容改成你的主页keywords
            $title = get_bloginfo('name');

        }elseif (is_page()){
            $description = of_get_option('website_description', '');// 将引号中的内容改成你的主页description
            $keywords = of_get_option('website-keywords', '');// 将引号中的内容改成你的主页keywords
            $title = get_the_title()."|".get_bloginfo('name');

        }elseif (is_single()) {
            $title = get_the_title()."|".get_bloginfo('name');
            $description1 = get_post_meta($post->ID, "description", true);
            $description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));// 填写自定义字段description时显示自定义字段的内容，否则使用文章内容前200字作为描述
            $description = $description1 ? $description1 : $description2;// 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词
            $keywords = get_post_meta($post->ID, "keywords", true);

            if($keywords == '') {
                $tags = wp_get_post_tags($post->ID);
                foreach ($tags as $tag ) {
                    $keywords = $keywords . $tag->name . ", ";
                }
                $keywords = rtrim($keywords, ', ');
        }
        }elseif (is_category()) {
            $title = single_cat_title('', false)." | ".get_bloginfo('name');
            $description = category_description();// 分类的description可以到后台 - 文章 -分类目录，修改分类的描述
            $keywords = single_cat_title('', false);

        }elseif (is_tag()){
            $description = tag_description();// 标签的description可以到后台 - 文章 - 标签，修改标签的描述
            $keywords = single_tag_title('', false);
            $title = single_tag_title('', false)." | ".get_bloginfo('name');
        }

        $description = trim(strip_tags($description));
        $keywords = trim(strip_tags($keywords));
        $title = trim(strip_tags($title));
    ?>


    <meta name="title" content="<?php echo $title; ?>">
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="keywords" content="<?php echo $keywords; ?>" />


    <?php 
        $application_name = of_get_option('application-name', ''); 
    
    ?>
    <!-- Web 应用的名称（仅当网站被用作为一个应用时才使用）-->
    <meta name="application-name" content="<?php echo $application_name; ?>">
    <!-- Chrome、Firefox OS 和 Opera 的主题颜色 -->
    <meta name="theme-color" content="#ff5722">
    <!-- 确定用于构建页面的软件（如 - WordPress、Dreamweaver）-->
    <meta name="generator" content="WordPress">

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo get_bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />

    <link rel="stylesheet" type="text/css" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- font-awesome -->
    <link rel="stylesheet" type="text/css" href="https://cdn.staticfile.org/font-awesome/5.12.0-1/css/all.min.css" type="text/css"/>
    <!-- https://github.com/daneden/animate.css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.staticfile.org/animate.css/3.7.2/animate.min.css" type="text/css"/>
    <!-- iconfont -->
    <link rel="stylesheet" type="text/css" href="https://at.alicdn.com/t/font_1581944_m3txwnks2fo.css" type="text/css"/>
    <!-- style.css -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <!-- single_style.css -->
    <?php if(is_single() || is_page()){?>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/res/css/single_style.css" type="text/css"/>
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
    <nav class="left">
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

        <div class="float-right" style="margin-top:16px;">
            <?php $url_this = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; //登录/登出（注销）后返回之前访问的页面 ?>
            <?php if ( is_user_logged_in() ) {?>
                <?php
                    global $current_user; //当前用户信息数组
                    wp_get_current_user();

                    echo "$current_user->display_name";
                    ?>
                    <a href="<?php echo wp_logout_url($url_this); ?>">登出</a>
            <?php } else { ?>
                <a href="<?php $select_pages_login = of_get_option('select_pages_login', '');  the_permalink($select_pages_login); ?>">
                <span class="font-size-small-14">登录</span>
                </a>
                <span class="font-size-small-14">/</span>
                <a href="<?php $select_pages_login = of_get_option('select_pages_registered', '');  the_permalink($select_pages_login); ?>">
                    <span class="font-size-small-14">注册</span>
                </a>
            <?php 
                } ?>

        </div>
        <div class="float-right" style="margin-top:14px;margin-right:10px">
        <form style="width:200px" class="input-group input-group-sm mb-3" method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
            <input class="form-control" type="text" placeholder="输入关键字" name="s" id="s"/>
            <div class="input-group-append">
                <input class="btn btn-success" type="submit" value="搜 索" onClick="if(document.forms['search'].searchinput.value=='- Search -')document.forms['search'].searchinput.value='';" alt="Search" />
            </div>
        </form></div>
        
    </nav>
    <div style="clear:both;"></div>
    <main style="margin-top: 80px;">