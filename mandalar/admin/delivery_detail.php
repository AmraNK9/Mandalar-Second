<?php 
error_reporting(0);
include_once "layouts/header.php"; ?>
<?php

include_once "../controller/deliveryController.php";
$deli_id=$_GET['id'];
$delivery_controller= new DeliveryController();
$delivery=$delivery_controller->get_deli($deli_id);
?>
            <link rel="stylesheet" href="css/post-deli.css">
			<main class="content">
                
                    <div class="container-fluid p-0">

                        <div class="mb-3">
                            <h1 class="h3 d-inline align-middle">User</h1>
                            
                            <div class="container">
                            <div class="card" style="width: 18rem;">
                                <img src="../image/deli_profile/<?php echo $delivery[0]['photo'] ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Delivery Info</h5>
                                    <p class="card-text">Name : <?php echo $delivery[0]['name'] ?></p>
                                    <p class="card-text">Ph No : <?php echo $delivery[0]['phone'] ?></p>
                                    <p class="card-text">NRC : <?php echo $delivery[0]['nrc'] ?></p>
                                    <p class="card-text">Bio : <?php echo $delivery[0]['city_name'] ?></p>
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