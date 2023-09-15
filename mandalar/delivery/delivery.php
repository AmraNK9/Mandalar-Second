<?php 
error_reporting(0);
session_start();
if(!isset($_SESSION['deli_id'])){
    header("Location: login.php");
}
include_once "header.php"; 
include_once "../controller/deliveryController.php";
$deli_controller=new DeliveryController();
$deli_id=$_SESSION['deli_id'];
// echo $deli_id;
$deli=$deli_controller->get_deli($deli_id);
?>

<body>

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
        /* .wave{
            display: flex;
            margin: 5px;
        }
        .wave .content{
            width: calc(100% - 100px);
            /* border: 3px solid #4e9c81; */
            /* height: 70px;
            display: flex; */
            /* border-radius: 5px; */
            /* align-items: center; */
            /* padding: 5px;
        /* } */
        .wave img{
            width: 50px;
            height: 50px;
            border-radius: 5px;
        }
        /* .wave .details{
            margin: 5px;
        }  */ 
        /* .wave .button{
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
            color:white;
        } */
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <div class="wrapper">
        <div class="users delivery">
            <header>
                <div class="content">
                    <img src="../image/deli_profile/<?php echo $deli[0]['photo'] ?>" alt="">
                    <div class="details">
                        <span><?php echo $deli[0]['name'] ?></span>
                    </div>
                </div>
            </header>
            <div class="deli-select">
                <button id="take" class="btn btn-secondary me-3">Take</button>
                <button id="send" class="btn btn-secondary">Send</button>
            </div>
            <div class="wave" id="wave-container">
            </div>
            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="../js/delivery.js"></script>
</body>