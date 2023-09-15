<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['user_id'];
    $sql = "SELECT users.*, MAX(messages.msg_id) AS max_msg_id
    FROM messages
    JOIN users ON users.user_id = messages.outgoing_msg_id OR users.user_id = messages.incoming_msg_id
    WHERE ((messages.outgoing_msg_id = {$outgoing_id} OR messages.incoming_msg_id = {$outgoing_id} )
      AND users.user_id != {$outgoing_id} )
    GROUP BY users.user_id
    ORDER BY
      CASE
        WHEN users.user_id = 13 THEN 1  -- User 12 is always on top
        ELSE 2  -- Other users are sorted based on max_msg_id
      END,
      max_msg_id DESC;
    ";
    
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $sql="SELECT * from users where user_id = 13";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) == 0){
            $output .= "there is no messages";
        }elseif(mysqli_num_rows($query) > 0){
            include_once "data.php";
        }
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>