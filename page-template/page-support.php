<?php
    /*
    Template Name: 支持与服务
    */
?>
<?php get_header(); ?>
        
        <div class="row">
            <div class="col-12">
                <ol class="page-breadcrumb" >
                    <li class="post-breadcrumb-item font-size-small"><a href="#">首页</a></li>
                    <li class="post-breadcrumb-item font-size-small"><a href="#">支持与服务</a></li>
                    <li class="post-breadcrumb-item font-size-small"><a href="#">免责声明</a></li>    
                </ol> 
            </div>
            <div class="col-lg-12 col-sm-12 text-center" style="margin-bottom: 40px;">
                <h2 style="font-weight: 600; margin: 20px 0px;"><?php the_title(); ?></h2>
                <div class="dropdown-divider"></div>
            </div>
            <div class="col-lg-2 hide-768px">
                <div id="fixed-tool" class="page-tool">
                    <ul>
                        <a href="#" class="font-size-small-14"><li>关于我们</li></a>
                        <a href="#" class="font-size-small-14"><li>意见反馈</li></a href="#">
                        <a href="#" class="font-size-small-14"><li>友情链接</li></a href="#">
                        <a href="#" class="font-size-small-14"><li>联系优设</li></a href="#">
                        <a href="#" class="font-size-small-14"><li>用户协议</li></a href="#">
                        <a href="#" class="font-size-small-14"><li>免责声明</li></a href="#">
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
                <div class="page-support-content" >
                    <?php the_content(); ?> 
                </div>
                <?php else : ?>
                <div class="grid_8">
                    没有找到你想要的页面！
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-2 hide-768px">
            </div>
        </div>
        
            
<?php get_footer(); ?>