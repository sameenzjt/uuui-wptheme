<?php
    /*
    Template Name: 全部文章
    */
?>
<?php get_header(); ?>
<main>
<h1><?php the_title(); ?></h1>

<select class="form-control" name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'>
    <option value=""><?php echo esc_attr(__('Select Month')); ?></option>
    <?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?> 
</select>
<div class="row">
    <div class="col-9" style="margin:20px 0;">
        <ul class="post-list">
            <?php $args=array(
                'post_status' => 'publish',
                'paged' => $paged,
                'ignore_sticky_posts' => 1,
                );
                query_posts($args);
                if (have_posts()) : while (have_posts()) : the_post();
            ?>
            <li class="index-posts-list">
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
            </li>
            <?php endwhile; ?>
                <?php mo_paging(); ?>
            <?php else : ?>
                <h3>未找到</h3>
                <p>没有找到任何文章！</p>
            <?php endif;  wp_reset_query(); ?>
        </ul>
        
    </div>
    
    <div class="col-3">
d
    </div>
</div>



</main>
<?php get_footer(); ?>