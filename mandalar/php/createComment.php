<?php
include_once __DIR__ . "/../model/comment.php";
include_once "../model/noti.php";
include_once "../model/user.php";
include_once "../controller/postController.php";

$commentModal = new Comment();
$postController = new PostController();

if (isset($_POST['post_id']) && isset($_POST['user_id']) && isset($_POST['content']) && isset($_POST['parent_comment_id'])) {
    $postId = $_POST['post_id'];
    $usetId = $_POST['user_id'];
    $content = $_POST['content'];
    $parentCommentId = $_POST['parent_comment_id'];


    if ($_POST['isEdit'] == 'true') {
        echo "is Edit: ", $_POST['isEdit'];
        if (isset($_POST['com_id'])) {
            $comId = $_POST['com_id'];
            echo $commentModal->EditCommentById($comId, $content);
        }
    } else {
        echo $commentModal->createComment($postId, $usetId, $content, $parentCommentId);
        $link = $_POST['link'];
        $Post = $postController->getPost($postId);
        $to_id = $Post[0]["seller_id"];
        $userinfo = $userModal->UserAllInfo($usetId);
        $name = $userinfo[0]["full_name"];
        if ($usetId !== $to_id) {
            $NOtiModal->SentNoti($name . " is Comment Your Post", $to_id, $link);
        }
        if ($parentCommentId != 0) {
            $commentData = $commentModal->getUserIdByParentId($parentCommentId);
            $to_id = $commentData[0]['user_id'];
            if($usetId !== $to_id){
                $NOtiModal->SentNoti($name . " reply your comment", $to_id, $link);
            }
        }
    }
}
