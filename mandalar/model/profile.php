<?php 
include_once __DIR__."/../vendor/db.php";

class UserProfile
{
    private $connection="";

     //get All user
     public function getAllUser()
     {
          //1.DataBase Connect
          $this->connection=Database::connect();
          $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
          //2.sql Statement
          $sql="select * from users";
          $statement=$this->connection->prepare($sql);
  
          //3.execute
          $statement->execute();
          $result=$statement->fetchAll(PDO::FETCH_ASSOC);
          return $result;
     }
}
?>