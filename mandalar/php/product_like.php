<?php
include_once "../controller/product_likeController.php";
include_once "../model/noti.php";
include_once "../model/user.php";
include_once "../controller/postController.php";

$product_like_controller = new ProductLikeController();
$postController = new PostController();


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
        $product_like_controller->addNewProductLike($post_id, $user_id);
        $link = $_GET['link'];
        $Post = $postController->getPost($post_id);
        $userinfo = $userModal->UserAllInfo($user_id);
        $name = $userinfo[0]["full_name"];
        $to_id = $Post[0]["seller_id"];

        if($to_id != $user_id){
            $NOtiModal->SentNoti($name . " React Your Post", $to_id, $link);
        }

        echo "have";
    } else if ($found==true) {
        $product_like_controller->removeProductLike($post_id, $user_id);
        echo "not have";
    }
} 


?>
