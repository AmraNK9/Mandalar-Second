<?php include_once __DIR__."/../model/product_like.php";
class ProductLikeController extends ProductLike{
    // public function registerDelivery($name,$phone,$password,$nrc,$new_deli_profile_img_name,$new_front_nrc_image_name,$new_back_nrc_image_name,$city)
    // {
    //     return $this->createDeliveryAccount($name,$phone,$password,$nrc,$new_deli_profile_img_name,$new_front_nrc_image_name,$new_back_nrc_image_name,$city);
    // }

    public function getPostReact()
    {
        return $this->getAllPostReact();
    }
    public function getPostFavorite()
    {
        return $this->getAllPostFavorite();
    }

    public function addNewProductLike($post_id, $user_id){
        return $this->createProductLike($post_id, $user_id);
    }
    public function removeProductLike($post_id, $user_id){
        return $this->deleteProductLike($post_id,$user_id);
    }
    public function addNewProductFavorite($post_id, $user_id){
        return $this->createProductFavorite($post_id, $user_id);
    }
    public function removeProductFavorite($post_id, $user_id){
        return $this->deleteProductFavorite($post_id,$user_id);
    }
    // public function getUserInfo($email)
    // {
    //     return $this->getUserId($email);
    // }
    public function react_list($post_id){
        return $this->react_list_postId($post_id);
    }
    public function favorite_list($post_id){
        return $this->favorite_list_postId($post_id);
    }
    
}
?>