<?php
    /*
    Template Name: 全部专题
    */
?>
<?php get_header(); ?>
<main>

<div class="row">

    <div class="col-lg-12 col-sm-12 text-center" style="margin-bottom: 40px;">
        <h2 style="font-weight: 600; margin: 20px 0px;"><?php the_title(); ?></h2>
        <div class="dropdown-divider"></div>
    </div>
    <?php foreach (get_categories() as $cat) : ?>
        <div class="col-lg-3 col-md-6 col-sm-6"><!-- 专题1-->
            <div class="index-thematic-div">
                <a href="<?php echo get_category_link($cat->term_id); ?>">
                    <div class="index-thematic-img" style="background-image: url(<?php echo z_taxonomy_image_url($cat->term_id); ?>);">
                        <span class="index-thematic-info float-right"><?php echo get_category($cat->term_id)->count; ?>篇文章</span>
                    </div>
                    <i style="background-color: #ff5c00;">&nbsp;</i>
                    <span><?php echo $cat->cat_name; ?></span>
                    <br />
                    <span class="font-size-small-14 index-category-description">
                        <?php echo category_description($cat->term_id);?>
                    </span>
                </a>
            </div>
        </div>
    <?php endforeach; ?>

</div>


</main>
<?php get_footer(); ?>