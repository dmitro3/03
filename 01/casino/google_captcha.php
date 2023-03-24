<?php
include "../../../wp-load.php";

$data;
header('Content-Type: application/json');
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_POST['g-recaptcha-response'])) {
  $captcha=$_POST['g-recaptcha-response'];
}
if(!$captcha){
  $data=array('nocaptcha' => 'true');
  echo json_encode($data);
  exit;
 }
 // calling google recaptcha api.
$secret_key = get_field('register_page_recaptcha_secret_key', 'option');
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
 // validating result.
 if($response.success==false) {
    $data=array('spam' => 'true');
    echo json_encode($data);
 } else {
    $data=array('spam' => 'false');
    echo json_encode($data);
 }
?>