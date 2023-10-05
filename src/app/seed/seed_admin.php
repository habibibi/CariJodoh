<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Tables.php';

$envFilePath = __DIR__ . '/../../../.env';

// Check if the .env file exists
if (file_exists($envFilePath)) {
    // Read the .env file line by line
    $lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Split each line into a key and value
        list($key, $value) = explode('=', $line, 2);

        // Trim whitespace and remove quotes from the value
        $key = trim($key);
        $value = trim($value, "\"'");

        // Set the environment variable if it's not already defined
        if (!isset($_ENV[$key])) {
            $_ENV[$key] = $value;
        }
    }
}

// Define DB Constants
define('DB_HOST', 'tugas-besar-1-mysql-1');
define('DB_NAME', $_ENV['MYSQL_DATABASE']);
define('DB_USER', $_ENV['MYSQL_USER']);
define('DB_PASSWORD', $_ENV['MYSQL_PASSWORD']);
define('DB_PORT', 3306);
define('ADMIN_PASSWORD', $_ENV['ADMIN_PASSWORD']);

// Seed admin account
try {
    // Construct DB
    $db = new Database(DB_PORT);

    // Define options
    $options = [
        'cost' => 10,
    ];

    // Check if the admin account already exists
    $db->query("SELECT user_id FROM user WHERE username = :username LIMIT 1");
    $db->bind(':username', 'admin');
    $result = $db->fetch();

    // If admin account doesn't exists
    if(!$result){
        $db->query("INSERT INTO user (username, password, role) VALUES (:username, :password, :role)");
        $db->bind(':username', 'admin');
        $db->bind(':password', password_hash(ADMIN_PASSWORD, PASSWORD_DEFAULT, $options));
        $db->bind(':role', 'admin');
        $db->execute();
    }
} catch (PDOException $e) {
    // Database failed
    echo $e->getMessage();
}