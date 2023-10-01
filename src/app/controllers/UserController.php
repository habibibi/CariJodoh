<?php

class UserController extends Controller {
    public function index(){
        $profileView = $this->view('user', 'ProfileView');
        $profileView->render();
    }

    public function login(){
        $loginView = $this->view('user', 'LoginView');
        $loginView->render();
    }

    public function register(){
        $registerView = $this->view('user', 'RegisterView');
        $registerView->render();
    }

    public function profile(){
        $profileView = $this->view('user', 'ProfileView');
        $profileView->render();
    }
}