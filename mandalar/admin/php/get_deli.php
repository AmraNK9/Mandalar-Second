<?php
include_once "../../controller/deliveryController.php";
$deli_city=$_GET['deli_city'];
$delivery_controller=new DeliveryController();
$delivery_list=$delivery_controller->getDeliveryListById($deli_city);
// Convert the array to JSON format
$jsonData = json_encode($delivery_list);

// Set the response content type to JSON
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;

?>