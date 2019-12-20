<?php
/*
Template Name: 资源导航
Template author: boke8.net
*/
?>

<?php get_header(); ?>


<div id="header">
	<div class="title">建站资源网站收藏目录 - BOKE8.NET</div>
</div>
<div id="bar">
	<div class="notice">
		<div class="logo"><a href="<?php the_permalink() ?>">首页</a></div>
		<div class="des">博客吧日常学习使用资源网站收藏平台，收集常用资源网站！注意：以下资源使用过程中产生的问题，本站概不负责！
		</div>
		<div class="back">
			<li><a href="<?php bloginfo('url');?>">返回主站</a></li>
		</div>
	</div>
</div>
<div id="container">	
	<?php //By boke8.net
		wp_list_bookmarks('show_description=0&show_name=1&show_images=1&title_li=&categorize=1&category_before=<div class="box">&category_after=</div>&category_orderby=id&orderby=rand&title_before=<h3><span>&title_after=</span></h3>&limit=13'); 
	?>	
</div>



<?php get_footer(); ?>