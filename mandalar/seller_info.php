
<?php 
include_once "./controller/cityController.php";
$city_controller=new CityController();
$city_list=$city_controller->getCityList();

 ?>

<button id="seller-info-btn" type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#seller_info" style="display:none">
  Launch demo modal
</button>
<div id="user_id" data-user_id="<?php echo $user_id; ?>"></div>

<!-- Modal -->
<div class="modal fade" id="seller_info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-mdb-backdrop='static'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                <div class="card"> 
                    <img id="seller-post-img" src="image/user-profile/mylove.jpg" class="card-img-top" alt="Fissure in Sandstone" width="100px" height="250px"/>
                    <div class="card-body">
                        <h5 id="seller-item-name" class="card-title">item name</h5>
                        <p id="seller-price" class="card-text">price: 90000</p>
                    </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
		
		<form id="sell-form" action="#" method="POST">
			
			<div class="row">
				<div class="col-1"></div>
				<div class="col-10">
					<label for="" class="form-label">Phone No</label>
					<input id="seller-phone" name="seller_phone" type="number" class="form-control">
					<span class="text-danger" id="phone-error" style="display:none;">Need to fill your phone no.!!!</span>
				</div>
				<div class="col-1"></div>
			</div>
			<div class="row">
				<div class="col-1"></div>
				<div class="col-10">
					<label for="" class="form-label">City</label>
					<select name="city" id="" class="form-select">
						<?php foreach ($city_list as $city) { ?>
						<option value="<?php echo $city['id'] ?>"><?php echo $city['name'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-1"></div>
			</div>
			<div class="row">
				<div class="col-1"></div>
				<div class="col-10">
					<label for="" class="form-label">Address</label>
					<textarea id="seller-address" name="seller_address" id="" cols="50" rows="5" class="form-control"></textarea>
					<span class="text-danger" id="address-error" style="display:none;">Need to fill your adress!!!</span>
				</div>
				<div class="col-1"></div>
			</div>
		</form>
	  
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary"  id="sell-info-close" data-mdb-dismiss="modal" style="">Close</button>
        <button type="button" class="btn btn-primary" id="sell-btn">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/seller_info.js"></script>