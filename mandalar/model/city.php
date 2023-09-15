<?php
include_once __DIR__."/../vendor/db.php";

class City{
    private $connection="";
    // public function createUserAccount($image,$fname,$lname,$email,$password)
    // {
    //     //1.DataBase Connect
    //     $this->connection=Database::connect();
    //     $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     //2.sql Statement
    //     $sql="INSERT INTO users(fname,lname,email,password,img) VALUES(:first_name,:last_name,:user_email,:user_password,:user_img)";
    //     $statement=$this->connection->prepare($sql);

    //     $statement->bindParam(":first_name",$fname);
    //     $statement->bindParam(":last_name",$lname);
    //     $statement->bindParam(":user_email",$email);
    //     $statement->bindParam(":user_password",$password);
    //     $statement->bindParam(":user_img",$image,);

    //     //3.execute
    //     if($statement->execute())
    //     {
    //         return true;
    //     }else
    //     {
    //         return false;
    //     }
    // }

    //get All user
    public function getAllCity()
    {
         //1.DataBase Connect
         $this->connection=Database::connect();
         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
         //2.sql Statement
         $sql="select * from city";
         $statement=$this->connection->prepare($sql);
 
         //3.execute
         $statement->execute();
         $result=$statement->fetchAll(PDO::FETCH_ASSOC);
         return $result;
    }
    // public function getUserId($email)
    // {
    //     //1.DataBase Connect
    //     $this->connection=Database::connect();
    //     $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     //2.sql Statement
    //     $sql="select user_id from users where email=:email";
    //     $statement=$this->connection->prepare($sql);

    //     $statement->bindParam(":email",$email);

    //     //3.execute
    //     $statement->execute();
    //     $result=$statement->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }
}
?>