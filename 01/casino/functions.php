<?php
global $woo_currency;

$woo_currency = get_woocommerce_currency();

function add_theme_scripts()
{
    wp_enqueue_style('all', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', false, '1.1', 'all');
    wp_enqueue_style('bootstrap.min', get_template_directory_uri() . '/assets/plugins/bootstrap/css/bootstrap.min.css', false, '1.1', 'all');
    wp_enqueue_style('slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '20151215');
    wp_enqueue_style('slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), '20151215');
    wp_enqueue_style('footer', get_template_directory_uri() . '/assets/css/footer.css', false, '1.1', 'all');
    wp_enqueue_style('jquery.scrollbar', get_template_directory_uri() . '/assets/plugins/jquery-scrollbar/jquery.scrollbar.css', false, '1.1', 'all');
    wp_enqueue_style('pages-icons', get_template_directory_uri() . '/pages/css/pages-icons.css', false, '1.1', 'all');

    if (is_page_template('casino.php') || is_page_template('slots.php') || is_front_page()) {
        wp_enqueue_style('casino-page-css', get_template_directory_uri() . '/assets/css/casino.css', false, rand(1000, 100000000));
    }

    if ('my-account' === get_post_field('post_name', get_the_ID())) {
        wp_enqueue_style('daterangepicker-page-css', get_template_directory_uri() . '/assets/css/daterangepicker.css', false, '1.5');
    }

    wp_enqueue_script('select2');
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/wallet.css?' . time(), false, '1.2', 'all');
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css?' . time(), false, '1.2', 'all');
    wp_enqueue_style('pages', get_template_directory_uri() . '/pages/css/pages.css?' . time(), array('woo-wallet-style'), rand(1000, 100000000), 'all');

    wp_enqueue_script('modernizr', get_template_directory_uri() . '/assets/plugins/modernizr.custom.js', array('jquery'), 1.5, true);
    wp_enqueue_script('jquery.scrollbar', get_template_directory_uri() . '/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js', array('jquery'), 1.5, true);
    wp_enqueue_script('pages.min', get_template_directory_uri() . '/pages/js/pages.min.js', array('jquery'), 1.5, true);
    wp_enqueue_script('bootstrap.min', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), 1.5, true);

    wp_enqueue_script('slick-min', get_template_directory_uri() . '/assets/js/slick.min.js', array(), '20151215', true);

    if ('my-account' === get_post_field('post_name', get_the_ID())) {

        wp_enqueue_script('moment-min', get_template_directory_uri() . '/assets/js/moment.min.js', array(), '20151215', true);
        wp_enqueue_script('daterangepicker-min', get_template_directory_uri() . '/assets/js/daterangepicker.min.js', array(), '20151215', true);
    }


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('cryptoloot-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), time(), true);
    wp_localize_script('cryptoloot-custom', 'custom_call', ['ajaxurl' => admin_url('admin-ajax.php')]);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function deRegister() {
    wp_deregister_style( 'woo-wallet-payment-jquery-ui' );
    wp_dequeue_style( 'woo-wallet-payment-jquery-ui' );
    wp_deregister_style( 'woo-wallet-jquery-ui-css' );
    wp_dequeue_style( 'woo-wallet-jquery-ui-css' );
    wp_deregister_style( 'faulh-public-jquery-ui.min' );
    wp_dequeue_style( 'faulh-public-jquery-ui.min' );
}
add_action('wp_enqueue_scripts', 'deRegister', 9999);


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function casino_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'premier-turf-farms'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'premier-turf-farms'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'casino_widgets_init');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Needed Plugins Downloader
 */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'bettingion_register_required_plugins');




/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function bettingion_register_required_plugins()
{
    /*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
    $plugins = array(


        array(
            'name'               => 'Casino Wallet', // The plugin name.
            'slug'               => 'casino-wallet', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/plugins/casino-wallet.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),

        array(
            'name'               => 'Casino Wallet Withdrawal', // The plugin name.
            'slug'               => 'casino-wallet-withdrawal', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/plugins/casino-wallet-withdrawal.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),


        array(
            'name'               => 'Advanced Custom Fields PRO', // The plugin name.
            'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/plugins/advanced-custom-fields-pro.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Classic Editor',
            'slug'      => 'classic-editor',
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.			
            'required'  => false,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.			
            'required'  => true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Contact Form CFDB7',
            'slug'      => 'contact-form-cfdb7',
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.			
            'required'  => true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Email Templates',
            'slug'      => 'email-templates',
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.			
            'required'  => true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'MultiLine files for Contact Form 7',
            'slug'      => 'multiline-files-for-contact-form-7',
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.			
            'required'  => true,
        ),


        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Really Simple SSL',
            'slug'      => 'really-simple-ssl',
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.			
            'required'  => true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.			
            'required'  => true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'ManageWP - Worker',
            'slug'      => 'worker',
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.		
            'required'  => true,
        ),

        // This is an example of the use of 'is_callable' functionality. A user could - for instance -
        // have WPSEO installed *or* WPSEO Premium. The slug would in that last case be different, i.e.
        // 'wordpress-seo-premium'.
        // By setting 'is_callable' to either a function from that plugin or a class method
        // `array( 'class', 'method' )` similar to how you hook in to actions and filters, TGMPA can still
        // recognize the plugin as being installed.
        array(
            'name'        => 'WordPress SEO by Yoast',
            'slug'        => 'wordpress-seo',
            'is_callable' => 'wpseo_init',
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.					
        ),

    );

    /*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
    $config = array(
        'id'           => 'bettingion',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

        /*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'bettingion' ),
			'menu_title'                      => __( 'Install Plugins', 'bettingion' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'bettingion' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'bettingion' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'bettingion' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'bettingion'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'bettingion'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'bettingion'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'bettingion'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'bettingion'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'bettingion'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'bettingion'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'bettingion'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'bettingion'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'bettingion' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'bettingion' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'bettingion' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'bettingion' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'bettingion' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'bettingion' ),
			'dismiss'                         => __( 'Dismiss this notice', 'bettingion' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'bettingion' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'bettingion' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
    );

    tgmpa($plugins, $config);
}






/**
 * Logout redirect to login page
 */
add_action('wp_logout', 'logout_redirect_to_login_page');
function logout_redirect_to_login_page()
{
    if ($_REQUEST['action'] === 'casino_admin_logout') {
        wp_safe_redirect(home_url('/casino-admin/'));
    } else {
        wp_safe_redirect(home_url('/login/'));
    }
    exit;
}

/**
 * Casino admin logout redirect to login page
 */
if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'casino_admin_logout') {
        wp_logout();
    }
}

add_action('init', 'blockusers_init');
function blockusers_init()
{
    if (is_admin() && !current_user_can('administrator') && !(defined('DOING_AJAX') && DOING_AJAX)) {
        wp_redirect(home_url());
        exit;
    }
}

function agereToken()
{
    $token = get_field('agere_token', 'option');
    return $token;
}


function agereCasino()
{
    $casino = get_field('agere_casino_id', 'option');
    return $casino;
}

function casino_encrypted_key($querystring)
{
    $saltKey = get_field('salt_key', 'option');
    return  $querystring . '&authKey=' . sha1($saltKey . $querystring);
}


/**
 * All user balance using API
 */
function get_all_user_balance($type = '') {
    global $api_server_url;
    $parameters = casino_encrypted_key( "action=getAllCasinoUsers&token=".agereToken()."&casino=".agereCasino() );
    $user_balances = "{$api_server_url}/casinos-admin/api?{$parameters}";
    
    $user_balances = file_get_contents($user_balances);
    $user_balances = json_decode($user_balances);
    $user_balance = array();
   
    foreach($user_balances->allUsers as $user) {
        if( $type === 'multiple' ) {
            $user_balance[$user->remoteId] = array(
                'balance' => $user->balance,
                'rollover' => $user->rolloverAmount,
                'bonus' => $user->bonusAmount
            );
        } else {
            $user_balance[$user->remoteId] = $user->balance;
        }
        
    }
    return $user_balance;
}


//get woo-wallet balance
add_shortcode('woo-mini-wallet', 'woo_mini_wallet_callback');
function woo_mini_wallet_callback()
{
    if (!function_exists('woo_wallet') || !is_user_logged_in()) {
        return '';
    }
    ob_start();
    $title = __('Current wallet balance', 'woo-wallet');
    $mini_wallet = '<a class="woo-wallet-menu-contents" href="' . esc_url(wc_get_account_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'))) . '" title="' . $title . '">';
    $mini_wallet .= woo_wallet()->wallet->get_wallet_balance(get_current_user_id());
    $mini_wallet .= '</a>';
    echo $mini_wallet;
    return ob_get_clean();
}


//remove annoying wordpress icon from admin backend
add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}, 7);

