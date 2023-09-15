<?php 
error_reporting(0);
include_once "layouts/header.php"; ?>
<?php

include_once "../controller/userController.php";
include_once "../controller/postController.php";
include_once "../controller/userController.php";
$user_id=$_GET['id'];
include_once "../php/available_money.php";
$user_controller= new UserController();
$user=$user_controller->UserInfo($user_id);
?>
            <link rel="stylesheet" href="css/post-deli.css">
			<main class="content">
                
                    <div class="container-fluid p-0">

                        <div class="mb-3">
                            <h1 class="h3 d-inline align-middle">User</h1>
                            <div class="container">
                            <div class="card" style="width: 18rem;">
                                <img src="../image/user-profile/<?php echo $user[0]['img'] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">User Info</h5>
                                    <p class="card-text">Name : <?php echo $user[0]['full_name'] ?></p>
                                    <p class="card-text">Email : <?php echo $user[0]['email'] ?></p>
                                    <p class="card-text">NRC : <?php echo $user[0]['nrc'] ?></p>
                                    <p class="card-text">Bio : <?php echo $user[0]['bio'] ?></p>
                                    <p class="card-text">Acc Money : <?php echo $user[0]['wallet'] ?></p>
                                    <p class="card-text">Freeze Money : <?php echo $freeze_money ?></p>
                                    <p class="card-text">Available Money : <?php echo $available_money ?></p>
                                </div>
                                </div>
                            </div>
                            
                        </div>


                        
                    </div>
				
			</main>
            <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
            
            <!-- <script src="js/post-deli.js"></script> -->
<?php include_once "layouts/footer.php"; ?>