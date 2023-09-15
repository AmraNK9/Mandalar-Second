<?php
include_once "../controller/userController.php";

$nrcNumber=$_POST['nrcnumber'];
$user_id=$_POST["userid"];
$updateUserNRC=new UserController();
$updateUser=$updateUserNRC->updateUserNRC($nrcNumber,$user_id);

?>