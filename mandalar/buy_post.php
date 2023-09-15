<?php
$buy_post = $post_controller->get_buy_post($user_id);
?>

<section id="products" class="">

    <div class="row ">
        <?php foreach ($buy_post as $post) {
            # code...
            ?>

            <a href="#" data-user-id="<?php echo $user_id ?>" data-post-id="<?php echo $post['id'] ?>"
                class="view_btn col-md-4 col-sm-6  col-lg-3 mb-4 " onclick="AddCount(event)">
                
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
                                <img src="image/user-profile/<?php echo $post['user_img'] ?>"
                                    class="rounded-circle profile-on-card" alt="Seller 1" />
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