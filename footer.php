    <footer class="footer">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 footer-about-us">
                <p>关于我们</p>
                <p class=" font-size-small-14" style="color:#BDBDBD"><?php echo of_get_option('footer-about-us', ''); ?></p>
            </div>
            <div class="col-lg-5 footer-menu-div">
                <div class="row">
                    <div class="col-4 footer_menu">
                        <p><?php echo of_get_option('footer_menu_1_title', ''); ?></p>
                        <?php 
                            if(function_exists('wp_nav_menu')) {
                                wp_nav_menu(array( 'theme_location' => 'footer_menu_1','container_id' => 'menu_left','fallback_cb' => 'nav_menus_fallback') ); 
                            }
                        ?>
                        
                    </div>
                    <div class="col-4 footer_menu">
                        <p><?php echo of_get_option('footer_menu_2_title', ''); ?></p>
                        <?php 
                            if(function_exists('wp_nav_menu')) {
                                wp_nav_menu(array( 'theme_location' => 'footer_menu_2','container_id' => 'menu_left','fallback_cb' => 'nav_menus_fallback') ); 
                            }
                        ?>
                    </div>
                    <div class="col-4 footer_menu">
                        <p><?php echo of_get_option('footer_menu_3_title', ''); ?></p>
                        <?php 
                            if(function_exists('wp_nav_menu')) {
                                wp_nav_menu(array( 'theme_location' => 'footer_menu_3','container_id' => 'menu_left','fallback_cb' => 'nav_menus_fallback') ); 
                            }
                        ?>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                
                    <div class="float-left" style="width:33%;overflow: hidden;">
                        <a title="微信二维码" href="javascript:void(0);" class="show_weixin">
                            <div class="weixin mx-auto"><i class="iconfont icon-weixin"></i></div>
                            <p>微信</p>
                        </a>
                        <div class="wechat-show-qr text-center">
                            <div id="weixin-show-qr"></div>
                            <div class="show_weixin_popup_foot text-center">使用“扫一扫”<br>关注官方微信</div>
                        </div>
                    </div>
                    <div class="float-left" style="width:33%;overflow: hidden;">
                        <a title="微博" href="<?php echo of_get_option('weibo_link', ''); ?>" target="_blank">
                            <div class="weibo mx-auto"><i class="iconfont icon-weibo"></i></div>
                            <p>微博</p>
                        </a>
                    </div>
                    <div class="float-left" style="width:33%;overflow: hidden;">
                        <a title="头条" href="<?php echo of_get_option('toutiao_link', ''); ?>" target="_blank">
                            <div class="toutiao mx-auto"><i class="iconfont icon-toutiao"></i></div>
                            <p>头条</p>
                        </a>
                    </div>
                    <div class="float-left btn_qq_qun w-100">
                        <a href="<?php echo of_get_option('qq-qun', ''); ?>" target="_blank">
                            <i class="iconfont icon-qq1"></i>&nbsp;官方QQ群
                        </a>
                    </div>
            </div>
            
            <div class="col-lg-12">
                <p style="color: #fff;" class="friend-link">
                    <span>友情链接：</span>
                    <a target="_blank" href="https://www.sameen.art/" title="sameen">Sameen</a>
                    <?php if (function_exists('wpjam_blogroll')) wpjam_blogroll();?>
                   </p>
            </div>

        </div>
        <div class="text-center">
            <span class="footer-copyright border-radius-4">
                Copyright © 2019 <?php bloginfo('name'); ?> &nbsp; 
                <span class="icp-bei"><?php echo of_get_option('icp-bei', ''); ?></span> 
                <span class="gongwang-bei"><i class="beian-icon"></i><?php echo of_get_option('gongwang-bei', ''); ?></span>
            </span>
        </div>
        
    </footer>
    
    <div class="back_top border-radius-4"><i class="iconfont icon-zhiding5"></i></div>


    <script type="text/javascript">//网站社交地址二维码，在jquery.qrcode.min.js之前引入
        var _wechat_url = '<?php echo of_get_option('weixin_qr_uploader', ''); ?>';
    </script>
    

    <?php if( is_single() ) { ?>
        <script type="text/javascript">//社交分享
            var _title,_source,_sourceUrl,_pic,_showcount,_desc,_site,
                _url = '<?php the_permalink(); ?>',
                _pic = '<?php the_field('article-cover-images'); ?>',
                _summary = '<?php echo get_post_meta($post->ID, "description", true); ?>'
        </script>
    <?php } elseif( is_page() ){ ?>
        <script>
            $(".tab-item").click(function() {
            $(this).addClass("btnss")
                .siblings()
                .removeClass("btnss");

            var index = $(this).index();
            $(".con .con-1").eq(index)
                .addClass("active-tab")
                .siblings()
                .removeClass("active-tab");
            });
        </script>
    <?php } ?>

    <?php wp_footer(); ?>
</body>
</html>
