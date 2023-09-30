<?php

class UserModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function login($username, $password)
    {
        $query = 'SELECT user_id, password FROM user WHERE username = :username LIMIT 1';

        $this->database->query($query);
        $this->database->bind('username', $username);

        $user = $this->database->fetch();

        if ($user && password_verify($password, $user->password)) {
            return $user->user_id;
        } else {
            throw new Exception('Unauthorized', 401);
        }
    }

    public function register($username, $password)
    {
        $query = 'INSERT INTO user (username, password, role) VALUES (:username, :password, :role)';

        $this->database->query($query);
        $this->database->bind('username', $username);
        $this->database->bind('password', password_hash($password, PASSWORD_DEFAULT));
        $this->database->bind('role', 'user');

        $this->database->execute();
    }
}