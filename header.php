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
                if (get_query_var('page')) {//分页显示“第x页”
                    echo ' - 第';
                    echo get_query_var('page'); 
                    echo '页';
                };
                echo " - ";
                bloginfo('name');

            } elseif (is_tag() ) {
                echo "标签：";
                echo single_tag_title();
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
    <!-- 网站SEO，首页/文章/页面的描述和关键词 -->
    <?php if ( of_get_option('site-seo','') == "1" ){
            include('functions/site-seo.php');
        } else{
            echo '';
        }
    ?>
    <?php //Web 应用的名称（仅当网站被用作为一个应用时才使用）//Chrome、Firefox OS 和 Opera 的主题颜色
        $application_name = of_get_option('application-name', ''); 
        $application_color = of_get_option('application-color', '');
        if (!empty($application_name)){
            echo '<meta name="application-name"  content="' . $application_name. '">';
            echo '<meta name="theme-color" content="' . $application_color . '">';
        }else{
            echo "";
    }?>
    <!-- RSS -->
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo get_bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />
    <!-- iconfont -->
    <link rel="stylesheet" type="text/css" href="https://at.alicdn.com/t/font_1581944_4zzzlieuj55.css" />
    
    <?php $header_style = of_get_option('header_style');//自定义style样式
        if(!empty($header_style)){
            echo "<style>\n";
            echo $header_style;
            echo "\n</style>";
        } else{
            echo "";
    } ?>

    <!-- 百度统计 -->
    <?php if(!empty(of_get_option('baidu-tongji', ''))){ ?>
        <script>
            var _hmt = _hmt || [];
            (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?<?php echo of_get_option('baidu-tongji', '') ?>";
            var s = document.getElementsByTagName("script")[0]; 
            s.parentNode.insertBefore(hm, s);
            })();
        </script>
    <?php } ?>

    <!-- img图片src错误时加载默认图片 -->
    <script type="text/javascript">
        function nofind(){
            var img=event.srcElement;
            img.src="<?php bloginfo('template_url'); ?>/images/1col.png";
            img.onerror=null; //控制不要一直跳动
        }
    </script>

    <?php wp_head(); ?>
</head>
<?php flush(); ?>
<body>
    <nav>
        
        <a class="" href="<?php echo get_option('home'); ?>/">
            <?php 
                $site_logo = of_get_option('site_logo', '');
                $blog_title = get_bloginfo('name');
                $blog_title2 = get_bloginfo('description');

                if(empty($site_logo)){
                    echo "<span class='float-left site-title nav-logo__title' title='" . $blog_title2 . "'>" . $blog_title . "</span>";
                }else{
                    echo "<img src='" . $site_logo . "' class='logo_img float-left site-title'>";
            }?>
            
        </a>
        <div class="nav-link float-left">
            <?php 
            if(function_exists('wp_nav_menu')) {
                wp_nav_menu(array( 'theme_location' => 'nav_menu','container_id'=>'menu_left','fallback_cb' => 'nav_menus_fallback') ); 
            }
            ?>
        </div>
        
        <!-- 登录/未登录 -->
        <div class="float-right nav-login clearfix">
            <?php if ( is_user_logged_in() ) {?>
                <i class="iconfont icon-yidenglu" style="font-size: 16px; font-weight: 600; padding-left:10px;"></i>
                <div class="nav-user-div animated fadeInDown faster clearfix">
                    <?php
                        global $current_user; //当前用户信息数组
                        wp_get_current_user();
                        ?>
                        <div class="nav-user-item w-100 text-center">
                            <?php echo get_avatar( $current_user->user_email, 64); ?>
                        </div>
                        <div class="nav-user-item w-100 text-center">
                            <?php echo $current_user->display_name; ?>
                        </div>
                        <?php if( $current_user->roles[0] == 'administrator' ) { ?>
                            <a href="<?php echo home_url(); ?>/wp-admin/" class="font-size-small float-left" target="_blank">
                                <div class="nav-user-item w-100 text-center"><i class="iconfont icon-shezhi font-size-small" style="padding:0 3px 0 10px;"></i>后台</div>
                            </a>
                        <?php } ?>
                        <a href="<?php echo wp_logout_url($url_this); ?>" class="font-size-small float-right">
                            <div class="nav-user-item w-100 text-center">登出<i class="iconfont icon-dengchu font-size-small" style="padding:0 10px 0 3px;"></i></div>
                        </a>
                </div>
                
            <?php } else{ ?>
                <a href="<?php echo wp_login_url( home_url(add_query_arg(array(),$wp->request)) ); ?>&page=login">
                    <i class="iconfont icon-denglu" style="font-size: 16px; font-weight: 600; padding-left:10px;"></i>
                </a>
            <?php } ?>
        </div>

        <!-- 搜索 -->
        <div class="float-right header-search">
            <a id="kl" href="javascript:void(0);" title="搜索">
                <i class="iconfont icon-sousuo" style="font-size: 16px; font-weight: 600; padding-left:10px;"></i>
            </a>
            <div id="search-form" class="search-form">
                <a id="jk" href="javascript:void(0);" title="关闭搜索框">
                    <i class="iconfont icon-guanbi float-right" style="font-size: 16px;"></i>
                </a>
                <form style="width:80%" class="input-group input-group-sm mb-3 mx-auto" method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
                    <input class="form-control" type="text" placeholder="输入关键字" name="s" id="s"/>
                    <div class="input-group-append">
                        <input class="btn btn-success" type="submit" value="搜 索" onClick="if(document.forms['search'].searchinput.value=='- Search -')document.forms['search'].searchinput.value='';" alt="Search" />
                    </div>
                </form>
                
            </div>
        </div>

        <?php if(is_single()){?>
            <span class="single-title nav-logo__title"><?php the_title(); ?></span>
        <?php }  ?>
    </nav>
    

    <div style="clear:both;"></div>