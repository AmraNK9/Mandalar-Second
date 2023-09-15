<?php
include_once "../controller/postController.php";
$post_controller= new PostController();
$category_list= $post_controller->getCategoryList();
// Convert the array to JSON format
$jsonData = json_encode($category_list);

// Set the response content type to JSON
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;

?>