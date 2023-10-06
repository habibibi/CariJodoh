<?php

class GenderMiddleware
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function isDifferentGender($userId)
    {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('Unauthorized', 401);
        }

        $query1 = 'SELECT gender FROM profile WHERE (user_id = :user_id) LIMIT 1';

        $this->database->query($query1);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user1 = $this->database->fetch();

        if (!$user1) {
            throw new Exception('Unauthorized', 401);
        }

        $query2 = 'SELECT gender FROM profile WHERE (user_id = :user_id) LIMIT 1';

        $this->database->query($query2);
        $this->database->bind('user_id', $userId);

        $user2 = $this->database->fetch();

        if (!$user2) {
            throw new Exception('Not Found', 404);
        }

        if($user1->gender == $user2->gender){
            throw new Exception('Unauthorized', 401);
        }

        return true;
    }
}