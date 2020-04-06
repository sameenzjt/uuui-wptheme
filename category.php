<?php get_header(); ?>
<main>

<div class="zt-banner-div">
        <div  class="zt-banner-bg" style="background: url(<?php echo z_taxonomy_image_url(); ?>) no-repeat center;"></div>
        <div class="zt-banner-content">
            <div class="zt-banner-img">
                <img src="<?php echo z_taxonomy_image_url(); ?>" width="300px">
            </div>
            <h1><?php single_cat_title() ?></h1>
            <p>
                <span>
                <?php
                    //获取当前分类文章数
                    global $wp_query;
                    $cat_ID = get_query_var('cat');
                    echo get_category($cat_ID)->count;
                    ?>
                </span>篇文章
            </p>
            <p><?php echo category_description();?></p>
        </div>
    </div>
        
<div class="row">
    
    <div class="col-lg-9 col-sm-12 box">
        <?php if(function_exists('cmp_breadcrumbs')) cmp_breadcrumbs();?>
        <div class="dropdown-divider"></div>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="index-posts-list">
                <a href="<?php the_permalink(); ?>">
                    <div class="index-posts-list-img-div">
                        <img class="index-posts-list-img" alt="<?php the_title(); ?>" src="<?php the_field('article-cover-images'); ?>" onerror="nofind();">
                    </div>
                    <h2 class="index-posts-list-title"><?php the_title(); ?></h2>
                    <div class="font-size-small index-posts-list-info">
                        <span><?php the_time('Y.m.d') ?></span>
                        <?php the_author_posts_link(); ?>
                        <?php edit_post_link('编辑', '', ''); ?>
                    </div>
                    <p class="font-size-small-14 index-posts-list-excerpt">
                        <?php if (has_excerpt()) {
                            echo get_the_excerpt(0, 150,"......"); //文章编辑中的摘要
                        } else {
                            echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 150,"......"); //文章编辑中若无摘要，自定截取文章内容字数做为摘要
                        } ?>
                    </p>
                </a>
            </div>
        <?php endwhile; ?>
            <?php mo_paging(); ?><!-- 分页 -->
        <?php else : ?>
            <h3>未找到</h3>
            <p>没有找到任何文章！</p>
        <?php endif;  wp_reset_query(); ?>
    </div>

    <div class="col-lg-3 box"></div>
</div>
            
       
</main>
<?php get_footer(); ?>