<?php 
error_reporting(0);
include_once "layouts/header.php";
include_once "../controller/kpayController.php";
include_once "../controller/userController.php";


$getAlltrans=new kpayController();
$gettrans=$getAlltrans->getAllTrans();

$getAllUserList=new UserController();

foreach ($gettrans as $key => $getName) {
    
    $getUser=$getAllUserList->UserInfo($getName["user_id"]);
    foreach ($getUser as $key => $UserName) {
        $user_id=$UserName["user_id"];
        $getName=$UserName["fname"]." ".$UserName["lname"];
        // var_dump($getName);
        # code...
    }
    
    # code...
}
// var_dump($gettrans);



?>
<main class="content">
				<div class="container-fluid p-0">
					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Checking User NRC Table</h1>
						
						
					</div>
                    <!-- <div class="col-md-12">
                        <div class="col-md-4">
                            <select name="" id="filterNRC" class="form-control">
                                <option value="0">All</option>
                                <option value="1">Already Check</option>
                                <option value="2">Unckecking</option>
                            </select>
                        </div>
                        
                    </div> -->

                    
                    <table class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Name</td>
                                <td>Amount</td>
                                <td>Phone Number</td>
                                <td>Transform Name</td>
                                
                                <td>Date</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody class="showuser">
                            
                                <?php $index=1;
                                foreach ($gettrans as $key => $gettran) {
                                    if($gettran['status']==0)
                                    {
                                ?>
                                <tr>
                                    <td><?php echo $index++ ?></td>
                                    <td><?php echo $getName; ?></td>
                                    <td><?php echo $gettran["check_wallet"] ?></td>
                                    <td><?php echo $gettran["kpay_phone"] ?></td>
                                    <td><?php echo $gettran["kpay_name"] ?></td>
                                    <td><?php echo $gettran["date"] ?></td>
                                    <td>
                                        <a href="kpay_checkdetails.php?id=<?php echo $gettran['id']; ?>" class="btn btn-warning">Check</a>
                                    </td>
                                </tr>
                                <?php }}  ?>
                            
                        </tbody>
                    </table>
				</div>
</main>
<script src="../js/jquery-3.7.0.min.js"></script>
<script src="js/kpay_checking.js"></script>


<?php
include_once "layouts/footer.php";
?>