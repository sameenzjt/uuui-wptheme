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
	$options_pages[''] = __( 'Select a page:', 'uuui' );
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

	


/* —— 基本设置 —— */
	$options[] = array(
		'name' => __( '基本设置', 'uuui' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( '网站导航栏Logo', 'uuui' ),
		'desc' => __( '上传图片则使用图片作为Logo，不填写则默认使用网站标题作为Logo（设置——常规——标题）。图片高度建议60px。', 'uuui' ),
		'id' => 'site_logo',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( '网站描述', 'uuui' ),
		'desc' => __( '网站描述description，有利于SEO。', 'uuui' ),
		'id' => 'website_description',
		'type' => 'textarea',
	);

	$options[] = array(
		'name' => __( '网站关键词', 'uuui' ),
		'desc' => __( '网站关键词keywords，有利于SEO。关键词之间用半角(英文)逗号分隔', 'uuui' ),
		'id' => 'website-keywords',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'QQ群链接', 'uuui' ),
		'desc' => __( '获取方式：打开群聊天窗口——群聊设置(右上角三条杠)——更多(右上角三个点)——分享群聊——复制链接', 'uuui' ),
		'id' => 'qq-qun',
		'type' => 'text',
		'class' => 'small'
	);

	$options[] = array(
		'name' => __( '网站备案信息', 'uuui' ),
		'desc' => __( '工信部备案号，例：X ICP备XXXXXX号', 'uuui' ),
		'id' => 'icp-bei',
		'type' => 'text',
		'class' => 'mini'
	);

	$options[] = array(
		'desc' => __( '公网安备，例：X 公网安备 XXXXXX号', 'uuui' ),
		'id' => 'gongwang-bei',
		'type' => 'text',
		'class' => 'small'
	);

	$options[] = array(
		'name' => __( '404标题', 'uuui' ),
		'desc' => __( '404页面的标题', 'uuui' ),
		'std' => '404 页面未找到！',
		'id' => '404_title',
		'type' => 'text',
		'class' => 'mini',
	);

	$options[] = array(
			'name' => __( '404描述', 'uuui' ),
			'desc' => __( '404页面中描述，可以向用户提示发生了什么', 'uuui' ),
			'std' => '没有找到该页面，可能是以下情况：<br />1、检查网址石佛偶争取',
			'id' => '404_description',
			'type' => 'textarea',
		);


/* —— 首页设置 —— */
	$options[] = array(
		'name' => __( '首页设置', 'uuui' ),
		'type' => 'heading'
	);

	
	$options[] = array(
		'name' => __( '必备网站栏目', 'uuui' ),
		'desc' => __( '示例：&lt;a href="此处填写链接" target="_blank"&gt;此处填写名称&lt;/a&gt;', 'uuui' ),
		'std' => '<a href="https://sameen.art" target="_blank">sameen.art</a>',
		'id' => 'designer-must-have',
		'type' => 'textarea'
	);

	if ( $options_categories ) {
		$options[] = array(
			'name' => __( '选择“软件教程”分类', 'uuui' ),
			'desc' => __( 'Ps分类', 'uuui' ),
			'id' => 'categories_ps',
			'type' => 'select',
			'class' => 'mini',
			'options' => $options_categories
		);
	}

	if ( $options_categories ) {
		$options[] = array(
			'desc' => __( 'Ai分类', 'uuui' ),
			'id' => 'categories_ai',
			'type' => 'select',
			'class' => 'mini',
			'options' => $options_categories
		);
	}
	
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

	$options[] = array(
		'name' => __( '首页侧边栏banner', 'uuui' ),
		'id' => 'index_sidebar_banner',
		'desc' => __( '填写banner图片链接', 'uuui' ),
		'placeholder' => 'banner图片链接',
		'type' => 'text'
	);
	$options[] = array(
		'id' => 'index_sidebar_banner_link',
		'desc' => __( '填写banner跳转链接', 'uuui' ),
		'placeholder' => 'banner跳转链接',
		'type' => 'text'
	);

	
/* —— 页面选择 —— */
	$options[] = array(
		'name' => __( '页面选择', 'uuui' ),
		'type' => 'heading'
	);

		$options[] = array(
			'name' => __( '全部专题', 'uuui' ),
			'desc' => __( '请先发布页面：标题自定，页面模板择“全部专题”', 'uuui' ),
			'id' => 'select_pages_allthematic',
			'class' => 'mini',
			'type' => 'select',
			'options' => $options_pages
		);
	

/* —— 页首页脚设置 —— */
	$options[] = array(
		'name' => __( '页首页脚', 'uuui' ),
		'type' => 'heading'
	);
		$options[] = array(
			'name' => __( '页脚——关于我们', 'uuui' ),
			'desc' => __( '页面页脚左侧关于我们', 'uuui' ),
			'id' => 'footer-about-us',
			'std' => '',
			'type' => 'textarea'
		);
	
		$options[] = array(
			'name' => __( '页脚导航标题', 'uuui' ),
			'desc' => __( '页脚第一列导航', 'uuui' ),
			'id' => 'footer_menu_1_title',
			'class' => 'mini',
			'type' => 'text'
		);
		$options[] = array(
			'desc' => __( '页脚第二列导航', 'uuui' ),
			'id' => 'footer_menu_2_title',
			'class' => 'mini',
			'type' => 'text'
		);
		$options[] = array(
			'desc' => __( '页脚第三列导航', 'uuui' ),
			'id' => 'footer_menu_3_title',
			'class' => 'mini',
			'type' => 'text'
		);

		$options[] = array(
			'name' => __( '页脚二维码', 'uuui' ),
			'desc' => __( '微信二维码，支持外链', 'uuui' ),
			'id' => 'weixin_qr_uploader',
			'type' => 'upload'
		);
		$options[] = array(
			'desc' => __( '微博二维码，支持外链', 'uuui' ),
			'id' => 'weibo_qr_uploader',
			'type' => 'upload'
		);
		$options[] = array(
			'desc' => __( '头条二维码，支持外链', 'uuui' ),
			'id' => 'toutiao_qr_uploader',
			'type' => 'upload'
		);



