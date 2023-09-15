<?php include_once __DIR__."/../model/city.php";
class CityController extends City{
    // public function registerDelivery($image,$fname,$lname,$email,$password)
    // {
    //     return $this->createDeliveryAccount($image,$fname,$lname,$email,$password);
    // }

    public function getCityList()
    {
        return $this->getAllCity();
    }
    // public function getUserInfo($email)
    // {
    //     return $this->getUserId($email);
    // }
}
?>