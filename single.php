<?php get_header(); ?>

<?php $article_type = get_field('article-type');
    $reprinted_from = get_field('reprinted-from');
    $reprinted_url = get_field('reprinted-url');
    $translation_from = get_field('translation-from');
    $translation_url = get_field('translation-url'); 
?>

<div class="row">
    <div class="col-12">
        <?php if(function_exists('cmp_breadcrumbs')) cmp_breadcrumbs();?>

        <h1 class="post-title"><?php the_title(); ?></h1>
        

        <p class="font-size-small-14 post-info">
            <span>
                <?php
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
            </span>
            <span><?php the_time('Y年n月j日') ?></span>
            <span>阅读 <?php get_post_views($post -> ID); ?></span>
            <span><?php comments_popup_link('评论 0', '评论 1', '评论 %', '', ''); ?></span>
            <span><?php edit_post_link('编辑', '[', ']'); ?></span>
        </p>
        <div class="dropdown-divider"></div>
    </div>


    <div class="col-lg-9 col-sm-12 container">
        <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
            <!--文章内容-->
            <div class="post-content border-radius-4">
                <?php the_content(); ?>
            </div>
        <?php else : ?>
            <div class="errorbox">
                没有文章！
            </div>
        <?php endif; ?>
        

        <div class="post-content-bottom">
            <!-- 二维码引流 -->
            <div class="post-qr">
                <p>扫码关注公众号</p>
                <img src="<?php echo of_get_option('weixin_qr_uploader', ''); ?>" width="120px">
            </div>

            <div class="dropdown-divider"></div>

            <!-- 版权声明 -->
            <div class="post-copyright-notice">
                <?php
                    if($article_type == "original") {
                        $the_permalink = get_permalink();
                        $the_title = get_the_title();
                        echo "转载请注明出处：<a href='" . $the_permalink ."'>《".$the_title."》</a>";
                        echo "<a href='javascript:void(0)' onclick='copy_code('" .$the_permalink. "'); return false;' class='click-copy-link'><i class='iconfont icon-link' aria-hidden='true'></i><span>点击复制链接</span></a>";
                        echo "<br /><i class='iconfont icon-yuanchuang post-icon'></i><span>文章为作者独立观点不代表本网站立场</span>";
                    } elseif ($article_type == "reproduced") {
                        echo "<span>转载自：<a href='" . $reprinted_url ."'>" . $reprinted_from . "</a></span>";
                        echo "<br /><i class='iconfont icon-azhuanzai post-icon'></i><span>本文转载自其他网站，请勿再次转载本文</span>";
                    } elseif ($article_type == "translation") {
                        echo "<span>原文：<a href='" . $translation_url ."'>" . $translation_from . "</a></span>";
                        echo "<br /><i class='iconfont icon-fanyiline post-icon'></i><span>本文翻译自其他文章，可能存在翻译错误，本网站不保证文章准确性</span>";
                }?>
            </div>

            <div class="dropdown-divider"></div>

            <!-- 文章标签 -->
            <div class="post-tags">
                <p><i class="iconfont icon-biaoqian post-icon"></i>继续阅读与本文标签相同的文章</p>
                <?php the_tags('<span class="post-tags-badge">','</span><span class="post-tags-badge">','</span>'); ?>
            </div>

            <div class="dropdown-divider"></div>

            <!-- 评论 -->
            <div class="post-comments">
                <p><i class="iconfont icon-pinglun post-icon"></i>评论</p>
                <?php comments_template(); ?>
            </div>

            <div class="dropdown-divider"></div>

        </div>
    </div>

    <!-- 右 -->
    <div class="col-lg-3 hide-768px">
        <div class="single-tool border-radius-4" id="fixed-tool">
            
            <h5 class="lanmu-title"><i class="iconfont icon-gongju" style="margin-right: 5px; color:#ff5c00;"></i>文章小工具</h5>
            <div class="dropdown-divider"></div>
            <p class="font-size-small-14">《<?php the_title(); ?>》</p>
            <p class="font-size-small-14">
                <i class="iconfont icon-shijian post-icon"></i><?php echo count_words_read_time(); ?>
            </p>
            <div class="post-font-size-change">
                <a href="javascript:void(0);" class="font-size-small-14"><span class="smaller">A-</span></a>
                <a href="javascript:void(0);" class="font-size-small-14"><span>14</span></a>
                <a href="javascript:void(0);" class="font-size-small-14"><span>16</span></a>
                <a href="javascript:void(0);" class="font-size-small-14"><span>18</span></a>
                <a href="javascript:void(0);" class="font-size-small-14"><span>20</span></a>
                <a href="javascript:void(0);" class="font-size-small-14"><span class="bigger">A+</span></a>
            </div>
        </div>
        <div class="single-tool border-radius-4">
            <h5 class="lanmu-title"><i class="iconfont icon-xiangsichanpin post-icon"></i>相似文章</h5>
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