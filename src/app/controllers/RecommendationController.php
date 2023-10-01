<?php

class RecommendationController extends Controller {
    public function index(){
        $recommendationView = $this->view('recommendation', 'RecommendationView');
        $recommendationView->render();
    }
}