<?php get_header(); ?>

<?php $article_type = get_field('article-type');
    $reprinted_from = get_field('reprinted-from');
    $reprinted_url = get_field('reprinted-url');
    $translation_from = get_field('translation-from');
    $translation_url = get_field('translation-url'); 
    
?>

<div class="row">
    <div class="col-12">
        <?php if(function_exists('cmp_breadcrumbs')) cmp_breadcrumbs(); ?>

        <h1 class="post-title"><?php the_title(); ?></h1>
        <p class="font-size-small-14 post-info">
            <?php
                if($article_type == "original") {
                    echo "<span class='badge badge-info'>原创</span>";
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
            <span><?php comments_popup_link('评论 0', '评论 1', '评论 %', '', ''); ?></span>
            <span><?php edit_post_link('编辑', '[', ']'); ?></span>
        </p>
        <div class="dropdown-divider"></div>
    </div>


    <div class="col-lg-9 col-sm-12 container">
        <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
            <!--文章内容-->
            <div class="post-content">
                <?php the_content(); ?>
                <?php wp_link_pages(array(
                    'before'           => '<div class="single-pagination alert alert-secondary">' . __( '文章分页:', 'uuui' ),//所有链接之前的文本
                    'after'            => '</div>',//所有链接之后的文本
                    'link_before'      => '',//单个链接文本之前的文本
		            'link_after'       => '',//单个链接文本之后的文本
                    'next_or_number'   => 'number',//选择使用数字分页还是上一页、下一页文本分页，可选number或next
                    'separator'        => ' ',//页码分隔符
                    'nextpagelink'     => __( 'Next page', 'uuui'),//下一页链接文本
                    'previouspagelink' => __( 'Previous page', 'uuui' ),//上一页链接文本
                    'pagelink'         => '%',//页码的字符串格式，百分号%会被替换成数字，如页%会生成 “页1”、“页2”这样的样式
                    'echo'             => 1,//选择是要返回结果还是直接输出，默认为True，返回NULL或返回内容；设置为false，则直接输出HTML格式
                )); ?>
            </div>
        <?php else: ?>
            <div class="errorbox">
                没有文章！
            </div>
        <?php endif; ?>


        <div class="post-content-bottom">
            <div class="dropdown-divider"></div>
            <!-- 版权声明 -->
            <div class="post-copyright-notice jumbotron">
                <?php
                    if($article_type == "original") {
                        $the_permalink = get_permalink();
                        $the_title = get_the_title();
                        $blog_title = get_bloginfo('name');

                        echo "<p><i class='iconfont icon-yuanchuang post-icon'></i>
                              本作品采用<a href='https://creativecommons.org/licenses/by-nc-nd/3.0/cn/'>知识共享BY-NC-ND许可协议</a>进行许可。
                              <br /><br />转载请注明出处：<a href='" . $the_permalink ."'>《".$the_title."》 | " . $blog_title . "</a></p>";
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
                <h5><i class="iconfont icon-biaoqian post-icon"></i>继续阅读与本文标签相同的文章</h5>
                <div style="margin-top:20px;">
                    <?php the_tags('<span class="post-tags-badge font-size-small-14">','</span><span class="post-tags-badge font-size-small-14">','</span>'); ?>
                </div>
            </div>
            
            <!-- 文章底部广告 -->
            <?php if(of_get_option('ads', '')) {
                echo "<div>"; echo of_get_option('ads', ''); echo "</div>";
            } ?>
            
            <div class="dropdown-divider"></div>

            <!-- 评论 -->
            <div class="post-comments">
                <h5><i class="iconfont icon-pinglun post-icon"></i>评论</h5>
                <?php comments_template(); ?>
            </div>
            <div class="dropdown-divider"></div>

        </div>
    </div>

    <!-- 右 id="fixed-tool" -->
    <div class="col-lg-3 hide-768px">
        <div class="single-tool border-radius-4">
            
            <h5 class="single_sidebar_title"><i class="iconfont icon-gongju" style="margin-right: 5px; color:#ff5c00;"></i>文章小工具</h5>
            <div class="dropdown-divider"></div>
            <p class="font-size-small-14">《<?php the_title(); ?>》</p>
            <div class="post-font-size-change">
                <a href="javascript:void(0);"><span class="smaller">A-</span></a>
                <a href="javascript:void(0);"><span>14</span></a>
                <a href="javascript:void(0);"><span>16</span></a>
                <a href="javascript:void(0);"><span>18</span></a>
                <a href="javascript:void(0);"><span>20</span></a>
                <a href="javascript:void(0);"><span class="bigger">A+</span></a>
            </div>
             <!-- 作者 -->
             <div class="font-size-small-14" style="margin-top:20px;overflow:hidden;">
                <div class="float-left" style="margin-right:10px;overflow:hidden;">
                    <?php echo get_avatar( get_the_author_meta( 'user_email' ) ,60); ?>
                </div>
                <span><?php the_author_posts_link(); ?></span>
                <span>
                    <a href=" <?php the_author_meta('url'); ?> "><i class="iconfont icon-difangwangzhi"></i></a>
                    <a href="mailto:<?php the_author_meta('email'); ?>"><i class="iconfont icon-mail"></i></a>
                </span>
                <br />
                <span class="font-divider-color"><?php the_author_meta('description'); ?></span>
                
            </div>
        </div>

        <div class="single-tool border-radius-4" style="margin-top:20px">
            <h5 class="single_sidebar_title"><i class="iconfont icon-xiangsichanpin post-icon"></i>相似文章</h5>
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