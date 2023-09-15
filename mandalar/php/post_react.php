<?php
include_once "../controller/product_likeController.php";
$product_like_controller = new ProductLikeController();
$post_id = $_GET["postId"];
$post_react_list=$product_like_controller->react_list($post_id);
echo count($post_react_list);

?>