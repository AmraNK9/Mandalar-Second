<?php
include_once "controller/followController.php";
$followUser=new FollowController();
$getAllFollow=$followUser->getAllFollow();


echo json_encode($getAllFollow)
// foreach ($variable as $key => $value) {
//     # code...
// }

?>