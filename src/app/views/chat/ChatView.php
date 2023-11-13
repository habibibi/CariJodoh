<?php

class ChatView
{
    public $user_id;
    public $other_id;
    public $our_name;
    public $other_name;
    
    public function __construct($data = []) {
        $this->user_id = $data['user_id'];
        $this->other_id = $data['other_id'];
        $this->our_name = $data['our_name'];
        $this->other_name = $data['other_name'];
    }

    public function render()
    {
        require_once __DIR__ . '/../../components/chat/ChatPage.php';
    }
}