<?php
include_once __DIR__ . "/../vendor/db.php";

class Notification
{
    private $connection = "";

    public function __construct()
    {
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function SentNoti($content, $user,$link)
    {
        //1.DataBase Connect


        $sql = "INSERT INTO `noti`( `content`,`link`) VALUES (:content,:link)";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':content', $content);
        $statement->bindParam(':link', $link);

        if ($statement->execute()) {

            $sql = "SELECT id FROM noti ORDER BY id DESC LIMIT 1";

            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $notiId = $statement->fetch(PDO::FETCH_ASSOC);

            if (isset($notiId)) {
                $notiInt = intval($notiId['id']);

                $sql = "INSERT INTO `noti_pivi`(`user_id`, `noti_id`) VALUES (:userId,:notiId)";

                $statement = $this->connection->prepare($sql);
                $statement->bindParam(":userId",$user);
                $statement->bindParam(":notiId",$notiInt );
                if($statement->execute()){
                }

            }

        }

    }

    public function LoadNoTiCount($user_id)
    {

        $sql = "SELECT COUNT(*) as notiCount FROM noti_pivi JOIN noti WHERE noti_pivi.id = noti.id and noti.is_read = 0 and user_id = :userId;";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':userId',$user_id);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function LoadNoti($user_id)
    {

        $sql = "SELECT * FROM `noti_pivi` JOIN noti on noti_id = noti.id and user_id = :userId ORDER By noti.id desc";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':userId',$user_id);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

   

}

$NOtiModal = new Notification();

// echo "<pre>";
// var_dump($NOtiModal->SentNoti(" is folling You",27,"asdfasd"));

// // var_dump($NOtiModal->LoadNoTiCount(27));
// // var_dump($NOtiModal->LoadNoti(27));
// echo "</pre>";