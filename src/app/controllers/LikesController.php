<?php

class LikesController extends Controller {
    private $middleware;

    public function __construct()
    {
        $this->middleware = $this->middleware("AuthenticationMiddleware");
    }

    public function index(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if (!$this->middleware->checkAuthenticated()) {
                        header('Location: ' . BASE_URL . '/user/login');
                    } else {
                        $likesView = $this->view('likes', 'LikesView');
                        $likesView->render();
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