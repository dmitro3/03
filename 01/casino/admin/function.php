<?php
global $permission_commissions, $sports_list, $casino_list, $poker_list, $current_user_player_child_player, $api_server_url;
$api_server_url = "https://api.agere.games";
$sports_list[0] = "Sports";
$casino_list[0] = "Casino";
$poker_list[0] = "Poker";
$permission_commissions[0] = "Sports";
$permission_commissions[1] = "Casino";
$permission_commissions[2] = "Poker";

function add_theme_scripts_admin()
{

	if ('casino-admin' === $page_slug) {
		wp_enqueue_script('cryptoloot-chart.min', get_template_directory_uri() . '/admin/assets/js/chart.min.js', array(), '25152515', true);
		wp_enqueue_script('cryptoloot-dashborad-chart', get_template_directory_uri() . '/admin/assets/js/dashborad-chart.js', array(), '25152515', true);
	}
	if ('agent-report' === $page_slug) {
		wp_enqueue_script('cryptoloot-mdb-min', get_template_directory_uri() . '/admin/assets/js/mdb-min.js', array(), '25152515', true);
		wp_enqueue_script('cryptoloot-global-reports', get_template_directory_uri() . '/admin/assets/js/global-reports.js', array(), '25152515', true);
	}
	if ('player-report' === $page_slug) {
		wp_enqueue_script('cryptoloot-mdb-min', get_template_directory_uri() . '/admin/assets/js/mdb-min.js', array(), '25152515', true);
		wp_enqueue_script('cryptoloot-player-global-reports', get_template_directory_uri() . '/admin/assets/js/player-global-reports.js', array(), '25152515', true);
	}
	if ('charges-and-withdrawals' === $page_slug || 'player-history' === $page_slug) {
		wp_enqueue_script('cryptoloot-mdb-min', get_template_directory_uri() . '/admin/assets/js/mdb-min.js', array(), '25152515', true);
		wp_enqueue_script('cryptoloot-file-reports', get_template_directory_uri() . '/admin/assets/js/file-reports.js', array(), '25152515', true);
	}


	if ('finance-agent-operation' === $page_slug || 'finance-players-operation' === $page_slug || 'finance-agent-balances' === $page_slug || 'finance-player-balances' === $page_slug || 'finance-players-withdrawal-request' === $page_slug) {
		wp_enqueue_script('cryptoloot-mdb-min', get_template_directory_uri() . '/admin/assets/js/mdb-min.js', array(), '25152515', true);
		wp_enqueue_script('cryptoloot-finance', get_template_directory_uri() . '/admin/assets/js/finance.js', array(), '25152515', true);
	}
	if ('casino-game-reports' === $page_slug || 'sports-game-reports' === $page_slug || 'poker-game-reports' === $page_slug) {
		wp_enqueue_script('cryptoloot-mdb-min', get_template_directory_uri() . '/admin/assets/js/mdb-min.js', array(), '25152515', true);
		wp_enqueue_script('cryptoloot-game-reports', get_template_directory_uri() . '/admin/assets/js/game-reports.js', array(), '25152515', true);
	}
	if ('finance-players-withdrawal-request' === $page_slug) {

		wp_enqueue_script('finanace-enqueue-script', get_template_directory_uri() . '/admin/assets/js/finance.js?' . time());
		$withdrawal_post_type_param = array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'security_nonce' => wp_create_nonce('woo-wallet-withdrawal-post-type-action'),
			'confirmation_message' => __('Are you sure you want to delete this request?', 'woo-wallet-withdrawal'),
			'error_message' => __('An error occurred, please check WooCommerce error log file.', 'woo-wallet-withdrawal')
		);
		wp_localize_script('finanace-enqueue-script', 'withdrawal_post_type_param', $withdrawal_post_type_param);
	}

	wp_enqueue_script('cryptoloot-mdb-min', get_template_directory_uri() . '/admin/assets/js/custom.js', array(), '25152515', true);
}

// add_action('wp_enqueue_scripts', 'add_theme_scripts_admin');

/**
 * Contact support add user id
 */
add_filter('shortcode_atts_wpcf7', 'custom_shortcode_atts_wpcf7_filter', 10, 3);
function custom_shortcode_atts_wpcf7_filter($out, $pairs, $atts)
{
	if (isset($atts['contact-support-user-id'])) $out['contact-support-user-id'] = $atts['contact-support-user-id'];
	return $out;
}

/** Custom User Filed Admin Start */
add_action('show_user_profile', 'crf_show_extra_profile_fields');
add_action('edit_user_profile', 'crf_show_extra_profile_fields');
function crf_show_extra_profile_fields($user)
{
	$user_info = get_userdata($user->ID);
	$user_role = "";
	$user_lock_unlock = 0;
	$user_hidden = 0;
	if (isset($user_info->roles[0]))        $user_role = $user_info->roles[0];
	global $permission_commissions, $sports_list, $casino_list, $poker_list;
	$full_name = get_the_author_meta('full_name', $user->ID);
	$phone = get_the_author_meta('phone', $user->ID);
	$document = get_the_author_meta('document', $user->ID);
	$user_permission = get_the_author_meta('user_play_permission', $user->ID);
	$user_commission = get_the_author_meta('user_game_commission', $user->ID);
	$parent_user = get_the_author_meta('parent_user', $user->ID);
	$user_lock_unlock = get_the_author_meta('user_block', $user->ID);
	$user_hidden = get_the_author_meta('user_hide', $user->ID);
	$user_permission_ck  = $user_commission_per = array();
	if (!empty($user_permission)) $user_permission_ck = explode(",", $user_permission);
	if (!empty($user_commission)) $user_commission_per = json_decode($user_commission, true); ?>
	<h3><?php esc_html_e('Personal Information', 'crf'); ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="full_name">Full Name</label></th>
			<td> <input type="text" id="full_name" name="full_name" value="<?php echo esc_attr($full_name); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="phone">Phone</label></th>
			<td><input type="text" id="phone" name="phone" value="<?php echo esc_attr($phone); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="document">Document</label></th>
			<td><input type="text" id="document" name="document" value="<?php echo esc_attr($document); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="permission">Permission</label></th>
			<td>
				<table>
					<tr>
						<?php
						if (!empty($permission_commissions) && isset($permission_commissions)) {
							foreach ($permission_commissions as $key => $list) {
								$slug = strtolower($list); ?>
								<td>
									<label><input type="checkbox" name="permission[]" value="<?php echo $slug; ?>" <?php if (in_array($slug, $user_permission_ck)) {
																														echo 'checked';
																													} ?> class="regular-text" /><b><?php echo $list; ?></b></label>
								</td>
						<?php
							}
						} ?>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th><label for="permission">Commissions</label></th>
			<td>
				<table class="commissions-table">
					<?php
					if (!empty($permission_commissions) && isset($permission_commissions)) {
						foreach ($permission_commissions as $key => $list) {
							$slug = strtolower($list);
					?>
							<tr>
								<td><b><?php echo $list; ?></b></td>
								<td><input type="number" name="commission[<?php echo $slug; ?>]" value="<?php echo $user_commission_per[$slug]; ?>" step=".01" class="form_input"></td>
							</tr>
					<?php
						}
					}
					?>
				</table>
			</td>
		</tr>
		<tr>
			<th><label for="parent_user">Parent User</label></th>
			<td>
				<select name="parent_user" class="form_input">
					<option value=''>Select User</option>
					<?php
					$all_users = get_users(array('fields' => array('ID')));
					if (isset($all_users) && !empty($all_users)) {
						foreach ($all_users as $key => $user_info) {
					?>
							<option <?php if ($parent_user == $user_info->ID) {
										echo 'selected';
									} ?> value="<?php echo $user_info->ID; ?>"><?php echo $user_info->ID; ?></option>
					<?php
						}
					}
					?>
				</select>

			</td>
		</tr>
		<tr>
			<th><label for="contact">Lock / Unlock</label></th>
			<td>
				<label class="button" for="user_lock"><input type="radio" <?php if ($user_lock_unlock == 1) {
																				echo 'checked';
																			} ?> name="user_lock_unlock" value="1" id="user_lock"><span>Lock</span><span class="dashicons dashicons-lock" style="padding-top: 3px;"></span></label>
				<label class="button" for="user_unlock"><input type="radio" <?php if ($user_lock_unlock == 0) {
																				echo 'checked';
																			} ?> name="user_lock_unlock" value="0" id="user_unlock"><span>Un Lock</span><span class="dashicons dashicons-unlock" style="padding-top: 3px;"></span></label>
			</td>
		</tr>
		<tr>
			<th><label for="contact">Hide / Unhide </label></th>
			<td>
				<label class="button" for="user_visibility"><input type="radio" <?php if ($user_hidden == 1) {
																					echo 'checked';
																				} ?> name="user_hidden" value="1" id="user_visibility"><span>Hide</span><span class="dashicons dashicons-visibility" style="padding-top: 3px;"></span></label>
				<label class="button" for="user_hide"><input type="radio" <?php if ($user_hidden == 0) {
																				echo 'checked';
																			} ?> name="user_hidden" value="0" id="user_hide"><span>unhide</span><span class="dashicons dashicons-hidden" style="padding-top: 3px;"></span></label>
			</td>
		</tr>

	</table>
	<?php
}

if (!function_exists('add_currency_symbol')) {
	function add_currency_symbol($amount)
	{
		$currency_symbol = get_woocommerce_currency_symbol(get_option('woocommerce_currency'));
		$negative = 0 > $amount ? "-{$currency_symbol}" : $currency_symbol;
		return $amount !== '' || $amount !== null ? $negative . abs($amount) : '';
	}
}

add_action('personal_options_update', 'crf_update_profile_fields');
add_action('edit_user_profile_update', 'crf_update_profile_fields');
function crf_update_profile_fields($user_id)
{
	if (!empty($_POST['full_name'])) {
		update_user_meta($user_id, 'full_name', $_POST['full_name']);
	}
	if (!empty($_POST['phone'])) {
		update_user_meta($user_id, 'phone', intval($_POST['phone']));
	}
	if (!empty($_POST['document'])) {
		update_user_meta($user_id, 'document', $_POST['document']);
	}
	if (isset($_POST['permission']) && !empty($_POST['permission'])) {
		$permission = implode(",", $_POST['permission']);
		update_user_meta($user_id, 'user_play_permission', $permission);
	}
	if (isset($_POST['commission']) && !empty($_POST['commission'])) {
		$commission = json_encode($_POST['commission'], JSON_NUMERIC_CHECK);
		update_user_meta($user_id, 'user_game_commission', $commission);
	}
	if (!empty($_POST['parent_user'])) {
		update_user_meta($user_id, 'parent_user', $_POST['parent_user']);
	}
	if (isset($_POST['user_lock_unlock'])) {
		update_user_meta($user_id, 'user_block', $_POST['user_lock_unlock']);
	}
	if (isset($_POST['user_hidden'])) {
		update_user_meta($user_id, 'user_hide', $_POST['user_hidden']);
	}
	backend_user_create($user_id);
}
/** Custom User Filed Admin End */
/** Agent and Admin Login Ajax */
add_action('wp_ajax_casino_admin_login', 'casino_player_agent_admin_login');
add_action('wp_ajax_nopriv_casino_admin_login', 'casino_player_agent_admin_login');
function casino_player_agent_admin_login()
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user_info = get_user_by('login', $username);
	if (!$user_info) {
		$user_info = get_user_by('email', $username);
	}
	if ($user_info) {
		$user_id = $user_info->ID;
		if (wp_check_password($password, $user_info->user_pass, $user_id)) {
			if ($user_info->roles[0] == "administrator" || $user_info->roles[0] == "agent") {
				wp_set_auth_cookie($user_id, $user_remember);
				wp_set_current_user($user_id, $user_login);
				do_action('wp_login', $user_login, get_userdata($user_id));
				echo 1;
			} else {
				echo 'The username and password you entered is incorrect.';
			}
		} else {
			echo 'The password you entered is incorrect.';
		}
	} else {
		echo 'The username you entered is incorrect.';
	}
	die;
}
/** Dashbord Chart Ajax Data */
add_action('wp_ajax_dashbord_chart_ajax', 'dashbord_chart_ajax_data');
add_action('wp_ajax_nopriv_dashbord_chart_ajax', 'dashbord_chart_ajax_data');
function dashbord_chart_ajax_data()
{
	global $api_server_url;
	$agere_casino_id = get_field('agere_casino_id', 'option');
	$agere_token = get_field('agere_token', 'option');
	$user_api_id = site_url() . "/_" . get_current_user_id();
	$netincome_api = $api_server_url . "/casinos/casino-admin-reports?action=netIncome&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $user_api_id;
	$netincome_api_data = file_get_contents($netincome_api);
	if (isset($netincome_api_data) && !empty($netincome_api_data)) {
		$netincome_data = json_decode($netincome_api_data, true);
		$totalCommission_curmonth = $totalCommission_lastmonth = 0;
		if (isset($netincome_data['commissionInfo']) && isset($netincome_data['commissionInfo']['topAgent'])) {
			$top_agent = $netincome_data['commissionInfo']['topAgent'];
			$user_info = get_userdata($top_agent['agent']);
			if (isset($user_info) && !empty($user_info)) {
				$username = $user_info->user_login;
			} else {
				$username = $top_agent['agent'];
			}
			$top_agent_data = array(
				0 => array(
					'label' => $username,
					'value' => $top_agent['commission'],
				)
			);
		}
	}
	$daily_netwin = $api_server_url . "/casinos/casino-admin-reports?action=daily-netwin&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $user_api_id;
	$daily_netwin_data = file_get_contents($daily_netwin);
	$daily_netwin_data = json_decode($daily_netwin_data, true);
	$dailyNetwin = $daily_netwin_data['data'];
	$dailyNetwin_array = array();
	if (isset($dailyNetwin) && !empty($dailyNetwin)) {
		foreach ($dailyNetwin as $key => $netwin) {
			$old_date_timestamp = strtotime($netwin['day']);
			$new_date = date('d-M', $old_date_timestamp);
			$dailyNetwin_array[$key] =  array(
				'label' => $new_date,
				'value' => $netwin['netwinIncome'],
			);
		}
	}
	$monthly_netwin_api = $api_server_url . "/casinos/casino-admin-reports?action=monthly-netwin&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $user_api_id;
	$monthly_netwin_result = file_get_contents($monthly_netwin_api);
	$monthly_netwin_alldata = json_decode($monthly_netwin_result, true);
	$Netwin_monthly = array();
	if (isset($monthly_netwin_alldata) && isset($monthly_netwin_alldata['data'])) {
		$monthly_netwin_data = $monthly_netwin_alldata['data'];
		foreach ($monthly_netwin_data as $key => $data) {
			$Netwin_monthly[] =  array(
				'label' => $data['monthName'],
				'value' => $data['netwinIncome'],
			);
		}
	}
	$chart_data = array(
		'Netwin' => array_reverse($Netwin_monthly),
		'NetwinDaily' =>
		array(
			'data' => array_reverse($dailyNetwin_array),
			'last_update' => 1652162672,
		),
		'TopAffiliates' =>
		array(
			'data' => $top_agent_data
		),
	);
	echo json_encode($chart_data);
	die;
}
/** dashboard_balance_action */
add_action('wp_ajax_dashboard_balance_action', 'balance_transaction_function');
add_action('wp_ajax_nopriv_dashboard_balance_action', 'balance_transaction_function');
function balance_transaction_function()
{
	$balance_action = $_POST['bal_action'];
	$username = $_POST['username'];
	if (username_exists($username)) {
		$user_args['search'] = $username;
		$user_args['search_columns'] = array('user_login');
		$user_args['fields'] = array('ID', 'display_name');
		$sort_users = get_users($user_args);

		if (isset($sort_users) && !empty($sort_users)) {
			$user_id =  $sort_users[0]->ID;
			echo $user_id;
		} else {
			echo 0;
		}
	} else {
		echo 0;
	}
	die;
}

/**
 * Contact Support Form
 */
