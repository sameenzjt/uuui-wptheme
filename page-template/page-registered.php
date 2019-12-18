<?php
/**
 * Template Name: 前台注册
 * 作者：露兜
 * 博客：https://www.ludou.org/
 *  
 *  2013年02月02日 ：
 *  首个版本
 */

if( !empty($_POST['ludou_reg']) ) {
    $error = '';
    $sanitized_user_login = sanitize_user( $_POST['user_login'] );
    $user_email = apply_filters( 'user_registration_email', $_POST['user_email'] );

    // Check the username
    if ( $sanitized_user_login == '' ) {
        $error .= '<div class="alert alert-warning"><strong>警告!</strong> 请输入用户名。</div>';
    } elseif ( ! validate_username( $sanitized_user_login ) ) {
        $error .= '<div class="alert alert-danger"><strong>错误!</strong> 此用户名包含无效字符，请输入有效的用户名</div>';
        $sanitized_user_login = '';
    } elseif ( username_exists( $sanitized_user_login ) ) {
        $error .= '<div class="alert alert-danger"><strong>错误!</strong> 该用户名已被注册，请再选择一个。</div>';
    }

    // Check the e-mail address
    if ( $user_email == '' ) {
        $error .= '<div class="alert alert-alert-warning"><strong>警告!</strong> 请填写电子邮件地址。</div>';
    } elseif ( ! is_email( $user_email ) ) {
        $error .= '<div class="alert alert-danger"><strong>错误!</strong> 电子邮件地址不正确。</div>';
        $user_email = '';
    } elseif ( email_exists( $user_email ) ) {
        $error .= '<div class="alert alert-danger"><strong>错误!</strong> 该电子邮件地址已经被注册，请换一个。</div>';
    }

    // Check the password
    if(strlen($_POST['user_pass']) < 6)
        $error .= '<div class="alert alert-warning"><strong>警告!</strong> 密码长度至少6位!</div>';
    elseif($_POST['user_pass'] != $_POST['user_pass2'])
        $error .= '<div class="alert alert-danger"><strong>错误!</strong> 两次输入的密码必须一致!</div>';
    
    if($error == '') {
        $user_id = wp_create_user( $sanitized_user_login, $_POST['user_pass'], $user_email );
        if ( ! $user_id ) {
            $error .= sprintf( '<div class="alert alert-danger"><strong>错误!</strong> 无法完成您的注册请求</div>
            <div class="alert alert-info">
                <strong>信息!</strong> 请联系<a href="mailto:%s" class="alert-link">管理员</a>！
            </div>', get_option( 'admin_email' ) );
        }
        else if (!is_user_logged_in()) {
            $user = get_user_by( 'login', $sanitized_user_login );
            $user_id = $user->ID;
            
            // 自动登录
            wp_set_current_user($user_id, $user_login);
            wp_set_auth_cookie($user_id);
            do_action('wp_login', $user_login);
        }
    }
}?>

<?php get_header(); ?>
    <div class="row">
        <div class="col-lg-12 col-sm-12 text-center" style="margin-bottom: 40px;">
            <h2 style="font-weight: 600; margin: 20px 0px;"><?php the_title(); ?></h2>
            <div class="dropdown-divider"></div>
        </div>
        <div class="col-lg-3 hide-768px"></div>
        <div class="col-lg-6 col-sm-12">
            <div class="page-support-content" >
                <?php if(!empty($error)) {
                    echo '<p class="ludou-error">'.$error.'</p>';
                    }
                    if (!is_user_logged_in()) { ?>
                <form name="registerform" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                    <!-- 用户名 -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">用&nbsp;&nbsp;户&nbsp;名</span>
                        </div>
                        <input type="text" name="user_login" tabindex="1" id="user_login" class="form-control" value="<?php if(!empty($sanitized_user_login)) echo $sanitized_user_login; ?>" />
                    </div>
                    <!-- 电子邮件 -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">电子邮件</span>
                        </div>
                        <input type="text" name="user_email" tabindex="2" id="user_email" class="form-control" value="<?php if(!empty($user_email)) echo $user_email; ?>" size="25" />
                    </div>
                    <!-- 密码(至少6位) -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</span>
                        </div>
                        <input id="user_pwd1" class="form-control" tabindex="3" type="password" tabindex="21" size="25" value="" name="user_pass" />
                        <div class="input-group-prepend">
                            <span class="input-group-text">至少6位</span>
                        </div>
                    </div>
                    <!-- 重复密码 -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">重复密码</span>
                        </div>
                        <input id="user_pwd2" class="form-control" tabindex="4" type="password" tabindex="21" size="25" value="" name="user_pass2" />
                    </div>
                    <!-- 注册 -->
                    <input type="hidden" name="ludou_reg" value="ok" />
                    <button class="btn btn-primary" type="submit">注册</button>
                    <span class="font-size-small">点击注册即表示同意本网站的<a href="#" class="font-size-small">隐私条款</a></span>
                      
                </form>
                <br /><br />

                <?php } else {
                    echo '<div class="alert alert-info">您已注册成功，并已登录！<a href="'.wp_logout_url().'" title="登出">登出？</a></div>';
                    } ?>
            </div>
        </div>
        <div class="col-lg-3 hide-768px"></div>
    </div>
    
    <div class="col-12">
        <?php include( get_stylesheet_directory() . '/index/landing-page.php' ); ?>
    </div>
   


<?php get_footer(); ?>