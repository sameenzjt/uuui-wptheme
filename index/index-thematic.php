<div class="row">
   
    <?php $index_thematic_1 = of_get_option('index_thematic_1', '');
        $index_thematic_2 = of_get_option('index_thematic_2', '');
        $index_thematic_3 = of_get_option('index_thematic_3', '');
        $index_thematic_4 = of_get_option('index_thematic_4', '');
    ?>
    <section class="col-lg-3 col-md-4 col-sm-6"><!-- 专题1-->
        <div class="index-thematic-div">
            <a href="<?php echo get_category_link($index_thematic_1);?>">
                <div class="index-thematic-img" style="background-image: url(<?php echo z_taxonomy_image_url($index_thematic_1); ?>);">
                    <span class="index-thematic-info float-right"><?php echo get_category($index_thematic_1)->count; ?>篇文章</span>
                </div>
                <h3 class="index_thematic_name"><?php echo get_cat_name($index_thematic_1);?></h3>
                <span class="font-size-small-14 index-category-description"><?php echo category_description($index_thematic_1);?></span>
            </a>
        </div>
    </section>

    <section class="col-lg-3 col-md-4 col-sm-6"><!-- 专题2-->
        <div class="index-thematic-div">
            <a href="<?php echo get_category_link($index_thematic_2);?>">
                <div class="index-thematic-img" style="background-image: url(<?php echo z_taxonomy_image_url($index_thematic_2); ?>);">
                    <span class="index-thematic-info float-right"><?php echo get_category($index_thematic_2)->count; ?>篇文章</span>
                </div>
                <h3 class="index_thematic_name"><?php echo get_cat_name($index_thematic_2);?></h3>
                <span class="font-size-small-14 index-category-description"><?php echo category_description($index_thematic_2);?></span>
            </a>
        </div>
    </section>

    <section class="col-lg-3 col-md-4 col-sm-6"><!-- 专题3-->
        <div class="index-thematic-div">
            <a href="<?php echo get_category_link($index_thematic_3);?>">
                <div class="index-thematic-img" style="background-image: url(<?php echo z_taxonomy_image_url($index_thematic_3); ?>);">
                    <span class="index-thematic-info float-right"><?php echo get_category($index_thematic_3)->count; ?>篇文章</span>
                </div>
                <h3 class="index_thematic_name"><?php echo get_cat_name($index_thematic_3);?></h3>
                <span class="font-size-small-14 index-category-description"><?php echo category_description($index_thematic_3);?></span>
            </a>
        </div>
    </section>

    <section class="col-lg-3 col-md-4 col-sm-6"><!-- 专题4-->
        <div class="index-thematic-div">
            <a href="<?php echo get_category_link($index_thematic_4);?>">
                <div class="index-thematic-img" style="background-image: url(<?php echo z_taxonomy_image_url($index_thematic_4); ?>);">
                    <span class="index-thematic-info float-right"><?php echo get_category($index_thematic_4)->count; ?>篇文章</span>
                </div>
                <h3 class="index_thematic_name"><?php echo get_cat_name($index_thematic_4);?></h3>
                <span class="font-size-small-14 index-category-description"><?php echo category_description($index_thematic_4);?></span>
            </a>
        </div>
    </section>

</div><!-- row end-->
