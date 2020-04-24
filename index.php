<?php get_header(); ?>
<main>
<?php
$select_pages_allthematic = of_get_option('select_pages_allthematic', '');
$index_look_all_post = of_get_option('index-look-all-post', '');
$select_all_tags = of_get_option('select-all-tags', '');
?>
<div class="row">

    <div class="col-12" style="margin:30px 0 15px">
        <?php include( 'index/index-lanmu-four.php' ); ?>
    </div>

    <div class="col-lg-9 col-sm-12" style="margin:15px 0">
        <div class="index-post">
            <i class="iconfont icon-wenzhang icon"></i>
            <h2 class="index-title">最新文章</h2>
            <div class="index-post-list-tags float-right font-size-small-14">
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
            <?php endwhile; //mo_paging(); ?>
                <div class="index-look-all-post w-100">
                    <a href="<?php the_permalink( of_get_option('index-look-all-post', '') ); ?>">
                        <button type="button" class="btn btn-block">查看全部文章</button>
                    </a>
                </div>
            <?php else : ?>
                <h3>未找到</h3>
                <p>没有找到任何文章！</p>
            <?php endif;  wp_reset_query(); ?>
            
        </div>
    </div>

    <div class="col-3 index-sidebar">
        <?php if( wp_is_mobile() ){ ?>
            <?php echo ''; ?>
        <?php } else { ?>
            <div class="border-radius-4 index-sidebar-box"><!--置顶文章 -->
                <h5 class="index-sidebar-title">置顶文章</h5>
                <div class="dropdown-divider"></div>
                <ol class="sticky_posts">
                    <?php $args = array(
                        'posts_per_page' => -1, 
                        'post__in' => get_option( 'sticky_posts' )
                        );
                        $query = new WP_Query( $args );
                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post();
                    ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php } } wp_reset_postdata(); ?>
                </ol>
            </div><!--置顶文章-end -->
            
            <?php dynamic_sidebar( 'index_sidebar_widget' ); ?>
        <?php } ?>
        
    </div>

    <div class="col-12 index-thematic" style="margin:15px 0">
        <?php include( 'index/index-thematic.php' ); ?>
    </div>
</div>
</main>
<?php get_footer(); ?>