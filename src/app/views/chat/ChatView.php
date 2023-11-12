<?php

class ChatView
{
    public $user_id;
    public $other_id;
    
    public function __construct($data = []) {
        $this->user_id = $data['user_id'];
        $this->other_id = $data['other_id'];
    }

    public function render()
    {
        require_once __DIR__ . '/../../components/chat/ChatPage.php';
    }
}