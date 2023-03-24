<?php

/**
 * Template Name: Login Taurus
 *
 * Login Page Template.
 *
 * @author Plutus
 * @since 1.0.0
 */
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (is_user_logged_in()) {
    wp_safe_redirect(home_url());
    exit;
}

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_info = get_user_by('login', $username);
    if (!$user_info) {
        $user_info = get_user_by('email', $username);
    }
    if ($user_info) {
        $user_id = $user_info->ID;
        if (wp_check_password($password, $user_info->user_pass, $user_id)) {
            // if ($user_info->roles[0] == "player") {
            wp_set_auth_cookie($user_id, $user_remember);
            wp_set_current_user($user_id, $user_login);
            do_action('wp_login', $user_login, get_userdata($user_id));
            wp_redirect(home_url());
            // } else {
            //     $error = 'The username and password you entered is incorrect.';
            // }
        } else {
            $error = 'The username and password you entered is incorrect.';
        }
    } else {
        $error = 'The username and password you entered is incorrect.';
    }
}




global $wpdb, $user_ID;

get_header();
get_sidebar();
?>
<div class="inner-page-text">
    <div class="container">
        <div class="row m-auto justify-content-center">
            <div class="col-lg-6  text-center">
                <h2 class="h2-title"><?php the_title(); ?></h2>
            </div>
        </div>
        <section class="login-section">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <?php if ($user_ID) {
                    ?>
                        <div class="user-logout-wp">

                            <div class="aa_logout">
                                <p><?php _e('Hello: ', ' AA');
                                    echo $user_login;  ?></p>
                                <p><?php _e('You are already logged in.', 'AA'); ?></p>
                            </div>
                            <a id="wp-submit" href="<?php echo wp_logout_url(); ?>" title="Logout">Logout</a>
                        </div>
                    <?php
                    } else {

                    ?>

                        <form method="post" class="login__form">
                            <div class="form_input_wp">
                                <label for="user_login">Username</label>
                                <input name="username" type="text" class="form-input">
                            </div>
                            <div class="form_input_wp">
                                <label for="user_login">Password</label>
                                <input name="password" type="password" class="form-input">
                            </div>

                            <div class="form_submit pb-3">
                                <button type="submit" name="login" class="button button-primary">Login</button>
                                <span class="load-more">
                                    <i class="fad fa-spinner-third  fa-spin ajax-loader"></i>
                                </span>
                            </div>
                            <a class="lost_pass" href="<?php echo home_url(); ?>/my-account/lost-password/">Lost Password?</a>
                            <div class="register-page-link">
                                <p>Do not have an account? <a href="<?php echo home_url(); ?>/register/">Register Here</a></p>
                            </div>

                            <?php
                            if (isset($error)) {
                                echo "<p class='register-error ' >" . $error . "</p>";
                            }
                            ?>
                        </form>


                    <?php

                    } ?>
                </div>
            </div>
        </section>
    </div>
</div>
</div>
<?php get_footer(); ?>