//support for woocommerce
add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
    add_theme_support('woocommerce');
}
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

//remove all biling requests
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
function custom_override_checkout_fields($fields)
{
    unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_phone']);
    unset($fields['order']['order_comments']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_email']);
    unset($fields['billing']['billing_city']);
    return $fields;
}

add_filter('woocommerce_add_to_cart_redirect', 'wp_get_referer');
add_filter('wc_add_to_cart_message_html', '__return_null');
//remove_action('welcome_panel', 'wp_welcome_panel');

//clear all contents of the cart
add_action("wp_ajax_clear_cart_custom", "woocommerce_clear_cart_url");
add_action("wp_ajax_nopriv_clear_cart_custom", "woocommerce_clear_cart_url");
function woocommerce_clear_cart_url()
{
    WC()->cart->empty_cart();
}

/** Disable All WooCommerce Styles and Scripts Except Shop Pages*/
add_action('wp_enqueue_scripts', 'dequeue_woocommerce_styles_scripts', 99);
function dequeue_woocommerce_styles_scripts()
{
    if (function_exists('is_woocommerce')) {
        if (!is_woocommerce() && !is_cart() && !is_checkout()) {
            # Styles
            wp_dequeue_style('woocommerce-general');
            wp_dequeue_style('woocommerce-layout');
            wp_dequeue_style('woocommerce-smallscreen');
            wp_dequeue_style('woocommerce_frontend_styles');
            wp_dequeue_style('woocommerce_fancybox_styles');
            wp_dequeue_style('woocommerce_chosen_styles');
            wp_dequeue_style('woocommerce_prettyPhoto_css');

            # Scripts
            wp_dequeue_script('wc_price_slider');
            wp_dequeue_script('wc-single-product');
            wp_dequeue_script('wc-add-to-cart');
            wp_dequeue_script('wc-cart-fragments');
            wp_dequeue_script('wc-checkout');
            wp_dequeue_script('wc-add-to-cart-variation');
            wp_dequeue_script('wc-single-product');
            wp_dequeue_script('wc-cart');
            wp_dequeue_script('wc-chosen');
            wp_dequeue_script('woocommerce');
            wp_dequeue_script('prettyPhoto');
            wp_dequeue_script('prettyPhoto-init');
            wp_dequeue_script('jquery-blockui');
            wp_dequeue_script('jquery-placeholder');
            wp_dequeue_script('fancybox');
            wp_dequeue_script('jqueryui');
        }
    }
}

add_action('init', 'redirect_login_page');
function redirect_login_page()
{
    $page_viewed = basename($_SERVER['REQUEST_URI']);
    // Where we want them to go
    $login_page = site_url() . '/login/';
    if ($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit();
    }
}


add_action('wp_login_failed', 'my_front_end_login_fail');
function my_front_end_login_fail($username)
{
    $referrer = $_SERVER['HTTP_REFERER'];

    if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
        $login_page = site_url() . '/login/';
        wp_redirect($login_page . '?login=failed');
        exit;
    }
}

