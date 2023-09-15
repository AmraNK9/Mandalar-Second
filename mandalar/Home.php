<?php
error_reporting(0);
include_once "./nav.php";
include_once "./model/category.php";
include_once "./controller/postController.php";
include_once "./model/post.php";
include_once "./controller/userController.php";
$user_controller = new UserController();



$post_controller = new PostController();
$post_list = $post_controller->getPostList();
// var_dump($post_list);
$post_model = new Post();

// var_dump($post_list);


$categorys = $category_model->getCategory();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // echo $user_id;
    $user = $user_controller->UserInfo($user_id);
    $user_nrc = true;
    if ($user[0]['nrc'] == null) {
        $user_nrc = false;
    }
}
// $user_id=6;

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
        display: block;
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
</style>

<div class="container-xl">

    <!-- Category Component -->
    <section id="home" class="">
        <div class="container-xxl">
            <div class="row category-row">
                <div class="col-2 mb-1">
                    <label class="card radio-image">
                        <input type="radio" class="custom-control-input category" name="category" value="All" />
                        <img src="image/category_img/All.jpg" class="p-2 category-image" alt="ALL
                        " />
                    </label>
                </div>
                <?php
                foreach ($categorys as $category) {

                ?>
                    <div class="col-2 mb-1">
                        <label class="card radio-image">
                            <input type="radio" class="custom-control-input category" name="category" value="<?php echo $category["id"] ?>" />
                            <img src="image/category_img/<?php echo $category["img"] ?>" class="p-2 category-image" alt="
                        <?php echo $category["img"] ?>" />
                        </label>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </section>

    <!-- Filter Component -->
    <section id="filter" class="">
        <div class="container-xxl">
            <div class="row flitter-row">
                <div class="col-sm-4 col-6 mb-4">
                    <div class="card custom-card">
                        <div class="card-body">
                            <select class="browser-default custom-select custom-disabled-select" id="sub-catgory-fliter">
                                <option value="All">Disbale On ALL</option>
                                <option value="1">Brand 1</option>
                                <option value="2">Brand 2</option>
                                <option value="3">Brand 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mb-4 sm-hide">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div id="priceSlider"></div>
                            <p id="priceValue" class="text-center">
                                0 - 1000
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mb-4 col-6">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input status-radio" value="new" id="newCondition" name="condition" />
                                <label class="custom-control-label" for="newCondition">New</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input status-radio" value="used" id="usedCondition" name="condition" />
                                <label class="custom-control-label" for="usedCondition">Used</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mb-4  sm-show ">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div id="priceSlider2"></div>
                            <p id="priceValue2" class="text-center">
                                0 - 1000
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Cards -->
    <section id="products" class="">

        <div class="row ">
            <?php foreach ($post_list as $post) {
                # code...
            ?>

                <a href="#" data-user-id="<?php echo $user_id ?>" data-post-id="<?php echo $post['id'] ?>" class="view_btn col-md-4 col-sm-6  col-lg-3 mb-4 " onclick="AddCount(event)">
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
                                    <?php echo $post['price'] ?> Ks
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
                            $count_react = $post_model->getPostReaction($post['id']);
                            $count_favorite = $post_model->getPostFavorite($post['id']);
                            ?>
                            <div class=" product-info-box">
                                <div>
                                    <i class="fa-solid fa-thumbs-up"></i>

                                    <span class="reaction-count">
                                        <?php echo $count_react['count_react'] ?>
                                    </span>
                                </div>
                                <div>
                                    <i class="far fa-heart mr-2"></i>
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
    <!-- Post -->
    <?php if (isset($_SESSION['user_id'])) { ?>
        <button type="button" class="btn btn-primary " id="PostBtn" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
            +
        </button>
    <?php } else { ?>
        <!-- Modal -->
        <button type="button" class="btn btn-primary " id="PostBtn" data-mdb-toggle="modal" data-mdb-target="#plusmodel">
            +
        </button>
        <div class="modal fade" id="plusmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <?php if ($user_nrc == true) { ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Post</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" id="form" action="#" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <div class="btn-group" id="">

                                    <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" value="new" />
                                    <label class="btn btn-secondary" for="option2">New</label>

                                    <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off" value="used" checked />
                                    <label class="btn btn-secondary" for="option3">Used</label>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-4">
                                <div class="form-outline">
                                    <input type="text" class="form-control" id="item-name" name="item_name" required />
                                    <label for="validationDefault01" class="form-label">Item Name</label>
                                </div>
                                <span class="text-danger" id="name-error" style="display:none;">Need to fill item
                                    name!!!</span>

                            </div>
                            <div class="col-md-4">
                                <div class="form-outline">
                                    <input type="text" class="form-control" id="brand" name="brand" required />
                                    <label for="validationDefault02" class="form-label">Brand</label>
                                </div>
                                <span class="text-danger" id="brand-error" style="display:none;">Need to fill brand
                                    name!!!</span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-outline">
                                    <input type="number" class="form-control" id="price" name="price" required />
                                    <label for="validationDefault02" class="form-label">Price</label>
                                </div>
                                <span class="text-danger" id="price-error" style="display:none;">Need to fill
                                    price!!!</span>
                            </div>
                            <hr>
                            <div class="col-md-6">
                                <select class="custom-select" id="post-category" name="post_category">
                                    <!-- <option value="option1">Phone</option>
                                <option value="option2">Computer</option>
                                <option value="option3">Car</option> -->
                                    <!-- Add more options here as needed -->
                                </select>

                            </div>
                            <div class="col-md-6">
                                <select class="custom-select" id="post_subcategory" name="post_subcategory">

                                    <!-- Add more options here as needed -->
                                </select>

                            </div>
                            <hr>

                            <div class="col-md-12 form-outline">
                                <textarea class="form-control " name="text_area" style="height:100px" id="validationTextarea" placeholder="Please enter Description" required></textarea>
                                <label for="validationTextarea" class="form-label">Description</label>
                                <div class="invalid-feedback">Please enter a message in the textarea.</div>
                            </div>

                            <hr>
                            <div class="col-md-12">
                                <label class="form-label">Upload Images</label>

                                <div id="imagePreviews" class=" image-previews">
                                    <div class="image-selector">
                                        <label for="imageUpload" cl0ass="plus-sign" id="imageLabel">+</label>
                                        <input type="file" id="imageUpload" name="post_img[]" class="form-control" accept="image/*" multiple />
                                    </div>
                                </div>
                                <span class="text-danger" id="imagePreviews_error" style="display:none;">Need to fill
                                    image!!!</span>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" name="submit" id="post_save">Save changes</button>
                    </div>
                </div>
            <?php } ?>
            <?php if ($user_nrc == false) { ?>
                
                <!-- <div class="modal-dialog "> -->
                <div class="modal-content  ">
                    <!-- <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Verfied your account!!!</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div> -->
                    <div class="modal_body">
                        <h3>You need to verified your account!</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">Ok</button>
                    </div>
                </div>
            <!-- </div> -->

            <?php } ?>
        </div>
    </div>
    <div id="output"></div>
    <!-- model end -->
    <!-- seller info model -->
    <!-- Button trigger modal -->
    <?php include_once 'seller_info.php' ?>
    <!-- end -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="js/post.js"></script>
    <script src="js/flitter.js"></script>
    <script src="js/home.js"></script>
    <?php include_once "./footer.php"; ?>