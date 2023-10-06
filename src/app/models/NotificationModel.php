<?php

class NotificationModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getNotifications($page = 1){
        // Define query
        $query = 'SELECT * FROM notification LIMIT :limit OFFSET :offset';
        $this->database->query($query);
        $this->database->bind('limit', 6);
        $this->database->bind('offset', ($page - 1) * 6);

        // Get result
        $result_query = $this->database->fetchAll();
        $pages_count = $this->getPagesCount();
        $result = ["data" => $result_query, "pages" => $pages_count];

        return $result;
    }

    public function getNotificationsByUserId($userId, $page = 1){
        // Define query
        $query = 'SELECT * FROM notification WHERE (user_id_receiver = :userId) AND sudah_dibaca = false LIMIT :limit OFFSET :offset';
        $this->database->query($query);
        $this->database->bind('limit', 6);
        $this->database->bind('offset', ($page - 1) * 6);
        $this->database->bind('userId', $userId);

        // Get result
        $result_query = $this->database->fetchAll();
        $pages_count = $this->getPagesCount($userId);
        $result = ["data" => $result_query, "pages" => $pages_count];

        return $result;
    }

    public function addNotification($jenisNotifikasi, $userIdSender, $userIdReceiver, $isiNotifikasi){
        // Check conflict
        if($this->checkConflict($jenisNotifikasi, $userIdSender, $userIdReceiver, $isiNotifikasi)) {
            throw new Exception('Conflict', 409);
        }

        // Define the INSERT query
        $query = 'INSERT INTO notification (jenis_notifikasi, user_id_sender, user_id_receiver, isi_notifikasi, sudah_dibaca) VALUES (:jenisNotifikasi, :userIdSender, :userIdReceiver, :isiNotifikasi, :sudahDibaca)';
        
        // Bind parameters and execute the query
        $this->database->query($query);
        $this->database->bind('jenisNotifikasi', $jenisNotifikasi);
        $this->database->bind('userIdSender', $userIdSender);
        $this->database->bind('userIdReceiver', $userIdReceiver);
        $this->database->bind('isiNotifikasi', $isiNotifikasi);
        $this->database->bind('sudahDibaca', false);
        
        // Execute the query
        $this->database->execute();

        return $this->getPagesCount();
    }

    public function getPagesCount($userId=null){
        if($userId != null){
            // Define query
            $query = 'SELECT COUNT(*) AS count FROM notification WHERE (user_id_receiver = :userId) AND sudah_dibaca = false';
            $this->database->query($query);
            $this->database->bind('userId', $userId);

            // Get result
            $result_query = $this->database->fetch();
            $pages_count = ceil($result_query->count / 6);

            return $pages_count;
        } else {
            // Define query
            $query = 'SELECT COUNT(*) AS count FROM notification';
            $this->database->query($query);

            // Get result
            $result_query = $this->database->fetch();
            $pages_count = ceil($result_query->count / 6);

            return $pages_count;
        }
    }

    public function deleteNotification($notificationId){
        // Define query
        $query = 'DELETE FROM notification WHERE (notification_id = :notification_id)';

        // Execute delete
        $this->database->query($query);
        $this->database->bind('notification_id', $notificationId);
        $this->database->execute();
    }

    public function updateNotification($notificationId, $jenisNotifikasi, $userIdSender, $userIdReceiver, $isiNotifikasi, $sudahDibaca){
        // Check conflict
        if($this->checkConflict($jenisNotifikasi, $userIdSender, $userIdReceiver, $isiNotifikasi)) {
            throw new Exception('Conflict', 409);
        }
        
        // Define the UPDATE query
        $query = 'UPDATE notification 
                SET jenis_notifikasi = :jenisNotifikasi,
                    user_id_sender = :userIdSender,
                    user_id_receiver = :userIdReceiver,
                    isi_notifikasi = :isiNotifikasi,
                    sudah_dibaca = :sudahDibaca
                WHERE (notification_id = :notificationId)';
        
        // Bind parameters and execute the query
        $this->database->query($query);
        $this->database->bind('notificationId', $notificationId);
        $this->database->bind('jenisNotifikasi', $jenisNotifikasi);
        $this->database->bind('userIdSender', $userIdSender);
        $this->database->bind('userIdReceiver', $userIdReceiver);
        $this->database->bind('isiNotifikasi', $isiNotifikasi);
        $this->database->bind('sudahDibaca', $sudahDibaca);
        
        // Execute the query
        $this->database->execute();
    }

    public function readNotification($notificationId){
        // Define the UPDATE query
        $query = 'UPDATE notification 
                SET sudah_dibaca = true 
                WHERE (notification_id = :notificationId)';
        
        // Bind parameters and execute the query
        $this->database->query($query);
        $this->database->bind('notificationId', $notificationId);
        
        // Execute the query
        $this->database->execute();
    }

    public function likeNotification($notificationId, $user_id_1, $user_id_2){
        // Check conflict
        if($this->checkConflict2($user_id_1, $user_id_2)) {
            throw new Exception('Conflict', 409);
        }

        // Read notification
        $this->readNotification($notificationId);

        // Create date for both user
        $query = 'INSERT INTO date (user_id_1, user_id_2) VALUES (:userId1, :userId2)';
        $this->database->query($query);
        $this->database->bind('userId1', $user_id_1);
        $this->database->bind('userId2', $user_id_2);
        $this->database->execute();

        $query = 'INSERT INTO date (user_id_1, user_id_2) VALUES (:userId1, :userId2)';
        $this->database->query($query);
        $this->database->bind('userId1', $user_id_2);
        $this->database->bind('userId2', $user_id_1);
        $this->database->execute();
    }

    public function likeUser($userIdSender, $userIdReceiver) {
        // Check conflict
        if($this->checkConflict2($userIdSender, $userIdReceiver)) {
            throw new Exception('Conflict', 409);
        }

        // Check if user already like sender
        $query = 'SELECT * FROM notification WHERE (user_id_receiver = :user_id_receiver) AND (user_id_sender = :user_id_sender) AND sudah_dibaca = false';
        $this->database->query($query);
        $this->database->bind('user_id_sender', $userIdReceiver);
        $this->database->bind('user_id_receiver', $userIdSender);
        $result = $this->database->fetch();

        if($result) {
            // Like notification
            $this->likeNotification($result->notification_id, $userIdSender, $userIdReceiver);
            return;
        }

        // Get sender name
        $query = 'SELECT nama_lengkap FROM profile WHERE (user_id = :user_id_sender)';
        $this->database->query($query);
        $this->database->bind('user_id_sender', $userIdSender);
        $result = $this->database->fetch();

        // Define INSERT query
        $query = 'INSERT INTO notification (jenis_notifikasi, user_id_sender, user_id_receiver, isi_notifikasi, sudah_dibaca) VALUES (:jenisNotifikasi, :userIdSender, :userIdReceiver, :isiNotifikasi, :sudahDibaca)';

        // Binding parameters
        $this->database->query($query);
        $this->database->bind('jenisNotifikasi', 'date');
        $this->database->bind('userIdSender', $userIdSender);
        $this->database->bind('userIdReceiver', $userIdReceiver);
        $this->database->bind('isiNotifikasi', $result->nama_lengkap . ' menyukai kamu!');
        $this->database->bind('sudahDibaca', false);

        // Execute query
        $this->database->execute();
    }

    public function checkLikeNotification($userIdSender, $userIdReceiver) {
        $query = "SELECT * from notification WHERE (user_id_sender = :userIdSender) AND (user_id_receiver = :userIdReceiver) AND jenis_notifikasi = 'date' AND sudah_dibaca = false";

        $this->database->query($query);
        $this->database->bind('userIdSender', $userIdSender);
        $this->database->bind('userIdReceiver', $userIdReceiver);

        $result = $this->database->fetch();

        if($result){
            return "true";
        }

        $query = "SELECT * from date WHERE (user_id_1 = :userIdSender) AND (user_id_2 = :userIdReceiver)";

        $this->database->query($query);
        $this->database->bind('userIdSender', $userIdSender);
        $this->database->bind('userIdReceiver', $userIdReceiver);

        $result = $this->database->fetch();

        if($result){
            return "pending";
        }

        return "false";
    }

    public function checkConflict($jenisNotifikasi, $userIdSender, $userIdReceiver, $isiNotifikasi){
        // Define query
        $query = 'SELECT * FROM notification WHERE (user_id_sender = :userIdSender) AND (user_id_receiver = :userIdReceiver) AND (jenis_notifikasi = :jenisNotifikasi) AND (isi_notifikasi = :isiNotifikasi) AND sudah_dibaca = false';
        $this->database->query($query);
        $this->database->bind('jenisNotifikasi', $jenisNotifikasi);
        $this->database->bind('userIdSender', $userIdSender);
        $this->database->bind('userIdReceiver', $userIdReceiver);
        $this->database->bind('isiNotifikasi', $isiNotifikasi);

        // Get result
        $result = $this->database->fetch();

        if($result){
            return true;
        } else {
            return false;
        }
    }

    public function checkConflict2($userId1, $userId2){
        // Define query
        $query = 'SELECT * FROM date WHERE (user_id_1 = :userId1) AND (user_id_2 = :userId2)';
        $this->database->query($query);
        $this->database->bind('userId1', $userId1);
        $this->database->bind('userId2', $userId2);

        // Get result
        $result = $this->database->fetch();

        if($result){
            return true;
        } else {
            return false;
        }
    }
}