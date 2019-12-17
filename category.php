<?php get_header(); ?>
        
<div class="row">
    <div class="col-12">
        
            <div style="background:url(<?php echo z_taxonomy_image_url(); ?>) no-repeat center; background-size: cover;background-attachment: fixed; width:100%;height:400px;border-radius: 4px;">
                <div style="background: rgba(0,0,0,0.5); width:100%;height:400px;padding:0px 80px; color: #fff;">
                    <ol class="page-breadcrumb" >
                        <li class="post-breadcrumb-item font-size-small"><a href="#">首页</a></li>
                        <li class="post-breadcrumb-item font-size-small"><a href="#">设计文章</a></li>
                        <li class="post-breadcrumb-item font-size-small"><a href="#">热门专题</a></li>
                        <li class="post-breadcrumb-item font-size-small"><a href="#">设计史太浓</a></li>     
                    </ol> 
                    <h1 class="category-title"><?php the_category(); ?></h1>
                    <p  class="font-size-small-14" style="margin-top: 50px;">
                        <span>
                        <?php
                            //获取当前分类文章数
                            global $wp_query;
                            $cat_ID = get_query_var('cat');
                            echo get_category($cat_ID)->count;
                            ?>
                        </span>篇文章
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span>550398</span>位观众
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span>5</span>人评论
                    </p>
                    <p class="font-size-small-14" style="margin-top: 20px;">
                        <?php echo category_description();?>
                    </p>
                </div>
            </div>

    </div>

    <div class="col-lg-9 col-sm-12 box">
        <span class="index-title">全部文章</span>
        <div class="dropdown-divider"></div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
                <div class="page-thematic-list" style="margin: 20px 0px; padding: 10px 10px; overflow: hidden;" >
                    <a href="<?php the_permalink(); ?>">    
                        <img src="<?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); echo $full_image_url[0]; ?>" class="page-thematic-list-img">
                        <p class="page-thematic-list-title"><?php the_title(); ?></p>
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

        <?php else : ?>
        <h3 class="title"><a href="#" rel="bookmark">未找到</a></h3>
        <p>没有找到任何文章！</p>
        <?php endif; ?>
    </div>

    <div class="col-lg-3 box hide-768px"></div>
</div>
            
        
<?php get_footer(); ?>