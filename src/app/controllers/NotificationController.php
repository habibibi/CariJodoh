<?php

class NotificationController extends Controller {
    private $middleware;

    public function __construct()
    {
        $this->middleware = $this->middleware("AuthenticationMiddleware");
    }

    public function index(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->middleware->checkAdmin()){
                        header('Location: ' . BASE_URL . '/user/admin');
                    } else if (!$this->middleware->checkAuthenticated()) {
                        header('Location: ' . BASE_URL . '/user/login');
                    } else {
                        $notificationView = $this->view('notification', 'NotificationView');
                        $notificationView->render();
                    }
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function fetch($params=null){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->middleware->checkAdmin()){
                        $notifModel = $this->model('NotificationModel');
                        $result = $notifModel->getNotifications($_GET['page']);

                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode($result);
                    } else if($this->middleware->isAuthenticated()) {
                        $notifModel = $this->model('NotificationModel');
                        $result = $notifModel->getNotificationsByUserId($_SESSION['user_id'], $_GET['page']);

                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode($result);
                    }
                    break;
                case 'POST':
                    if($this->middleware->isAuthenticated()){
                        $notifModel = $this->model('NotificationModel');
                        $pages = $notifModel->addNotification($_POST['jenis_notifikasi'], $_POST['user_id_sender'], $_POST['user_id_receiver'], $_POST['isi_notifikasi']);

                        header('Content-Type: application/json');
                        http_response_code(201);
                        echo json_encode(["message" => "Tambah Notifikasi berhasil.", "pages" => $pages]);
                    }
                    break;
                case 'PUT':
                    if ($params) {
                        if($this->middleware->isAuthenticated()){
                            $notifModel = $this->model('NotificationModel');
                            $notifModel->readNotification((int) $params);
                            $result = $notifModel->getNotificationsByUserId($_SESSION['user_id'], 1);

                            header('Content-Type: application/json');
                            http_response_code(200);
                            echo json_encode($result);
                        }
                    } else {
                        throw new Exception('Not Found', 404);
                    }
                    break;
                case 'DELETE':
                    if ($params) {
                        if($this->middleware->isAdmin()){
                            $notifModel = $this->model('NotificationModel');
                            $notifModel->deleteNotification((int) $params);
                            $result = $notifModel->getNotifications(1);

                            header('Content-Type: application/json');
                            http_response_code(200);
                            echo json_encode($result);
                        }
                    } else {
                        throw new Exception('Not Found', 404);
                    }
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function update($notificationId) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    if ($notificationId) {
                        $jenisNotifikasi = $_POST['jenis_notifikasi'];
                        $userIdSender = $_POST['user_id_sender'];
                        $userIdReceiver = $_POST['user_id_receiver'];
                        $isiNotifikasi = $_POST['isi_notifikasi'];
                        $sudahDibaca = $_POST['sudah_dibaca'];

                        $notifModel = $this->model('NotificationModel');
                        $notifModel->updateNotification((int) $notificationId, $jenisNotifikasi, $userIdSender, $userIdReceiver, $isiNotifikasi, $sudahDibaca);

                        header('Content-Type: application/json');
                        http_response_code(201);
                        echo json_encode(["message" => "Update Notifikasi berhasil."]);
                    } else {
                        throw new Exception('Not Found', 404);
                    }
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function likes($notificationId) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    if ($notificationId && isset($_POST['user_id'])) {
                        $userId = $_POST['user_id'];

                        $notifModel = $this->model('NotificationModel');
                        $notifModel->likeNotification((int) $notificationId, $_SESSION['user_id'], $userId);

                        header('Content-Type: application/json');
                        http_response_code(201);
                        echo json_encode(["message" => "Update Notifikasi berhasil."]);
                    } else {
                        throw new Exception('Not Found', 404);
                    }
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }
}