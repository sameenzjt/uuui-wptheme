<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php if ( is_home() ) {
            bloginfo('name'); echo " - "; bloginfo('description');
            } elseif ( is_category() ) {
                single_cat_title(); echo " - "; bloginfo('name');
            } elseif (is_single() || is_page() ) {
                single_post_title();
            } elseif (is_search() ) {
                echo "搜索结果"; echo " - "; bloginfo('name');
            } elseif (is_404() ) {
                echo '页面未找到!';
            } else {
                wp_title('',true);
            } ?>
    </title>
    <?php $description = ''; $keywords = '';

        if (is_home()) {
            // 将以下引号中的内容改成你的主页description
            $description = of_get_option('website_description', '');
            // 将以下引号中的内容改成你的主页keywords
            $keywords = of_get_option('website-keywords', '');

            $title = get_bloginfo('name');
        }elseif (is_page()){
            // 将以下引号中的内容改成你的主页description
            $description = of_get_option('website_description', '');
            // 将以下引号中的内容改成你的主页keywords
            $keywords = of_get_option('website-keywords', '');

            $title = get_bloginfo('name')."-".get_the_title();
        }elseif (is_single()) {
            $title = get_the_title()."-".get_bloginfo('name');
            $description1 = get_post_meta($post->ID, "description", true);
            $description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));
            // 填写自定义字段description时显示自定义字段的内容，否则使用文章内容前200字作为描述
            $description = $description1 ? $description1 : $description2;
            // 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词
            $keywords = get_post_meta($post->ID, "keywords", true);
            if($keywords == '') {
                $tags = wp_get_post_tags($post->ID);
                foreach ($tags as $tag ) {
                    $keywords = $keywords . $tag->name . ", ";
                }
                $keywords = rtrim($keywords, ', ');
        }
        }elseif (is_category()) {
            $title = get_bloginfo('name')."-".single_cat_title('', false);
            // 分类的description可以到后台 - 文章 -分类目录，修改分类的描述
            $description = category_description();
            $keywords = single_cat_title('', false);
        }elseif (is_tag()){
            // 标签的description可以到后台 - 文章 - 标签，修改标签的描述
            $description = tag_description();
            $keywords = single_tag_title('', false);
            $title = get_bloginfo('name')."-".single_tag_title('', false);
        }
        $description = trim(strip_tags($description));
        $keywords = trim(strip_tags($keywords));
        $title = trim(strip_tags($title));
    ?>


    <meta name="title" content="<?php echo $title; ?>">
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="keywords" content="<?php echo $keywords; ?>" />


    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo get_bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />

    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" type="text/css" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    
    <link rel="stylesheet" type="text/css" href="https://cdn.staticfile.org/font-awesome/5.12.0-1/css/all.min.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="https://at.alicdn.com/t/font_1581944_hupwddav3bj.css" type="text/css"/>
    

    <!-- 自定义style样式 -->
    <?php $header_style = of_get_option('header_style');
        if(empty($header_style)){
            echo "";
        } else{
            echo "<style>\n";
            echo $header_style;
            echo "\n</style>";
    } ?>

    <?php wp_head(); ?>
</head>
<?php flush(); ?>
<body>
    <nav class="left">
        <a href="<?php echo get_option('home'); ?>/">
            <img src="<?php bloginfo('template_url'); ?>/images/083456tqzn4xxw99f1999w.jpg" class="logo_img left">
        </a>
        <div class="nav-link hide-768px left">
            <?php 
            if(function_exists('wp_nav_menu')) {
                wp_nav_menu(array( 'theme_location' => 'nav_menu','container_id'=>'menu_left') ); 
            }
            ?>
        </div>

        <div class="right" style=" margin-top:16px;">
            <?php if ( is_user_logged_in() ) {?>
                <?php global $current_user; //当前用户信息数组
                    wp_get_current_user();
                    echo ' '. $current_user->display_name .' ';
                    ?>
                    <a href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>"><span>登出</span></a>
            <?php } else { ?>
                <a href="<?php $select_pages_login = of_get_option('select_pages_login', '');  the_permalink($select_pages_login); ?>">
                    <span>登录</span>
                </a>
                <span>/</span>
                <a href="<?php $select_pages_login = of_get_option('select_pages_registered', '');  the_permalink($select_pages_login); ?>">
                    <span>注册</span>
                </a>
            <?php 
                } ?>
        </div>
        
    </nav>
    <div style="clear:both;"></div>
    <main style="margin-top: 80px;">