<?php

class ChatController extends Controller {

    private $authMiddleware;
    private $dateMiddleware;

    public function __construct()
    {
        $this->middleware = $this->middleware("AuthenticationMiddleware");
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
                    if($this->middleware->checkAdmin()){
                        header('Location: ' . BASE_URL . '/admin');
                    } else if (!$this->middleware->checkAuthenticated()) {
                        header('Location: ' . BASE_URL . '/user/login');
                    } else if (!$this->dateMiddleware->isDating($otherId)) {
                        header('Location: ' . BASE_URL . '/recommendation');
                    } else {
                        $chatView = $this->view('chat', 'ChatView', ['user_id' => $_SESSION['user_id'], 'other_id' => $otherId]);
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