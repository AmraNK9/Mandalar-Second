<?php
include_once "../../controller/postController.php";
$post_controller=new PostController();
$seller_city=$_GET['seller_city'];
$buyer_city=$_GET['buyer_city'];
$selectedStatus=$_GET['selectedStatus'];
$post_list=$post_controller->getPostByCity($seller_city,$buyer_city,$selectedStatus);
// Convert the array to JSON format
$jsonData = json_encode($post_list);

// Set the response content type to JSON
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;

?>
