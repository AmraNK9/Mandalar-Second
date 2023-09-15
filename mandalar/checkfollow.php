<?php
session_start();
include_once "controller/profileController.php";
include_once "controller/followController.php";
include_once "controller/userController.php";
include_once "model/noti.php";
include_once "model/user.php";
$getUserName=new UserController();
$getalluserlist = new ProfileController();
$getAllUser = $getalluserlist->getUserList();
$followUser=new FollowController();



if(isset($_POST["state"]))
{
    $state=$_POST["state"];

}
if(isset($_POST['from_id']))
{
    $from_id=$_POST['from_id'];
}

if(isset($_POST['to_id']))
{
    $to_id=$_POST['to_id'];
}

if(isset($_POST["id"]))
{
    $id=$_POST["id"];
}


if($state==1)
{
     $follow=$followUser->following($from_id,$to_id);
    // $getNames=$getUserName->UserInfo($from_id);
    // foreach ($getNames as $key => $getName) {
    //     $name=$getName["full_name"];
    //     # code...
    // }
    $userinfo = $userModal->UserAllInfo($from_id);
    $name = $userinfo[0]["full_name"];
    
    // var_dump($_POST);
    $link = $_POST['link'];

   echo $NOtiModal->SentNoti($name." is folling You",$to_id,$link);


}
// $followresult=$followUser->followingUser($from_id,$to_id);
//var_dump($followresult);
if($state==0)
{
    $deletefollow=$followUser->deletefollow($id);

}
?>