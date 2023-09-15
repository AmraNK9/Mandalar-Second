<?php
include_once "../controller/postController.php";
$post_id=$_GET['post_id'];
$user_id=$_GET['user_id'];
$post_controller=new PostController();
$post_controller->add_view_count($post_id,$user_id);
echo 'success';
?>