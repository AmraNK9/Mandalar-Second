<?php 
error_reporting(0);
include_once "layouts/header.php"; ?>
<?php

include_once "../controller/deliveryController.php";
$delivery_controller= new DeliveryController();
$delivery_list=$delivery_controller->getDeliveryList();
?>
            <link rel="stylesheet" href="css/post-deli.css">
			<main class="content">
                
                    <div class="container-fluid p-0">

                        <div class="mb-3">
                            <h1 class="h3 d-inline align-middle">User</h1>
                            <div>
                                <a href="create_delivery.php" class="btn btn-info">Create Delivery</a>
                            </div>
                            <div class="container">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>view</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($delivery_list as $key => $delivery) {
                                            # code...
                                         ?>
                                        <tr>
                                            <td><?php echo ($key+1) ?></td>
                                            <td><img src="../image/deli_profile/<?php echo $delivery['photo'] ?>" alt="" height="50px" width="50px" style="border-radius:50%;object-fit:cover;"></td>
                                            <td><?php echo $delivery['name'] ?></td>
                                            <td><?php echo $delivery['phone'] ?></td>
                                            <td><a href="delivery_detail.php?id=<?php echo $delivery['id'] ?>" class="btn btn-outline-info">view</a></td>
                                        </tr>
                                        <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>


                        
                    </div>
				
			</main>
            <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
            
            <!-- <script src="js/post-deli.js"></script> -->
<?php include_once "layouts/footer.php"; ?>