add_action('login_form_bottom', 'add_lost_password_link');
function add_lost_password_link()
{
    return '<a href="' . esc_url(wp_lostpassword_url(get_permalink())) . '">Lost Password?</a>';
}


add_filter('woocommerce_cart_totals_coupon_label', 'bt_rename_coupon_label', 10, 1);
function bt_rename_coupon_label($err, $err_code = null, $something = null)
{
    $err = str_ireplace("Coupon", "Deposit Code ", $err);
    return $err;
}

add_filter('woocommerce_cart_totals_coupon_html', 'custom_cart_totals_coupon_html', 30, 3);
function custom_cart_totals_coupon_html($coupon_html, $coupon, $discount_amount_html)
{

    if ('percent' == $coupon->get_discount_type()) {
        $percent = $coupon->get_description();
        $discount_amount_html = '<span>' . $percent . '% </span>';
        $coupon_html = $discount_amount_html . ' <a href="' . esc_url(add_query_arg('remove_coupon', urlencode($coupon->get_code()), defined('WOOCOMMERCE_CHECKOUT') ? wc_get_checkout_url() : wc_get_cart_url())) . '" class="woocommerce-remove-coupon" data-coupon="' . esc_attr($coupon->get_code()) . '">' . __('[Remove]', 'woocommerce') . '</a>';
    }
    return $coupon_html;
}

add_filter('woocommerce_save_account_details_required_fields', 'misha_myaccount_required_fields');
function misha_myaccount_required_fields($account_fields)
{
    unset($account_fields['account_last_name']);
    unset($account_fields['account_first_name']);
    return $required_fields;
}

//get selected language to pass to games
function selected_language()
{
    global $TRP_LANGUAGE;
    return strpos($TRP_LANGUAGE, "_") !== FALSE ? substr($TRP_LANGUAGE, 0, strpos($TRP_LANGUAGE, "_")) : $TRP_LANGUAGE;
}

/**
 * Ajax for language code
 */
add_action('wp_ajax_language_code', 'send_language_code');
add_action('wp_ajax_nopriv_language_code', 'send_language_code');
function send_language_code()
{
    echo selected_language();
    die;
}

//add custom options page
add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init()
{

    // Check function exists.
    if (function_exists('acf_add_options_sub_page')) {

        // Add parent.
        $parent = acf_add_options_page(array(
            'page_title'  => __('Theme General Settings'),
            'menu_title'  => __('Theme Settings'),
            'redirect'    => false,
        ));

        // Add sub page.
        $child = acf_add_options_sub_page(array(
            'page_title'  => __('Social Settings'),
            'menu_title'  => __('Social'),
            'parent_slug' => $parent['menu_slug'],
        ));
    }
}

//remove wordpress warnings from JS
add_action('wp_loaded', 'output_buffer_start');
function output_buffer_start()
{
    ob_start("output_callback");
}

add_action('shutdown', 'output_buffer_end');
function output_buffer_end()
{
    if (ob_get_length()) {
        ob_end_flush();
    }
}

function output_callback($buffer)
{
    return preg_replace("%[ ]type=[\'\"]text\/(javascript|css)[\'\"]%", '', $buffer);
}

/**
 * Active bonus form AJAX
 */
add_action('wp_ajax_active_bonus_form', 'active_bonus_form_action');
add_action('wp_ajax_nopriv_active_bonus_form', 'active_bonus_form_action');
function active_bonus_form_action() {
    global $api_server_url;
    $bonus_code = $_POST['bonusCode'];
    $remote_id = site_url( '/_'.get_current_user_id() );

    $bonus_api = "{$api_server_url}/api/bonus-code/addToPlayer?code={$bonus_code}&remote_id={$remote_id}&casino=".agereCasino();

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_URL, $bonus_api);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $response = json_decode($response);

    if(isset($response->status) && $response->status === 200) {
        echo json_encode(array(
            'status'    => 'success',
            'message'   => $response->message
        ));
    } else {
        echo json_encode(array(
            'status'    => 'error',
            'message'   => $response->message
        ));
    }
    exit;
}

