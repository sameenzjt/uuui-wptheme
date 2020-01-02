<div class="post-list">
    <i class="iconfont icon-wenzhang post-icon"></i>
    <h2 class="index-title d-inline">最新文章</h2>
    <div class="post-list-tags hide-768px float-right font-size-small-14">
        <?php wp_tag_cloud( array ( 'smallest' => '14', 'largest' => 14, 'unit' => 'px', 'order' => 'RAND', 'number' => 8 ) ); ?>
    </div>
    
    
    <div class="dropdown-divider"></div>
    
    <?php
        $args = array(
            'ignore_sticky_posts' => 1 //取消文章置顶
        );
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
 
    /*    if (is_sticky()):
            global $more;    // 设置全局变量$more
            $more = 1;?>
        <li>
            <h3 class="index-posts-list-title">
                <span class="badge badge-themecolor">置顶</span>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
                    <?php the_title(); ?>
                </a>
            </h3>
            <p class="font-size-small-14 index-posts-list-excerpt hide-768px" style="margin: 20px 0px;">
                <?php if (has_excerpt()) {
                    echo $description = get_the_excerpt(); //文章编辑中的摘要
                }else {
                    echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 150,"......"); //文章编辑中若无摘要，自定截取文章内容字数做为摘要
                } ?>
            </p>
        </li>

    <?php else:
        global $more;  
        $more = 0;
        */
    ?>

        <div class="index-posts-list" style="margin: 20px 0px; padding: 10px 10px; overflow: hidden;" >
            <a href="<?php the_permalink(); ?>">
                <div class="post-img-div left">
                    <img class="post-img" src="<?php the_field('article-cover-images'); ?>">
                </div>
                <!--<img src="< ?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); echo $full_image_url[0]; ?>" class="index-posts-list-img">-->
                <h3 class="index-posts-list-title"><?php the_title(); ?></h3>
                <p class="font-size-small-14 index-posts-list-excerpt hide-768px" style="margin: 20px 0px;">
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
    
        <a href="<?php $select_pages_allposts = of_get_option('select_pages_allposts', ''); the_permalink($select_pages_allposts); ?>">
            <button type="button" class="btn all-post-btn btn-block border-radius-4">查看全部文章</button>
        </a>

    <?php else : ?>

        <h3 class="title"><a href="#" rel="bookmark">未找到</a></h3>
        <p>没有找到任何文章！</p>

    <?php endif; ?>
</div>