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
                    if($this->middleware->checkAdmin()){
                        header('Location: ' . BASE_URL . '/user/admin');
                    } else if (!$this->middleware->checkAuthenticated()) {
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

    public function fetch($params=null){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if ($params) {
                        if($this->middleware->isAuthenticated()){
                            $notifModel = $this->model('LikesModel');
                            $result = $notifModel->getLikesByUserId((int) $params, $_GET['page']);

                            header('Content-Type: application/json');
                            http_response_code(200);
                            echo json_encode($result);
                        }
                    } else if($this->middleware->isAdmin()){
                        $notifModel = $this->model('LikesModel');
                        $result = $notifModel->getLikes($_GET['page']);

                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode($result);
                    }
                    break;
                case 'POST':
                    if($this->middleware->isAuthenticated()){
                        $notifModel = $this->model('LikesModel');
                        $notifModel->addLikes($_POST['user_id_1'], $_POST['user_id_2']);

                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode(["message" => "Tambah Likes berhasil."]);
                    }
                    break;
                case 'PATCH':
                    if ($params) {
                        if($this->middleware->isAdmin()){
                            $notifModel = $this->model('LikesModel');
                            $notifModel->updateLikes((int) $params, $_POST['user_id_1'], $_POST['user_id_2']);

                            header('Content-Type: application/json');
                            http_response_code(200);
                            echo json_encode(["message" => "Update Likes berhasil."]);
                        }
                    } else {
                        throw new Exception('Not Found', 404);
                    }
                    break;
                case 'DELETE':
                    if ($params) {
                        if($this->middleware->isAdmin()){
                            $notifModel = $this->model('LikesModel');
                            $notifModel->deleteLike((int) $params);

                            header('Content-Type: application/json');
                            http_response_code(200);
                            echo json_encode(["message" => "Delete Likes berhasil."]);
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
}