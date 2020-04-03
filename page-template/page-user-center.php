<?php
    /*
    Template Name: 用户中心
    */
?>
<?php get_header(); ?>

<?php
    global $current_user; //当前用户信息数组
    wp_get_current_user();
?>


<div class="uc-body">
        <div class="uc-header text-center">
            <div class="uc-header-content">
                <?php echo get_avatar( $current_user->user_email, 64 ); ?>
                <p><?php echo $current_user->display_name; ?></p>
                <small><?php echo $current_user->description ?></small>
            </div>
            <div class="tab-item-div">
                <div class="tab-item btnss"><a href="javascript:void(0);">我的主页</a></div>
                <div class="tab-item"><a href="javascript:void(0);">我的文章</a></div>
                <div class="tab-item"><a href="javascript:void(0);">管理中心</a></div>
            </div>
        </div>
        
        <div class="tab con">
            <div class="con-1 active-tab" style="overflow: hidden; clear: both;">
                <div class="float-left" style="width: 30%;padding-right: 10px;">
                    <div style="margin-top: 20px; padding: 20px 10px; background-color: #fff; overflow: hidden; ">
                        <div class="float-left text-center" style="width: 33.33%;">
                            <div><strong><?php echo get_comments('count=true&user_id='.$user_ID); ?></strong></div>
                            <div><small>评论数</small></div>
                        </div>
                        <div class="float-left text-center" style="width: 33.33%;">
                            <div><strong><?php echo the_author_posts(); ?></strong></div>
                            <div><small>发布文章</small></div>
                        </div>
                        <div class="float-left text-center" style="width: 33.33%;">
                            <div><strong><?php echo get_comments('count=true&user_id='.$user_ID); ?></strong></div>
                            <div><small>评论数</small></div>
                        </div>
                    </div>
                    <div style="margin-top: 20px; padding: 20px 10px; background-color: #fff;">
                        <div style="overflow: hidden;">
                            <div style="width: 20px;float: left; text-align: center;">H</div>
                            <div style="float: left;margin-left: 5px;"><?php echo $current_user->user_email; ?></div>
                        </div>
                        <div style="overflow: hidden;">
                            <div style="width: 20px;float: left; text-align: center;">H</div>
                            <div style="float: left;margin-left: 5px;"><?php echo $current_user->user_url; ?></div>
                        </div>
                        <div style="overflow: hidden;">
                            <div style="width: 20px;float: left; text-align: center;">H</div>
                            <div style="float: left;margin-left: 5px;"><?php echo $current_user->qq; ?></div>
                        </div>
                        <div style="overflow: hidden;">
                            <div style="width: 20px;float: left; text-align: center;">H</div>
                            <div style="float: left;margin-left: 5px;"><?php echo $current_user->qq_email; ?></div>
                        </div>
                        <div style="overflow: hidden;">
                            <div style="width: 20px;float: left; text-align: center;">H</div>
                            <div style="float: left;margin-left: 5px;"><?php echo $current_user->weibo; ?></div>
                        </div>
                        <div style="overflow: hidden;">
                            <div style="width: 20px;float: left; text-align: center;">H</div>
                            <div style="float: left;margin-left: 5px;"><?php echo $current_user->wechat; ?></div>
                        </div>
                    </div>
                </div>
                <div class="float-left" style="width: 70%;padding-left: 10px;">
                    <div style="margin-top: 20px; padding: 20px; background-color: #fff;">
                        <ul>
                            <?php
                                $args = array(
                                    'user_id' => $current_user->ID, // use user_id
                                );
                                $comments = get_comments($args);
                                foreach($comments as $comment) :
                            ?>
                            <li style="border: #000 1px solid;">
                                <?php echo($comment->comment_content); ?>
                                <?php echo($comment->comment_date); ?>
                                
                                
                            </li>
                                
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php echo $current_user->ID ?>
                    
                </div>
            </div><!-- con-1 -->
                
            <div class="con-1">
                ch
            </div><!-- con-1 -->

            <div class="con-1 ">
                <?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
                    <div class="page-content" >
                        <?php the_content(); ?> 
                    </div>
                <?php else : ?>
                    <div class="grid_8">
                        没有找到你想要的页面！
                    </div>
                <?php endif; ?>
            </div><!-- con-1 -->
        </div>
        
    </div>


    
<?php get_footer(); ?>