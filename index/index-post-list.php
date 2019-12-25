<div class="post-list">
    <span class="index-title new-post">最新文章</span>
    <span class="font-size-small">设计文章</span>
    <div class="post-list-tags hide-768px right">
        <a href="#">UI</a>
        <a href="#">网页</a>
        <a href="#">平面</a>      
        <a href="#">手绘</a>
        <a href="#">电商</a>
        <a href="#">交互</a>
        <a href="#">产品</a>
        <a href="#">下载</a>
    </div>
    
    <div class="dropdown-divider"></div>
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <div class="index-posts-list" style="margin: 20px 0px; padding: 10px 10px; overflow: hidden;" >
        <a href="<?php the_permalink(); ?>">
            <div class="post-img-div">
                <img class="post-img" src="<?php the_field('article-cover-images'); ?>">
            </div>
            <!--<img src="< ?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); echo $full_image_url[0]; ?>" class="index-posts-list-img">-->
            <p class="index-posts-list-title"><?php the_title(); ?></p>
            <p class="font-size-small-14 hide-768px" style="margin: 20px 0px;">
                <?php if (has_excerpt()) {
                    echo $description = get_the_excerpt(); //文章编辑中的摘要
                }else {
                    echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 150,"......"); //文章编辑中若无摘要，自定截取文章内容字数做为摘要
                } ?></p>
        </a>
        <p class="posts-list-info font-size-small">
            <?php the_time('Y-n-j') ?>
            <?php the_author_posts_link(); ?>
            <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?>
            <?php edit_post_link('编辑', '', ''); ?>
        </p>
    </div>
    <div class="dropdown-divider"></div>
    <?php endwhile; ?>

    <a href="<?php $select_pages_allposts = of_get_option('select_pages_allposts', ''); the_permalink($select_pages_allposts); ?>">
        <button type="button" class="btn all-post-btn btn-block">查看全部文章</button>
    </a>

    

    <?php else : ?>
    <h3 class="title"><a href="#" rel="bookmark">未找到</a></h3>
    <p>没有找到任何文章！</p>
    <?php endif; ?>
</div>