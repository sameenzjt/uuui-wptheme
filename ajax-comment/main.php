<?php
define('AC_VERSION','1.0.0');

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	wp_die('请升级到4.4以上版本');
}

if(!function_exists('fa_ajax_comment_scripts')) :

    function fa_ajax_comment_scripts(){
        wp_enqueue_script( 'ajax-comment', get_template_directory_uri() . '/ajax-comment/app.js', array('jquery_js'), AC_VERSION , true );
        wp_localize_script( 'ajax-comment', 'ajaxcomment', array(
            'ajax_url'   => admin_url('admin-ajax.php'),
            'order' => get_option('comment_order'),
            'formpostion' => 'top', //默认为bottom，如果你的表单在顶部则设置为top。
        ) );
    }

endif;

if(!function_exists('fa_ajax_comment_err')) :

    function fa_ajax_comment_err($a) {
        header('HTTP/1.0 500 Internal Server Error');
        header('Content-Type: text/plain;charset=UTF-8');
        echo $a;
        exit;
    }

endif;

if(!function_exists('fa_ajax_comment_callback')) :

    function fa_ajax_comment_callback(){
        $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
        if ( is_wp_error( $comment ) ) {
            $data = $comment->get_error_data();
            if ( ! empty( $data ) ) {
            	fa_ajax_comment_err($comment->get_error_message());
            } else {
                exit;
            }
        }
        $user = wp_get_current_user();
        do_action('set_comment_cookies', $comment, $user);
        $GLOBALS['comment'] = $comment; //根据你的评论结构自行修改，如使用默认主题则无需修改
        ?>
        <li <?php comment_class('media border p-3'); ?> id="li-comment-<?php comment_ID(); ?>">
			
			<?php $comment_author = get_comment_author_link() ;
			$comment_avatar = array(
				'class' => 'mr-3 mt-3 align-self-start',
			); ?>
			<?php echo get_avatar( $comment, $size = '56', '', $comment_author, $comment_avatar )?>
				
			<?php if ( '0' == $comment->comment_approved ) : // 未审核的评论显示一行提示文字 ?>
				<p class="comment-awaiting-moderation">
				<?php _e( 'Your comment is awaiting moderation.', 'bootstrapwp' ); ?>
				</p>
			<?php endif; ?>
			<div class="media-body">
				<h4> <?php printf( '%1$s %2$s',// 显示评论作者名称 
						get_comment_author_link(),
						// 如果当前文章的作者也是这个评论的作者，那么会出现一个标签提示。
						( $comment->user_id === $post->post_author ) ? '<span class="badge badge-pill badge-primary"> ' . __( 'Post author', 'uuui' ) . '</span>' : ''
					); ?>
				</h4>
				<small>
					<?php printf( '<time datetime="%1$s">%2$s</time>', get_comment_time( 'c' ), sprintf( __( '%1$s %2$s', 'fenikso' ), get_comment_date(), get_comment_time() ));?>
					<?php  edit_comment_link( __( 'Edit', 'uuui' ), '<span class="edit-link">', '</span>' ); ?>
				</small>

				<?php  comment_text(); ?>
				
				<div class="reply">
					<?php // 显示评论的回复链接 
						comment_reply_link( array_merge( $args, array( 
						'reply_text' =>  __( 'Reply', 'uuui'), 
						'after'      =>  ' <span>&darr;</span>', 
						'depth'      =>  $depth, 
						'max_depth'  =>  $args['max_depth'] ) ) ); 
					?>
				</div>

			</div>
		</li>


        <?php die();
    }

endif;

add_action( 'wp_enqueue_scripts', 'fa_ajax_comment_scripts' );
add_action('wp_ajax_nopriv_ajax_comment', 'fa_ajax_comment_callback');
add_action('wp_ajax_ajax_comment', 'fa_ajax_comment_callback');