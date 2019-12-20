<?php
/**
 * 创建自定义文章类型dashicons-admin-links
 */

add_action('init', 'my_custom_init');
function my_custom_init()
{
	$labels = array(
		'name' => '网址',	//文章类型的名称，这个可以用中文
		'singular_name' => '网址',	//单篇文章对象的名称
		'add_new' => '添加网址',	//对应于默认文章类型中的“写文章”
		'add_new_item' => '新建一个网址',
		'edit_item' => '编辑网址',	//编辑
		'new_item' => 'new_item',
		'view_item' => 'view_item',
		'search_items' => '搜索',
		'not_found' =>  '没有找到',
		'not_found_in_trash' => 'not_found_in_trash',  
		'parent_item_colon' => '',
		'menu_name' => '设计导航'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,	//是否生成一个默认的管理页面
		'show_in_menu' => true,	//是否在后台菜单项中显示
		'menu_position' => 3,
		'menu_icon' => 'dashicons-admin-links',	//菜单的icon图标
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',	//查看、编辑、删除的能力类型(capability)
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array(	//对文章类型的一些功能支持
			'title',//标题
			'excerpt',//摘要
			)
	);
	register_post_type('book',$args);
}


/**
 * 创建自定义文章类型 —— 结束
 */





























?>