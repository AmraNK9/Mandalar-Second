<?php
include_once __DIR__."/../vendor/db.php";

class Kpay{
    private $connection="";

    public function getTrans()
    {
    //1.DataBase Connect
    $this->connection=Database::connect();
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql="Select * From money_check";
    $statement=$this->connection->prepare($sql);

    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    }

    public function UpdateKpayStatus($checking_id)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="UPDATE `money_check` SET `status`=1 WHERE id=:id";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":id",$checking_id);

        if($statement->execute())
        {
            return true;
        }else{
            return false;
        }
    }

    public function reject_money($checking_id)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="DELETE FROM `money_check` WHERE  id=:id";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":id",$checking_id);

        if($statement->execute())
        {
            return true;
        }else{
            return false;
        }
    }


    public function gethistory($user_id)
    {

        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="SELECT *
        FROM money_check
        WHERE user_id = :user_id
          AND status = 1
          AND DATE(date) = CURDATE()
        ORDER BY date DESC;";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":user_id",$user_id);

    
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getNottodayhistory($user_id)
    {

        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="SELECT *
        FROM money_check
        WHERE user_id = :user_id
          AND status = 1
          AND DATE(date) < CURDATE()
        ORDER BY date DESC;";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":user_id",$user_id);

    
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_all_withdraw(){
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="Select withdraw.*,users.full_name as user_name,users.wallet as user_wallet From withdraw join users on users.user_id=withdraw.user_id";
        $statement=$this->connection->prepare($sql);

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update_withdraw_status($withdraw_id,$status){
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="UPDATE `withdraw` SET `status`=:status WHERE id=:id";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":id",$withdraw_id);
        $statement->bindParam(":status",$status);

        if($statement->execute())
        {
            return true;
        }else{
            return false;
        }
    }

    public function todayWithdraw($user_id){
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="SELECT *
        FROM withdraw
        WHERE user_id = :user_id
          AND status = 'success'
          AND DATE(date) = CURDATE()
        ORDER BY date DESC;";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":user_id",$user_id);

    
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function notTodayWithdraw($user_id){
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="SELECT *
        FROM withdraw
        WHERE user_id = :user_id
          AND status = 'success'
          AND DATE(date) < CURDATE()
        ORDER BY date DESC;";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":user_id",$user_id);

    
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>