<?php get_header(); ?>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

<?php the_content(); ?>

<?php else : ?>
	<div class="grid_8">
		没有找到你想要的页面！
	</div>
<?php endif; ?>
        


<?php get_footer(); ?>