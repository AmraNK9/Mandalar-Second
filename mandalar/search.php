<?php
error_reporting(0);
include_once "controller/searchController.php";
include_once "controller/postController.php";
include_once "model/post.php";

$searchAlluser = new SearchController();
$post_controller = new PostController();
$post_model = new Post();
if (isset($_GET['searchinput'])) {

    $searchinput = $_GET['searchinput'];
    // echo $searchinput;
    $searchUsers = $searchAlluser->searchAllUser($searchinput);
    $post_list = $post_controller->searchPosts($searchinput);
    $search_brands = $post_controller->searchBrand($searchinput);

    // var_dump($search_brands);
}

if (isset($_POST["search"])) {
    if (!empty($_POST["searchinput"])) {
        $searchinput = $_POST["searchinput"];
    }
}

include_once "nav.php";

?>
<style>
    /* Custom select box style for MDB */

    .custom-select {
        display: block;
        width: 100%;
        height: 38px;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .profile-on-card {
        object-fit: cover;
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }

    .custom-select:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Style the arrow icon */

    .custom-select::after {
        content: '\f107';
        /* Font Awesome caret-down icon */
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    /* Optional: Style the dropdown options */

    .custom-select option {
        padding: 10px;
        background-color: #fff;
        color: #495057;
    }

    /* Custom style for image selector */

    .image-selector {
        display: inline-block;
    }

    .image-selector .form-control {
        display: none;
    }

    .image-selector label {
        /* display: block; */
        margin-top: 8px;
        width: 100px;
        height: 100px;
        background-color: #f0f0f0;
        border: 2px dashed #ccc;
        border-radius: 8px;
        text-align: center;
        line-height: 100px;
        font-size: 24px;
        color: #666;
        cursor: pointer;
        transition: border-color 0.2s;
    }

    .image-selector img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 8px;
        margin-top: 10px;
    }

    .image-selector label:hover {
        border-color: #333;
    }

    .image-selector label.plus-sign::before {
        content: '+';
    }

    /* Show the selected image preview */

    .image-selector .form-control:focus+img {
        display: block ;
    }

    .preview-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-right: 8px;
        margin-top: 8px;
        border-radius: 8px;
    }

    .image-previews img {
        /* display: flex; */
        vertical-align: top;
    }

    #PostBtn {
        position: fixed;
        right: 40px;
        bottom: 40px;
        padding: 30px;
        font-size: 20px;
        border-radius: 20px;
    }

    #products a {
        color: initial !important;
        font-size: initial !important;
    }


    ::-webkit-scrollbar {
        width: 0.1em;
        /* Width of the scrollbar */
    }

    ::-webkit-scrollbar-track {
        background: transparent;
        /* Track background color */
    }

    ::-webkit-scrollbar-thumb {
        background: transparent;
        /* Scrollbar thumb color */
    }

    * {
        height: auto;
    }

    .swiper-slide {
        height: calc(100%-200px);
        min-height: 0px;
        overflow-y: scroll;
    }

    #myElement {
            visibility:visible;
            opacity: 1 !important;
        }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" /> -->


    <!-- <script src="js/modernizr-2.6.2.min.js"></script> -->
    <!-- <link rel="stylesheet" href="../mandalar/fontawesome-free-6.4.0-web/css/all.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap/css/bootstrap.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap/css/mdb.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap/css/mdb.min.css" /> -->
    <!-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" /> -->
    <!-- <link rel="stylesheet" href="css/nav.css" /> -->
    <!-- <link rel="stylesheet" href="css/profile.css"> -->
    <!-- <link rel="stylesheet" href="css/style2.css" /> -->
    <link rel="stylesheet" href="css/search.css" />
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <title>Product Detail Page</title>
</head>

