<?php include_once __DIR__."/../model/buyer.php";
class BuyerController extends Buyer{
    public function createBuyerInfo($user_id,$phone,$city,$address)
    {
        return $this->addBuyerInfo($user_id,$phone,$city,$address);
    }
    public function getBuyerId($user_id,$phone,$city,$address){
        return $this->takeBuyerId($user_id,$phone,$city,$address);
    }
    // public function getCategoryList()
    // {
    //     return $this->getAllCategory();
    // }

    // public function getSubCategoryList($id){
    //     return $this->getAllSubCategory($id);
    // }
    // // public function getUserInfo($email)
    // // {
    // //     return $this->getUserId($email);
    // // }
    // public function getPostList(){
    //     return $this->getAllPost();
    // }
    // public function getPost($id){
    //     return $this->getPostById($id);
    // }
}
?>