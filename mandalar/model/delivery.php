<?php
include_once __DIR__."/../vendor/db.php";

class Delivery{
    private $connection="";
    public function createDeliveryAccount($name,$phone,$password,$nrc,$new_deli_profile_img_name,$new_front_nrc_image_name,$new_back_nrc_image_name,$city)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="INSERT INTO `delivery`( `name`, `nrc`, `phone`, `password`, `city_id`, `photo`, `nrc_front`, `nrc_back`) VALUES(:name, :nrc, :phone, :password, :city_id, :photo, :nrc_front, :nrc_back)";
        $statement=$this->connection->prepare($sql);
        $passwordHash = md5($password);
        $statement->bindParam(":password", $passwordHash);
        $statement->bindParam(":name",$name);
        $statement->bindParam(":nrc",$nrc);
        $statement->bindParam(":phone",$phone);
        $statement->bindParam(":city_id",$city);
        $statement->bindParam(":photo",$new_deli_profile_img_name);
        $statement->bindParam(":nrc_front",$new_front_nrc_image_name);
        $statement->bindParam(":nrc_back",$new_back_nrc_image_name);

        //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    //get All Delivery
    public function getAllDelivery()
    {
         //1.DataBase Connect
         $this->connection=Database::connect();
         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
         //2.sql Statement
         $sql="select * from delivery";
         $statement=$this->connection->prepare($sql);
 
         //3.execute
         $statement->execute();
         $result=$statement->fetchAll(PDO::FETCH_ASSOC);
         return $result;
    }
    public function takeDeliveryListById($deli_city)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="SELECT * FROM `delivery` WHERE city_id=:deli_city";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":deli_city",$deli_city);

        //3.execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function deli_order_by_admin($check,$delivery){
        // 1. Database Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. SQL Statement
        $sql = "INSERT INTO `wave`(`post_id`, `delivery_id`) VALUES (:check,:delivery)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":check", $check);
        $statement->bindParam(":delivery", $delivery);

        // 3. Execute
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function get_deli_by_id($deli_id)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="SELECT delivery.* , city.name as city_name FROM `delivery` join city on city.id=delivery.city_id WHERE delivery.id=:deli_id";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":deli_id",$deli_id);

        //3.execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function takeDeliveryId($phone){
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="SELECT * from delivery where phone=:phone";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":phone",$phone);

        //3.execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>