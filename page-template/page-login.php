<?php
/**
 * Template Name: 前台登录
 * 作者：露兜
 * 博客：https://www.ludou.org/
 *  
 *  2013年5月6日 ：
 *  首个版本
 *  
 *  2013年5月21日 ：
 *  防止刷新页面重复提交数据
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
        }
        else {
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
 <?php get_header(); ?>
        
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center" style="margin-bottom: 40px;">
                <h2 style="font-weight: 600; margin: 20px 0px;"><?php the_title(); ?></h2>
                <div class="dropdown-divider"></div>
            </div>
            <div class="col-lg-3 hide-768px"></div>
            <div class="col-lg-6 col-sm-12" style="text-align:center;margin-bottom: 40px;">
                <div class="page-support-content">
                    
                    <?php if(!empty($error)) {
                    echo '<p class="ludou-error">'.$error.'</p>';
                    }
                    if (!is_user_logged_in()) { ?>
                    <form name="loginform" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
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
                </div>
            </div>
            <div class="col-lg-3 hide-768px"></div>
        </div>
        
        <div class="col-12">
            <?php include( get_stylesheet_directory() . '/index/landing-page.php' ); ?>
        </div>


<?php get_footer(); ?>