<body>


    <section>
        <div class="container overflow-hidden">
            <div class="flitter-tab">
                <div class="navbar">
                    <ul class="nav-list">
                        <li class="nav-item active" data-tab="0">
                            <i class="fa-solid fa-user-plus"></i>
                            User
                        </li>
                        <li class="nav-item" data-tab="1">
                            <i class="fa-solid fa-clipboard"></i>
                            Post
                        </li>
                        <li class="nav-item" data-tab="2">
                            <i class="fa-solid fa-box"></i>
                            Brand
                        </li>
                        <!-- Add more navigation items as needed -->
                    </ul>
                </div>
            </div>


            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide mr-3">
                        <div class="tab-content">
                            <div class="row">
                                <?php
                                foreach ($searchUsers as $key => $user) {
                                ?>
                                    <a href="searchprofile.php?id=<?php echo $user['user_id'] ?>">
                                        <div class="col-md-12 rounded d-flex p-2 border pointer text-dark">
                                            <div class="col-md-1">
                                                <img src="../mandalar/image/user-profile/<?php echo $user["img"] ?>" class="usersearchimg" alt="">
                                            </div>
                                            <div class="col-md-8">
                                                <h5>
                                                    <?php echo $user["fname"] . " " . $user['lname'] ?>
                                                </h5>
                                            </div>
                                            <div class="col-md-3 d-flex align-items-center justify-content-end">
                                                <i class="fa-solid fa-arrow-right fa-2xl"></i>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tab-content">
                            <section id="products" class="">
                                <div class="row ">
                                    <?php foreach ($post_list as $post) {
                                        // var_dump($post);
                                        # code...
                                    ?>

                                        <a href="#" data-user-id="<?php echo $user_id ?>" data-post-id="<?php echo $post['id'] ?>" class="view_btn col-md-4 col-sm-6  col-lg-3 mb-4 " onclick="AddCount(event)">
                                            <div class="card product-card-by-nay" id="myElement">
                                                <?php
                                                $images = glob('image/post_img/' . $post['photo_folder'] . '/*.{jpg,png,gif,jpeg,jiff}', GLOB_BRACE);
                                                // var_dump($images[0]);
                                                ?>
                                                <img src="<?php echo $images[0] ?>" class="card-img-top product-image" alt="Product 1" />
                                                <div class="card-body">
                                                    <div class=" product-card-title">
                                                        <h5>
                                                            <?php echo $post['item'] ?>

                                                        </h5>
                                                        <h5>
                                                            <?php echo $post['price'] ?> ks
                                                        </h5>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <img src="image/user-profile/<?php echo $post['user_img'] ?>" class="rounded-circle profile-on-card" alt="Seller 1" />
                                                            <span class="ml-2 card-text">
                                                                <?php echo $post['full_name'] ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $count_react = $post_model->getPostReaction($post['id']);
                                                    $count_favorite = $post_model->getPostFavorite($post['id']);
                                                    ?>
                                                    <div class=" product-info-box">
                                                        <div>
                                                            <i class="far fa-heart mr-2"></i>
                                                            <span class="reaction-count">
                                                                <?php echo $count_react['count_react'] ?>
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <i class="far fa-plus-square ml-3"></i>
                                                            <span class="save-count">
                                                                <?php echo $count_favorite['count_favorite'] ?>
                                                            </span>
                                                        </div>
                                                        <?php $viewCount = $post_model->selectViewCount($post['id']) ?>
                                                        <div>
                                                            <i class="far fa-eye ml-3"></i>
                                                            <span class="view-count">
                                                                <?php echo $viewCount['view_count'] ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                    <?php } ?>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!-- brand -->
                    <div class="swiper-slide">
                        <div class="tab-content">
                            <section id="products" class="">

                                <div class="row ">
                                    <?php foreach ($search_brands as $post) {
                                    ?>

                                        <a href="#" data-user-id="<?php echo $user_id ?>" data-post-id="<?php echo $post['id'] ?>" class="view_btn col-md-4 col-sm-6  col-lg-3 mb-4 " onclick="AddCount(event)">
                                            <div style="visibility:visible;opacity:1 !important ;" class="card product-card-by-nay"  id="myElement" >
                                                <?php
                                                $images = glob('image/post_img/' . $post['photo_folder'] . '/*.{jpg,png,gif,jpeg,jiff}', GLOB_BRACE);
                                                // var_dump($images[0]);
                                                ?>
                                                <img src="<?php echo $images[0] ?>" class="card-img-top product-image" alt="Product 1" />
                                                <div class="card-body">
                                                    <div class=" product-card-title">
                                                        <h5>
                                                            <?php echo $post['item'] ?>

                                                        </h5>
                                                        <h5>
                                                            <?php echo $post['price'] ?> ks
                                                        </h5>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <img src="image/user-profile/<?php echo $post['user_img'] ?>" class="rounded-circle profile-on-card" alt="Seller 1" />
                                                            <span class="ml-2 card-text">
                                                                <?php echo $post['full_name'] ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $count_react = $post_model->getPostReaction($post['id']);
                                                    $count_favorite = $post_model->getPostFavorite($post['id']);
                                                    ?>
                                                    <div class=" product-info-box">
                                                        <div>
                                                            <i class="far fa-heart mr-2"></i>
                                                            <span class="reaction-count">
                                                                <?php echo $count_react['count_react'] ?>
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <i class="far fa-plus-square ml-3"></i>
                                                            <span class="save-count">
                                                                <?php echo $count_favorite['count_favorite'] ?>
                                                            </span>
                                                        </div>
                                                        <?php $viewCount = $post_model->selectViewCount($post['id']) ?>
                                                        <div>
                                                            <i class="far fa-eye ml-3"></i>
                                                            <span class="view-count">
                                                                <?php echo $viewCount['view_count'] ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                    <?php } ?>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!-- Add more swiper slides and tab content as needed -->
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery-3.7.0.min.js"></script>
    <!-- <script>
        // Get a reference to the element
        var element = document.getElementById("myElement");

        // Remove the inline styles
        element.style.visibility = "";
        element.style.opacity = "";
    </script> -->
    <!-- <script src="js/loader.js"></script> -->
    <script src="js/searchbox.js"></script>
    <script src="js/home.js"></script>
    <script src="js/noti.js"></script>
    <script src="js/flitter.js"></script>
    <script>
        // Initialize Swiper
        var swiper = new Swiper(".swiper-container", {
            slidesPerView: "auto",
            spaceBetween: 0,
        });

        // Get the navigation items
        const navItems = document.querySelectorAll(".nav-item");

        // Add click event listener to each navigation item
        navItems.forEach((item, index) => {
            item.addEventListener("click", () => {
                // Remove active class from all navigation items
                navItems.forEach((item) => item.classList.remove("active"));

                // Add active class to the clicked navigation item
                item.classList.add("active");

                // Slide to the corresponding tab
                swiper.slideTo(index);
            });
        });

        // Update active tab based on swiper slide change event
        swiper.on("slideChange", () => {
            // Get the active slide index
            const activeSlideIndex = swiper.activeIndex;

            // Remove active class from all navigation items
            navItems.forEach((item) => item.classList.remove("active"));

            // Add active class to the corresponding navigation item
            navItems[activeSlideIndex].classList.add("active");
        });
    </script>
    <?php include_once "./footer.php"; ?>
</body>

</html>