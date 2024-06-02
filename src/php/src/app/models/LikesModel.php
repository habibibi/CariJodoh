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
        $query = '
            SELECT date.user_id_2, profile.nama_lengkap, user_contact.contact_person  
            FROM date
            JOIN profile on date.user_id_2 = profile.user_id
            JOIN user_contact on user_contact.user_id = date.user_id_2
            WHERE (date.user_id_1 = :userId) 
            LIMIT :limit OFFSET :offset
        ';
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
        // Check conflict
        if($this->checkConflict($userId1, $userId2) || $userId1 == $userId2) {
            throw new Exception('Conflict', 409);
        }

        // Define the INSERT query
        $query = 'INSERT INTO date (user_id_1, user_id_2) VALUES (:userId1, :userId2); INSERT INTO date (user_id_1, user_id_2) VALUES (:userId2, :userId1)';
        
        // Bind parameters and execute the query
        $this->database->query($query);
        $this->database->bind('userId1', $userId1);
        $this->database->bind('userId2', $userId2);
        
        // Execute the query
        $this->database->execute();

        return $this->getPagesCount();
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
        $query = 'SELECT * from date WHERE (date_id = :dateId)';

        // Execute delete
        $this->database->query($query);
        $this->database->bind('dateId', $dateId);
        $result = $this->database->fetch();

        // Delete likes
        // Define query
        $query = 'DELETE from date WHERE (user_id_1 = :user_id_1) AND (user_id_2 = :user_id_2)';

        // Execute delete
        $this->database->query($query);
        $this->database->bind('user_id_1', $result->user_id_1);
        $this->database->bind('user_id_2', $result->user_id_2);
        $this->database->execute();

        // Execute delete
        $this->database->query($query);
        $this->database->bind('user_id_1', $result->user_id_2);
        $this->database->bind('user_id_2', $result->user_id_1);
        $this->database->execute();
    }

    public function updateLike($dateId, $userId1, $userId2){
        // Check conflict
        if($this->checkConflict($userId1, $userId2) || $userId1 == $userId2) {
            throw new Exception('Conflict', 409);
        }
        
        // Get current data
        $query = 'SELECT * FROM date WHERE (date_id = :dateId)';
        
        // Bind parameters and execute the query
        $this->database->query($query);
        $this->database->bind('dateId', $dateId);

        // Execute the query
        $result = $this->database->fetch();

        // Define the UPDATE query
        $query = 'UPDATE date 
                SET user_id_1 = :userId1, 
                    user_id_2 = :userId2 
                WHERE (date_id = :dateId)';
        
        // Bind parameters and execute the query
        $this->database->query($query);
        $this->database->bind('userId1', $userId1);
        $this->database->bind('userId2', $userId2);
        $this->database->bind('dateId', $dateId);

        // Execute the query
        $this->database->execute();

        if(!$this->checkConflict($userId2, $userId1)) {
            // Define the INSERT query
            $query = 'INSERT INTO date (user_id_1, user_id_2) VALUES (:userId1, :userId2)';
            
            // Bind parameters and execute the query
            $this->database->query($query);
            $this->database->bind('userId1', $userId2);
            $this->database->bind('userId2', $userId1);
            $this->database->execute();
        }

        // Define the DELETE QUERY
        $query = 'DELETE from date WHERE (user_id_1 = :user_id_1) AND (user_id_2 = :user_id_2)';

        // Execute delete
        $this->database->query($query);
        $this->database->bind('user_id_1', $result->user_id_2);
        $this->database->bind('user_id_2', $result->user_id_1);
        $this->database->execute();
    }

    public function checkConflict($userId1, $userId2){
        // Define query
        $query = 'SELECT * FROM date WHERE (user_id_1 = :userId1) AND (user_id_2 = :userId2)';
        $this->database->query($query);
        $this->database->bind('userId1', $userId1);
        $this->database->bind('userId2', $userId2);

        // Get result
        $result = $this->database->fetch();

        if($result){
            return true;
        } else {
            return false;
        }
    }
}