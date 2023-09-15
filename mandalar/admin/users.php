<?php 
error_reporting(0);
include_once "layouts/header.php"; ?>
<?php

include_once "../controller/userController.php";
$user_controller= new UserController();
$user_list=$user_controller->getAllUser();
?>
            <link rel="stylesheet" href="css/post-deli.css">
			<main class="content">
                
                    <div class="container-fluid p-0">

                        <div class="mb-3">
                            <h1 class="h3 d-inline align-middle">User</h1>
                            <div class="container">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>view</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user_list as $key => $user) {
                                            # code...
                                         ?>
                                        <tr>
                                            <td><?php echo ($key+1) ?></td>
                                            <td><img src="../image/user-profile/<?php echo $user['img'] ?>" alt="" height="50px" width="50px" style="border-radius:50%;object-fit:cover;"></td>
                                            <td><?php echo $user['full_name'] ?></td>
                                            <td><?php echo $user['email'] ?></td>
                                            <td><a href="user_detail.php?id=<?php echo $user['user_id'] ?>" class="btn btn-outline-info">view</a></td>
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