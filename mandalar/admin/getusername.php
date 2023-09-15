<?php
include_once "../controller/userController.php";

$userid=$_POST["userid"];

$getUserName=new UserController();
$getName=$getUserName->UserInfo($userid);
foreach ($getName as $key => $Name) {
    $userName=$Name['fname']." ".$Name["lname"];
    # code...
}
echo $userName;

?>