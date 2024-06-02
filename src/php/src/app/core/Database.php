<?php

class Database
{
    private $db_connection;
    private $statement;

    public function __construct($port=3306)
    {
        if($port == 3306){
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";user=" . DB_USER . ";password=" . DB_PASSWORD;
        } else {
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";user=" . DB_USER . ";password=" . DB_PASSWORD;
        }

        try {
            $this->db_connection = new PDO($dsn);
        } catch (PDOException $e) {
            throw new Exception('Bad Gateway', 502);
        }

        try {
            $this->db_connection->exec(Tables::USER_TABLE);
            $this->db_connection->exec(Tables::PROFILE_TABLE);
            $this->db_connection->exec(Tables::USER_CONTACT_TABLE);
            $this->db_connection->exec(Tables::DATE_TABLE);
            $this->db_connection->exec(Tables::NOTIFICATION_TABLE);
        } catch (PDOException) {
            throw new Exception('Internal Server Error', 500);
        }
    }

    public function query($query)
    {
        try {
            $this->statement = $this->db_connection->prepare($query);
        } catch (PDOException) {
            throw new Exception('Internal Server Error', 500);
        }
    }

    public function bind($param, $value, $type = null)
    {
        try {
            if (is_null($type)) {
                if (is_int($value)) {
                    $type = PDO::PARAM_INT;
                } else if (is_bool($value)) {
                    $type = PDO::PARAM_BOOL;
                } else if (is_null($value)) {
                    $type = PDO::PARAM_NULL;
                } else {
                    $type = PDO::PARAM_STR;
                }
            }
            $this->statement->bindValue($param, $value, $type);
        } catch (PDOException) {
            throw new Exception('Internal Server Error', 500);
        }
    }

    public function execute()
    {
        try {
            $this->statement->execute();
        } catch (PDOException) {
            throw new Exception('Internal Server Error', 500);
        }
    }

    public function fetch()
    {
        try {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException) {
            throw new Exception('Internal Server Error', 500);
        }
    }

    public function fetchAll()
    {
        try {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException) {
            throw new Exception('Internal Server Error', 500);
        }
    }

    public function rowCount()
    {
        try {
            return $this->statement->rowCount();
        } catch (PDOException) {
            throw new Exception('Internal Server Error', 500);
        }
    }
}