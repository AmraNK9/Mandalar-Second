<?php
include_once __DIR__ . "/../vendor/db.php";

class Post
{
    private $connection = "";
    public function add_new_post($id, $name, $brand, $options, $post_subcategory, $price, $text_area, $imageFolder, $status)
    {
        // 1. Database Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. SQL Statement
        $sql = "INSERT INTO `post`(`seller_id`,  `sub_category_id`, `item`, `brand`, `photo_folder`, `price`, `description`, `new_used`,`status`) VALUES 
    (:seller_id, :sub_category_id, :item, :brand, :photo_folder, :price, :description, :new_used, :status)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":seller_id", $id);
        $statement->bindParam(":sub_category_id", $post_subcategory);
        $statement->bindParam(":item", $name);
        $statement->bindParam(":brand", $brand);
        $statement->bindParam(":photo_folder", $imageFolder);
        $statement->bindParam(":price", $price);
        $statement->bindParam(":description", $text_area);
        $statement->bindParam(":new_used", $options);
        $statement->bindParam(":status", $status);

        // 3. Execute
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllPost()
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql = "SELECT post.*,users.fname,users.lname,users.img as user_img FROM `post` join users on post.seller_id=users.user_id ORDER BY post.post_date DESC";
        $statement = $this->connection->prepare($sql);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //get All Categories
    public function getAllCategory()
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql = "select * from category";
        $statement = $this->connection->prepare($sql);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getAllSubCategory($id)

    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql = "select * from sub_category where category_id=:id";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":id", $id);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getPostByFlitter($filtering_Data)
    {
        $filteringData = get_object_vars($filtering_Data);
        try {
            $this->connection = Database::connect();
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Extract values from $filteringData
            $minPrice = $filteringData['min-price'];
            $maxPrice = $filteringData['max-price'];
            $newUsed = $filteringData['new-used'];
            $category = $filteringData['category'];
            $subCategory = $filteringData['subCategory'];
    
            // Initialize SQL query and parameters
            $sql = 'SELECT post.*, users.*
                    FROM post
                    JOIN users ON post.seller_id = users.user_id
                    JOIN sub_category ON post.sub_category_id = sub_category.id
                    JOIN category ON sub_category.category_id = category.id
                    WHERE 1'; // Start with a basic condition
    
            $params = array();
    
            if ($minPrice !== null && $maxPrice !== null) {
                $sql .= ' AND price BETWEEN :minPrice AND :maxPrice';
                $params['minPrice'] = $minPrice;
                $params['maxPrice'] = $maxPrice;
            }
    
            if ($newUsed !== null) {
                if ($newUsed == 'All') {
                    $sql .= ' AND (new_used = "used" OR new_used = "new")';
                } else {
                    $sql .= ' AND new_used = :newUsed';
                    $params['newUsed'] = $newUsed;
                }
            }
    
            if ($category !== null) {
                $sql .= ' AND category.id = :category';
                $params['category'] = $category;
            }
            if ($subCategory !== null && $subCategory !== 'All') {
                $sql .= ' AND sub_category_id = :subCategory';
                $params['subCategory'] = $subCategory;
            }
    
            $statement = $this->connection->prepare($sql);
            $statement->execute($params);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle database errors here
            return [];
        }
    }
    
    public function getPostById($id)
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql = "SELECT post.*,users.fname,users.lname,users.img as user_img,category.name as cate_name,sub_category.name as sub_name FROM `post` join users on post.seller_id=users.user_id join sub_category on sub_category.id=post.sub_category_id join category on sub_category.category_id=category.id where post.id=:id";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":id", $id);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function takeFreezeMoney($id)
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql = "SELECT * FROM `post` WHERE buyer_id=:id AND status != 'sold_out'";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":id", $id);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // buyer update post
    public function newBuyer($user_id, $buyer_info_id, $status, $post_id, $buy_date)
    {
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE post SET  buyer_id = :buyer_id, buyer_info_id = :buyer_info_id, status=:status,buy_date=:buy_date WHERE id=:id
        ";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":buyer_id", $user_id);
        $statement->bindParam(":buyer_info_id", $buyer_info_id);
        $statement->bindParam(":status", $status);
        $statement->bindParam(":id", $post_id);
        $statement->bindParam(":buy_date", $buy_date);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostReaction($PostId)
    {
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT COUNT(*) as count_react FROM `post_react` WHERE post_id = :post_id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":post_id", $PostId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getPostFavorite($PostId)
    {
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT COUNT(*) as count_favorite FROM `favorite` WHERE post_id = :post_id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":post_id", $PostId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    // seller update post
    public function newSeller($seller_info_id, $status, $post_id,)
    {
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE post SET   seller_info_id = :seller_info_id, status=:status WHERE id=:id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":seller_info_id", $seller_info_id);
        $statement->bindParam(":status", $status);
        $statement->bindParam(":id", $post_id);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // favorite
    public function favoritePostListById($user_id)
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql = "SELECT favorite.*, post.*,users.fname,users.lname,users.img as user_img FROM `favorite` join post on post.id=favorite.post_id join users on users.user_id=post.seller_id WHERE favorite.user_id=:user_id ORDER BY post.post_date DESC";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":user_id", $user_id);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getSellerPostById($user_id)
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql = "SELECT * FROM `post` WHERE seller_id=:user_id and status='seller_waiting' limit 1";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":user_id", $user_id);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getPostByCityId($seller_city_id, $buyer_city_id, $selectedStatus)
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql = "SELECT post.*,seller_city.name as seller_city,buyer_city.name as buyer_city
        FROM `post`
        JOIN user_info AS seller_info ON post.seller_info_id = seller_info.id
        join city as seller_city on seller_city.id=seller_info.city_id
        JOIN user_info AS buyer_info ON post.buyer_info_id = buyer_info.id
        JOIN city as buyer_city on buyer_city.id=buyer_info.city_id
        where seller_info.city_id=:seller_city_id and buyer_info.city_id=:buyer_city_id and post.status=:selectedStatus order by post.id desc";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":seller_city_id", $seller_city_id);
        $statement->bindParam(":buyer_city_id", $buyer_city_id);
        $statement->bindParam(":selectedStatus", $selectedStatus);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function deli_command_by_admin($stats, $check)
    {
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE post SET status=:stats WHERE id=:check
        ";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":stats", $stats);
        $statement->bindParam(":check", $check);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function takePost($deli_id)
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql = 'SELECT post.*
        FROM wave
        LEFT JOIN post ON wave.post_id = post.id
        WHERE wave.delivery_id = :deli_id AND (post.status = "take_waiting" OR post.status = "go_take")';
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":deli_id", $deli_id);
        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function sendPost($deli_id)
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql='SELECT post.*
        FROM wave
        LEFT JOIN post ON wave.post_id = post.id
        WHERE wave.delivery_id = :deli_id AND (post.status="send_waiting" or post.status="go_send")';
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":deli_id", $deli_id);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function get_deli_post_by_id($post_id)
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql = 'SELECT post.*,seller.fname as seller_fname,seller.lname as seller_lname,buyer.fname as buyer_fname,buyer.lname as buyer_lname,seller_info.address as seller_address,buyer_info.address as buyer_address,seller_city.name as seller_city,buyer_city.name as buyer_city FROM `post` join users as seller on seller.user_id=post.seller_id join users as buyer on buyer.user_id=post.buyer_id 
        join user_info as seller_info on seller_info.id=post.seller_info_id join user_info as buyer_info on buyer_info.id=post.buyer_info_id join city as seller_city on seller_city.id=seller_info.city_id join city as buyer_city on buyer_city.id=buyer_info.city_id where post.id=:post_id';
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":post_id", $post_id);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function deli_status_update_by_btn($status, $post_id)
    {
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE post SET status=:status WHERE id=:post_id
        ";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":status", $status);
        $statement->bindParam(":post_id", $post_id);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    

    public function searchPostList($searchinput)
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $sql = "SELECT * FROM `post` WHERE description name like ";
        // $statement = $this->connection->prepare($sql);

        // $sql = "SELECT  post.*,users.full_name,users.img from post join users on post.seller_id=users.user_id  WHERE REPLACE(description, ' ', '') LIKE :description";
        // $statement = $this->connection->prepare($sql);

        // $searchInputWithoutSpaces = str_replace(' ', '', $searchinput);
        // $params = '%' . $searchInputWithoutSpaces . '%';
        // $statement->bindParam(":description", $params);

        // //3.execute
        // $statement->execute();
        // $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        // return $result;
        $sql = "SELECT post.*,users.full_name,users.img as user_img FROM post join users WHERE post.status!='sold_out' and REPLACE(post.description, ' ', '') LIKE :description";
        $statement = $this->connection->prepare($sql);
        
        $searchValueWithoutSpaces = str_replace(' ', '', $searchinput);
        $param = '%' . $searchValueWithoutSpaces . '%';
        $statement->bindParam(":description", $param);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function create_view_count($post_id, $user_id)
    {
        // 1. Database Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. SQL Statement
        $sql = "INSERT INTO `view_count`(`user_id`, `post_id`) VALUES (:user_id,:post_id)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":user_id", $user_id);
        $statement->bindParam(":post_id", $post_id);

        // 3. Execute
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function load_max_price(){
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT MIN(post.price) as minPrice,MAX(post.price) as maxPrice FROM `post` ";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function load_min_max_price($id)
    {
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT MIN(post.price) as minPrice,MAX(post.price) as maxPrice FROM `post` WHERE sub_category_id = :id
        ";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function load_min_max_Price_with_category($id){
         $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
        SELECT MAX(post.price) as maxPrice FROM post 
        JOIN sub_category ON post.sub_category_id = sub_category.id 
        JOIN category ON sub_category.category_id = category.id 
        WHERE category.id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function take_post_id($id, $name, $brand, $options, $post_subcategory, $price, $text_area, $imageFolder, $status){
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql = "SELECT * from post where seller_id=:seller_id and sub_category_id=:sub_category_id and item=:item and brand=:brand
        and photo_folder=:photo_folder and price=:price and description=:description and new_used=:new_used and status=:status";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":seller_id", $id);
        $statement->bindParam(":sub_category_id", $post_subcategory);
        $statement->bindParam(":item", $name);
        $statement->bindParam(":brand", $brand);
        $statement->bindParam(":photo_folder", $imageFolder);
        $statement->bindParam(":price", $price);
        $statement->bindParam(":description", $text_area);
        $statement->bindParam(":new_used", $options);
        $statement->bindParam(":status", $status);
        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function selectViewCount($postId){
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT COUNT(*) as view_count FROM `view_count` WHERE post_id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $postId);
      
        //3.execute
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }


    public function sold_out_post($id){
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// SELECT post.*,users.fname,users.lname,users.img as user_img FROM `post` join users on post.seller_id=users.user_id ORDER BY post.post_date DESC
        // $sql = "SELECT * FROM `post` WHERE post.status='sold_out' AND seller_id=:seller_id";
        $sql="SELECT post.*,users.fname,users.lname,users.img as user_img FROM `post` JOIN users on users.user_id=post.seller_id WHERE post.status='sold_out' AND post.seller_id =:seller_id  ORDER BY post.post_date DESC";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":seller_id", $id);
        // 3. Execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function buy_post($user_id){
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// SELECT post.*,users.fname,users.lname,users.img as user_img FROM `post` join users on post.seller_id=users.user_id ORDER BY post.post_date DESC
        // $sql = "SELECT * FROM `post` WHERE post.status='sold_out' AND seller_id=:seller_id";
        $sql="SELECT post.*,users.fname,users.lname,users.img as user_img FROM `post` JOIN users on users.user_id=post.seller_id WHERE post.status!='sold_out' AND post.status !='none' AND post.buyer_id =:buyer_id  ORDER BY post.post_date DESC";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":buyer_id", $user_id);
        // 3. Execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // public function postDec($searchinput)
    // {
    //     //1.DataBase Connect
    //     $this->connection=Database::connect();
    //     $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     //2.sql Statement
    //     // $searchValue = str_replace(' ', '', $searchValue);
    //     $sql = "SELECT * FROM post WHERE status!='sold_out' and REPLACE(description, ' ', '') LIKE :description";
    //     $statement = $this->connection->prepare($sql);
        
    //     $searchValueWithoutSpaces = str_replace(' ', '', $searchinput);
    //     $param = '%' . $searchValueWithoutSpaces . '%';
    //     $statement->bindParam(":description", $param);

    //     //3.execute
    //     $statement->execute();
    //     $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    public function search_Brand_Post($searchinput)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        // $searchValue = str_replace(' ', '', $searchValue);
        $sql = "SELECT post.*,users.full_name,users.img as user_img FROM post join users WHERE REPLACE(post.brand, ' ', '') LIKE :brand";
        $statement = $this->connection->prepare($sql);
        
        $searchValueWithoutSpaces = str_replace(' ', '', $searchinput);
        $param = '%' . $searchValueWithoutSpaces . '%';
        $statement->bindParam(":brand", $param);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getList($user_id)
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql = "SELECT post.*,users.full_name,users.img as user_img FROM post join users  ON post.seller_id = users.user_id where post.status='none' AND seller_id=:seller_id;";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":seller_id", $user_id);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function SoldOutPost($userid)
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql = "SELECT post.*,users.full_name,users.img as user_img FROM post join users  ON post.seller_id = users.user_id where post.status='sold_out' AND seller_id=:seller_id;";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":seller_id", $userid);

        //3.execute
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}