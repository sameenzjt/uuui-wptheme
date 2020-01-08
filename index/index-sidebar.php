<div class="sidebar-border border-radius-4 sidebar-box"><!-- 细节看点 -->
    <h5 class="lanmu-title">细节看点</h5>
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col-lg-6" style="margin:6px 0px; padding: 0px 10px;">
            <a href="#">
                <div class="sidebar-tags-div">
                    <span>#用户引导</span>
                </div>
            </a>
        </div>
        <div class="col-lg-6" style="margin:6px 0px; padding: 0px 10px;">
            <a href="#">
                <div class="sidebar-tags-div">
                    <span>#用户引导</span>
                </div>
            </a>
        </div>
        <div class="col-lg-6" style="margin:6px 0px; padding: 0px 10px;">
            <a href="#">
                <div class="sidebar-tags-div">
                    <span>#用户引导</span>
                </div>
            </a>
        </div>
        <div class="col-lg-6" style="margin:6px 0px; padding: 0px 10px;">
            <a href="#">
                <div class="sidebar-tags-div">
                    <span>#用户引导</span>
                </div>
            </a>
        </div>
        <div style="width: 100%; margin: 10px 0px; padding: 0px 10px;">
            <a href="#">
                <div class="text-center all-tags-btn font-size-small-14">全部细节&nbsp;&gt;</div>
            </a>
        </div>


    </div><!-- row-end -->
</div><!-- 细节看点-end -->


<div class="sidebar-border border-radius-4 sidebar-box"><!-- 置顶文章 -->
    <h5 class="lanmu-title"><i class="iconfont icon-zhiding5 icon"></i>置顶文章</h5>
    <div class="dropdown-divider"></div>
    <ol style="display: block; padding-left:20px">
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
