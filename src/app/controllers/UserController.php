<?php

class UserController extends Controller {
    private $middleware;

    public function __construct()
    {
        $this->middleware = $this->middleware("AuthenticationMiddleware");
    }

    public function index(){
        $notFoundView = $this->view('not-found', 'NotFoundView');
        $notFoundView->render();
    }

    public function login(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->middleware->checkAdmin()){
                        header('Location: ' . BASE_URL . '/user/admin');
                    } else if ($this->middleware->checkAuthenticated()) {
                        header('Location: ' . BASE_URL . '/recommendation');
                    } else {
                        $loginView = $this->view('user', 'LoginView');
                        $loginView->render();
                    }
                    break;
                case 'POST':
                    $userModel = $this->model('UserModel');
                    $userId = $userModel->login($_POST['username'], $_POST['password']);
                    $_SESSION['user_id'] = $userId;

                    header('Content-Type: application/json');
                    http_response_code(201);

                    if($this->middleware->checkAdmin()){
                        echo json_encode(["redirect_url" => BASE_URL . "/user/admin"]);
                    } else {
                        echo json_encode(["redirect_url" => BASE_URL . "/recommendation"]);
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

    public function register(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->middleware->checkAdmin()){
                        header('Location: ' . BASE_URL . '/user/admin');
                    } else if ($this->middleware->checkAuthenticated()) {
                        header('Location: ' . BASE_URL . '/recommendation');
                    } else {
                        $registerView = $this->view('user', 'RegisterView');
                        $registerView->render();
                    }
                    break;
                case 'POST':
                    $userModel = $this->model('UserModel');
                    $formData = $_POST;
                    $username = $formData['username'];
                    $password = $formData['password'];
                    $fullName = $formData['fullName'];
                    $name = $formData['name'];
                    $age = $formData['age'];
                    $contact = $formData['contact'];
                    $hobby = $formData['hobby'];
                    $interest = $formData['interest'];
                    $tinggiBadan = $formData['tinggiBadan'];
                    $agama = $formData['agama'];
                    $domisili = $formData['domisili'];
                    $loveLanguage = $formData['loveLanguage'];
                    $mbti = $formData['mbti'];
                    $zodiac = $formData['zodiac'];
                    $ketidaksukaan = $formData['ketidaksukaan'];
                    $imageFile = $_FILES['imageFile'];
                    $videoFile = $_FILES['videoFile'];
                    $gender = $formData['gender'];

                    // Call the register method with the extracted data
                    $userId = $userModel->register($username, $password, $fullName, $name, $age, $contact, $hobby, $interest, $tinggiBadan, $agama, $domisili, $loveLanguage, $mbti, $zodiac, $ketidaksukaan, $imageFile, $videoFile, $gender);
                    $_SESSION['user_id'] = $userId;

                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(["redirect_url" => BASE_URL . "/recommendation"]);
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function register_admin(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $userModel = $this->model('UserModel');
                    $userId = $userModel->register_admin($_POST['username'], $_POST['password']);
                    $_SESSION['user_id'] = $userId;

                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(["redirect_url" => BASE_URL . "/recommendation"]);
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function profile(){
        $profileView = $this->view('user', 'ProfileView');
        $profileView->render();
    }

    public function admin(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->middleware->checkAdmin()){
                        $adminView = $this->view('user', 'AdminView');
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

    public function admin_notifications(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->middleware->checkAdmin()){
                        $adminNotificationsView = $this->view('user', 'AdminNotificationsView');
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

    public function admin_likes(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->middleware->checkAdmin()){
                        $adminLikesView = $this->view('user', 'AdminLikesView');
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
}