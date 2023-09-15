<?php 
include_once __DIR__."/../model/comment.php";
$commentModal = new Comment();

if(isset($_POST['post_id']) ) {
    $post_id = $_POST['post_id'];
   $result = $commentModal->loadCommentByPostId($post_id);
   echo json_encode($result);
}