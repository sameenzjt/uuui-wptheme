<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'options-framework-theme';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __( 'One', 'uuui' ),
		'two' => __( 'Two', 'uuui' ),
		'three' => __( 'Three', 'uuui' ),
		'four' => __( 'Four', 'uuui' ),
		'five' => __( 'Five', 'uuui' )
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __( 'French Toast', 'uuui' ),
		'two' => __( 'Pancake', 'uuui' ),
		'three' => __( 'Omelette', 'uuui' ),
		'four' => __( 'Crepe', 'uuui' ),
		'five' => __( 'Waffle', 'uuui' )
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __( 'Basic Settings', 'uuui' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Input Text Mini', 'uuui' ),
		'desc' => __( '迷你文本输入字段。', 'uuui' ),
		'id' => 'example_text_mini',
		'std' => 'Default',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Input Text', 'uuui' ),
		'desc' => __( '文本输入字段。', 'uuui' ),
		'id' => 'example_text',
		'std' => 'Default Value',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( '用占位符输入', 'uuui' ),
		'desc' => __( '具有HTML5占位符的文本输入字段。', 'uuui' ),
		'id' => 'example_placeholder',
		'placeholder' => 'Placeholder',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Textarea', 'uuui' ),
		'desc' => __( '文字区域描述。', 'uuui' ),
		'id' => 'example_textarea',
		'std' => 'Default Text',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( 'Input Select Small', 'uuui' ),
		'desc' => __( '小选择框。', 'uuui' ),
		'id' => 'example_select',
		'std' => 'three',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $test_array
	);

	$options[] = array(
		'name' => __( 'Input Select Wide', 'uuui' ),
		'desc' => __( '宽的选择框。', 'uuui' ),
		'id' => 'example_select_wide',
		'std' => 'two',
		'type' => 'select',
		'options' => $test_array
	);

	if ( $options_categories ) {
		$options[] = array(
			'name' => __( '选择一个类别', 'uuui' ),
			'desc' => __( '通过cat_ID和cat_name传递了一个类别数组', 'uuui' ),
			'id' => 'example_select_categories',
			'type' => 'select',
			'options' => $options_categories
		);
	}

	if ( $options_tags ) {
		$options[] = array(
			'name' => __( '选择一个标签', 'options_check' ),
			'desc' => __( '传递了带有term_id和term_name的标签数组', 'options_check' ),
			'id' => 'example_select_tags',
			'type' => 'select',
			'options' => $options_tags
		);
	}

	$options[] = array(
		'name' => __( '选择一个页面', 'uuui' ),
		'desc' => __( '传递了具有ID和post_title的页面', 'uuui' ),
		'id' => 'example_select_pages',
		'type' => 'select',
		'options' => $options_pages
	);

	$options[] = array(
		'name' => __( 'Input Radio (one)', 'uuui' ),
		'desc' => __( '选择默认选项为“one”的单选按钮。', 'uuui' ),
		'id' => 'example_radio',
		'std' => 'one',
		'type' => 'radio',
		'options' => $test_array
	);

	$options[] = array(
		'name' => __( '示例信息', 'uuui' ),
		'desc' => __( '这只是您可以在面板中放入的一些示例信息。', 'uuui' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( '输入复选框', 'uuui' ),
		'desc' => __( '示例复选框，默认为true。', 'uuui' ),
		'id' => 'example_checkbox',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( 'Advanced Settings', 'uuui' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( '检查以显示隐藏的文本输入', 'uuui' ),
		'desc' => __( '单击此处，看看会发生什么。', 'uuui' ),
		'id' => 'example_showhidden',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => __( '隐藏文字输入', 'uuui' ),
		'desc' => __( '除非通过复选框单击激活，否则此选项是隐藏的。', 'uuui' ),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( '上传测试', 'uuui' ),
		'desc' => __( '这将创建一个完整尺寸的上传器，以预览图像。', 'uuui' ),
		'id' => 'example_uploader',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => "示例图像选择器",
		'desc' => "用于布局的图像。",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png'
		)
	);

	$options[] = array(
		'name' =>  __( '示例background', 'uuui' ),
		'desc' => __( '更改 background CSS', 'uuui' ),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background'
	);

	$options[] = array(
		'name' => __( '多重检查', 'uuui' ),
		'desc' => __( '多重检查说明。', 'uuui' ),
		'id' => 'example_multicheck',
		'std' => $multicheck_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $multicheck_array
	);

	$options[] = array(
		'name' => __( '选色器', 'uuui' ),
		'desc' => __( '默认未选择颜色。', 'uuui' ),
		'id' => 'example_colorpicker',
		'std' => '',
		'type' => 'color'
	);

	$options[] = array( 
		'name' => __( '排版', 'uuui' ),
		'desc' => __( '排版示例。', 'uuui' ),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography'
	);

	$options[] = array(
		'name' => __( '自定义字体', 'uuui' ),
		'desc' => __( '自定义排版选项。', 'uuui' ),
		'id' => "custom_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options
	);

	$options[] = array(
		'name' => __( 'Text Editor', 'uuui' ),
		'type' => 'heading'
	);

	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress,wplink' )
	);

	$options[] = array(
		'name' => __( '默认文本编辑器', 'uuui' ),
		'desc' => sprintf( __( '您也可以将设置传递给编辑器。 在<a href="%1$s" target="_blank"> WordPress Codex </a>中了解有关wp_editor的更多信息。', 'uuui' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);

/* —— 基本设置 —— */
	$options[] = array(
		'name' => __( '基本设置', 'uuui' ),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' => __( '工信部备案号', 'uuui' ),
		'desc' => __( '鲁ICP备19008202号', 'uuui' ),
		'id' => 'icp-bei',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '公网安备', 'uuui' ),
		'desc' => __( '鲁公网安备 37021102000826号', 'uuui' ),
		'id' => 'gongwang-bei',
		'type' => 'text'
	);
	$options[] = array(
		'name' => __( '微信二维码', 'uuui' ),
		'desc' => __( '支持外链，亦可上传微信公众号二维码', 'uuui' ),
		'id' => 'weixin_qr_uploader',
		'type' => 'upload'
	);
	$options[] = array(
		'name' => __( '微博二维码', 'uuui' ),
		'desc' => __( '支持外链', 'uuui' ),
		'id' => 'weibo_qr_uploader',
		'type' => 'upload'
	);
	$options[] = array(
		'name' => __( '头条二维码', 'uuui' ),
		'desc' => __( '支持外链', 'uuui' ),
		'id' => 'toutiao_qr_uploader',
		'type' => 'upload'
	);


/* —— 首页设置 —— */
	$options[] = array(
		'name' => __( '首页设置', 'uuui' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __( '选择全部文章页面', 'uuui' ),
		'desc' => __( '需要先发布页面，页面模板选择“全部文章”', 'uuui' ),
		'id' => 'select_pages_allposts',
		'type' => 'select',
		'options' => $options_pages
	);

	$options[] = array(
		'name' => __( '选择全部专题页面', 'uuui' ),
		'desc' => __( '需要先发布页面，页面模板选择“全部专题”', 'uuui' ),
		'id' => 'select_pages_allthematic',
		'type' => 'select',
		'options' => $options_pages
	);
	if ( $options_categories ) {
		$options[] = array(
			'name' => __( '首页专题栏目', 'uuui' ),
			'desc' => __( '第一个专题', 'uuui' ),
			'id' => 'index_thematic_1',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $options_categories
		);
		$options[] = array(
			'desc' => __( '第二个专题', 'uuui' ),
			'id' => 'index_thematic_2',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $options_categories
		);
		$options[] = array(
			'desc' => __( '第三个专题', 'uuui' ),
			'id' => 'index_thematic_3',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $options_categories
		);
		$options[] = array(
			'desc' => __( '第四个专题', 'uuui' ),
			'id' => 'index_thematic_4',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $options_categories
		);
	}
	
/* —— 页首页脚设置 —— */
	$options[] = array(
		'name' => __( '页首页脚设置', 'uuui' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __( '关于我们', 'uuui' ),
		'desc' => __( '页脚', 'uuui' ),
		'id' => 'footer-about-us',
		'std' => '',
		'type' => 'textarea'
	);
	




	return $options;
}