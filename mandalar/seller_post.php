<?php
include_once "controller/postController.php";
$user_id=$_GET["user_id"];
$post_controller=new PostController();
$post_list=$post_controller->getSellerPost($user_id);
if(isset($post_list)){
    $images = glob('image/post_img/'.$post_list[0]['photo_folder'].'/*.{jpg,png,gif}', GLOB_BRACE);
    $seller_post=[$post_list[0]['item'],$post_list[0]['price'],$images[0]];
    $jsonData = json_encode($seller_post);
    
    // Set the response content type to JSON
    header('Content-Type: application/json');
    
    // Output the JSON data
    echo $jsonData;
}else{
    echo "don't stop";
}

?>