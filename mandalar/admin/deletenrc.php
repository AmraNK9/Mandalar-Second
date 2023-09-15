<?php
include_once "../controller/nrcController.php";
$to_id=$_POST["userid"];

$deletAllNrc=new NrcController();
$delteNrcrow=$deletAllNrc->deleteNrc($to_id);




?>