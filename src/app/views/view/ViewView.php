<?php

class ViewView
{
    public $data;
    
    public function __construct($data = []) {
        $this->data = $data;
    }

    public function render()
    {
        require_once __DIR__ . '/../../components/view/ViewPage.php';
    }
}