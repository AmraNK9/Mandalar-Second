<?php
session_start();
include_once "controller/profileController.php";
include_once "controller/userController.php";

$getalluserlist = new ProfileController();
$getAllUser = $getalluserlist->getUserList();

$current_page = basename($_SERVER['PHP_SELF']);
// if ($current_page == "favorite.php") {
//     echo "///////////";
// } else {
//     echo $current_page;
//     echo "fdsad";
// }

$updateUserDetails = new UserController();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // echo $user_id;

}


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
    <!-- <link rel="stylesheet" href="css/loader.css"> -->
    <link rel="stylesheet" href="css/flitter.css" />


</head>
<style>
    .force-scroll {

        overflow-y: scroll;

        max-height: 300px;
        min-height: 200px;

    }


    /* .noti_id{
    background-color: #627E8B;
} */
</style>

<body class="">
    <!-- Navigation -->


    <div id="page">
        <header id="aa-header">
            <!-- start header top  -->

            <!-- / header top  -->

            <!-- start header bottom  -->
            <div class="aa-header-bottom mb-4" style="background-color: #627E8B; ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="aa-header-bottom-area">
                                <!-- logo  -->
                                <div class="aa-logo">
                                    <!-- Text based logo -->
                                    <a href="home.php">
                                        <img src="image/logoimg/logo-no-background.png" class="logo" width="200px" height="auto" alt="as">

                                    </a>

                                </div>
                                <!-- / logo  -->
                                <!-- cart box -->
                                <?php if (isset($_SESSION['user_id'])) { ?>
                                    <div class="aa-cartbox">
                                        <div class=" d-flex justify-content-end" style="width: 230px;">
                                            <?php if ($current_page == "favorite.php") { ?>
                                                <a class="aa-cart-link home" href="home.php">
                                                    <i class="fa-solid fa-house"></i>
                                                </a>
                                            <?php } else { ?>
                                                <a class="aa-cart-link heart" href="favorite.php">
                                                    <i class="fa-solid fa-heart"></i>
                                                </a>
                                            <?php  } ?>
                                            <div class="dropdown">
                                                <a class="aa-cart-link bell" style="display:inline-block;width:70px;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false" role="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">

                                                    <i class="fa-regular fa-bell "></i>
                                                    <span class="aa-cart-notify" data-user-id="<?php echo $user_id ?>" style="color: #4e9c81;">0</span>
                                                    <ul class="dropdown-menu force-scroll" id="notiContainer" aria-labelledby="dropdownMenuButton ">
                                                       
                                                    </ul>
                                                </a>
                                            </div>

                                            <a class="aa-cart-link message" href="ChatApp/users.php">
                                                <i class="fa-regular fa-message "></i>
                                            </a>

                                            <a class="aa-cart-link user" href="profile.php">
                                                <i class="fa-regular fa-user"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="aa-cartbox">
                                        <div class=" d-flex justify-content-end " style="width: 230px;">
                                            <a class="aa-cart-link btn btn-outline-light btn-rounded text-white d-flex login" href="login.php" style="height:45px">
                                                <i class="fa-solid fa-arrow-right-to-bracket fs-4 login-text"></i><span class="m-1 login-text" style=" font-size:13px">Login</span>
                                            </a>

                                            <!-- <div class="dropdown" >
                                            <a class="aa-cart-link bell" style="display:inline-block;width:120px"  role="button"  id="dropdownMenuButton"
                                                data-mdb-toggle="dropdown" >
                                                
                                                <i class="fa-regular fa-bell"></i>
                                                <span class="aa-cart-notify" style="color: #4e9c81;">0</span>
                                                <ul class="dropdown-menu"  aria-labelledby="dropdownMenuButton">
                                                    
                                                </ul>
                                            </a>
                                        </div> -->
                                            <a class="aa-cart-link btn btn-outline-light btn-rounded text-white d-flex login  ms-2" href="register.php" style="height:45px; width:150px;">
                                                <i class="fa-solid fa-user fs-4 login-text"></i><span class="m-1 login-text" style=" font-size:13px">Register</span>
                                            </a>

                                            <!-- <a class="aa-cart-link btn btn-light register" href="#">
                                        <i class="fa-solid fa-arrow-right-to-bracket fa-xl" style="color: #ffffff;"></i>
                                        <span class="" style="color: #4e9c81;">register</span>
                                        <i class="fa-solid fa-user"></i>
                                        </a> -->

                                            <!-- <a class="aa-cart-link user" href="profile.php">
                                            <i class="fa-regular fa-user"></i>
                                        </a> -->
                                        </div>
                                    </div>

                                <?php } ?>
                                <!-- / cart box -->
                                <!-- search box -->
                                <div class="aa-search-box">
                                    <form action="" method="post">

                                        <input type="text" name="searchinput" id="search-box" placeholder="Search" value="<?php if (isset($searchinput)) echo $searchinput; ?>">
                                        <button type="submit" name="search" id="search" style="border-radius: 30px; background-color: #4e9c81;"><span class="fa fa-search"></span></button>
                                    </form>
                                </div>

                                <!-- / search box -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </header>

        <!-- <div class="loader-wrapper">
            <div id="loader"></div>
        </div> -->

</body>
<!-- Modernizr JS -->
<script src="js/modernizr-2.6.2.min.js"></script>
<!-- <script src="mdbbootstrap/js/mdb.min.js"></script> -->
<!-- <script src="mdbbootstrap/js/mdb.min.js"></script> -->
<script src="js/jquery-3.7.0.min.js"></script>
<!-- <script src="bootstrap/js/bootstrap.bundle.min.js"></script> -->
<script src="js/searchbox.js"></script>
<script src="js/noti.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

</html>