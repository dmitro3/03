<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



$request = $_SERVER['REQUEST_URI'];
if (substr( $request, 0, 4 ) === "/es/"){
$language ='es';    
}else{
$language ='en';
}
?>
<p><?php

	/* translators: 1: order number 2: order date 3: order status */
	printf(
		__( 'Bet #%1$s was placed on %2$s and is currently %3$s.', 'woocommerce' ),
		'' . $order->get_order_number() . '',
		'' . wc_format_datetime( $order->get_date_created() ) . '',
		'' . wc_get_order_status_name( $order->get_status() ) . ''
	);
?></p>

<?php if ( $notes = $order->get_customer_order_notes() ) : ?>
	<h2><?php _e( 'Order updates', 'woocommerce' ); ?></h2>
	<ol class="woocommerce-OrderUpdates commentlist notes">
		<?php foreach ( $notes as $note ) : ?>
		<li class="woocommerce-OrderUpdate comment note">
			<div class="woocommerce-OrderUpdate-inner comment_container">
				<div class="woocommerce-OrderUpdate-text comment-text">
					<p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); ?></p>
					<div class="woocommerce-OrderUpdate-description description">
						<?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
					</div>
	  				<div class="clear"></div>
	  			</div>
				<div class="clear"></div>
			</div>
		</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>






<?php

// Get an instance of the WC_Order object
$order = wc_get_order($order_id);

 echo '<table class="table table-striped table-bordered">';
	echo '<tr>';
		echo '<th>Name</th>';
		echo '<th>Bet Type</th>';
		echo '<th>Bet Amount</th>';
   		echo '<th>To Win</th>';
	echo '</tr>';
	echo '<tr>';
	
// Iterating through each WC_Order_Item_Product objects
foreach ($order->get_items() as $item_key => $item_values):

    ## Using WC_Order_Item methods ##

    // Item ID is directly accessible from the $item_key in the foreach loop or
    $item_id = $item_values->get_id();

    ## Using WC_Order_Item_Product methods ##

    $item_name = $item_values->get_name(); // Name of the product
    $item_type = $item_values->get_type(); // Type of the order item ("line_item")

    $product_id = $item_values->get_product_id(); // the Product id
    $product = $item_values->get_product(); // the WC_Product object

    ## Access Order Items data properties (in an array of values) ##
    $item_data = $item_values->get_data();

    $product_name = $item_data['name'];
    $product_id = $item_data['product_id'];
    $variation_id = $item_data['variation_id'];
    $quantity = $item_data['quantity'];
    $tax_class = $item_data['tax_class'];
    $line_subtotal = $item_data['subtotal'];
    $line_subtotal_tax = $item_data['subtotal_tax'];
    $line_total = $item_data['total'];
    $line_total_tax = $item_data['total_tax'];
    $meta_data = $item_data['meta_data'];
    // Get data from The WC_product object using methods (examples)
    //$product_type   = $product->get_type();
    //$product_sku    = $product->get_sku();
    //$product_price  = $product->get_price();
    //$stock_quantity = $product->get_stock_quantity();
 
    
    




$count = count($meta_data);

if ($item_name == "Wallet Topup"){
	echo '<td>Wallet Topup</td>';
 	echo '<td></td>';
	echo '<td> &#8383 '.$line_subtotal.'</td>';
}elseif ($item_name == "Casino Bet"){
	echo '<td>Casino Bet</td>';
 	echo '<td></td>';
       
	echo '<td> &#8383 '.$line_subtotal.'</td>';
}else{
    for ($x = 0; $x < $count; $x++) {
               
        if($meta_data[$x]->key == 'Event Name'){
            echo '<td>'.$meta_data[$x]->value.'</td>';
        }
        
        if($meta_data[$x]->key == 'Name'){
            $name = $meta_data[$x]->value;
        }
        if($meta_data[$x]->key == 'Line'){
            echo '<td>'.$name . ' ' . $meta_data[$x]->value.'</td>';
        }        
        if($meta_data[$x]->key == 'Team Name'){
            echo '<td>'.$meta_data[$x]->value.'</td>';
        }

        if($meta_data[$x]->key == 'Spread'){
            echo '<td>Spread '.$meta_data[$x]->value.'</td>';
           // echo '<td>Spread '.$meta_data[$x]->value.' '.$meta_data[2]->value.'</td>';
        }
        
        if(($meta_data[$x]->value <> '') && ($meta_data[$x]->key == 'Moneyline')){
            echo '<td>MoneyLine '.$meta_data[$x]->value.'</td>';
        }


        if(($meta_data[$x]->value <> '') && ($meta_data[$x]->key == 'Totals Over')){
            echo '<td>Total Points Over '.$meta_data[$x]->value.'</td>';
        }

         if(($meta_data[$x]->value <> '') && ($meta_data[$x]->key == 'Totals Under')){
            echo '<td>Total Points Under '.$meta_data[$x]->value.'</td>';
        }       
         if(($meta_data[$x]->value <> '') && ($meta_data[$x]->key == 'Team Total Over')){
            echo '<td>Team Points Over '.$meta_data[$x]->value.'</td>';
        }            
         if(($meta_data[$x]->value <> '') && ($meta_data[$x]->key == 'Team Total Under')){
            echo '<td>Team Points Under  '.$meta_data[$x]->value.'</td>';
        }            
        
         if(($meta_data[$x]->value <> '') && ($meta_data[$x]->key == 'Team Total Under')){
            echo '<td>Team Points Under  '.$meta_data[$x]->value.'</td>';
        }          
        
        
        if(($meta_data[$x]->value <> '') && ($meta_data[$x]->key == 'To Win')){
            $to_win = $meta_data[$x]->value;
        }         
        
        
}
		echo '<td> &#36; '.number_format($line_subtotal,2).'</td>';
		echo '<td> &#36; '.number_format($to_win,2).'</td>';
		
              
		echo '</td>';
	echo '</tr>';
}
endforeach;
echo '</table>';



?>
</div>