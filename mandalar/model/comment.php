<?php
include_once __DIR__ . "/../vendor/db.php";

class Comment
{
    private $connection = "";
    private $table = '';
    function __construct()
    {
        //1.DataBase Connect
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->table = 'comment';
    }
    function createComment($postId, $userId, $content, $ParentcommentId)
    {
        $sql = "INSERT INTO 
        `$this->table`( `post_id`, `user_id`, `content`, `parent_com_id`)
         VALUES (:post_id, :user_id , :content, :parent_cm_id )";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':post_id', $postId);
        $statement->bindParam(':user_id', $userId);
        $statement->bindParam(':content', $content);
        $statement->bindParam(':parent_cm_id', $ParentcommentId);
        if ($statement->execute()) {
            echo "Comment Created Successfully";
        } else {
            echo "Comment Created Err";
        }
    }

    function loadCommentByPostId($postId)
    {
        $sql = 'SELECT comment.date, comment.content,comment.id ,comment.parent_com_id, CONCAT(users.fname,users.lname) As name,users.img , users.user_id FROM `comment` JOIN users WHERE post_id = :post_id and parent_com_id = 0 and comment.user_id = users.user_id;'  ;
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':post_id', $postId);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            $error = array('error' => 'sql Statement Error');
            return $error;
        }
    }

    function loadCommentByParentCommentId($parentCommentId)
    {
        $sql = 'SELECT comment.date,comment.content,comment.id ,comment.parent_com_id , CONCAT(users.fname,users.lname) As name,users.img, users.user_id FROM `comment` JOIN users WHERE parent_com_id = :parent_com_id and  comment.user_id = users.user_id;';
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':parent_com_id', $parentCommentId);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            $error = array('error' => 'sql Statement Error');
            return $error;
        }
    }

    function deleteCommentById($id){
        $sql = 'delete FROM comment where id = :id';
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            $error = array('error' => 'sql Statement Error');
            return $error;
        }

    }

    function EditCommentById($id,$content){
        $sql = "UPDATE `comment` SET `content`=:content WHERE id = :id;
        ";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':content',$content);
        if ($statement->execute()) {
            return $id;
        } else {
            $error = array('error' => 'sql Statement Error');
            return $error;
        }

    }

    public function getUserIdByParentId($id)
    {
         //1.DataBase Connect
         $this->connection=Database::connect();
         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
         //2.sql Statement
         $sql="SELECT * FROM `comment` WHERE id=:id";
         $statement=$this->connection->prepare($sql);
         $statement->bindParam(':id', $id);
 
         //3.execute
         $statement->execute();
         $result=$statement->fetchAll(PDO::FETCH_ASSOC);
         return $result;
    }

    

}