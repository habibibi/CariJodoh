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

    public function register_admin($username, $password)
    {   
        $query = 'INSERT INTO user (username, password, role) VALUES (:username, :password, :role)';
        $options = [
            'cost' => 10,
        ];
        $this->database->query($query);
        $this->database->bind('username', $username);
        $this->database->bind('password', password_hash($password, PASSWORD_DEFAULT, $options));
        $this->database->bind('role', 'admin');

        $this->database->execute();
    }

    public function register($username, $password, $fullName, $name, $age, $contact, $hobby, $interest, $tinggiBadan, $agama, $domisili, $loveLanguage, $mbti, $zodiac, $ketidaksukaan, $imageFile, $videoFile, $gender)
    {
        $options = [
            'cost' => 10,
        ];

        // Check if user already exists
        $query = 'SELECT user_id FROM user WHERE username = :username LIMIT 1';
        $this->database->query($query);
        $this->database->bind('username', $username);
        $user = $this->database->fetch();
        if($user){
            throw new Exception('Username already exists', 409);
        }

        // Insert user data into the 'user' table
        $query = 'INSERT INTO user (username, password, role) VALUES (:username, :password, :role)';
        $this->database->query($query);
        $this->database->bind('username', $username);
        $this->database->bind('password', password_hash($password, PASSWORD_DEFAULT, $options));
        $this->database->bind('role', 'user');
        $this->database->execute();

        // Get the user_id of the newly inserted user
        $query = 'SELECT user_id FROM user WHERE username = :username LIMIT 1';
        $this->database->query($query);
        $this->database->bind('username', $username);
        $user = $this->database->fetch();
        $userId = $user->user_id;

        // Insert additional profile data into the 'profile' table
        $query = 'INSERT INTO profile (user_id, nama_panggilan, nama_lengkap, umur, hobi, interest, tinggi_badan, agama, domisili, love_language, mbti, zodiak, ketidaksukaan, gambar_profile, video_perkenalan, gender) 
                VALUES (:user_id, :nama_panggilan, :nama_lengkap, :umur, :hobi, :interest, :tinggi_badan, :agama, :domisili, :love_language, :mbti, :zodiak, :ketidaksukaan, :gambar_profile, :video_perkenalan, :gender)';
        $this->database->query($query);
        $this->database->bind('user_id', $userId);
        $this->database->bind('nama_panggilan', $name);
        $this->database->bind('nama_lengkap', $fullName);
        $this->database->bind('umur', $age);
        $this->database->bind('hobi', $hobby);
        $this->database->bind('interest', $interest);
        $this->database->bind('tinggi_badan', $tinggiBadan);
        $this->database->bind('agama', $agama);
        $this->database->bind('domisili', $domisili);
        $this->database->bind('love_language', $loveLanguage);
        $this->database->bind('mbti', $mbti);
        $this->database->bind('zodiak', $zodiac);
        $this->database->bind('ketidaksukaan', $ketidaksukaan);
        $this->database->bind('gender', $gender);

        // Handle file uploads (image and video) and move them to the desired location
        $imageUploadPath = $userId . '.jpg';
        $this->database->bind('gambar_profile', $imageUploadPath);
        move_uploaded_file($imageFile['tmp_name'], __DIR__ . '/../../public/images/profile/' . $imageUploadPath);
        if ($videoFile) {
            $videoUploadPath = $userId . '.mp4';
            $this->database->bind('video_perkenalan', $videoUploadPath);
            move_uploaded_file($videoFile['tmp_name'], __DIR__ . '/../../public/videos/' . $videoUploadPath);
        }
        $this->database->execute();

        // Insert contact data into the 'user_contact' table
        $query = 'INSERT INTO user_contact (user_id, contact_person) VALUES (:user_id, :contact_person)';
        $this->database->query($query);
        $this->database->bind('user_id', $userId);
        $this->database->bind('contact_person', $contact);
        $this->database->execute();

        // Return the user_id of the registered user
        return $userId;
    }
}