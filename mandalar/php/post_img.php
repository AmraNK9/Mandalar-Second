<?php

$img_file=$_FILES['post_img'];
// Convert the array to JSON format
$post_file = json_encode($img_file);

// Set the response content type to JSON
header('Content-Type: application/json');

// Output the JSON data
echo $post_file;

?>