//
//
//   Begin Casino Code
//
// ajax code freeplay or moneyplay urgent game
add_action('wp_ajax_free_play_agere_game_action', 'free_play_agere_game_action');
add_action('wp_ajax_nopriv_free_play_agere_game_action', 'free_play_agere_game_action');
function free_play_agere_game_action()
{

    global $woo_currency;

    $game_id        = $_POST['gameid'];
    $provider       = $_POST['provider'];
    $providergameid = $_POST['providergameid'];
    $server_url     = $_POST['server_url'];
    $game_url       = $_POST['game_url'];
    $casino_key     = $_POST['casino'];
    $token_key      = $_POST['token'];
    $mode           = $_POST['mode'];

    $user = get_current_user_id();

    $demo_url = "";
    $add_balance = "";
    $new_add_balance = "";
    $response = array();

    // $woo_currency = get_woocommerce_currency();

    // $provider_ids = array(3, 4, 5, 6, 7, 11, 18, 19, 13, 16, 15, 17, 20, 14, 12, 21, 25, 22, 23, 24, 26, 27, 29, 28, 30, 32, 36, 34, 37, 38, 39, 35, 40, 33, 31, 42, 41, 43, 45, 49, 46, 50, 47, 48, 51, 52, 53, 54, 55, 56, 57, 58, 60, 59, 62, 61, 63, 64, 65, 67, 66, 68, 70, 69, 72, 71, 74, 75, 78, 76, 77, 79, 80, 82, 81, 83, 84, 85, 88, 86, 87, 90, 89, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 109, 120, 121, 122, 123, 125, 126);
    // $provider_ids = [100, 101, 102, 103, 104, 105, 109, 11, 111, 12, 120, 121, 122, 123, 124, 125, 126, 14, 15, 16, 17, 18, 19, 20, 21, 23, 25, 26, 27, 29, 30, 32, 33, 34, 35, 36, 37, 38, 39, 45, 46, 47, 48, 50, 51, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 66, 67, 68, 70, 71, 72, 76, 77, 78, 79, 80, 83, 84, 86, 87, 88, 89, 90, 91, 93, 94, 95, 97, 98];

    $provider_ids = array( 3, 4, 5, 6, 7, 11, 18, 19, 13, 16, 15, 17, 20, 14, 12, 21, 25, 22, 23, 24, 26, 27, 29, 28, 30, 32, 36, 34, 37, 38, 39, 35, 40, 33, 31, 42, 41, 43, 45, 49, 46, 50, 47, 48, 51, 52, 53, 54, 55, 56, 57, 58, 60, 59, 62, 61, 63, 64, 65, 67, 66, 68, 70, 69, 72, 71, 74, 75, 78, 76, 77, 79, 80, 82, 81, 83, 84, 85, 88, 86, 87, 90, 89, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 109, 120, 121, 122, 123, 125, 126, 100, 101, 102, 103, 104, 105, 109, 11, 111, 12, 120, 121, 122, 123, 124, 125, 126, 14, 15, 16, 17, 18, 19, 20, 21, 23, 25, 26, 27, 29, 30, 32, 33, 34, 35, 36, 37, 38, 39, 45, 46, 47, 48, 50, 51, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 66, 67, 68, 70, 71, 72, 76, 77, 78, 79, 80, 83, 84, 86, 87, 88, 89, 90, 91, 93, 94, 95, 97, 98 );

    if (in_array($provider, $provider_ids)) {
        if ($mode == "offline") {
            $get_demo_games = $server_url . '?token=' . agereToken() . '&currency=FUN&action=gameLoad&casino=' . agereCasino() . '&game_id=' . $game_id . '&language=' . selected_language() . '&mode=offline';
        } else {
            $add_balance = '&deposit=' . site_url() . '/my-account/wallet/add/';
            $new_add_balance = '?deposit=' . site_url() . '/my-account/wallet/add/';
            $get_demo_games = $server_url . '?token=' . agereToken() . '&remote_id=' . $user . '&currency=' . $woo_currency . '&action=gameLoad&casino=' . agereCasino() . '&game_id=' . $game_id . '&language=' . selected_language();
        }

        // echo $get_demo_games;
        $get_demo_url_raw = file_get_contents($get_demo_games);
        $get_demo_game_url_decoded = json_decode($get_demo_url_raw);

        if ($get_demo_game_url_decoded->status == 200) {
            $demo_url = $get_demo_game_url_decoded->result;
        } else {
            $response_msg = $get_demo_game_url_decoded->response;
            // $response_msg = $get_demo_games;
        }
    } else {
        $get_demo_games = $server_url . '?token=' . agereToken() . '&currency=' . $woo_currency . '&action=gameLoad&casino=' . agereCasino() . '&game_id=' . $game_id . '&remote_id=' . $user;
        $get_demo_url_raw = file_get_contents($get_demo_games);
        $get_demo_game_url_decoded = json_decode($get_demo_url_raw);
        if ($get_demo_game_url_decoded->status == 200) {
            $token = $get_demo_game_url_decoded->result;

            if ($mode == "offline") {
                $demo_url = $game_url . '?token=' . $token_key . '&casino=' . $casino_key . '&language=' . selected_language() . '&currency=FUN&mode=offline&session_id=' . $token . '&game_id=' . $providergameid;
            } else {
                $add_balance = '&deposit=' . site_url() . '/my-account/wallet/add/';
                $new_add_balance = '?deposit=' . site_url() . '/my-account/wallet/add/';
                $demo_url = $game_url . '?token=' . $token_key . '&casino=' . $casino_key . '&language=' . selected_language() . '&currency=' . $woo_currency . '&remote_id=' . $user . '&session_id=' . $token . '&game_id=' . $providergameid;
            }
        } else {
            $response_msg = $get_demo_game_url_decoded->response;
        }
    }
    if (!empty($demo_url)) {
        if (strpos($demo_url, "?") !== false) {
            $gameplayUrl = $demo_url . '' . $add_balance;
        } else {

            $gameplayUrl = $demo_url . '' . $new_add_balance;
        }
        // echo "if con true";
        $response['success'] = $gameplayUrl;
    } else {

        $response['error'] = $response_msg;
    }

    echo json_encode($response);
    die();
}

add_action('wp_ajax_free_play_tvbet_game_action', 'free_play_tvbet_game_action');
add_action('wp_ajax_nopriv_free_play_tvbet_game_action', 'free_play_tvbet_game_action');
function free_play_tvbet_game_action()
{
    global $woo_currency;

    $user       = get_current_user_id();
    $game_id    = $_POST['gameid'];
    $server_url = $_POST['server_url'];
    $mode       = $_POST['mode'];
    $token      = "";
    // $woo_currency = get_woocommerce_currency();
    if ($mode == 'offline') {
    } else {
        $url = $server_url . '?token=' . agereToken() . '&action=gameLoad&remote_id=' . $user . '&currency=' . $woo_currency . '&game_id=' . $game_id . '&language=' . selected_language() . '&casino=' . agereCasino() . '';

        try {
            $raw_post = file_get_contents($url);
        } catch (Exception $e) {
            $raw_post = 0;
        }

        $decoded = json_decode($raw_post);
        $token = $decoded->result;
    }
    echo $token;
    die;
}

