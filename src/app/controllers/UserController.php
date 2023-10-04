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
                        $_SESSION['role'] = 'admin';
                        echo json_encode(["redirect_url" => BASE_URL . "/user/admin"]);
                    } else {
                        $_SESSION['role'] = 'user';
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
                    if(isset($_FILES['videoFile'])){
                        $videoFile = $_FILES['videoFile'];
                    } else {
                        $videoFile = null;
                    }
                    $gender = $formData['gender'];

                    // Call the register method with the extracted data
                    $userId = $userModel->register($username, $password, $fullName, $name, $age, $contact, $hobby, $interest, $tinggiBadan, $agama, $domisili, $loveLanguage, $mbti, $zodiac, $ketidaksukaan, $imageFile, $videoFile, $gender);
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['role'] = 'user';

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
                    $_SESSION['role'] = 'admin';
    
                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(["redirect_url" => BASE_URL . "/user/admin"]);
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
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->middleware->checkAdmin()){
                        header('Location: ' . BASE_URL . '/user/admin');
                    } else if($this->middleware->checkAuthenticated()) {
                        $profileView = $this->view('user', 'ProfileView');
                        $profileView->render();
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

    public function logout(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    unset($_SESSION['user_id']);
                    unset($_SESSION['role']);
                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(["redirect_url" => BASE_URL . "/user/login"]);
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e){
            http_response_code($e->getCode());
            exit;
        }
    }

    public function profiles(){
        try{
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if ($this->middleware->checkAuthenticated()){
                        $userModel = $this->model('UserModel');
                        $exclude_userid = ($this->middleware->checkAdmin() ? null : $_SESSION['user_id']);
                        $page = $_GET['page'] ?? 1;
                        $name = $_GET['name'] ?? null;
                        $interest = $_GET['interest'] ?? null;
                        $agama = $_GET['agama'] ?? null;
                        $mbti = $_GET['mbti'] ?? null;

                        $sort = $_GET['sort'] ?? 'nama_lengkap';
                        $allowed_column = ['nama_lengkap', 'umur'];
                        if (!in_array($sort, $allowed_column)) {
                            throw new Exception('Bad Request', 400);
                        }

                        $isdesc = $_GET['isdesc'] ?? false;
                        $result = $userModel->getProfiles($page, $exclude_userid, $name, $interest, $agama, $mbti, $sort, $isdesc);
                        $pageCount = $userModel->getProfilesPageCount($exclude_userid, $name, $interest, $agama, $mbti);
                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode(["profiles" => $result, "pageCount" => $pageCount], JSON_NUMERIC_CHECK);
                    } else {
                        throw new Exception('Unauthorized', 401);
                    }
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e){
            http_response_code($e->getCode());
            exit;
        }
    }
}