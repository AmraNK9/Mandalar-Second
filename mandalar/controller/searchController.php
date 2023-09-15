<?php 
include_once __DIR__."/../model/search.php";
class SearchController extends Search{

    public function searchAllUser($searchValue)
    {
        return $this->searchUser($searchValue);
    }

    

    

}



?>