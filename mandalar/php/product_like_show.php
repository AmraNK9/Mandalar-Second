<?php
include_once "../controller/product_likeController.php";
$product_like_controller = new ProductLikeController();
$product_like_list = $product_like_controller->getPostReact();
$post_id = $_GET["postId"];
$user_id = $_GET["userId"];
$found = false; // Initialize a flag variable

if (isset($product_like_controller)) {
    foreach ($product_like_list as $product_like) {
        if ($product_like["post_id"] == $post_id && $product_like["user_id"] == $user_id) {
            // Matching record found
            $found = true;
            break; // No need to continue the loop, we already found a match
        }
    }

    if ($found==false) {
        echo "have";
    } else if ($found==true) {
        echo "not have";
    }
} 


?>