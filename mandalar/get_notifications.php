<?php
include_once "controller/notiController.php";
$to_id=$_POST['to_id'];

$getNoti=new NotiController();
$getAllNoti=$getNoti->getNoti($to_id);
// $newNotifications = fetchNewNotifications($_SESSION['user_id']);

// Prepare the response data
// $response = array(
//     'newNotifications' => count($to_id),
//     'notifications' => $to_id,
// );

// Send the response as JSON
//header('Content-Type: application/json');
echo json_encode($getAllNoti);

?>