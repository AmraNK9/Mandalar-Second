<?php
session_start();
include_once "../controller/postController.php";
include_once "../controller/followController.php";
include_once "../model/noti.php";
include_once "../model/user.php";

$post_controller=new postController();
$noti_model = new Notification();
$follow_controller=new FollowController();
$user_model = new User();

$id=$_SESSION['user_id'];
$item_name=$_POST['item_name'];
$brand=$_POST['brand'];
$options=$_POST['options'];
$post_category=$_POST['post_category'];
$post_subcategory=$_POST['post_subcategory'];
$price=$_POST['price'];
$text_area=$_POST['text_area'];
$status='none';
$uploadsDir = '../image/post_img/';

//   if (!file_exists($uploadsDir)) {
//     mkdir($uploadsDir, 0777, true);
//   }
// $time=time();
//   $imageFolder = uniqid($id.'image_'.$time, true);
//   $targetDir = $uploadsDir . $imageFolder . '/';

//   if (!file_exists($targetDir)) {
//     mkdir($targetDir, 0777, true);
//   }

//   $targetFile = $targetDir . basename($_FILES['post_img']['name']);

//   if (move_uploaded_file($_FILES['post_img']['tmp_name'], $targetFile)) {
//   } else {
//   }
if (!file_exists($uploadsDir)) {
  mkdir($uploadsDir, 0777, true);
}

$time = time();
$imageFolder = uniqid($id . 'image_' . $time, true);
$targetDir = $uploadsDir . $imageFolder . '/';

if (!file_exists($targetDir)) {
  mkdir($targetDir, 0777, true);
}

// Handle multiple image uploads
$uploadedFiles = count($_FILES['post_img']['name']);


for ($i = 0; $i < $uploadedFiles; $i++) {
  $name = $_FILES['post_img']['name'][$i];
  $tmp_name = $_FILES['post_img']['tmp_name'][$i];
  $targetFile = $targetDir . basename($name);

  if (move_uploaded_file($tmp_name, $targetFile)) {
    // The image has been successfully uploaded to the target directory.
  } else {
    // Error handling if the upload fails.
  }
}


$post_controller->add_post($id,$item_name,$brand,$options,$post_subcategory,$price,$text_area,$imageFolder,$status);
$post_id=$post_controller->get_post_id($id,$item_name,$brand,$options,$post_subcategory,$price,$text_area,$imageFolder,$status);
$link = "http://localhost/MandalarSecond1.0/mandalar/productDetail.php?id=".$post_id[0]['id'];
$followers=$follow_controller->get_followers($id);
$Poster_name = $user_model->UserAllInfo($id);
foreach ($followers as $key => $follower) {
  $noti_model->SentNoti($Poster_name[0]['full_name']." add new Post",$follower['from_id'],$link);
}
echo "success";

?>