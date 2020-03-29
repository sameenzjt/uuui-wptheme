<?php
    /*
    Template Name: 支持与服务
    */
?>
<?php get_header(); ?>
        
        <div class="row">
            <div class="col-12">
                <?php if(function_exists('cmp_breadcrumbs')) cmp_breadcrumbs();?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 text-center" style="margin-bottom: 40px;">
                <h2 style="font-weight: 600; margin: 20px 0px;"><?php the_title(); ?></h2>
                <div class="dropdown-divider"></div>
            </div>
            <div class="col-lg-2 col-md-2 page-tool-father">
                <div id="fixed-tool" class="page-tool">
                    <?php if(function_exists('wp_nav_menu')) {
                        wp_nav_menu(array( 'theme_location' => 'support_menu','menu_class'=>'support_menu_ul') ); 
                    }?>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
                <div class="page-content" >
                    <?php the_content(); ?> 
                </div>
                <?php else : ?>
                <div class="grid_8">
                    没有找到你想要的页面！
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-2 col-md-2">
            </div>
        </div>
        
            
<?php get_footer(); ?>