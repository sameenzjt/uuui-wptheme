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

	// Test data
	$replace_comments = array(
		'replace_when_comments_are_displayed' => __( '评论显示时替换(推荐)', 'uuui' ),
		'replace_when_comments_are_added' => __( '评论添加时替换', 'uuui' ),
		'do_not_replace_comments' => __( '不替换评论', 'uuui' )
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
	$options_pages[''] = __( '请选择一个页面', 'uuui' );
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();
/*
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
*/
	


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
		'desc' => __( '<strong>网站描述description，最好是25到160个字符之间。</strong>搜索引擎只显示该说明在搜索结果页中的前150-160个字符，因此如果说明过长，搜索者可能无法看到所有文本；如果说明过短，搜索引擎可能会添加页面其他位置找到的文本内容。', 'uuui' ),
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
		'desc' => __( '<strong>注意：不是QQ群号！</strong>链接获取方式：打开群聊聊天窗口——群聊设置(右上角)——更多(右上角)——分享群聊——复制链接。', 'uuui' ),
		'placeholder' => __( 'ex：https://jq.qq.com/?_wv=1234&k=5A6B7C8', 'uuui' ),
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
		'class' => 'mini'
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
	
	if ( $options_categories ) {
		$options[] = array(
			'name' => __( '首页专题栏目', 'uuui' ),
			'desc' => __( '专题一', 'uuui' ),
			'id' => 'index_thematic_1',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $options_categories
		);
		$options[] = array(
			'desc' => __( '专题二', 'uuui' ),
			'id' => 'index_thematic_2',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $options_categories
		);
		$options[] = array(
			'desc' => __( '专题三', 'uuui' ),
			'id' => 'index_thematic_3',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $options_categories
		);
		$options[] = array(
			'desc' => __( '专题四', 'uuui' ),
			'id' => 'index_thematic_4',
			'type' => 'select',
			'class' => 'mini', //mini, tiny, small
			'options' => $options_categories
		);
	}


	
/* —— 页面选择 —— */
	$options[] = array(
		'name' => __( '页面选择', 'uuui' ),
		'type' => 'heading'
	);

		$options[] = array(
			'name' => __( '全部分类(专题)', 'uuui' ),
			'desc' => __( '请先发布页面。页面--新建页面--模板选择“全部专题”(有多个可选择任意一个)。', 'uuui' ),
			'id' => 'select_pages_allthematic',
			'type' => 'select',
			'options' => $options_pages
		);
		$options[] = array(
			'name' => __( '全部文章', 'uuui' ),
			'desc' => __( '请先发布页面。页面--新建页面--模板选择“全部文章”(有多个可选择任意一个)。', 'uuui' ),
			'id' => 'index-look-all-post',
			'type' => 'select',
			'options' => $options_pages
		);
		$options[] = array(
			'name' => __( '全部标签', 'uuui' ),
			'desc' => __( '请先发布页面。页面--新建页面--模板选择“标签”(有多个可选择任意一个)。', 'uuui' ),
			'id' => 'select-all-tags',
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
			'desc' => __( '页脚导航左', 'uuui' ),
			'id' => 'footer_menu_1_title',
			'class' => 'mini',
			'type' => 'text'
		);
		$options[] = array(
			'desc' => __( '页脚导航中', 'uuui' ),
			'id' => 'footer_menu_2_title',
			'class' => 'mini',
			'type' => 'text'
		);
		$options[] = array(
			'desc' => __( '页脚导航右', 'uuui' ),
			'id' => 'footer_menu_3_title',
			'class' => 'mini',
			'type' => 'text'
		);

		$options[] = array(
			'name' => __( '页脚二维码', 'uuui' ),
			'desc' => __( '用于生成二维码，需要微信网址(具体方式请百度)', 'uuui' ),
			'id' => 'weixin_qr_uploader',
			'type' => 'text'
		);
		$options[] = array(
			'desc' => __( '微博用户地址', 'uuui' ),
			'placeholder' => 'https://weibo.com/u/6027243059',
			'id' => 'weibo_link',
			'type' => 'text'
		);
		$options[] = array(
			'desc' => __( '头条用户地址', 'uuui' ),
			'placeholder' => 'https://www.toutiao.com/c/user/52511973021/#mid=1646246823879692',
			'id' => 'toutiao_link',
			'type' => 'text'
		);



/* —— 样式 —— */
$options[] = array(
	'name' => __( '样式', 'uuui' ),
	'type' => 'heading'
);

	$options[] = array(
		'name' => __( '主题色', 'uuui' ),
		'desc' => __( '主题色', 'uuui' ),
		'id' => 'main_color',
		'std' => '#ff5722',
		'type' => 'color'
	);
	$options[] = array(
		'name' => __( '深主题色', 'uuui' ),
		'desc' => __( '深主题色', 'uuui' ),
		'id' => 'deep_main_color',
		'std' => '#E64A19',
		'type' => 'color'
	);
	$options[] = array(
		'name' => __( '主要文字颜色', 'uuui' ),
		'desc' => __( '主要文字颜色', 'uuui' ),
		'id' => 'primary_text_color',
		'std' => '#404040',
		'type' => 'color'
	);
	$options[] = array(
		'name' => __( '辅助文字颜色', 'uuui' ),
		'desc' => __( '辅助文字颜色', 'uuui' ),
		'id' => 'secondary_text_color',
		'std' => '#757575',
		'type' => 'color'
	);

	$options[] = array(
		'name' => __( '额外CSS', 'uuui' ),
		'desc' => __( '请转到“外观--自定义--额外CSS”。<br />
		全局变灰：html{overflow-y:scroll;filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(100%);}
		', 'uuui' ),
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
		'name' => __( '评论敏感词自动替换', 'uuui' ),
		'desc' => __( '自动将敏感字词替换', 'uuui' ),
		'id' => 'replace_comments',
		'std' => 'replace_when_comments_are_displayed',
		'type' => 'radio',
		'options' => $replace_comments
	);
	$options[] = array(
		'desc' => __( '<strong>评论显示时替换</strong>：此方法不会更改评论的原始内容，只会在评论显示给访客时替换相应的关键字(后台“评论”中也是显示替换后的内容，需要点击“编辑”按钮才能看到原始内容)，保存在数据库中的仍然是评论的原文；<br /><strong>评论添加时替换</strong>：此方法将直接替换访客发布的评论内容，数据库中存储的评论就是替换后的内容；<br /><strong>自定义替换规则</strong>：请修改主题文件夹中“functions/prohibited-words.txt”文件，注意格式为“关键字A->替换A || 关键字B->替换B || 关键字C->替换C”，以此类推 ', 'uuui' ),
		'type' => 'info'
	);
	
	$options[] = array(
		'name' => __( 'Web应用的名称', 'uuui' ),
		'desc' => __( '仅当网站被用作为一个应用安装时才使用，详情：<a href="https://www.ithome.com/0/459/353.htm">PWA应用</a>', 'uuui'),
		'id' => 'application-name',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Web应用的标签条颜色', 'uuui' ),
		'desc' => __( '仅当网站被用作为一个应用安装时才使用，详情：<a href="https://www.ithome.com/0/471/471.htm">PWA应用</a>', 'uuui' ),
		'id' => 'application-color',
		'std' => '#ff5722',
		'type' => 'color'
	);


/* —— 广告与统计 —— */
$options[] = array(
	'name' => __( '广告与统计', 'uuui' ),
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

	$options[] = array(
		'name' => __( '百度新版统计代码', 'uuui' ),
		'desc' => __( '只输入https://hm.baidu.com/hm.js?后面的一串数字加英文的代码,无需标点符号', 'uuui' ),
		'id' => 'baidu-tongji',
		'placeholder' => '例：35104048fed03ae09d6c1abdc6a583a3',
		'type' => 'text'
	);

	
	$options[] = array(
		'name' => __( '站点验证(使用第三方服务验证站点所有权)', 'uuui' ),
		'desc' => __( '支持的验证服务：<a href="https://www.google.com/webmasters/tools/">Google Search Console</a>、<a href="https://www.bing.com/webmaster/">Bing Webmaster Center</a>。<br><br>要使用这些高级搜索引擎工具并使用某服务验证您的站点，请将 HTML 标签代码复制粘贴到以下相应位置。', 'uuui' ),
		'type' => 'info'
	);
	$options[] = array(
		'name' => __('Google Search Console', 'uuui'),
		'desc' => __( '例：只填写content="后面的一串代码', 'uuui' ),
		'placeholder' => 'x2tkVvAqhT0Y0uBjCh5ARHNSHdxAeD6dzgBjCXb3I',
		'id' => 'google-search-console',
		'type' => 'text',
		'class' => 'small'
	);
	$options[] = array(
		'name' => __('必应Bing网站管理员工具'),
		'desc' => __( 'Bing Webmaster Center（必应Bing网站管理员工具）', 'uuui' ),
		'placeholder' => '<mate name="msvalidate" content="1234">',
		'id' => 'bing-webmaster-center',
		'type' => 'text',
		'class' => 'small'
	);


/* —— 支持 —— */
$options[] = array(
	'name' => __( '支持', 'uuui' ),
	'type' => 'heading'
);
	$options[] = array(
		'desc' => '<a href="https://www.staticfile.org/"><img src="https://img.shields.io/badge/cdn-Staticfile CDN-yellow.svg" alt="Staticfile CDN"><a>
						<a href="https://getbootstrap.com/"><img src="https://img.shields.io/badge/css-Bootstrap 4-green.svg" alt="Bootstrap 4"><a>
						<a href="https://fontawesome.com"><img src="https://img.shields.io/badge/icon-FontAwesome-green.svg" alt="FontAwesome"></a>
						<a href="https://jquery.com"><img src="https://img.shields.io/badge/js-jquery-blue.svg" alt="jquery"></a>',
		'type' => 'info'
	);



	return $options;

}