<?php
include_once __DIR__ . "/../vendor/db.php";

class Report
{
    private $connection = "";

    public function __construct()
    {
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getData($sql_sta)
    {
        $sql = $sql_sta;

        $statement = $this->connection->prepare($sql);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($result);
            $datalist = [];
            $cat_name_list = [];
            foreach ($result as $key => $value) {
                $cat_name_list[] = $value['name'];
            }
            foreach ($result as $key => $value) {
                # code...
                $datalist[] = $value['post_count'];
            }
            $dataResult = json_encode(array("data" => $datalist, "name" => $cat_name_list));
            return $dataResult;
        }
    }

 
}

$Report_model = new Report();

// echo "<pre>";
// var_dump($Report_model->Total_Sold_Out_Posts_in_each_category());
// echo "<pre>";