<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:home.php");
}
include_once "nav.php";
include_once "controller/profileController.php";
include_once "controller/userController.php";
include_once "./controller/cityController.php";
$user_id = $_SESSION['user_id'];
$city_controller = new CityController();
$getalluserlist = new ProfileController();
$city_list = $city_controller->getCityList();
$getAllUser = $getalluserlist->getUserList();



$updateUserDetails = new UserController();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // echo $user_id;
}
// $user_id=6;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buy and Sell Website</title>



    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="mdbbootstrap/css/mdb.min.css">

    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> -->
    <link rel="stylesheet" href="../mandalar/fontawesome-free-6.4.0-web/css/all.min.css" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap/css/bootstrap.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap/css/mdb.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap/css/mdb.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
    <link rel="stylesheet" href="css/products.css" />
    <link rel="stylesheet" href="css/category.css" />
    <link rel="stylesheet" href="css/nav.css" />
    <!-- <script src="bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <link rel="stylesheet" href="css/nouislider.css">

    <!-- Flexslider  -->
    <!-- <link rel="stylesheet" href="css/flexslider.css"> -->

    <!-- Owl Carousel  -->
    <!-- <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css"> -->

    <!-- Theme style  -->
    <link rel="stylesheet" href="css/style2.css">
    <!-- <link rel="stylesheet" href="css/loader.css">
    <link rel="stylesheet" href="css/flitter.css" /> -->
    <style>
        .success-overlay {
            width: 100vw;
            height: 100vh;
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 99999999;
            /* background-color: #111; */
            opacity: 1;
            display: none;
            backdrop-filter: blur(10px);
        }

        .success-overlay span {
            color: rgb(65, 190, 81);
            background-color: aliceblue;
            font-size: large;
            opacity: 1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1), 0 32px 64px -48px rgba(0, 0, 0, 0.5);
        }

        #products a {
            color: initial !important;
            font-size: initial !important;
        }
    </style>

</head>

<body class="">
    <!-- Navigation -->
    <div class="success-overlay">
        <span>Successfully</span>
    </div>




    <!-- Button trigger modal -->
    <button id="seller-info-btn" type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#seller_info" style="display:none">
        Launch demo modal
    </button>

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
                                    <img id="seller-post-img" src="image/user-profile/mylove.jpg" class="card-img-top" alt="Fissure in Sandstone" width="100px" height="250px" />
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
                    <button type="button" class="btn btn-secondary" id="sell-info-close" data-mdb-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="sell-btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</body>
<!-- Modernizr JS -->
<script src="js/modernizr-2.6.2.min.js"></script>
<script src="mdbbootstrap/js/mdb.min.js"></script>
<!-- <script src="mdbbootstrap/js/mdb.min.js"></script> -->
<script src="js/jquery-3.7.0.min.js"></script>
<!-- <script src="bootstrap/js/bootstrap.bundle.min.js"></script> -->
<script src="js/searchbox.js"></script>

</html>


<?php


include_once "controller/postController.php";
include_once "model/post.php";
$post_controller = new PostController();
$post_model = new Post();
$post_list = $post_controller->favorite_post_list($user_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <section id="products" class="">

            <form id="sell-form" action="" action="#" method="POST">
            <div class="row ">
                <?php foreach ($post_list as $post) {
                # code...
                ?>

                <a href="#" data-user-id="<?php echo $user_id ?>"  data-post-id="<?php echo $post['id'] ?>" class="view_btn col-md-4 col-sm-6  col-lg-3 mb-4 " onclick="AddCount(event)">
                    <div class="card product-card-by-nay">
                        <?php
                        $images = glob('image/post_img/' . $post['photo_folder'] . '/*.{jpg,png,gif,jpeg,jiff}', GLOB_BRACE);
                        ?>
                            <img src="<?php echo $images[0] ?>" class="card-img-top product-image" alt="Product 1" />
                            <div class="card-body">
                                <div class=" product-card-title">
                                    <h5>
                                        <?php echo $post['item'] ?>

                                    </h5>
                                    <h5>
                                        <?php echo $post['price']  ?> Ks
                                    </h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="image/user-profile/<?php echo $post['user_img'] ?>" class="rounded-circle profile-on-card" alt="Seller 1" />
                                        <span class="ml-2 card-text">
                                    <?php echo $post['fname'] . " " . $post['lname'] ?>
                                </span>
                                    </div>
                                </div>
                                <?php 
                                $count_react=$post_model->getPostReaction($post['id']);
                                $count_favorite=$post_model->getPostFavorite($post['id']);
                                 ?>
                                <div class=" product-info-box">
                                    <div>
                                    <i class="fa-solid fa-thumbs-up"></i>
                                        
                                        <span class="reaction-count"><?php echo $count_react['count_react'] ?></span>
                                    </div>
                                    <div>
                                    <i class="far fa-heart mr-2"></i>
                                        <span class="save-count"><?php echo $count_favorite['count_favorite'] ?></span>
                                    </div>
                                    <?php $viewCount =  $post_model->selectViewCount($post['id']) ?>
                                    <div>
                                        <i class="far fa-eye ml-3"></i>
                                        <span class="view-count"><?php echo $viewCount['view_count'] ?></span>
                                    </div>
                                </div>
                            </div>
                    </div>
                </a>

                <?php } ?>
            </div>
        </section>
        </form>
        <div id="user_id" data-user_id="<?php echo $user_id; ?>"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/seller_info.js"></script>
    <script src="js/home.js"></script>
</body>

</html>