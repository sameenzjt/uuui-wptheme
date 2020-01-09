<?php get_header(); ?>

<div class="row">
    <div class="col-3">
        <img >
        <?php if ( get_the_author_meta( 'qq' ) ){
            echo '作者QQ：'.get_the_author_meta( 'qq' );
        }?>
    </div>

    <div class="col-9">
        h 
    </div>
</div>
    


<?php get_footer(); ?>