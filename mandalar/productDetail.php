<?php
// session_start();
include_once "nav.php";
include_once "./controller/postController.php";
include_once "./controller/userController.php";
include_once "./controller/cityController.php";

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    include_once "php/available_money.php";
    $user_controller = new UserController();
    $user_list = $user_controller->UserInfo($user_id);
} else {
    $user_id = "nan";
}

$id = $_GET['id'];
$post_controller = new PostController();

$city_controller = new CityController();
$posts = $post_controller->getPost($id);

$city_list = $city_controller->getCityList();
// echo 'sub_id'.$posts[0]['sub_category_id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    /> -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="css/product-detail.css" />
    <link rel="stylesheet" href="css/products.css" />
    <link rel="stylesheet" href="css/comment.css" />

    <!-- <script src="js/modernizr-2.6.2.min.js"></script> -->
    <!-- <link rel="stylesheet" href="../mandalar/fontawesome-free-6.4.0-web/css/all.min.css" /> -->
    <link rel="stylesheet" href="mdbbootstrap/css/mdb.min.css">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap/css/bootstrap.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap/css/mdb.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap/css/mdb.min.css" />  -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" />  -->
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style2.css">
    <title>Product Detail Page</title>
</head>
<style>
    #myElement {
        visibility: visible;
        opacity: 1 !important;
    }
</style>

