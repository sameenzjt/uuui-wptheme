<div class="post-list">
    <i class="iconfont icon-wenzhang icon"></i>
    <h2 class="index-title d-inline">最新文章</h2>
    <div class="post-list-tags float-right font-size-small-14">
        <?php wp_tag_cloud( array ( 'smallest' => '14', 'largest' => 14, 'unit' => 'px', 'order' => 'RAND', 'number' => 8 ) ); ?>
    </div>
    
    
    <div class="dropdown-divider"></div>
    
    <?php $args=array(
        'post_status' => 'publish',
        'paged' => $paged,
        'ignore_sticky_posts' => 1,
        );
        query_posts($args);
        if (have_posts()) : while (have_posts()) : the_post();
    ?>
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