<?php
include_once __DIR__."/../model/follow.php";

class NotiController extends follow
{
    public function getNoti($to_id)
    {
        return $this->noti($to_id);

    }

    public function update_read($id)
    {
        return $this->Up_read($id);
    }
}
?>