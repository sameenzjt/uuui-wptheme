<?php get_header(); ?>
<div class="row">
	<div class="col-12">
		<?php if(function_exists('cmp_breadcrumbs')) cmp_breadcrumbs();?>
	</div>
	<div class="col-lg-12 col-sm-12 text-center" style="margin-bottom: 40px;">
		<h2 style="font-weight: 600; margin: 20px 0px;"><?php the_title(); ?></h2>
		<div class="dropdown-divider"></div>
	</div>

	<div class="col-lg-2 hide-768">
		
	</div>

	<div class="col-lg-8 col-sm-12">
		<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

			 <div class="page-content" >
				<?php the_content(); ?> 
			</div>

		<?php else : ?>
			<div class="grid_8">
				没有找到你想要的页面！
			</div>
		<?php endif; ?>
	</div>

	<div class="col-lg-2 hide-768px">
	</div>
        


<?php get_footer(); ?>