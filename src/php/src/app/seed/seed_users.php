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
define('DB_HOST', 'tugas-besar-2-config-php-db-1');
define('DB_NAME', $_ENV['MYSQL_DATABASE']);
define('DB_USER', $_ENV['MYSQL_USER']);
define('DB_PASSWORD', $_ENV['MYSQL_PASSWORD']);
define('DB_PORT', 3306);

// Define accounts
$users = [];

$hobbies = ['Reading', 'Sports', 'Cooking', 'Gaming', 'Travel', 'Music'];
$interests = ['Technology', 'Art', 'Science', 'Fashion', 'Nature', 'Movies'];
$religions = ['Islam', 'Protestan', 'Buddha', 'Hindu', 'Katolik', 'Konghucu'];
$locations = ['Jakarta', 'Surabaya', 'Bandung', 'Yogyakarta', 'Medan', 'Bali'];
$loveLanguages = ['Words of Affirmation', 'Physical Touch', 'Quality Time', 'Receiving Gifts', 'Acts of Service'];
$mbtiTypes = ['ISTJ', 'ENFP', 'INTP', 'ESFJ', 'INFJ', 'ENTP'];
$zodiacSigns = ['Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo'];
$dislikes = ['Spiders', 'Snakes', 'Loud noise', 'Crowded places', 'Mushrooms', 'Darkness'];
$email = ['13521124@std.stei.itb.ac.id', '13521140@std.stei.itb.ac.id', '13521169@std.stei.itb.ac.id'];
$imageDirectory = __DIR__ . '/../../public/seed_profile_video/user_profile.webp';
$videoDirectory = __DIR__ . '/../../public/seed_profile_video/user_video.mp4';

for ($i = 1; $i <= 100; $i++) {
    $user = [
        'username' => "user{$i}_username",
        'password' => "user{$i}_password",
        'email' => $email[array_rand($email)],
        'fullName' => "User {$i}",
        'name' => 'User',
        'age' => rand(20, 40),
        'contact' => "user{$i}@example.com",
        'hobby' => $hobbies[array_rand($hobbies)],
        'interest' => $interests[array_rand($interests)],
        'tinggiBadan' => rand(150, 190),
        'agama' => $religions[array_rand($religions)],
        'domisili' => $locations[array_rand($locations)],
        'loveLanguage' => $loveLanguages[array_rand($loveLanguages)],
        'mbti' => $mbtiTypes[array_rand($mbtiTypes)],
        'zodiac' => $zodiacSigns[array_rand($zodiacSigns)],
        'ketidaksukaan' => $dislikes[array_rand($dislikes)],
        'imageFile' => file_get_contents($imageDirectory),
        'videoFile' => file_get_contents($videoDirectory),
        'gender' => $i <= 50 ? 'Laki-Laki' : 'Perempuan'
    ];

    $users[] = $user;
}

// Define function
function register($database, $username, $password, $email, $fullName, $name, $age, $contact, $hobby, $interest, $tinggiBadan, $agama, $domisili, $loveLanguage, $mbti, $zodiac, $ketidaksukaan, $imageFile, $videoFile, $gender)
    {
        $options = [
            'cost' => 10,
        ];

        // Check if user already exists
        $query = 'SELECT user_id FROM user WHERE (username = :username) LIMIT 1';
        $database->query($query);
        $database->bind('username', $username);
        $user = $database->fetch();
        if($user){
            throw new Exception('Username already exists', 409);
        }

        // Insert user data into the 'user' table
        $query = 'INSERT INTO user (username, password, email, role) VALUES (:username, :password, :email, :role)';
        $database->query($query);
        $database->bind('username', $username);
        $database->bind('password', password_hash($password, PASSWORD_DEFAULT, $options));
        $database->bind('email', $email);
        $database->bind('role', 'user');
        $database->execute();

        // Get the user_id of the newly inserted user
        $query = 'SELECT user_id FROM user WHERE (username = :username) LIMIT 1';
        $database->query($query);
        $database->bind('username', $username);
        $user = $database->fetch();
        $userId = $user->user_id;

        // Insert additional profile data into the 'profile' table
        if($videoFile){
            $query = 'INSERT INTO profile (user_id, nama_panggilan, nama_lengkap, umur, hobi, interest, tinggi_badan, agama, domisili, love_language, mbti, zodiak, ketidaksukaan, gambar_profile, video_perkenalan, gender) 
                VALUES (:user_id, :nama_panggilan, :nama_lengkap, :umur, :hobi, :interest, :tinggi_badan, :agama, :domisili, :love_language, :mbti, :zodiak, :ketidaksukaan, :gambar_profile, :video_perkenalan, :gender)';
        } else {
            $query = 'INSERT INTO profile (user_id, nama_panggilan, nama_lengkap, umur, hobi, interest, tinggi_badan, agama, domisili, love_language, mbti, zodiak, ketidaksukaan, gambar_profile, gender) 
                VALUES (:user_id, :nama_panggilan, :nama_lengkap, :umur, :hobi, :interest, :tinggi_badan, :agama, :domisili, :love_language, :mbti, :zodiak, :ketidaksukaan, :gambar_profile, :gender)';
        }
        $database->query($query);
        $database->bind('user_id', $userId);
        $database->bind('nama_panggilan', $name);
        $database->bind('nama_lengkap', $fullName);
        $database->bind('umur', $age);
        $database->bind('hobi', $hobby);
        $database->bind('interest', $interest);
        $database->bind('tinggi_badan', $tinggiBadan);
        $database->bind('agama', $agama);
        $database->bind('domisili', $domisili);
        $database->bind('love_language', $loveLanguage);
        $database->bind('mbti', $mbti);
        $database->bind('zodiak', $zodiac);
        $database->bind('ketidaksukaan', $ketidaksukaan);
        $database->bind('gender', $gender);

        // Handle file uploads (image and video) and move them to the desired location
        $imageUploadPath = $userId . '.jpg';
        $database->bind('gambar_profile', $imageUploadPath);
        file_put_contents(__DIR__ . '/../../public/images/profile/' . $imageUploadPath, $imageFile);
        if ($videoFile) {
            $videoUploadPath = $userId . '.mp4';
            $database->bind('video_perkenalan', $videoUploadPath);
            file_put_contents(__DIR__ . '/../../public/videos/' . $videoUploadPath, $videoFile);
        }
        $database->execute();

        // Insert contact data into the 'user_contact' table
        $query = 'INSERT INTO user_contact (user_id, contact_person) VALUES (:user_id, :contact_person)';
        $database->query($query);
        $database->bind('user_id', $userId);
        $database->bind('contact_person', $contact);
        $database->execute();
    }

// Seed admin account
try {
    // Construct DB
    $db = new Database(DB_PORT);

    foreach($users as $user){
        register($db, $user['username'], $user['password'], $user['email'], $user['fullName'], $user['name'], $user['age'], $user['contact'], $user['hobby'], $user['interest'], $user['tinggiBadan'], $user['agama'], $user['domisili'], $user['loveLanguage'], $user['mbti'], $user['zodiac'], $user['ketidaksukaan'], $user['imageFile'], $user['videoFile'], $user['gender']);
    }
} catch (PDOException) {
    // Database failed
    echo $e->getMessage();
}