<?php
include_once "../controller/nrcController.php";

$userid=$_POST["userid"];
$updateUserNrc=new NrcController();
$updateUser=$updateUserNrc->updateNrc($userid);
?>