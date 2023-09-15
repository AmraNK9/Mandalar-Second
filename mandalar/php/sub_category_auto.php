<?php
include_once "../controller/postController.php";
$post_controller= new PostController();
$id=1;
$sub_category_list= $post_controller->getSubCategoryList($id);
// Convert the array to JSON format
$jsonData = json_encode($sub_category_list);

// Set the response content type to JSON
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;

?>