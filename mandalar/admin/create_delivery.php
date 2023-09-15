<?php 
error_reporting(0);
include_once "layouts/header.php"; ?>
<?php

include_once "../controller/cityController.php";
$city_controller= new cityController();
$city_list=$city_controller->getCityList();
?>

			<main class="content">
				<div class="container-fluid p-0">

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Create Delivery</h1>
						
						<form id="form" action="#" method="POST" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-md-3 m-4">
                                    <div class="deli-profile-img">
                                        <div class="pre_img">Profile</div>
                                        <!-- <img src="../image/user-profile/mylove.jpg" alt="" width="115px" height="150px"> -->
                                    </div>
                                    <span id="deli_profile_img_error" class="text-danger" style="display:none;">You need to upload a profile image!!!</span>
                                    <input type="file" name="deli_profile_img" style="display:none;" id="deli_profile_img_input" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" >
                                <span class="text-danger" id="name-error" style="display:none;">Need to fill delivery name!!!</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="form-label">Ph No.<span class="text-danger">*</span></label>
                                <input type="number" name="phone" id="phone" class="form-control">
                                <span class="text-danger" id="phone-error" style="display:none;">Need to fill delivery phone No!!!</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="form-label">City<span class="text-danger">*</span></label>
                                <select name="city" id="" class="form-select">
                                    <?php foreach ($city_list as $city) {
                                      ?>
                                    <option value="<?php echo $city['id'] ?>"><?php echo $city['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="form-label">Password<span class="text-danger">*</span></label>
                                <input type="text" name="password" id="password" class="form-control">
                                <span class="text-danger" id="password-error" style="display:none;">Need to fill password!!!</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="form-label">NRC No.<span class="text-danger">*</span></label>
                                <input type="text" name="nrc" id="nrc" class="form-control">
                                <span class="text-danger" id="nrc-error" style="display:none;">Need to fill delivery NRC No!!!</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 nrc_img m-4">
                                <div class="nrc_img_but nrc_front_img_but">Front photo</div>
                                <input type="file" name="front_nrc_image" id="deli_front_nrc_img_input" style="visibility: hidden;">
                                <div class="nrc_img_border" id="nrc_front_img">
                                    <div class="pre_img">Front photo</div>
                                    <!-- <img src="../image/nrc_img/front.jpg" alt=""> -->
                                </div>
                                <span class="text-danger" id="nrc_front_img_error" style="display:none;">You need to upload a NRC Front image!!!</span>
                            </div>
                            <div class="col-md-3 nrc_img m-4">
                                <div class="nrc_img_but nrc_back_img_but">Back photo</div>
                                <input type="file" name="back_nrc_image" id="deli_back_nrc_img_input" style="visibility: hidden;">
                                <div class="nrc_img_border" id="nrc_back_img">
                                    <div class="pre_img">Back photo</div>
                                    <!-- <img src="../image/nrc_img/back.jpg" alt=""> -->
                                </div>
                                <span class="text-danger" id="nrc_back_img_error" style="display:none;">You need to upload a NRC Back image!!!</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <button type="submit" name="submit" class="btn btn-success submit" >Create</button>
                            </div>
                        </div>
                        </form>
					</div>

				</div>
			</main>
<?php include_once "layouts/footer.php"; ?>