/* —— 样式 —— */
$options[] = array(
	'name' => __( '样式', 'uuui' ),
	'type' => 'heading'
);

	$options[] = array(
		'name' => __( '自定义样式', 'uuui' ),
		'desc' => __( '添加自定义的style，直接填写css选择器，无需额外添加&lt;style&gt;', 'uuui' ),
		'id' => 'header_style',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'desc' => __( '例如输入：#menu-box {background: #56bbdc;} 将固定的导航背景改为蓝色
		<br>全局变灰：html{overflow-y:scroll;filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(100%);}', 'uuui' ),
		'type' => 'info'
	);
	


/* —— 高级选项 —— */
$options[] = array(
	'name' => __( '高级选项', 'uuui' ),
	'type' => 'heading'
);

	$options[] = array(
		'name' => __( '网站SEO', 'uuui' ),
		'desc' => __( '主题自带SEO功能，如已启用第三方SEO插件，请不要勾选此选项。', 'uuui' ),
		'id' => 'site-seo',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'desc' => __( '主题自带SEO功能包括：网页关键字、网页描述、网页标题', 'uuui' ),
		'type' => 'info'
	);


	$options[] = array(
		'name' => __( 'Web 应用的名称', 'uuui' ),
		'desc' => __( '仅当网站被用作为一个应用时才使用', 'uuui' ),
		'id' => 'application-name',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( '站点验证(使用第三方服务验证站点所有权)', 'uuui' ),
		'desc' => __( '支持的验证服务：<a href="https://www.google.com/webmasters/tools/">Google Search Console</a>、<a href="https://www.bing.com/webmaster/">Bing Webmaster Center</a>。<br><br>要使用这些高级搜索引擎工具并使用某服务验证您的站点，请将 HTML 标签代码复制粘贴到以下相应位置。', 'uuui' ),
		'type' => 'info'
	);
	$options[] = array(
		'desc' => __( 'Google Search Console', 'uuui' ),
		'placeholder' => '<mate name="google-site-verification" content="1234">',
		'id' => 'google-search-console',
		'type' => 'text',
		'class' => 'small'
	);
	$options[] = array(
		'desc' => __( 'Bing Webmaster Center', 'uuui' ),
		'placeholder' => '<mate name="msvalidate" content="1234">',
		'id' => 'bing-webmaster-center',
		'type' => 'text',
		'class' => 'small'
	);

	
	


/* —— 广告位 —— */
$options[] = array(
	'name' => __( '广告位', 'uuui' ),
	'type' => 'heading'
);
	$options[] = array(
		'name' => __( '声明', 'uuui' ),
		'desc' => __( '主题仅提供广告插入位置，任何由此产生的商业行为均与本主题无关。', 'uuui' ),
		'type' => 'info'
	);

	$options[] = array(
		'name' => __( '正文底部', 'uuui' ),
		'desc' => __( '正文底部广告', 'uuui' ),
		'id' => 'text-bottom-ads',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => __( '正文顶部', 'uuui' ),
		'desc' => __( '正文顶部广告', 'uuui' ),
		'id' => 'text-top-ads',
		'std' => '',
		'type' => 'textarea'
	);



/* —— 支持 —— */
$options[] = array(
	'name' => __( '支持', 'uuui' ),
	'type' => 'heading'
);
	$options[] = array(
		'name' => __( '我们用到的技术', 'uuui' ),
		'desc' => __( '本主题所使用的所有文件', 'uuui' ),
		'type' => 'info'
	);
	$options[] = array(
		'desc' => __( '<a href="https://www.staticfile.org/">Staticfile CDN<a>：免费、快速、开放的 CDN 服务', 'uuui' ),
		'type' => 'info',
	);
	$options[] = array(
		'desc' => __( '<a href="https://getbootstrap.com/">Bootstrap 4<a>：全球最受欢迎的前端组件库', 'uuui' ),
		'type' => 'info',
	);
	$options[] = array(
		'desc' => __( '<a href="https://fontawesome.com/">FontAwesome<a>：网络上最受欢迎的图标集和工具包', 'uuui' ),
		'type' => 'info',
	);
	$options[] = array(
		'desc' => __( '<a href="https://github.com/hustcc/placeholder.js">placeholder.js<a>：<1Kb的Javascript库，可在客户端生成图像占位符', 'uuui' ),
		'type' => 'info',
	);
	$options[] = array(
		'desc' => __( '<a href="https://jquery.com/">jquery<a>：一个快速、小型且功能丰富的 JavaScript 库', 'uuui' ),
		'type' => 'info',
	);






	return $options;

}