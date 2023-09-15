<?php 
include_once "controller/userController.php";
$user_id=$_POST['from_id'];

$getUserNames=new UserController();
$getName=$getUserNames->UserInfo($user_id);

echo json_encode($getName);

?>