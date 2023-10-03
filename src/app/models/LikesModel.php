<?php

class LikesModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getLikes($page = 1){
        // Define query
        $query = 'SELECT * FROM date LIMIT :limit OFFSET :offset';
        $this->database->query($query);
        $this->database->bind('limit', 6);
        $this->database->bind('offset', ($page - 1) * 6);

        // Get result
        $result_query = $this->database->fetchAll();
        $pages_count = $this->getPagesCount();
        $result = ["data" => $result_query, "pages" => $pages_count];

        return $result;
    }

    public function getLikesByUserId($userId, $page = 1){
        // Define query
        $query = 'SELECT * FROM date WHERE (user_id_1 = :userId) LIMIT :limit OFFSET :offset';
        $this->database->query($query);
        $this->database->bind('limit', 6);
        $this->database->bind('offset', ($page - 1) * 6);
        $this->database->bind('userId', $userId);

        // Get result
        $result_query = $this->database->fetchAll();
        $pages_count = $this->getPagesCount($userId);
        $result = ["data" => $result_query, "pages" => $pages_count];

        return $result;
    }

    public function addLike($userId1, $userId2){
        // Define the INSERT query
        $query = 'INSERT INTO date (user_id_1, user_id_2) VALUES (:userId1, :userId2)';
        
        // Bind parameters and execute the query
        $this->database->query($query);
        $this->database->bind('userId1', $userId1);
        $this->database->bind('userId2', $userId2);
        
        // Execute the query
        $this->database->execute();
    }

    public function getPagesCount($userId=null){
        if($userId != null){
            // Define query
            $query = 'SELECT COUNT(*) AS count FROM date WHERE (user_id_1 = :userId)';
            $this->database->query($query);
            $this->database->bind('userId', $userId);

            // Get result
            $result_query = $this->database->fetch();
            $pages_count = ceil($result_query->count / 6);

            return $pages_count;
        } else {
            // Define query
            $query = 'SELECT COUNT(*) AS count FROM date';
            $this->database->query($query);

            // Get result
            $result_query = $this->database->fetch();
            $pages_count = ceil($result_query->count / 6);

            return $pages_count;
        }
    }

    public function deleteLike($dateId){
        // Define query
        $query = 'DELETE FROM date WHERE date_id = :dateId';

        // Execute delete
        $this->database->query($query);
        $this->database->bind('dateId', $dateId);
        $this->database->execute();
    }

    public function updateLike($dateId, $userId1, $userId2){
        // Define the UPDATE query
        $query = 'UPDATE date 
                SET user_id_1 = :userId1, 
                    user_id_2 = :userId2, 
                WHERE date_id = :dateId';
        
        // Bind parameters and execute the query
        $this->database->query($query);
        $this->database->bind('userId1', $userId1);
        $this->database->bind('userId2', $userId2);
        $this->database->bind('dateId', $dateId);

        // Execute the query
        $this->database->execute();
    }
}