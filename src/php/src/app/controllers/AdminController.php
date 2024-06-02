<?php

class AdminController extends Controller {

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
                        $adminView = $this->view('admin', 'AdminView');
                        $adminView->render();
                    } else if($this->middleware->checkAuthenticated()) {
                        header('Location: ' . BASE_URL . '/recommendation');
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

    public function notification(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->middleware->checkAdmin()){
                        $adminNotificationsView = $this->view('admin', 'AdminNotificationsView');
                        $adminNotificationsView->render();
                    } else if($this->middleware->checkAuthenticated()) {
                        header('Location: ' . BASE_URL . '/recommendation');
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

    public function likes(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->middleware->checkAdmin()){
                        $adminLikesView = $this->view('admin', 'AdminLikesView');
                        $adminLikesView->render();
                    } else if($this->middleware->checkAuthenticated()) {
                        header('Location: ' . BASE_URL . '/recommendation');
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

    public function user(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->middleware->checkAdmin()){
                        $adminUserView = $this->view('admin', 'AdminUserView');
                        $adminUserView->render();
                    } else if($this->middleware->checkAuthenticated()) {
                        header('Location: ' . BASE_URL . '/recommendation');
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

    public function view_user($userId=null){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($userId && $this->middleware->checkAdmin()){
                        $profileView = $this->view('admin', 'AdminViewUserView', ["user_id" => $userId]);
                        $profileView->render();
                    } else if($this->middleware->checkAuthenticated()) {
                        $profileView = $this->view('recommendation', 'RecommendationView');
                        $profileView->render();
                    } else {
                        header('Location: ' . BASE_URL . '/user/login');
                    }
                    break;
            }
        } catch (Exception $e){
            http_response_code($e->getCode());
            exit;
        }
    }
}