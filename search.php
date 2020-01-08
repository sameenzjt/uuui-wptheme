<?php get_header(); ?>
        
<div class="row">
    <div class="col-lg-12 col-sm-12 box">
        <div class="tag-content">
            <?php printf( __( '关键字“%s”的搜索结果如下：', 'tanhaibonet' ), '<span>' . get_search_query() . '</span>' ); ?>
        </div>
        <div class="dropdown-divider"></div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="page-thematic-list" style="margin: 20px 0px; padding: 10px 10px; overflow: hidden;" >
                    <a href="<?php the_permalink(); ?>">    
                        <div class="post-img-div float-left">
                            <img class="post-img" src="<?php the_field('article-cover-images'); ?>">
                        </div>
                        <h3 class="index-thematic-list-title"><?php the_title(); ?></h3>
                        <p class="font-size-small-14 hide-768px" style="margin: 20px 0px;">
                            <?php if (has_excerpt()) {
                                echo $description = get_the_excerpt(); //文章编辑中的摘要
                            }else {
                                echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 150,"......"); //文章编辑中若无摘要，自定截取文章内容字数做为摘要
                            } ?></p>
                    </a>
                    <p class="font-size-small">
                        <?php the_time('Y-n-j') ?>
                        <?php the_author_posts_link(); ?>
                        <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?>
                        <?php edit_post_link('编辑', ' • ', ''); ?>
                    </p>
                </div>
        
        <?php endwhile; ?>

        <?php mo_paging(); ?> <!-- 分页 -->

        <?php else : ?>

            <h3 class="title"><a href="#" rel="bookmark">未找到</a></h3>
            <p>没有找到任何文章！</p>

        <?php endif; wp_reset_query(); ?>

    </div>

</div>
            
        
<?php get_footer(); ?>