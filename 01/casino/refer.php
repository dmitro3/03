<?php

/**
 * Template Name: Refer Template
 * 
 * @refer https://millionclues.com/tutorials/custom-wordpress-register-login-page
 */

/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) exit;

global $wpdb, $user_ID, $api_server_url, $woo_currency;

// $action = (isset($_GET['action'])) ? $_GET['action'] : 0;



get_header();
get_sidebar();
?>
<div class="inner-page-text">
    <div class="container">
        <div class="login-page-text">
            <div class="row m-auto justify-content-center">
                <div class="col-lg-6  text-center">
                    <h2 class="h2-title">Account Creation</h2>
                </div>
            </div>
            <section class="register-section">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <?php
                        if (isset($_GET['user']) && !empty($_GET['user'])) {
                            $refer_user = $_GET['user'];

                            if (username_exists($refer_user)) {
                                $refer_id = username_exists($_GET['user']);
                                $referral_data = get_userdata($refer_id);

                                if (isset($referral_data->roles[0]) && !empty($referral_data->roles[0])) {
                                    $referral_role = $referral_data->roles[0];
                                }
                            } else if ($referral_data = get_userdata($refer_user)) {
                                $refer_id = $referral_data->ID;

                                if (isset($referral_data->roles[0]) && !empty($referral_data->roles[0])) {
                                    $referral_role = $referral_data->roles[0];
                                }
                            } else {
                                $refer_id = false;
                            }

                            if (isset($_GET['referral']) && $_GET['referral'] !== '') {
                                $referral_commission = get_user_meta($refer_id, 'referral_commission', true);
                                
                                if (isset($referral_commission) && !empty($referral_commission)) {
                                    if (isset($referral_commission[$_GET['referral']])) {
                                        $user_commission = $referral_commission[$_GET['referral']]['commission'];
                                        $user_settlement = $referral_commission[$_GET['referral']]['settlement'];
                                        $referral_status = true;
                                    } else {
                                        $user_commission = 0;
                                        $referral_status = false;
                                    }
                                } else {
                                    $user_commission = 0;
                                    $referral_status = false;
                                }
                            } else {
                                $user_commission = 0;
                                $referral_status = true;
                            }

                            if ($referral_status) {
                                if ($referral_role === 'agent' || $referral_role === 'administrator') {
                                    if ($refer_id) {
                                        if (isset($_POST['signup'])) {
                                            $error = 0;
                                            $username = esc_sql($_REQUEST['username']);
                                            $referral_user_commission = $_REQUEST['referral_user_commission'];
                                            $referral_user_settlement = $_REQUEST['referral_user_settlement'];
                                            if (empty($username)) {
                                                echo '<p class="register-error">User name should not be empty.</p>';
                                                $error = 1;
                                            } else if (!preg_match("/^[_a-zA-Z0-9-]*$/", $username)) {
                                                echo '<p class="register-error">Please enter a valid username.</p>';
                                                $error = 1;
                                            }

                                            $email = esc_sql($_REQUEST['email']);
                                            if (!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$/", $email)) {

                                                echo '<p class="register-error">Please enter a valid email.</p>';
                                                $error = 1;
                                            }

                                            if ($referral_user_commission > 0) {
                                                $referral_user_role = 'agent';
                                            } else {
                                                $referral_user_role = 'player';
                                            }

                                            $referral_user = esc_sql($_REQUEST['referral_user']);
                                            if (empty($referral_user)) {
                                                echo '<p class="register-error">Password should not be empty..</p>';
                                                $error = 1;
                                            }

                                            $password = esc_sql($_REQUEST['password']);
                                            $confirm_password = esc_sql($_REQUEST['password2']);
                                            if (empty($password)) {
                                                echo '<p class="register-error">Password should not be empty..</p>';
                                                $error = 1;
                                            } else {
                                                $password_len = strlen($password);

                                                if ($password_len < 3) {
                                                    echo '<p class="register-error">The password does not meet the requirements!.</p>';
                                                    // echo 'the password does not meet the requirements!';
                                                    $error = 1;
                                                } else {
                                                    if ($password != $confirm_password) {
                                                        echo '<p class="register-error">Password and Confirm Password not match.</p>';
                                                        $error = 1;
                                                    }
                                                }
                                            }

                                            $consent = esc_sql($_REQUEST['consent']);
                                            if (empty($consent)) {
                                                echo '<p class="register-error">You must accept our terms and conditions to register account</p>';
                                                $error = 1;
                                            }
        
                                            if ($error == 0) {
                                                // $random_password = wp_generate_password(12, false);
                                                $password = $_REQUEST['password'];
                                                $email = strtolower($email);
                                                $status = wp_create_user($username, $password, $email);

                                                if (is_wp_error($status)) {
                                                    echo '<p class="register-error">Username already exists. Please try another one.</p>';
                                                } else {
                                                    $from     = get_option('admin_email');
                                                    $headers   = 'From: ' . $from . "\r\n";
                                                    $subject   = "Registration successful";
                                                    $message   = "Registration successful.\nYour login details\nUsername: $username\nPassword: $password";
                                                    // $message = registration_email_template($username, $password);
                                                    // Email password and other details to the user
                                                // $test = wp_mail($email, $subject, $message, $headers);

                                                    // echo "<p class='register-successful'>Please check your email for login details.</p>";
                                                    // echo "<p class='register-successful'>Registered successfully.</p>";
                                                    registration_response_modal("User Registration", "Registered successfully.");

                                                    // Making sure to adjust `10` to an appropriate user ID
                                                    $user_role_change = new WP_User($status);
                                                    $user_role_change->set_role($referral_user_role);

                                                    update_user_meta($status, 'parent_user', $refer_id);

                                                    $referral_user_commission = array(
                                                        'casino' => $referral_user_commission,
                                                        'sports' => $referral_user_commission,
                                                        'poker' => $referral_user_commission
                                                    );
                                                    $referral_user_permission = 'casino,sports,poker';

                                                    $referral_user_commission = json_encode($referral_user_commission, JSON_NUMERIC_CHECK);
                                                    update_user_meta($status, 'user_play_permission', $referral_user_permission);
                                                    update_user_meta($status, 'user_game_commission', $referral_user_commission);
                                                    update_user_meta($status, 'settlement_type', $referral_user_settlement);
                                                    update_user_meta($status, 'user_hide', 0);


                                                    $data = array(
                                                        "action"    => "player-agent-action",
                                                        "remoteId"  => home_url() . "/_" . $status,
                                                        "fatherId"  => home_url() . "/_" . $refer_id,
                                                        "currency"  => $woo_currency,
                                                        "role"      => $referral_user_role
                                                    );

                                                    if ($referral_user_role === 'agent') {
                                                        $data['commission'] = $referral_user_commission;
                                                        $data['settlementType'] = $referral_user_settlement;
                                                    }

                                                    $data = json_encode($data);

                                                    if (!empty($data) && isset($data)) {
                                                        $agere_casino_id = get_field('agere_casino_id', 'option');
                                                        $agere_token = get_field('agere_token', 'option');
                                                        $api_url = $api_server_url . "/casinos/create-agent-player?action=create-user&token=" . $agere_token . "&casino=" . $agere_casino_id;

                                                        $curl = curl_init();
                                                        curl_setopt($curl, CURLOPT_POST, 1);
                                                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                                                        curl_setopt($curl, CURLOPT_URL, $api_url);
                                                        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                                            'Content-Type: application/json',
                                                        ));
                                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                                                        curl_exec($curl);
                                                    }

                                                    $error = 2; // We will check for this variable before showing the sign up form. 
                                                }
                                            }
                                        }
                                        if ($error != 2) { ?>
                                            <div class="manual-register-form">
                                                <form method="post" id="registerForm" enctype="multipart/form-data">
                                                    <div class="login-username">
                                                        <label for="Username">Username (lowercase only)</label>
                                                        <input type="text" name="username" placeholder="Username" class="form-input" value="<?php if (!empty($username)) echo $username; ?>" /><br />
                                                    </div>
                                                    <div class="login-email">
                                                        <label for="Email">Email</label>
                                                        <input type="text" name="email" placeholder="Email" class="form-input " value="<?php if (!empty($email)) echo $email; ?>" /> <br />
                                                    </div>
                                                    <div class="login-password">
                                                        <label for="Password">Password (minimum 3 characters)</label>
                                                        <input type="password" name="password" placeholder="password" class="form-input" value="<?php if (!empty($password)) echo $password; ?>" /> <br />
                                                    </div>
                                                    <div class="login-password">
                                                        <label for="Password">Confirm password</label>
                                                        <input type="password" name="password2" placeholder="Confirm password" class="form-input" value="<?php if (!empty($password2)) echo $password2; ?>" /> <br />
                                                    </div>
                                                    <?php if (1 === (int) get_field('register_page_recaptcha', 'option')) { ?>
                                                        <div class="login-submit">
                                                            <div class="checkbox" id="consent_div">
                                                                <input type="checkbox" value="1" name="consent" id="consent">
                                                                <label class="consent-label">By ticking this box, in order to register for this website, the user declares to have read, understood and accepted the <a href="javascript:void(0);">General Terms and Conditions</a>.</label>
                                                            </div>
                                                            <div class="g-recaptcha mb-3" data-sitekey="<?php the_field('register_page_recaptcha_site_key', 'option'); ?>"></div>
                                                         
                                                            <input type="hidden" name="referral_user" value="<?php echo $refer_id; ?>">
                                                            <input type="hidden" name="referral_user_commission" value="<?php echo $user_commission; ?>">
                                                            <input type="hidden" name="referral_user_settlement" value="<?php echo $user_settlement; ?>">
                                                            <input type="submit" id="register-submit-btn" class="mb-4" name="signup" value="Sign Up" />
                                                        </div>
                                                    <?php } ?>
                                                </form>
                                                <p>Already have an account? <a href="<?php echo site_url(); ?>/login">Login Here</a></p>
                                                <div class="pass-error"></div>
                                            </div>
                                    <?php }

                                       
                                    }
                                } elseif (($referral_role !== 'agent' || $referral_role !== 'administrator')  && $refer_id !== FALSE) { ?>
                                    <p>Referral user does not have permissions to refer other people. Please <a href="<?php echo site_url('/register/'); ?>">click here</a> to register an account.</p>
                                    <p>Already have an account? <a href="<?php echo site_url(); ?>/login">Login here</a></p>
                                <?php } else { ?>
                                    <p>Referral user does not exists in our database. Please <a href="<?php echo site_url('/register/'); ?>">click here</a> to register an account.</p>
                                    <p>Already have an account? <a href="<?php echo site_url(); ?>/login">Login here</a></p>
                                <?php }
                            } else { ?>
                                <p>Referral parameter value is wrong. Please contact your agent or admin. Please <a href="<?php echo site_url('/register/'); ?>">click here</a> to register an account.</p>
                                <p>Already have an account? <a href="<?php echo site_url(); ?>/login">Login here</a></p>
                            <?php }
                        } else if (is_user_logged_in()) {
                            if (!isset($_GET['user'])) { ?>
                                <p>You can invite users via your referral link by user name or user id. You can follow following links and register users via referral.</p>
                                <p><strong>1.</strong> <a href="<?php echo site_url('/refer/?user=' . get_current_user_id()); ?>"><?php echo site_url('/refer/?user=' . get_current_user_id()); ?></a></p>
                                <p><strong>2.</strong> <a href="<?php echo site_url('/refer/?user=' . wp_get_current_user()->user_login); ?>"><?php echo site_url('/refer/?user=' . wp_get_current_user()->user_login); ?></a></p>
                            <?php }
                        } else { ?>
                            <p>Required parameters are not available. Please <a href="<?php echo site_url('/register/'); ?>">click here</a> to register an account.</p>
                            <p>Already have an account? <a href="<?php echo site_url(); ?>/login">Login here</a></p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php if (1 === (int) get_field('register_page_recaptcha', 'option')) { ?>
    <script type="text/javascript">
        jQuery("#registerForm").submit(function(e) {
            var data_2;
            jQuery.ajax({
                type: "POST",
                url: "/wp-content/themes/casino/google_captcha.php",
                data: jQuery('#registerForm').serialize(),
                async: false,
                success: function(data) {
                    console.log(data);
                    if (data.nocaptcha === "true") {
                        data_2 = 1;
                    } else if (data.spam === "true") {
                        data_2 = 1;
                    } else {
                        data_2 = 0;
                    }
                }
            });
            if (data_2 != 0) {
                e.preventDefault();
                if (data_2 == 1) {
                    alert("Check the captcha box");
                } else {
                    alert("Please Don't spam");
                }
            } else {
                jQuery("#registerForm").submit
            }
        });
    </script>
<?php } ?>
<?php get_footer(); ?>