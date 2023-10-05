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
                            $viewView = $this->view('view', 'ViewView', ['profile' => $profile]);
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
            $notFoundView = $this->view('not-found', 'NotFoundView');
            $notFoundView->render();
            exit;
        }
    }
}