add_action('wp_ajax_contact_support_form', 'contact_support_form');
add_action('wp_ajax_nopriv_contact_support_form', 'contact_support_form');
function contact_support_form()
{
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$files = $_FILES['files'];

	if (isset($files) && !empty($files)) {
		$image_array = array();
		foreach ($files['name'] as $key => $value) {
			$image_allowed = array('png', 'jpg', 'jpeg');
			$extension = pathinfo($files['name'][$key], PATHINFO_EXTENSION);

			if ($files['error'][$key] != 0) {
				echo json_encode(array(
					'response' => 'error',
					'message'  => $files['error'][$key]
				));
				exit;
			}

			if (!in_array($extension, $image_allowed)) {
				echo json_encode(array(
					'response' => 'error',
					'message'  => 'Image file must be JPG, PNG or JPEG'
				));
				exit;
			}

			if ($files['size'][$key] / 1024 / 1024 > 4) {
				echo json_encode(array(
					'response' => 'error',
					'message'  => 'Maximum file upload size is 4 MB'
				));
				exit;
			}
		}

		if (!function_exists('wp_handle_upload')) require_once(ABSPATH . 'wp-admin/includes/file.php');
		$UploadDirectory = WP_CONTENT_DIR . '/uploads/casino-contact-support/';

		foreach ($files['tmp_name'] as $value) {
			$random_digits = rand(000000, 999999);
			$image_name = get_current_user_id() . "-{$random_digits}-" . current_time('timestamp') . ".{$extension}";
			move_uploaded_file($value, $UploadDirectory . $image_name);
		}
	}

	echo json_encode(array(
		'response'  => 'success'
	));

	exit;
}

function generateString($n = 8)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$characters_length = strlen($characters);
	$randomString = '';

	for ($i = 0; $i < $n; $i++) {
		$randomString .= $characters[rand(0, $characters_length - 1)];
	}

	return $randomString;
}

/**
 * Create Referral Link
 */
add_action('wp_ajax_create_referral_link', 'create_referral_link');
add_action('wp_ajax_no_priv_create_referral_link', 'create_referral_link');
function create_referral_link()
{
	$commission = $_POST['referralCommission'];
	$settlementType = $_POST['settlement_type'];

	
	$link = trim(str_replace(array(' ', '&'), array('-', '-'), $_POST['referralLink']));
	$user_id = get_current_user_id();
	
	// $meta = get_user_meta($user_id, 'referral_commission', true);
	// print_r($meta);
	// exit;

	$my_commission =  get_user_meta($user_id, 'user_game_commission', true);
	$my_commission = isset($my_commission) ? json_decode($my_commission) : 0;

	if ($commission >= $my_commission->casino) {
		$my_commission = (empty($my_commission->casino)) ? '0' : $my_commission->casino;

		$response = array(
			'response'  => false,
			'message'   => "You can't enter commission more than {$my_commission}%",
		);
	} else {
		$update_commission = array();
		$user_referrals = get_user_meta($user_id, 'referral_commission', true);

		// echo '<pre>';
		// print_r($user_referrals);
		// echo '</pre>';

		if (isset($user_referrals) && !empty($user_referrals)) {
			$update_commission = $user_referrals;

			$exists = false;
			if (isset($update_commission[$link]) && $update_commission[$link] !== FALSE) {
				$exists = true;
				$link = $update_commission[$link]['commission'];
			} else {
				// $update_commission[$link] = $commission;
				$update_commission[$link]['commission'] = $commission;
				$update_commission[$link]['settlement'] = $settlementType;
			}
		} else {
			$update_commission[$link]['commission'] = $commission;
			$update_commission[$link]['settlement'] = $settlementType;
		}

		$referral_link = site_url("/refer/?user={$user_id}&referral={$link}");

		$response = array(
			'response'  => true
		);

		if ($exists) {
			$response['message']    = 'Referral link is already generated, You can generate more links by adding unique characters in the <strong>Referral Link</strong> field';
			$response['status']     = 'exists';
		} else {
			update_user_meta($user_id, 'referral_commission', $update_commission);
			$response['message']    = 'Referral link generated successfully';
			$response['status']     = 'generated';
			$response['data']       = $referral_link;
		}
	}

	echo json_encode($response);
	exit;
}

/** Add New User */
add_action('wp_ajax_add_new_user', 've_register_new_user');
add_action('wp_ajax_nopriv_add_new_user', 've_register_new_user');
function ve_register_new_user()
{
	$formdata = $_POST['formdata'];
	$user_role = $_POST['userrole'];
	parse_str($formdata);
	$username =  $username;
	$password = $password;
	$fullname = $fullname;
	$document = $document;
	$user_email = $user_email;
	$phone = $phone;
	$permission = array('casino');

	$commission = $commission;
	$parent_user = $parent_user;
	$settlement_type = $settlement_type;

	$userdata = array(
		'user_login'            => $username,
		'user_email'            => $user_email,
		'user_pass'             => $password,
		'role'                  => $user_role
	);

	$user_data = wp_insert_user($userdata);

	if (!isset($user_data->errors)) {
		$user_id = $user_data;
		if (!empty($fullname)) {
			update_user_meta($user_id, 'full_name', $fullname);
		}
		if (!empty($phone)) {
			update_user_meta($user_id, 'phone', intval($phone));
		}
		if (!empty($document)) {
			update_user_meta($user_id, 'document', $document);
		}
		if (isset($permission) && !empty($permission)) {
			$permission = implode(",", $permission);
			update_user_meta($user_id, 'user_play_permission', $permission);
		}
		if (isset($commission) && !empty($commission)) {
			$commission = json_encode($commission, JSON_NUMERIC_CHECK);
			update_user_meta($user_id, 'user_game_commission', $commission);
		}
		if (!empty($parent_user)) {
			update_user_meta($user_id, 'parent_user', $parent_user);
		}
		if (!empty($settlement_type)) {
			update_user_meta($user_id, 'settlement_type', $settlement_type);
		}
		update_user_meta($user_id, 'user_hide', 0);

		$from     = get_option('admin_email');
		$headers   = 'From: ' . $from . "\r\n";
		$subject   = "Registration successful as a $user_role";
		$message   = "Registration successful.\nYour login details\nUsername: $username\nPassword: $password";

		// Email password and other details to the user
		wp_mail(strtolower($user_email), $subject, $message, $headers);

		echo $user_id;
		backend_user_create($user_id);
	} else {
		echo json_encode($user_data);
	}
	die;
}
/** User page user data table ajax call */
add_action('wp_ajax_user_datatabel_data', 'user_datatabel_data_callback');
add_action('wp_ajax_nopriv_user_datatabel_data', 'user_datatabel_data_callback');
function user_datatabel_data_callback()
{
	global $api_server_url;
	$agere_casino_id = get_field('agere_casino_id', 'option');
	$agere_token     = get_field('agere_token', 'option');
	$rowperpage      = $_POST['length'];
	$start           = $_POST['start'];
	$draw            = $_POST['draw'];
	$sort_tab        = $_POST['sort_tab'];
	$current_user    = $_POST['current_user'];
	$searchByName    = $_POST['search']['value'];
	$user_remote_id  = site_url("/_{$current_user}");
	$user_args = array();
	$user_args_page = array();
	if (isset($searchByName) && !empty($searchByName)) {
		$searchByName = $searchByName . "*";
	}
	if (empty($sort_tab)) {
		$sort_tab = "everyone";
	}

// 	$adminBulkBalanceUsers = "{$api_server_url}/casinos-admin/api?action=adminBulkBalanceUsers&remote_id={$user_remote_id}&token={$agere_token}&casino={$agere_casino_id}";

// echo '<pre>'; print_r( $adminBulkBalanceUsers ); echo '</pre>';

// 	$all_user_balance = file_get_contents($adminBulkBalanceUsers);
// 	$all_user_balance = json_decode($all_user_balance);
// 	$user_balance = array();
// 	foreach ($all_user_balance as $value) {
// 		$user_balance[$value->remoteId] = $value->balance;
// 	}
    $user_balance = get_all_user_balance('multiple');

	$cu_user_agent = array($current_user);
	$get_data_user_role = array('agent', 'player');
	$all_agent_data_level = get_current_agent_and_admin_user($current_user, $cu_user_agent, $get_data_user_role);

	// Create 1 level childern IDs
	$all_agent_data = [];
	foreach ($all_agent_data_level as $user_data)
		if ($current_user === get_user_meta($user_data, 'parent_user', true))
			$all_agent_data[] = $user_data;

	$user_args['number'] = $rowperpage;
	$user_args['offset'] = $start;
	$user_args['fields'] = array('ID', 'display_name');
	$user_args_page['fields'] = array('ID', 'display_name');

	$totalRecords = 0;
	$totalRecordwithFilter = 0;
	if (!empty($all_agent_data)) {
		// $all_agent_data = $cu_user_agent;
		$user_args['include'] = $all_agent_data;
		$user_args_page['include'] = $all_agent_data;

		// $user_args['meta_key'] = 'parent_user';
		// $user_args['meta_value'] = $all_agent_data;
		// // $user_args['meta_value'] = $current_user;
		// $user_args['meta_compare'] = 'IN';   
		// $user_args_page['meta_key'] = 'parent_user';
		// $user_args_page['meta_value'] = $all_agent_data;
		// // $user_args_page['meta_value'] = $current_user;
		// $user_args_page['meta_compare'] = 'IN';   

		// $user_hidden = get_the_author_meta('user_hide',112);
		if (isset($searchByName) && !empty($searchByName)) {
			$user_args['search'] = $searchByName;
			$user_args['search_columns'] = array('user_login');
			$user_args_page['search'] = $searchByName;
			$user_args_page['search_columns'] = array('user_login');
		}
		if (isset($sort_tab) && !empty($sort_tab)) {
			// echo $sort_tab;
			if ($sort_tab == 'player' || $sort_tab == 'agent') {

				$user_args['meta_key'] = 'user_hide';
				$user_args['meta_value'] = 0;
				$user_args['meta_compare'] = '=';
				$user_args_page['meta_key'] = 'user_hide';
				$user_args_page['meta_value'] = 0;
				$user_args_page['meta_compare'] = '=';

				$user_args['role__in'] =  array($sort_tab);
				$user_args_page['role__in'] =  array($sort_tab);
			} elseif ($sort_tab == "hidden") {
				$user_args['meta_key'] = 'user_hide';
				$user_args['meta_value'] = 1;
				$user_args['meta_compare'] = '=';
				$user_args_page['meta_key'] = 'user_hide';
				$user_args_page['meta_value'] = 1;
				$user_args_page['meta_compare'] = '=';

				// if($sort_tab == "everyone") {
				//     $user_args['role__in'] =  array('agent','player');
				//     $user_args_page['role__in'] =  array('agent','player');
				// }
			} elseif ($sort_tab == "everyone") {

				$user_args['meta_key'] = 'user_hide';
				$user_args['meta_value'] = 0;
				$user_args['meta_compare'] = '=';
				$user_args_page['meta_key'] = 'user_hide';
				$user_args_page['meta_value'] = 0;
				$user_args_page['meta_compare'] = '=';
				$user_args['role__in'] =  array('agent', 'player');
				$user_args_page['role__in'] =  array('agent', 'player');
			}
		}
		$all_users = get_users($user_args_page);
		$all_users_count = count($all_users);
		$sort_users = get_users($user_args);
		$i = 1;
		$totalRecords = $all_users_count;
		$totalRecordwithFilter = $all_users_count;
	}

	foreach ($sort_users as $user) {
		$user_lock_unlock = 0;
		$user_hidden = 0;
		$user_lock_unlock = get_the_author_meta('user_block', $user->ID);
		$user_hidden = get_the_author_meta('user_hide', $user->ID);

		if ($user_lock_unlock == 1) {
			$unlock_user_modal_name = 'user_unlock';
			$lock_icon_class = "fal fa-lock";
			$lock_title = "Unlock";
		} else {
			$unlock_user_modal_name = 'to_lock_popup';
			$user_lock_unlock = 0;
			$lock_icon_class = "fal fa-unlock";
			$lock_title = "Lock";
		}
		if ($user_hidden == 1) {
			$hide_user_modal_name = 'user_unhide';
			$hide_icon_class = "fal fa-eye-slash";
			$hide_title = "Show";
		} else {
			$hide_user_modal_name = 'user_hide';
			$hide_icon_class = "fal fa-eye";
			$hide_title = "Hide";
		}
		$user_info = get_userdata($user->ID);
		$user_role = "";
		if (isset($user_info->roles[0])) $user_role = $user_info->roles[0];

		$current_user_info = get_userdata(get_current_user_id());
		$casino_admin =  get_user_meta(get_current_user_id(), 'casino_admin', true);

		if ((isset($casino_admin) && !empty($casino_admin) && $casino_admin == 1) || $current_user_info->roles[0] === 'administrator') {

			$action_html = '<div class="table_btn_group"><ul><li><button data-user-id="' . $user->ID . '" type="button" class="sec-btn icon_btn modal-html-btn" data-button-toggle="tooltip" title="Add credits" data-target="add_credit_modal" tabindex="0"><i class="far fa-plus"></i></button></li><li><button data-user-id="' . $user->ID . '" type="button" class="sec-btn icon_btn modal-html-btn" data-button-toggle="tooltip" title="Remove credits"  data-target="add_debit_modal"><i class="far fa-minus"></i></button></li></ul></div>';

			$info_html = '<div class="table_btn_group"><ul><li><button data-user-id="' . $user->ID . '" type="button" class="sec-btn icon_btn modal-html-btn" data-button-toggle="tooltip" title="Information" data-target="user_information_Modal" ><i class="fal fa-info"></i></button></li><li><button data-user-id="' . $user->ID . '" type="button" class="sec-btn icon_btn modal-html-btn" data-button-toggle="tooltip" title="Change Password" data-target="change_password"><i class="fal fa-key"></i></button></li><li><button data-user-id="' . $user->ID . '" type="button" class="sec-btn icon_btn modal-html-btn" data-button-toggle="tooltip" data-target="modify_popup_' . $user_role . '" title="Edit"><i class="fal fa-user-edit"></i></button></li><li><button data-user-id="' . $user->ID . '" type="button" class="sec-btn icon_btn modal-html-btn" data-button-toggle="tooltip" data-target="' . $unlock_user_modal_name . '" title="' . $lock_title . '"><i class="' . $lock_icon_class . '"></i></button></li><li><button data-user-id="' . $user->ID . '" type="button" data-target="' . $hide_user_modal_name . '" class="sec-btn icon_btn modal-html-btn" data-button-toggle="tooltip" title="' . $hide_title . '"><i class="' . $hide_icon_class . '"></i></button></li></ul></div>';
		} else {
			$action_html = '';
			$info_html = '';
		}


		// $balance = woo_wallet()->wallet->get_wallet_balance($user->ID);
		// $balance = $user_balance[$user->ID];
        $balance = add_currency_symbol($user_balance[$user->ID]['balance']);

		$user_data = array('name' => $user->display_name, "role" => $user_role);
		$data[] = array(
			"user_id" => $balance,
			"username" => $user_data,
			"action" => $action_html,
			"info" => $info_html,
			"user_role" => $user_role
		);
		$i++;
	}
	$response = array(
		"draw" => intval($draw),
		"iTotalRecords" => $totalRecords,
		"iTotalDisplayRecords" => $totalRecordwithFilter,
		"aaData" => $data
	);
	echo json_encode($response);
	die;
}

