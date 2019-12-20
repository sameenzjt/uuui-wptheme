<?php
    /*
    Template Name: 001
    */
?>

<?php get_header(); ?>



<?php
    $cats = get_categories(array('taxonomy' => 'links_cat'));
    foreach ( $cats as $cat ) {
    query_posts( 'showposts=10&cat=' . $cat->cat_ID );
?>
    <h3><?php echo $cat->cat_name; ?></h3>
    <ul class="sitemap-list">
        <?php while ( have_posts() ) { the_post(); ?>
        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php } wp_reset_query(); ?>
    </ul>
<?php } ?>

    

<?php get_footer(); ?>