<div class="border-radius-4 index-sidebar-box"><!-- 置顶文章 -->
    <h5 class="index-sidebar-title">置顶文章</h5>
    <div class="dropdown-divider"></div>
    <ol class="sticky_posts">
        <?php
            /* 获取所有置顶文章 */
            $sticky = get_option( 'sticky_posts' );
            /* 对这些文章排序, 日期最新的在最上 */
            rsort( $sticky ); /* 获取5篇文章 */
            $sticky = array_slice( $sticky, 0, 6 );
            /* 输出这些文章 */
            query_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) );
            while ( have_posts() ) : the_post();
        ?>

        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

        <?php endwhile; wp_reset_query();?>
    </ol>
</div><!-- 置顶文章-end -->
