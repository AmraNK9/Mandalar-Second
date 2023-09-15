<?php
include_once "../controller/postController.php";
include_once "../controller/sellerController.php";
$post_controller=new PostController();
$seller_controller=new SellerController();
$user_id=$_POST["user_id"];
$post_list=$post_controller->getSellerPost($user_id);
$phone=$_POST['seller_phone'];
$address=$_POST['seller_address'];
$city=$_POST['city'];
$seller_controller->createSellerInfo($user_id,$phone,$city,$address);
$seller_id=$seller_controller->getSellerId($user_id,$phone,$city,$address);
$seller_info_id=$seller_id[0]['id'];
$status="waiting";
$post_controller->updateSeller($seller_info_id,$status,$post_list[0]['id']);
echo "success";

?>