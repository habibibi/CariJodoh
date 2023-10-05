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
        if($videoFile){
            $query = 'INSERT INTO profile (user_id, nama_panggilan, nama_lengkap, umur, hobi, interest, tinggi_badan, agama, domisili, love_language, mbti, zodiak, ketidaksukaan, gambar_profile, video_perkenalan, gender) 
                VALUES (:user_id, :nama_panggilan, :nama_lengkap, :umur, :hobi, :interest, :tinggi_badan, :agama, :domisili, :love_language, :mbti, :zodiak, :ketidaksukaan, :gambar_profile, :video_perkenalan, :gender)';
        } else {
            $query = 'INSERT INTO profile (user_id, nama_panggilan, nama_lengkap, umur, hobi, interest, tinggi_badan, agama, domisili, love_language, mbti, zodiak, ketidaksukaan, gambar_profile, gender) 
                VALUES (:user_id, :nama_panggilan, :nama_lengkap, :umur, :hobi, :interest, :tinggi_badan, :agama, :domisili, :love_language, :mbti, :zodiak, :ketidaksukaan, :gambar_profile, :gender)';
        }
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

    public function getProfile($userId) {
        $query = "
            SELECT * FROM profile
            WHERE user_id = :user_id
        ";

        $this->database->query($query);
        $this->database->bind('user_id', $userId);
        $profile = $this->database->fetch();

        return $profile;
    }

    public function getProfiles($page = 1, $exclude_userid=null, $name=null, $interest=null, $agama=null, $mbti=null, $sortAttr='nama_lengkap', $isDesc=false)
    {
        $query = "
        SELECT user_id, gambar_profile, nama_lengkap, domisili, hobi, interest, umur, tinggi_badan, agama, mbti 
        FROM profile
        ";
        $cond = array();
        if ($exclude_userid) {
            array_push($cond," user_id != :userid");
        }
        if ($name) {
            array_push($cond," nama_lengkap LIKE :name");
        }
        if ($interest) {
            array_push($cond," interest LIKE :interest");
        }
        if ($agama) {
            array_push($cond," agama = :agama");
        }
        if ($mbti) {
            array_push($cond," mbti = :mbti");
        }

        if ($exclude_userid) {
            $queryGender = "SELECT gender from profile WHERE user_id = :userid";
            $this->database->query($queryGender);
            $this->database->bind('userid', $exclude_userid);
            $gender = $this->database->fetch()->gender;
            array_push($cond, " gender != '". $gender . "'");
        }

        if (count($cond) > 0) {
            $query .= " WHERE";
            $query .= implode(" AND",$cond);
        }

        $query .= " ORDER BY " . $sortAttr;

        if ($isDesc && $isDesc == "true") {
            $query .= " DESC";
        } else {
            $query .= " ASC";
        }
        $query .= " LIMIT 6 OFFSET :offset";
        
        $this->database->query($query);

        if ($exclude_userid) {
            $this->database->bind('userid', $exclude_userid);
        }
        if ($name) {
            $this->database->bind('name', '%' . $name . '%');
        }
        if ($interest) {
            $this->database->bind('interest', '%' . $interest . '%');
        }
        if ($agama) {
            $this->database->bind('agama', $agama);
        }
        if ($mbti) {
            $this->database->bind('mbti', $mbti);
        }
        
        $this->database->bind('offset',($page-1)*6);
        $profiles = $this->database->fetchall();
        return $profiles;
    }

    public function getProfilesPageCount($exclude_userid=null, $name=null, $interest=null, $agama=null, $mbti=null)
    {
        $query = "
        SELECT gambar_profile, nama_lengkap, domisili, hobi, interest, umur, tinggi_badan, agama, mbti 
        FROM profile
        ";
        $cond = array();
        if ($exclude_userid) {
            array_push($cond," user_id != :userid");
        }
        if ($name) {
            array_push($cond," nama_lengkap LIKE :name");
        }
        if ($interest) {
            array_push($cond," interest LIKE :interest");
        }
        if ($agama) {
            array_push($cond," agama = :agama");
        }
        if ($mbti) {
            array_push($cond," mbti = :mbti");
        }

        if ($exclude_userid) {
            $queryGender = "SELECT gender from profile WHERE user_id = :userid";
            $this->database->query($queryGender);
            $this->database->bind('userid', $exclude_userid);
            $gender = $this->database->fetch()->gender;
            array_push($cond, " gender != '". $gender . "'");
        }

        if (count($cond) > 0) {
            $query .= " WHERE";
            $query .= implode(" AND",$cond);
        }
        
        $this->database->query($query);

        if ($exclude_userid) {
            $this->database->bind('userid', $exclude_userid);
        }
        if ($name) {
            $this->database->bind('name', '%' . $name . '%');
        }
        if ($interest) {
            $this->database->bind('interest', '%' . $interest . '%');
        }
        if ($agama) {
            $this->database->bind('agama', $agama);
        }
        if ($mbti) {
            $this->database->bind('mbti', $mbti);
        }

        $this->database->execute();
        return ceil($this->database->rowCount()/6);
    }    

    public function getGender($userId) {
        $query = '
            SELECT gender from profile
            WHERE user_id = :user_id
        ';

        $this->database->query($query);
        $this->database->bind('user_id', $userId);

        $user = $this->database->fetch();
        
        return $user->gender;
    }

    public function getMBTI($userId) {
        $query = '
            SELECT mbti from profile
            WHERE user_id = :user_id
        ';

        $this->database->query($query);
        $this->database->bind('user_id', $userId);

        $user = $this->database->fetch();
        
        return $user->mbti;
    }

    public function getAgama($userId) {
        $query = '
            SELECT agama from profile
            WHERE user_id = :user_id
        ';

        $this->database->query($query);
        $this->database->bind('user_id', $userId);

        $user = $this->database->fetch();
        
        return $user->agama;
    }

    public function getZodiak($userId) {
        $query = '
            SELECT zodiak from profile
            WHERE user_id = :user_id
        ';

        $this->database->query($query);
        $this->database->bind('user_id', $userId);

        $user = $this->database->fetch();
        
        return $user->zodiak;
    }

    public function getRecommendations($userId, $condition){
        // Get gender
        $gender = $this->getGender($userId);

        if($condition == "mbti"){
            $query = "
                SELECT * from profile
                WHERE mbti = :mbti AND gender <> :gender AND user_id <> :user_id
                LIMIT 6
            ";

            $mbti = $this->getMBTI($userId);
            $this->database->query($query);
            $this->database->bind('user_id', $userId);
            $this->database->bind('mbti', $mbti);
            $this->database->bind('gender', $gender);
        } else if($condition == "agama"){
            $query = "
                SELECT * from profile
                WHERE agama = :agama AND gender <> :gender AND user_id <> :user_id
                LIMIT 6
            ";

            $agama = $this->getAgama($userId);
            $this->database->query($query);
            $this->database->bind('user_id', $userId);
            $this->database->bind('agama', $agama);
            $this->database->bind('gender', $gender);
        } else if($condition == "zodiak"){
            $query = "
                SELECT * from profile
                WHERE zodiak = :zodiak AND gender <> :gender AND user_id <> :user_id
                LIMIT 6
            ";

            $zodiak = $this->getZodiak($userId);
            $this->database->query($query);
            $this->database->bind('user_id', $userId);
            $this->database->bind('zodiak', $zodiak);
            $this->database->bind('gender', $gender);
        } else {
            throw new Exception('Condition is not valid.', 400);
        }

        $result = $this->database->fetchAll();

        return $result;
    }

    public function updateProfile(
        $user_id,
        $fullName, 
        $name, 
        $age, 
        $contact, 
        $hobby, 
        $interest, 
        $tinggiBadan, 
        $agama, 
        $domisili, 
        $loveLanguage, 
        $mbti, 
        $zodiac, 
        $ketidaksukaan, 
        $imageFile, 
        $videoFile,
        $gender)
    {
        $query = 'UPDATE profile SET 
            nama_panggilan = :nama_panggilan, 
            nama_lengkap = :nama_lengkap, 
            umur = :umur, 
            hobi = :hobi,
            interest = :interest,
            tinggi_badan = :tinggi_badan,
            agama = :agama, 
            domisili = :domisili, 
            love_language = :love_language, 
            mbti = :mbti, 
            zodiak = :zodiak, 
            ketidaksukaan = :ketidaksukaan, 
            gender = :gender
            WHERE user_id = :user_id';
        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
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

        if ($imageFile) {
            $imageUploadPath = $user_id . '.jpg';
            move_uploaded_file($imageFile['tmp_name'], __DIR__ . '/../../public/images/profile/' . $imageUploadPath);
        }
        if ($videoFile) {
            $videoUploadPath = $user_id . '.mp4';
            move_uploaded_file($videoFile['tmp_name'], __DIR__ . '/../../public/videos/' . $videoUploadPath);
        }

        $this->database->execute();

        // Insert contact data into the 'user_contact' table
        $query = 'UPDATE user_contact SET contact_person = :contact_person WHERE user_id = :user_id';
        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
        $this->database->bind('contact_person', $contact);
        $this->database->execute();
    }

    public function getMyProfile($user_id)
    {
        $query = 'SELECT * FROM profile JOIN (SELECT user_id, contact_person FROM user_contact WHERE user_id = :user_id) ct USING (user_id)';
        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
        $profile = $this->database->fetch();
        return $profile;
    }
}