/* Disable WordPress Admin Bar for all users */
add_filter('show_admin_bar', '__return_false');

/** Password change */
add_action('wp_ajax_pwd_change', 'popup_pwd_change');
add_action('wp_ajax_nopriv_pwd_change', 'popup_pwd_change');
function popup_pwd_change()
{
    // echo "hii call function ";

    // echo $_POST['password'];
    $new_password = $_POST['password_confirm'];
    $user = wp_get_current_user();

    wp_set_password($new_password, $user->ID);
    wp_set_auth_cookie($user->ID);
    wp_set_current_user($user->ID);
    do_action('wp_login', $user->user_login, $user);
    die;
}

/** Show login history popup */
if (isset($_GET['pagenum']) && !empty($_GET['pagenum'])) {
    add_action('wp_footer', function () {
?>
        <script>
            jQuery(document).ready(function($) {
                jQuery("#login-history").fadeIn();
            });
        </script>
    <?php
    }, 100);
}


/** Autoload more button ajax call */
add_action('wp_ajax_casino_load_more_game_list', 'casino_load_more_game_list');
add_action('wp_ajax_nopriv_casino_load_more_game_list', 'casino_load_more_game_list');
function casino_load_more_game_list()
{
    global $api_server_url;
    $pageno = $provider = $gametype = $search = "";

    $provider_type = isset($_REQUEST['providerType']) && 'featured' === $_REQUEST['providerType'] ? 'featured' : '';
    if (isset($_REQUEST['pageno'])) {
        $pageno = '&page=' . $_POST['pageno'];
    }
    if (isset($_REQUEST['provider'])) {
        $provider = $_POST['provider'];
    }

    if (isset($_REQUEST['gametype']) && !empty($_REQUEST['gametype'])) {
        $gametype = '&gameType=' . $_POST['gametype'];
    }else{
        $gametype = '&gameType=all';
    }
    // echo '<pre>'; print_r($gametype  ); echo '</pre>';
    if (isset($_REQUEST['gametypeSecondary'])) {
        $gametypeSecondary = '&gameTypeSecondary=' . $_POST['gametypeSecondary'];
    }


    $innerpage = $_REQUEST['innerpage'];
    if (!empty($_REQUEST['search'])) {

        // $ser_str = str_replace(" ","%20",$_POST['search']);
        $ser_str = urlencode($_POST['search']);
        $search = '&gameSearch=' . $ser_str;
    }

    if (!empty($provider_type)) {
        $agere_games_url =  "{$api_server_url}/games/admin/getAllCombineAPI?action=feature-providers-games&token=" . agereToken() . "&casino=" . agereCasino() . $pageno;
    } else {
        if (!empty($search)) {
            $agere_games_url =  $api_server_url . '/games/admin/getAllCombineAPI?action=available_games&token=' . agereToken() . '&casino=' . agereCasino() . '' . $pageno . '' . $provider . '' . $gametype . '' . $search.$gametypeSecondary;
        } else {
            $agere_games_url =  $api_server_url . '/games/admin/getAllCombineAPI?action=available_games&token=' . agereToken() . '&casino=' . agereCasino() . '' . $pageno . '' . $provider . '' . $gametype.$gametypeSecondary;
        }
    }
    
    try {
        $all_game_data = file_get_contents($agere_games_url);
    } catch (Exception $e) {
        $all_game_data = 0;
    }

    $all_game_data = json_decode($all_game_data);

    if (isset($all_game_data) && !empty($all_game_data)) {
        $all_providers = $all_game_data->providers;
        $all_gametypes = $all_game_data->gamesTypes;
        if (!empty($provider_type)) {
            $all_available_game = $all_game_data;
        } else {
            $all_available_game = $all_game_data->availableGames;
        }
        $total_game = $all_available_game->currentGamesCount;
    }

    if ($total_game != 0) {
        // print_r($all_available_game);
        all_casino_game_html($all_available_game, $innerpage);
    } else {
        echo $total_game;
    }

    die;
}

/** Autoload more button ajax call */
// add_action('wp_ajax_casino_game_type', 'casino_game_type');
// add_action('wp_ajax_nopriv_casino_game_type', 'casino_game_type');
// function casino_game_type(){

//     global $api_server_url;
//     $pageno = $provider = $gametype = $search = "";

//     $provider_type = isset($_REQUEST['providerType']) && 'featured' === $_REQUEST['providerType'] ? 'featured' : '';
//     if (isset($_REQUEST['pageno'])) {
//         $pageno = '&page=' . $_POST['pageno'];
//     }
//     if (isset($_REQUEST['provider'])) {
//         $provider = $_POST['provider'];
//     }
//     if (isset($_REQUEST['gametype'])) {
//         $gametype = '&gameType=' . $_POST['gametype'];
//     }
//     if (isset($_REQUEST['gametypeSecondary'])) {
//         $gametypeSecondary = '&gameTypeSecondary=' . $_POST['gametypeSecondary'];
//     }


//     $innerpage = $_REQUEST['innerpage'];
//     if (!empty($_REQUEST['search'])) {

//         // $ser_str = str_replace(" ","%20",$_POST['search']);
//         $ser_str = urlencode($_POST['search']);
//         $search = '&gameSearch=' . $ser_str;
//     }

