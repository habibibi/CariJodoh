<?php

class AuthenticationMiddleware
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function isAuthenticated()
    {
        if (!isset($_SESSION['profile_id'])) {
            throw new Exception('Unauthorized', 401);
        }

        $query = 'SELECT profile_id FROM profile WHERE profile_id = :profile_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('profile_id', $_SESSION['profile_id']);

        $profile = $this->database->fetch();

        if (!$profile) {
            throw new Exception('Unauthorized', 401);
        }
    }

    public function isAdmin()
    {
        if (!isset($_SESSION['profile_id'])) {
            throw new Exception('Unauthorized', 401);
        }

        $query = 'SELECT role FROM profile WHERE profile_id = :profile_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('profile_id', $_SESSION['profile_id']);

        $profile = $this->database->fetch();

        if ($profile->role != "admin") {
            throw new Exception('Unauthorized', 401);
        }
    }
}