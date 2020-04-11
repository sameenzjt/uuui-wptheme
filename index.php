<?php get_header(); ?>
<main>

<div class="row">

    <div class="col-12" style="margin:20px 0">
        <?php include( 'index/index-lanmu-four.php' ); ?>
    </div>


    <div class="col-lg-9 col-sm-12" style="margin:20px 0">
        <?php include( 'index/index-post-list.php' ); ?>
    </div>


    <div class="col-3 index-sidebar">
        <?php if(! wp_is_mobile()){ ?>
            <?php include( 'index/index-sidebar.php' ); ?>
            <?php dynamic_sidebar( 'index_sidebar_widget' ); ?>
        <?php }else {
            echo '';
        } ?>
        
    </div>


    <!--
    <div class="col-12" style="margin-top:20px;">
        <div class="dropdown-divider" style="margin-bottom:20px;"></div>
        < ?php include( 'index/index-navigation.php' ); ?>
    </div>
    -->
    <div class="col-12" style="margin:20px 0">
        <?php include( 'index/index-thematic.php' ); ?>
    </div>

</div>

</main>
<?php get_footer(); ?>