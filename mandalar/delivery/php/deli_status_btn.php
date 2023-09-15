<?php
include_once "../../controller/postController.php";
include_once "../../controller/userController.php";
$post_controller=new PostController();
$user_controller=new UserController();
$status=$_GET['status'];
if($status!='sold_out'){
    $post_id=$_GET['post_id'];
    $post_controller->deli_status_update($status,$post_id);
    echo 'success';
}else{
    $post_id=$_GET['post_id'];
    $post=$post_controller->getPost($post_id);
    $buyer_id=$post[0]['buyer_id'];
    $seller_id=$post[0]['seller_id'];
    $cost=$post[0]['price'];
    $buyer=$user_controller->UserInfo($buyer_id);
    $seller=$user_controller->UserInfo($seller_id);
    $buyer_money=$buyer[0]['wallet'];
    $seller_money=$seller[0]['wallet'];
    $buyer_result_money=$buyer_money-$cost;
    $seller_result_money=$seller_money+$cost;
    $user_controller->UpdateAmount($buyer_id,$buyer_result_money);
    $user_controller->UpdateAmount($seller_id,$seller_result_money);
    $post_controller->deli_status_update($status,$post_id);
    echo 'success';
}

?>