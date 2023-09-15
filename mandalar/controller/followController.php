<?php
include_once __DIR__."/../model/follow.php";

class FollowController extends Follow
{
    public function getAllFollow()
    {
        return $this->getFollow();
    }
    public function following($from_id,$to_id)
    {
        return $this->follow($from_id,$to_id);
    }

    public function followingUser($from_id,$to_id)
    {
        return $this->followUser($from_id,$to_id);
    }

    public function deletefollow($id)
    {
        return $this->deletefollowing($id);
    }
    public function get_followers($user_id){
        return $this->take_followers($user_id);
    }
}


?>