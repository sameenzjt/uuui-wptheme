<?php get_header(); ?>
        
<div class="row">
    <div class="col-12">
        
            <div style="background:url(<?php echo z_taxonomy_image_url(); ?>) no-repeat center; background-size: cover;background-attachment: fixed; width:100%;height:400px;border-radius: 4px;">
                <div style="background: rgba(0,0,0,0.5); width:100%;height:400px;padding:20px 80px; color: #fff;">
                    <?php if(function_exists('cmp_breadcrumbs')) cmp_breadcrumbs();?>
                    <h1 class="category-title animated bounceInLeft"><?php single_cat_title() ?></h1>
                    <p  class="font-size-small-14 animated bounceInUp" style="margin-top: 60px;">
                        <span>
                        <?php
                            //获取当前分类文章数
                            global $wp_query;
                            $cat_ID = get_query_var('cat');
                            echo get_category($cat_ID)->count;
                            ?>
                        </span>篇文章
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span>5</span>人评论
                    </p>
                    <p class="font-size-small-14" style="margin-top: 40px;">
                        <?php echo category_description();?>
                    </p>
                </div>
            </div>

    </div>

    <div class="col-lg-9 col-sm-12 box">
        <div class="dropdown-divider"></div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="page-thematic-list" style="margin: 20px 0px; padding: 10px 10px; overflow: hidden;" >
                    <a href="<?php the_permalink(); ?>">    
                        <div class="post-img-div float-left">
                            <img class="post-img" src="<?php the_field('article-cover-images'); ?>">
                        </div>
                        <h4 class="index-thematic-list-title"><?php the_title(); ?></h4>
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

    <div class="col-lg-3 box hide-768px"></div>
</div>
            
        
<?php get_footer(); ?>