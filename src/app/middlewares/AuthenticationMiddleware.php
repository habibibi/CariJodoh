<?php

class AuthenticationMiddleware
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function checkAuthenticated()
    {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }

        $query = 'SELECT user_id FROM user WHERE user_id = :user_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if (!$user) {
            return false;
        }

        return true;
    }

    public function isAuthenticated()
    {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('Unauthorized', 401);
        }

        $query = 'SELECT user_id FROM user WHERE user_id = :user_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if (!$user) {
            throw new Exception('Unauthorized', 401);
        }
    }

    public function isAdmin()
    {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('Unauthorized', 401);
        }

        $query = 'SELECT role FROM user WHERE user_id = :user_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if ($user->role != "admin") {
            throw new Exception('Unauthorized', 401);
        }
    }
}