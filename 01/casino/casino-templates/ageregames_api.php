<?php
/**
 * Template Name: API Agere Games Page
 *
 * API Agere Games Page.
 *
 * @author Plutus
 * @since 1.0.0
 * 
 *
 *
 *
 *  balance
 *  https://blissbets.com/agere-games-feq723f9/?action=balance&session_id=38432ff064690c9b03da519d0c685b1045451c9e&remote_id=6
 *
 *
 *
 *  win
 *  https://blissbets.com/agere-games-feq723f9/?action=credit&action_type=WIN&session_id=38432ff064690c9b03da519d0c685b1045451c9e&remote_id=6&amount=0.1&key=BA505C93BC46D04C82265B25FB7E8EF26B048ED3
 *
 *
 * debit
 * https://blissbets.com/agere-games-feq723f9/?action=debit&action_type=BET&amount=0.01&remote_id=6&transaction_id=13173376-a92e28&game_id=14&round_id=-2147177346&session_id=b11403-331751&key=86ee6a3f21fd91bbf9e5191960ccff0edfbf0495
 */

$url = $_SERVER['REQUEST_URI'];
$url = str_replace("?","",$url);
$url = str_replace("/agere6hw547w54_wqe5b/","",$url);
$url = substr($url, 0, strpos($url, "&key"));
if(!isset($_GET['key'])){
    die;    
}
elseif($_GET['key'] != (sha1($gameart_key . $url))){
    die;
}
else{



    if(isset($_REQUEST['action'])){
        if(isset($_REQUEST['transaction_id'])){
            $casino_transactions_id = $_GET['transaction_id'];
        }
        if(isset($_REQUEST['remote_id'])){
            $user_account = $_GET['remote_id'];
        }    
        if(isset($_REQUEST['amount'])){
        $amount = $_GET['amount'];
        }  
    
        if ($_GET['action'] == 'balance'){
            $balance = strip_tags(woo_wallet()->wallet->get_wallet_balance($user_account), 0);
            $balance = substr($balance, 5);
            $balance  = preg_replace( '/[^0-9.]/', '', $balance  );

            $balance = str_replace(',', '', $balance);
            clear_woo_wallet_cache( $user_account );
 
            $json_response["status"] = 200;
            $json_response["balance"] = $balance;
            echo json_encode($json_response);
        }//end balance
        elseif ($_GET['action'] == 'debit'){
            if ($_GET['action_type'] == 'BET'){
                $balance = strip_tags(woo_wallet()->wallet->get_wallet_balance($user_account), 0);
                $balance = substr($balance, 5);
                $balance = str_replace(',', '', $balance);                        
                clear_woo_wallet_cache( $user_account );
                    
                    if (!function_exists('woo_wallet') || ($balance < $amount)) {
                        $json_response['status'] = 403;
                        $json_response["balance"] = $balance;
                        $json_response["msg"] = "Insufficient funds";
                        echo json_encode($json_response);
                    }//order failed
                    elseif ($balance >= $amount){
                        woo_wallet()->wallet->debit($user_account, $amount, 'Casino Bet: Urgent Games - ' . $casino_transactions_id);
                $balance = strip_tags(woo_wallet()->wallet->get_wallet_balance($user_account), 0);
                $balance = substr($balance, 5);
                $balance = str_replace(',', '', $balance);                        
                
                clear_woo_wallet_cache( $user_account );
                        
                        $json_response['status'] = 200;
                        $json_response["balance"] = $balance;
                        echo json_encode($json_response);
                    }//oder completed
            }//end action_type BET
            elseif ($_GET['action_type'] == 'BET_FREE'){
                $balance = strip_tags(woo_wallet()->wallet->get_wallet_balance($user_account), 0);
                $balance = substr($balance, 5);
                $balance = str_replace(',', '', $balance);                        
                
                clear_woo_wallet_cache( $user_account );
                
                $json_response['status'] = 200;
                $json_response["balance"] = $balance;
                echo json_encode($json_response);
            }//end action_type BET_FREE            
        }//end debit
        elseif ($_GET['action'] == 'credit'){
            if( $amount > 0){
            if ($_GET['action_type'] == 'WIN'){
                woo_wallet()->wallet->credit($user_account, $amount, 'Casino Win: Urgent Games - ' . $casino_transactions_id);
                $balance = strip_tags(woo_wallet()->wallet->get_wallet_balance($user_account), 0);
                $balance = substr($balance, 5);
                $balance = str_replace(',', '', $balance);                        
                
                clear_woo_wallet_cache( $user_account );
            
                $json_response['status'] = 200;
                $json_response["balance"] = $balance;
                echo json_encode($json_response);
            }//end action_type WIN
            elseif ($_GET['action_type'] == 'WIN_FREE'){
                    woo_wallet()->wallet->credit($user_account, $amount, 'Casino Free Win: Urgent Games - ' . $casino_transactions_id);
                $balance = strip_tags(woo_wallet()->wallet->get_wallet_balance($user_account), 0);
                $balance = substr($balance, 5);
                $balance = str_replace(',', '', $balance);                        
                
                clear_woo_wallet_cache( $user_account );

                $json_response['status'] = 200;
                $json_response["balance"] = $balance;
                echo json_encode($json_response);
            }//end action_type WIN_FREE    
        }       
        }//end credit
        elseif ($_GET['action'] == 'rollback'){
            woo_wallet()->wallet->credit($user_account, $amount, 'Rollback: Urgent Games - ' . $casino_transactions_id);
            $balance = strip_tags(woo_wallet()->wallet->get_wallet_balance($user_account), 0);
            $balance = substr($balance, 5);
            $balance = str_replace(',', '', $balance);                        
            
            clear_woo_wallet_cache( $user_account );
            
                $json_response['status'] = 200;
                $json_response["balance"] = $balance;
                echo json_encode($json_response); 
        }//end action rollback
    }//end action block
}
?> 