<?php get_header(); ?>
<div class="row">


    <div class="col-12">
        <?php include( 'index/index-carousel.php' ); ?>
    </div>


    <div class="col-12" style="margin:30px 0px">
        <?php include( 'index/index-lanmu-four.php' ); ?>
    </div>


    
   


    <div class="col-lg-9 col-sm-12">
        <div style="margin-top:20px;">
            <?php include( 'index/index-post-list.php' ); ?>
        </div>
        <div class="dropdown-divider"></div>
        <div style="margin-top:20px;">
            <?php include( 'index/index-thematic.php' ); ?>
        </div>
    </div>

    

    <div class="col-3 hide-768px">
        <?php include( 'index/index-sidebar.php' ); ?>
    </div>

    
    <div class="col-12 hide-768px" style="margin-top:20px;">
        <div class="dropdown-divider" style="margin-bottom:20px;"></div>
        <?php include( 'index/index-navigation.php' ); ?>
    </div>
</div>
<?php get_footer(); ?>