<?php 
error_reporting(0);
include_once "layouts/header.php"; ?>
<?php

include_once "../controller/cityController.php";
$city_controller= new cityController();
$city_list=$city_controller->getCityList();
?>
            <link rel="stylesheet" href="css/post-deli.css">
			<main class="content">
                <form id="deli-post-form" action="#" method="POST">
                    <div class="container-fluid p-0">

                        <div class="mb-3">
                            <h1 class="h3 d-inline align-middle">Post Delivery</h1>
                            <div class="container">
                                <div class="row mt-4">
                                    <div class="col-md-3 mt-3">
                                        <div class="form-check form-check-inline fs-3">
                                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="waiting" checked>
                                            <label class="form-check-label" for="flexRadioDefault1" >
                                                Go Take
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline fs-3">
                                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="take">
                                            <label class="form-check-label" for="flexRadioDefault2" >
                                                Go Send
                                            </label>
                                        </div>
                                        <!-- <label for="" class="form-label">Post</label> -->
                                        <!-- <select name="" id="post" class="form-select">
                                            <option value="all">All</option>
                                            <option value="none">None</option>
                                            <option value="seller_waiting">Seller Waiting</option>
                                            <option value="waiting">Waiting</option>
                                            <option value="take_waiting">Take Waiting</option>
                                            <option value="go_take">Go Take</option>
                                            <option value="take">Take</option>
                                            <option value="send_waiting">Send Waiting</option>
                                            <option value="go_send">Go Send</option>
                                            <option value="sold_out">Sold Out</option>
                                        </select> -->
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Seller City</label>
                                        <select name="" id="seller-city" class="form-select">
                                            <?php foreach ($city_list as $city) { ?>
                                            <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Buyer City</label>
                                        <select name="" id="buyer-city" class="form-select">
                                            <?php foreach ($city_list as $city) { ?>
                                            <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="post-table">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th >select</th>
                                                <th>Image</th>
                                                <th>item name</th>
                                                <th>price</th>
                                                <th>seller city</th>
                                                <th>buyer city</th>
                                                <th>view</th>
                                            </tr>
                                        </thead>
                                        <tbody id="post_body">

                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <div class="row mt-2" id="save-btn-container">
                                    <div class="col-md-7"></div>
                                    <div class="col-md-3"><strong>Total Select : <span id="check-count">0</span></strong></div>
                                    <div class="col-md-2">
                                    <button type="button" id="save" class="btn btn-primary">Save</button>
                                    <button type="button" id="send-post" style="display:none" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Save</button>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-9"></div>
                                    <div class="col-md-3">
                                        <span style="display:none;" id="post-check-error" class="text-danger fs-4">You need to select post!!!</span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- Button trigger modal -->


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="" class="form-label">Delivery City</label>
                                            <select name="" id="deli-city" class="form-select">
                                                <?php foreach ($city_list as $city) { ?>
                                                <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row deli-container">

                                    </div>
                                </div>
                                <span class="text-danger ms-auto pe-4" id="deli-error" style="display:none;">You need to select delivery!!!</span>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="send-deli">Save changes</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
				
			</main>
            <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
            
            <!-- <script src="js/post-deli.js"></script> -->
<?php include_once "layouts/footer.php"; ?>