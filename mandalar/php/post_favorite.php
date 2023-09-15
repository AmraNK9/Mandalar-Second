<?php
include_once "../controller/product_likeController.php";
$product_favorite_controller = new ProductLikeController();
$post_id = $_GET["postId"];
$post_favorite_list=$product_favorite_controller->favorite_list($post_id);
echo count($post_favorite_list) ?? 0;

?>