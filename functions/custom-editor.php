<?php

//关闭 wptexturize 功能避免符号被转换
add_filter( 'run_wptexturize', '__return_false' );

/**
  *WordPress 自定义文章编辑器的样式
  *自定义 CSS 文件
  *http://www.endskin.com/editor-style/
*/
function Bing_add_editor_style(){
    add_editor_style( 'https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css' );//引入外部的 CSS 文件
    add_editor_style( get_stylesheet_directory_uri() . '/res/css/custom-editor-style.css?ver=' . wp_get_theme()->get('Version') );//这样就会调用主题目录 CSS 文件夹的 custom-editor-style.css 文件
}
add_action( 'after_setup_theme', 'Bing_add_editor_style' );


//编辑器添加按钮
    function appthemes_add_quicktags() {
        ?>
        <script type="text/javascript">
            QTags.addButton( '键盘输入元素', '键盘输入元素', '<kbd>', '</kbd>' ); 
            QTags.addButton( '引用', '引用', '<blockquote class="blockquote">', '</blockquote>' );
            QTags.addButton( '引用来源', '引用来源', '<footer class="blockquote-footer">', '</footer>' );
            QTags.addButton( '首字母大写', '首字母大写', '<span class="text-capitalize">', '</span>' );
            QTags.addButton( '高亮', '高亮', '<mark>', '</mark>' ); 
        </script>
        <?php
        }
    add_action('admin_print_footer_scripts', 'appthemes_add_quicktags' );

/** —— TinyMCE编辑器增强 —— */
    function add_editor_buttons($buttons) {
        $buttons[] = 'fontselect';//字体选择
        $buttons[] = 'fontsizeselect';//字号选择
        $buttons[] = 'cleanup';//清除冗余代码
        $buttons[] = 'styleselect';//样式选择
        $buttons[] = 'hr';//水平线
        $buttons[] = 'del';
        $buttons[] = 'sub';//上标
        $buttons[] = 'sup';//下标
        //$buttons[] = 'copy';//复制
        //$buttons[] = 'paste';//粘贴
        //$buttons[] = 'cut';//剪切
        $buttons[] = 'undo';//撤销
        $buttons[] = 'image';//插入图片
        $buttons[] = 'anchor';//锚文本
        $buttons[] = 'backcolor';//字体背景色
        $buttons[] = 'wp_page';//插入分页标签
        $buttons[] = 'charmap';//特殊符号
        $buttons[] = 'spellchecker';//拼写检查
        return $buttons;
    }
    add_filter("mce_buttons_3", "add_editor_buttons"); 

    //为TinyMCE增加中文字体
    function custum_fontfamily($initArray){
        $initArray['font_formats'] = "微软雅黑='微软雅黑';宋体='宋体';黑体='黑体';仿宋='仿宋';楷体='楷体';隶书='隶书';幼圆='幼圆';";
        return $initArray;
    }
    add_filter('tiny_mce_before_init', 'custum_fontfamily');
/** —— TinyMCE编辑器增强 —— 结束*/


/** 后台编辑器添加下拉式按钮 */ 
function QGG_select(){
	echo '
	<select id="short_code_select">
		<option value="请选择一个短代码！！！">插入短代码</option>
        <option value="[fa_insert_post ids=文章id,文章id][/fa_insert_post]">引用站内文章</option>
        <option value="[video_bilibili]src[/video_bilibili]">哔哩哔哩视频</option>
		
	</select>';
	}
	if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
		add_action('media_buttons', 'QGG_select', 11);
	}
	
	function QGG_button() {
	echo '<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#short_code_select").change(function(){
				send_to_editor(jQuery("#short_code_select :selected").val());
				return false;
			});
		});
	</script>';
	}
	add_action('admin_head', 'QGG_button');
/** 后台编辑器添加下拉式按钮 —— 结束 */ 


/** —— 文章编辑页将作者模块移到发布模块内 ——*/
add_action( 'admin_menu', 'remove_author_metabox' );
add_action( 'post_submitbox_misc_actions', 'move_author_to_publish_metabox' );
function remove_author_metabox() {
    remove_meta_box( 'authordiv', 'post', 'normal' );
}
function move_author_to_publish_metabox() {
    global $post_ID;
    $post = get_post( $post_ID );
    echo '<div id="author" class="misc-pub-section" style="border-top-style:solid; border-top-width:1px; border-top-color:#EEEEEE; border-bottom-width:0px;">作者： ';
    post_author_meta_box( $post );
    echo '</div>';
}
/** —— 文章编辑页将作者模块移到发布模块内 —— 结束*/



?>