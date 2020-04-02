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
                        <div class="media border p-3">
                            <img src="https://static.runoob.com/images/mobile-icon.png" class="align-self-start rounded-circle mr-3" style="width:36px">
                            <div class="media-body">
                                <h5>菜鸟教程</h5>
                                <p>学的不仅是技术，更是梦想！！！</p>
                                <div class="media p-3">
                                    <img src="https://static.runoob.com/images/mobile-icon.png" alt="Jane Doe" class="align-self-start rounded-circle mr-3" style="width:36px">
                                    <div class="media-body">
                                    <h5>菜鸟教程</h5>
                                    <p>学的不仅是技术，更是梦想！！！</p>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div><!-- con-1 -->
                
            <div class="con-1">
               df
            </div><!-- con-1 -->

            <div class="con-1 ">
                df1
            </div><!-- con-1 -->
        </div>
        
    </div>


    
<?php get_footer(); ?>