<?php 
include_once __DIR__."/../model/noti.php";
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
       $result = $NOtiModal->LoadNoTi($user_id);
    echo json_encode($result);
}