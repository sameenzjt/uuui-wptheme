<?php
    /*
    Template Name: 登录+注册
    */
      
    if(!isset($_SESSION))
    session_start();
    
    if( isset($_POST['ludou_token']) && ($_POST['ludou_token'] == $_SESSION['ludou_token'])) {
        $error = '';
        $secure_cookie = false;
        $user_name = sanitize_user( $_POST['log'] );
        $user_password = $_POST['pwd'];
    if ( empty($user_name) || ! validate_username( $user_name ) ) {
        $error .= '<div class="alert alert-danger"><strong>错误!</strong> 请输入有效的用户名。</div><br />';
        $user_name = '';
    }
    
    if( empty($user_password) ) {
        $error .= '<div class="alert alert-danger"><strong>错误!</strong> 请输入密码。</div><br />';
    }
    
    if($error == '') {
        // If the user wants ssl but the session is not ssl, force a secure cookie.
        if ( !empty($user_name) && !force_ssl_admin() ) {
            if ( $user = get_user_by('login', $user_name) ) {
                if ( get_user_option('use_ssl', $user->ID) ) {
                    $secure_cookie = true;
                    force_ssl_admin(true);
                }
            }
        }
        
        if ( isset( $_GET['r'] ) ) {
            $redirect_to = $_GET['r'];
        // Redirect to https if user wants ssl
        if ( $secure_cookie && false !== strpos($redirect_to, 'wp-admin') )
            $redirect_to = preg_replace('|^http://|', 'https://', $redirect_to);
        }
        else {
            $redirect_to = admin_url();
        }
        
        if ( !$secure_cookie && is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )
            $secure_cookie = false;
            
            $creds = array();
            $creds['user_login'] = $user_name;
            $creds['user_password'] = $user_password;
            $creds['remember'] = !empty( $_POST['rememberme'] );
            $user = wp_signon( $creds, $secure_cookie );
            if ( is_wp_error($user) ) {
                $error .= $user->get_error_message();
            } else {
                unset($_SESSION['ludou_token']);
                wp_safe_redirect($redirect_to);
            }
        }
        unset($_SESSION['ludou_token']);
    }

    $rememberme = !empty( $_POST['rememberme'] );
    
    $token = md5(uniqid(rand(), true));
    $_SESSION['ludou_token'] = $token;
?>

<?php 
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
<div style="margin-bottom: 600px;">
    <div class="dowebok">
        <div class="form sign-in" style="text-align:center;margin-bottom: 40px;">
            <div class="page-support-content">
                <?php if(!empty($error)) {
                    echo '<p class="ludou-error">'.$error.'</p>';
                }
                if (!is_user_logged_in()) { ?>
                    <form name="loginform" method="post" action="<?php echo home_url(); ?>">
                        <h2>登录</h2>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">用户名</span>
                            </div>
                            <input type="text" name="log" class="form-control" value="<?php if(!empty($user_name)) echo $user_name; ?>" />
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">密码</span>
                            </div>
                            <input class="form-control" type="password" value="" name="pwd" />
                        </div>
                        
                        <label for="form-check-label">
                            <input name="rememberme" type="checkbox" value="1" <?php checked( $rememberme ); ?> />
                            记住我
                        </label>
                        <br />
                        <input type="hidden" name="redirect_to" value="<?php if(isset($_GET['r'])) echo $_GET['r']; ?>" />
                        <input type="hidden" name="ludou_token" value="<?php echo $token; ?>" />
                        <button class="btn btn-primary" type="submit">登录</button>
                    </form>
                <?php } else {
                echo '<div class="alert alert-info"><strong>您已登录！</strong> <a href="'.wp_logout_url().'" title="登出">登出？</a></div>';
                } ?>
            </div><!-- End——page-support-content -->
        </div><!-- End——form sign-in -->

        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">
                    <h2>还未注册？</h2>
                    <p>立即注册，发现大量机会！</p>
                </div>
                <div class="img__text m--in">
                    <h2>已有帐号？</h2>
                    <p>有帐号就登录吧，好久不见了！</p>
                </div>
                <div class="img__btn">
                    <span class="m--up">注 册</span>
                    <span class="m--in">登 录</span>
                </div>
            </div>

            <div class="form sign-up">
                <div class="page-support-content" >
                    <?php if(!empty($error)) {
                        echo '<p class="ludou-error">'.$error.'</p>';
                    } if (!is_user_logged_in()) { ?>
                        <form name="registerform" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                            <h2>注册</h2>
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
                </div><!--page-support-content-->
            </div><!--form-->
        </div><!--sub-cont-->
    </div><!--dowebok-->
</div>
<?php get_footer(); ?>