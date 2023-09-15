<?php
include_once "../../controller/postController.php";
include_once "../../controller/deliveryController.php";
$post_controller=new PostController();
$delivery_controller=new DeliveryController();
$status=$_POST['status'];
$check_post=$_POST['check_post'];
$delivery=$_POST['delivery'];
if($status == 'waiting'){
    $stats='take_waiting';
    foreach ($check_post as $check) {
        $post_controller->deli_command($stats,$check);
        $delivery_controller->deli_order($check,$delivery);
    }
}elseif($status == 'take'){
    $stats='send_waiting';
    foreach ($check_post as $check) {
        $post_controller->deli_command($stats,$check);
    }
}


echo 'success';

?>