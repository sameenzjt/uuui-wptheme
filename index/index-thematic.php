
    <i class='iconfont icon-zhuanti1 icon'></i>
    <span class="index-title">专题</span>
    <span class="font-size-small-14 float-right view-all">
        <a href="<?php $select_pages_allthematic = of_get_option('select_pages_allthematic', '');
                the_permalink($select_pages_allthematic); ?>">查看全部</a>
    </span>
    <div class="dropdown-divider"></div>

    <div class="row">
        <?php $index_thematic_1 = of_get_option('index_thematic_1', '');
            $index_thematic_2 = of_get_option('index_thematic_2', '');
            $index_thematic_3 = of_get_option('index_thematic_3', '');
            $index_thematic_4 = of_get_option('index_thematic_4', '');
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6"><!-- 专题1-->
            <div class="index-thematic-div">
                <a href="<?php echo get_category_link($index_thematic_1);?>">
                    <div class="index-thematic-img" style="background-image: url(<?php echo z_taxonomy_image_url($index_thematic_1); ?>);">
                        <span class="index-thematic-info float-right"><?php echo get_category($index_thematic_1)->count; ?>篇文章</span>
                    </div>
                    <h3 class="index_thematic_name"><?php echo get_cat_name($index_thematic_1);?></h3>
                    <span class="font-size-small-14 index-category-description"><?php echo category_description($index_thematic_1);?></span>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6"><!-- 专题2-->
            <div class="index-thematic-div">
                <a href="<?php echo get_category_link($index_thematic_2);?>">
                    <div class="index-thematic-img" style="background-image: url(<?php echo z_taxonomy_image_url($index_thematic_2); ?>);">
                        <span class="index-thematic-info float-right"><?php echo get_category($index_thematic_2)->count; ?>篇文章</span>
                    </div>
                    <h3 class="index_thematic_name"><?php echo get_cat_name($index_thematic_2);?></h3>
                    <span class="font-size-small-14 index-category-description"><?php echo category_description($index_thematic_2);?></span>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6"><!-- 专题3-->
            <div class="index-thematic-div">
                <a href="<?php echo get_category_link($index_thematic_3);?>">
                    <div class="index-thematic-img" style="background-image: url(<?php echo z_taxonomy_image_url($index_thematic_3); ?>);">
                        <span class="index-thematic-info float-right"><?php echo get_category($index_thematic_3)->count; ?>篇文章</span>
                    </div>
                    <h3 class="index_thematic_name"><?php echo get_cat_name($index_thematic_3);?></h3>
                    <span class="font-size-small-14 index-category-description"><?php echo category_description($index_thematic_3);?></span>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6"><!-- 专题4-->
            <div class="index-thematic-div">
                <a href="<?php echo get_category_link($index_thematic_4);?>">
                    <div class="index-thematic-img" style="background-image: url(<?php echo z_taxonomy_image_url($index_thematic_4); ?>);">
                        <span class="index-thematic-info float-right"><?php echo get_category($index_thematic_4)->count; ?>篇文章</span>
                    </div>
                    <h3 class="index_thematic_name"><?php echo get_cat_name($index_thematic_4);?></h3>
                    <span class="font-size-small-14 index-category-description"><?php echo category_description($index_thematic_4);?></span>
                </a>
            </div>
        </div>

    </div><!-- row end-->
