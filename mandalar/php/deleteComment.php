<?php 
include_once __DIR__ . "/../model/comment.php";
$commentModal = new Comment();
if(isset($_POST['id'])){
    $commentId = $_POST['id'];
    if( $commentModal->deleteCommentById($commentId)){
        echo "delete success";
    }
}