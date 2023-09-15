<?php
include_once __DIR__."/../model/profile.php";
class ProfileController extends UserProfile
{
    public function getUserList()
    {
        return $this->getAllUser();
    }
}
?>