/** withdrawal request  data table ajax call */
add_action('wp_ajax_withdrawal_request_datatabel_data', 'withdrawal_request_datatabel_data_callback');
add_action('wp_ajax_nopriv_withdrawal_request_datatabel_data', 'withdrawal_request_datatabel_data_callback');
function withdrawal_request_datatabel_data_callback()
{
	$length     = $_POST['length'];
	$start          = $_POST['start'];

	$cu_user_agent = array(get_current_user_id());
	$get_data_user_role = array('player', 'agent');
	$AUTHOR = get_current_agent_and_admin_user(get_current_user_id(), $cu_user_agent, $get_data_user_role);

	$the_query = new WP_Query(array('post_type' => 'wallet_withdrawal', 'posts_per_page' => -1/*, 'author__in' => $AUTHOR */));


	if ($the_query->have_posts()) {
		$i = 0;
		while ($the_query->have_posts()) {

			$the_query->the_post();
			$user_meta = get_user_meta(get_post_field('post_author', get_the_ID()));
			$user_data = get_userdata($the_query->posts[$i]->post_author);
			$post_meta = get_post_meta(get_the_ID());




			$username = $user_meta['nickname'][0] . '(#' . $the_query->posts[$i]->post_author . ' - ' . $user_data->data->user_email . ')';
			$current_user_info = get_userdata(get_current_user_id());

			$amount = $post_meta['_wallet_withdrawal_amount'][0];
			$charge = $post_meta['_wallet_withdrawal_transaction_charge'][0];
			$status = str_replace('ww-', '', get_post_status());
			$crypto_methods = isset($post_meta['_withdrawal_cryptocurrency_method'][0]) ? ' - ' . $post_meta['_withdrawal_cryptocurrency_method'][0] : '';
			$method = $post_meta['_wallet_withdrawal_method'][0] . $crypto_methods;
			$action_html = '';

			$casino_admin =  get_user_meta(get_current_user_id(), 'casino_admin', true);

			if ((isset($casino_admin) && !empty($casino_admin) && $casino_admin == 1) || $current_user_info->roles[0] === 'administrator') {

				if ($status === 'cancelled') {
					$action_html = '<td data-colname="Actions">
						<div class="table_btn_group">
							<ul>
								<li>
									<button data-user-id="' . get_the_ID() . '" type="button"  class="modal-html-btn sec-btn icon_btn" data-target="get_woo_wallet_withdrawal_details_Modal"><i class="fal fa-eye"></i></button>
								</li>
								
								<li>
									<button data-post_id="' . get_the_ID() . '" type="button" class="woo_wallet_withdrawal_action sec-btn icon_btn" data-action="pending" data-button-toggle="tooltip" title="pending"><i class="fad fa-thumbtack"></i></i></button>
								</li>
								<li>
									<button data-post_id="' . get_the_ID() . '" type="button" class="woo_wallet_withdrawal_action sec-btn icon_btn"  data-action="delete"   
										data-button-toggle="tooltip" title=""><i class="fal fa-trash"></i></button>
								</li>
					
							</ul>
						</div>
					</td>';
				} elseif ($status === 'pending') {
					$action_html = '<td data-colname="Actions">
						<div class="table_btn_group">
							<ul>
								<li>
									<button data-user-id="' . get_the_ID() . '" type="button"  class="modal-html-btn sec-btn icon_btn" data-target="get_woo_wallet_withdrawal_details_Modal"><i class="fal fa-eye"></i></button>
								</li>
								<li>
									<button data-post_id="' . get_the_ID() . '"  type="button" class="woo_wallet_withdrawal_action sec-btn icon_btn" data-action="approve" data-button-toggle="tooltip" title=""><i class="fal fa-check"></i></button>
								</li>
								<li>
									<button data-post_id="' . get_the_ID() . '" type="button" class="woo_wallet_withdrawal_action sec-btn icon_btn" data-action="reject" data-button-toggle="tooltip" title="reject"><i class="fal fa-times"></i></button>
								</li>
								
							</ul>
						</div>
					</td>';
				} elseif ($status === 'unverified') {
					$action_html = '<td data-colname="Actions">
						<div class="table_btn_group">
							<ul>
								<li>
									<button data-user-id="' . get_the_ID() . '" type="button"  class="modal-html-btn sec-btn icon_btn" data-target="get_woo_wallet_withdrawal_details_Modal"><i class="fal fa-eye"></i></button>
								</li>
								<li>
									<button data-post_id="' . get_the_ID() . '" type="button" class="woo_wallet_withdrawal_action sec-btn icon_btn" data-action="reject" data-button-toggle="tooltip" title="reject"><i class="fal fa-times"></i></button>
								</li>
								<li>
									<button data-post_id="' . get_the_ID() . '" type="button" class="woo_wallet_withdrawal_action sec-btn icon_btn" data-action="pending" data-button-toggle="tooltip" title="pending"><i class="fad fa-thumbtack"></i></i></button>
								</li>
								<li>
									<button data-post_id="' . get_the_ID() . '" type="button" class="woo_wallet_withdrawal_action sec-btn icon_btn"  data-action="delete"   
										data-button-toggle="tooltip" title=""><i class="fal fa-trash"></i></button>
								</li>
					
							</ul>
						</div>
					</td>';
				} elseif ($status === 'approved') {
					$action_html = '<td data-colname="Actions">
						<div class="table_btn_group">
							<ul>
								<li>
									<button data-user-id="' . get_the_ID() . '" type="button"  class="modal-html-btn sec-btn icon_btn" data-target="get_woo_wallet_withdrawal_details_Modal"><i class="fal fa-eye"></i></button>
								</li>
								
								<li>
									<button data-post_id="' . get_the_ID() . '" type="button" class="woo_wallet_withdrawal_action sec-btn icon_btn"  data-action="delete"   
										data-button-toggle="tooltip" title=""><i class="fal fa-trash"></i></button>
								</li>
					
							</ul>
						</div>
					</td>';
				}
			} else {
				$action_html = '<td data-colname="Actions">
									<div class="table_btn_group">
										<ul>
											<li>
												<button data-user-id="' . get_the_ID() . '" type="button"  class="modal-html-btn sec-btn icon_btn" data-target="get_woo_wallet_withdrawal_details_Modal"><i class="fal fa-eye"></i></button>
											</li>
										</ul>
									</div>
								</td>';
			}
			$data[] = array(
				"username" => $username,
				"amount" => wc_price($amount, array('currency' => $currency)),
				"gateway" => wc_price($charge, array('currency' => $currency)),
				"status" => $status,
				"method" => $method,
				"date" => get_the_date() . ' ' . get_the_time(),
				"action" => $action_html,
			);
			$i++;
		}
	}

	$data = array_slice($data, $start, $length);

	$response = array(
		"draw" => intval($_POST['draw']),
		"iTotalRecords" => $the_query->found_posts,
		"iTotalDisplayRecords" => $the_query->found_posts,
		"aaData" => $data
	);
	wp_reset_postdata();

	echo json_encode($response);
	die;
}



/** Change User Password Ajax */
add_action('wp_ajax_change_user_password', 'change_password_ajax_function');
add_action('wp_ajax_nopriv_change_user_password', 'change_password_ajax_function');
function change_password_ajax_function()
{
	$new_password = $_POST['new_password'];
	$user_id = $_POST['user_id'];
	$userdata = get_userdata($user_id);
	if (isset($userdata) && !empty($userdata)) {
		wp_set_password($new_password, $user_id);
		echo 0;
	} else {
		echo 1;
	}
	die;
}

/** Edit Player and Agent  */
add_action('wp_ajax_edit_user_information', 'edit_player_agent_information');
add_action('wp_ajax_nopriv_edit_user_information', 'edit_player_agent_information');
function edit_player_agent_information()
{
	$formdata = $_POST['formdata'];
	$user_role = $_POST['userrole'];

	parse_str($formdata);
	$user_id = $user_id;
	$fullname = $fullname;
	$document = $document;
	$user_email = $user_email;
	$phone = $phone;
	$permission = array('casino');

	$commission = $commission;
	$parent_user = $parent_user;
	$settlement_type = $settlement_type;
	$exists = email_exists($user_email);
	if ($exists != $user_id && !empty($exists)) {
		echo "That E-mail is already registered.";
	} else {
		$args = array(
			'ID'         => $user_id,
			'user_email' => esc_attr($user_email)
		);
		wp_update_user($args);
		if (!empty($fullname)) {
			update_user_meta($user_id, 'full_name', $fullname);
		}
		if (!empty($phone)) {
			update_user_meta($user_id, 'phone', intval($phone));
		}
		if (!empty($document)) {
			update_user_meta($user_id, 'document', $document);
		}
		if (isset($permission) && !empty($permission)) {
			$permission = implode(",", $permission);
			update_user_meta($user_id, 'user_play_permission', $permission);
		}
		if (isset($commission) && !empty($commission)) {
			$commission = json_encode($commission, JSON_NUMERIC_CHECK);
			update_user_meta($user_id, 'user_game_commission', $commission);
		}
		if (!empty($settlement_type)) {
			update_user_meta($user_id, 'settlement_type', $settlement_type);
		}
		echo 1;
		backend_user_create($user_id);
	}
	die;
}
/** User block  */
add_action('wp_ajax_user_block', 'user_block_callback');
add_action('wp_ajax_nopriv_user_block', 'user_block_callback');
function user_block_callback()
{
	$user_id = $_POST['user_id'];
	$user_block_reason = $_POST['user_block_reason'];
	update_user_meta($user_id, 'user_block', 1);
	if (isset($user_block_reason) && !empty($user_block_reason)) {
		update_user_meta($user_id, 'user_block_reason', $user_block_reason);
	}
}
/** All page usermap sidebar include hidden user ajax  */
add_action('wp_ajax_get_user_map_html', 'get_sidebar_user_map_html');
add_action('wp_ajax_nopriv_get_user_map_html', 'get_sidebar_user_map_html');
function get_sidebar_user_map_html()
{
	$user_id = $_POST['user_id'] == '' ? get_current_user_id() : $_POST['user_id'];
	$user_hide = $_POST['user_hide'];
	$cu_user_agent = array();
	$agent_data_with_child = get_curren_user_data_with_child_array($user_id, $cu_user_agent, $user_hide);
	$agent_data_with_child = array($user_id =>  $agent_data_with_child);
	if (isset($agent_data_with_child) && !empty($agent_data_with_child)) {
		foreach ($agent_data_with_child as $user_id => $value) {
			$user_info  = get_userdata($user_id);
			if (empty($value)) { ?>
				<li><a href="javascript:void(0);" data-user="<?php echo $user_id; ?>" title="<?php echo $user_info->user_login; ?>"><?php echo $user_info->user_login; ?></a><?php user_map_sidebar_html($user_id, $agent_data_with_child); ?></li>
			<?php
			} else {
			?>
				<li class="user_dropdown user_dropdown_active current_user"><i class="far fa-angle-down"></i> <a href="javascript:void(0);" data-user="<?php echo $user_id; ?>" title="<?php echo $user_info->user_login; ?>"><?php echo $user_info->user_login; ?></a><?php user_map_sidebar_html($user_id, $agent_data_with_child); ?></li>
			<?php
			}
			?>
		<?php
		}
		?>
	<?php
	}
	die;
}
/** Update User balance  */
add_action('wp_ajax_update_user_balance', 'credit_debit_user_balance');
add_action('wp_ajax_nopriv_update_user_balance', 'credit_debit_user_balance');
function credit_debit_user_balance()
{
	$user_balance_data = $_POST['form_data'];
	parse_str($user_balance_data);
	$user_id = $user_id;
	$user_balance = $user_balance;
	$balance_action = $balance_action;
	$user_role = $user_role;
	$user_payment_description = $user_payment_description;

	$operation_type = '';
	if (isset($register_charged) && !empty($register_charged)) {
		$operation_type = "collect";
	} else if (isset($register_bonus) && !empty($register_bonus)) {
		$operation_type = "discount";
	} else if (isset($register_paid) && !empty($register_paid)) {
		$operation_type = "payout";
	}

	$result = array();
	global $wpdb;
	$table = $wpdb->prefix . '_admin_transaction';
	$date = date('Y-m-d H:i:s');
	$order_details = !empty($user_payment_description) ? $user_payment_description : '';

	if ($balance_action == "credit") {
		$debit_user_balance = woo_wallet()->wallet->get_wallet_balance(get_current_user_id(), 'edit');
		if ($debit_user_balance >= $user_balance) {
			// $debit_transaction_id = woo_wallet()->wallet->debit(get_current_user_id(), $user_balance, $order_details);
			// $debit_transaction = array(get_current_user_id() => array(0 => $debit_transaction_id, 1 => 'debit'));
			// $debit_transaction = json_encode($debit_transaction);


			// $data = array('id' => '', 'user_id' => get_current_user_id(), 'from_id' => $user_id, 'amount' => $user_balance, 'created_at' => $date, 'transaction' => $debit_transaction, 'status' => 0);
			// // $wpdb->insert($table,$data);            
			// $parent_data = user_information_modal_usermap_sidebar_html($user_id, array($user_id));
			// $parent_data = array_reverse($parent_data);
			// if (!empty($parent_data) && isset($parent_data)) {
			//     $get_data_count =  count($parent_data);
			//     for ($i = 0; $i < $get_data_count - 1; $i++) {
			//         $data = array('id' => '', 'user_id' => $parent_data[$i], 'from_id' => $parent_data[$i + 1], 'amount' => $user_balance, 'created_at' => $date, 'transaction' => $debit_transaction, 'status' => 1);
			//         // $wpdb->insert($table,$data);                    
			//     }
			// }
			woo_wallet()->wallet->credit($user_id, $user_balance, $order_details, $operation_type);
			$result['current_user_balance'] = woo_wallet()->wallet->get_wallet_balance(get_current_user_id(), 'edit');
		} else {
			$result['error'] = 'Sorry, insufficient balance.';
		}
	}
	if ($balance_action == "debit") {

		$debit_user_balance = woo_wallet()->wallet->get_wallet_balance($user_id, 'edit');
		if ($debit_user_balance >= $user_balance) {
			$transaction_id = woo_wallet()->wallet->debit($user_id, $user_balance, $order_details, $operation_type);
			// $credit_transaction_id = woo_wallet()->wallet->credit(get_current_user_id(), $user_balance, $order_details);
			// $credit_transaction = array(get_current_user_id() => array(0 => $credit_transaction_id, 1 => 'credit'));
			// $credit_transaction = json_encode($credit_transaction);


			// $data = array('id' => '', 'user_id' => get_current_user_id(), 'from_id' => $user_id, 'amount' => "-" . $user_balance, 'created_at' => $date, 'transaction' => $credit_transaction, 'status' => 0);
			// // $wpdb->insert($table,$data);            
			// $parent_data = user_information_modal_usermap_sidebar_html($user_id, array($user_id));
			// $parent_data = array_reverse($parent_data);
			// if (!empty($parent_data) && isset($parent_data)) {
			//     $get_data_count =  count($parent_data);
			//     for ($i = 0; $i < $get_data_count - 1; $i++) {
			//         $data = array('id' => '', 'user_id' => $parent_data[$i], 'from_id' => $parent_data[$i + 1], 'amount' => "-" . $user_balance, 'created_at' => $date, 'transaction' => $credit_transaction, 'status' => 1);
			//         // $wpdb->insert($table,$data);                    
			//     }
			// }
			$result['current_user_balance'] = woo_wallet()->wallet->get_wallet_balance(get_current_user_id(), 'edit');
		} else {
			$result['error'] = 'Sorry, insufficient balance.';
		}
	}
	echo json_encode($result);
	die;
}

/** All modal HTMl AJAX call
 * 
 */
