<?php include_once __DIR__."/../model/post.php";
class PostController extends Post{
    public function add_post($id,$name,$brand,$options,$post_subcategory,$price,$text_area,$imageFolder,$status)
    {
        return $this->add_new_post($id,$name,$brand,$options,$post_subcategory,$price,$text_area,$imageFolder,$status);
    }

    public function getCategoryList()
    {
        return $this->getAllCategory();
    }

    public function getSubCategoryList($id){
        return $this->getAllSubCategory($id);
    }
    // public function getUserInfo($email)
    // {
    //     return $this->getUserId($email);
    // }
    public function getPostList(){
        return $this->getAllPost();
    }
    public function getPost($id){
        return $this->getPostById($id);
    }
    public function getFreezeMoney($id){
        return $this->takeFreezeMoney($id);
    }
    
// buyer update post
    public function updateBuyer($user_id,$buyer_info_id,$status,$post_id,$buy_date){
        return $this->newBuyer($user_id,$buyer_info_id,$status,$post_id,$buy_date);
    }
    public function updateSeller($seller_info_id,$status,$post_id){
        return $this->newSeller($seller_info_id,$status,$post_id);
    }
    public function favorite_post_list($user_id){
        return $this->favoritePostListById($user_id);
    }
    
    // seller
    public function getSellerPost($user_id){
        return $this->getSellerPostById($user_id);
    }
    public function getPostByCity($seller_city_id,$buyer_city_id,$selectedStatus){
        return $this->getPostByCityId($seller_city_id,$buyer_city_id,$selectedStatus);
    }

    // deli_command
    public function deli_command($stats,$check){
        return $this->deli_command_by_admin($stats,$check);
    }
    // take post
    public function take_post($deli_id){
        return $this->takePost($deli_id);
    }
    // send post
    public function send_post($deli_id){
        return $this->sendPost($deli_id);
    }
    // get deli post
    public function get_deli_post($post_id){
        return $this->get_deli_post_by_id($post_id);
    }
    // updat deli status
    public function deli_status_update($status,$post_id){
        return $this->deli_status_update_by_btn($status,$post_id);
    }

    public function getUserList($user_id)
    {
        return $this->getList($user_id);
    }

    public function searchPosts($searchinput)
    {
        return $this->searchPostList($searchinput);
    }

    public function add_view_count($post_id,$user_id){
        return $this->create_view_count($post_id,$user_id);
    }


    // noti

    public function get_post_id($id,$name,$brand,$options,$post_subcategory,$price,$text_area,$imageFolder,$status){
        return $this->take_post_id($id,$name,$brand,$options,$post_subcategory,$price,$text_area,$imageFolder,$status);
    }


    //get sold out post
    public function get_sold_out_post($id){
        return $this->sold_out_post($id);
    }

    // public function postStatus($searchinput)
    // {
    //     return $this->postDec($searchinput);
    // }

    public function searchBrand($searchinput)
    {
        return $this->search_Brand_Post($searchinput);
    }

    public function get_buy_post($user_id){
        return $this->buy_post($user_id);
    }

    public function getSoldOutPost($userid)
    {
        return $this->SoldOutPost($userid);
    }
}
?>