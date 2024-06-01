<?php

require_once __DIR__ . '/../app/init.php';

if(!session_id()) session_start();

$app = new App();