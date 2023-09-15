<?php 
error_reporting(0);
include_once "layouts/header.php";
include_once "../controller/nrcController.php";
include_once "../controller/userController.php";
$getUserName=new UserController();
$getAllNRCusers=new NrcController();
$getNRCusers=$getAllNRCusers->getAll();


$userid=$_GET["userid"];
foreach ($getNRCusers as $key => $user) {
    if($userid==$user["to_id"])
    {
    $front_nrc= $user["front_nrc"];
    $back_nrc= $user["back_nrc"];
    $nrc_number= $user["nrc"];
    $date= $user["date"];
    $status=$user['status'];
    
    }
}


$getName=$getUserName->UserInfo($userid);
foreach ($getName as $key => $Name) {
    $userName=$Name['fname']." ".$Name["lname"];
  
}
?>

<a href="nrc_checking.php" class="btn btn-secondary mx-5 mt-4" style="width: 100px;">Back</a>

<main class="content">
				<div class="container-fluid  shadow-lg p-3 mb-5 bg-white rounded">

					<div class="mb-3 mx-2">
						<h1 class="h3 d-inline align-middle">Checking User NRC Table</h1>
					</div>
                   <input type="" name="" id="userid" class="d-none" value="<?php echo $userid;?>">
                   <input type="" name="" id="nrcnumber" class="d-none" value="<?php echo  $nrc_number;?>">
                        <div class="container d-flex justify-content-center align-items-center ">
                            <div class="row bg-white ">
                                <h4 class="mt-4 mx-2">Name : <?php echo $userName; ?></h4>
                                <h4 class="mt-4 mx-2">NRC Number : <?php echo $nrc_number; ?></h4>
                                <!-- <h4 class="my-3 mx-3">id : <?php echo $userid; ?></h4> -->
                                <div class="col-md-12 d-flex  justify-content-around">
                                    <div class="front_img  col-md-6">
                                        <h5 class="my-3 mx-2">Front NRC Image</h5>
                                        <!-- <label for="" class="col-md-12"></label> -->
                                        <img src="../image/user_nrc/front_nrc/<?php echo $front_nrc ?>" alt=" " class="px-2" width="100%" >
                                    </div>
                                    <div class="front_img col-md-6">
                                        <h5 class="my-3 mx-2">Back NRC Image</h5>
                                        <!-- <label for="" class="col-md-12"></label> -->
                                        <img src="../image/user_nrc/back_nrc/<?php echo $back_nrc ?>" alt=" "  class="px-2" width="100%">
                                    </div>
                                </div>
                                <h4 class="text-success mx-2 my-3" id="successtext"></h4>
                                <div class="col-md-12 my-4 mx-2">
                                    <button class="btn btn-success col-md-1 <?php if($status == 1)echo 'd-none'; ?>" id="acceptNRC">Accept</button>
                                    <a class="btn btn-danger  col-md-1 <?php if($status == 1)echo 'd-none'; ?>" href="nrc_checking.php" id="deleteNRC">Delete</a>
                                </div>
                               
                            </div>
                        </div>
				</div>
</main>
<script src="../js/jquery-3.7.0.min.js"></script>
<script src="js/nrc_checking.js"></script>
<script src="js/view_NRCuser.js"></script></script>


<?php
include_once "layouts/footer.php";
?>