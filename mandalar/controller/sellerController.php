<?php include_once __DIR__."/../model/seller.php";
class SellerController extends Seller{
    public function createSellerInfo($user_id,$phone,$city,$address)
    {
        return $this->addSellerInfo($user_id,$phone,$city,$address);
    }
    public function getSellerId($user_id,$phone,$city,$address){
        return $this->takeSellerId($user_id,$phone,$city,$address);
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