<?php

class DateMiddleware
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function isDating($anotherId)
    { 
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('Unauthorized', 401);
        }
        $query = 'SELECT date_id FROM date WHERE (user_id_1 = :user_id) AND (user_id_2 = :another_id) OR (user_id_2 = :user_id) AND (user_id_1 = :another_id)';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);
        $this->database->bind('another_id', $anotherId);

        $date = $this->database->fetch();

        if (!$date) {
            throw new Exception('Unauthorized', 401);
        }

        return true;
    }
}