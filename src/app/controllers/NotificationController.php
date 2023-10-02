<?php

class NotificationController extends Controller {
    public function index(){
        $notificationView = $this->view('notification', 'NotificationView');
        $notificationView->render();
    }
}