<div class="row">

    <!--软件教程-->
    <section class="col-lg-3 col-sm-6">
        <div class="lanmu-section-div h-100">
           
        </div>
    </section>

    <!--必备网站-->
    <section class="col-lg-3 col-sm-6 designer-must-have">
        <div class="lanmu-section-div h-100">
            <?php echo of_get_option('designer-must-have', ''); ?>
        </div>
    </section>

    <!--热门频道--> 
    <section class="col-lg-3 col-sm-6">
        <div class="lanmu-section-div h-100">
            <div class="lanmu-section text-center float-left">
                <a href="<?php the_permalink($select_all_tags); ?>">
                    <i class="iconfont icon-xijie lanmu-icon"></i>
                    <p class="font-size-small">细节</p>
                </a>
            </div>
            <div class="lanmu-section text-center float-left">
                <a href="<?php the_permalink($select_pages_allthematic); ?>">
                    <i class="iconfont icon-zhuanti lanmu-icon"></i>
                    <p class="font-size-small">专题</p>
                </a>
            </div>
            <div class="lanmu-section text-center float-left">
                <a href="#">
                    <i class="iconfont icon-Adobecreativecloud lanmu-icon"></i>
                    <p class="font-size-small">Adobe</p>
                </a>
            </div>
            <div class="lanmu-section text-center float-left">
                <a href="#">
                    <i class="iconfont icon-Adobecreativecloud lanmu-icon"></i>
                    <p class="font-size-small">Adobe</p>
                </a>
            </div>
        </div>
    </section>

    <!-- 软件教程 --> 
    <section class="col-lg-3 col-sm-6">
        <div class="lanmu-section-div h-100">
            
        </div>
    </section>

</div><!--row-->