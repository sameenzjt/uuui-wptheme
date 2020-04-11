<?php
    if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('请不要直接加载此页面。 谢谢！');
?>

<?php $defaults = array(
        'comment_field'        => '<div class="form-group"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea class="form-control" id="comment" name="comment" rows="3" aria-required="true"></textarea></div>',
        'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'logged_in_as'         => '<p class="float-right">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'uuui' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'comment_notes_before' => '<p class="float-right">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
        #'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'title_reply'          => __( '' ),//评论标题
        'title_reply_to'       => __( 'Leave a Reply to %s' ),
        'cancel_reply_link'    => __( 'Cancel reply' ),
        'label_submit'         => __( 'Post Comment' ),
    );

comment_form($defaults); ?>

<?php if (!empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { 
        // if there's a password
        // and it doesn't match the cookie
?>
    <li class="decmt-box">
        <p><a href="#addcomment">请输入密码再查看评论内容.</a></p>
    </li>
<?php } else if ( !comments_open() ) { ?>
    <li class="decmt-box">
        <p><a href="#addcomment">评论功能已经关闭!</a></p>
    </li>
<?php } else if ( !have_comments() ) { ?>
    <li class="decmt-box">
        <p><a href="#addcomment">还没有任何评论，你来说两句吧</a></p>
    </li>
<?php } else {?>
    <ol class="comment-list container mt-3">
        <?php wp_list_comments(
            array(
            'callback'     =>  'bootstrapwp_comment',
        )); ?>
    </ol>
        
<?php } ?>