<?php
/**
 * Template Name: 用户中心
 */
?>
<?php if ( get_the_author_meta( 'qq' ) ){
	echo "作者QQ：".get_the_author_meta( 'qq' );
}?>
<?php the_author_meta('email') ?>
风格非官方