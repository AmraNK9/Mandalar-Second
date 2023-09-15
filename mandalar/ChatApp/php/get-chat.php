<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['user_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * , messages.img as mess_img FROM messages LEFT JOIN users ON users.user_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    if(!empty($row['msg'])){
                        $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                    }else{
                        $output .= '<div class="chat outgoing">
                                <div class="details">
                                <img src="../image/chat-img/'.$row['mess_img'].'" alt="" width=270px height=150px style="border-radius:5px">
                                </div>
                                </div>';
                    }
                }else{
                    if(!empty($row['msg'])){
                        $output .= '<div class="chat incoming">
                                <img src="../image/user-profile/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                    }else{
                        $output .= '<div class="chat incoming">
                                <img src="../image/user-profile/'.$row['img'].'" alt="">
                                <div class="details">
                                <img src="../image/chat-img/'.$row['mess_img'].'" alt=""  style="border-radius:5px; width:270px;height:150px;">
                                </div>
                                </div>';
                    }
                    
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>