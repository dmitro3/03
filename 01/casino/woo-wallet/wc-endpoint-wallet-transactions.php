<?php

/**
 * The Template for displaying transaction history
 *
 * This template can be overridden by copying it to yourtheme/woo-wallet/wc-endpoint-wallet-transactions.php.
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @author 	Subrata Mal
 * @version     1.0.0
 */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


$request = $_SERVER['REQUEST_URI'];
if (substr($request, 0, 4) === "/es/") {
    $language = 'es';
} else {
    $language = 'en';
}




if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$transactions = get_wallet_transactions();
do_action('woo_wallet_before_transaction_details_content');
?>


<?php if ($language == 'en') { ?>



    <p>
        <span><?php _e('Current balance :', 'woo-wallet'); ?></span>
        <?php echo woo_wallet()->wallet->get_wallet_balance(get_current_user_id()); ?> <a href="<?php echo is_account_page() ? esc_url(wc_get_account_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'))) : get_permalink(); ?>"><span class="dashicons dashicons-editor-break"></span></a>
    </p>

    <div class="block">
        <div class="content">

            <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                <thead>
                    <tr>
                        <th><?php _e('ID', 'woo-wallet'); ?></th>
                        <th><?php _e('Credit', 'woo-wallet'); ?></th>
                        <th><?php _e('Debit', 'woo-wallet'); ?></th>
                        <th><?php _e('Details', 'woo-wallet'); ?></th>
                        <th><?php _e('Date', 'woo-wallet'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $key => $transaction) :
                        // $details = $transaction->details ? $transaction->details : '';
                        $details = '';
                    ?>
                        <tr>
                            <td><?php echo "1"; ?></td>
                            <td><?php echo $transaction->action == 'credit' ? wc_price(apply_filters('woo_wallet_amount', $transaction->amount, $transaction->currency, get_current_user_id())) : ' - '; ?>
                            </td>
                            <td><?php echo $transaction->action == 'debit' ? wc_price(apply_filters('woo_wallet_amount', $transaction->amount, $transaction->currency, get_current_user_id())) : ' - '; ?>
                            </td>
                            <td><?php echo $details; ?></td>
                            <td><?php echo wc_string_to_datetime($transaction->createdAt)->date_i18n(wc_date_format()); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
} elseif ($language == 'es') {
?>




    <p>
        <span><?php _e('Saldo :', 'woo-wallet'); ?></span>
        <?php echo woo_wallet()->wallet->get_wallet_balance(get_current_user_id()); ?>
        <a href="/mi-cuenta/wallet/"><span class="dashicons dashicons-editor-break"></span></a>
    </p>

    <div class="block">
        <div class="content">

            <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped sortable">
                <thead>
                    <tr>
                        <th><?php _e('ID', 'woo-wallet'); ?></th>
                        <th><?php _e('Credito', 'woo-wallet'); ?></th>
                        <th><?php _e('Debito', 'woo-wallet'); ?></th>
                        <th><?php _e('Detalles', 'woo-wallet'); ?></th>
                        <th><?php _e('Fecha', 'woo-wallet'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $key => $transaction) :
                        // $details = $transaction->details ? $transaction->details : '';
                        $details = '';
                    ?>
                        <tr>
                            <td><?php echo "1"; ?></td>
                            <td><?php echo $transaction->action == 'credit' ? wc_price(apply_filters('woo_wallet_amount', $transaction->amount, $transaction->currency, get_current_user_id())) : ' - '; ?>
                            </td>
                            <td><?php echo $transaction->action == 'debit' ? wc_price(apply_filters('woo_wallet_amount', $transaction->amount, $transaction->currency, get_current_user_id())) : ' - '; ?>
                            </td>
                            <td><?php echo $details; ?></td>
                            <td><?php echo wc_string_to_datetime($transaction->createdAt)->date_i18n(wc_date_format()); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>







<?php } ?>
<?php do_action('woo_wallet_after_transaction_details_content');
