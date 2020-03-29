<?php
/**
 * Template Name: Tags Cloud
 */
?>
   
 <?php get_header(); ?>

<div class="row">
    <div class="col-lg-12 col-sm-12 text-center" style="margin-bottom: 40px;">
        <h2 style="font-weight: 600; margin: 20px 0px;"><?php the_title(); ?></h2>
        <div class="dropdown-divider"></div>
    </div>
    <div class="col-lg-2"></div>
    <div class="col-lg-8 col-sm-12" style="margin-bottom: 40px;">
        <?php 
        $html = '<ul class="post_tags">';
        foreach (get_tags( array('number' => 50, 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => false) ) as $tag){
        $color = dechex(rand(0,16777215));
        $tag_link = get_tag_link($tag->term_id);
                        
        $html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
        $html .= "{$tag->name} ({$tag->count})</a></li>";
        }
        $html .= '</ul>';
        echo $html; ?>
    </div>
    <div class="col-lg-2"></div>
</div>
        
        


<?php get_footer(); ?>