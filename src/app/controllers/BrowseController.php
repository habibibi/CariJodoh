<?php

class BrowseController extends Controller {

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
                        $browseView = $this->view('browse', 'BrowseView');
                        $browseView->render();
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