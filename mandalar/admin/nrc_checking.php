<?php 
error_reporting(0);
include_once "layouts/header.php";
include_once "../controller/nrcController.php";


$getAllNRCusers=new NrcController();
$getNRCusers=$getAllNRCusers->getAll();

?>
<main class="content">
				<div class="container-fluid p-0">

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Checking User NRC Table</h1>
						
						
					</div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <select name="" id="filterNRC" class="form-control">
                                <option value="0">All</option>
                                <option value="1">Already Check</option>
                                <option value="2">Unckecking</option>
                            </select>
                        </div>
                        
                    </div>

                    
                    <table class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Name</td>
                                <td>NRC Number</td>
                                <td>Date</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody class="showNRCuser" id="deletetd">
                            
                        </tbody>
                    </table>
				</div>
</main>
<script src="../js/jquery-3.7.0.min.js"></script>
<script src="js/nrc_checking.js"></script>


<?php
include_once "layouts/footer.php";
?>