//     if (!empty($provider_type)) {
//         $agere_games_url =  "{$api_server_url}/games/admin/getAllCombineAPI?action=feature-providers-games&token=" . agereToken() . "&casino=" . agereCasino() . $pageno;
//     } else {
//         if (!empty($search)) {
//             $agere_games_url =  $api_server_url . '/games/admin/getAllCombineAPI?action=available_games&token=' . agereToken() . '&casino=' . agereCasino() . '' . $pageno . '' . $provider . '' . $gametype . '' . $search.$gametypeSecondary;
//         } else {
//             $agere_games_url =  $api_server_url . '/games/admin/getAllCombineAPI?action=available_games&token=' . agereToken() . '&casino=' . agereCasino() . '' . $pageno . '' . $provider . '' . $gametype.$gametypeSecondary;
//         }
//     }
    
//     try {
//         $all_game_data = file_get_contents($agere_games_url);
//     } catch (Exception $e) {
//         $all_game_data = 0;
//     }

//     $all_game_data = json_decode($all_game_data);

//     die;
// }


add_action('wp_ajax_current_user_balance', 'header_balance_update_ajax');
add_action('wp_ajax_nopriv_current_user_balance', 'header_balance_update_ajax');
function header_balance_update_ajax()
{

    if (is_user_logged_in()) {

        echo do_shortcode('[woo-mini-wallet]');
    } else {
        echo 0;
    }

    die;
}

/**
 * Provider change
 */
add_action('wp_ajax_casino_game_provider', 'casino_game_provider');
add_action('wp_ajax_nopriv_casino_game_provider', 'casino_game_provider');
function casino_game_provider()
{
    global $api_server_url;
    $pageno = $provider = $gametype = $search = "";

    if (isset($_REQUEST['provider'])) $provider = $_POST['provider'];
    if (isset($_REQUEST['gametype']) && !empty($_REQUEST['gametype'])) {
        $gametype = '&gameType=' . $_POST['gametype'];
    } else {
        $gametype = '&gameType=all';
    }
    if (isset($_REQUEST['innerpage'])) $page = $_POST['innerpage'];
    $provider_type = isset($_REQUEST['providerType']) && 'featured' === $_REQUEST['providerType'] ? 'featured' : '';

    $innerpage = $_REQUEST['innerpage'];
    if (!empty($_REQUEST['search'])) {
        // $ser_str = str_replace(" ","%20",$_POST['search']);
        $ser_str = urlencode($_POST['search']);
        $search = '&gameSearch=' . $ser_str;
    }

    if (!empty($provider_type)) {
        $agere_games_url = "{$api_server_url}/games/admin/getAllCombineAPI?action=feature-providers-games&token=" . agereToken() . "&casino=" . agereCasino() . $gametype;
    } else {
        if (!empty($search)) {
            $agere_games_url =  $api_server_url . '/games/admin/getAllCombineAPI?action=available_games&token=' . agereToken() . '&casino=' . agereCasino() . '' . $pageno . '' . $provider . '' . $gametype . '' . $search;
        } else {
            $agere_games_url =  $api_server_url . '/games/admin/getAllCombineAPI?action=available_games&token=' . agereToken() . '&casino=' . agereCasino() . '' . $pageno . '' . $provider . '' . $gametype;
        }
    }

    try {
        $all_game_data = file_get_contents($agere_games_url);
    } catch (Exception $e) {
        $all_game_data = 0;
    }

    $all_game_data = json_decode($all_game_data);

    if (isset($all_game_data) && !empty($all_game_data)) {
        $all_providers = $all_game_data->providers;
        $all_gametypes = $all_game_data->gamesTypes;
        $all_subGameTypes = $all_game_data->subGameTypes;
        $all_available_game = $all_game_data->availableGames;
        $total_game = $all_available_game->currentGamesCount;
        $total_games = $all_available_game->totalGames;
    }
    ?>

    <?php

    if($page === 'live') { ?>
        <li class="game-type-all" data-gameTypeSecondary=""><a href="javascript:void(0);" class="active-type">All<span class="type-count"><?php echo $total_games; ?></span></a></li>
        <?php if (isset($all_subGameTypes)) {
            foreach ($all_subGameTypes as $key => $type) {
                if (!empty($type->name)) { ?>
                    <li data-gameTypeSecondary="<?php echo $type->name; ?>"><a href="javascript:void(0);"><?php echo $type->name; ?><span class="type-count"> <?php echo $type->gamesCount; ?></span></a>
                    </li> <?php
                }
            }
        }
    } else { ?>
        <li class="game-type-all" data-gametype=""><a href="javascript:void(0);" class="active-type">All<span class="type-count"><?php echo $total_games; ?></span></a></li>
        <?php

        // if (isset($all_gametypes) && $total_game != 0) {
            foreach ($all_gametypes as $key => $type) {
                if (!(($type->name == 'Virtual') || ($type->name == 'OnlinePoker')) && !empty($type->name) && ($type->gamesCount != 0)) { ?>
                    <li data-gametype="<?php echo $type->name; ?>"><a href="javascript:void(0);"><?php echo $type->name; ?><span class="type-count"><?php echo $type->gamesCount; ?></span></a></li>
                    <?php
                }
            }
        // }
    }

    die;
}

