<?php
include_once __DIR__."/../vendor/db.php";

class Seller{
    private $connection="";
    public function addSellerInfo($user_id,$phone,$city,$address)
{
    // 1. Database Connect
    $this->connection = Database::connect();
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. SQL Statement
    $sql = "INSERT INTO `user_info`(`user_id`, `address`, `phone`, `city_id`) VALUES 
    (:user_id, :address, :phone, :city_id)";
    
    $statement = $this->connection->prepare($sql);
    $statement->bindParam(":user_id", $user_id);
    $statement->bindParam(":address", $address);
    $statement->bindParam(":phone", $phone);
    $statement->bindParam(":city_id", $city);

    // 3. Execute
    if ($statement->execute()) {
        return true;
    } else {
        return false;
    }
}
public function takeSellerId($user_id,$phone,$city,$address)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="Select id from user_info where user_id=:user_id and city_id=:city_id and address=:address and phone=:phone";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":user_id",$user_id);
        $statement->bindParam(":city_id",$city);
        $statement->bindParam(":address",$address);
        $statement->bindParam(":phone",$phone);

        //3.execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


//     //get All Categories
//     public function getAllCategory()
//     {
//          //1.DataBase Connect
//          $this->connection=Database::connect();
//          $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//          //2.sql Statement
//          $sql="select * from category";
//          $statement=$this->connection->prepare($sql);
 
//          //3.execute
//          $statement->execute();
//          $result=$statement->fetchAll(PDO::FETCH_ASSOC);
//          return $result;
//     }
//     public function getAllSubCategory($id)
//     {
//         //1.DataBase Connect
//         $this->connection=Database::connect();
//         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//         //2.sql Statement
//         $sql="select * from sub_category where category_id=:id";
//         $statement=$this->connection->prepare($sql);

//         $statement->bindParam(":id",$id);

//         //3.execute
//         $statement->execute();
//         $result=$statement->fetchAll(PDO::FETCH_ASSOC);
//         return $result;
//     }
//     public function getAllPost()
//     {
//          //1.DataBase Connect
//          $this->connection=Database::connect();
//          $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//          //2.sql Statement
//          $sql="SELECT post.*,users.fname,users.lname,users.img as user_img FROM `post` join users on post.seller_id=users.user_id ORDER BY post.post_date DESC";
//          $statement=$this->connection->prepare($sql);
 
//          //3.execute
//          $statement->execute();
//          $result=$statement->fetchAll(PDO::FETCH_ASSOC);
//          return $result;
//     }
//     public function getPostById($id)
//     {
//         //1.DataBase Connect
//         $this->connection=Database::connect();
//         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//         //2.sql Statement
//         $sql="SELECT post.*,users.fname,users.lname,users.img as user_img,category.name as cate_name,sub_category.name as sub_name FROM `post` join users on post.seller_id=users.user_id join sub_category on sub_category.id=post.sub_category_id join category on sub_category.category_id=category.id where post.id=:id";
//         $statement=$this->connection->prepare($sql);

//         $statement->bindParam(":id",$id);

//         //3.execute
//         $statement->execute();
//         $result=$statement->fetchAll(PDO::FETCH_ASSOC);
//         return $result;
//     }
}
?>