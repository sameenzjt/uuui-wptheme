<div class="row">

    <!--软件教程-->
    <div class="col-lg-3 col-sm-6 little-section-father">
        <div class="little-section border-radius-4 h-100">
            <i class="iconfont icon-shejiruanjian icon"></i>
            <span>软件教程</span>
            <span  class="font-size-small ">常用软件自学路径</span>
            <div class="dropdown-divider"></div>

            <?php $categories_ps = of_get_option('categories_ps','');
                $categories_ai = of_get_option('categories_ai','');
            ?>
            <ul class="row text-center" style="list-style-type: none; margin:0px;padding:0px;">
                <li class="col-3">
                    <a href="<?php echo get_category_link($categories_ps) ?>">
                        <img src="<?php bloginfo('template_url'); ?>/images/Adobe-Ps.png" width="36px" height="36px" height="36px" style="margin:10px 0px;">
                    </a>
                </li>
                <li class="col-3" >
                    <a href="<?php echo get_category_link($categories_ai) ?>">
                        <img src="<?php bloginfo('template_url'); ?>/images/Adobe-Ai.png"  width="36px" height="36px" style="margin:10px 0px;">
                    </a>
                </li>
                <li class="col-3" >
                    <img src="<?php bloginfo('template_url'); ?>/images/Adobe-Ae.png"  width="36px" height="36px" style="margin:10px 0px;">
                </li>
                <li class="col-3" >
                    <img src="<?php bloginfo('template_url'); ?>/images/Adobe-Pr.png"  width="36px" height="36px" style="margin:10px 0px;">
                </li>
                <li class="col-3 hide" >
                    <img src="<?php bloginfo('template_url'); ?>/images/Adobe-Ps.png"  width="36px" height="36px" style="margin:10px 0px;">
                </li>
                <li class="col-3 hide" >
                    <img src="<?php bloginfo('template_url'); ?>/images/Adobe-Ae.png"  width="36px" height="36px" style="margin:10px 0px;">
                </li>
                <li class="col-3 hide" >
                    <img src="<?php bloginfo('template_url'); ?>/images/Adobe-Ai.png"  width="36px" height="36px" style="margin:10px 0px;">
                </li>
                <li class="col-3 hide" >
                    <img src="<?php bloginfo('template_url'); ?>/images/Adobe-Pr.png"  width="36px" height="36px" style="margin:10px 0px;">
                </li>
                <div class="look_more_soft w-100"><a href="javascript:void(0)" class="text-center"><i class="iconfont icon-zhankai show font-size-small"></i><i class="iconfont icon-shouqishang hide font-size-small"></i></a></div>

            </ul>
        </div>
    </div>

    <!--必备网站--> 
    <div class="col-lg-3 col-sm-6 little-section-father">
        <div class="little-section border-radius-4 h-100">
            <i class="iconfont icon-gongju1 icon"></i>
            <span>必备网站</span>
            <span  class="font-size-small">倾心推荐</span>
            <div class="dropdown-divider"></div>
            <div class="designer-must-have">
                
                <?php echo of_get_option('designer-must-have', ''); ?>
            </div>
        </div>
    </div>

    <!--热门频道--> 
    <div class="col-lg-3 col-sm-6 little-section-father">
        <div class="little-section border-radius-4 h-100">
            <i class="iconfont icon-hot_light icon"></i>
            <span>热门频道</span>
            <span  class="font-size-small">常用软件自学路径</span>
            <div class="dropdown-divider"></div>
            <div class="lanmu-soft-tutorial">
                <div class="text-center float-left">
                    <a href="#">
                        <i class="iconfont icon-Adobecreativecloud lanmu-icon" style="font-size:30px;"></i>
                        <p class="font-size-small">Adobe2020</p>
                    </a>
                </div>
                <div class="text-center float-left">
                    <a href="#">
                        <i class="iconfont icon-Adobecreativecloud lanmu-icon" style="font-size:30px;"></i>
                        <p class="font-size-small">Adobe</p>
                    </a>
                </div>
                <div class="text-center float-left">
                    <a href="#">
                        <i class="iconfont icon-Adobecreativecloud lanmu-icon" style="font-size:30px;"></i>
                        <p class="font-size-small">Adobe</p>
                    </a>
                </div>
                <div class="text-center float-left">
                    <a href="#">
                        <i class="iconfont icon-Adobecreativecloud lanmu-icon" style="font-size:30px;"></i>
                        <p class="font-size-small">Adobe</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 软件教程 --> 
    <div class="col-lg-3 col-sm-6 little-section-father">
        <div class="little-section border-radius-4 h-100">
            
        </div>
    </div>

</div><!--row-->