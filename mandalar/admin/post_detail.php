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
            <?php

include_once "../controller/postController.php";
if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
}
$user_id=7;
$id = $_GET['id'];
$post_controller = new PostController();
$posts = $post_controller->getPost($id);
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
        <link rel="stylesheet" href="../css/product-detail.css" />
        <link rel="stylesheet" href="../css/products.css" />
        <link rel="stylesheet" href="../css/comment.css" />

        <!-- <script src="js/modernizr-2.6.2.min.js"></script> -->
        <!-- <link rel="stylesheet" href="../mandalar/fontawesome-free-6.4.0-web/css/all.min.css" /> -->
        <link rel="stylesheet" href="../mdbbootstrap/css/mdb.min.css">

        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap/css/bootstrap.min.css" /> -->
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap/css/mdb.min.css" /> -->
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap/css/mdb.min.css" />  -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" /> -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" />  -->
        <link rel="stylesheet" href="../css/nav.css">
        <link rel="stylesheet" href="../css/style2.css">
        <title>Post Detail Page</title>
    </head>

    <body>
        <div id="loader"></div>

        <div id="page">
            <main>
                <div class="container my-5">
                    <div class="row">
                        <?php foreach ($posts as $post) {
						$images = glob('../image/post_img/' . $post['photo_folder'] . '/*.{jpg,png,gif}', GLOB_BRACE);
						?>
                        <div class="col-md-6">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
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
                                <p class="text-muted">Category:
                                    <?php echo $post['cate_name']; ?>
                                </p>
                                <p class="text-muted">Sub Category:
                                    <?php echo $post['sub_name']; ?>
                                </p>
                                <p class="brand">Brand:
                                    <?php echo $post['brand']; ?>
                                </p>
                                <p class="product-status">Status:
                                    <?php echo $post['new_used']; ?>
                                </p>
                                <h2>mmk
                                    <?php echo $post['price']; ?>
                                </h2>
                                <p>
                                    <?php echo $post['description']; ?>
                                </p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    
                <!-- model end -->
            </main>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
            <script src="../js/product-detail.js"></script>
            <script src="../js/comment.js"></script>
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

            <?php include_once "./../footer.php"; ?>
				
			</main>
            <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
            
            <!-- <script src="js/post-deli.js"></script> -->
<?php include_once "layouts/footer.php"; ?>











































