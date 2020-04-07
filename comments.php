<?php
    if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('请不要直接加载此页面。 谢谢！');
?>

<?php comment_form(); ?>

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
        <?php wp_list_comments(); ?>
<?php } ?>