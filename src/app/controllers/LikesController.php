<?php

class LikesController extends Controller {
    public function index(){
        $likesView = $this->view('likes', 'LikesView');
        $likesView->render();
    }
}