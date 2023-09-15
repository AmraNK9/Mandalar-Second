<?php
include_once "../controller/product_likeController.php";
$product_favorite_controller = new ProductLikeController();
$product_favorite_list = $product_favorite_controller->getPostFavorite();
$post_id = $_GET["postId"];
$user_id = $_GET["userId"];
$found = false; // Initialize a flag variable

if (isset($product_favorite_list)) {
    foreach ($product_favorite_list as $product_favorite) {
        if ($product_favorite["post_id"] == $post_id && $product_favorite["user_id"] == $user_id) {
            // Matching record found
            $found = true;
            break; // No need to continue the loop, we already found a match
        }
    }
}
    if ($found==false) {
        $product_favorite_controller->addNewProductFavorite($post_id, $user_id);
        echo "have";
    } else if ($found==true) {
        $product_favorite_controller->removeProductFavorite($post_id, $user_id);
        echo "not have";
    }



?>
