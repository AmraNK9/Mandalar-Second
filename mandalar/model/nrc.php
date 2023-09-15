<?php
include_once __DIR__."/../vendor/db.php";

class NRC{
    private $connection="";

    public function Nrc($userid,$nrcNumber,$frontfilename,$backfilename)
    {
        //1.DataBase Connect
        // echo $nrcNumber.$frontfilename.$backfilename
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="INSERT INTO nrc(nrc, front_nrc, back_nrc,to_id) VALUES (:nrcNumber,:frontfilename,:backfilename,:to_id)";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":nrcNumber",$nrcNumber);
        $statement->bindParam(":frontfilename",$frontfilename);
        $statement->bindParam(":backfilename",$backfilename);
        $statement->bindParam(":to_id",$userid);

        //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function getNrcUser()
    {
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT * FROM nrc";
        $statement=$this->connection->prepare($sql);

        // $statement->bindParam(":to_id",$user_id);

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    public function updateNrcStatus($userid)
    {
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="UPDATE `nrc` SET `status`='1' WHERE to_id=:to_id";
        $statement=$this->connection->prepare($sql);

        
        $statement->bindParam(":to_id",$userid);

        //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function deleteuserNRC($to_id)
    {
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="DELETE FROM `nrc` WHERE to_id=:to_id";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":to_id",$to_id);

        //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }
}
?>