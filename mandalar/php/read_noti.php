<?php

include_once "../controller/notiController.php";
$notiController=new NotiController();
$id=$_GET['id'];
$notiController->update_read($id);