/** Show casino game HTML */
function all_casino_game_html($all_available_ames, $page = 'casino', $type = '')
{
    if (isset($all_available_ames->games)) {

        // echo "<br>";
        // echo "if con true";
        // echo "<br>";

        $all_games = $all_available_ames->games;

        // echo "<pre/>";
        // print_r( $all_games);

        if (isset($all_games) && !empty($all_games)) {


            // echo "<br>";
            // echo "all_games if con true";
            // echo "<br>";
            $flag_skipgame = 0;
            $skipgame_html = 1;
            foreach ($all_games as $key => $game) {


                $game_title         = $game->name;
                $gameType           = $game->gameType;
                $game_id            = $game->id;
                $providerGameId     = $game->providerGameId;
                $providerId         = $game->providerId;
                $providerName       = $game->providerName;
                $gameIcon           = $game->gameIcon;
                $serverUrl          = $game->serverUrl;
                $gameUrl            = $game->gameUrl;
                $isDemo             = $game->isDemo;
                $isFreemode         = $game->isFreemode;
                $alt_img            = $game_title . 'Slot Game';


                $providerSecret     = $game->providerSecret;
                $partnerClientId    = $game->partnerClientId;
                $disabledbycasino   = $game->disabledByCasino;


                if($type !== 'feature') {
                    if ($page == 'casino') {
                        if ($providerId == 6 || $providerId == 4 || $gameType == 'Virtual' || $gameType == 'OnlinePoker') {
                            $flag_skipgame = 1;
                            continue;
                        } else {
                            $flag_skipgame = 0;
                        }
                    } else {
                        if ($providerId == 6) {
                            $flag_skipgame = 1;
                            continue;
                        } else {
                            $flag_skipgame = 0;
                        }
                    }                    
                }

                if (($page === 'casino' && $type === 'feature') || ($page === 'main-page' && $type === 'feature')) {
                    if (stripos($game_title, 'Roulette Lobby') !== false || strpos($game_title, 'Blackjack Lobby') !== false) {
                        $flag_skipgame = 1;
                        continue;
                    }
                }

                $tvbet = '';
                // if ($providerId == 97) {
                //     $tvbet = '-is_tvbet';
                // }
                if (empty($gameIcon)) {
                    $gameIcon = site_url() . "/wp-content/themes/casino/assets/image/game_placeholder.png";
                }

                // echo "<br>";
                // echo "foreach loop :- ".$key." <--------------> disabledbycasino :- ".$disabledbycasino;
                // echo "<br>";

                if ($disabledbycasino == '') {

                    $skipgame_html = 0; ?>
                    <div class='game-img-box c430'>
                        <picture>
                            <source srcset="<?php echo $gameIcon; ?>" type="image/png">
                            <img src="<?php echo $gameIcon; ?>" alt="<?php echo $alt_img; ?>">
                            <div class='game-box-overlay'>
                                <!-- <h6>
                                    <span class='game-title'><?php echo $game_title; ?></span>
                                    <span class='sub-game-title'><?php echo $providerName; ?></span>
                                </h6> -->
                                <div class='game-link-wrap'>
                                    <?php
                                    if ('casino' === $page) {
                                        if ($isFreemode == 'true' && $isDemo == 1) {
                                            echo "<a href='javascript:void(0);' data-gameid='" . $game_id . "' data-provider='" . $providerId . "' data-providerGameId='" . $providerGameId . "' data-casino='" . $partnerClientId . "' data-token='" . $providerSecret . "' data-server= '" . $serverUrl . "' data-gameURL='" . $gameUrl . "' data-url='' data-mode='offline'  class='game-url play-url-agere-game" . $tvbet . "'>Free Play </a>";
                                        }
                                    } else if ('live' !== $page && $isDemo == 1) {
                                        echo "<a href='javascript:void(0);' data-gameid='" . $game_id . "' data-provider='" . $providerId . "' data-providerGameId='" . $providerGameId . "' data-casino='" . $partnerClientId . "' data-token='" . $providerSecret . "' data-server= '" . $serverUrl . "' data-gameURL='" . $gameUrl . "' data-url='' data-mode='offline'  class='game-url play-url-agere-game" . $tvbet . "'>Free Play </a>";
                                    }
                                    if (is_user_logged_in()) {
                                        echo "<a href='javascript:void(0);' data-url='' data-gameid='" . $game_id . "' data-provider='" . $providerId . "' data-providerGameId='" . $providerGameId . "' data-casino='" . $partnerClientId . "' data-token='" . $providerSecret . "' data-server= '" . $serverUrl . "' data-gameURL='" . $gameUrl . "' data-mode='online' data-type='" . $gameType . "' class='game-url play-url-agere-game" . $tvbet . "'>Real Money</a>";
                                    } ?>
                                </div>
                            </div>
                        </picture>
                        <h6>
                            <span class='game-title' data-no-translation><?php echo $game_title; ?></span>
                            <span class='sub-game-title' data-no-translation><?php echo $providerName; ?></span>
                        </h6>
                    </div>
<?php
                }
            }

            if ($flag_skipgame == 1) {
                if ($skipgame_html == 1) {

                    echo "skipgame";
                }
            }
        }
    } else {
        $game_count = 0;
    }
}

/** Admin Panel Function File  */
include get_template_directory() . '/admin/function.php';


// This theme uses wp_nav_menu() in one location.
register_nav_menus(
array(
    // 'menu-1' =>  esc_html__( 'Primary', 'rb-electrical-service' ),
    'footer' => esc_html__( 'Footer','casino'),
    'information' => esc_html__( 'Information','casino'),
)
);

add_action('wp_head', 'enqueue_ajax');
function enqueue_ajax(){ ?>
    <input type="hidden" id="ajaxurl" value="<?php echo admin_url('admin-ajax.php'); ?>">
<?php }


// change order status on thank you page
//add_action( 'woocommerce_thankyou', 'woocommerce_thankyou_change_order_status', 10, 1 );
function woocommerce_thankyou_change_order_status( $order_id ){
    if( ! $order_id ) return;

    $order = wc_get_order( $order_id );

    if( $order->get_status() == 'processing' ) 
    {
        $order->update_status( 'completed' );

    }
}


//add_action('woocommerce_order_status_changed', 'so_status_completed', 10, 3);

