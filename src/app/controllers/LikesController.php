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
                        header('Location: ' . BASE_URL . '/admin');
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
                    if($this->middleware->checkAdmin()){
                        $likesModel = $this->model('LikesModel');
                        $result = $likesModel->getLikes($_GET['page']);

                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode($result);
                    } else if($this->middleware->isAuthenticated()){
                        $likesModel = $this->model('LikesModel');
                        $result = $likesModel->getLikesByUserId($_SESSION['user_id'], $_GET['page']);

                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode($result);
                    }
                    break;
                case 'POST':
                    if($this->middleware->isAuthenticated()){
                        $likesModel = $this->model('LikesModel');
                        $pages = $likesModel->addLike($_POST['user_id_1'], $_POST['user_id_2']);

                        header('Content-Type: application/json');
                        http_response_code(201);
                        echo json_encode(["message" => "Tambah Likes berhasil.", "pages" => $pages]);
                    }
                    break;
                case 'DELETE':
                    if ($params) {
                        if($this->middleware->isAdmin()){
                            $likesModel = $this->model('LikesModel');
                            $likesModel->deleteLike((int) $params);
                            $result = $likesModel->getLikes(1);

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

    public function update($dateId){
        try {
            switch($_SERVER['REQUEST_METHOD']){
                case 'POST':
                    if ($dateId) {
                        if($this->middleware->isAdmin()){
                            $likesModel = $this->model('LikesModel');
                            $likesModel->updateLike((int) $dateId, $_POST['user_id_1'], $_POST['user_id_2']);

                            header('Content-Type: application/json');
                            http_response_code(201);
                            echo json_encode(["message" => "Update Likes berhasil."]);
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