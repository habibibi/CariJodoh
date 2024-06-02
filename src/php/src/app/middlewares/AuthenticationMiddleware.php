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
        // Check using API KEY
        if(isset($_GET['api_key'])) {
            if($_GET['api_key'] == API_KEY){
                return true;
            } else {
                return false;
            }
        }

        if (!isset($_SESSION['user_id'])) {
            return false;
        }

        $query = 'SELECT user_id FROM user WHERE (user_id = :user_id) LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if (!$user) {
            return false;
        }

        return true;
    }

    public function checkAdmin()
    {
        // Check using API KEY
        if(isset($_GET['api_key'])) {
            if($_GET['api_key'] == API_KEY){
                return true;
            } else {
                return false;
            }
        }

        if (!isset($_SESSION['user_id'])) {
            return false;
        }

        $query = 'SELECT role FROM user WHERE (user_id = :user_id) LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if ($user->role != "admin") {
            return false;
        }

        return true;
    }

    public function isAuthenticated()
    {
        // Check using API KEY
        if(isset($_GET['api_key'])) {
            if($_GET['api_key'] == API_KEY){
                return true;
            } else {
                throw new Exception('Unauthorized', 401);
            }
        }

        if (!isset($_SESSION['user_id'])) {
            throw new Exception('Unauthorized', 401);
        }

        $query = 'SELECT user_id FROM user WHERE (user_id = :user_id) LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if (!$user) {
            throw new Exception('Unauthorized', 401);
        }

        return true;
    }

    public function isAdmin()
    {
        // Check using API KEY
        if(isset($_GET['api_key'])) {
            if($_GET['api_key'] == API_KEY){
                return true;
            } else {
                throw new Exception('Unauthorized', 401);
            }
        }

        if (!isset($_SESSION['user_id'])) {
            throw new Exception('Unauthorized', 401);
        }

        $query = 'SELECT role FROM user WHERE (user_id = :user_id) LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if ($user->role != "admin") {
            throw new Exception('Unauthorized', 401);
        }

        return true;
    }
}