<?php

class ChatController extends Controller {

    private $authMiddleware;
    private $dateMiddleware;

    public function __construct()
    {
        $this->authMiddleware = $this->middleware("AuthenticationMiddleware");
        $this->dateMiddleware = $this->middleware("DateMiddleware");
    }

    public function index()
    {
        $notFoundView = $this->view('not-found', 'NotFoundView');
        $notFoundView->render();
    }

    public function user($otherId){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->authMiddleware->checkAdmin()){
                        header('Location: ' . BASE_URL . '/admin');
                    } else if (!$this->authMiddleware->checkAuthenticated()) {
                        header('Location: ' . BASE_URL . '/user/login');
                    } else if (!$this->dateMiddleware->isDating($otherId)) {
                        header('Location: ' . BASE_URL . '/recommendation');
                    } else {
                        $userModel = $this->model("UserModel");
                        $our_name = $userModel->getName($_SESSION['user_id']);
                        $other_name = $userModel->getName($otherId);
                        $other_email = $userModel->getEmail($otherId);
                        $chatView = $this->view('chat', 'ChatView', ['user_id' => $_SESSION['user_id'], 'other_id' => $otherId, 'our_name' => $our_name, 'other_name' => $other_name, 'other_email' => $other_email]);
                        $chatView->render();
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