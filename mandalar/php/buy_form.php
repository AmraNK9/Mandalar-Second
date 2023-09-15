<?php
include_once "../controller/buyerController.php";
include_once "../controller/postController.php";
$post_controller=new PostController();
$buyer_controller=new BuyerController();
$user_id=$_POST['user_id'];
$post_id=$_POST['post_id'] ;
$phone=$_POST['buyer_phone'];
$city=$_POST['city'];
$address=$_POST['buyer_address'];
$buyer_controller->createBuyerInfo($user_id,$phone,$city,$address);
$buyer_id=$buyer_controller->getBuyerId($user_id,$phone,$city,$address);
$buyer_info_id=$buyer_id[0]['id'];
$buy_date = date('Y-m-d H:i:s');
$status="seller_waiting";
$post_controller->updateBuyer($user_id,$buyer_info_id,$status,$post_id,$buy_date);
echo "success";

?>