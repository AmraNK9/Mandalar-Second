<?php

session_start();
if(isset($_SESSION['user_id'])){
    include_once "config.php";
    
    if(isset($_FILES['image'])){
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];
        
        $img_explode = explode('.',$img_name);
        $img_ext = end($img_explode);

        $extensions = ["jpeg", "png", "jpg"];
        if(in_array($img_ext, $extensions) === true){
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if(in_array($img_type, $types) === true){
                $time = time();
                $new_img_name = $time.$img_name;
                if(move_uploaded_file($tmp_name,"../../image/chat-img/".$new_img_name)){
                    $ran_id = rand(time(), 100000000);
                    $outgoing_id = $_SESSION['user_id'];
                    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
                    $insert_query = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, img)
                    VALUES ({$incoming_id}, {$outgoing_id}, '{$new_img_name}')") or die();
                }}}}
}else{
    header("location: ../login.php");
}



?>

