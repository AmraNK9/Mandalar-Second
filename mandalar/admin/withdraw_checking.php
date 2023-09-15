<?php 
error_reporting(0);
include_once "layouts/header.php";
include_once "../controller/kpayController.php";
$kpay_controller=new kpayController();
$withdraw_list=$kpay_controller->getAllWithdraw();



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
                                foreach ($withdraw_list as $key => $withdraw) {
                                    // if($gettran['status']==0)
                                    // {
                                ?>
                                <?php if($withdraw['status']=='wait'){ ?>
                                <tr>
                                    <td><?php echo $index++ ?></td>
                                    <td><?php echo $withdraw['user_name']; ?></td>
                                    <td><?php echo $withdraw["amount"] ?></td>
                                    <td><?php echo $withdraw["kpay_phone"] ?></td>
                                    <td><?php echo $withdraw["kpay_name"] ?></td>
                                    <td><?php echo $withdraw["date"] ?></td>
                                    <td>
                                        
                                        <a href="withdraw_checkdetails.php?id=<?php echo $withdraw['id']; ?>" class="btn btn-warning">Check</a>
                                        
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php
                                //  }
                            }  
                            ?>
                            
                        </tbody>
                    </table>
				</div>
</main>
<script src="../js/jquery-3.7.0.min.js"></script>
<script src="js/kpay_checking.js"></script>


<?php
include_once "layouts/footer.php";
?>