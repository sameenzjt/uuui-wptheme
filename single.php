<?php get_header(); ?>

        <div class="row">
            <div class="col-12">
                <ol class="post-breadcrumb">
                    <li class="post-breadcrumb-item font-size-small"><a href="#">首页</a></li>
                    <li class="post-breadcrumb-item font-size-small"><a href="#">设计文章</a></li>
                    <li class="post-breadcrumb-item font-size-small"><a href="#">交互</a></li>
                    <li class="post-breadcrumb-item font-size-small"><a href="#">正文</a></li>     
                </ol>

                <h2><?php the_title(); ?></h2>
                <p class="font-size-small-14 post-info">
                    <span>作者：Lyudmil</span>
                    <span><?php the_time('Y年n月j日') ?></span>
                    <span>阅读 12775</span>
                    <span>点赞 82</span>
                    <span><?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?></span>
                    <span><?php the_tags('标签：', ', ', ''); ?></span>
                    <span><?php edit_post_link('编辑', ' • ', ''); ?></span>
                </p>
                <div class="dropdown-divider"></div>
            </div>


            <div class="col-lg-9 col-sm-12">
            <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
                <!--文章内容-->
                <div class="post-content">
                    <?php the_content(); ?>



                </div>
                <?php else : ?>
                <div class="errorbox">
                    没有文章！
                </div>
                <?php endif; ?>
                <!--版权声明-->
                <div class="post-copyright-notice">
                    <div class="dropdown-divider"></div>
                    <p>文章为作者独立观点不代表优设网立场，未经允许不得转载。</p>
                    <div class="dropdown-divider"></div>
                </div>
                <!--文章标签-->
                <div class="post-tags">
                    <p>继续阅读与本文标签相同的文章</p>
                    <div>
                        <a href="#"><span class="post-tags-badge font-size-small-14">2020设计趋势</span></a>
                        <a href="#"><span class="post-tags-badge font-size-small-14">LOGO 设计</span></a>
                        <a href="#"><span class="post-tags-badge font-size-small-14">LOGO设计趋势</span></a>
                        <a href="#"><span class="post-tags-badge font-size-small-14">经验分享</span></a>
                        <a href="#"><span class="post-tags-badge font-size-small-14">设计趋势</span></a>
                    </div>
                </div>
                <!--评论-->
                <div style="margin: 40px 0; padding: 0px 90px 0px 100px;">
                    <?php comment_form(); ?>
                </div>

            </div>

            <!--右-->
            <div class="col-lg-3 hide-768px">
                <div class="single-tool" id="fixed-tool">
                    <h5 class="lanmu-title">文章小工具</h5>
                    <div class="dropdown-divider"></div>
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