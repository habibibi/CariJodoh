<?php

class ArticlesController extends Controller {

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
                        $articlesView = $this->view('articles', 'ArticlesView');
                        $articlesView->render();
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

    // public function fetch(){
    //     try {
    //         switch ($_SERVER['REQUEST_METHOD']) {
    //             case 'GET':
    //                 if($this->middleware->isAuthenticated()){
    //                     $articleModel = $this->model('ArticleModel');
    //                     $page = $_GET['page'] ?? 1;
    //                     $pageCount = $articleModel->getArticles($exclude_userid, $name, $interest, $agama, $mbti);
    //                     header('Content-Type: application/json');
    //                     http_response_code(200);
    //                     echo json_encode(["articles" => $result, "pageCount" => $pageCount], JSON_NUMERIC_CHECK);
    //                 }
    //                 break;
    //             default:
    //                 throw new Exception('Method Not Allowed', 405);
    //         }
    //     } catch (Exception $e) {
    //         http_response_code($e->getCode());
    //         exit;
    //     }
    // }
}