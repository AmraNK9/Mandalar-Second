<?php
include_once __DIR__."/../vendor/db.php";

class User{

    private $connection="";

    public function UserDetail($userid, $update_fname, $update_lname, $update_bio, $filename,$fullname)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        //2.sql Statement
        $sql="UPDATE users SET fname=:user_fname,lname=:user_lname,
        img=:image,bio=:bio,full_name=:full_name WHERE user_id=:user_id";
         $statement=$this->connection->prepare($sql);


        $statement->bindParam(":user_fname",$update_fname);
        $statement->bindParam(":user_lname",$update_lname);
        $statement->bindParam(":user_id",$userid);
        $statement->bindParam(":bio",$update_bio,);
        $statement->bindParam(":image",$filename,);
        $statement->bindParam(":full_name",$fullname);


        //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function UserAllInfo($user_id)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="select * from users where user_id=:user_id";
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":user_id",$user_id);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        
        return $result;

    }

    public function updateNrc($nrcNumber,$user_id)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="UPDATE `users` SET `nrc`=:nrc WHERE user_id=:user_id";
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":user_id",$user_id);
        $statement->bindParam(":nrc",$nrcNumber);

        //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }

    }


    public function enterWallet($userid,$amount,$kpay_name,$kpay_phone,$kpay_img)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="INSERT INTO `money_check`(`user_id`, `check_wallet`, `kpay_phone`, `kpay_name`, `kpay_img`) VALUES 
        (:user_id,:check_wallet,:kpay_phone,:kpay_name,:kpay_img)";
         $statement=$this->connection->prepare($sql);

         $statement->bindParam(":user_id",$userid);
         $statement->bindParam(":check_wallet",$amount);
         $statement->bindParam(":kpay_phone",$kpay_phone);
         $statement->bindParam(":kpay_name",$kpay_name);
         $statement->bindParam(":kpay_img",$kpay_img);

         //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function UpdateUserAmount($userid,$newAmount)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="UPDATE `users` SET `wallet`=:wallet WHERE user_id=:user_id";
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":user_id",$userid);
        $statement->bindParam(":wallet",$newAmount);

        //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }
    public function takeAllUser(){
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="select * from users";
        $statement=$this->connection->prepare($sql);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function amount_withdraw($user_id,$kpay_name,$kpay_ph,$kpay_amount,$status)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="INSERT INTO `withdraw`(`user_id`, `kpay_name`, `kpay_phone`, `amount`,`status`) VALUES 
        (:user_id,:kpay_name,:kpay_phone,:amount,:status)";
         $statement=$this->connection->prepare($sql);

         $statement->bindParam(":user_id",$user_id);
         $statement->bindParam(":kpay_name",$kpay_name);
         $statement->bindParam(":kpay_phone",$kpay_ph);
         $statement->bindParam(":amount",$kpay_amount);
         $statement->bindParam(":status",$status);


         //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function get_all_withdraw_list_by_id($user_id){
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="select * from withdraw where user_id=:user_id and status='wait'";
        
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":user_id",$user_id);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
}

$userModal = new User();
// $userInfo = $userModal->UserAllInfo(27);

// echo $userInfo[0]["full_name"];
?>