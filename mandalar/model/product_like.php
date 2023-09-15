<?php
include_once __DIR__."/../vendor/db.php";

class ProductLike{
    private $connection="";
    public function createProductLike($post_id, $user_id)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="INSERT INTO `post_react`(`user_id`,`post_id`) VALUES (:user_id, :post_id)";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":user_id",$user_id);
        $statement->bindParam(":post_id",$post_id);

        //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function createProductFavorite($post_id, $user_id)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="INSERT INTO `favorite`(`user_id`,`post_id`) VALUES (:user_id, :post_id)";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":user_id",$user_id);
        $statement->bindParam(":post_id",$post_id);

        //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function deleteProductLike($post_id,$user_id)
{
     //1.DataBase Connect
     $this->connection=Database::connect();
     $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM `post_react` WHERE user_id=:user_id AND post_id=:post_id";
    
    $statement=$this->connection->prepare($sql);

    $statement->bindParam(":user_id",$user_id, PDO::PARAM_INT);
    $statement->bindParam(":post_id",$post_id, PDO::PARAM_INT);

    //3.execute
    if($statement->execute())
    {
        return true;
    }else
    {
        return false;
    }
}
    public function deleteProductFavorite($post_id,$user_id)
    {
         //1.DataBase Connect
         $this->connection=Database::connect();
         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "DELETE FROM `favorite` WHERE user_id=:user_id AND post_id=:post_id";
        
        $statement=$this->connection->prepare($sql);
    
        $statement->bindParam(":user_id",$user_id, PDO::PARAM_INT);
        $statement->bindParam(":post_id",$post_id, PDO::PARAM_INT);
    
        //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }

}
    
    public function getAllPostReact()
    {
         //1.DataBase Connect
         $this->connection=Database::connect();
         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
         //2.sql Statement
         $sql="select * from post_react";
         $statement=$this->connection->prepare($sql);
 
         //3.execute
         $statement->execute();
         $result=$statement->fetchAll(PDO::FETCH_ASSOC);
         return $result;
    }
    public function getAllPostFavorite()
    {
         //1.DataBase Connect
         $this->connection=Database::connect();
         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
         //2.sql Statement
         $sql="select * from favorite";
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
    public function react_list_postId($post_id){
            //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="select * from post_react where post_id=:post_id";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":post_id",$post_id);

        //3.execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function favorite_list_postId($post_id){
        //1.DataBase Connect
    $this->connection=Database::connect();
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //2.sql Statement
    $sql="select * from favorite where post_id=:post_id";
    $statement=$this->connection->prepare($sql);

    $statement->bindParam(":post_id",$post_id);

    //3.execute
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
}
?>