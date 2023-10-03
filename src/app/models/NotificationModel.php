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
        $query = 'SELECT * FROM notification WHERE (user_id_receiver = :userId) LIMIT :limit OFFSET :offset';
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
            $query = 'SELECT COUNT(*) AS count FROM notification WHERE (user_id_receiver = :userId)';
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
        $query = 'DELETE FROM notification WHERE notification_id = :notification_id';

        // Execute delete
        $this->database->query($query);
        $this->database->bind('notification_id', $notificationId);
        $this->database->execute();
    }

    public function updateNotification($notificationId, $jenisNotifikasi, $userIdSender, $userIdReceiver, $isiNotifikasi, $sudahDibaca){
        // Define the UPDATE query
        $query = 'UPDATE notification 
                SET jenis_notifikasi = :jenisNotifikasi, 
                    user_id_sender = :userIdSender, 
                    user_id_receiver = :userIdReceiver, 
                    isi_notifikasi = :isiNotifikasi, 
                    sudah_dibaca = :sudahDibaca 
                WHERE notification_id = :notificationId';
        
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
                WHERE notification_id = :notificationId';
        
        // Bind parameters and execute the query
        $this->database->query($query);
        $this->database->bind('notificationId', $notificationId);
        
        // Execute the query
        $this->database->execute();
    }
}