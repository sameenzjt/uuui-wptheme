<?php
/**
 * 创建自定义文章类型dashicons-admin-links
 */

add_action('init', 'my_custom_init');
function my_custom_init()
{
	$labels = array(
		'name' => '导航',	//文章类型的名称，这个可以用中文
		'singular_name' => '导航',	//单篇文章对象的名称
		'add_new' => '添加导航网址',	//对应于默认文章类型中的“写文章”
		'add_new_item' => '新建一个导航网址',
		'edit_item' => '编辑导航网址',	//编辑
		'new_item' => 'new_item',
		'view_item' => 'view_item',
		'search_items' => '搜索',
		'not_found' =>  '没有找到',
		'not_found_in_trash' => 'not_found_in_trash',  
		'parent_item_colon' => '',
		'menu_name' => '导航'
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
	register_post_type('links',$args);
}
/**
 * 创建自定义文章类型 —— 结束
 */



/**
 * 自定义文章类型分类
 */
function uuui_website_links() {
	$labels = array(
	'name' => _x( '网址分类', 'taxonomy 名称' ),
	'singular_name' => _x( '网址分类', 'taxonomy 单数名称' ),
	'search_items' => __( '搜索网址分类' ),
	'all_items' => __( '所有网址分类' ),
	'parent_item' => __( '该网址分类的上级分类' ),
	'parent_item_colon' => __( '该网址分类的上级分类：' ),
	'edit_item' => __( '编辑网址分类' ),
	'update_item' => __( '更新网址分类' ),
	'add_new_item' => __( '添加新的网址分类' ),
	'new_item_name' => __( '新网址分类' ),
	'menu_name' => __( '网址分类' ),
	);
	$args = array(
	'labels' => $labels,
	'hierarchical' => true,
	);
	register_taxonomy( 'links_cat', 'links', $args );
	}
	add_action( 'init', 'uuui_website_links', 0 );
/**
 * 自定义文章类型分类 —— 结束
 */




 /**
 * 自定义文章类型后台文章列表新增栏目
 */
add_filter('manage_links_posts_columns','add_new_links_columns');   
 
function add_new_links_columns($links_columns) {   
       
    $new_columns['cb'] = '<input type="checkbox" />';//这个是前面那个选框，不要丢了   
  
	$new_columns['title'] = '网站'; 
	$new_columns['id'] = __('ID');
	$new_columns['url'] = 'URL'; 
    
    $new_columns['date'] = _x('Date', 'column name');   
  
    //直接返回一个新的数组   
    return $new_columns;   
}  

add_action('manage_links_posts_custom_column', 'manage_links_columns', 10, 2);   
    
function manage_links_columns($column_name, $id) {   
    global $wpdb; 
    switch ($column_name) {
    case 'id':
        echo $id;  
	break;
    
    case 'url':     
        $url = get_field('url');   
        echo $url;  
	break;

	

    default: 
break; 
    }   
}  

/**
 * 自定义文章类型后台文章列表新增栏目 —— 结束
 */






















?>