add_action('wp_ajax_get_modal_html', 'all_modal_html');
add_action('wp_ajax_nopriv_get_modal_html', 'all_modal_html');
function all_modal_html()
{
	$user_id = $_POST['user_id'];
	$modal_name = $_POST['modal_name'];
	$user_info = get_userdata($user_id);
	$user_registered = $user_info->user_registered;

	$agere_casino_id = get_field('agere_casino_id', 'option');
	$agere_token = get_field('agere_token', 'option');
	global $permission_commissions, $sports_list, $casino_list, $poker_list, $api_server_url;

	if ($modal_name == "add_player_Modal") {
	?>
		<h3 class="h3-title modal_title">Add player</h3>
		<div class="modal_tablist">
			<!-- <ul>
				<li data-tab="entry" class="active_modal_tab">
					Entry
				</li>
				<li data-tab="personal-information">
					Personal information
				</li>
				<li data-tab="permission">
					Permission
				</li>
			</ul> -->
		</div>
		<form class="vr_add_user_from" action="<?php echo get_permalink(get_page_by_path('casino-admin/users')); ?>">
			<div class="modal-from-section entry-sec">
				<div class="modal_form">
					<div class="form_input_wp">
						<i class="fal fa-user"></i>
						<input name="username" type="text" class="form_input" autocomplete="off" placeholder="UserName">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-envelope"></i>
						<input name="user_email" type="email" class="form_input" placeholder="E-mail">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-eye"></i>
						<input name="password" type="password" class="form_input" autocomplete="off" placeholder="Password">
					</div>
				</div>
			</div>
			<!-- <div class="modal-from-section personal-information-sec" style="display: none;">
				<div class="modal_form">
					<div class="form_input_wp">
						<i class="fal fa-user"></i>
						<input name="fullname" type="text" class="form_input" placeholder="Fullname">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-id-card"></i>
						<input name="document" type="text" class="form_input" placeholder="Document">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-envelope"></i>
						<input name="user_email" type="email" class="form_input" placeholder="E-mail">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-phone-alt"></i>
						<input name="phone" type="text" class="form_input" placeholder="phone">
					</div>
				</div>
			</div> -->
			<!-- <div class="modal-from-section permission-sec" style="display: none;">

				<div class="form_chechbox-sec-wp">
					<?php
					if (!empty($permission_commissions) && isset($permission_commissions)) {
						foreach ($permission_commissions as $key => $value) {
							$slug = strtolower($value);
					?>
							<div class="form_chechbox-sec">
								<div class="form_checkbox">
									<input type="checkbox" name="permission[]" value="<?php echo $slug; ?>" class="vr_ck_everyone">
									<div class="form_chocbox-header">
										<span><?php echo $value; ?></span>
									</div>
								</div>
							</div>
							<?php
						}
					}
							?>
				</div>

			</div> -->
			<div class="modal_footer">
				<button type="submit" class="sec-btn">Submit</button>
				<span class="load-more"><i class="fad fa-spinner-third  fa-spin ajax-loader"></i></span>
				<input type="hidden" name="user_role" value="player">
				<input type="hidden" name="parent_user" value="<?php echo $user_id; ?>">
			</div>
			<p class="error-msg vr-uname-err" style="display: none;">Please enter valid username.</p>
			<p class="error-msg vr-email-err" style="display: none;">Please enter valid email.</p>
			<p class="error-msg vr-pwd-err" style="display: none;">Please enter valid password.</p>
			<p class="error-msg vr-permission-err" style="display: none;">Please add user game permission.</p>
			<p class="success-msg" style="display: none;">your account has been created successfully.</p>
		</form>
	<?php
	} else if ($modal_name == "add_referral_modal") {
		$user_id = get_current_user_id();
		$my_commission =  get_user_meta($user_id, 'user_game_commission', true);
		$my_commission = json_decode($my_commission);
	?>
		<h3 class="h3-title modal_title">Create Referral Link</h3>
		<form class="create_referral_link" id="create_referral_link" action="<?php echo get_permalink(get_page_by_path('casino-admin/users')); ?>">
			<div class="modal-from-section entry-sec">
				<div class="modal_form">
					<div class="form_input_wp">
						<i class="fal fa-percent"></i>
						<input name="referral_commission" type="number" class="form_input" id="referral_commission" autocomplete="off" step=".01" min="0" max="100" placeholder="Referral commission">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-link"></i>
						<input name="referral_link" type="text" class="form_input" id="referral_link" autocomplete="off" placeholder="tag">
					</div>
					<div class="form_input_wp commission-type-div">
						<div class="form_input_wp form-element text-center">
							<select name="settlement_type" id="settlement_type_select" class="form_input">
								<option>Select Settlement Type</option>
								<option value="month">Monthly</option>
								<option value="week">Weekly</option>
							</select>
							<i class="far fa-angle-down"></i>
						</div>
					</div>
					<p class="note">*Enter a Commission Less then <?php echo (empty($my_commission->casino)) ? '0' : $my_commission->casino; ?>% </br>Tag is a character that can be attached to the end of the referral link.</p>
					<div class="form_input_wp generated-referral-link" style="display: none;">
						<a target="_blank" href="" class="generated-referral-link-anchor"></a>
						<input type="text" id="generated-referral-link-input" value="" style="display: none;" />

						<button type="button" class="generated-referral-link-icon-button sec-btn icon_btn balance_action" data-button-toggle="tooltip" title="Copy Link">
							<i class="fal fa-copy generated-referral-link-icon"></i>
						</button>
					</div>
				</div>
			</div>
			<div class="modal_footer">
				<button type="submit" class="sec-btn">Submit</button>
				<span class="load-more"><i class="fad fa-spinner-third  fa-spin ajax-loader"></i></span>
			</div>
			<p class="error-msg referral-max-commission-err"></p>
			<p class="error-msg referral-settlement-type-err">Please select settlement type</p>
			<p class="error-msg referral-commission-err">Please enter commission between 0 to 100</p>
			<p class="error-msg referral-commission-link-err">Please enter link address you want to create</p>
			<p class="response-referral-link"></p>
		</form>
	<?php } elseif ($modal_name == "add_agent_Modal") {
	?>
		<h3 class="h3-title modal_title">Add Agent</h3>
		<div class="modal_tablist">
			<ul>
				<li data-tab="entry" class="active_modal_tab">Entry </li>
				<!-- <li data-tab="personal-information">Personal information </li> -->
				<!-- <li data-tab="permission">Permission </li> -->
				<li data-tab="commissions">Commissions </li>
			</ul>
		</div>
		<form class="vr_add_user_from" action="<?php echo get_permalink(get_page_by_path('casino-admin/users')); ?>">
			<div class="modal-from-section entry-sec">
				<div class="modal_form">
					<div class="form_input_wp">
						<i class="fal fa-user"></i>
						<input name="username" type="text" class="form_input" placeholder="UserName">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-envelope"></i>
						<input name="user_email" type="email" class="form_input" placeholder="E-mail">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-eye"></i>
						<input name="password" type="password" class="form_input" placeholder="Password">
					</div>
				</div>
			</div>
			<!-- <div class="modal-from-section personal-information-sec" style="display: none;">
				<div class="modal_form">
					<div class="form_input_wp">
						<i class="fal fa-user"></i>
						<input name="fullname" type="text" class="form_input" placeholder="Fullname">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-id-card"></i>
						<input name="document" type="text" class="form_input" placeholder="Document">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-envelope"></i>
						<input name="user_email" type="email" class="form_input" placeholder="E-mail">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-phone-alt"></i>
						<input name="phone" type="text" class="form_input" placeholder="phone">
					</div>
				</div>
			</div> -->
			<!-- <div class="modal-from-section permission-sec" style="display: none;">
				<div class="form_chechbox-sec-wp">
					<?php
					if (!empty($permission_commissions) && isset($permission_commissions)) {
						foreach ($permission_commissions as $key => $value) {
							$slug = strtolower($value);
					?>
							<div class="form_chechbox-sec">
								<div class="form_checkbox">
									<input type="checkbox" name="permission[]" value="<?php echo $slug; ?>" class="vr_ck_everyone agent_game_permission">
									<div class="form_chocbox-header">
										<span><?php echo $value; ?></span>
									</div>
								</div>
							</div>
					<?php
						}
					}
					?>
				</div>
			</div> -->
			<div class="modal-from-section commissions-sec" style="display: none;">
				<div class="commissions_modal_form">
					<div class="commission-type-div">
						<label for="settlement_type_select">Settle Automatically</label>
						<div class="form_input_wp form-element text-center">
							<select name="settlement_type" id="settlement_type_select" class="form_input">
								<option>Select Settlement Type</option>
								<option value="month">Monthly</option>
								<option value="week">Weekly</option>
							</select>
							<i class="far fa-angle-down"></i>
						</div>
					</div>
					<div class="form_chechbox-sec-wp">
						<div class="form_chechbox-sec form_input-sec">
							<?php
							if (!empty($permission_commissions) && isset($permission_commissions)) {
								foreach ($permission_commissions as $key => $value) {
									$slug = strtolower($value);
									if ($value === 'Casino') {
							?>
										<div class="form_input-sec_list all-commission-main-box">
											<div class="form_chocbox-header">
												<span><?php echo $value; ?></span>
												<div class="form-element">
													<input type="number" name="commission[<?php echo $slug; ?>]" class="form_input" step=".01" placeholder="">
													<i class="far fa-percent"></i>
												</div>
											</div>

										</div>
							<?php
									}
								}
							}
							?>

						</div>

					</div>
				</div>
			</div>
			<div class="modal_footer">
				<button type="submit" class="sec-btn">Submit</button>
				<input type="hidden" name="user_role" value="agent">
				<input type="hidden" name="parent_user" value="<?php echo $user_id; ?>">
				<span class="load-more"><i class="fad fa-spinner-third  fa-spin ajax-loader"></i></span>
			</div>
			<p class="error-msg vr-uname-err">Please enter valid username.</p>
			<p class="error-msg vr-email-err">Please enter valid email.</p>
			<p class="error-msg vr-pwd-err">Please enter valid password.</p>
			<p class="error-msg vr-commission-settlement-type-err">Please select settlement type.</p>
			<p class="error-msg vr-permission-err">Please add user game permission.</p>
			<p class="success-msg">your account has been created successfully.</p>
		</form>
	<?php
	} elseif ($modal_name == "user_information_Modal") {
		$father_id = get_the_author_meta('parent_user', $user_id);
		$father_user_data = get_userdata($father_id);
		$current_user_agent = $current_user_player = array($father_id);
		$current_user_agent =  get_current_agent_and_admin_user($user_id, array(), array('agent'));
		$current_user_player =  get_current_user_player_count($user_id);

	?>
		<h3 class="h3-title modal_title">User information</h3>
		<div class="two_col_row">
			<div class="two_col">
				<ul class="user_info_list">
					<li>
						<label>id :</label>
						<span><?php echo $user_id; ?></span>
					</li>
					<li>
						<label>User :</label>
						<span><?php echo $user_info->user_login; ?></span>
					</li>
					<li>
						<label>Father :</label>
						<span><?php echo $father_user_data->display_name;; ?></span>
					</li>
					<li>
						<label>Role :</label>
						<span><?php echo $user_info->roles[0]; ?></span>
					</li>
					<?php
					if ($user_info->roles[0] == "agent") {
					?>
						<li>
							<label>Agents :</label>
							<span><a href="javascript:void(0);" data-userrole="agent" data-userid="<?php echo $user_id; ?>" class="user_info_sort"><?php echo count($current_user_agent); ?></a></span>
						</li>
						<li>
							<label>Players :</label>
							<span><a href="javascript:void(0);" data-userrole="player" data-userid="<?php echo $user_id; ?>" class="user_info_sort"><?php echo count($current_user_player); ?></a></span>
						</li>
					<?php
					}
					?>
					<li>
						<label>Created :</label>
						<span><?php echo date("m/d/Y", strtotime($user_registered)); ?></span>
					</li>
				</ul>
			</div>
			<div class="two_col">
				<h6 class="h6-title">Structure :</h6>
				<ul class="structure_list">
					<?php
					$parent_data = user_information_modal_usermap_sidebar_html($user_id, array($user_id));
					$parent_data = array_reverse($parent_data);
					$i = 0;
					$k = 0;
					foreach ($parent_data as $key => $value) {

						if ($value == get_current_user_id()) {
							$k = 1;
						}
						if ($k == 1) {
							$user_info  = get_userdata($value);
					?>
							<li style="--data-count:<?php echo $i; ?>">
						<?php
							echo $user_info->user_login;
							echo "</li>";
							$i++;
						}
					}

						?>

				</ul>
			</div>
		</div>
	<?php
	} elseif ($modal_name == "change_password") {
	?>
		<h3 class="h3-title modal_title">Change Password</h3>
		<form class="modal_form user_change_pwd_form">
			<div class="form_input_wp">
				<i class="fal fa-eye"></i>
				<input name="new_assword" type="password" class="form_input" placeholder="New Password">
			</div>
			<div class="form_input_wp">
				<i class="fal fa-eye"></i>
				<input name="confirm_password" type="password" class="form_input" placeholder="confirm Password">
			</div>
			<div class="modal_footer">
				<button type="submit" class="sec-btn">Submit</button><input type="hidden" value="<?php echo $user_id; ?>" name="user_id">
			</div>
			<p class="error-msg vr-newpwd-err">Please enter password.</p>
			<p class="error-msg vr-conpwd-err">Please enter confirm password.</p>
			<p class="success-msg pwd-success-msg">password is successfully update.</p>
		</form>
	<?php
	} elseif ($modal_name == "modify_popup_player") {
		$full_name = $phone = $document = $sports_data = $casino_data = $user_email = "";
		$full_name = get_the_author_meta('full_name', $user_id);
		$phone = get_the_author_meta('phone', $user_id);
		$document = get_the_author_meta('document', $user_id);
		$permission = get_the_author_meta('user_play_permission', $user_id);
		// $sports_data = get_the_author_meta( 'sports', $user_id );
		// $casino_data = get_the_author_meta( 'casino', $user_id );
		$user_info = get_userdata($user_id);
		if (isset($user_info)) {
			$user_email = $user_info->user_email;
		}

		$sports_data_ck  = $casino_data_ck = array();
		if (!empty($permission)) {
			$permission_ck = explode(",", $permission);
		}
	?>
		<h3 class="h3-title modal_title">Edit User</h3>
		<div class="modal_tablist">
			<!-- <ul>
				<li data-tab="personal-information" class="active_modal_tab">Personal information</li>
				<li data-tab="permission">Permission</li>
			</ul> -->
		</div>
		<form class="vr_edit_user_from">
			<div class="modal-from-section personal-information-sec">
				<div class="modal_form">
					<div class="form_input_wp">
						<i class="fal fa-user"></i>
						<input name="fullname" type="text" class="form_input" value="<?php echo $full_name; ?>" placeholder="Fullname">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-id-card"></i>
						<input name="document" type="text" class="form_input" value="<?php echo $document; ?>" placeholder="Document">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-envelope"></i>
						<input name="user_email" type="email" class="form_input" value="<?php echo $user_email; ?>" placeholder="E-mail">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-phone-alt"></i>
						<input name="phone" type="text" class="form_input" value="<?php echo $phone; ?>" placeholder="phone">
					</div>
				</div>
			</div>
			<!-- <div class="modal-from-section permission-sec" style="display: none;">
				<div class="form_chechbox-sec-wp">
					<?php
					if (!empty($permission_commissions) && isset($permission_commissions)) {
						foreach ($permission_commissions as $key => $value) {
							$slug = strtolower($value);
					?>
							<div class="form_chechbox-sec">
								<div class="form_checkbox">
									<input type="checkbox" name="permission[]" <?php if (in_array($slug, $permission_ck)) {
																					echo 'checked';
																				} ?> value="<?php echo $slug; ?>" class="vr_ck_everyone">
									<div class="form_chocbox-header">
										<span><?php echo $value; ?></span>
									</div>
								</div>
							</div>
					<?php
						}
					}
					?>
				</div>

			</div> -->
			<div class="modal_footer">
				<button type="submit" class="sec-btn">Submit</button>
				<input type="hidden" name="user_role" value="player">
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				<span class="load-more"><i class="fad fa-spinner-third  fa-spin ajax-loader"></i></span>
			</div>
			<p class="error-msg vr-email-err">Please enter valid email.</p>
			<p class="error-msg vr-permission-err">Please add user game permission.</p>
			<p class="success-msg">your account has been created successfully.</p>
		</form>
	<?php
	} elseif ($modal_name == "modify_popup_agent") {

		$full_name = $phone = $document = $sports_data = $casino_data = $user_email = "";
		$full_name = get_the_author_meta('full_name', $user_id);
		$phone = get_the_author_meta('phone', $user_id);
		$document = get_the_author_meta('document', $user_id);
		$permission = get_the_author_meta('user_play_permission', $user_id);
		$commission = get_the_author_meta('user_game_commission', $user_id);
		$commission_automatically = get_the_author_meta('commission_automatically', $user_id);
		$settlement_type = get_the_author_meta('settlement_type', $user_id, true);

		$user_info = get_userdata($user_id);
		if (isset($user_info)) {
			$user_email = $user_info->user_email;
		}

		$permission_data_ck  = $commission_data_ck = array();
		if (!empty($permission)) {
			$permission_data_ck = explode(",", $permission);
		}
		if (!empty($commission)) {
			$commission_data_ck = json_decode($commission, true);
		}

		$user_api_id = site_url("/_{$user_id}");
		$user_data = $api_server_url . "/casinos/casino-admin-reports?action=get-user-action&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $user_api_id;

		$user_data = file_get_contents($user_data);

		if (isset($user_data) && !empty($user_data)) {
			$user_api_data = json_decode($user_data, true);

			if (isset($user_api_data['data']) && !empty($user_api_data['data'])) {
				$commision_settlementType = strtolower($user_api_data['data']['settlementType']);
				$commission_data = $user_api_data['data']['commission'];
			}
		}
	?>
		<h3 class="h3-title modal_title">Edit User</h3>
		<div class="modal_tablist">
			<ul>
				<li data-tab="personal-information" class="active_modal_tab">
					Personal information
				</li>
				<!-- <li data-tab="permission">
					Permission
				</li> -->
				<li data-tab="commissions">
					Commissions
				</li>
			</ul>
		</div>
		<form class="vr_edit_user_from">
			<div class="modal-from-section personal-information-sec">
				<div class="modal_form">
					<div class="form_input_wp">
						<i class="fal fa-user"></i>
						<input name="fullname" type="text" class="form_input" value="<?php echo $full_name; ?>" placeholder="Fullname">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-id-card"></i>
						<input name="document" type="text" class="form_input" value="<?php echo $document; ?>" placeholder="Document">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-envelope"></i>
						<input name="user_email" type="email" class="form_input" value="<?php echo $user_email; ?>" placeholder="E-mail">
					</div>
					<div class="form_input_wp">
						<i class="fal fa-phone-alt"></i>
						<input name="phone" type="text" class="form_input" value="<?php echo $phone; ?>" placeholder="phone">
					</div>
				</div>
			</div>
			<!-- <div class="modal-from-section permission-sec" style="display: none;">
				<div class="form_chechbox-sec-wp">
					<?php
					if (!empty($permission_commissions) && isset($permission_commissions)) {
						foreach ($permission_commissions as $key => $value) {
							$slug = strtolower($value); ?>
							<div class="form_chechbox-sec">
								<div class="form_checkbox">
									<input type="checkbox" name="permission[]" <?php if (in_array($slug, $permission_data_ck)) {
																					echo 'checked';
																				} ?> value="<?php echo $slug; ?>" class="vr_ck_everyone">
									<div class="form_chocbox-header">
										<span><?php echo $value; ?></span>
									</div>
								</div>
							</div>
					<?php
						}
					}
					?>
				</div>
			</div> -->
			<div class="modal-from-section commissions-sec" style="display: none;">
				<div class="commissions_modal_form">
					<div class="commission-type-div">
						<label for="settlement_type_select">Settle Automatically</label>
						<div class="form_input_wp form-element text-center">
							<select name="settlement_type" id="settlement_type_select" class="form_input">
								<option>Select Settlement Type</option>
								<option value="month" <?php echo "month" === $commision_settlementType ? "selected" : ''; ?>>Monthly</option>
								<option value="week" <?php echo "week" === $commision_settlementType ? "selected" : ''; ?>>Weekly</option>
							</select>
							<i class="far fa-angle-down"></i>
						</div>
					</div>
					<div class="form_chechbox-sec-wp">
						<div class="form_chechbox-sec form_input-sec">
							<?php if (!empty($commission_data) && isset($commission_data)) { ?>
								<?php foreach ($commission_data as $key => $value) { ?>
									<div class="form_input-sec_list all-commission-main-box">
										<div class="form_chocbox-header">
											<span><?php echo ucwords($key); ?></span>
											<div class="form-element">
												<input type="number" name="commission[<?php echo strtolower($key); ?>]" value="<?php echo $value; ?>" step=".01" class="form_input" placeholder="">
												<i class="far fa-percent"></i>
											</div>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="modal_footer">
				<button type="submit" class="sec-btn">Submit</button>
				<input type="hidden" name="user_role" value="agent">
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				<span class="load-more"><i class="fad fa-spinner-third fa-spin ajax-loader"></i></span>
			</div>
			<p class="error-msg vr-email-err">Please enter valid email.</p>
			<p class="error-msg vr-permission-err">Please add user game permission.</p>
			<p class="error-msg vr-commission-settlement-type-err">Please select settlement type.</p>
			<p class="success-msg">your account has been created successfully.</p>
		</form>

	<?php
	} elseif ($modal_name == "to_lock_popup") {
	?>
		<h3 class="h3-title modal_title">Lock user</h3>
		<form class="modal_form user_block_form">
			<div class="form_input_wp">
				<label for="">Lock reason (optional)</label>
				<textarea name="user_block_reason" rows="3" placeholder="Massage" class="form_input"></textarea>
			</div>
			<div class="modal_footer">
				<button type="submit" class="sec-btn">Submit</button>
				<span class="load-more">
					<i class="fad fa-spinner-third  fa-spin ajax-loader"></i>
				</span>
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			</div>
		</form>
	<?php
	} elseif ($modal_name == "user_hide") {
		update_user_meta($user_id, 'user_hide', 1);
		echo "user_hide";
	} elseif ($modal_name == "user_unhide") {
		update_user_meta($user_id, 'user_hide', 0);
		echo "user_hide";
	} elseif ($modal_name == "user_unlock") {
		update_user_meta($user_id, 'user_block', 0);
		echo "user_hide";
	} elseif ($modal_name == "add_credit_modal") {
	?>
		<h3 class="h3-title modal_title">Add credits</h3>
		<form action="" class="add_credit_form">
			<div class="form_input_group">
				<div class="input-group-prepend">
					<span class="input-group-text input-modal-addon">
						<i class="fas fa-user" aria-hidden="true"></i>
					</span>
				</div>
				<input type="text" class="form_input" name="user_name" readonly value="<?php echo $user_info->user_login; ?>">
				<?php
				$current_user_info = get_userdata(get_current_user_id());
				$casino_admin =  get_user_meta(get_current_user_id(), 'casino_admin', true);

				if ((isset($casino_admin) && !empty($casino_admin) && $casino_admin == 1) || $current_user_info->roles[0] === 'administrator') { ?>
					<input type="text" class="form_input" name="user_current_balance" readonly value="<?php echo woo_wallet()->wallet->get_wallet_balance($user_id, 'edit'); ?>">
				<?php
				} ?>
			</div>

			<div class="form_input_group balance_input_group">
				<div class="d-flex">
					<div class="input-group-prepend">
						<span class="input-group-text input-modal-addon"><i class="fas fa-coins" aria-hidden="true"></i></span>
					</div>
					<input type="number" class="form_input" name="user_balance" aria-label="amount" autocomplete="off" value="0" min="0" step=".01" placeholder="0.00">
				</div>
				<div class="table_btn_group form_right_group">
					<ul>
						<li>
							<button type="button" class="sec-btn icon_btn btn-balance-increase-action" data-button-toggle="tooltip" title="increase"><i class="far fa-plus"></i></button>
						</li>
						<li>
							<button type="button" class="sec-btn icon_btn btn-balance-decrease-action" data-button-toggle="tooltip" title="decrease"><i class="far fa-minus"></i></button>
						</li>
					</ul>
				</div>
			</div>

			<div class="add_coin_group">
				<ul>
					<li>
						<button type="button" data-value="100" class="sec-btn sm-btn" data-button-toggle="tooltip" title="increase 100"><i class="far fa-plus"></i>100</button>
					</li>
					<li>
						<button type="button" data-value="1000" class="sec-btn sm-btn" data-button-toggle="tooltip" title="increase 1,000"><i class="far fa-plus"></i>1,000</button>
					</li>
					<li>
						<button type="button" data-value="10000" class="sec-btn sm-btn" data-button-toggle="tooltip" title="increase  10,000"><i class="far fa-plus"></i>10,000</button>
					</li>
				</ul>
			</div>

			<div class="form_input_group add_credit_modal_footer">
				<?php
				if (isset($user_info->roles[0]) && $user_info->roles[0] == "player") {
				?>
					<div class="d-flex form_checkbox_group">
						<div class="form_checkbox">
							<input type="checkbox" name="register_charged" value="1" class="form-check-input" id="register_charged">
							<label class="form-check-label" for="register_charged">Register as Collected</label>
						</div>
						<div class="form_checkbox">
							<input type="checkbox" name="register_bonus" value="1" class="form-check-input" id="register_bonus">
							<label class="form-check-label" for="register_bonus">Register as Discounted</label>
						</div>
					</div>
					<div class="form_right_group">
						<button type="button" class="sec-btn icon_btn" data-button-toggle="tooltip" title="Balance in finance: <?php echo woo_wallet()->wallet->get_wallet_balance($user_id, 'edit'); ?>">
							<i class="fal fa-dollar-sign"></i>
						</button>
						<textarea name="user_payment_description" cols="40" rows="10" class="form_input" placeholder="Description"></textarea>
					</div>
					<input type="hidden" name="user_role" value="player">
				<?php
				} else {
				?>
					<input type="hidden" name="user_role" value="agent">
				<?php
				}
				?>
			</div>

			<div class="modal_footer">
				<button type="submit" class="sec-btn">Submit</button>
				<span class="load-more">
					<i class="fad fa-spinner-third  fa-spin ajax-loader"></i>
				</span>
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				<input type="hidden" name="balance_action" value="credit">
			</div>
			<p class="error-msg"></p>
		</form>
	<?php
	} elseif ($modal_name == "add_debit_modal") {
	?>
		<h3 class="h3-title modal_title">Deduct credits</h3>
		<form action="" class="add_credit_form">
			<div class="form_input_group">
				<div class="input-group-prepend">
					<span class="input-group-text input-modal-addon">
						<i class="fas fa-user" aria-hidden="true"></i>
					</span>
				</div>
				<input type="text" class="form_input" name="" readonly value="<?php echo $user_info->user_login; ?>">
				<?php
				$current_user_info = get_userdata(get_current_user_id());
				$casino_admin =  get_user_meta(get_current_user_id(), 'casino_admin', true);
				if ((isset($casino_admin) && !empty($casino_admin) && $casino_admin == 1) || $current_user_info->roles[0] === 'administrator') { ?>
					<input type="text" class="form_input" name="user_current_balance" readonly value="<?php echo woo_wallet()->wallet->get_wallet_balance($user_id, 'edit');; ?>">
				<?php
				} ?>
			</div>
			<div class="form_input_group balance_input_group">
				<div class="d-flex">
					<div class="input-group-prepend">
						<span class="input-group-text input-modal-addon">
							<i class="fas fa-coins" aria-hidden="true"></i>
						</span>
					</div>
					<input type="number" class="form_input" name="user_balance" aria-label="amount" autocomplete="off" value="0" step=".01" placeholder="0.00">
				</div>
				<div class="table_btn_group form_right_group">
					<ul>
						<li>
							<button type="button" class="sec-btn icon_btn btn-balance-increase-action" data-button-toggle="tooltip" title="increase"><i class="far fa-plus"></i></button>
						</li>
						<li>
							<button type="button" class="sec-btn icon_btn btn-balance-decrease-action" data-button-toggle="tooltip" title="decrease"><i class="far fa-minus"></i></button>
						</li>
					</ul>
				</div>
			</div>
			<div class="add_coin_group">
				<ul>
					<li>
						<button type="button" data-value="100" class="sec-btn sm-btn" data-button-toggle="tooltip" title="increase 100"><i class="far fa-plus"></i>100</button>
					</li>
					<li>
						<button type="button" data-value="1000" class="sec-btn sm-btn" data-button-toggle="tooltip" title="increase 1,000"><i class="far fa-plus"></i>1,000</button>
					</li>
					<li>
						<button type="button" data-value="10000" class="sec-btn sm-btn" data-button-toggle="tooltip" title="increase  10,000"><i class="far fa-plus"></i>10,000</button>
					</li>
				</ul>
			</div>
			<div class="form_input_group add_debit_modal_footer">
				<?php
				if (isset($user_info->roles[0]) && $user_info->roles[0] == "player") {
				?>
					<div class="d-flex form_checkbox_group">
						<div class="form_checkbox">
							<input type="checkbox" name="register_paid" value="1" class="form-check-input" id="register_paid">
							<label class="form-check-label" for="register_paid">Register as Paid</label>
						</div>
					</div>
					<div class="form_right_group">
						<button type="button" class="sec-btn icon_btn" data-button-toggle="tooltip" title="Balance in finance: 0.00">
							<i class="fal fa-dollar-sign"></i>
						</button>
						<textarea name="user_payment_description" cols="40" rows="10" class="form_input" placeholder="Description"></textarea>
					</div>
					<input type="hidden" name="user_role" value="player">
				<?php
				} else {
				?>
					<input type="hidden" name="user_role" value="agent">
				<?php
				}
				?>
			</div>
			<div class="modal_footer">
				<button type="submit" class="sec-btn">Submit</button>
				<span class="load-more">
					<i class="fad fa-spinner-third  fa-spin ajax-loader"></i>
				</span>
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				<input type="hidden" name="balance_action" value="debit">
			</div>
			<p class="error-msg"></p>
		</form>
	<?php
	} elseif ($modal_name === "agent-tree-list") {
		include get_template_directory() . '/admin/template-parts/agents-sidebar.php';
	} elseif ($modal_name === 'get_woo_wallet_withdrawal_details_Modal') {
		$post_meta = get_post_meta($user_id);
		$user_meta = get_user_meta(get_post_field('post_author', $user_id)); ?>
		<h2 class="h2-title">Request details</h2>
		<table id="woo_wallet_withdraw_details">
			<tbody>
				<tr>
					<td>Amount</td>
					<td><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $post_meta['_wallet_withdrawal_amount'][0]; ?></bdi></span></td>
				</tr>
				<tr>
					<td>Gateway charge</td>
					<td><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $post_meta['_wallet_withdrawal_transaction_charge'][0]; ?></bdi></span></td>
				</tr>
				<tr>
					<td>Payment method</td>
					<td><?php echo $post_meta['_wallet_withdrawal_method'][0] . ' - ' . $post_meta['_withdrawal_cryptocurrency_method'][0]; ?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><?php echo $user_meta['_woo_wallet_withdrawal_cryptocurrency_email'][0]; ?></td>
				</tr>
			</tbody>
		</table>
		<?php

	}

	die;
}
function get_current_agent_and_admin_user($user_id, $cu_user_agent, $user_role)
{
	$user_args_agent = array();
	$user_args_agent['fields'] = array('ID');
	$user_args_agent['meta_key'] = 'parent_user';
	$user_args_agent['meta_value'] = $user_id;
	$user_args_agent['meta_compare'] = '=';
	$user_args_agent['role__in'] = $user_role;
	$all_users_data = get_users($user_args_agent);
	$branch = array();
	$loop_count =  count($all_users_data);
	foreach ($all_users_data as $key => $value) {
		// if( !is_array($value->ID) && get_user_meta( $value->ID, 'parent_user', true ) == $user_id ) {
		$cu_user_agent[] = $value->ID;
		$output = get_current_agent_and_admin_user($value->ID, $cu_user_agent, $user_role);

		// echo "<pre>";
		// print_r($output);
		// echo "Value-id: ".$value->ID."<br>";
		// echo get_user_meta( $value->ID, 'parent_user', true ) == $user_id;
		// echo "</pre>";



		if (!empty($output)) {
			$cu_user_agent = $output;
		}
	}
	$branch = $cu_user_agent;
	// }
	return $branch;
}
function get_current_user_player_count($user_id)
{
	global $current_user_player_child_player;
	$all_agent = get_current_agent_and_admin_user($user_id, array(), array('agent'));
	$current_user_player_child_player = get_current_agent_and_admin_user($user_id, array(), array('player'));
	if (!empty($all_agent) && isset($all_agent)) {
		foreach ($all_agent as $key => $value) {
			$agent_player_data = get_current_agent_and_admin_user($value, $current_user_player_child_player, array('player'));
			if (!empty($current_user_player_child_player)) {
				$current_user_player_child_player = array_merge($agent_player_data, $current_user_player_child_player);
			}
		}
	}
	return array_unique($current_user_player_child_player);
}
function get_curren_user_data_with_child_array($user_id, $cu_user_agent, $user_hide)
{
	$user_args_agent = array();
	$user_args_agent['fields'] = array('ID');
	$user_args_agent['meta_key'] = 'parent_user';
	$user_args_agent['meta_value'] = $user_id;
	$user_args_agent['meta_compare'] = '=';
	$user_args_agent['role__in'] =  array('agent');
	$all_users_data = get_users($user_args_agent);
	$agent_data = array();
	foreach ($all_users_data as $key => $value) {
		$user_hidden = get_the_author_meta('user_hide', $value->ID);
		if ($user_hide == 1) {
			if ($user_hidden != $user_hide) {

				$cu_user_agent[$value->ID] = array();
				$output[$value->ID] = get_curren_user_data_with_child_array($value->ID, $cu_user_agent, $user_hide);

				$agent_data = $output;
			}
		} else {
			$cu_user_agent[$value->ID] = array();
			$output[$value->ID] = get_curren_user_data_with_child_array($value->ID, $cu_user_agent, $user_hide);

			$agent_data = $output;
		}
	}
	return $agent_data;
}
function get_curren_player_data_with_child_array($user_id, $cu_user_agent)
{
	$user_args_agent = array();
	$user_args_agent['fields'] = array('ID');
	$user_args_agent['meta_key'] = 'parent_user';
	$user_args_agent['meta_value'] = $user_id;
	$user_args_agent['meta_compare'] = '=';
	$user_args_agent['role__in'] =  array('player');
	$all_users_data = get_users($user_args_agent);
	$player_data = array();
	foreach ($all_users_data as $key => $value) {

		$cu_user_agent[$value->ID] = array();
		$output[$value->ID] = get_curren_player_data_with_child_array($value->ID, $cu_user_agent);

		$player_data = $output;
	}
	return $player_data;
}
function user_map_sidebar_html($user_id, $agent_data_with_child, $child = 0)
{
	$collapse = $child !== 0 ? ' style="display: none;"' : '';
	if (isset($agent_data_with_child[$user_id]) && !empty($agent_data_with_child[$user_id])) {
		echo '<ul' . $collapse . '>';
		$agent_data_with_child = $agent_data_with_child[$user_id];
		foreach ($agent_data_with_child as $user_id => $value) {
			$user_info  = get_userdata($user_id);

			if (empty($value)) {
		?>
				<li>
					<a href="javascript:void(0);" data-user="<?php echo $user_id; ?>" title="<?php echo $user_info->user_login; ?>"><?php echo $user_info->user_login; ?></a>
					<?php user_map_sidebar_html($user_id, $agent_data_with_child, 1); ?>
				</li>
			<?php
			} else {
			?>
				<li class="user_dropdown user_dropdown_active hide">
					<i class="far fa-angle-down"></i>
					<a href="javascript:void(0);" data-user="<?php echo $user_id; ?>" title="<?php echo $user_info->user_login; ?>"><?php echo $user_info->user_login; ?></a>

					<?php user_map_sidebar_html($user_id, $agent_data_with_child, 1); ?>
				</li>
	<?php
			}
		}
		echo ' </ul>';
	}
}
function user_information_modal_usermap_sidebar_html($user_id, $parent_data)
{

	$parent_user = get_the_author_meta('parent_user', $user_id);
	$user_info  = get_userdata($parent_user);
	if ($parent_user != '') {
		$parent_data[] = $parent_user;
		$parent_data = user_information_modal_usermap_sidebar_html($parent_user, $parent_data);
	}
	return $parent_data;
}
/**
 * Charges and Withdrawals Page code */
add_action('wp_ajax_report_balances', 'charges_withdrawals_table');
add_action('wp_ajax_nopriv_report_balances', 'charges_withdrawals_table');
function charges_withdrawals_table()
{
	global $api_server_url;
	$rowperpage     = $_POST['length'];
	$start          = $_POST['start'];
	$draw           = $_POST['draw'];
	$searchByName   = $_POST['search']['value'];
	$tran_checkbox  = $_POST['tran_checkbox'];
	$start_date         = $_POST['start_date'];
	$start_date         = date("Y-m-d", strtotime($start_date));
	$start_time         = date("H:i:s", strtotime($_POST['start_time']));
	$end_date           = $_POST['end_date'];
	$end_date           = date("Y-m-d", strtotime($end_date));
	$end_time           = date("H:i:s", strtotime($_POST['end_time']));
	$start_date_time    = $start_date . "T" . $start_time;
	$end_date_time      = $end_date . "T" . $end_time;
	$userrole           = $_POST['userrole'];
	$username_search    = $_POST['username'];
	$current_user       = $_POST['current_user'];

	if (!empty($username_search)) {
		global $wpdb;
		$table_name = $wpdb->prefix . "users";
		$user_sql = "select ID from " . $table_name . " where user_login = '" . $username_search . "'";
		$user_result = $wpdb->get_results($user_sql);

		if (isset($user_result) && isset($user_result[0])) {
			if (isset($user_result[0]->ID) && !empty($user_result[0]->ID)) {
				$current_user = $user_result[0]->ID;
			}
		}
	}
	$agere_casino_id = get_field('agere_casino_id', 'option');
	$agere_token = get_field('agere_token', 'option');
	$remote_id_string .= site_url('/') . '_' . $current_user;
	$current_login .= site_url('/') . '_' . get_current_user_id();
	$page_no = ($start / $rowperpage) + 1;
	// if($userrole == "agent"){
	if (isset($tran_checkbox) && $tran_checkbox == "received") {
		$balance_report_api = $api_server_url . "/casinos/casino-admin-reports?action=credit-agent-report&type=" . $userrole . "&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $remote_id_string . "&start=" . $start_date_time . "&end=" . $end_date_time . "&filterType=received&limit=" . $rowperpage . "&pageno=" . $page_no . "&auth_id=" . $current_login;
	} elseif (isset($tran_checkbox) && $tran_checkbox == "direct") {
		$balance_report_api = $api_server_url . "/casinos/casino-admin-reports?action=credit-agent-report&type=" . $userrole . "&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $remote_id_string . "&start=" . $start_date_time . "&end=" . $end_date_time . "&filterType=direct&limit=" . $rowperpage . "&pageno=" . $page_no . "&auth_id=" . $current_login;
	} elseif (isset($tran_checkbox) && $tran_checkbox == "higher") {
		$balance_report_api = $api_server_url . "/casinos/casino-admin-reports?action=credit-agent-report&type=" . $userrole . "&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $remote_id_string . "&start=" . $start_date_time . "&end=" . $end_date_time . "&filterType=higher&limit=" . $rowperpage . "&pageno=" . $page_no . "&auth_id=" . $current_login;
	} else {
		$balance_report_api = $api_server_url . "/casinos/casino-admin-reports?action=credit-agent-report&type=" . $userrole . "&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $remote_id_string . "&start=" . $start_date_time . "&end=" . $end_date_time . "&filterType=all&limit=" . $rowperpage . "&pageno=" . $page_no . "&auth_id=" . $current_login;
	}
	// }
	$balance_report_data = $totalRecords = 0;
	if (!empty($balance_report_api)) {
		$balance_report_content = file_get_contents($balance_report_api);
		if (isset($balance_report_content) && !empty($balance_report_content)) {
			$balance_report_data = json_decode($balance_report_content);
			$totalRecords = $balance_report_data->total;
			$totalRecordwithFilter = $balance_report_data->total;
			$balance_report_data = $balance_report_data->txns;
			if (isset($balance_report_data) && !empty($balance_report_data)) {
				foreach ($balance_report_data as $key => $report) {

					$user_info = get_userdata(str_replace(site_url('/') . '_', '', $report->senderId));
					$from_user_info = get_userdata(str_replace(site_url('/') . '_', '', $report->receiverId));
					$destination_user_data = array('name' => $from_user_info->user_login, "role" => $userrole);

					$transtion_date    = strtotime($report->createdAt);
					$transtion_date    = date("d-m-Y H:i:s", $transtion_date);

					$data[] = array(
						"date"      => $transtion_date,
						"source"  => $user_info->user_login,
						"destination"    => $destination_user_data,
						"amount" => add_currency_symbol($report->amount),
					);
				}
			}
		}
	}


	$response = array(
		"draw" => intval($draw),
		"iTotalRecords" => $totalRecords,
		"iTotalDisplayRecords" => $totalRecordwithFilter,
		"aaData" => $data
	);
	echo json_encode($response);
	die;
}
/** Player history page data table ajax */
add_action('wp_ajax_player_history', 'player_history_data_table');
add_action('wp_ajax_nopriv_player_history', 'player_history_data_table');
function player_history_data_table()
{
	global $api_server_url;
	$rowperpage     = $_POST['length'];
	$start          = $_POST['start'];
	$draw           = $_POST['draw'];
	$searchByName   = $_POST['search']['value'];
	$tran_checkbox  = $_POST['tran_checkbox'];
	$start_date         = $_POST['start_date'];
	$start_date         = date("Y-m-d", strtotime($start_date));
	$start_time         = date("H:i:s", strtotime($_POST['start_time']));
	$end_date           = $_POST['end_date'];
	$end_date           = date("Y-m-d", strtotime($end_date));
	$end_time           = date("H:i:s", strtotime($_POST['end_time']));
	$start_date_time    = $start_date . "T" . $start_time;
	$end_date_time      = $end_date . "T" . $end_time;
	$username_search    = $_POST['username'];
	global $wpdb;
	$table_name = $wpdb->prefix . "users";
	$user_sql = "select ID from " . $table_name . " where user_login = '" . $username_search . "'";
	$total_result = $wpdb->get_results($user_sql);
	if (isset($total_result) && isset($total_result[0])) {
		if (isset($total_result[0]->ID) && !empty($total_result[0]->ID)) {
			$userid = $total_result[0]->ID;
		}
	}
	// $userid = "110";
	$page_no = ($start / $rowperpage) + 1;
	$agere_casino_id = get_field('agere_casino_id', 'option');
	$agere_token = get_field('agere_token', 'option');
	$remote_id_string .= site_url('/') . '_' . $userid;
	$player_his_api = $api_server_url . "/casinos/report?report=player&token=" . $agere_token . "&remote_id=" . $remote_id_string . "&casino=" . $agere_casino_id . "&start=" . $start_date_time . "&end=" . $end_date_time . "&limit=" . $rowperpage . "&page=" . $page_no;


	$player_history_content = file_get_contents($player_his_api);
	if (isset($player_history_content) && !empty($player_history_content)) {
		$player_history_data = json_decode($player_history_content);
		if (isset($player_history_data->response[0]) && isset($player_history_data->response[0]->transactions)) {
			$player_history_record = $player_history_data->response[0]->transactions;
			$totalRecordwithFilter = $player_history_data->response[0]->totalTxns;
			$totalRecords = $player_history_data->response[0]->totalTxns;
			$previous_balance = $subsequent_balance = 0;
			foreach ($player_history_record as $key => $history_record) {
				$previous_balance = $history_record->beforeBalance ?  number_format($history_record->beforeBalance, 2) : $history_record->beforeBalance;
				$subsequent_balance = $history_record->afterBalance ?  number_format($history_record->afterBalance, 2) : $history_record->afterBalance;
				$transtion_date    = strtotime($history_record->createdAt);
				$transtion_date    = date("d-m-Y H:i:s", $transtion_date);
				$data[] = array(
					"date"      => $transtion_date,
					"provider"  => $history_record->providerName,
					"operation"    => $history_record->actionType,
					"amount" => add_currency_symbol($history_record->amount),
					"previous_balance" => add_currency_symbol($previous_balance),
					"subsequent_balance" => add_currency_symbol($subsequent_balance),
				);
			}
		} else {
			$totalRecords = 0;
			$totalRecordwithFilter = 0;
		}
	} else {
		$totalRecords = 0;
		$totalRecordwithFilter = 0;
	}

	$response = array(
		"draw" => intval($draw),
		"iTotalRecords" => $totalRecords,
		"iTotalDisplayRecords" => $totalRecordwithFilter,
		"aaData" => $data
	);
	echo json_encode($response);
	die;
}
/**
 * 
 * All finance Page AJax
 *  
 */
/** finance Agents operations page data table ajax call */
add_action('wp_ajax_summary_data', 'summary_data_callback');
add_action('wp_ajax_nopriv_summary_data', 'summary_data_callback');
function summary_data_callback()
{
	global $api_server_url;
	$rowperpage     = $_POST['length'];
	$start          = $_POST['start'];
	$draw           = $_POST['draw'];
	$sort_user_role = $_POST['sort_user_role'];
	$searchByName   = $_POST['search']['value'];


	$user_args = array();
	$user_args_page = array();

	$agere_casino_id = get_field('agere_casino_id', 'option');
	$agere_token = get_field('agere_token', 'option');
	$remote_id_string .= site_url('/') . '_' . get_current_user_id();

	$pag_no = ($start / $rowperpage) + 1;

	$summay_api = $api_server_url . "/casinos/casino-admin-reports?action=my-summary&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $remote_id_string . "&page=" . $pag_no . "&limit=" . $rowperpage;

	$summay_api_content = file_get_contents($summay_api);

	if (isset($summay_api_content) && !empty($summay_api_content)) {
		$summay_api_data = json_decode($summay_api_content);

		$summay_api_data = $summay_api_data->data;
		if (isset($summay_api_data) && !empty($summay_api_data)) {
			$final_balance = $summay_api_data->currentBalance;
			$totalRecords = $summay_api_data->totalCount;
			$totalRecordwithFilter = $summay_api_data->totalCount;
			$num = 1;
			foreach ($summay_api_data->txns as $key => $value) {
				if (!empty($value->comment) || !empty($value->image)) {
					$comment_status = !empty($value->comment) ? '' : 'disabled';
					$image_status = !empty($value->image) ? '' : 'disabled';
					$more_info_html = '<div class="table_attachment_row">
						<button type="button" class="sec-btn icon_btn"><i class="fas fa-paperclip"></i></button>
						<div class="table_attachment_hover">
							<button type="button" data-button-toggle="tooltip" title="Info" class="sec-btn icon_btn" disabled><i class="far fa-info"></i></button>
							<button type="button" data-button-toggle="tooltip" title="<span class=finance-comment-tooltip>' . htmlentities($value->comment, ENT_QUOTES) . '</span>" class="sec-btn icon_btn" ' . $comment_status . '><i class="far fa-comment"></i></button>
							<button data-fancybox="finance-attachment-' . $num++ . '" class="sec-btn icon_btn" href="' . $value->image . '" data-button-toggle="tooltip" title="<img src=' . $value->image . ' />" ' . $image_status . '><i class="far fa-image"></i></button>
						</div>
					</div>';
				} else {
					$more_info_html = '';
				}

				$data[] = array(
					"date" => date("d-m-Y H:i:s", strtotime($value->createdAt)),
					"operation" => $value->operation,
					"amount" => add_currency_symbol($value->amount),
					"balance" => add_currency_symbol($value->balance),
					"more-info" => $more_info_html,
					"mySummaryBalance" => add_currency_symbol($final_balance)
				);
			}
		}
	}

	$response = array(
		"draw" => intval($draw),
		"iTotalRecords" => $totalRecords,
		"iTotalDisplayRecords" => $totalRecordwithFilter,
		"aaData" => $data
	);
	echo json_encode($response);
	die;
}








add_action('wp_ajax_finance_agent_data', 'finance_agent_data_callback');
add_action('wp_ajax_nopriv_finance_agent_data', 'finance_agent_data_callback');
function finance_agent_data_callback()
{
	global $api_server_url;
	$rowperpage     = $_POST['length'];
	$start          = $_POST['start'];
	$draw           = $_POST['draw'];
	$sort_user_role = $_POST['sort_user_role'];
	$searchByName   = $_POST['search']['value'];
	$user_args = array();
	$user_args_page = array();
	$agere_casino_id = get_field('agere_casino_id', 'option');
	$agere_token = get_field('agere_token', 'option');

	// if(!empty($searchByName)) {
	//     global $wpdb;
	//     $table_name = $wpdb->prefix."users";
	//     $user_sql = "SELECT ID FROM ".$table_name." WHERE user_login LIKE '".$username."'";
	//     $total_result = $wpdb->get_results($user_sql);

	//     $user_remote_id_url = site_url('/') . '_';
	//     $search_user = array();
	//     if(!empty($total_result) && isset($total_result[0])) { 
	//         foreach ($total_result as $value) {
	//             $search_user[] = $user_remote_id_url.$value->ID;
	//         }
	//         $remote_id_string .= implode(",", $search_user);
	//     } else {
	//         $remote_id_string .= site_url('/') . '_' . get_current_user_id();    
	//     }
	// } else {
	$remote_id_string .= site_url('/') . '_' . get_current_user_id();
	// }

	$agent_balance_api = $api_server_url . "/casinos/casino-admin-reports?action=finance-user-list&type=" . $sort_user_role . "&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $remote_id_string;

	$agent_balance_content = file_get_contents($agent_balance_api);
	if (isset($agent_balance_content) && !empty($agent_balance_content)) {
		$agent_balance_data = json_decode($agent_balance_content);

		$agent_balance_data = $agent_balance_data->data;
		if (isset($agent_balance_data) && !empty($agent_balance_data)) {

			$totalBalance = $agent_balance_data->totalBalance;
			foreach ($agent_balance_data->users as $key => $agentData) {
				$cu_userID = $agentData->remoteId;
				$user_info = get_userdata($cu_userID);
				$user_role = "";

				if ($searchByName === "" || stripos($user_info->display_name, $searchByName) !== FALSE) {
					if (isset($user_info->roles[0]))        $user_role = $user_info->roles[0];
					$action_html = '<div class="table_btn_group"><ul><li><button data-user-id="' . $cu_userID . '" type="button" class="sec-btn icon_btn finance-modal-html-btn double-icon-btn" data-button-toggle="tooltip" title="Collect"data-balance="' . number_format($agentData->balance, 2) . '" data-payment-action="collect" data-modal-status="Collect" data-color-code="#32cd32" tabindex="0"><i class="far fa-plus"></i><i class="fas fa-sack-dollar"></i></button></li><li><button data-user-id="' . $cu_userID . '" type="button" class="sec-btn icon_btn finance-modal-html-btn double-icon-btn" data-button-toggle="tooltip" title="Registrer Payout" data-balance="' . number_format($agentData->balance, 2) . '" data-payment-action="payout" data-modal-status="Payout" data-color-code="#ff6347" ><i class="far fa-minus"></i><i class="fas fa-sack-dollar"></i></button></li><li><button data-user-id="' . $cu_userID . '" type="button" class="sec-btn icon_btn finance-modal-html-btn" data-button-toggle="tooltip" title="Discount" data-balance="' . number_format($agentData->balance, 2) . '" data-payment-action="discount" data-modal-status="Discount" data-color-code="#007700"><i class="far fa-minus"></i></button></li><li><button data-user-id="' . $cu_userID . '" type="button" class="sec-btn icon_btn finance-modal-html-btn" data-button-toggle="tooltip" title="Surcharge"data-balance="' . number_format($agentData->balance, 2) . '" data-payment-action="surcharge" data-modal-status="Surcharge" data-color-code="#c71585" tabindex="0"><i class="far fa-plus"></i></button></li></ul></div>';
					$user_data = array('name' => $user_info->display_name, "role" => $user_role);
					$data[] = array(
						"user_id" => $cu_userID,
						"username" => $user_data,
						"balance" => add_currency_symbol($agentData->balance, 2),
						"action" => $action_html,
						"totalamt" => add_currency_symbol($totalBalance, 2)
					);
				}
			}
		}
	}

	$response = array(
		"draw" => intval($draw),
		"iTotalRecords" => $totalRecords,
		"iTotalDisplayRecords" => $totalRecordwithFilter,
		"aaData" => $data
	);
	echo json_encode($response);
	die;
}


/** finance page action modal html ajax call */
add_action('wp_ajax_get_finance_modal_html', 'finance_modal_html');
add_action('wp_ajax_nopriv_get_finance_modal_html', 'finance_modal_html');
function finance_modal_html()
{
	$user_id = $_POST['user_id'];
	$modal_title = $_POST['modal_title'];
	$payment_action = $_POST['payment_action'];
	$status = $_POST['status'];
	$user_role = $_POST['user_role'];
	$balance = $_POST['balance'];
	$user_info = get_userdata($user_id);
	?>
	<h3 class="h3-title modal_title"><?php echo $modal_title; ?></h3>
	<form action="" class="finance_payment_form" enctype="multipart/form-data">
		<div class="form_input_group">
			<div class="input-group-prepend">
				<span class="input-group-text input-modal-addon">
					<i class="fas fa-user" aria-hidden="true"></i>
				</span>
			</div>
			<input type="text" class="form_input" name="" readonly value="<?php echo $user_info->user_login; ?>">
			<input type="text" class="form_input" name="user_current_balance" readonly value="<?php echo number_format($balance, 2); ?>">
		</div>
		<div class="form_input_group balance_input_group">
			<div class="d-flex">
				<div class="input-group-prepend">
					<span class="input-group-text input-modal-addon">
						<i class="fas fa-coins" aria-hidden="true"></i>
					</span>
				</div>
				<input type="number" class="form_input" name="user_balance" aria-label="amount" autocomplete="off" value="0" step=".01" placeholder="0.00">
			</div>
			<div class="table_btn_group form_right_group">
				<ul>
					<li>
						<button type="button" class="sec-btn icon_btn btn-balance-increase-action" data-button-toggle="tooltip" title="increase"><i class="far fa-plus"></i></button>
					</li>
					<li>
						<button type="button" class="sec-btn icon_btn btn-balance-decrease-action" data-button-toggle="tooltip" title="decrease"><i class="far fa-minus"></i></button>
					</li>
				</ul>
			</div>
		</div>
		<div class="add_coin_group">
			<ul>
				<li>
					<button type="button" data-value="100" class="sec-btn sm-btn" data-button-toggle="tooltip" title="increase 100"><i class="far fa-plus"></i>100</button>
				</li>
				<li>
					<button type="button" data-value="1000" class="sec-btn sm-btn" data-button-toggle="tooltip" title="increase 1,000"><i class="far fa-plus"></i>1,000</button>
				</li>
				<li>
					<button type="button" data-value="10000" class="sec-btn sm-btn" data-button-toggle="tooltip" title="increase  10,000"><i class="far fa-plus"></i>10,000</button>
				</li>
			</ul>
		</div>
		<div class="attachment_items">
			<div class="attachment_items_comment">
				<textarea name="additional_finance_comment" id="" cols="30" rows="10" class="form_input" placeholder="Comment..."></textarea>
			</div>
			<ul>
				<li>
					<div class="sec-btn sm-btn" data-button-toggle="tooltip" data-original-title="Attach image">
						<input type="file" name="attach_proof" id="attach_proof" accept="image/*" onchange="loadFile(event)" />
						<label for="attach_proof">
							<i class="far fa-images"></i>
						</label>
					</div>
				</li>
				<li>
					<button class="sec-btn sm-btn" type="button" id="proof_comment" data-button-toggle="tooltip" data-original-title="Add a comment">
						<i class="far fa-comment"></i>
					</button>
				</li>
			</ul>

			<div class="attach_proof_preview_wp" style="display: none;">
				<div class="attach_proof_preview">
					<img src="" alt="" id="finance-image-preview"> <!-- https://picsum.photos/1000 -->
					<button type="button" class="finance-image-preview-close close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>
		</div>
		<div class="modal_footer">
			<button type="submit" class="sec-btn">Submit</button>
			<span class="load-more">
				<i class="fad fa-spinner-third  fa-spin ajax-loader"></i>
			</span>
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<input type="hidden" name="user_role" value="<?php echo $user_role; ?>">
			<input type="hidden" name="balance_action" value="<?php echo $payment_action; ?>">
			<input type="hidden" name="payment_status" value="<?php echo $status; ?>">
		</div>
		<p class="error-msg"></p>
	</form>
<?php

	die;
}
/** Update User balance  */
add_action('wp_ajax_finance_balance_action', 'finance_user_payment_action');
add_action('wp_ajax_nopriv_finance_balance_action', 'finance_user_payment_action');
function finance_user_payment_action()
{
	global $api_server_url;
	$user_balance_data = $_POST['form_data'];
	parse_str($user_balance_data);
	$user_id = $user_id;
	$user_balance = $user_balance;
	$balance_action = $balance_action;
	$payment_status = $payment_status;
	$user_role = $user_role;
	$comment = isset($additional_finance_comment) && !empty($additional_finance_comment) ? "&comment=" . rawurlencode(str_replace(array("\'", '\"'), array("'", '"'), $additional_finance_comment)) : '';

	if (isset($_FILES['image_data']) && !empty($_FILES['image_data'])) {
		$image_allowed = array('png', 'jpg', 'jpeg');
		$extension = pathinfo($_FILES['image_data']['name'], PATHINFO_EXTENSION);

		if ($_FILES['image_data']['error'] != 0) {
			echo json_encode(array(
				'response' => 'error',
				'message'  => $_FILES['image_data']['error']
			));
			exit;
		}

		if (!in_array($extension, $image_allowed)) {
			echo json_encode(array(
				'response' => 'error',
				'message'  => 'Image file must be JPG, PNG or JPEG'
			));
			exit;
		}

		if ($_FILES['image_data']['size'] / 1024 / 1024 > 4) {
			$fileSize = $_FILES['image_data']['size'] / 1024 / 1024;
			echo json_encode(array(
				'response' => 'error',
				'message'  => 'Maximum file upload size is 4 MB'
			));
			exit;
		}

		if (!function_exists('wp_handle_upload')) require_once(ABSPATH . 'wp-admin/includes/file.php');

		$random_digits = rand(000000, 999999);
		$UploadDirectory = WP_CONTENT_DIR . '/uploads/casino-finance-operations/';
		$image_name = "{$user_id}-{$balance_action}-{$random_digits}-" . current_time('timestamp') . ".{$extension}";

		move_uploaded_file($_FILES['image_data']['tmp_name'], $UploadDirectory . $image_name);
	}
	$uploads_url = wp_upload_dir();
	$image_name = isset($image_name) && !empty($image_name) ? "&image={$uploads_url['baseurl']}/casino-finance-operations/{$image_name}" : '';

	$result = array();
	$agere_casino_id = get_field('agere_casino_id', 'option');
	$agere_token = get_field('agere_token', 'option');
	$remote_id_string .= site_url('/') . '_' . $user_id;
	$current_login .= site_url('/') . '_' . get_current_user_id();

	$finance_action_api = $api_server_url . "/casinos/casino-admin-reports?action=finance-user-list&type=" . $user_role . "-operation&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $remote_id_string . "&operation_type=" . $balance_action . "&amount=" . $user_balance . "&auth_id=" . $current_login . $comment . $image_name;

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $finance_action_api);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($curl);
	curl_close($curl);
	echo $output;

	die;
}
/** Agent and Player Current accounts page data table ajax */
add_action('wp_ajax_finance_report', 'finance_current_account_report');
add_action('wp_ajax_nopriv_finance_report', 'finance_current_account_report');
function finance_current_account_report()
{
	global $api_server_url;
	$rowperpage     = $_POST['length'];
	$start          = $_POST['start'];
	$draw           = $_POST['draw'];
	$searchByName   = $_POST['search']['value'];
	$start_date         = $_POST['start_date'];
	$start_date         = date("Y-m-d", strtotime($start_date));
	$start_time         = date("H:i:s", strtotime($_POST['start_time']));
	$end_date           = $_POST['end_date'];
	$end_date           = date("Y-m-d", strtotime($end_date));
	$end_time           = date("H:i:s", strtotime($_POST['end_time']));
	$start_date_time    = $start_date . "T" . $start_time;
	$end_date_time      = $end_date . "T" . $end_time;
	$userrole           = $_POST['userrole'];
	$userid             = $_POST['userid'];
	$status             = $_POST['status'];
	$agere_casino_id = get_field('agere_casino_id', 'option');
	$agere_token = get_field('agere_token', 'option');

	if ($userid == "all") {
		$remote_id_string = "all";
	} else {
		$remote_id_string = site_url('/') . '_' . $userid;
	}
	$current_login .= site_url('/') . '_' . get_current_user_id();
	if ($userrole == "agent") {
		$balance_report_api = $api_server_url . "/casinos/casino-admin-reports?action=finance-user-txns&type=agent-txns&token=" . $agere_token . "&casino=" . $agere_casino_id . "&user_search=" . $remote_id_string . "&auth_id=" . $current_login . "&operation_type=" . $status . "&startDate=" . $start_date_time . "&endDate=" . $end_date_time . "";
	}
	if ($userrole == "player") {
		$balance_report_api = $api_server_url . "/casinos/casino-admin-reports?action=finance-user-txns&type=player-txns&token=" . $agere_token . "&casino=" . $agere_casino_id . "&user_search=" . $remote_id_string . "&auth_id=" . $current_login . "&operation_type=" . $status . "&startDate=" . $start_date_time . "&endDate=" . $end_date_time . "";
	}
	$balance_report_content = file_get_contents($balance_report_api);
	if (isset($balance_report_content) && !empty($balance_report_content)) {
		$balance_report_data = json_decode($balance_report_content);

		$balance_report_data = $balance_report_data->data;

		// $status_total_amt =0;
		$status_total_amt = $balance_report_data->totalAmount;
		$num = 1;
		foreach ($balance_report_data->txns as $key => $value) {
			if (!empty($value->comment) || !empty($value->image)) {
				$comment_status = !empty($value->comment) ? '' : 'disabled';
				$image_status = !empty($value->image) ? '' : 'disabled';
				$more_info_html = '<div class="table_attachment_row">
					<button type="button" class="sec-btn icon_btn"><i class="fas fa-paperclip"></i></button>
					<div class="table_attachment_hover">
						<button type="button" data-button-toggle="tooltip" title="Info" class="sec-btn icon_btn" disabled><i class="far fa-info"></i></button>
						<button type="button" data-button-toggle="tooltip" title="<span class=finance-comment-tooltip>' . htmlentities($value->comment, ENT_QUOTES) . '</span>" class="sec-btn icon_btn" ' . $comment_status . '><i class="far fa-comment"></i></button>
						<button data-fancybox="finance-attachment-' . $num++ . '" class="sec-btn icon_btn" href="' . $value->image . '" data-button-toggle="tooltip" title="<img src=' . $value->image . ' />" ' . $image_status . '><i class="far fa-image"></i></button>
					</div>
				</div>';
			} else {
				$more_info_html = '';
			}

			$user_info = get_userdata($value->remoteId);
			$data[] = array(
				"date"      => date_format(date_create($value->createdAt), "d-m-Y H:i:s"),
				"user"      => $user_info->user_login,
				"status"    => $value->operation,
				"amount"    => add_currency_symbol($value->amount),
				"balance"   => add_currency_symbol($value->balance),
				"more-info" => $more_info_html,
				"totalamt"  => add_currency_symbol($status_total_amt)
			);
		}
	}

	$totalRecords = 0;
	$totalRecordwithFilter = 0;
	// $data = array();
	$response = array(
		"draw" => intval($draw),
		"iTotalRecords" => $totalRecords,
		"iTotalDisplayRecords" => $totalRecordwithFilter,
		"aaData" => $data,
	);
	echo json_encode($response);
	die;
}
/** Agent and Player Current accounts page data table ajax */
add_action('wp_ajax_casino_report', 'casino_game_reports');
add_action('wp_ajax_nopriv_casino_report', 'casino_game_reports');
function casino_game_reports()
{
	global $api_server_url;
	$rowperpage     = $_POST['length'];
	$start          = $_POST['start'];
	$draw           = $_POST['draw'];
	$searchByName   = $_POST['search']['value'];
	$tran_checkbox  = $_POST['tran_checkbox'];

	$start_date         = $_POST['start_date'];
	$start_date         = date("Y-m-d", strtotime($start_date));
	$start_time         = date("H:i:s", strtotime($_POST['start_time']));
	$end_date           = $_POST['end_date'];
	$end_date           = date("Y-m-d", strtotime($end_date));
	$end_time           = date("H:i:s", strtotime($_POST['end_time']));
	$start_date_time    = $start_date . "T" . $start_time;
	$end_date_time      = $end_date . "T" . $end_time;
	$username_search    = $_POST['username'];
	$current_user       = $_POST['current_user'];
	$matchType          = $_POST['matchType'];
	$betid              = $_POST['betId'];
	$transaction_type   = $_POST['transaction_type'];
	$casino_provider    = str_replace(' ', '%20', $_POST['provider']);

	global $wpdb;
	$agere_casino_id = get_field('agere_casino_id', 'option');
	$agere_token = get_field('agere_token', 'option');
	$transaction_type = $transaction_type === 'true' ? '&txnType=pending' : '';

	/** Get all child  */
	// $current_user = get_current_user_id();

	$cu_user_agent = array($current_user);
	$get_data_user_role = array('agent', 'player');
	$all_agent_data = get_current_agent_and_admin_user($current_user, $cu_user_agent, $get_data_user_role);
	$user_args_page['fields'] = array('ID', 'display_name');
	$user_args_page['meta_key'] = 'parent_user';
	$user_args_page['meta_value'] = $all_agent_data;
	$user_args_page['meta_compare'] = 'IN';
	$user_args_page['role__in'] =  array('player');
	$all_users = get_users($user_args_page);
	if (!empty($all_users) && isset($all_users)) {
		foreach ($all_users as $key => $user) {
			$user_id = $user->id;
			$curr_user_player[] = $user->id;
			$remote_id_string .= site_url('/') . '_' . $user_id . ',';
		}
	}

	if ($username_search != "") {
		$remote_id_string = "";
		global $wpdb;
		$table_name = $wpdb->prefix . "users";
		$user_sql = "select ID from " . $table_name . " where user_login = '" . $username_search . "'";
		$total_result = $wpdb->get_results($user_sql);
		if (isset($total_result) && !empty($total_result)) {
			foreach ($total_result as $key => $users) {
				$user_id = $users->ID;
				if (in_array($user_id, $curr_user_player)) {
					$remote_id_string .= site_url('/') . '_' . $user_id . ',';
				}
			}
		}
	}
	$pag_no = ($start / $rowperpage) + 1;
	if ($betid == "") {
		$casino_api = $api_server_url . '/casinos/report?report=casinoAdminPlayer&token=' . $agere_token . '&remote_id=' . $remote_id_string . '&casino=' . $agere_casino_id . '&start=' . $start_date_time . '&end=' . $end_date_time . '&matchType=' . $matchType . '&limit=' . $rowperpage . '&page=' . $pag_no . '&providerName=' . $casino_provider . $transaction_type;
	} else {
		$casino_api = $api_server_url . '/casinos/report?report=casinoAdminPlayer&token=' . $agere_token . '&remote_id=' . $remote_id_string . '&casino=' . $agere_casino_id . '&start=' . $start_date_time . '&end=' . $end_date_time . '&matchType=' . $matchType . '&transactionId=' . $betid . '&limit=' . $rowperpage . '&page=' . $pag_no . '&providerName=' . $casino_provider;
	}
	$reports_api_data = file_get_contents($casino_api);
	$casino_reports_data = json_decode($reports_api_data);

	if (isset($casino_reports_data) && !empty($casino_reports_data)) {
		$casino_reports_data  = $casino_reports_data->response;
		$transactions_data = $casino_reports_data->txns;
		$totalRecords = $casino_reports_data->count;
		$total_amount_pending = $casino_reports_data->totalAmountPending;
		$total_possible_win = $casino_reports_data->totalPossibleWin;

		$total_win_amount = $casino_reports_data->totalWinAmount;
		$total_win_amount_color = $total_win_amount > 0 ? 'bet-won' : 'bet-loss';
		$total_win_amount = "<b class='$total_win_amount_color'>" . add_currency_symbol($total_win_amount) . "</b>";

		foreach ($transactions_data as $key => $value) {
			$user_id = str_replace(site_url('/_'), '', $value->remoteId);
			$user_info = get_userdata($user_id);
			$username = $user_info->data->user_login;

			if ($matchType == "casino" || $matchType == "sports") {
				$data[] = array(
					"betId" => $value->transactionID,
					"date" => date_format(date_create($value->createdAt), "d-m-Y H:i:s"),
					"user" => $username,
					"operation" => $value->status,
					"amount" => add_currency_symbol($value->amount),
					"resultamount" => add_currency_symbol($value->resultAmount),
					"possiblewin" => add_currency_symbol($value->possibleWin),
					"totalAmountPending" => $total_amount_pending,
					"totalPossibleWin" => $total_possible_win,
					"totalwinamount"     => $total_win_amount
				);
			} else {
				$data[] = array(
					"date"      => date_format(date_create($value->createdAt), "d-m-Y H:i:s"),
					"user"      => $username,
					"buyin"     => $value->action == "debit" ? add_currency_symbol($value->amount) : '',
					"cashout"   => $value->action == "credit" ? add_currency_symbol($value->amount) : '',
					"rake"      => add_currency_symbol($value->rake)
				);
			}
		}
	}

	$response = array(
		"draw" => intval($draw),
		"iTotalRecords" => $totalRecords,
		"iTotalDisplayRecords" => $totalRecords,
		"aaData" => $data
	);
	echo json_encode($response);
	die;
}
add_action('user_register', 'backend_user_create');

function backend_user_create($user_id)
{

	global $woo_currency, $current_language, $api_server_url;
	$user_info = get_userdata($user_id);
	$user_role = "";
	if (isset($user_info->roles[0]))        $user_role = $user_info->roles[0];
	$parent_user = get_the_author_meta('parent_user', $user_id);
	if (empty($parent_user)) {
		$parent_user = get_current_user_id();
	}
	switch ($user_role) {
		case 'agent':
			$user_commission = get_the_author_meta('user_game_commission', $user_id, true);
			if (!empty($user_commission) && isset($user_commission)) {
				$user_commission = json_decode($user_commission);
			} else {
				$user_commission = array("sports" => '', "casino" => '', "poker" => '');
			}
			$settlement_type = get_the_author_meta('settlement_type', $user_id, true);
			// echo $user_commission;
			$data = array(
				"action"    => "player-agent-action",
				"remoteId"  => site_url() . "/_" . $user_id,
				"fatherId"  => site_url() . "/_" . $parent_user,
				"currency"  => $woo_currency,
				"role"      => $user_role,
				"commission" => $user_commission,
				"settlementType" => $settlement_type
			);

			$data = json_encode($data);

			break;
		case 'player':
			$data = array(
				"action"    => "player-agent-action",
				"remoteId"  => site_url() . "/_" . $user_id,
				"fatherId"  => site_url() . "/_" . $parent_user,
				"currency"  => $woo_currency,
				"role"      => $user_role,
			);

			$data = json_encode($data);
			break;
		case 'administrator':
			$user_commission = get_the_author_meta('user_game_commission', $user_id);
			if (!empty($user_commission) && isset($user_commission)) {
				$user_commission = json_decode($user_commission);
			} else {
				$user_commission = array("sports" => '', "casino" => '', "poker" => '');
			}
			$data = array(
				"action"    => "player-agent-action",
				"remoteId"  => site_url() . "/_" . $user_id,
				"fatherId"  => site_url() . "/_" . $parent_user,
				"currency"  => $woo_currency,
				"role"      => $user_role,
				"commission" => $user_commission,
				"settlementType" => $settlement_type
			);

			$data = json_encode($data);
			break;

		default:
			break;
	}

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
		$result = curl_exec($curl);
	}
	// die;
}
/** Agent and Player Global data table ajax */
add_action('wp_ajax_global_reports', 'global_current_account_report');
add_action('wp_ajax_nopriv_global_reports', 'global_current_account_report');
function global_current_account_report()
{
	global $api_server_url;
	$draw           = $_POST['draw'];
	$searchByName   = $_POST['search']['value'];
	$start_date         = $_POST['start_date'];
	$start_date         = date("Y-m-d", strtotime($start_date));
	$start_time         = date("H:i:s", strtotime($_POST['start_time']));
	$end_date           = $_POST['end_date'];
	$end_date           = date("Y-m-d", strtotime($end_date));
	$end_time           = date("H:i:s", strtotime($_POST['end_time']));
	$start_date_time    = $start_date . "T" . $start_time;
	$end_date_time      = $end_date . "T" . $end_time;
	// $start_date_time    = strtotime($start_date." ".$start_time);
	// $start_date_time    = date("Y-m-deH:i:s",$start_date_time);
	// $end_date_time      = strtotime($end_date." ".$end_time);
	// $end_date_time      = date("Y-m-deH:i:s",$end_date_time);
	$userid     = $_POST['user_id'];
	$status     = $_POST['status'];
	$username   = $_REQUEST['username'];
	$details_btn = $_REQUEST['details'];
	global $wpdb;
	$table_name = $wpdb->prefix . "users";
	$user_sql = "select ID from " . $table_name . " where user_login = '" . $username . "'";
	$total_result = $wpdb->get_results($user_sql);
	if (isset($total_result) && isset($total_result[0])) {
		if (isset($total_result[0]->ID) && !empty($total_result[0]->ID)) {
			$userid = $total_result[0]->ID;
		}
	}
	$agere_casino_id = get_field('agere_casino_id', 'option');
	$agere_token = get_field('agere_token', 'option');
	$remote_id_string .= site_url('/') . '_' . $userid;

	$global_reports_api = $api_server_url . "/casinos/casino-admin-reports?action=global-agent-report&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $remote_id_string . "&start=" . $start_date_time . "&end=" . $end_date_time;
	$global_reports_content = file_get_contents($global_reports_api);

	if (isset($global_reports_content) && !empty($global_reports_content)) {
		$global_reports_data = json_decode($global_reports_content);

		$total_amt = 0;
		if (isset($global_reports_data->result)) {

			$totalAgentsCredits = $global_reports_data->result->totalAgentsCredits;
			$totalPlayerCredits = $global_reports_data->result->totalPlayerCredits;

			$total_amt = number_format($global_reports_data->result->totalToPay, 2);
			$global_reports_data = $global_reports_data->result->data;

			foreach ($global_reports_data as $key => $reports_data) {

				$current_user_info = get_userdata(get_current_user_id());
				$casino_admin =  get_user_meta(get_current_user_id(), 'casino_admin', true);
				if ((isset($casino_admin) && !empty($casino_admin) && $casino_admin == 1) || $current_user_info->roles[0] === 'administrator') {
					if ($details_btn == 1) {
						$providers_data = $reports_data->providers;
						$data[] = array(
							"category"				=> $reports_data->category,
							"bets"				    => $reports_data->betsCount,
							"bet"					=> add_currency_symbol($reports_data->bets),
							"win"					=> add_currency_symbol($reports_data->credits),
							// "netwin"				=> add_currency_symbol($reports_data->netwin),
							"commission"			=> add_currency_symbol($reports_data->commission),
							"paytoagents"			=> add_currency_symbol($reports_data->payAmount),
							"totalamt"				=> add_currency_symbol($total_amt),
							"totalAgentsCredits"	=> add_currency_symbol($totalAgentsCredits),
							"totalPlayerCredits"	=> add_currency_symbol($totalPlayerCredits),
							"class"					=> "game_type"
						);
						foreach ($providers_data as $key => $provider) {

							$data[] = array(
								"category"			=> $provider->name,
								"bets"				=> $provider->betsCount,
								"bet"				=> add_currency_symbol($provider->bets),
								"win"				=> add_currency_symbol($provider->credits),
								// "netwin"			=> add_currency_symbol($provider->netwin),
								"commission"		=> add_currency_symbol($provider->commission),
								"paytoagents"		=> add_currency_symbol($provider->payAmount),
								"totalamt"			=> add_currency_symbol($total_amt),
								"class"				=> "game_provider"
							);
						}
					} else {
						$data[] = array(
							"category"				=> $reports_data->category,
							"bets"					=> $reports_data->betsCount,
							"bet"					=> add_currency_symbol($reports_data->bets),
							"win"					=> add_currency_symbol($reports_data->credits),
							// "netwin"				=> add_currency_symbol($reports_data->netwin),
							"commission"			=> add_currency_symbol($reports_data->commission),
							"paytoagents"			=> add_currency_symbol($reports_data->payAmount),
							"totalamt"				=> add_currency_symbol($total_amt),
							"class"					=> ""
						);
					}
				} else {
					if ($details_btn == 1) {
						$providers_data = $reports_data->providers;
						$data[] = array(
							"category"				=> $reports_data->category,
							"bets"					=> $reports_data->betsCount,
							"bet"					=> add_currency_symbol($reports_data->bets),
							"win"					=> add_currency_symbol($reports_data->credits),
							// "netwin"				=> add_currency_symbol($reports_data->netwin),
							"commission"			=> add_currency_symbol($reports_data->commission),
							// "paytoagents"		=> add_currency_symbol($reports_data->payAmount),
							"totalamt"				=> add_currency_symbol($total_amt),
							"totalAgentsCredits"	=> add_currency_symbol($totalAgentsCredits),
							"totalPlayerCredits"	=> add_currency_symbol($totalPlayerCredits),
							"class"					=> "game_type"
						);
						foreach ($providers_data as $key => $provider) {

							$data[] = array(
								"category"			=> $provider->name,
								"bets"				=> $provider->betsCount,
								"bet"				=> add_currency_symbol($provider->bets),
								"win"				=> add_currency_symbol($provider->credits),
								// "netwin"			=> add_currency_symbol($provider->netwin),
								"commission"		=> add_currency_symbol($provider->commission),
								// "paytoagents"	=> add_currency_symbol($provider->payAmount),
								"totalamt"			=> add_currency_symbol($total_amt),
								"class"				=> "game_provider"
							);
						}
					} else {
						$data[] = array(
							"category"				=> $reports_data->category,
							"bets"					=> $reports_data->betsCount,
							"bet"					=> add_currency_symbol($reports_data->bets),
							"win"					=> add_currency_symbol($reports_data->credits),
							// "netwin"				=> add_currency_symbol($reports_data->netwin),
							"commission"			=> add_currency_symbol($reports_data->commission),
							// "paytoagents"		=> add_currency_symbol($reports_data->payAmount),
							"totalamt"				=> add_currency_symbol($total_amt),
							"class"					=> ""
						);
					}
				}
			}
		}
	}

	$response = array(
		"draw" => intval($draw),
		"aaData" => $data,
	);
	echo json_encode($response);
	die;
}
add_action('wp_ajax_player_global_reports', 'player_global_reports_callback');
add_action('wp_ajax_nopriv_player_global_reports', 'player_global_reports_callback');
function player_global_reports_callback()
{
	global $api_server_url;
	$draw           = $_POST['draw'];
	$searchByName   = $_POST['search']['value'];
	$start_date         = $_POST['start_date'];
	$start_date         = date("Y-m-d", strtotime($start_date));
	$start_time         = date("H:i:s", strtotime($_POST['start_time']));
	$end_date           = $_POST['end_date'];
	$end_date           = date("Y-m-d", strtotime($end_date));
	$end_time           = date("H:i:s", strtotime($_POST['end_time']));
	$start_date_time    = $start_date . "T" . $start_time;
	$end_date_time      = $end_date . "T" . $end_time;
	$username   = $_REQUEST['username'];
	$userid = "";
	global $wpdb;
	$table_name = $wpdb->prefix . "users";
	$user_sql = "select ID from " . $table_name . " where user_login = '" . $username . "'";
	$total_result = $wpdb->get_results($user_sql);
	if (isset($total_result) && isset($total_result[0])) {
		if (isset($total_result[0]->ID) && !empty($total_result[0]->ID)) {
			$userid = $total_result[0]->ID;
		}
	}
	if (!empty($userid)) {
		$agere_casino_id = get_field('agere_casino_id', 'option');
		$agere_token = get_field('agere_token', 'option');
		$remote_id_string .= site_url('/') . '_' . $userid;


		$global_reports_api = $api_server_url . "/casinos/casino-admin-reports?action=global-player-report&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $remote_id_string . "&start=" . $start_date_time . "&end=" . $end_date_time;

		$global_reports_content = file_get_contents($global_reports_api);
		if (isset($global_reports_content) && !empty($global_reports_content)) {
			$global_reports_data = json_decode($global_reports_content);
			$player_balance = $global_reports_data->balance;

			if (isset($global_reports_data->data)) {
				$player_report_data = $global_reports_data->data;
				$updatedTime = date('m-d-Y H:i:s', strtotime($global_reports_data->updatedTime));
				$loadsAndWithdraw = $global_reports_data->loadsAndWithdraw;
				$player_bets = $loadsAndWithdraw->bets;
				$player_credits = $loadsAndWithdraw->credits;
				$player_ggr = $loadsAndWithdraw->ggr;

				foreach ($player_report_data as $key => $reportData) {
					$data[] = array(
						"category"      => $reportData->category,
						"bets"          => add_currency_symbol($reportData->bets),
						"win"           => add_currency_symbol($reportData->credits),
						"netwin"        => add_currency_symbol($reportData->ggr),
						"rakes"         => add_currency_symbol($reportData->rakes),
						"playerBalance" => add_currency_symbol($player_balance),
						"playerBets"    => add_currency_symbol($player_bets),
						"playerCredits" => add_currency_symbol($player_credits),
						"playerGGR"     => add_currency_symbol($player_ggr),
						"updatedTime"   => $updatedTime
					);
				}
			}
		}
	} else {
		$data = array();
	}

	$response = array(
		"draw" => intval($draw),
		"aaData" => $data,
	);
	echo json_encode($response);
	die;
}

// $users = get_users(
//     array(
//         'role' => 'agent',
//         'meta_key' => 'casino_admin',
//         'meta_value' => 1
//     )
// );
										

// foreach($users as $user){
//     $recipient_email = $user->data->user_email;  
//     echo '<pre>'; print_r( $recipient_email); echo '</pre>';
// }
// die;