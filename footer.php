</main>

    <footer class="footer">
        <div class="row">
            <div class="col-lg-4 footer-about-us">
                <p>关于我们</p>
                <p style="font-size: 14px;color: rgb(170, 169, 169);"><?php echo of_get_option('footer-about-us', ''); ?></p>
            </div>
            <div class="col-lg-5 footer-about-us hide-768px" style="padding: 0px 60px;">
                <div class="row">
                    <div class="col-4 footer_menu">
                        <p><?php echo of_get_option('footer_menu_1_title', ''); ?></p>
                        <?php 
                            if(function_exists('wp_nav_menu')) {
                                wp_nav_menu(array( 'theme_location' => 'footer_menu_1','container_id'=>'menu_left') ); 
                            }
                        ?>
                        
                    </div>
                    <div class="col-4 footer_menu">
                        <p><?php echo of_get_option('footer_menu_2_title', ''); ?></p>
                        <?php 
                            if(function_exists('wp_nav_menu')) {
                                wp_nav_menu(array( 'theme_location' => 'footer_menu_2','container_id'=>'menu_left') ); 
                            }
                        ?>
                    </div>
                    <div class="col-4 footer_menu">
                        <p><?php echo of_get_option('footer_menu_3_title', ''); ?></p>
                        <?php 
                            if(function_exists('wp_nav_menu')) {
                                wp_nav_menu(array( 'theme_location' => 'footer_menu_3','container_id'=>'menu_left') ); 
                            }
                        ?>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3 mx-auto text-center hide-768px" style="margin: 0px auto;padding-left: 60px; color: #fff;font-size: 12px;">
                
                    <div style="margin: 0px auto; float: left; padding: 0px 10px;">
                        <a href="javascript:void(0);" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<img src='<?php echo of_get_option('weixin_qr_uploader', ''); ?>' width='100%'>">
                            <div class="weixin mx-auto"></div>
                            <p>微信</p>
                        </a>
                    </div>
                    <div style="margin: 0px auto; float: left; padding: 0px 10px;">
                        <a href="javascript:void(0);" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<img src='<?php echo of_get_option('weibo_qr_uploader', ''); ?>' width='100%'>">
                            <div class="weibo mx-auto"></div>
                            <p>微博</p>
                        </a>
                    </div>
                    <div style="margin: 0px auto; float: left; padding: 0px 10px;">
                        <a href="javascript:void(0);" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<img src='<?php echo of_get_option('toutiao_qr_uploader', ''); ?>' width='100%'>">
                            <div class="toutiao mx-auto"></div>
                            <p>头条</p>
                        </a>
                    </div>
            </div>
            <div class="col-lg-12 hide-768px">
                <p style="color: #fff;" class="friend-link">
                    <span>友情链接：</span>
                    <a href="#">申请优设友链</a><a href="#">hao123上网导航</a><a href="#">设计师网址导航</a>
                    <a href="#">psd素材</a><a href="#">优优教程 </a><a href="#">腾讯CDC</a><a href="#">设计导航</a>
                    <a href="#">优设导航</a><a href="#">图片素材</a><a href="#">UI设计培训</a><a href="#">红动中国设计网 </a>   
                    <a href="#">网页模板</a><a href="#">360安全网址导航</a><a href="#">优设</a><a href="#">在线设计</a>
                    <a href="#">WordPress主题定制 </a><a href="#">Nav80网址导航</a><a href="#">网页设计</a><a href="#">视觉同盟</a>
                    <a href="#">腾讯ISUX</a><a href="#">iconfont</a><a href="#">设计达人 </a><a href="#">腾讯TGideas</a><a href="#">PConline创意设计</a>
                    <a href="#">uiiiuiii</a><a href="#">优优网</a><a href="#">U站</a><a href="#">灵感网站</a>
                    <a href="#">ps下载</a><a href="#">正版图片</a><a href="#">c4d教程</a><a href="#">免费软件教程</a> 
                </p>
            </div>

        </div>
        <div class="text-center">
            <span style="background-color: #000; font-size: 10px; padding: 6px 30px;border-radius:4px;color: rgb(170, 169, 169);">
                Copyright © 2019 <?php bloginfo('name'); ?> &nbsp; 
                <span class="hide-768px"><?php echo of_get_option('icp-bei', ''); ?> &nbsp; <?php echo of_get_option('gongwang-bei', ''); ?></span>
            </span>
        </div>
        
    </footer>
    <div class="back_top hide-768px"></div>
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <!-- bootstrap.bundle.min.js 用于弹窗、提示、下拉菜单，包含了 popper.min.js -->
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    

    <!--<script>
        $(".ds").mouseover(function()  //鼠标悬停执行函数
        {
            $(this).removeClass().addClass("col-2 ui-div ui-hover-bg"); //把class清空。再重新赋一个值给它！
        });
        $(".ds").mouseout(function() //鼠标移除执行函数
        {
            $(this).removeClass().addClass("col-2 ui-div"); //把class清空。再重新赋一个值给它！
        });
    </script>-->


    <!-- 返回顶部，按钮默认不可见，当滚动页面到一定高度后，按钮出现（低于500px不显示），500毫秒动画 -->
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/res/js/back-top.js"></script>
    <!-- 二维码弹出框 -->
    <script src="<?php bloginfo('template_url'); ?>/res/js/qr-pop.js"></script>

    <?php if (is_home()) { ?>
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/res/js/index-navigation.js"></script>

    <?php } elseif( is_single() ) { ?>
        <!--  更改文章内容字体大小 -->
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/res/js/change-single-font-size.js"></script>
        <!-- 工具栏上滑至顶部后固定位置 -->
        <script src="<?php bloginfo('template_url'); ?>/res/js/tool-slide-top-fixed.js"></script>

    <?php } elseif( is_page() ) { ?>
        <!-- 工具栏上滑至顶部后固定位置 -->
        <script src="<?php bloginfo('template_url'); ?>/res/js/tool-slide-top-fixed.js"></script>
        
    <?php }?>
<?php wp_footer(); ?>
</body>
</html>
