<?php
    /*
    Template Name: 全部文章
    */
?>
<?php get_header(); ?>


<select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'>
<option value=""><?php echo esc_attr(__('Select Month')); ?></option>
<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?> </select>

<?php while(have_posts()) : the_post(); ?>
    <h2 class="index-title d-inline"><?php the_title(); ?></h2>
    <div class="dropdown-divider"></div>
    <ul>
        <?php $totalposts = get_posts('numberposts=20&offset=0');
        foreach($totalposts as $post) :
        ?>
            <li class="index-posts-list" style="margin: 20px 0px; padding: 10px 10px; overflow: hidden;" >
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
                    <?php the_category(', ') ?>
                    <?php the_time('Y-n-j') ?>
                    <?php the_author_posts_link(); ?>
                    <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?>
                    <?php edit_post_link('编辑', '', ''); ?>
                </div>
            </li>
            
        <?php endforeach; ?>
    </ul>
<?php endwhile; ?>

<?php get_footer(); ?>