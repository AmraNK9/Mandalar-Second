<?php
session_start();
include_once "../controller/userController.php";
include_once "../controller/postController.php";

$user_id=$_SESSION['user_id'];
$kpay_name=$_POST['kpay_name'];
$kpay_ph=$_POST['kpay_ph'];
$kpay_amount=$_POST['withdraw_amount'];
$status='wait';
include_once "available_money.php";
if($kpay_amount <= $available_money){
$user_controller->withdraw_amount($user_id,$kpay_name,$kpay_ph,$kpay_amount,$status);
echo 'success';
}else{
    echo "not enough";
}
?>