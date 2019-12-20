<?php
/**
 * 创建自定义文章类型
 */

add_action('init', 'my_custom_init');
function my_custom_init()
{
$labels = array(
'name' => '影片',
'singular_name' => 'movie',
'add_new' => '发表影片',
'add_new_item' => '发表一个新影片',
'edit_item' => '编辑影片',
'new_item' => '新影片',
'all_items' => '所有影片',
'view_item' => '查看影片',
'search_items' => '搜索影片',
'not_found' => '没有找到相关影片',
'not_found_in_trash' => '回收间中没有相关影片',
'parent_item_colon' => '',
'menu_name' => '影片'

);
$args = array(
'labels' => $labels,
'public' => true,
'publicly_queryable' => true,
'show_ui' => true,
'show_in_menu' => true,
'query_var' => true,
'rewrite' => true,
'capability_type' => 'post',
'has_archive' => true,
'hierarchical' => false,
'menu_position' => 5,
'supports' => array('title','author','thumbnail','excerpt','comments')
);
register_post_type('movie',$args);
}

//自定义文章分类
function my_taxonomies_shop() {
	$labels = array(
	'name' => _x( '影片分类', 'taxonomy 名称' ),
	'singular_name' => _x( '影片分类', 'taxonomy 单数名称' ),
	'search_items' => __( '搜索影片分类' ),
	'all_items' => __( '所有影片分类' ),
	'parent_item' => __( '该影片分类的上级分类' ),
	'parent_item_colon' => __( '该影片分类的上级分类：' ),
	'edit_item' => __( '编辑影片分类' ),
	'update_item' => __( '更新影片分类' ),
	'add_new_item' => __( '添加新的影片分类' ),
	'new_item_name' => __( '新影片分类' ),
	'menu_name' => __( '影片分类' ),
	);
	$args = array(
	'labels' => $labels,
	'hierarchical' => true,
	);
	register_taxonomy( 'shop', 'movie', $args );
	}
	add_action( 'init', 'my_taxonomies_shop', 0 );
/**
 * 创建自定义文章类型 —— 结束
 */
?>