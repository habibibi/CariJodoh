<?php

class NotFoundController extends Controller
{
    public function index()
    {
        $notFoundView = $this->view('not-found', 'NotFoundView');
        $notFoundView->render();
    }
}