function so_status_completed($order_id, $old_status, $new_status)
{

    $order = wc_get_order($order_id);

    if($new_status=='processing' && $old_status == "pending")
    {
        $order->update_status( 'completed' );
    }
   
}
//add_action( 'woocommerce_order_status_processing', 'order_extracode1' );
function order_extracode1( $order_id) {
    $order = new WC_Order($order_id);
    $order_id=$order->get_id();
 // $amount = $order->get_formatted_order_total();
 $recharge_amount = apply_filters('woo_wallet_credit_purchase_amount', $order->get_subtotal('edit'),  $order_id);
  $user_id = $order->get_user_id(); 
  woo_wallet()->wallet->credit($user_id, $recharge_amount, 'Deposit -'.$order_id);
}



add_filter( 'cron_schedules', 'cron_add_weekly' );
 
 function cron_add_weekly( $schedules ) {
 	// Adds once weekly to the existing schedules.
 	$schedules['every_30'] = array(
 		'interval' => 30,
 		'display' => __( 'Every Half min' )
 	);
 	return $schedules;
 }

// change order status
 add_action("init", "set_order_cron");



 function set_order_cron()
 {
    add_action( 'woo_order_cron', 'fun_woo_order_cron' );

    if (! wp_next_scheduled ( 'woo_order_cron' )) {
		wp_schedule_event( time(), 'every_30', 'woo_order_cron' );
	}
    

 }
 add_action("init", "fun_woo_order_cron");
 function fun_woo_order_cron(){
    
    $query = new WC_Order_Query( array(
        'limit' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'return' => 'ids',
        'status' => array('wc-processing'),
    ) );
    $data = $query->get_orders();
    
    foreach($data  as $order_id)
    {   
        $order = wc_get_order( $order_id ); 
        $order_status =$order->get_status();
        
        $testObject = new Woo_Wallet_Wallet();
        $testObject->wallet_credit_purchase($order_id);
        $order->update_status( 'completed' );
       
        $total_amount = add_currency_symbol($order->get_total());
        $payment_method = $order->get_payment_method_title();
        $user = $order->get_user();
        $username = $user->user_login;;
        $email = $user->user_email;
        
        $from     = get_option('admin_email');
        $headers   = 'From: ' . $from . "\r\n";
        $subject   = "ご入金が完了しました.";
        $message   = '<div style="text-align:center;width: 74%;margin: 0 auto;"><p>'.$username .' 様,</p>
                      <p>ご入金が完了いたしました.</p>
                      <p>金額: '.$total_amount.'</p>
                      <p>方法: '.$payment_method.'</p></div>';
      
        wp_mail($email, $subject, $message, $headers);
    }

 }

function registration_response_modal( $title, $content ) { ?>
    <!-- Modal -->
    <div id="registration-popup" class="modal fade" role="dialog"data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                    <h4 class="modal-title"><?php echo $title; ?></h4>
                </div>
                <div class="modal-body">
                <p class='register-successful'><?php echo $content; ?></p>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default sec-btn" data-dismiss="modal">Close</button>
                </div> -->
            </div>

        </div>
    </div>

    <script>
        jQuery(window).load(function(){        
            jQuery('#registration-popup').modal('show');
            if($_GET['transfer-funds-status'] && $_GET['transfer-funds-status'] === 'success') {
                jQuery("#registration-popup").on('hide.bs.modal', function(){
                    const transferFundsUrl = window.location.origin + window.location.pathname;
                    window.location.replace(transferFundsUrl);
                });
            }
        });
    </script>
<?php }

function success_modal_footer() {
    if(isset($_GET['transfer-funds-status']) && $_GET['transfer-funds-status'] === 'success') {
        registration_response_modal("Transfer between accounts", "Amount transferred successfully!");
    }
}
add_action( 'wp_footer', 'success_modal_footer' );

/* Function which remove Plugin Update Notices – CryptAPI */
function disable_plugin_updates( $value ) {
    unset( $value->response['cryptapi-payment-gateway-for-woocommerce/CryptAPI.php'] );
    return $value;
}
add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );


add_action( 'user_register', 'user_register_email' );

function user_register_email($user_id){
 
    $user = get_userdata($user_id);
    $username = $user->user_login;
    $email = $user->user_email;
    
    $from     = get_option('admin_email');
    $headers   = 'From: ' . $from . "\r\n";
    $subject   = "Casinoterraへようこそ！";
    $message = '<p style="text-align:center;">'.$username.' 様,</p>';
    $message .= '<p>ご登録いただきまして誠にありがとうございます！<br>
    Casinoterraでは豊富なゲームをご用意しております.<br>
    お得なキャンペーン情報も随時お知らせします.</p>
    
    <p>ご不明な点などございましたら、カスタマーサポートまでお気軽にご連絡ください。</p>';
    
   
    wp_mail($email, $subject, $message, $headers);
}


function tranfer_fund_emails($user_id, $amount, $method = false, $type){
   
    $user = get_userdata($user_id);
    $username = $user->user_login;
    $email = $user->user_email;
   
    if($type === 'credit'){
      
        $content = 'ご入金が完了しました';

    }elseif($type === 'debit'){
       
        $content = 'ご出金が完了しました';
    }
    $from     = get_option('admin_email');
    $headers   = 'From: ' . $from . "\r\n";
    $subject   = $content;
    $message   = '<div style="text-align:center;width: 74%;margin: 0 auto;">
                    <p>'.$username .' 様,</p>
                    <p>'.$content.'</p>
                    <p>金額: '.add_currency_symbol($amount).'</p>';
    
    if ($method !== false) {
        $message .= "<p>方法: $method</p>";
    }

    $message .= '</div>';
   wp_mail($email, $subject, $message, $headers);
}

