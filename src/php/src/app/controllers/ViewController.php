<?php

class ViewController extends Controller {
    private $authMiddleware;
    private $genderMiddleware;

    public function __construct()
    {
        $this->authMiddleware = $this->middleware("AuthenticationMiddleware");
        $this->genderMiddleware = $this->middleware("GenderMiddleware");
    }

    public function index()
    {
        $notFoundView = $this->view('not-found', 'NotFoundView');
        $notFoundView->render();
    }

    public function profile($userId){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->authMiddleware->checkAdmin()){
                        header('Location: ' . BASE_URL . '/admin');
                    } else if($this->authMiddleware->checkAuthenticated() && $userId) {
                        if($this->genderMiddleware->isDifferentGender($userId)){
                            $userModel = $this->model("UserModel");
                            $profile = $userModel->getProfile($userId);
                            $notificationModel = $this->model("NotificationModel");
                            $liked = $notificationModel->checkLikeNotification($_SESSION['user_id'], $userId);
                            $viewView = $this->view('view', 'ViewView', ['profile' => $profile, 'liked' => $liked]);
                            $viewView->render();
                        } else {
                            throw new Exception('Method Not Allowed', 405);
                        }
                    } else {
                        header('Location: ' . BASE_URL . '/user/login');
                    }
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception) {
            $notFoundView = $this->view('not-found', 'NotFoundView');
            $notFoundView->render();
            exit;
        }
    }

    public function like($userId){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    if($this->authMiddleware->checkAdmin()){
                        throw new Exception('Method Not Allowed', 405);
                    } else if($this->authMiddleware->checkAuthenticated() && $userId) {
                        if($this->genderMiddleware->isDifferentGender($userId)){
                            $notificationModel = $this->model("NotificationModel");
                            $notificationModel->likeUser($_SESSION['user_id'], $userId);

                            header('Content-Type: application/json');
                            http_response_code(201);
                            echo json_encode(["message" => "Berhasil like user!"]);
                        } else {
                            throw new Exception('Method Not Allowed', 405);
                        }
                    } else {
                        header('Location: ' . BASE_URL . '/user/login');
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

    public function report(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    if($this->authMiddleware->checkAuthenticated()) {
                        $userModel = $this->model("UserModel");
                        if(!$userModel->isExist((int)$_POST['user_id_reported'])){
                            header('Content-Type: application/json');
                            http_response_code(405);
                            echo json_encode(["message" => "User sudah terblokir!"]);
                            return;
                        }
                        $apiUrl = REST_API_URL . "report?api_key=" . API_KEY;
                        $data = array(
                            'user_id_reporter' => (int)$_POST['user_id_reporter'],
                            'user_id_reported' => (int)$_POST['user_id_reported'],
                            'report_detail' => $_POST['report_detail']
                        );

                        $ch = curl_init($apiUrl);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_exec($ch);

                        // Check for errors
                        if (curl_errno($ch)) {
                            http_response_code(500);
                            echo json_encode(["message" => "Gagal report user!"]);
                        } else {
                            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                            if ($httpCode === 201) {
                                header('Content-Type: application/json');
                                http_response_code(201);
                                echo json_encode(["message" => "Berhasil report user!"]);
                            } else if($httpCode === 409){
                                http_response_code($httpCode);
                                echo json_encode(["message" => "Gagal, sebelumnya sudah Anda report!"]);
                            } else {
                                http_response_code($httpCode);
                                echo json_encode(["message" => "Gagal report user!"]);
                            }
                        }
                        curl_close($ch);
                    } else {
                        throw new Exception('Method Not Allowed', 405);
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