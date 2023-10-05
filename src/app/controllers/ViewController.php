<?php

class ViewController extends Controller {
    private $authMiddleware;
    private $genderMiddleware;

    public function __construct()
    {
        $this->authMiddleware = $this->middleware("AuthenticationMiddleware");
        $this->genderMiddleware = $this->middleware("GenderMiddleware");
    }

    public function index($userId){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->authMiddleware->checkAdmin()){
                        header('Location: ' . BASE_URL . '/admin');
                    } else if($this->authMiddleware->checkAuthenticated() && $userId) {
                        if($this->genderMiddleware->isDifferentGender($userId)){
                            $userModel = $this->model("UserModel");
                            $profile = $userModel->getProfile($userId);
                            $viewView = $this->view('view', 'ViewView', ['user_id' => $userId], $profile);
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
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function like($userId) {
        try {
            switch ($_SERVER['REQUEST METHOD']) {
                case 'POST':
                    if ($this->authMiddlewar->checkAdmin()) {
                        throw new Exception('Method Not Allowed', 405);
                    } else if ($this->authMiddleware->checkAutheticated() && $userId) {
                        if ($this->genderMiddleware->isDifferentGender($userId)) {
                            $notificationModel = $this->model("NotificationModel");
                            $notificationModel->likeUser($_SESSION['user_id'], $userId);

                            header('Content-Type: application/json');
                            http_response_code(201);
                            echo json_encode(["message" => "Berhasil menyukai user!"]);
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
}