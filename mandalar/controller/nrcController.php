<?php
include_once __DIR__."/../model/nrc.php";

class NrcController extends NRC{
    public function enterNrc($userid,$nrcNumber,$frontfilename,$backfilename){
        return $this->Nrc($userid,$nrcNumber,$frontfilename,$backfilename);
    }

    public function getAll()
    {
        return $this->getNrcUser();
    }

    public function updateNrc($userid)
    {
        return $this->updateNrcStatus($userid);
    }

    public function deleteNrc($to_id)
    {
        return $this->deleteuserNRC($to_id);
    }

    
}

?>