<?php 
include_once __DIR__."/../model/register.php";
class RegisterController extends Register{
    public function registerUser($filename, $fname, $lname, $email, $password,$fullname)
    {
        return $this->createUserAccount($filename, $fname, $lname, $email, $password,$fullname);
    }

    public function getUserList()
    {
        return $this->getAllUser();
    }
    public function getUserInfo($email)
    {
        return $this->getUserId($email);
    }
}
?>