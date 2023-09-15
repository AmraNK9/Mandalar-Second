<?php 
error_reporting(0);
session_start();
if(!isset($_SESSION['deli_id'])){
    header("Location: login.php");
}
include_once "header.php"; 

include_once "../controller/deliveryController.php";
include_once "../controller/postController.php";
$deli_controller=new DeliveryController();
$post_controller=new PostController();
$deli_id=$_SESSION['deli_id'];
$post_id=$_GET['id'];
$deli=$deli_controller->get_deli($deli_id);
$post=$post_controller->get_deli_post($post_id);
if($post[0]['status']=='take_waiting'){
    $take_btn='<button class="btn btn-primary" id="go_take">Go Take</button>';
}elseif($post[0]['status']=='go_take'){
    $take_btn='<button href="" class="btn btn-primary" id="taken">Taken</button>';
}elseif($post[0]['status']=='take'){
    $take_btn='<p style="width:80px; height:40px; border-radius:9px; display:flex; justify-content:center; align-items:center;" class="bg-success text-white">Done</p>';
}
if($post[0]['status']=='send_waiting'){
    $send_btn='<button href="" class="btn btn-primary" id="go_send">Go Send</button>';
}elseif($post[0]['status']=='go_send'){
    $send_btn='<button href="" class="btn btn-primary" id="send">Send</button>';
}elseif($post[0]['status']=='sold_out'){
    $send_btn='<p style="width:80px; height:40px; border-radius:9px; display:flex; justify-content:center; align-items:center;" class="bg-success text-white">Sold Out</p>';
}
?>
<body>
    <link rel="stylesheet" href="../mdbbootstrap/css/mdb.min.css">
    <style>
        .deli-select{
            display:flex;
            justify-content: center;
            align-items: center;
            margin: 2px;
            padding: 10px;
        }
        .take, .send{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 75px;
            height: 40px;
            border-radius: 5px;
            border: 1px solid #4e9c81;
            margin: 8px;
            font-weight: 500;
            font-size: 18px;
        }
        .deli-select-active{
            background: #4e9c81;
            border: none;
        }
        .wave{
            display: flex;
            margin: 5px;
        }
        .wave .content{
            width: calc(100% - 100px);
            border: 3px solid #4e9c81;
            height: 70px;
            display: flex;
            border-radius: 5px;
            align-items: center;
            padding: 5px;
        }
        .wave img{
            width: 50px;
            height: 50px;
            border-radius: 5px;
        }
        .wave .details{
            margin: 5px;
        }
        .wave .button{
            width: 80px;
            height: 68px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            background: #4e9c81;
            margin-left: 10px;
            font-size: 20px;
            font-weight: 500;
            text-align: center;
        }
    </style>
    <div class="wrapper">
        <div class="users delivery">
            <header>
                <div class="container">
                <div class="row">
                    <div class="content">
                        <img src="../image/deli_profile/<?php echo $deli[0]['photo'] ?>" alt="">
                        <div class="details">
                            <span><?php echo $deli[0]['name'] ?></span>
                        </div>
                    </div>
                </div>
                <div data-post-id=<?php echo $post_id ?> id="post_id"></div>
                <div class="row mt-5">
                    <div class="card">
                        <img src="../image/user-profile/mylove.jpg" style="width:100%; height:300px; border-radius:9px; margin-top:9px" class="card-img-top" alt="Fissure in Sandstone"/>
                        <div class="card-body">
                            <h5 class="card-title">Item name:<?php echo $post[0]['item'] ?></h5>
                            <p class="card-text">Price : <?php echo $post[0]['price'] ?> mmk</p>
                            <?php if($post[0]['status']=='take_waiting'  || $post[0]['status']=='go_take' || $post[0]['status']=='take') {?>
                            <p class="card-text">Seller City : <?php echo $post[0]['seller_city'] ?></p>
                            <p class="card-text">Seller Address : <?php echo $post[0]['seller_address'] ?></p>
                            <?php }elseif($post[0]['status']=='send_waiting'  || $post[0]['status']=='go_send' || $post[0]['status']=='sold_out'){ ?>
                            <p class="card-text">Buyer City : <?php echo $post[0]['buyer_city'] ?></p>
                            <p class="card-text">Buyer Address : <?php echo $post[0]['buyer_address'] ?></p>
                            <?php } ?>
                            <div id="btn-container">
                                <?php if(isset($send_btn)) echo $send_btn; ?>
                                <?php if(isset($take_btn)) echo $take_btn; ?>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                </div>
                
                </div>
            </header>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="../js/deli_detail.js"></script>
</body>