<?php
include_once __DIR__."/../model/comment.php";
$commentModal = new Comment();

if(isset($_POST['parent_comment_id'])){
    $parent_comment_id = $_POST['parent_comment_id'];
   $result = $commentModal->loadCommentByParentCommentId($parent_comment_id);
   echo json_encode($result);
}