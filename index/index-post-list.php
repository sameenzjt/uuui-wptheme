<div class="post-list">
    <i class="iconfont icon-wenzhang icon"></i>
    <h2 class="index-title d-inline">最新文章</h2>
    <div class="post-list-tags float-right font-size-small-14">
        <?php wp_tag_cloud( array ( 'smallest' => '14', 'largest' => 14, 'unit' => 'px', 'order' => 'RAND', 'number' => 8 ) ); ?>
    </div>
    
    
    <div class="dropdown-divider"></div>
    
    <?php
        $args=array(
        'post_status' => 'publish',
        'paged' => $paged,
        'ignore_sticky_posts' => 1,
        );
        query_posts($args);

        if (have_posts()) : while (have_posts()) : the_post();
    ?>

        <div class="index-posts-list">
            <a href="<?php the_permalink(); ?>">
                <div class="post-img-div">
                    <img class="post-img" src="<?php the_field('article-cover-images'); ?>">
                </div>
                <!--<img src="< ?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); echo $full_image_url[0]; ?>" class="index-posts-list-img">-->
                <h4 class="index-posts-list-title"><?php the_title(); ?></h4>
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

    <!--< ?php endif; ?>-->
    <?php endwhile; ?>

    <?php mo_paging(); ?><!-- 分页 -->

    <!--
    <div class="float-right form-group" style="margin-top:0px">
        <select class="form-control" name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'>
            <option value="">< ?php echo esc_attr(__('Select Month')); ?></option>
            < ?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?>
        </select>
    </div>
        -->

    <?php else : ?>

        <h3 class="title"><a href="#" rel="bookmark">未找到</a></h3>
        <p>没有找到任何文章！</p>

    <?php endif;  wp_reset_query(); ?>
    

</div>