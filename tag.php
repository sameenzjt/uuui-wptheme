<?php
    /*
    Template Name: Tags
    */
?>
<?php get_header(); ?>
<main>
    <h1 class="category-title animated bounceInLeft"><?php single_tag_title() ?></h1>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="index-posts-list">
            <a href="<?php the_permalink(); ?>">    
                <div class="post-img-div">
                    <img class="post-img" src="<?php the_field('article-cover-images'); ?>">
                </div>
                <h2 class="index-posts-list-title"><?php the_title(); ?></h2>
                <p class="font-size-small-14 index-posts-list-excerpt">
                    <?php if (has_excerpt()) {
                        echo $description = get_the_excerpt(); //文章编辑中的摘要
                    }else {
                        echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 150,"......"); //文章编辑中若无摘要，自定截取文章内容字数做为摘要
                    } ?>
                </p>
            </a>
            <div class="posts-list-info font-size-small">
                <?php the_time('Y-n-j') ?>
                <?php the_author_posts_link(); ?>
                <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?>
                <?php edit_post_link('编辑', '', ''); ?>
            </div>
        </div>
        
    <?php endwhile; ?>
    <?php mo_paging(); ?> <!-- 分页 -->
    <?php else : ?>
        <h3 class="title"><a href="#" rel="bookmark">未找到</a></h3>
        <p>没有找到任何文章！</p>
    <?php endif; wp_reset_query(); ?>
 
</main>
<?php get_footer(); ?>