<body>
    <div id="commenter_id" data-user-id="<?php echo $user_id ?>"></div>
    <div id="post_id" data-post-id='<?php echo $id ?>'>


        <div class="success-overlay">
            <span>Successfully</span>
        </div>
        <main>
            <div class="container my-5">
                <div class="row">
                    <?php foreach ($posts as $post) {
                        $images = glob('image/post_img/' . $post['photo_folder'] . '/*.{jpg,png,gif,jpeg,jiff}', GLOB_BRACE);
                    ?>
                        <div class="col-md-6">
                            <div class="swiper-container">
                                <div class="swiper-wrapper main-product-img-container">
                                    <?php
                                    foreach ($images as $image) {
                                    ?>
                                        <div class="swiper-slide card shadow">
                                            <img src="<?php echo $image; ?>" alt="Product Image 1" />
                                        </div>
                                    <?php } ?>

                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-next text-black"></div>
                                <div class="swiper-button-prev text-black"></div>
                            </div>
                        </div>
                        <div class="col-md-6 ps-5">
                            <div class="product-info">
                                <h1>
                                    <?php echo $post['item']; ?>
                                </h1>
                                <p class="category text-muted">Category:
                                    <?php echo $post['cate_name']; ?>
                                </p>
                                <p class="text-muted" id="subCategory" data-category="<?php echo $post['sub_category_id'] ?>">Sub Category:
                                    <?php echo $post['sub_name']; ?>
                                </p>
                                <p class="brand">Brand:
                                    <?php echo $post['brand']; ?>
                                </p>
                                <p class="product-status" data-status=<?php echo $post['new_used'] ?>>Status:
                                    <?php echo $post['new_used']; ?>
                                </p>
                                <h2 id="price" data-price=<?php echo $post['price'] ?>>
                                    <?php echo $post['price']; ?> Ks
                                </h2>
                                <p>
                                    <?php echo $post['description']; ?>
                                </p>
                                <div class="product-buttons">
                                    <?php if (isset($_SESSION["user_id"])) {  ?>
                                        <button class="btn bg-secondary text-white" id="product-like" data-post-id="<?php echo $id; ?>" data-user-id="<?php echo $user_id; ?>">
                                            <i class="fas fa-thumbs-up"></i> <span id="post-like-count"></span>
                                        </button>
                                        <button class="btn btn-secondary bg-info  text-white comment-btn">
                                            <i class="fas fa-comment"></i> Comment
                                        </button>
                                        <button class="btn bg-secondary text-white" id="product-favorite" data-post-id="<?php echo $id; ?>" data-user-id="<?php echo $user_id; ?>">
                                            <i class="fas fa-heart"></i> <span id="post-favorite-count"></span>
                                        </button>
                                        <?php if ($post['status'] == "none") {
                                        ?>
                                            <button type="button" style="display:<?php
                                                                                    if ($user_id == $post['seller_id'])
                                                                                        echo 'none';
                                                                                    else {
                                                                                        echo 'block';
                                                                                    }
                                                                                    ?>;  background-color: #4e9c81;" class="btn text-white" data-mdb-toggle="modal" data-mdb-target="#exampleModal"> Buy</button>
                                        <?php } else if ($post['status'] != 'none' && $post['status'] != 'sold_out') { ?>
                                            <button class="btn btn-warning">Waiting!</button>
                                            <!-- <span class="bg-warning" style="border-radius: 10px;">Waiting!</span> -->
                                        <?php } else if ($post['status'] == 'sold_out') { ?>
                                            <button class="btn btn-danger">Sold Out</button>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <button class="btn btn-secondary bg-primary text-white" id="product-like" data-mdb-toggle="modal" data-mdb-target="#productDetailModal">
                                            <i class="fas fa-thumbs-up"></i><span></span>
                                        </button>
                                        <button class="btn btn-secondary bg-info  text-white comment-btn">
                                            <i class="fas fa-comment"></i> Comment
                                        </button>
                                        <button class="btn btn-secondary bg-danger text-white" id="product-favorite" data-mdb-toggle="modal" data-mdb-target="#productDetailModal">
                                            <i class="fas fa-heart"></i> <span></span>
                                        </button>
                                        <button type="button" class="btn btn-primary" style="background-color: #4e9c81;" data-mdb-toggle="modal" data-mdb-target="#productDetailModal"> Buy</button>

                                        <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Please Sign Up and Register</h5>
                                                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- <div class="modal-body">...</div> -->
                                                    <div class="modal-footer d-flex align-items-center justify-content-center">
                                                        <a href="register.php" class="btn btn-info">Register</a>
                                                        <a href="login.php" class="btn btn-primary">Login</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="comment-section d-none">
                    <h3>Comments</h3>
                    <div class="comments"></div>
                    <!-- <div class="comments">
                            <div class="comment">
                                <div class="d-flex">
                                    <img src="image/profiles/Profile.png" class="profile-picture-comment" alt="User 1"
                                        style="width: max-content" />
                                    <div>
                                        <div class="comment-content">
                                            <div class="comment-details">
                                                <span class="comment-author">User 1</span>
                                                <span class="comment-date">Posted on July 12, 2023</span>
                                            </div>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec semper
                                            mauris, at convallis est.
                                        </div>
                                        <div class="comment-actions">
                                            <button class="btn btn-link btn-sm">Like</button>
                                            <button class="btn btn-link btn-sm">Reply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment">
                            <div class="d-flex">
                                <img src="image/profiles/Profile.png" class="profile-picture-comment" alt="User 1"
                                    style="width: max-content" />
                                <div>
                                    <div class="comment-content">
                                        <div class="comment-details">
                                            <span class="comment-author">User 1</span>
                                            <span class="comment-date">Posted on July 12, 2023</span>
                                        </div>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec semper mauris,
                                        at convallis est.
                                    </div>
                                    <div class="comment-actions">
                                        <button class="btn btn-link btn-sm">Like</button>
                                        <button class="btn btn-link btn-sm">Reply</button>
                                        <button class="btn btn-link btn-sm see-reply" onclick="seeReplies(event)">see 2
                                            reply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="replies">
                                <div class="comment">
                                    <div class="d-flex">
                                        <img src="image/profiles/Profile.png" class="profile-picture-comment"
                                            alt="User 1" style="width: max-content" />
                                        <div>
                                            <div class="comment-content">
                                                <div class="comment-details">
                                                    <span class="comment-author">User 1</span>
                                                    <span class="comment-date">Posted on July 12, 2023</span>
                                                </div>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec semper
                                                mauris, at convallis est.
                                            </div>
                                            <div class="comment-actions">
                                                <button class="btn btn-link btn-sm">Like</button>
                                                <button class="btn btn-link btn-sm">Reply</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="replies">
                                        <div class="comment">
                                            <div class="d-flex">
                                                <img src="image/profiles/Profile.png" class="profile-picture-comment"
                                                    alt="User 1" style="width: max-content" />
                                                <div>
                                                    <div class="comment-content">
                                                        <div class="comment-details">
                                                            <span class="comment-author">User 1</span>
                                                            <span class="comment-date">Posted on July 12, 2023</span>
                                                        </div>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec
                                                        semper mauris, at convallis est.
                                                    </div>
                                                    <div class="comment-actions">
                                                        <button class="btn btn-link btn-sm">Like</button>
                                                        <button class="btn btn-link btn-sm">Reply</button>
                                                        <button class="btn btn-link btn-sm">see 2 reply</button>

                                                    </div>
                                                </div>
                                                <div class="replies"></div>
                                            </div>
                                        </div>
                                        <div class="comment-actions">
                                            <button class="btn btn-link btn-sm">Like</button>
                                            <button class="btn btn-link btn-sm">Reply</button>
                                            <button class="btn btn-link btn-sm see-reply" onclick="seeReplies(event)">see 2
                                            reply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-form">
                        <div class="form-group">
                            <label for="comment-input">Add a comment</label>
                            <textarea class="form-control" id="comment-input" rows="2"></textarea>
                        </div>
                        <button type="submit" id="comment-btn" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </div>

            <div class="related-products my-5">
                <div class="container">
                    <h3 class="mb-4">Related Products</h3>
                    <div class="position-relative related-products-slider overflow-hidden">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="card shadow">
                                    <img src="image/products/product-image2.jfif" class="card-img-top product-image"
                                        alt="Product 2" />
                                    <div class="card-body">
                                        <h5 class="card-title">Product 2</h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <img src="image/profiles/seller1.jpg"
                                                    class="rounded-circle profile-on-card" alt="Seller 1" />
                                                <span class="ml-2 card-text">Seller 1</span>
                                            </div>
                                            <div>
                                                <p class="card-text view-details-btn">300000mmk</p>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <i class="far fa-heart mr-2"></i>
                                            <span class="reaction-count">5</span>
                                            <i class="far fa-plus-square ml-3"></i>
                                            <span class="save-count">8</span>
                                            <i class="far fa-eye ml-3"></i>
                                            <span class="view-count">30</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card shadow">
                                    <img src="image/products/product-image2.jfif" class="card-img-top product-image"
                                        alt="Product 2" />
                                    <div class="card-body">
                                        <h5 class="card-title">Product 2</h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <img src="image/profiles/seller2.jpg"
                                                    class="rounded-circle profile-on-card" alt="Seller 2" />
                                                <span class="ml-2 card-text">Seller 2</span>
                                            </div>
                                            <div>
                                                <p class="card-text view-details-btn">300000mmk</p>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <i class="far fa-heart mr-2"></i>
                                            <span class="reaction-count">5</span>
                                            <i class="far fa-plus-square ml-3"></i>
                                            <span class="save-count">8</span>
                                            <i class="far fa-eye ml-3"></i>
                                            <span class="view-count">30</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card shadow">
                                    <img src="image/products/product-image2.jfif" class="card-img-top product-image"
                                        alt="Product 2" />
                                    <div class="card-body">
                                        <h5 class="card-title">Product 2</h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <img src="image/profiles/seller3.jpg"
                                                    class="rounded-circle profile-on-card" alt="Seller 3" />
                                                <span class="ml-2 card-text">Seller 3</span>
                                            </div>
                                            <div>
                                                <p class="card-text view-details-btn">300000mmk</p>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <i class="far fa-heart mr-2"></i>
                                            <span class="reaction-count">5</span>
                                            <i class="far fa-plus-square ml-3"></i>
                                            <span class="save-count">8</span>
                                            <i class="far fa-eye ml-3"></i>
                                            <span class="view-count">30</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <div class="comment-form">
                        <div class="form-group">
                            <!-- <button type="button" class="btn btn-primary" id="liveAlertBtn">Show live alert</button> -->
                            <label for="comment-input">Add a comment</label>
                            <div id="liveAlertPlaceholder"></div>

                            <textarea class="form-control" id="comment-input" rows="2"></textarea>
                        </div>
                        <?php if (isset($_SESSION["user_id"])) { ?>
                            <button type="submit" id="comment-btn" class="btn btn-primary">
                                Submit
                            </button>
                        <?php } else { ?>
                            <button type="submit" data-mdb-toggle="modal" data-mdb-target="#productCommentModal" class="btn btn-primary">
                                Submit
                            </button>
                            <div class="modal fade" id="productCommentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Please Sign Up and Register</h5>
                                                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- <div class="modal-body">...</div> -->
                                                    <div class="modal-footer d-flex align-items-center justify-content-center">
                                                        <a href="register.php" class="btn btn-secondary">Register</a>
                                                        <a href="login.php" class="btn btn-primary">Login</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="related-products my-5">
                <div class="container">
                    <h3 class="mb-4">Related Products</h3>
                    <div class="position-relative related-products-slider overflow-hidden">
                        <div class="swiper-wrapper" id="Related-Wrapper">
                            <div class="swiper-slide">

                            </div>
                            <div class="swiper-slide">
                                <div class="card shadow">
                                    <img src="image/products/product-image2.jfif" class="card-img-top product-image" alt="Product 2" />
                                    <div class="card-body">
                                        <h5 class="card-title">Product 2</h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <img src="image/profiles/seller2.jpg" class="rounded-circle profile-on-card" alt="Seller 2" />
                                                <span class="ml-2 card-text">Seller 2</span>
                                            </div>
                                            <div>
                                                <p class="card-text view-details-btn">300000mmk</p>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <i class="far fa-heart mr-2"></i>
                                            <span class="reaction-count">5</span>
                                            <i class="far fa-plus-square ml-3"></i>
                                            <span class="save-count">8</span>
                                            <i class="far fa-eye ml-3"></i>
                                            <span class="view-count">30</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card shadow">
                                    <img src="image/products/product-image2.jfif" class="card-img-top product-image" alt="Product 2" />
                                    <div class="card-body">
                                        <h5 class="card-title">Product 2</h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <img src="image/profiles/seller3.jpg" class="rounded-circle profile-on-card" alt="Seller 3" />
                                                <span class="ml-2 card-text">Seller 3</span>
                                            </div>
                                            <div>
                                                <p class="card-text view-details-btn">300000mmk</p>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <i class="far fa-heart mr-2"></i>
                                            <span class="reaction-count">5</span>
                                            <i class="far fa-plus-square ml-3"></i>
                                            <span class="save-count">8</span>
                                            <i class="far fa-eye ml-3"></i>
                                            <span class="view-count">30</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
            <!-- model start -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php if ($available_money >= $posts[0]['price']) { ?>
                                <form id="buy-form" action="#" method="POST">

                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <label for="" class="form-label">Phone No</label>
                                            <input id="buyer-phone" name="buyer_phone" type="number" class="form-control">
                                            <span class="text-danger" id="phone-error" style="display:none;">Need to fill
                                                your phone no.!!!</span>
                                        </div>
                                        <div class="col-1"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <label for="" class="form-label">City</label>
                                            <select name="city" id="" class="form-select">
                                                <?php foreach ($city_list as $city) { ?>
                                                    <option value="<?php echo $city['id'] ?>"><?php echo $city['name'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-1"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <label for="" class="form-label">Address</label>
                                            <textarea id="buyer-address" name="buyer_address" id="" cols="50" rows="5" class="form-control"></textarea>
                                            <span class="text-danger" id="address-error" style="display:none;">Need to fill
                                                your adress!!!</span>
                                        </div>
                                        <div class="col-1"></div>
                                    </div>
                                </form>
                            <?php } else { ?>
                                <p>not enough balance</p>
                            <?php } ?>
                        </div>
                        <div class="modal-footer">
                            <?php if ($available_money >= $posts[0]['price']) { ?>
                                <button type="button" class="btn btn-secondary" id="buy-info-close" data-mdb-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="buy-btn">Save changes</button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-secondary" id="buy-info-close" data-mdb-dismiss="modal">Close</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- model end -->
        </main>
        <?php include_once 'seller_info.php' ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script src="js/product-detail.js"></script>
        <script src="js/related.js"></script>
        <script src="js/comment.js"></script>
        <!-- <script src="js/loader.js"></script> -->

        <script>
            // var swiper = new Swiper(".swiper-container", {
            // 	pagination: {
            // 		el: ".swiper-pagination",
            // 	},
            // 	effect: "cards",
            // 	cardsEffect: {
            // 		// ...
            // 	},
            // 	loop: true,
            // 	navigation: {
            // 		nextEl: ".swiper-button-next",
            // 		prevEl: ".swiper-button-prev",
            // 	},
            // });

            // var relatedProductsSwiper = new Swiper(".related-products-slider", {
            // 	slidesPerView: 3,
            // 	spaceBetween: 20,
            // 	navigation: {
            // 		nextEl: ".swiper-button-next",
            // 		prevEl: ".swiper-button-prev",
            // 	},
            // 	breakpoints: {
            // 		375: {
            // 			slidesPerView: 1,
            // 		},
            // 		768: {
            // 			slidesPerView: 2,
            // 		},
            // 		992: {
            // 			slidesPerView: 3,
            // 		},
            // 	},
            // 	effect: "coverflow",
            // 	coverflowEffect: {
            // 		rotate: 10,
            // 		slideShadows: false,
            // 	},
            // });

            // const commentBtn = document.querySelector(".comment-btn");
            // const commentSection = document.querySelector(".comment-section");

            // commentBtn.addEventListener("click", function () {
            // 	commentSection.classList.toggle("d-none");
            // });

            // const comments = document.querySelectorAll(".comment");
            // comments.forEach(function (comment) {
            // 	const likeBtn = comment.querySelector(".comment-like");
            // 	const replyBtn = comment.querySelector(".comment-reply");

            // 	// likeBtn.addEventListener("click", function () {
            // 	// 	// Perform like action
            // 	// });

            // 	// replyBtn.addEventListener("click", function () {
            // 	// 	// Perform reply action
            // 	// });
            // });
        </script>

        <?php include_once "./footer.php";

        ?>