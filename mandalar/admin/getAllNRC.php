<?php 
include_once "../controller/nrcController.php";


$getAllNRCusers=new NrcController();
$getNRCusers=$getAllNRCusers->getAll();

echo json_encode($getNRCusers);

?>