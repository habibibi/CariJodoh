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
                        header('Location: ' . BASE_URL . '/admin');
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
                        echo json_encode(["redirect_url" => BASE_URL . "/admin"]);
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
                        header('Location: ' . BASE_URL . '/admin');
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
                    
                    if($this->middleware->checkAdmin()){
                        header('Content-Type: application/json');
                        http_response_code(201);
                        echo json_encode(["message" => "Berhasil tambah user!"]);
                    } else {
                        $_SESSION['user_id'] = $userId;
                        $_SESSION['role'] = 'user';

                        header('Content-Type: application/json');
                        http_response_code(201);
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
                    echo json_encode(["redirect_url" => BASE_URL . "/admin"]);
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function profile($user_id=null){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->middleware->checkAdmin()){
                        if ($user_id == null) {
                            throw new Exception('Bad Request', 400);
                        }
                        $userModel = $this->model('UserModel');
                        $profile = $userModel->getMyProfile($user_id);
                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode($profile, JSON_NUMERIC_CHECK);
                    } else if ($this->middleware->checkAuthenticated() && ($user_id == null || $user_id == $_SESSION['user_id'])) {
                        if ($user_id == null) $user_id = $_SESSION['user_id'];
                        $userModel = $this->model('UserModel');
                        $profile = $userModel->getMyProfile($user_id);
                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode($profile, JSON_NUMERIC_CHECK);
                    } else {
                        header('Location: ' . BASE_URL . '/user/login');
                    }
                    break;
                case 'POST':
                    $valid = false;
                    if ($this->middleware->checkAdmin()){
                        if ($user_id == null) {
                            throw new Exception('Bad Request', 400);
                        }
                        $valid = true;
                    }
                    else if ($this->middleware->checkAuthenticated() && ($user_id == $_SESSION['user_id'] || $user_id == null)) {
                        $valid = true;
                        $user_id = $_SESSION['user_id'];
                    }
                    if ($valid){
                        $userModel = $this->model('UserModel');
                        $formData = $_POST;
                        $fullName = $formData['fullName'];
                        $name = $formData['name'];
                        $age = $formData['age'];
                        $contact = $formData['contact_person'];
                        $hobby = $formData['hobby'];
                        $interest = $formData['interest'];
                        $tinggiBadan = $formData['tinggiBadan'];
                        $agama = $formData['agama'];
                        $domisili = $formData['domisili'];
                        $loveLanguage = $formData['loveLanguage'];
                        $mbti = $formData['mbti'];
                        $zodiac = $formData['zodiac'];
                        $ketidaksukaan = $formData['ketidaksukaan'];
                        if (isset($_FILES['imageFile'])) {
                            $imageFile = $_FILES['imageFile'];
                        } else {
                            $imageFile = null;
                        }
                        if(isset($_FILES['videoFile'])){
                            $videoFile = $_FILES['videoFile'];
                        } else {
                            $videoFile = null;
                        }
                        $gender = $formData['gender'];
                        $userModel->updateProfile($user_id, $fullName, $name, $age, $contact, $hobby, $interest, $tinggiBadan, $agama, $domisili, $loveLanguage, $mbti, $zodiac, $ketidaksukaan, $imageFile, $videoFile, $gender);
                        header('Content-Type: application/json');
                        http_response_code(201);
                        echo json_encode(["message" => "Profile updated"]);
                    } else {
                        throw new Exception('Unauthorized', 401);
                    }
                    break;
                default:
                    throw new Exception('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            http_response_code($e->getCode());
            exit;
        }
    }

    public function admin(){
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

    public function admin_notifications(){
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

    public function admin_likes(){
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
                        $allowed_column = ['nama_lengkap', 'tinggi_badan', 'umur'];
                        if (!in_array($sort, $allowed_column)) {
                            throw new Exception('Bad Request', 400);
                        }

                        $isdesc = $_GET['isdesc'] ?? null;
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

    public function fetch_recommendation(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if ($this->middleware->isAuthenticated() && isset($_GET['condition'])) {
                        $userModel = $this->model("UserModel");

                        $condition = $_GET['condition'];

                        $result = $userModel->getRecommendations($_SESSION['user_id'], $condition);
                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode(["data" => $result]);
                    } else {
                        throw new Exception('Method Not Allowed', 405);
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

    public function myprofile(){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if($this->middleware->checkAdmin()){
                        header('Location: ' . BASE_URL . '/admin');
                    } else if($this->middleware->checkAuthenticated()) {
                        $profileView = $this->view('user', 'ProfileView');
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

    public function delete($userId=null){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'DELETE':
                    if($userId && $this->middleware->isAdmin()){
                        $userModel = $this->model("UserModel");
                        $userModel->deleteUser($userId);
                        header('Content-Type: application/json');
                        http_response_code(202);
                        echo json_encode(["redirect_url" => BASE_URL . "/admin/user"]);
                    }
                    break;
            }
        } catch (Exception $e){
            http_response_code($e->getCode());
            exit;
        }
    }
}