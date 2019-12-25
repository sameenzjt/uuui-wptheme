<?php get_header(); ?>

        <div class="row">
            <div class="col-12">
                <?php if(function_exists('cmp_breadcrumbs')) cmp_breadcrumbs();?>

                <h1><?php the_title(); ?></h1>
                

                <p class="font-size-small-14 post-info">

                <?php
                    $article_type = get_field('article-type');
                    $reprinted_from = get_field('reprinted-from');
                    $reprinted_url = get_field('reprinted-url');
                    $translation_from = get_field('translation-from');
                    $translation_url = get_field('translation-url');

                    if($article_type == "original") {
                        echo "<span class='badge badge-info'>原创</span>";
                        echo "<span>作者：Lyudmil</span>";
                    } elseif ($article_type == "reproduced") {
                        echo "<span class='badge badge-info'>转载</span>";
                        echo "<span>转载来源：" . $reprinted_from . "</span>";
                    } elseif ($article_type == "translation") {
                        echo "<span class='badge badge-info'>翻译</span>";
                        echo "<span>原文来源：" . $translation_from . "</span>";
                    }
                ?>
                    
                    <span><?php the_time('Y年n月j日') ?></span>
                    <span>阅读 <?php get_post_views($post -> ID); ?></span>
                    <span>点赞 82</span>
                    <span><?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?></span>

                    <span><?php edit_post_link('编辑', ' • ', ''); ?></span>
                </p>
                <div class="dropdown-divider"></div>
            </div>


            <div class="col-lg-9 col-sm-12 container">
            <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
                <!--文章内容-->
                <div class="post-content">
                    <?php the_content(); ?>

                    <?php the_field('001'); ?>

                    
                    



                </div>
                <?php else : ?>
                <div class="errorbox">
                    没有文章！
                </div>
                <?php endif; ?>

                <!-- 二维码引流 -->
                <div class="post-qr" style="background:red;">
                    <p>扫码关注公众号</p>
                    <img src="<?php echo of_get_option('weixin_qr_uploader', ''); ?>" width="120px">
                </div>
                <!-- 版权声明 -->
                <div class="post-copyright-notice">
                    <div class="dropdown-divider"></div>
                    <p>文章为作者独立观点不代表优设网立场，未经允许不得转载。</p>
                    <div class="dropdown-divider"></div>
                </div>
                <!-- 文章标签 -->
                <div class="post-tags">
                    <p>继续阅读与本文标签相同的文章</p>
                    <?php the_tags('<span class="post-tags-badge">','</span><span class="post-tags-badge">','</span>'); ?>
                </div>
                <!-- 评论 -->
                <div style="margin: 40px 0; padding: 0px 90px 0px 100px;">
                    <?php comments_template(); ?>
                </div>

            </div>

            <!-- 右 -->
            <div class="col-lg-3 hide-768px">
                <div class="single-tool" id="fixed-tool">
                    <h5 class="lanmu-title">文章小工具</h5>
                    <div class="dropdown-divider"></div>
                    <p class="font-size-small-14">《<?php the_title(); ?>》</p>
                    <img src="<?php bloginfo('template_url'); ?>/images/time.png" style="float: left; margin: 4px 6px 0px 0px ;">
                    <p class="font-size-small-14"><?php echo count_words_read_time(); ?></p>
                    <div class="post-font-size-change">
                        <a href="javascript:void(0);" class="font-size-small-14"><span class="smaller">A-</span></a>
                        <a href="javascript:void(0);" class="font-size-small-14"><span>14</span></a>
                        <a href="javascript:void(0);" class="font-size-small-14"><span>16</span></a>
                        <a href="javascript:void(0);" class="font-size-small-14"><span>18</span></a>
                        <a href="javascript:void(0);" class="font-size-small-14"><span>20</span></a>
                        <a href="javascript:void(0);" class="font-size-small-14"><span class="bigger">A+</span></a>
                    </div>
                </div>
                <div class="single-tool">
                    <h5 class="lanmu-title">相似文章</h5>
                    <div class="dropdown-divider"></div>
                    <ul style="list-style-type:none; margin: 0px; padding: 0px; font-size: 14px;">
                        <?php $i=1;
                            $cats = wp_get_post_categories($post->ID);
                            if ($cats) {
                                $args = array(
                                'category__in' => array( $cats[0] ),                   
                                'showposts' => 10,
                                'ignore_sticky_posts' => 1
                                );
                            query_posts($args);
                            if (have_posts()) :
                                while (have_posts()) : the_post(); update_post_caches($posts); ?>
                                    <li style="list-style-type: none; display: block;">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <span class="num"><?php echo $i;$i++; ?></span>
                                            <?php the_title(); ?>
                                        </a>
                                    </li>
                            <?php endwhile; else : ?>
                                <li> 暂无文章</li>
                            <?php endif; wp_reset_query(); } ?>                                                        
                    </ul>
                </div>




                
            </div>

        </div>
    

<?php get_footer(); ?>